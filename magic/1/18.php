<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=orden&ord=1&spell=18' method='post'>
Укажите логин травмированного:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=15>
<BR>
<BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["login"]=='ПАЛАЧ'){


$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
$QUERY=mysql_query("SELECT * FROM users WHERE login='$target'");
$data=mysql_fetch_array($QUERY);

        $o_stat = $data['travm_old_stat'];
        $t_stat = $data['travm_stat'];
        $SQ = mysql_query("UPDATE users SET $t_stat='$o_stat',travm='0' WHERE login='$target'");

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
	$city = $db["city_game"];
        $time = time();
        $room = $db["room"];
        $d=date("d.m.y H:i");
if($login!=$target){
$text = "от всех травм персонажа &quot$target&quot";
}
else{
$text = "себя от всех травм";
}
$masseg= "<i>$opr &quot$login&quot излечил$prefix $text.</i>";
        mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");


print "Персонаж успешно излечен от всех травм.";
}
?>