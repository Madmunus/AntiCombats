<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=clan&do=3' method='post'>
За прием в клан нового члена, Вы должны уплотить пошлину 100 кр.<BR>
Новый член клана должен пройти проверку Паладинов.<BR>
Укажите логин персонажа:<BR>
<input type=text name='target' class=new size=15>

<BR><BR>
<input type=submit value=" принять в клан " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["clan_take"]==1){
$S="select * from characters where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
if($res["clan_short"]!='' AND $res["clan_short"]!=0 OR $res["orden"]!='' AND $res["orden"]!=0){
print "Персонаж <B>$target</B> уже состоит в клане/ордене";
die();
}
if($res["metka"]=='0' OR $res["metka"]==''){
print "Персонаж <B>$target</B> не прошел проверку Паладинов!";
die();
}
if($db["money"]<100){
print "У Вас недостаточно средств, для приема в клан нового члена!";
die();
}
$sql = "UPDATE characters SET clan='$clan_t',clan_short='$clan_s',chin='Новобранец',orden='$orden_t' WHERE login='$target'";
$result = mysql_query($sql);
$S = mysql_query("UPDATE characters SET money=money-100 WHERE login='$login'");
if($result){
print "Персонаж <b>$target</b> принят в клан. С Вашего счета снято 100 кр.";
}
else{
echo mysql_error();
}
}