<?
session_start();
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
$char_db = $char->getChar('char_db', 'login', 'city', 'room', 'chat_shut', 'chat_filter', 'chat_sys', 'chat_update');
ArrToVar($char_db);

$do = getVar('do', '', 2);
switch ($do)
{
  /*Talk*/
  case 'sendmessage':
    $h = getVar('h');
    
    $commands = $adb->selectCol("SELECT `name` FROM `server_commands`;");
    $command = false;

    if ((!$h && !is_numeric($h)) || $chat_shut)
      returnAjax('none');
    
    $color = $char->getChar('char_info', 'color');
    
    if ($h[0] == '/')
    {
      foreach ($commands as $num => $name)
      {
        if (utf8_substr($h, 0, utf8_strlen($name)) == $name && $char->chat->executeCommand($name, $h))
          returnAjax('complete');
      }
    }
    
    $h = str_replace("\n", "", $h);
    $to = split(']', str_replace(array('to [', 'private ['), "]", $h));
    
    if (isset($to[1]))
    {
      $h = preg_replace("/private \[$to[1]/", "private [", $h, 1);
      $to = str_replace(", ", ",", $to[1]);
    }
    else
      $to = '';
    
    if (utf8_substr($h, 0, 4) == 'to [')
      $class = 'to';
    else if (utf8_substr($h, 0, 9) == 'private [')
      $class = 'private';
    else
      $class = 'all';
    
    $char->setChar('char_db', array('afk' => 0));
    if ($adb->query("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                     VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $login ,$to ,$room ,"<font color=$color>$h</font>" ,$class ,time() ,$city))
      returnAjax('complete');
    else
      returnAjax('error');
  break;
  /*Users*/
  case 'refreshusers':
    $room_online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s and `room` = ?s", $city ,$room);
    $room_name = $char->city->getRoom($room, $city, 'name');
    $user_list = "<font style='color: #8f0000; font-size: 10pt; font-weight: bold;'>$room_name ($room_online)</font><br>";

    $rows = $adb->select("SELECT `guid`, 
                                 `last_time` 
                          FROM `online` 
                          WHERE `city` = ?s 
                            and `room` = ?s 
                          ORDER by `login_display`", $city ,$room);
    foreach ($rows as $online)
    {
      if ($char->test->Online($online['guid']))
        $user_list .= $char->getLogin('online', $online['guid']);
    }
    returnAjax($user_list);
  break;
  /*Msg*/
  case 'refreshmessage':
    $char->setChar('char_db', array('last_time' => time()));
    $char->setChar('online', array('last_time' => time()));
    $go = getVar('go');
    $send = "";

    $last_t = (checks('last_t')) ?$_SESSION['last_t'] :0;
    $last_m = (checks('last_m')) ?$_SESSION['last_m'] :0;
    
    if (!$last_t || $go)
      $last_m = $_SESSION['last_m'] = ($adb->selectCell("SELECT MAX(`id`) FROM `city_chat` WHERE `room` = ?s and `city` = ?s", $room ,$city)) - 5;

    $rows = $adb->select("SELECT `msg`, 
                                 `sender`, 
                                 `to`, 
                                 `class`, 
                                 `date_stamp`, 
                                 `id` 
                          FROM `city_chat` 
                          WHERE `id` > ?d 
                            and `room` = ?s 
                            and `city` = ?s", $last_m ,$room ,$city);
    foreach ($rows as $message)
    {
      list($msg, $sender, $to, $class, $_SESSION['last_t'], $_SESSION['last_m']) = array_values($message);
      $date = (bcsub(time(), $_SESSION['last_t']) <= 86400) ?date('H:i', $_SESSION['last_t']) :date('d.m.y H:i', $_SESSION['last_t']);
      $sender2 = str_replace(" ", "%20", $sender);
      $to2 = str_replace(" ", "%20", $to);
      $smiles = split(':', $msg);
      if ($class == 'private')
      {
        $sent = '';
        $names = split(',', $to);
        foreach ($names as $key => $name)
        {
          $name_link = ($name == $login) ?str_replace(" ", "%20", $sender) :str_replace(" ", "%20", $name);
          $name_title = ($name == $login) ?$sender :$name;
          if ($sent != '')
            $sent .= ', ';
          $sent .= "<a href=javascript:top.AddTo('$name_link'); title='$name_title'><span class='private'>$name</span></a>";
        }
        $msg = preg_replace("/private \[\]/", "<font class='private'>private [$sent]</font>", $msg, 1);
      }
      $msg = preg_replace("/private \[/", "<a href=javascript:top.AddTo('$to2'); title='$to'><font class='private'>private</font></a> [", $msg, 1);
      $i = 0;
      foreach ($smiles as $key => $value)
      {
        if (file_exists("img/smiles/$value.gif") && $i < 3)
        {
          $msg = preg_replace("/\:$value\:/", "<img src='img/smiles/$value.gif' border='0' style='cursor: pointer;'>", $msg, 1);
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
          else if (!$chat_filter)
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
  case 'change_button':
    $but = getVar('but');
    $val = getVar('val');
    switch ($but)
    {
      default:
        $val = ($val == 'false' || $val === 0) ?0 :1;
      break;
      case 'slow':
        $val = ($val == 'false' || $val === 0) ?10 :60;
        $but = 'update';
      break;
    }
    $char->setChar('char_db', array('chat_'.$but => $val));
    returnAjax('complete');
  break;
}
?>