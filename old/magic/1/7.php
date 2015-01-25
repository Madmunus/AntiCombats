<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=orden&ord=1&spell=7' method='post'>
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
<option value=1>Глава Ордена
Верховный паладин
<option value=2>Кавалер Ордена Света
<option value=3>Координатор
<option value=4>Паладин Неба
<option value=5>Инквизитор
<option value=6>Хранитель знаний
<option value=7>Зеленый Паладин
<option value=8>Паладин Огненной Зари
<option value=9>Паладин Солнечной Улыбки
<option value=10>Паладин Поднебесья
</select>
<BR>
Отдел:<BR>
<select class=new name=type>
<option value="moder">Отдел модерации</option>
<option value="clan">Отдел регистрации кланов</option>
<option value="proverka">Ревизионный отдел</option>
</select>
<BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=9 or $db["login"]=='Мироздатель'){
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
print "Персонаж <B>$target</B> уже имеет склонность, вы не можете принять в орден того,<br> у кого уже есть склонность.";
die();
}
if ($rang==1) {$stat_rang = "Глава Ордена | Верховный паладин";}
if ($rang==2) {$stat_rang = "Кавалер Ордена Света";}
if ($rang==3) {$stat_rang = "Координатор";}
if ($rang==4) {$stat_rang = "Паладин Неба";}
if ($rang==5) {$stat_rang = "Инквизитор";}
if ($rang==6) {$stat_rang = "Хранитель знаний";}
if ($rang==7) {$stat_rang = "Зеленый Паладин";}
if ($rang==8) {$stat_rang = "Паладин Огненной Зари";}
if ($rang==9) {$stat_rang = "Паладин Солнечной Улыбки";}
if ($rang==10) {$stat_rang = "Паладин Поднебесья";}
$sql = "UPDATE characters SET orden='1',admin_level='$acces',type='$type',rang='$rang',stat_rang='$stat_rang' WHERE login='$target'";
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
if($db["orden"]==1){$opr="Паладин";}
else {$opr="Персонаж";}
$masseg= "<i>$opr &quot$login&quot принял$prefix персонажа &quot$target&quot в Паладинский орден.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");
print "Персонаж $target принят в орден.";
}