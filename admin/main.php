<?
session_start ();
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("../engline/config.php");
include ("../engline/dbsimple/Generic.php");
include ("../engline/data/data.php");
include ("../engline/functions/functions.php");

$guid = getGuid ('main', '../');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid ('main', '../');
$char->test->Admin ('main', '../');

$act = requestVar ('act');
$name = $adb->selectCell ("SELECT `name` FROM `admin_menu` WHERE `href` = ?s", $act);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="../scripts/jquery-1.4.4.js" type="text/javascript"></script>
<script src="../scripts/scripts.js" type="text/javascript"></script>
<script src="../scripts/show.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<script>window.parent.document.getElementById('info').innerHTML = 'Информация: <?echo $name;?>';</script>
<?
switch ($act)
{
    case 'none':
    default:            echo "<center><img src='img/logo.gif'></center>";
    break;
    case 'doc':
    case 'admin_bd':
    case 'upload':
    case 'coder':
    case 'online':
    case 'room_all':
    case 'room':
    case 'kick_all':
    case 'kick':
    case 'unwear_all':
    case 'unwear':
    case 'travm_all':
    case 'travm':
    case 'hpmp':
    case 'add':
    case 'mer':
    case 'metka':
    case 'new':
    case 'stat_admin': include ("module/$act.php");
    break;
    case 'phpinfo':    echo "<script>window.parent.document.getElementById('info').innerHTML = 'Информация: Phpinfo';</script>";
                       phpinfo ();
    break;
    case 'exit':
        unset ($_SESSION['admin']);
        echo "<script>top.location.href = 'index.php';</script>";
    break;
}
?>
<div id="mmoves" class="mmoves"></div>