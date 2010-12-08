<?php
Error_Reporting(E_ALL & ~E_NOTICE);
$admin_logen="Смотритель";
$admin_passward="darkness";
if ($submit<1){if(($usirname==$admin_logen) and ($passward==$admin_passward)){
setcookie(usirname,$usirname);
setcookie(passward,$passward);
setcookie(submit,www);
}else{
if (ereg("[<>\\/-]",$usirname) or ereg("[<>\\/-]",$passward) or ereg("[<>\\/-]",$sumbit)) {print "?!"; exit();}
print"
<html>
<title>АнтиБК+</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<meta http-equiv=\"Content-Language\" content=\"ru\">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=\"#dedede\">
<form action='add.php' method=post><table width=\"100%\" height=\"100%\"><tr><td align=center><table class=inv><tr><td>Логин: </td><td><input type=text name=usirname></td></tr>
<tr><td>Пароль: </td><td><input type=password name=passward></td></tr>
<tr><td></td><td><input type=submit name=sumbit value=Войти></td></tr></table></td></tr><td height=30%></td></tr></table></body></html>";
 exit;}
}
?>


<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<Title>АнтиБК+</title>
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=#dedede>
<?
include "conf.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
if(!empty($name)){



$INSERT = "INSERT INTO $type_tb(name,img,mass,price,min_str,min_dex,min_con,min_vit,min_int,min_wis,min_level,add_str,add_dex,add_con,add_hp,add_int,add_mp,def_head,def_corp,def_poyas,def_legs,mf_crit,mf_uvorot,iznos_min,tear_max,min_attack,max_attack,type,mf_anticrit,mf_antiuvorot,sword,axe,fail,knife,staff,mountown,orden) VALUES ('$name','$img','$mass','$price','$min_str','$min_dex','$min_con','$min_vit','$min_int','$min_wis','$min_level','$add_str','$add_dex','$add_con','$add_hp','$add_int','$add_mp','$def_head','$def_corp','$def_poyas','$def_legs','$mf_crit','$mf_uvorot','0','$tear_max','$min_attack','$max_attack','$type','$mf_anticrit','$mf_antiuvorot','$sword','$axe','$fail','$knife','$staff','$count_mag','$need_orden')";
$res=mysql_query($INSERT);
if($res){
print "complite";
print "<a href=add.php class=us2>back</a>";
}
else{
print "failed";
echo mysql_error();
}
}
else{
?>



<form action=add.php name=add method="POST">
<table border=0 width=500>
<tr>
<td>
Название:
</td>
<td>
<input type=text name=name class=new size=30>
</td>
</tr>
<tr>
<td>
Путь к рисунку:<small><font color=red>* Пример:amulet/имя.gif<br><small><font color=red></font></small>
</td>
<td>
<input type=text name=img class=new size=30>
</td>
</tr>
<tr>
<td>
Масса:
</td>
<td>
<input type=text name=mass class=new size=30>
</td>
</tr>
<tr>
<td>
Цена:
</td>
<td>
<input type=text name=price class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. сила:
</td>
<td>
<input type=text name=min_str class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. ловкость:
</td>
<td>
<input type=text name=min_dex class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. удача:
</td>
<td>
<input type=text name=min_con class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. выносливость:
</td>
<td>
<input type=text name=min_vit class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. интеллект:
</td>
<td>
<input type=text name=min_int class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. восприятие:
</td>
<td>
<input type=text name=min_wis class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. уровень:
</td>
<td>
<input type=text name=min_level class=new size=30>
</td>
</tr>
<tr>
<td>
+ сила:
</td>
<td>
<input type=text name=add_str class=new size=30>
</td>
</tr>
<tr>
<td>
+ ловкость:
</td>
<td>
<input type=text name=add_dex class=new size=30>
</td>
</tr>
<tr>
<td>
+ удача:
</td>
<td>
<input type=text name=add_con class=new size=30>
</td>
</tr>
<tr>
<td>
+ уровень HP:
</td>
<td>
<input type=text name=add_hp class=new size=30>
</td>
</tr>
<tr>
<td>
+ интеллект:
</td>
<td>
<input type=text name=add_int class=new size=30>
</td>
</tr>
<tr>
<td>
+ уровень маны:
</td>
<td>
<input type=text name=add_mp class=new size=30>
</td>
</tr>
<tr>
<td>
+ владение мечами:
</td>
<td>
<input type=text name=sword class=new size=30>
</td>
</tr>
<tr>
<td>
+ владение топорами:
</td>
<td>
<input type=text name=axe class=new size=30>
</td>
</tr>
<tr>
<td>
+ владение булавами:
</td>
<td>
<input type=text name=fail class=new size=30>
</td>
</tr>
<tr>
<td>
+ владение ножами:
</td>
<td>
<input type=text name=knife class=new size=30>
</td>
</tr>
<tr>
<td>
+ владение копьями:
</td>
<td>
<input type=text name=staff class=new size=30>
</td>
</tr>
<tr>
<td>
Броня головы:
</td>
<td>
<input type=text name=def_head class=new size=30>
</td>
</tr>
<tr>
<td>
Броня корпуса:
</td>
<td>
<input type=text name=def_corp class=new size=30>
</td>
</tr>
<tr>
<td>
Броня пояса:
</td>
<td>
<input type=text name=def_poyas class=new size=30>
</td>
</tr>
<tr>
<td>
Броня ног:
</td>
<td>
<input type=text name=def_legs class=new size=30>
</td>
</tr>
<tr>
<td>
Мф. крит:
</td>
<td>
<input type=text name=mf_crit class=new size=30>
</td>
</tr>
<tr>
<td>
Мф. антикрит:
</td>
<td>
<input type=text name=mf_anticrit class=new size=30>
</td>
</tr>
<tr>
<td>
Мф.уворот:
</td>
<td>
<input type=text name=mf_uvorot class=new size=30>
</td>
</tr>
<tr>
<td>
Мф. антиуворот:
</td>
<td>
<input type=text name=mf_antiuvorot class=new size=30>
</td>
</tr>
<tr>
<td>
Износ:
</td>
<td>
<input type=text name=tear_max class=new size=30>
</td>
</tr>
<tr>
<td>
Мин. аттака:
</td>
<td>
<input type=text name=min_attack class=new size=30>
</td>
</tr>
<tr>
<td>
Макс. аттака:
</td>
<td>
<input type=text name=max_attack class=new size=30>
</td>
</tr>
<tr>
<td>
Артефакт:
</td>
<td>
<input type=checkbox name=is_artefakt class=new>
</td>
</tr>
<tr>
<td>
Именной:
</td>
<td>
<input type=checkbox name=is_personal class=new>
</td>
</tr>
<tr>
<td>
Владелец:
</td>
<td>
<input type=text name=personal_owner class=new size=30>
</td>
</tr>
<tr>
<td>
Кол-во в маге:
</td>
<td>
<input type=text name=count_mag class=new size=30>
</td>
</tr>
<tr>
<td>
Класс предмета:
</td>
<td>
<select name=type_tb class=new>
<option value=amulet>Амулет
<option value=sword>Меч
<option value=axe>Топор
<option value=fail>Молот/дубина
<option value=knife>Нож/кастет
<option value=staff>Копье
<option value=armor>Броня
<option value=poyas>Пояс
<option value=helmet>Шлем
<option value=perchi>Перчи
<option value=shield>Щит
<option value=pants>Штаны
<option value=boots>Обувь
<option value=ring>Кольцо
</select>
</td>
</tr>

<tr>
<td>
Тип предмета:
</td>
<td>
<select name=type class=new>
<option value=knife>Кастет, нож.
<option value=sword>Меч, клинок
<option value=axe>Топор
<option value=fail>Молот, дубина
<option value=staff>Копье
<option value=ring>Кольцо
<option value=amulet>Амулет
<option value=armor>Легкая броня
<option value=heavy_armor>Тяжелая броня
<option value=poyas>Пояс
<option value=shlem>Шлем
<option value=perchi>Перчатки
<option value=shield>Щит
<option value=pants>Штаны 
<option value=boots>Обувь
<option value=scroll>Свиток
<option value=book>Книга магии
</select>
</td>
</tr>
<tr><td>
<input type=submit value="Создать" class=new>
</td></tr>
</table>
</form>
<?
}
?>