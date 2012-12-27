<?
define('AntiBK', true);

include_once("engline/config.php");
include_once("engline/dbsimple/Generic.php");
include_once("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");
?>
<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico" />
<title>Новости Анти Бойцовского Клуба</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#3D3D3B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr><td background="img/site/sitebk_02.jpg"><div align="center"><img src="img/site/sitebk_03ru.gif" width="194" height="135"></div></td></tr>
  <tr>
    <td align="center" height="90%" valign="top">
      <table width="80%" height=100% border="0" cellpadding="0" cellspacing="0" bgcolor="#F2E5B1">
        <tr valign="top">
          <td width="29" align="right" valign="top" style="background: url(img/site/n21_08_1.jpg) repeat-y;"><img src="img/site/byst_start_08.jpg"></td>
          <td bgcolor="#F2E5B1" style="background: url(img/site/byst_start_04.jpg) no-repeat;">
            <br>
            <h3><p class="news">Новости</p></h3>
            <table width="73%" border="0" cellPadding="0" cellSpacing="0" align="center">
<?
$rows = $adb->select("SELECT * FROM `news` ORDER BY `id` DESC;");
foreach ($rows as $news)
{
  echo "<tr><td height='19'>"
     . "<table width='100%' border='0' cellpadding='0' cellspacing='0' background='img/site/evn_news_05.gif'><tr>"
     . "<td align='left' width='8' height='29'><img src='img/site/evn_news_03.gif' width='8' height='29'></td>"
     . "<td align='left' width='90%'><b><font color='#FFFFFF'>$news[theme]</font></b></td>"
     . "<td align='right' nowrap><font color='#FFFF80'>".date('d/m/y H:i', $news['date'])."</font></td>"
     . "<td align='right'><img src='img/site/evn_news_07.gif' width='9' height='29'></td>"
     . "</tr></table></td></tr>"
     . "<tr><td bgcolor='#EDE9DA'>"
     . "<table width='100%' border='0' cellpadding='0' cellspacing='0'><tr>"
     . "<td width='1%' background='img/site/evn_news_12.gif'><img src='img/site/evn_news_12.gif' width='8' height='100%'></td>"
     . "<td width='100%'>$news[msg]</td>"
     . "<td width='1%' background='img/site/evn_news_13.gif'><img src='img/site/evn_news_13.gif' width='9' height='14'></td>"
     . "</tr></table></tr>"
     . "<tr><td>"
     . "<table width='100%'  border='0' cellpadding='0' cellspacing='0' background='img/site/evn_news_17.gif'><tr>"
     . "<td align='left' width='8'><img src='img/site/evn_news_16.gif' width='8' height='24'></td>"
     . "<td width='100%'>&nbsp;<nobr>Комментариев: <b>0</b></nobr></td>"
     . "<td align='right' width='9'><img src='img/site/evn_news_18.gif' width='9' height='24'></td>"
     . "</tr></table></td></tr>";
}
?>
            </table>
          </td>
          <td width="23" valign="top" background="img/site/nnn21_03_1.jpg"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table cellSpacing="0" cellPadding="0" width="100%" border="0">
        <tr><td width="100%" height="13" background="img/site/sitebk_07.jpg"></td></tr>
        <tr><td width="100%" bgColor="#000" height="20" align="center" class="copyright"><?echo $config['copyright'];?></td></tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>