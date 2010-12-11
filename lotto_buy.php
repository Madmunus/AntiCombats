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
$sql2 = mysql_query("UPDATE characters SET money=money-1 WHERE login='$login'");
$num = rand(0, 9999);
$insert = mysql_query("INSERT INTO lotto(name, number) VALUES('$login','$num')");
$infond = mysql_query("UPDATE lotto_fond SET fond=fond+1");
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

<td bgcolor=#fffbbb><strong>&#1051;&#1086;&#1090;&#1090;&#1086;</strong></td>

</tr>
</table>

</td></tr>
</table>

</td></tr></table>

<br>

<table border=1 width=100% bordercolor=black bgcolor=#fffbbb>
<tr>
<td width=20% valign=top><p>&nbsp&nbsp <? print "<a href='lotto.php?act=none'><font color='black'>Главный холл</font></a>"; ?></p>
 </td>
<td valign=top><p>&#1041;&#1080;&#1083;&#1077;&#1090; &#1082;&#1091;&#1087;&#1083;&#1077;&#1085;</p>
  <p>&#1042;&#1072;&#1096; &#1085;&#1086;&#1084;&#1077;&#1088; <? print "$num"; ?> </p></td>
</tr></table></td></tr></table></td></tr></table></td></tr></table>