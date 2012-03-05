<?
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
?>
<html>
<head>
<title>Восстановление пароля</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body      {margin: 0px; background-color: #000000;}
a:link    {font-weight: normal; color: #f9f7ea; text-decoration: none;}
a:visited {font-weight: normal; color: #f9f7ea; text-decoration: none;}
a:active  {font-weight: normal; color: #77684d; text-decoration: none;}
a:hover   {color: #7e7765; text-decoration: underline;}
.inup     {border: #817a63 1px double; font-size: 8pt; color: #dfddd3; font-family: verdana, arial, helvetica, sans-serif; background-color: #151616; cursor: pointer;}
.btn      {border: #817a63 1px double; font-size: 7.5pt; color: #dfddd3; font-family: verdana, arial, helvetica, sans-serif; background-color: #2b2b18;}
.menu     {font-size: 10pt; color: white; font-family: verdana;}
</style>
</head>
<body class="menu">
<table class="menu" height="100%" cellSpacing="0" cellPadding="0" width="100%" border="0">
  <tfoot><tr height="30%"><td valign="top"><img src="img/site/18adult0.gif"></td></tr></tfoot>
  <thead><tr><td colspan="3" height="30%"></td></tr>
  <tr height="205"><td colspan="3" width="100%" valign="top" align="center" background="img/site/start6_02.jpg" style="background-repeat: repeat-x;"><img src="img/site/start2_ru_04.jpg"></td></tr></thead>
  <tbody><tr>
    <td width="100%" valign="top" align="center">
<?
if ($login)
{
  $db = $adb->selectRow("SELECT `mail` FROM `characters` WHERE `login` = ?s", $login);
  if (!$db)
    die("<font class='menu' style='color: red;'>Логин \"$login\" не найден в базе.</font><br><br><input type='button' class='inup' value='Назад' onclick='window.history.go(-1);'>");

  $msg = "Здравствуйте!\n";
  $msg .= "Кто-то с ip-адреса ".$_SERVER['REMOTE_ADDR']." запросил пароль к персонажу $login он-лайн игры АнтиБК+.\n";
  $msg .= "Так как в анкете персонажа $login указан этот e-mail, система выслала новый пароль.\n";
  $msg .= "Это письмо сгенерировано автоматически, не надо на него отвечать ;)\n";
  $msg .= "Администрация АнтиБК.";

  if (mail($db['mail'], "АнтиБК+. Пароль для персонажа $login", $msg, 'From: Администрация АБК <admin@abk.ru>', 'admin@abk.ru'))
    echo "<span class='menu'>Пароль от <b>$login</b> был выслан на e-mail, указанный в анкете.</span><br><br><input type='button' class='inup' value='На главную' onclick=\"window.location='index.php';\">";
  else
    echo "<br><span class='menu'>Не удалось отправить пароль на e-mail, указанный в анкете!</span><br><br><input type='button' class='inup' value='Назад' onclick='window.history.go(-1);'>";
}
else
{
?>
<table>
<form action="pass.php" name="pass" method="post">
  <tr><td><b><div class="menu">Забыли пароль?</div><br></b></td></tr>
  <tr><td><font class="menu">Укажите логин персонажа </font><input type="text" class="inup" size="25" name="login"></td></tr>
  <tr><td><input type="submit" class="inup" style="width: 145px;" value="Выслать пароль"></td></tr>
  <tr><td><input type="button" class="inup" value="Вернуться" onclick="window.history.go(-1);"></td></tr>
</form>
</table>
<?
}
?>
</td></tr></tbody>
</table>
</body>
</html>