<?
session_start();
define('AntiBK', true);

include("../engline/config.php");
include("../engline/dbsimple/Generic.php");
include("../engline/data/data.php");
include("../engline/functions/functions.php");

$guid = getGuid('game', '../');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('game', '../');
$char->test->Admin('game', '../');
?>
<html>
<head>
<title>Административная панель</title>
<link rel="stylesheet" type="text/css" href="css.css">
<script src="../scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
  $('body').on('click', '.menu', function (){
    $('.menu').css('font-weight', 'normal');
    $(this).css('font-weight', 'bold');
  });
  $('[name=main]').attr('height', ($(window).height()-150));
});
</script>
</head>
<body bgColor="#3D3D3B">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%" style="padding: 10px;">
  <tr><td align="center" colspan="2"><img src="img/enter.gif"><div align='right'>Здравствуйте, <strong><?echo $char->getLogin();?></strong> (<a href='javascript:window.close();' style='color: red; text-decoration: underline;'>Выход</a>)</div></td></tr>
  <tr height="100%">
    <td valign="top" width="240">
        <div class="white">Навигация</div><hr>
<?
$rows = $adb->select("SELECT * FROM `admin_menu` ORDER BY `id`;");
foreach ($rows as $menu)
{
  echo "<a href='main.php?act=$menu[href]' target='main' onclick='this.blur();' class='menu'>$menu[name]</a><br>";
  if (in_array($menu['href'], array('doc', 'coder', 'travm')))
    echo "<hr>";
}
?>
    </td>
    <td valign="top">
        <div class="white" id="info">Информация</div><hr>
        <iframe src="main.php" width="100%" height="500" noresize frameborder="0" name="main"></iframe>
    </td>
  </tr>
  <tr><td colspan="2" align='center'><small>Powered by Madmunus</small></td></tr>
</table>
</body>
</html>