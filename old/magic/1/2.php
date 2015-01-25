<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=2' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=2' method='post'>";}?>
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
else if($db["orden"]==1 && $db["admin_level"]>=2 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["orden"]==2 && $db["admin_level"]>=2){
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
if(!empty($db["shut"])){
print "Пока на вас действует заклятие молчания, вы не можете снять<BR> заклятие с другого персонажа.";
die();
}
if(empty($res["shut"]) or $res["shut"]==0){
print "На персонаже нет заклинания молчания!.";
die();
}
if ($db["login"]!=Смотритель){
if ($db["login"]!=Мироздатель){
if($res["admin_level"]>=$db["admin_level"] or $res["login"]==Мироздатель or $res["login"]==Смотритель){
print "Вы не можете снять заклинание молчания с этого персонажа.";
die();
}}}
$sql = "UPDATE characters SET shut='0' WHERE login='$target'";
$result = mysql_query($sql);
$pref=$db["sex"];
if($pref=="female"){
$prefix="а";
}
else{
$prefix="";
}
if($db["orden"]==2){$opr="Тарман";}
else {$opr="Персонаж";}
if ($db["orden"]==1){$opr="Паладин";}
        $d=date("d.m.y H:i");
    $city = $db["city_game"];
        $time = time();
        $room = $db["room"];
$S2 = mysql_query("INSERT INTO protocol(login,templier,type) VALUES('$target','$login','unshut')");
$masseg= "<i>$opr &quot$login&quot снял$prefix заклятие молчания с персонажа &quot$target&quot.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");
print "Заклятие снято!";
}
?>