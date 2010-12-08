<?
session_start ();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include_once ("engline/config.php");
include_once ("engline/dbsimple/Generic.php");
include_once ("engline/data/data.php");
include_once ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

switch ($_POST['do'])
{
  case 'checklogin':
	unset ($_SESSION['reg_login']);
    $login_check = $adb -> selectCell ("SELECT `guid` FROM `characters` WHERE `login` = ?s", $_POST['login']);
	if ($login_check)
	  echo "occupy";
	else
	{
	  $_SESSION['reg_login'] = $_POST['login'];
	  echo "free";
	}
  break;
}
?>