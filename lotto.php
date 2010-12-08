<?
session_start();
$login = $_SESSION['login'];
include "conf.php";
$conn = @mysql_connect("$base_name","$base_user","$base_pass");
!@mysql_select_db("$db_name",$conn);
mysql_query("SET NAMES cp1251");
$sql = mysql_query("SELECT * FROM characters WHERE login='$login'");
while ($res = mysql_fetch_array($sql)){
$money = $res['money'];
}
	$fondasd = mysql_query("SELECT * FROM lotto_fond");
	$resta = mysql_fetch_array($fondasd);
	$fond = $resta['fond'];
if($act == none){
?><style type="text/css">
<!--
body {
	background-color: #E4E4E4;
}
-->
</style>

<table border=1 bordercolor=black width=100% bgcolor=#fffbbb><tr><td>
<table border=0 width=100% cellpadding=0 cellspacing=0 height=20>
<tr>

<td bgcolor=#fffbbb><strong>Лотерея</strong></td>

</tr>
</table>

</td></tr>
</table>

</td></tr></table>

<br>

<table border=1 width=100% bordercolor=black bgcolor=#fffbbb>
<tr>
<td width=20% valign=top><p>&nbsp&nbsp <? print "<a href='lotto?act=buy'><font color='black'>Купить билет</font></a>"; ?></p>
  <p>&nbsp&nbsp <? print "<a href='main.php?act=go&room_go=casino' class=us2><font color='black'>Выход</font></a>"; ?></p>
<?
$ordensql = mysql_query("SELECT * FROM characters WHERE login='$login'");
$ordenres = mysql_fetch_array($ordensql);
$orden = $ordenres['admin_level'];
if ($orden == 1){
?>
  <p>&nbsp&nbsp <? print "<a href='lotto?act=play'><font color='black'>Провести лотто</font></a>"; ?></p>
  </td>
<? } ?>
<td valign=top>
      <p><strong>Внимание!</strong><br>
        Стоимость билета 1 Кредит.</p>
  <p>Призовой фонд  <? print "<i>$fond</i>"; ?> Кредитов</p>
  <p>Розыгрышь каждую среду в 15:30 (по балтискаму времини)</p></td>
</tr></table></td></tr></table></td></tr></table></td></tr></table>
<?
exit();}
if ($act == "buy"){
	if ($money >= "100000000000000000000000.00"){
	print "<META HTTP-EQUIV='Refresh' CONTENT = '0; URL=lotto_buy.php'>";
	exit();}
	if ($money < "100000000000000000000000.00"){
	print "У вас недостаточно денег";
	exit();}
}
if ($act == "play"){
	print "<META HTTP-EQUIV='Refresh' CONTENT = '604800; URL=lotto_play.php'>";
exit();}
?>