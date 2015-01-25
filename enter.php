<?
session_start();
define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$login = getVar('login', '', 2);
$password = getVar('password', '', 2);

$enter = $adb->selectCell("SELECT `login` FROM `server_info`;");
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <title>Анти Бойцовский Клуб</title>
  <link rel="SHORTCUT ICON" href="img/favicon.ico" />
  <script src="scripts/jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    if (!(/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)))
    {
      alert('Поддерживается только браузер Mozilla Firefox');
      location.href = 'index.php';
    }
  </script>
</head>
<body bgcolor="#ffffff">
<?
if (!$enter)
  error('Сервер оффлайн');
else if (empty($login))
  error('Вы не ввели логин');
else if (empty($password))
  error('Укажите пароль');

$char_info = $adb->selectRow("SELECT `guid`, 
                                     `password`, 
                                     `city`, 
                                     `block`, 
                                     `room`, 
                                     `city` 
                              FROM `characters` 
                              WHERE `login` = ?s", $login) or error("Логин \"$login\" не найден в базе.");

$guid = $char_info['guid'];

$char = Char::initialization($guid, $adb);

if (SHA1($guid.':'.$password) != $char_info['password'])
{
  $char->history->Auth(0, $char_info['city'], 'wrong_password');
  error("Неверный пароль для \"$login\". Введите логин/пароль на <a href='index.php'>титульной странице");
}
else if ($char_info['block'])
{
  $char->history->Auth(0, $char_info['city'], 'blocked');
  error("Внимание!!! Персонаж $login заблокирован!");
}

if (checks('guid'))
  deleteSession();

$adb->query("DELETE FROM `online` WHERE `guid` = ?d", $guid);
$adb->query("INSERT INTO `online` (`guid`, `login_display`, `sid`, `city`, `room`, `last_time`) 
             VALUES (?d, ?s, ?s, ?s, ?s, ?d);", $guid, $login, session_id(), $char_info['city'], $char_info['room'], time());
$char->setChar('char_db', array('last_go' => time()));
$_SESSION['guid'] = $guid;
$char->history->Auth(1, $char_info['city']);
echoScript("location.href = 'game.php';");
?>
</body>
</html>