<?
session_start();
if(empty($login)){
print "<script>top.location.href='index.php';</script>";
}

?>
<title>АнтиБК+ - администраторская.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=#dedede>
<p align=right><input type=button value="Вернуться" class=nav onclick="javascript:location.href='main.php?act=none'">&nbsp;&nbsp;&nbsp;&nbsp;</p>

<?
include "conf.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
if (ereg("[<>]",$act) or ereg("[<>]",$do) or ereg("[<>]",$target)) {print"Недопустимые символы"; die();}

if($act=="save"){

if($do){
mysql_query("delete from characters where login='$target'");
print "<font color=red>Персонаж удален!</font>";
print "<br><a href='adm.php' class=nick>Назад</a> ";
die();
}

$n_S="select * from characters where login='$target'";
$n_q=mysql_query($n_S);
$n_row=mysql_fetch_array($n_q);
$n_login=$n_row[login];
$n_name=$n_row[name];
$n_sex=$n_row[sex];
$n_level=$n_row[level];
$n_str=$n_row[str];
$n_dex=$n_row[dex];
$n_con=$n_row[con];
$n_vit=$n_row[vit];
$n_int=$n_row[int];
$n_wis=$n_row[wis];
$n_money=$n_row[money];
$n_obraz=$n_row[obraz];
$n_status=$n_row[status];
$n_town=$n_row[town];
$n_mail=$n_row[mail];
$n_exp=$n_row[exp];
$n_next_up=$n_row[next_up];
$n_win=$n_row[win];
$n_lose=$n_row[lose];
$n_birthday=$n_row[birthday];
$n_date=$n_row[date];
$n_icq=$n_row[icq];
$n_ups=$n_row[ups];
$n_hp=$n_row[hp];
$n_hp_all=$n_row[hp_all];
$n_mp=$n_row[mp];
$n_mp_all=$n_row[mp_all];
$n_login_sec=$n_row[login_sec];
$n_mass=$n_row[mass];
$n_room=$n_row[room];
$n_maxmass=$n_row[maxmass];

if(empty($money)){$money=$n_money;}
if(empty($login_sec)){$login_sec=$n_login_sec;}
if(empty($icon)){$icon=$n_obraz;}
if($n_login_sec!=$login_sec){$v_login_sec="Логин в чате изменен с <b>$n_login_sec</b> на <b>$login_sec</b>.<br>";}
if($n_name!=$name){$v_name="Имя изменено с <b>$n_name</b> на <b>$name</b>.<br>";}
if($n_sex!=$sex){$v_sex="Пол изменен с <b>$n_sex</b> на <b>$sex</b>.<br>";}
if($n_level!=$level){$v_level="Уровень изменен с <b>$n_level</b> на <b>$level</b>.<br>";}
if($n_str!=$u){$v_str="Сила изменена с <b>$n_str</b> на <b>$u</b>.<br>";}
if($n_dex!=$g){$v_dex="Ловкость изменена с <b>$n_dex</b> на <b>$g</b>.<br>";}
if($n_con!=$l){$v_con="Интуиция изменена с <b>$n_con</b> на <b>$l</b>.<br>";}
if($n_vit!=$z){$v_vit="Выносливость изменена с <b>$n_vit</b> на <b>$z</b>.<br>";}
if($n_int!=$int){$v_int="Интеллект изменен с <b>$n_int</b> на <b>$int</b>.<br>";}
if($n_wis!=$wis){$v_wis="Мудрость изменена с <b>$n_wis</b> на <b>$wis</b>.<br>";}
if($n_money!=$money){$v_money="Деньги изменены с <b>$n_money</b> на <b>$money</b>.<br>";}
if($n_obraz!=$icon){$v_obraz="Образ изменен с <b>$n_obraz</b> на <b>$icon</b>.<br>";}
if($n_status!=$status){$v_status="Статус изменен с <b>$n_status</b> на <b>$status</b>.<br>";}
if($n_town!=$city){$v_town="Город изменен с <b>$n_town</b> на <b>$city</b>.<br>";}
if($n_mail!=$email){$v_mail="Email изменен с <b>$n_mail</b> на <b>$email</b>.<br>";}
if($n_exp!=$exp){$v_exp="Опыт изменен с <b>$n_exp</b> на <b>$exp</b>.<br>";}
if($n_next_up!=$num_up){$v_next_up="Следующий ап изменен с <b>$n_next_up</b> на <b>$num_up</b>.<br>";}
if($n_win!=$victory){$v_win="Победы изменены с <b>$n_win</b> на <b>$victory</b>.<br>";}
if($n_lose!=$lose){$v_lose="Поражения изменены с <b>$n_lose</b> на <b>$lose</b>.<br>";}
if($n_birthday!=$birthday){$v_birthday="День рождения изменен с <b>$n_birthday</b> на <b>$birthday</b>.<br>";}
if($n_date!=$date){$v_date="Дата рождения изменена с <b>$n_date</b> на <b>$date</b>.<br>";}
if($n_icq!=$icq){$v_icq="icq изменен с <b>$n_icq</b> на <b>$icq</b>.<br>";}
if($n_ups!=$ups){$v_ups="Кол-во свободных статов изменено с <b>$n_ups</b> на <b>$ups</b>.<br>";}
if($n_hp!=$hp){$v_hp="HP изменено с <b>$n_hp</b> на <b>$hp</b>.<br>";}
if($n_hp_all!=$maxhp){$v_hp_all="maxHP изменено с <b>$n_hp_all</b> на <b>$maxhp</b>.<br>";}
if($n_mp!=$mp){$v_mp="Мана изменена с <b>$n_mp</b> на <b>$mp</b>.<br>";}
if($n_mp_all!=$mp_all){$v_mp_all="maxМана изменена с <b>$n_mp_all</b> на <b>$mp_all</b>.<br>";}
if($n_mass!=$mass){$v_mass="масса рюкзака изменена с <b>$n_mass</b> на <b>$mass</b>.<br>";}
if($n_room!=$room){$v_room="перемешон с <b>$room</b> в <b>$room</b><br>";}
if($n_maxmass!=$maxmass){$v_maxmass="max масса рюкзака изменена с <b>$n_maxmass</b> на <b>$maxmass</b>.<br>";}
$msg="$v_login$v_name$v_sex$v_level$v_str$v_dex$v_con$v_vit$v_int$v_wis$v_money$v_obraz$v_status$v_town$v_mail$v_exp$v_next_up$v_win$v_lose$v_birthday$v_date$v_icq$v_ups$v_hp$v_hp_all$v_mp$v_mp_all$v_login_sec$v_maxmass$v_mass$v_room";
$date_time=date("d.m.y H:i:s");
if(!empty($msg) && $db["login"]!='Мироздатель'){
$v_SQL="INSERT INTO protocol_adm (date_time,login,target,msg) VALUES ('$date_time','$login','$target','$msg')";
$lpp = mysql_query($v_SQL);
}
if($align==3 or $align==4){$admin_level=0;}
if($align==4){$dealer=3;}
if($db["login"]=='Мироздатель') {$SQL="update characters set login='$login_player',name='$name',sex='$sex',level='$level',str='$u',dex='$g',con='$l',vit='$z',
int='$int',wis='$wis',money='$money',obraz='$icon',status='$status',town='$city',mail='$email',
exp='$exp',next_up='$num_up',win='$victory',lose='$lose',birthday='$birthday',date='$date',icq='$icq',ups='$ups',hp='$hp',
hp_all='$maxhp',mp='$mp',mp_all='$mp_all',login_sec='$login_sec',orden='$align',admin_level='$admin_level',dealer='$dealer',mass='$mass',room='$room',maxmass='$maxmass' where login='$target'";}

else {$SQL="update characters set name='$name',sex='$sex',level='$level',str='$u',dex='$g',con='$l',vit='$z',
int='$int',wis='$wis',money='$money',obraz='$icon',status='$status',town='$city',mail='$email',
exp='$exp',next_up='$num_up',win='$victory',lose='$lose',birthday='$birthday',date='$date',icq='$icq',ups='$ups',hp='$hp',
hp_all='$maxhp',mp='$mp',mp_all='$mp_all',login_sec='$login_sec',mass='$mass',room='$room',maxmass='$maxmass' where login='$target'";}

$q=mysql_query($SQL);
if($q){
print "Персонаж <b>$target</b> [$level]<a href=info.php?log=$target target=_blank><img border=0 src=img/inf.gif alt='Информация о $target'></A> удачно сохранен!";
print "<br><a href='adm.php' class=nick>Назад</a> "; die();
}
else {
print "Ошибка сохранения!"; die();
}
}


if(empty($target)){
?>
<table height=100% width=100%><tr><td align=center>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='adm.php' method='post'>
Укажите логин персонажа:<BR><br>
<center><input type=text name='target' class=new size=20>
<BR>
<BR>
<input type=submit value=" Редактировать " class=new>
</form>
</td></tr>
</table>
</td></tr><td height=50%></td></tr></table>
<?
}
else if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){

$S="select * from characters where login='$target'";
$q=mysql_query($S);
$row=mysql_fetch_array($q);
if(!$row){
print "Персонаж <B>$target</B> не найден в базе данных.";
print "<br><a href='adm.php' class=nick>Назад</a> ";
die();
}
if ($db["login"]!='Мироздатель'){
if($target=='Мироздатель'){
print "Редактирование богов запрещено высшей силой!";
print "<br><a href='adm.php' class=nick>Назад</a> ";
die();
}}

echo"

<script>
function del(){
if(confirm('Вы уверены, что хотите удалить этого персонажа?')){top.location.href='?do=1&act=save&target=$target'};
}
</script>
<center><table border=5><td><form action=?act=save&target=$target method=post>
<table border=0>
<tr><td>id персонажа:</td><td>$row[id] <a href=/info.php?log=$row[login] class=nick target=_blank><small><u>смотреть информацию</u></small></a></td></tr>";
if($db["login"]=='Мироздатель'){
echo"<tr><td>логин:</td><td><input type=text size=30 maxlength=15 name=login_player value='$row[login]'></td></tr>";}
else {echo"<tr><td>логин:</td><td><b>$row[login]</b></td></tr>";}
if($db["login"]=='Мироздатель' or $target=='Смотритель' or $target=='ПАЛАЧ'){
echo"<tr><td>логин в чате:</td><td><input type=text size=30 maxlength=15 name=login_sec value='$row[login_sec]'></td></tr>";}
echo"<tr><td>имя:</td><td><input type=text size=30 name=name value='$row[name]'></td></tr>
<tr><td>пол:</td><td><input type=radio name=sex value='male' "; if($row["sex"]=="male") {echo"checked";} echo" > <small>Мужской</small> <input type=radio name=sex value='female' "; if($row["sex"]=="female") {echo"checked";} echo" > <small>Женский</small></td></tr>
<tr><td>уровень:</td><td><input type=text size=8 name=level value='$row[level]'></td></tr>
<tr><td>сила:</td><td><input type=text size=8 name=u value='$row[str]'></td></tr>
<tr><td>ловкость:</td><td><input type=text size=8 name=g value='$row[dex]'></td></tr>
<tr><td>интуиция:</td><td><input type=text size=8 name=l value='$row[con]'></td></tr>
<tr><td>выносливость:</td><td><input type=text size=8 name=z value='$row[vit]'></td></tr>
<tr><td>интеллект:</td><td><input type=text size=8 name=int value='$row[int]'></td></tr>
<tr><td>мудрость:</td><td><input type=text size=8 name=wis value='$row[wis]'></td></tr>
<tr><td>деньги (кр.):</td><td><input type=text size=8 name=money value='$row[money]'></td></tr>";
if($db["login"]=='Мироздатель' or $target=='Смотритель'){
echo"<tr><td>образ</td><td><input type=text size=20 name=icon value='$row[obraz]'><small> Название рисунка в папке \"obraz\".</small></td></tr>";}
echo"<tr><td>статус:</td><td><input type=text size=40 name=status value='$row[status]'></td></tr>
<tr><td>город:</td><td><input type=text size=40 name=city value='$row[town]'></td></tr>
<tr><td>e-mail:</td><td><input type=text size=40 name=email value='$row[mail]'></td></tr>
<tr><td>опыт</td><td><input type=text size=20 name=exp value='$row[exp]'></td></tr>
<tr><td>следующий ап:</td><td><input type=text size=20 name='num_up' value='$row[next_up]'></td></tr>
<tr><td>побед:</td><td><input type=text size=8 name=victory value='$row[win]'></td></tr>
<tr><td>поражений:</td><td><input type=text size=8 name=lose value='$row[lose]'></td></tr>
<tr><td>день Рождения: </td><td><input type=text size=20 name=birthday value='$row[birthday]'></td></tr>
<tr><td>дата регистрации: </td><td><input type=text size=20 name=date value='$row[date]'></td></tr>
<tr><td>icq uin #</td><td><input type=text size=20 name=icq value='$row[icq]'></td></tr>
<tr><td>свободных статов:</td><td><input type=text size=8 name=ups value='$row[ups]'></td></tr>
<tr><td>hp:</td><td><input type=text size=8 name=hp value='$row[hp]'></td></tr>
<tr><td>maxhp:</td><td><input type=text size=8 name=maxhp value='$row[hp_all]'></td></tr>
<tr><td>мана:</td><td><input type=text size=8 name=mp value='$row[mp]'></td></tr>
<tr><td>max мана:</td><td><input type=text size=8 name=mp_all value='$row[mp_all]'></td></tr>
<tr><td>масса рюкзака:</td><td><input type=text size=8 name=mass value='$row[mass]'></td></tr>
<tr><td>max масса рюкзака:</td><td><input type=text size=8 name=maxmass value='$row[maxmass]'></td></tr>
<tr><td>место:</td><td><input type=text size=8 name=room value='$row[room]'></td></tr>";
if($db["login"]=='Мироздатель'){
echo"<tr><td>уровень доступа:</td><td><input type=text size=8 name=admin_level value='$row[admin_level]'></td></tr>
<tr><td>склонность:</td><td><select class=new name=align>
<option "; if($row["orden"]==0 or $row["orden"]==1 or $row["orden"]==2) {echo"selected";} echo" value=";if($row["orden"]==0 or $row["orden"]==3 or $row["orden"]==4){print"0";}if($row["orden"]==1){print"1";}if($row["orden"]==20){print"2";}echo">-------
<option "; if($row["orden"]==3) {echo"selected";} echo" value=3>Нейтрал
<option "; if($row["orden"]==4) {echo"selected";} echo" value=4>Алхимик
<option "; if($row["orden"]==20) {echo"selected";} echo" value=20>Тьма
</select>";}
echo"<tr><td><input type=submit value='Сохранить данные'></td><td></form><input type=submit onclick=\"del();\" value='Удалить персонажа'></td></tr></table></td></table>";
}}
else {
print "<script>top.location.href='index.php';</script>";
}?>