<?
session_start ();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("../engline/config.php");
include ("../engline/dbsimple/Generic.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$user = strtoupper ($admin);
$data = $adb -> selectRow ("SELECT 	`guid`, 
									`password` 
							FROM `characters` 
							WHERE `login` = ?s
							  and `admin_level` > 0;", $admin) or die ("$top Логин $admin не найден в базе.$bot");
$top = "Произошла ошибка:<br><br><span class='err'>";
$bot = "</span><br><br><a href='javascript: window.history.go(-1);' class='us2'>Назад</a><hr>";
if (empty($admin) || empty($pass)) die("$top Вы не ввели логин либо пароль.$bot");
else if (session_is_registered ('admin')) {unset ($_SESSION['admin']); die("$top Двое или больше пользователей пытаются зайти в админ панель!<br>Попробуйте войти еще раз!$bot");}
else if (SHA1 ($data['guid'].':'.$pass)  != $data['password']) die("$top Неверный пароль для $admin.$bot");

if (!empty($_SESSION['admin']))
{
	session_unregister ('admin');
	session_register ('admin');
}
else
	session_register ('admin');
echo "<script>location.href = 'admin.php';</script>";
?>