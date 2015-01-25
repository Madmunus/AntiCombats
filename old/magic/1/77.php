<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=orden&ord=2&spell=77' method='post'>
Укажите логин персонажа и уровень доступа:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=15>

<select class=new name=acces>
<option value=1>1
<option value=2>2
<option value=3>3
<option value=4>4
<option value=5>5
<option value=6>6
<option value=7>7
<option value=8>8
<?if ($db["login"]=='Мироздатель'){
echo"<option value=9>9
<option value=10>10";}?>
</select>
<BR>
Ранг:<BR>
<select class=new name=rang>
<option value=1>Верховный тарман
<option value=2>Тарман-владыка
<option value=3>Тарман-палач
<option value=4>Тарман-убийца
<option value=5>Тарман-каратель
<option value=6>Тарман-надсмотрщик
<option value=7>Тарман-служитель
</select>
<BR>
Отдел:<BR>
<select class=new name=type>
<option value="moder">Отдел модерации</option>
<option value="proverka">Ревизионный отдел</option>
<option value="public">Социальный отдел</option>
<!--<option value="forum">Форумный отдел</option>-->
</select>
<BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==2 && $db["admin_level"]>=9 or $db["login"]=='Мироздатель'){
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
if($res["orden"]!=0){
print "Персонаж <B>$target</B> уже имеет склонность, вы не можете принять в Армаду того,<br> у кого уже есть склонность.";
die();
}
if ($rang==1) {$stat_rang = "Верховный тарман";}
if ($rang==2) {$stat_rang = "Тарман-владыка";}
if ($rang==3) {$stat_rang = "Тарман-палач";}
if ($rang==4) {$stat_rang = "Тарман-убийца";}
if ($rang==5) {$stat_rang = "Тарман-каратель";}
if ($rang==6) {$stat_rang = "Тарман-надсмотрщик";}
if ($rang==7) {$stat_rang = "Тарман-служитель";}
$sql = "UPDATE characters SET orden='2',admin_level='$acces',type='$type',rang='$rang',stat_rang='$stat_rang' WHERE login='$target'";
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
$masseg= "<i>$opr &quot$login&quot принял$prefix персонажа &quot$target&quot в Армаду.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");
print "Персонаж $target принят в Армаду.";
}