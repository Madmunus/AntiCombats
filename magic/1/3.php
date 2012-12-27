<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=3' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=3' method='post'>";}?>
Укажите логин персонажа и длительность действия магии:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=15>

<select class=new name=timer>
<option value=24>1 день
<option value=72>3 дня
<option value=168>неделя
<option value=360>15 суток
<option value=744>месяц
<option value=1440>2 месяца
<option value=2160>3 месяца
</select>
<BR>
причина заключения:<BR>
<input type=text name=reason class=new size=27>
<BR><BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=4 or $db["login"]==Мироздатель or $db["orden"]==2 && $db["admin_level"]>=4  or $db["login"]==Смотритель){
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
if(!empty($db["prision"])){
print "Пока вы в тюрьме, вы не можете использовать<BR> это заклятие на другого персонажа.";
die();
}
if(!empty($res["prision"]) or $res["prision"]!=0){
print "Персонаж уже в тюрьме!.";
die();
}
if ($db["login"]!=Смотритель){
if ($db["login"]!=Мироздатель){
if($res["admin_level"]>=$db["admin_level"] or $res["login"]==Мироздатель or $res["login"]==Смотритель){
print "Вы не можете отправить этого персонажа в тюрьму.";
die();
}}}
$d=date("H.i");
$time2=time()+$timer*1440;
$sql = "UPDATE characters SET orden='5',clan='',clan_short='',prision='$time2',prision_reason='$reason',room='Тюрьма',metka='' WHERE login='$target'";
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
if($timer==24){$days_d="сутки";}
if($timer==72){$days_d="3 дня";}
if($timer==168){$days_d="неделю";}
if($timer==360){$days_d="15 суток";}
if($timer==744){$days_d="месяц";}
if($timer==1440){$days_d="2 месяца";}
if($timer==2160){$days_d="3 месяца";}
if($db["orden"]==2){$opr="Тарман";}
else {$opr="Персонаж";}
if ($db["orden"]==1){$opr="Паладин";}
$S2 = mysql_query("INSERT INTO protocol(login,templier,type,reason,time) VALUES('$target','$login','prision','$reason','$days_d')");
$masseg= "<i>$opr &quot$login&quot отправил$prefix в тюрьму персонажа &quot$target&quot на $days_d.</i>";
mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");

    $shut_say = array();
    $shut_say[0] = "<font color=black>Всем нарушителям туда дорога...</font>";
    $shut_say[1] = "<font color=black>На свободу с чистой совестью!!!</font>";    
    $shut_say[2] = "<font color=black>Незавидую ему - на зоне был я однажды...</font>";
    $shut_say[3] = "<font color=black>Там его научат уму-разуму...</font>";
    $shut_say[4] = "<font color=black>Вот и пришло правосудие...</font>";
    $shut_say[5] = "<font color=black>Справедливость восторжествовала!</font>";
    $shut_say[6] = "<font color=black>А там плохо кормят...</font>";
    $shut_say[7] = "<font color=black>Кто хочет составить компанию?</font>";
    $shut_say[8] = "<font color=black>Вот, еще одним зэком больше....</font>";
    $shut_say[9] = "<font color=black>Все кто нарушит Закон - попадут туда же!</font>";

    $shut = $shut_say[rand(0,count($shut_say)-1)];

    $dname=date("H:i");

    $city = $db["city_game"];
        $room = $db["room"];
        $time = time();
        $sender = "Смотритель";
        mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$dname','$sender','$room','$shut','sys','$time','$city')");

print "Персонаж отправлен в тюрьму.";
}
?>