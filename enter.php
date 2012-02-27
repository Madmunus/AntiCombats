<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$login = requestVar('login', '', 2);
$password = requestVar('password', '', 2);
?>
<html>
<head>
<title>Анти Бойцовский Клуб</title>
<link rel="SHORTCUT ICON" href="img/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
if (!($.browser.mozilla))
{
  alert('Поддерживается только браузер Mozilla Firefox');
  location.href = 'index.php';
}
</script>
</head>
<body bgcolor="#ffffff">
<?
$top = "Произошла ошибка:<br><pre>";
$bot = "</pre><a href='javascript: window.history.go(-1);'><b>Назад</b></a><hr>";

if (empty($login))
{
  echoScript("$('title').html('Произошла ошибка');");
  die ("$top Вы не ввели логин$bot");
}
else if (empty($password))
{
  echoScript("$('title').html('Произошла ошибка');");
  die ("$top Укажите пароль$bot");
}

$char_info = $adb->selectRow("SELECT `guid`, 
                                     `password`, 
                                     `city`, 
                                     `block`, 
                                     `room`, 
                                     `city` 
                              FROM `characters` 
                              WHERE `login` = ?s", $login) or die ("$top Логин \"$login\" не найден в базе.$bot");
$guid = $char_info['guid'];

$char = Char::initialization($guid, $adb);

if (SHA1 ($guid.':'.$password) != $char_info['password'])
{
  $char->history->authorization(0, $char_info['city'], 'wrong_password');
  die ("$top Неверный пароль для \"$login\". Введите логин/пароль на <a href='../combats'>титульной странице</a>$bot");
}
else if ($char_info['block'])
{
  $char->history->authorization(0, $char_info['city'], 'blocked');
  die ("$top Внимание!!! Персонаж $login заблокирован!$bot");
}

if (session_is_registered ('guid'))
{
  deleteSession();
  $_SESSION['guid'] = $guid;
}
else
  $_SESSION['guid'] = $guid;

$adb->query("DELETE FROM `online` WHERE `guid` = ?d", $guid);
$adb->query("INSERT INTO `online` (`guid`, `login_display`, `ip`, `city`, `room`, `last_time`) 
             VALUES (?d, ?s, ?s, ?s, ?s, ?d);", $guid ,$login ,$_SERVER['REMOTE_ADDR'] ,$char_info['city'] ,$char_info['room'] ,time ());
$adb->query("UPDATE `characters` SET `last_go` = ?d WHERE `guid` = ?d", time () ,$guid);
$_SESSION['zayavka_c_m'] = 1;
$_SESSION['zayavka_c_o'] = 1;
$_SESSION['battle_ref']  = 0;
$char->history->authorization(1, $char_info['city']);
?>
Авторизация окончена...
<script type="text/javascript">location.href = 'game.php';</script>
</body>
</html>