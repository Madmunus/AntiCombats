<?
if(empty($target)){
?>
<div align=right>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_t.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_t.gif'></td>
</table>
<table border=0 bgcolor=#cccccc cellpadding=0 cellspacing=0 width=300 height=60>
<tr><td align=left valign=top>
<form name='drink_e' action='main.php?act=orden&ord=20&spell=12' method='post'>
<small>
&nbsp&nbsp Вампиризм<BR>
&nbsp&nbsp Заклятие "Выпить энергию"<BR>
</small>
&nbsp&nbsp Укажите логин персонажа:<BR>
&nbsp&nbsp <input type=text name='target' class=new style="width=200">
<BR>
&nbsp&nbsp <input type=submit value=" Использовать магию " class=new  style="width=200">
</form>
</td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_b.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_b.gif'></td>
</table>
</div>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["admin_level"]>=10){


$S="select * from characters where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);


if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
          if($res["orden"] == 20){
     print "Это заклятие не действует на персонажа <B>$target</B>";
     die();
     }
          if($res["orden"] == 1){
     print "Это заклятие не действует на персонажа <B>$target</B>";
     die();
     }
     $hp_t = $res["hp_all"];
$min_dr_hp = floor($hp_t/100);
     if($res["hp"]<($res["hp_all"]/100)*95){
     print "Персонаж <B>$target</B> слишком ослаблен, чтобы применить к нему это заклинание.";
     print "Или же Персонаж <B>$target</B> слишком мальенкий и у него не может быть 95/95хп ";
     die();
     }
     $mine_hp_min = floor($db["hp_all"]/3);
     if($db["hp"]<$mine_hp_min){
     print "Вы слишком ослабленны, чтобы кастовать это заклинание.";
     die();
     }
          if($db["hp"]>$mine_hp_min*2){
     print "Вы уже достаточно восстановленны.";
     die();
     }
          if($res["level"]>$db["level"]){
     print "Вы не можете кастовать это заклятие на персонажа, уровень которого выше Вашего.";
     die();
     }
     
     $drink_hp_p = rand(90,100);
$drink_hp = ($res["hp_all"]/100)*$drink_hp_p;
$tar_allhp = $res["hp_all"];
$tar_newhp = $res["hp"] - $drink_hp;
setHP($target,$tar_newhp,$tar_allhp);
$drink_hp_m = $drink_hp*(1 + $db["magic_vit"]/100);

$mine_allhp = $db["hp_all"];
$mine_newhp = $db["hp"]+$drink_hp_m;
setHP($login,$mine_newhp,$mine_allhp);

$mine_allmp = $db["mp_all"];
$mine_newmp = $db["mp"] - 0;
setMN($login,$mine_newmp,$mine_allmp);


$pref=$db["sex"];
if($pref=="female"){
$prefix="а";
}
else{
$prefix="";
}

if($db["orden"]==20){$opr="Тьма";}
else {$opr="Персонаж";}
if ($db["orden"]==1){$opr="Паладин";}
     $city = $db["city_game"];
        $time = time();
        $room = $db["room"];
        $d=date("d.m.y H:i");

$masseg= "private [$login] <font color=black>Внимание! вы выпили часть энергии у  &quot$target&quot.</font>";
                mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','Система','$room','$masseg','us','$time','$city')");
$masseg= "private [$target] <font color=black>Внимание! На вас напал$prefix вампир и выпел$prefix часть энергии.</font>";
                mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','Система','$room','$masseg','us','$time','$city')");
          
          


print "Заклятие прокастовано удачно.";
}
?>