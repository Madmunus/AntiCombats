<?
if(empty($target)){$target="";}
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$give_zl) or ereg("[<>\\/-]",$target) or ereg("[<>\\/-]",$to) or ereg("[<>\\/-]",$item_id) or ereg("[<>\\/-]",$item) or ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$target=htmlspecialchars($target);
$give_zl=htmlspecialchars($give_zl);
$to=htmlspecialchars($to);
$item_id=htmlspecialchars($item_id);
$item=htmlspecialchars($item);
$log=htmlspecialchars($log);
$SEARCHING = mysql_query("SELECT * FROM characters WHERE login = '$login'");
$RESULTAT = mysql_fetch_array($SEARCHING);
if ($RESULTAT["orden"]!=4){
if ($RESULTAT["level"]<4){print "Вы еще не достигли требуемого уровня."; die();}
}
if(empty($target)){
?><br><p align=right><input type=button value="Вернуться" class=nav onclick="javascript:location.href='main.php?act=none'"></p>
<div align=center><Br><br><bR><table border="0" cellspacing="0" cellpadding="0" width="300">
        <tr>
          <td width="10" height="5"><img border="0" src="img/cor_l_t.gif" width="10" height="10"></td>
          <td height="10" bgcolor="#CCCCCC" rowspan="2" valign="middle" colspan="2">&nbsp</td>
          <td width="10" height="5"><img border="0" src="img/cor_r_t.gif" width="10" height="10"></td>
        </tr>
        <tr>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
</table>
<table border=0 width=300 height=120 bgcolor=#cccccc>
<tr>
<td width=5>&nbsp</td>
<td align=left valign=top>
<form name='perevod' action='main.php?act=perevod' method='post'>
Укажите логин персонажа, которому Вы хотите перевести деньги/предметы. Указаный Вами персонаж должен быть не ниже 4-го уровня, быть он-лайн и находиться в Вашей комнате.<BR>
<input type=text name='target' class=new size=25>
<input type=submit value="  OK  " class=new>
</form>
</td></tr>
</table>
<table border=0 width=300 cellpadding=0 cellspacing=0>
<tr>
<td width=10><img src='img/cor_l_b.gif'></td>
<td bgcolor=#cccccc><img src='img/10_10.gif'></td>
<td width=10><img src='img/cor_r_b.gif'></td>
</tr>
</table>
</table>

<?
}
else{
$user_sql="SELECT * FROM characters WHERE login='$login'";
$user_q=mysql_query($user_sql);
$user_dat=mysql_fetch_array($user_q);
$money1=$user_dat["money"];
$money = sprintf ("%01.2f", $money1);

$target_sql="SELECT * FROM characters WHERE login='$target'";
$target_q=mysql_query($target_sql);
$target_dat=mysql_fetch_array($target_q);
$orden_d=$target_dat["orden"];
$rang=$target_dat["rang"];
$clan_s=$target_dat["clan_short"];
$city=$target_dat["city_game"];
$is_online = 0;


	if($orden_d==1){$orden_dis="Белое братство";}
	else if($orden_d==2){$orden_dis="Темное братство";}
	else if($orden_d==3){$orden_dis="Нейтральное братство";}
	else if($orden_d==4){$orden_dis="Алхимик";}
	else if($orden_d==5){$orden_dis="Тюремный заключеный.";}
	if(empty($clan_s)){$clan="";}
	else{$clan="<img src='img/clan/$clan_s.gif' border=0 alt='$clan_f'>";}
	if(empty($orden_d)){$orden="";}
	else{
if ($orden_d==1) {$orden="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}}


$SEARCH = mysql_query("SELECT * FROM online WHERE login = '$login'");

	if(mysql_fetch_array($SEARCH)){$is_online = 1;}

if(!$target_dat){
print "Ошибка!!! Персонаж \"$target\" не найден в базе данных!<Br><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\">";
die();
}
if($user_dat["orden"]!=4 && $user_dat["login"]=='Мироздатель' && $user_dat["login"]=='Смотритель' && $user_dat["login"]=='ПАЛАЧ'){
if($target_dat["level"]<4){
print "Ошибка!!! Персонаж \"$target\" ниже 4-го уровня!<br><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\">";
die();
}}
if($is_online==0){
print "Персонаж &quot<B>$target</B>&quot сейчас офф-лайн.<br><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\">";
die();
}
else if($user_dat["city_game"]!=$target_dat["city_game"]){
print "Ошибка!!! Персонаж \"$target\" находится в другом городе!<br><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\">";
die();
}
else if($user_dat["room"]!=$target_dat["room"]){
print "Ошибка!!! Персонаж \"$target\" находится в другой комнате!<br><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\">";
die();
}
else if($target==$login){
print "Очень щедро передавать что-то самому себе ;-)<br><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\">";
}
else{
?><br><p align=right><input type=button value="Вернуться" class=nav onclick="javascript:location.href='main.php?act=none'"></p>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<td width=6%></td><td align=left width=230 valign=top>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="10" height="5"><img border="0" src="img/cor_l_t.gif" width="10" height="10"></td>
          <td height="10" bgcolor="#CCCCCC" rowspan="2" valign="middle" colspan="2">
<?
$t_level=$target_dat["level"];
$p = str_replace(" ","%20",$target);
print "<b>$orden$clan$target</b> [$t_level]<a href='info.php?log=$p' target=_new><img src='img/inf.gif' border=0 alt='Информация о персонаже $target'></a>";
?>
</td>
          <td width="10" height="5"><img border="0" src="img/cor_r_t.gif" width="10" height="10"></td>
        </tr>
        <tr>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
</table>

<table border=0 bgcolor=#cccccc width=230 height=60><tr><td align=center valign=top>
<?
if(empty($give_zl)){$give_zl="";}
if(!empty($give_zl)){
give_money($login,$target,$give_zl);
}
?>

<form name='give_money' action='main.php?act=perevod&target=<?echo $target?>' method='post'>
Передать деньги:<br>
<input type=text name='give_zl' class=new size=12>
<input type=submit value=" OK " class=new>
</form>
</td></tr></table>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<td width=10><img src='img/cor_l_b.gif'></td>
<td bgcolor=#cccccc><img src='img/10_10.gif'></td>
<td width=10><img src='img/cor_r_b.gif'></td>
</tr>
</table>
<? 
$user_sql="SELECT * FROM characters WHERE login='$login'";
$user_q=mysql_query($user_sql);
$user_dat=mysql_fetch_array($user_q);
$money1=$user_dat["money"];
$money = sprintf ("%01.2f", $money1);?>
<br><Br><center><B>У вас в наличии:<FONT COLOR=339900> <?echo $money;?></font> кр.</B></center>
</td>
<td width=10%><img src='img/1_10.gif'></tD>
<td valign=top><table border=0 width=660 cellpadding=0 cellspacing=0>
<tr>
<td align=left width=100% valign=top>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td width="10" height="5"><img border="0" src="img/cor_l_t.gif" width="10" height="10"></td>
          <td height="10" bgcolor="#CCCCCC" rowspan="2" valign="middle" colspan="2">Выберете вещь из Вашего рюкзака, которую вы хотите подарить/передать персонажу "<b><?echo $target?></b>".</td>
          <td width="10" height="5"><img border="0" src="img/cor_r_t.gif" width="10" height="10"></td>
        </tr>
        <tr>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
</table>

<table border=0 bgcolor=#cccccc width=100% height=100><tr><TD valign=top>
<?


$total=0;
$result=mysql_query('SELECT * FROM inv WHERE object_razdel="obj" ORDER BY date DESC');
while($data = mysql_fetch_array($result)){

if($data["owner"]==$login && $data["wear"]==0){
$total++;
$item_id=$data["id"];
$obj_id=$data["object_id"];
$obj_type=$data["object_type"];
$obj_section=$data["object_razdel"];
$wear=$data["wear"];
$iznos=$data["iznos"];
$tear_max=$data["tear_max"];
$gift=$data["gift"];
$gift_author=$data["gift_author"];
$is_artefakt=$data["is_artefakt"];
$is_personal=$data["is_personal"];
$presonal_owner=$data["personal_owner"];
$is_aligned=$data["is_aligned"];
$q2="SELECT * FROM $obj_type WHERE id=$obj_id";
$r2=mysql_query($q2);
$dat=mysql_fetch_array($r2);
$name=$dat["name"];
$img=$dat["img"];
$mass=$dat["mass"];
$price=$dat["price"];
$min_s=$dat["min_str"];
$min_l=$dat["min_dex"];
$min_u=$dat["min_con"];
$min_p=$dat["min_vit"];
$min_i=$dat["min_int"];
$min_v=$dat["min_wis"];
$min_level=$dat["min_level"];
$add_s=$dat["add_str"];
$add_l=$dat["add_dex"];
$add_u=$dat["add_con"];
$add_hp=$dat["add_hp"];
$add_i=$dat["add_int"];
$add_mp=$dat["add_mp"];
$addsword=$dat["sword"];
$addaxe=$dat["axe"];
$addfail=$dat["fail"];
$addknife=$dat["knife"];
$addstaff=$dat["staff"];
$p_h=$dat["def_head"];
$p_c=$dat["def_corp"];
$p_p=$dat["def_poyas"];
$p_l=$dat["def_legs"];
$mf_crit=$dat["mf_crit"];
$mf_anticrit=$dat["mf_anticrit"];
$mf_uvorot=$dat["mf_uvorot"];
$mf_antiuvorot=$dat["mf_antiuvorot"];
$min_a=$dat["min_attack"];
$max_a=$dat["max_attack"];
$qq="SELECT * FROM characters WHERE login='$login'";
$res=mysql_query($qq);
$d=mysql_fetch_array($res);


print "<tr><td></td></tr><tr><td><hr color=#000000 noshade size=1 width=100% align=left><table><tr><td width=250>";
print "<center><img src='img/$img' border=0 alt='$name($iznos/$tear_max)'><BR>";
print "<a href='main.php?act=gift&item_id=$item_id&to=$target' class=nick>подарить</a><BR>";
print "<a href='main.php?act=give&item_id=$item_id&to=$target' class=nick>передать</a>";

print "</td><td valign=top>";
print "<font color=#003388><B>$name</b></font> (Масса: $mass)";
if($gift==1){
print "&nbsp&nbsp<img src='img/icon/gift.gif' width=14 height=14 border=0 alt='Подарок от $gift_author'>";
}
if($is_artefakt==1){
print "&nbsp&nbsp<img src='img/icon/artefakt.gif' width=16 height=16 border=0 alt='Артефактная вещь'>";
}
if($is_personal==1){
print "&nbsp&nbsp<img src='img/icon/personal.gif' width=16 height=16 border=0 alt='Именная артефактная вещь.\nПринадлежит $personal_owner'>";
}
if($is_aligned!=0){
print "&nbsp&nbsp<img src='img/icon/aligned.gif' width=16 height=16 border=0 alt='$align'>";
}
print "&nbsp&nbsp<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/del.gif' width=14 height=14 border=0 alt='Выбросить предмет $name'></a>";

print "<Br><B>Цена: $price кр.</b>";
print "<BR>Долговечность: $iznos/$tear_max";
print "<BR><B>Требуется минимальное:</b><BR>";
if($min_level>0){
if($min_level>$d["level"]){
$min_level="<font color=#D50000>$min_level</font>";
}
print "&bull; Уровень: $min_level<BR>";
}
if($min_s>0){
if($min_s>$d["str"]){
$min_s="<font color=#D50000>$min_s</font>";
}
print "&bull; Сила: $min_s<BR>";
}
if($min_l>0){
if($min_l>$d["dex"]){
$min_l="<font color=#D50000>$min_l</font>";
}
print "&bull; Ловкость: $min_l<BR>";
}
if($min_u>0){
if($min_u>$d["con"]){
$min_u="<font color=#D50000>$min_u</font>";
}
print "&bull; Интуиция: $min_u<BR>";
}
if($min_p>0){
if($min_p>$d["vit"]){
$min_p="<font color=#D50000>$min_p</font>";
}
print "&bull; Выносливость: $min_p<BR>";
}
if($min_i>0){
if($min_i>$d["int"]){
$min_i="<font color=#D50000>$min_i</font>";
}
print "&bull; Интеллект: $min_i<BR>";
}
if($min_v>0){
if($min_v>$d["wis"]){
$min_v="<font color=#D50000>$min_v</font>";
}
print "&bull; Мудрость: $min_v<BR>";
}
print "<b>Параметры:</b><BR>";
if($min_a>0 or $max_a>0){
print "&bull; Урон: $min_a - $max_a<BR>";
}
if($add_s>0){
print "&bull; Сила: +$add_s<BR>";
}
else if($add_s<0){
print "&bull; Сила: $add_s<BR>";
}
if($add_l>0){
print "&bull; Ловкость: +$add_l<BR>";
}
else if($add_l<0){
print "&bull; Ловкость: $add_l<BR>";
}
if($add_u>0){
print "&bull; Интуиция: +$add_u<BR>";
}
else if($add_u<0){
print "&bull; Интуиция: $add_u<BR>";
}
if($add_i>0){
print "&bull; Интеллект: +$add_i<BR>";
}
else if($add_i<0){
print "&bull; Интеллект: +$add_i<BR>";
}
if($add_hp>0){
print "&bull; Уровень жизни: +$add_hp<BR>";
}
else if($add_hp<0){
print "&bull; Уровень жизни: $add_hp<BR>";
}
if($add_mp>0){
print "&bull; Уровень маны: +$add_mp<BR>";
}
else if($add_mp<0){
print "&bull; Уровень маны: $add_mp<BR>";
}
if($addsword>0){
print "&bull; Владение мечами: +$addsword%<BR>";
}
if($addaxe>0){
print "&bull; Владение топорами: +$addaxe%<BR>";
}
if($addfail>0){
print "&bull; Владение дубинами: +$addfail%<BR>";
}
if($addknife>0){
print "&bull; Владение ножами: +$addknife%<BR>";
}
if($addstaff>0){
print "&bull; Владение копьями: +$addstaff%<BR>";
}
if($p_h>0){
print "&bull; Броня головы: $p_h<BR>";
}
if($p_c>0){
print "&bull; Броня корпуса: $p_c<BR>";
}
if($p_p>0){
print "&bull; Броня пояса: $p_p<BR>";
}
if($p_l>0){
print "&bull; Броня ног: $p_l<BR>";
}
if($mf_crit>0){
print "&bull; Мф. крит. удара: +$mf_crit<BR>";
}
else if($mf_crit<0){
print "&bull; Мф. крит. удара: $mf_crit<BR>";
}
if($mf_anticrit>0){
print "&bull; Мф. антикрит: +$mf_anticrit<BR>";
}
else if($mf_anticrit<0){
print "&bull; Мф. антикрит: $mf_anticrit<BR>";
}
if($mf_uvorot>0){
print "&bull; Мф. увертливости: +$mf_uvorot<BR>";
}
else if($mf_uvorot<0){
print "&bull; Мф. увертливости: $mf_uvorot<BR>";
}
if($mf_antiuvorot>0){
print "&bull; Мф. антиувертливости: +$mf_antiuvorot<BR>";
}
else if($mf_uvorot<0){
print "&bull; Мф. антиувертливости: $mf_antiuvorot<BR>";
}


print "</td></tr><tr><td></td></tr></td></tr></table>";
}



}

$S = mysql_query("SELECT * FROM inv WHERE object_razdel='thing' ORDER BY date DESC");
while($DAT = mysql_fetch_array($S)){
	if($DAT["owner"]==$login){

		if($DAT["object_type"]=="wood"){
		$obj_id = $DAT["object_id"];
		$obj_s = mysql_query("SELECT * FROM wood WHERE id=$obj_id");
		$obj_data = mysql_fetch_array($obj_s);
		$name = $obj_data["name"];
		$img = $obj_data["img"];
		$item_id = $DAT["id"];
		$mass = $obj_data["mass"];
		$price = $obj_data["price"];

		print "<table border=0 bgcolor=#cccccc width=100%>";
		print "<tr><td><hr color=#000000 width=100% size=1 align=left>Дерево&nbsp";
		print "<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/del.gif' width=14 height=14 border=0 alt='Выбросить предмет $name'></a>";
		print "</td></tr></table>";
		print "<table border=0 bgcolor=#cccccc width=100%><tr><td width=75><img src='img/$img' alt='$name'><BR>";
		print "<a href='main.php?act=gift&item_id=$item_id&to=$target' class=us2>подарить</a><BR>";
		print "<a href='main.php?act=give&item_id=$item_id&to=$target' class=us2>передать</a>";
		print "</td><td valign=top>";
		print "Цена: $price зл.<BR>";
		print "Масса: $mass ед.<BR>";
		print "Ресурс: $name<BR>";
		print "</td></tr>";
		print "<tr><td align=center>";
		
		print "</td><td>&nbsp</td></tr>";
		print"</table>";
		}


		if($DAT["object_type"]=="book"){
		$obj_id = $DAT["object_id"];
		$obj_s = mysql_query("SELECT * FROM book WHERE id=$obj_id");
		$obj_data = mysql_fetch_array($obj_s);
		$name = $obj_data["name"];
		$img = $obj_data["img"];
		$min_i = $obj_data["min_int"];
		$min_v = $obj_data["min_wis"];
		$min_level = $obj_data["min_level"];
		$add_i = $obj_data["add_int"];
		$add_mp = $obj_data["add_mp"];
		$add_water = $obj_data["add_water"];
		$add_earth = $obj_data["add_earth"];
		$add_fire = $obj_data["add_fire"];
		$add_air = $obj_data["add_fire"];
		$item_id = $DAT["id"];
		$pages = $obj_data["pages"];
		$pages_used = $DAT["pages_used"];
		$gift_author = $DAT["gift_author"];
		$book_name = $DAT["book_name"];
		$iznos = $DAT["iznos"];
		$iznos_all = $DAT["tear_max"];
		if(empty($book_name)){$book_name = "Без названия.";}

		print "<table border=0 bgcolor=#cccccc width=100%>";
		print "<tr><td><hr color=#000000 width=100% size=1 align=left>$name";
		print "<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/del.gif' width=14 height=14 border=0 alt='Выбросить предмет $name'></a>";
		print "</td></tr></table>";
		print "<table border=0 bgcolor=#cccccc width=100%><tr><td width=75><img src='img/$img' alt='$name\n$book_name'><BR>";
		print "<a href='main.php?act=gift&item_id=$item_id&to=$target' class=us2>подарить</a><BR>";
		print "<a href='main.php?act=give&item_id=$item_id&to=$target' class=us2>передать</a>";
		print "</td><td valign=top>";
		print "Заглавие: $book_name<BR>";
		print "Использований: $iznos/$iznos_all<BR>";
		if(!empty($add_i)){
		print "Разум: <font color=#00990>+$add_i</font><BR>";
		}
		if(!empty($add_mp)){
		print "Уровень маны: +$add_mp<BR>";
		}
		if($add_water>0){
		print "Магия воды: +$add_water<BR>";
		}
		if($add_earth>0){
		print "Магия земли: +$add_earth<BR>";
		}
		if($add_fire>0){
		print "Магия огня: +$add_fire<BR>";
		}
		if($add_air>0){
		print "Магия воздуха: +$add_air<BR>";
		}
		print "Страниц: <font color=#000099>$pages_used/$pages</font><BR>";
		print "</td></tr>";
		print "<tr><td align=center>";
		
		print "</td><td>&nbsp</td></tr>";
		print"</table>";
		}
		if($DAT["object_type"]=="scroll"){
		$obj_id = $DAT["object_id"];
		$obj_s = mysql_query("SELECT * FROM scroll WHERE id=$obj_id");
		$obj_data = mysql_fetch_array($obj_s);
		$name = $obj_data["name"];
		$img = $obj_data["img"];
		$min_i = $obj_data["min_int"];
		$min_v = $obj_data["min_wis"];
		$min_level = $obj_data["min_level"];
		$item_id = $DAT["id"];
		$desc = $obj_data["desc"];
		$gift_author = $DAT["gift_author"];
		$iznos = $DAT["iznos"];
		$iznos_all = $DAT["tear_max"];
		$type = $obj_data["type"];
		$mp = $obj_data["mp"];
                $Sa = mysql_query("SELECT * FROM scroll ORDER BY id DESC");
                $dats = mysql_fetch_array($Sa);
		$massa = $dats["mass"];

		print "<table border=0 bgcolor=#cccccc width=100%>";
		print "<tr><td><hr color=#000000 width=100% size=1 align=left>";
		print "</td></tr></table>";
		print "<table border=0 bgcolor=#cccccc width=100%><tr><td width=250><center><img src='img/$img' alt='$name'><BR>";
		print "<a href='main.php?act=gift&item_id=$item_id&to=$target' class=nick>подарить</a><BR>";
		print "<a href='main.php?act=give&item_id=$item_id&to=$target' class=nick>передать</a>";
		print "</td><td valign=top>";
		print "<font color=#003388><B>$name</b></font>&nbsp(Масса: $massa)<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/del.gif' width=14 height=14 border=0 alt='Выбросить предмет $name'></a><br>";
		print "Долговечность: $iznos/$iznos_all<BR>";
		print "<B>Требуется минимальное:</b><BR>";
		if($min_level>$db["level"]){
		print "&bull; Уровень: <font color=#D50000>$min_level</font><BR>";
		}
		if($min_level<=$db["level"]){
		print "&bull; Уровень: $min_level<BR>";
		}
		if(!empty($min_i) && $min_i>$db["int"]){
		print "&bull; Интеллект: <font color=#D50000>$min_i</font><BR>";
		}
		else if(!empty($min_i) && $min_i<=$db["int"]){
		print "&bull; Интеллект: $min_i<BR>";
		}
		if(!empty($min_v) && $min_v>$db["wis"]){
		print "&bull; Мудрость: <font color=#D50000>$min_v</font><BR>";
		}
		if(!empty($min_v) && $min_v<=$db["wis"]){
		print "&bull; Мудрость: $min_v<BR>";
		}
		if($mp<=$db["mp"]){
		print "&bull; Исп. маны: $mp<BR>";
		}
		if($mp>$db["mp"]){
		print "&bull; Исп. маны: <font color=#D50000>$mp</font><BR>";
		}
		print "<b>Параметры:</b><BR>";
		print "$desc<BR>";
		print "</td></tr>";
		print "<tr><td align=center>";
		
		print "</td><td>&nbsp</td></tr>";
		print"</table>";
		}
	}

}
if($total==0){
print "<center><Br><br>У вас нет вешей в рюкзаке.</center>";
}

?>
</td></tr></table>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<td width=10><img src='img/cor_l_b.gif'></td>
<td bgcolor=#cccccc><img src='img/10_10.gif'></td>
<td width=10><img src='img/cor_r_b.gif'></td>
</tr>
</table><br>
</td>
</tr>
</table>

<?
}

}
?>