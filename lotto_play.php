<?
session_start();
$login = $_SESSION['login'];
include "conf.php";
$conn = @mysql_connect("$base_name","$base_user","$base_pass");
!@mysql_select_db("$db_name",$conn);
mysql_query("SET NAMES cp1251");
$num = rand(0,9999);
	$fondasd = mysql_query("SELECT * FROM lotto_fond");
	$resta = mysql_fetch_array($fondasd);
	$fond = $resta['fond'];

	$sqlwin = mysql_query("SELECT * FROM lotto WHERE number='$num'");
	$reswinrow = mysql_num_rows($sqlwin);
		if($reswinrow == 0){
			$win = "нет";;
			$sbrosf = mysql_query("UPDATE lotto_fond SET fond=0");
			$sbrosl = mysql_query("TRUNCATE TABLE lotto");
		}else{
			while ($reswin = mysql_fetch_array($sqlwin)){
			$win = $reswin['name'];
			}
			$plus = mysql_query("UPDATE characters SET money=money+'$fond' WHERE login='$win'");
			$sbrosf = mysql_query("UPDATE lotto_fond SET fond=0");
			$sbrosl = mysql_query("TRUNCATE TABLE lotto");
			}
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
<td width=20% valign=top><p>Игра проведена! <? print "<a href='lotto.php?act=none'><font color='black'>Главный холл</font></a>"; ?></p>
 </td>
<td valign=top><p>Выпавший номер:<? print "$num"; ?></p>
  <p>Победитель: <? print"$win"; ?> Фонд составил <? print"$fond"; ?>кр.</p></td>
</tr></table></td></tr></table></td></tr></table></td></tr></table>