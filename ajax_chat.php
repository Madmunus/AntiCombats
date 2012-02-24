<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$guid = getGuid('ajax');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('ajax');
$char->test->Afk();

$lang = $char->getLang();
$char_db = $char->getChar('char_db', '*');
$char_stats = $char->getChar('char_stats', '*');
$char_feat = array_merge ($char_db, $char_stats);

$login = $char_feat['login'];
$city = $char_feat['city'];
$room = $char_feat['room'];
$shut = $char_feat['shut'];
$chat_filter = $char_feat['chat_filter'];
$chat_sys = $char_feat['chat_sys'];
$chat_update = $char_feat['chat_update'];

$do = requestVar('do');
switch ($do)
{
  /*Talk*/
  case 'sendmessage':
    $h = requestVar('h');
    
    $commands = $adb->selectCol("SELECT `name` FROM `server_commands`;");
    $command = false;

    if (!$h || $shut)
      returnAjax('none');
    
    $color = $char->getChar('char_info', 'color');
    
    if ($h[0] == '/')
    {
      foreach ($commands as $num => $name)
      {
        if (utf8_substr($h, 0, utf8_strlen($name)) == $name && $char->chat->executeCommand($name, $h, $guid))
          returnAjax('complete');
      }
    }
    
    $h = str_replace ("\n", "", $h);
    $to = split (']', str_replace (array('to [', 'private ['), "]", $h));
    
    if (isset ($to[1]))
    {
      $h = preg_replace ("/private \[$to[1]/", "private [", $h, 1);
      $to = str_replace (", ", ",", $to[1]);
    }
    else
      $to = '';
    
    if (utf8_substr($h, 0, 4) == 'to [')
      $class = 'to';
    else if (utf8_substr($h, 0, 9) == 'private [')
      $class = 'private';
    else
      $class = 'all';
    
    $adb->query("UPDATE `characters` SET `afk` = '0' WHERE `guid` = ?d", $guid);
    if ($adb->query("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                      VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $login ,$to ,$room ,"<font color=$color>$h</font>" ,$class ,time () ,$city))
      returnAjax('complete');
  break;
  /*Users*/
  case 'refreshusers':
    $room_online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s and `room` = ?s", $city ,$room);
    $room_name = $char->city->getRoom($room, $city, 'name');
    $user_list = "<font style='color: #8f0000; font-size: 10pt; font-weight: bold;'>$room_name ($room_online)</font><br>";

    $rows = $adb->selectCol("SELECT `guid` 
                             FROM `online` 
                             WHERE `city` = ?s 
                               and `room` = ?s 
                             ORDER by `login_display`", $city ,$room);
    foreach ($rows as $num => $online_guid)
      $user_list .= $char->info->character('online', $online_guid);
    returnAjax($user_list);
  break;
  /*Msg*/
  case 'refreshmessage':
    $go = requestVar('go');
    $send = "";

    $last = (isset($_SESSION['last'])) ?$_SESSION['last'] :0;
    if (!$last || $go)
      $last = $_SESSION['last'] = time () - 300;

    $rows = $adb->select("SELECT `msg`, 
                                 `sender`, 
                                 `to`, 
                                 `class`, 
                                 `date_stamp` 
                          FROM `city_chat` 
                          WHERE `date_stamp` > ?d 
                            and `room` = ?s 
                            and `city` = ?s", $last ,$room ,$city);
    foreach ($rows as $message)
    {
      list ($msg, $sender, $to, $class, $_SESSION['last']) = array_values ($message);
      $date = date ('H:i', $_SESSION['last']);
      $sender2 = str_replace (" ", "%20", $sender);
      $to2 = str_replace (" ", "%20", $to);
      $smiles = split (':', $msg);
      if ($class == 'private')
      {
        $sent = '';
        $names = split (',', $to);
        foreach ($names as $key => $name)
        {
          $name_link = ($name == $login) ?str_replace (" ", "%20", $sender) :str_replace (" ", "%20", $name);
          $name_title = ($name == $login) ?$sender :$name;
          if ($sent != '')
            $sent .= ', ';
          $sent .= "<a href=javascript:top.AddTo('$name_link'); title='$name_title'><span class='private'>$name</span></a>";
        }
        $msg = preg_replace ("/private \[\]/", "<font class='private'>private [$sent]</font>", $msg, 1);
      }
      $msg = preg_replace ("/private \[/", "<a href=javascript:top.AddTo('$to2'); title='$to'><font class='private'>private</font></a> [", $msg, 1);
      $i = 0;
      foreach ($smiles as $key => $value)
      {
        if (file_exists ("img/smiles/$value.gif") && $i < 3)
        {
          $msg = preg_replace ("/\:$value\:/", "<img src='img/smiles/$value.gif' border='0' style='cursor: pointer;'>", $msg, 1);
          $i++;
        }
        else if ($i >= 3)
          break;
      }
      
      $msg_full = " [<a href=javascript:top.AddTo('$sender2');><span>$sender</span></a>] $msg<br>";
      
      switch ($class)
      {
        case 'all':
          if (!$chat_filter)
            $send .= "<font class='date'>$date</font>$msg_full";
        break;
        case 'emotion':
          if (!$chat_filter)
            $send .= "<font class='date'>$date</font> <i><a href=javascript:top.AddTo('$sender2');><span>$sender</span></a> $msg</i><br>";
        break;
        case 'to':
          if ($to == $login || $sender == $login)
            $send .= "<font class='date2'>$date</font>$msg_full";
          else if (ereg(",", $to))
          {
            $characters = explode (',', $to);
            foreach ($characters as $key => $value)
            {
              if ($value == $login)
                $send .= "<font class='date2'>$date</font>$msg_full";
            }
          }
          else
            $send .= "<font class='date'>$date</font>$msg_full";
        break;
        case 'private':
          if ($to != $login && $sender == $login)
            $send .= "<font class='date'>$date</font>$msg_full";
          else if ($to == $login || $sender == $login)
            $send .= "<font class='date2'>$date</font>$msg_full";
          else if (ereg(",", $to))
          {
            $characters = explode (',', $to);
            foreach ($characters as $key => $value)
            {
              if ($value == $login)
                $send .= "<font class='date2'>$date</font>$msg_full";
            }
          }
        break;
        case 'sys':
          if ($to == $login && $chat_sys)
            $send .= "<font class='date2'>$date</font> <font color='red'>Внимание!</font> $msg<br>";
        break;
      }
    }
    returnAjax($send, $chat_update);
  break;
}
?>