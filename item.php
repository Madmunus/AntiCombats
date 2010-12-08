<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='css/main.css' TYPE='text/css'>
<body topmargin=2>
<?
include "conf.php";
include "functions.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
$city=$db["city"];

if($nums>0){
?>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<td width=10><img src='img/cor2_l_t.gif'></td>
<td bgcolor=#cccccc><img src='img/20_20.gif'></td>
<td width=10><img src='img/cor2_r_t.gif'></td>
</tr>
</table>
<?
print "<table border=0 width=100% cellpadding=0 cellspacing=0><tr><td><table border=0 bgcolor=#888888 width=100% cellpadding=0 cellspacing=0><tr><td>";
print "<table border=0 width=100% cellpadding=2 cellspacing=0><tr>";
print "<td valign=top bgcolor=#cccccc><span class=usuallyb>";
print "<B>$name</B>";
if($need_orden!=0){
if($need_orden==1){$orden_dis="Белое братство";}
if($need_orden==2){$orden_dis="Темное братство";}
if($need_orden==3){$orden_dis="Нейтральное братство";}
if($need_orden==4){$orden_dis="Алхимик";}
if($need_orden==5){$orden_dis="Тюремный заключенный";}
print "&nbsp&nbsp<img src='img/orden/$need_orden.gif' border=0 alt='Требуемая склонность:\n$orden_dis'>";
}
print "</tr></td></table>";
print "<table border=0 width=100% bgcolor=#cccccc cellpadding=1 cellspacing=1><TR><TD valign=top bgcolor=#cccccc width=90>";
print "<center><img src='img/$img' alt='$name'><BR><center>";
?>