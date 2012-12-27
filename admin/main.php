<?
session_start();
define('AntiBK', true);

include("../engline/config.php");
include("../engline/dbsimple/Generic.php");
include("../engline/data/data.php");
include("../engline/functions/functions.php");
include("functions.php");

$guid = getGuid('main', '../');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('main', '../');
$char->test->Admin('main', '../');

$act = getVar('act', 'none');
$name = $adb->selectCell("SELECT `name` FROM `admin_menu` WHERE `href` = ?s", $act);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="../scripts/jquery.js" type="text/javascript"></script>
<script src="../scripts/show.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<script>$('#info', parent.document).html('Информация: <?echo $name;?>');</script>
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
    case 'stat_admin': include("module/$act.php");
    break;
    case 'phpinfo':    phpinfo();
    break;
}
?>