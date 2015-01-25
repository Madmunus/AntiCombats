<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=1' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=1' method='post'>";}?>
Укажите логин персонажа и длительность действия магии:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=15>

<select class=new name=timer>
<option value=15>15 мин
<option value=30>30 мин
<option value=60>60 мин
<option value=120>2 часа
<option value=360>6 часов
<option value=720>12 часов
<option value=1480>24 часов
</select>
<BR>
<BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=1 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["orden"]==2 && $db["admin_level"]>=1){


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
print "Пока на вас действует заклятие молчания, вы не можете использовать<BR> заклятие на другого персонажа.";
die();
}
if(!empty($res["shut"]) or $res["shut"]!=0){
print "На персонаже уже есть заклинание молчания!.";
die();
}
if ($db["login"]!=Смотритель){
if ($db["login"]!=Мироздатель){
if($res["admin_level"]>=$db["admin_level"] or $res["login"]==Мироздатель or $res["login"]==Смотритель){
print "Вы не можете использовать заклинание молчания на этого персонажа.";
die();
}}}
$d=date("d.m.y H:i");
$time2=time()+$timer*60;
$sql = "UPDATE characters SET shut='$time2' WHERE login='$target'";
$result = mysql_query($sql);

$hours=floor($timer/60);
$minutes=$timer-$hours*60;

if($hours>0){
if($hours==2 or $hours==24){
$hours_d="$hours часа";
}
else{
$hours_d="$hours часов";
}
$minutes_d="";
}
else{
$hours_d="";
$minutes_d="$minutes минут";
}
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
$masseg= "<i>$opr &quot$login&quot наложил$prefix заклятие молчания на персонажа &quot$target&quot, сроком $hours_d $minutes_d.</i>";
        mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$masseg','sys','$time','$city')");

    $time_d = "$hours_d  $minutes_d";
    $S2 = mysql_query("INSERT INTO protocol(login,templier,type,reason,time) VALUES('$target','$login','shut','$reason','$time_d')");

    $shut_say = array();
    $shut_say[0] = "<font color=red>А я его предупреждал - помалкивай!</font>";
    $shut_say[1] = "<font color=red>А кто много говорит, с теми так всегда поступают...</font>";    
    $shut_say[2] = "<font color=red>Эх, помолчу-ка и я...</font>";
    $shut_say[3] = "<font color=red>Строго, но по закону!</font>";
    $shut_say[4] = "<font color=red>Стоило рот раскрывать...</font>";
    $shut_say[5] = "<font color=red>Вот и договорились)</font>";
    $shut_say[6] = "<font color=red>А вот раньше просто кляпом рот затыкали.</font>";
    $shut_say[7] = "<font color=red>А еще раз можешь? ;) </font>";
    $shut_say[8] = "<font color=red>А раньше все не так было</font>";
    $shut_say[9] = "<font color=red>Будете много говорить и с Вами такое случится...</font>";
    $shut_say[10] = "<font color=red>Значит, есть еще порядок в этом мире </font>";
    $shut_say[11] = "<font color=red>Молчание - золото. Ощути себя богатым.</font>";
    $shut_say[12] = "<font color=red>Будете много говорить и с Вами такое случится...</font>";
    $shut_say[13] = "<font color=red>Молчание не ценят, потому что оно достается на халяву... \"$target\"., но ему подарю с удовольствием! </font>";
    $shut_say[14] = "<font color=red>Нет крика громче тишины...</font>";
    $shut_say[15] = "<font color=red>Ну, как, дошло?</font>";
    $shut_say[16] = "<font color=red>О чем с этим человеком можно говорить, когда с ним и помолчать то не о чем!</font>";
    $shut_say[17] = "<font color=red>Прям как рыбка теперь, только рот открывается. </font>";
    $shut_say[18] = "<font color=red>Тебе повезло, что не навсегда. </font>";
    $shut_say[19] = "<font color=red>А культурный человек сказал бы Заткнись, пожалуйста </font>";
    $shut_say[20] = "<font color=red>Безобразие куда цензура смотрит?</font>";
    $shut_say[21] = "<font color=red>  В Клубе жесткие законы... Только не надо тосковать по беззаконью </font>";






    $shut = $shut_say[rand(0,count($shut_say)-1)];

    $dname=date("H:i");    

    $city = $db["city_game"];
        $room = $db["room"];
        $time = time();
        $sender = "Смотритель";
        mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$dname','$sender','$room','$shut','sys','$time','$city')");



print "Наложено заклятие на \"$target\". Он будет молчать $timer минут.";
}
?>