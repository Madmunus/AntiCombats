<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='chin' action='main.php?act=clan&do=2&a=give' method='post'>
Укажите логин нового главы клана:<BR>
<input type=text name='target' class=new size=15>

<BR><BR>
<input type=submit value=" вперед " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["glava"]==1){
$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
if($res["clan_short"]!=$clan_s){
print "Персонаж <B>$target</B> не состоит в Вашем клане!";
die();
}

	$sql = "UPDATE users SET chin='Глава',glava='1',clan_take='1' WHERE login='$target'";
	$result = mysql_query($sql);
	$S = mysql_query("UPDATE users SET glava='0',chin='Экс-глава' WHERE login='$login'");
	$S2 = mysql_query("UPDATE clan SET glava='$target' WHERE name_short='$clan_s'");

	if($result){
	print "Новый глава клана: $target";
	}
	else{
	echo mysql_error();
	}

}