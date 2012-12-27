<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='unshut' action='main.php?act=orden&ord=1&spell=9' method='post'>
Укажите логин персонажа:<BR>
<input type=text name='target' class=new size=27>
<BR>
Выберите орден:<BR>
<select name='orden_num' class=new>
<option value='3'>За службу
<option value='2'>Темплиерский орден
<option value='1'>Бета-тестеру
<option value='4'>За помощь в создании
<option value='5'>За храбрость
<option value='6'>св. Екатерина
<option value='7'>св. Анна
<option value='8'>Валентинка
</select>
<BR><BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=10){
$S="select * from characters where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
$sql = "INSERT INTO inv(owner,object_id,object_type,object_razdel,gift,wear,gift_author) VALUES('$target','$orden_num','medal','thing','1','0','$login')";
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
$masseg= "<i>Паладин &quot$login&quot наградил$prefix персонажа &quot$target&quot орденом.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");
print "Персонаж награжден.";
}
?>