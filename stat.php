<?
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/data/data.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$equip = Equip::setguid(0);
$info = new info;
?>
<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico" />
<title>Анти Бойцовский Клуб: Рейтинг бойцов</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="private">
<link href="styles/main.css" rel="stylesheet" type="text/css">
</head>
<body bgColor="#3D3D3B" leftMargin="0" topMargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
  <thead><tr><td background="img/site/sitebk_02.jpg" scope="col" align="center"><img src="img/site/sitebk_03ru.gif" width="194" height="135"></td></tr></thead>
  <tfoot>
    <tr><td width="100%" height="13" background="img/site/sitebk_07.jpg"></td></tr>
    <tr><td width="100%" bgColor="#000" height="20" align="center" class="copyright">Copyright © 2002—2010 Dragon Server</td></tr>
  </tfoot>
  <tbody>
  <tr>
    <td align="center" height="90%">
      <table width="70%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f2e5b1">
        <tr valign="top">
          <td width="29" align="left" valign="top" style='background: url(img/site/n21_08_1.jpg) repeat-y'><img src="img/site/raitt_08.jpg"></td>
          <td width="40"><img src="img/site/raitt_04.jpg"></td>
          <td style="padding: 35px;">
            <table width="100%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td>
                  <img src="img/site/ratin_10.gif" border="0"><br><br>
                  <table width='100%'><tr><td>&nbsp; &nbsp; Рейтинг бойцов клуба<td>
                  <td align='right'>Статистика на <code><?echo DATE_NO_SEC;?></code></td></tr></table>
                  <br>
                  <table width='100%'  border='0' cellpadding='0' cellspacing='0' background='img/site/ram12_34.gif' align='center'>
                    <tr>
                      <td align='left' scope='col'><img src='img/site/ram12_33.gif' width='12' height='11'></td>
                      <td scope='col'></td>
                      <td width='18' align='right' scope='col'><img src='img/site/ram12_35.gif' width='13' height='11'></td>
                    </tr>
                  </table>
<?//
$players = $adb -> select ("SELECT `guid`, 
                                   `login`, 
                                   `exp` 
                            FROM `characters` 
                            WHERE `admin_level` = '0' 
                            ORDER BY `exp` DESC
                            LIMIT 200;");
echo "<table width='100%' border='0' cellpadding='0' cellspacing='1' align='center'>";
echo "<tr bgcolor='#ECDFAA'>";
echo "<td align='left' width='2%'><b>№</b></td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'><b>рейтинг</b></td>";
echo "</tr>";
for ($i = 0; $i < count ($players); $i++)
{
  $bg = (!($i % 2 === 0) || $i == 1) ?" bgcolor='#ECDFAA'" :"";
  echo "<tr$bg>";
  echo "<td align='right'>".($i + 1).".</td>";
  echo "<td>".$info -> character ($players[$i]['guid'])."</td>";
  echo "<td align='right'><b>".getExp ($players[$i]['exp'])."</b></td>";
  echo "</tr>";
}
echo "</table>";
?>
                </td>
              </tr>
            </table>
          </td>
          <td width="40" align="right"><img src="img/site/rairus_03.jpg" border="0" valign="top"></td>
          <td width="23" valign="top" background="img/site/nnn21_03_1.jpg"></td>
        </tr>
        <tr>
          <td style='background:url(img/site/n21_08_1.jpg) repeat-y'></td>
          <td colspan="3" align="right"><img src="img/site/raitt_15.jpg" border="0" valign="top"></td>
          <td valign="top" background="img/site/nnn21_03_1.jpg"></td>
        </tr>
      </table>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>