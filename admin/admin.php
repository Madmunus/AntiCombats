<?
session_start ();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("../engline/config.php");
include ("../engline/dbsimple/Generic.php");
include ("functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

if (empty($admin))
{
	unset ($_SESSION['admin']);
	echo "<script>top.location.href = 'index.php';</script>";
}
$rows = $adb -> select ("SELECT * FROM `admin_menu` ORDER BY `id`;");
?>
<html>
<head>
<title>Администрация</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body bgColor="#3D3D3B">
<table align="center" cellpadding="0" cellspacing="5" width="100%" height="100%">
	<tr><td align="center" colspan="2"><img src="img/enter.gif"><?echo "<div align='right'>Здравствуйте, <strong>".character ($admin)."</strong> (<a href='main.php?act=exit' target='mi' onclick='this.blur ();' style='color: red; text-decoration: underline;'>Выход</a>)</div>";?></td></tr>
	<tr>
		<td valign="top" width="270">
			<div class="block">
			<div class="white">Навигация</div>
			<hr>
			<div>
<?
foreach ($rows as $menu)
{
	echo "<a href='main.php?act={$menu['href']}' target='mi' onclick='this.blur ();'>{$menu['name']}</a><br>";
	if (in_array ($menu['href'], array('doc', 'coder', 'travm', 'team2')))
		echo "<hr>";
}
?>
			</div>
			</div>
		</td>
		<td valign="top" height="95%">
			<div class="block">
				<div class="white" id="info">Информация</div>
				<hr>
				<div align="center"><iframe src="main.php" width="100%" noresize frameborder="0" name="mi" style="height: 690;"></iframe></div>
			</div>
		</td>
	</tr>
	<tr><td colspan="2"><center><font size="-2"><small>Powered by Madmunus</a><br></small></font></center></td></tr>
</table>
</body>
</html>