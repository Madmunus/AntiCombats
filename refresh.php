<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$guid = getGuid();

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid();
$char->test->Zayavka();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Refresh" content="10; url=refresh.php">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<script src="scripts/jquery.js" type="text/javascript"></script>
</head>
<body topmargin="0">
<?
$char_db = $char->getChar('char_db', 'login', 'room', 'city', 'battle', 'battle_opponent');
ArrToVar($char_db);

if ($battle)
{
  echo "<script>$('#mes', parent.msg.document).append('$_SESSION[battle_ref]<br>');</script>";
  if ($battle_opponent && !$_SESSION['battle_ref'])
  {
    //print "<script>top.main.location.reload()</script>";
    $_SESSION['battle_ref'] = 1;
  }
}

/*---------------------Проверки ip-------------------------*/
$ip = $adb->selectCell("SELECT `ip` FROM `online` WHERE `guid` = ?d", $guid) or die ("<script>top.main.location.href = 'main.php?action=exit';</script>");
if ($ip != $_SERVER['REMOTE_ADDR'])
  die ("<script>top.main.location.href = 'main.php?action=exit';</script>");
?>
</body>
</html>