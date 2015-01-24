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
$acts = $adb->selectCol("SELECT `href` AS ARRAY_KEY, `name` FROM `admin_menu`;");
$act = (array_key_exists($act, $acts)) ?$act :'none';
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="../scripts/jquery.js" type="text/javascript"></script>
<script src="../scripts/show.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script type="text/javascript">$('#info', parent.document).html('Информация: <?echo $acts[$act];?>');</script>
<?
switch ($act)
{
  case 'none':    echo "<center><img src='img/logo.gif'></center>"; break;
  case 'phpinfo': phpinfo();                                        break;
  default:        include("module/$act.php");                       break;
}
?>