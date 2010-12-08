<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='unshut' action='main.php?act=orden&ord=2&spell=88' method='post'>
Укажите логин персонажа:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=27>
<BR><BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==2 && $db["admin_level"]>=10 or $db["login"]=='Мироздатель'){
$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
if($target==$login){
print "На себя применить это заклинание невозможно!";
die();
}
if($res["orden"]!=2){
print "Вы не можете выгнать персонажа <B>$target</B>, т.к он не состоит в Армаде.";
die();
}
$sql = "UPDATE users SET orden='',admin_level='0' WHERE login='$target'";
$result = mysql_query($sql);
$pref=$db["sex"];
if($pref=="female"){
$prefix="а";
}
else{
$prefix="";
}
        $d=date("d.m.y H:i");
	$city = $db["city_game"];
        $time = time();
        $room = $db["room"];
if($db["orden"]==2){$opr="Тарман";}
else {$opr="Персонаж";}
$masseg= "<i>$opr &quot$login&quot изгнал$prefix персонажа &quot$target&quot из Армады.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");
print "Персонаж изгнан из Армады.";
}
?>