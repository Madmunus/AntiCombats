<?
if(empty($ip)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=20' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=20' method='post'>";}?>
Укажите ip, по которому хотите найти персонажей:<BR>
<input type=text name=ip class=new size=27 maxlength=20>
<BR>
<BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=6 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["orden"]==2 && $db["admin_level"]>=6){

if(!ereg("[0-9.]$",$ip)){
print "в ip адресе могут присутствовать только цифры и знак \".\"!";
die();
}
if(strlen($ip)>20){
print "ip адрес может содержать не более чем 20 символов.";
die();
}
$S="select * from users where reg_ip='$ip'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонажей с ip-<B>$ip</B> не найдено в базе данных.";
die();
}
?><center> <b>Найденные персонажи:</b><br><?
while($ip_data = mysql_fetch_Array($q)){
$player = $ip_data["login"];
$pl1 = str_replace(" ","%20",$player);
$lev_ip = $ip_data["level"];
$orden_d = $ip_data["orden"];
$clan_s = $ip_data["clan_short"];
$clan_f = $ip_data["clan"];
$rang = $ip_data["rang"];
	if($orden_d==1){$orden_dis="Белое братство";}
	else if($orden_d==2){$orden_dis="Темное братство";}
	else if($orden_d==3){$orden_dis="Нейтральное братство";}
	else if($orden_d==4){$orden_dis="Алхимик";}
	else if($orden_d==5){$orden_dis="Тюремный заключеный";}
	if(empty($clan_s)){$clan="";}
	else{$clan="<img src='img/clan/$clan_s.gif' border=0 alt='$clan_f'>";}
	if(empty($orden_d)){$orden="";}
	else{
if ($orden_d==2) {$orden="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";}  
else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}
if ($orden_d==1) {$orden="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";}
}
	print "$orden$clan<b>$player</b> [$lev_ip]<a href='info.php?log=$pl1' target='$player'><img src='img/inf.gif' border=0></a><br>";
}

}
?>