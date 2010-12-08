<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=clan&do=2&a=zam' method='post'>
Назначить заместителем(возможность приема в клан) персонажа:<BR>
<input type=text name='target' class=new size=15>

<BR><BR>
<input type=submit value=" назначить " class=new>
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
print "Персонаж <B>$target</B> не состоит в Вашем клане";
}
else{
$sql = "UPDATE users SET clan_take='1', chin='Зам. Главы' WHERE login='$target'";
$result = mysql_query($sql);

if($result){
print "Персонаж $target назначен заместителем главы клана.";
}
else{
echo mysql_error();
}
}
}