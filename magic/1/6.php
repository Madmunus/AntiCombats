<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=6' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=6' method='post'>";}?>
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
else if($db["orden"]==1 && $db["admin_level"]>=7 or $db["login"]=='Мироздатель' or $db["orden"]==2 && $db["admin_level"]>=7 or $db["login"]==Смотритель){
$S="select * from characters where login='$target'";
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
if(empty($res["block"]) or $res["block"]==0){
print "Этот персонаж не заблокирован!.";
die();
}
if ($db["login"]!=Смотритель){
if ($db["login"]!=Мироздатель){
if($res["admin_level"]>=$db["admin_level"] or $res["login"]==Мироздатель or $res["login"]==Смотритель){
print "Вы не можете разблокировать этого персонажа.";
die();
}}}
$sql = "UPDATE characters SET block='0' WHERE login='$target'";
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
if ($db["orden"]==1){$opr="Паладин";}
$S2 = mysql_query("INSERT INTO protocol(login,templier,type) VALUES('$target','$login','unkill')");
$masseg= "<i>$opr &quot$login&quot разблокировал$prefix персонажа &quot$target&quot.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");
print "Персонаж $target разблокирован.";
}
?>