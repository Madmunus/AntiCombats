<?
$time = microtime (true);

session_start ();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

$guid = (empty($_SESSION['guid'])) ?0 :$_SESSION['guid'];

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$test = Test::setguid($guid);
$info = new Info;

$go = (isset($_GET['go'])) ?1 :0;

$test -> Guid ($guid);
$test -> Zayavka ();
$test -> Afk ();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="10; url=refresh.php">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<script src="scripts/jquery-1.4.3.js" type="text/javascript"></script>
</head>
<body topmargin="0" onload="parent.msg.window.scroll(0, 65000);">
<?
$db = $adb -> selectRow ("SELECT `login`, 
                                 `room`, 
                                 `city`, 
                                 `battle`, 
                                 `battle_opponent`, 
                                 `chat_s` 
                          FROM `characters` 
                          WHERE `guid` = ?d", $guid);
list ($login, $room, $city, $battle, $battle_opponent, $chat_s) = array_values ($db);

if ($battle)
{
  echo "<script>parent.msg.document.getElementById('mes').innerHTML += '$_SESSION[battle_ref]<br>'</script>";
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
  if (!isset($_SESSION['ENTERED']) || $go)
    $last = time () - 300;
  else if (empty($last))
    $last = $_SESSION['last'] = time ();

  $rows = $adb -> select ("SELECT `msg`, 
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
$('#mes', parent.msg.document).html($('#mes', parent.msg.document).html() + "<?echo $send;?>");
</script>
<?
  }
}
else if ($chat_s == 2)
  $_SESSION['last'] = time ();

/*================Генерация списка чатовцев================*/
/*---------------------Проверки ip-------------------------*/
$ip = $adb -> selectCell ("SELECT `ip` FROM `online` WHERE `guid` = ?d", $guid) or die ("<script>top.main.location.href = 'main.php?action=exit';</script>");
if ($ip != $_SERVER['REMOTE_ADDR'])
  die ("<script>top.main.location.href = 'main.php?action=exit';</script>");

/*------------------Обновление онлайн----------------------*/
$search = $adb -> selectCell ("SELECT `guid` FROM `online` WHERE `guid` = ?d", $guid);
if ($search)
  $adb -> query ("UPDATE `online` SET `room` = ?s WHERE `guid` = ?d", $room ,$guid);
/*---------------------Очистка чата------------------------*/
$seek = $adb -> selectCell ("SELECT COUNT(*) FROM `city_chat` WHERE `city` = ?s and `room` = ?s", $city ,$room);
if ($seek > 1000)
{
  $adb -> query ("DELETE FROM `city_chat` WHERE `city` = ?s and `room` = ?s", $city ,$room);
  $adb -> query ("ALTER TABLE `city_chat` AUTO_INCREMENT = 1;");
}
/*-------------------Создание списка-----------------------*/
$room_online = $adb -> selectCell ("SELECT COUNT(*) FROM `online` WHERE `city` = ?s and `room` = ?s", $city ,$room);
$room_name = $adb -> selectCell ("SELECT `name` FROM `city_rooms` WHERE `city` = ?s and `room` = ?s", $city ,$room);
$user_list = "<br><center><input type='button' class='nav' value='Обновить' onclick='top.ref.location.reload();'></center><font style='color: #8f0000; font-size: 10pt; font-weight: bold;'>$room_name ($room_online)</font><br>";

$rows = $adb -> selectCol ("SELECT `guid` 
                            FROM `online` 
                            WHERE `city` = ?s 
                              and `room` = ?s 
                            ORDER by `login_display`", $city ,$room);
foreach ($rows as $num => $list_guid)
  $user_list .= $info -> character ($list_guid, 'online');
/*=========================================================*/
$time = round (microtime(true) - $time, 2);
?>
<script type="text/javascript">
$('#user_list', parent.user.document).html("<?echo $user_list."<br>Загружено за: ".$time." сек.";?>");
</script>
</body>
</html>