<?
session_start ();
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$guid = getGuid ();

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$go = (isset($_GET['go'])) ?1 :0;

$char->test->Guid ();
$char->test->Zayavka ();
$char->test->Afk ();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="10; url=refresh.php">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<script src="scripts/jquery-1.4.4.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
</head>
<body topmargin="0" onload="parent.msg.window.scroll(0, 65000);">
<?
$char_db = $char->getChar ('char_db', 'login', 'room', 'city', 'battle', 'battle_opponent', 'chat_s');
ArrToVar ($char_db);

if ($battle)
{
  echo "<script>$('#mes', parent.msg.document).append('$_SESSION[battle_ref]<br>');</script>";
  if ($battle_opponent && !$_SESSION['battle_ref'])
  {
    //print "<script>top.main.location.reload()</script>";
    $_SESSION['battle_ref'] = 1;
  }
}

/*================Чат================*/
$send = "";

if ($chat_s != 2)
{
  $last = (isset($_SESSION['last'])) ?$_SESSION['last'] :0;
  if ($go || !$last)
    $last = $_SESSION['last'] = time () - 300;

  $rows = $adb->select ("SELECT `msg`, 
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
        if ($chat_s == 0)
          $send = "<font class='date'>$date</font>$msg_full";
      break;
      case 'emotion':
        if ($chat_s == 0)
          $send = "<font class='date'>$date</font> <i><a href=javascript:top.AddTo('$sender2');><span>$sender</span></a> $msg</i><br>";
      break;
      case 'to':
        if ($to == $login || $sender == $login)
          $send = "<font class='date2'>$date</font>$msg_full";
        else if (ereg(",", $to))
        {
          $characters = explode (',', $to);
          foreach ($characters as $key => $value)
          {
            if ($value == $login)
              $send = "<font class='date2'>$date</font>$msg_full";
          }
        }
        else
          $send = "<font class='date'>$date</font>$msg_full";
      break;
      case 'private':
        if ($to != $login && $sender == $login)
          $send = "<font class='date'>$date</font>$msg_full";
        else if ($to == $login || $sender == $login)
          $send = "<font class='date2'>$date</font>$msg_full";
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
        if ($sender == '' && $to == $login)
          $send = "<font class='date2'>$date</font> <font color='red'>Внимание!</font> $msg<br>";
      break;
    }
?>
<script type="text/javascript">
var mes_class = "<?echo $class;?>";
$('#mes', parent.msg.document).append("<?echo $send;?>");
</script>
<?
  }
}
else if ($chat_s == 2)
  $_SESSION['last'] = time ();

/*---------------------Проверки ip-------------------------*/
$ip = $adb->selectCell ("SELECT `ip` FROM `online` WHERE `guid` = ?d", $guid) or die ("<script>top.main.location.href = 'main.php?action=exit';</script>");
if ($ip != $_SERVER['REMOTE_ADDR'])
  die ("<script>top.main.location.href = 'main.php?action=exit';</script>");
?>
</body>
</html>