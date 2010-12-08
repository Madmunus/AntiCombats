<?
if(empty($target)){
?>
<div align=right>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_t.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_t.gif'></td>
</table>
<table border=0 bgcolor=#cccccc cellpadding=0 cellspacing=0 width=300 height=60>
<tr><td align=left valign=top>
<form name='cure_hp' action='?act=magic&school=air&scroll=<?echo $scroll?>' method='post'>
<small>
&nbsp&nbspСитхия воздуха<BR>
&nbsp&nbspЗаклятие "Восстановить здоровье/25"<BR>
</small>
&nbsp&nbspУкажите логин персонажа:<BR>
&nbsp&nbsp<input type=text name='target' class=new style="width=200">
<BR>
&nbsp&nbsp<input type=submit value=" Использовать магию " class=new  style="width=200">
</form>
</td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_b.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_b.gif'></td>
</table>
</div>
<?
}
else {
$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
$on1 = 0;
	$sss = mysql_query("SELECT * FROM online");
	while($D = mysql_fetch_array($sss)){
		if($D["login"] == $target){
		$on1 = 1;
		}
	}
	if(!$res){
	print "Персонаж <B>$target</B> не найден в базе данных.";
	die();
	}
	if($on1 == 0){
	print "Персонаж <B>$target</B> сейчас офф-лайн.";
	die();
	}
	$hp_now = $res["hp"];
	$hp_all = $res["hp_all"];
	$hp_add = 25;
		if($hp_all - $hp_now<25){
		$hp_add = $hp_all - $hp_now;
		}
	$hp_new = $hp_now + $hp_add;
	$mana_new = $db["mana"] - 5;
	$mana_all = $db["mana_all"];
	setHP($target,$hp_new,$hp_all);
	setMN($login,$mana_new,$mana_all);
	if($login == $target){
		if($db["battle"]==0){
		say($login,"Внимание!!! Вы удачно прокастовали заклинание &quotВосстановить здоровье/25&quot и восстановили свое здоровье на $hp_add пунктов",$login);
		}
		else{
		$battle_id = $db["battle"];
		$chas = date("H");
		$date = date("H:i", mktime($chas-$GSM));
		if($db["battle_team"]==1){$span = "p1";}else{$span = "p2";}
		$phrase = "<span class=date>$date</span> <span class=$span>$login</span> Восстановил свое здоровье на <span class=hitted>$hp_add</span> пунктов!<BR>";

		$ALL_UPDATE = mysql_query("UPDATE users SET battle_opponent='' WHERE login='$login'");
		$t = time();
		$U_T = mysql_query("UPDATE timeout SET lasthit='$t' WHERE battle_id='$battle_id'");
		$td = fopen("logs/$battle_id.dis","a");
		fputs($td,$phrase);
		fclose($td);
		}
	}
	else{
		if($db["battle"]==0){
		say($login,"Вниание!!! Вы удачно прокастовали заклинание &quotВосстановить здоровье/25&quot на персонажа &quot$target&quot",$login);
		say($target,"Внимание!!! &quot$login&quot восстановил Ваше здоровье на $hp_add пунктов!",$target);
		}
		else{
		$battle_id = $db["battle"];
		$chas = date("H");
		$date = date("H:i", mktime($chas-$GSM));
		if($db["battle_team"]==1){$span = "p1";$span2 = "p2";}else{$span = "p2";$span2 = "p1";}
		$phrase = "<span class=date2>$date</span> <span class=$span>$login</span> Восстановил здоровье <span class=$span2>$target</span> на <span class=hitted>$hp_add</span> пунктов!<BR>";

		$ALL_UPDATE = mysql_query("UPDATE users SET battle_opponent='' WHERE login='$login'");
		$t = time();
		$U_T = mysql_query("UPDATE timeout SET lasthit='$t' WHERE battle_id='$battle_id'");
		$td = fopen("logs/$battle_id.dis","a");
		fputs($td,$phrase);
		fclose($td);
		}
	}
	$SQL = mysql_query("UPDATE users SET cast = cast+0.5,air_magic=air_magic+0.5 WHERE login='$login'");
	$S = mysql_query("UPDATE inv SET iznos = iznos+1 WHERE id=$scroll");
	$S_INV = mysql_query("SELECT * FROM inv WHERE id = $scroll");
	$DATA = mysql_fetch_array($S_INV);
	$iznos = $DATA["iznos"];
	$iznos_max = $DATA["iznos_max"];
	$iznos_k = $iznos+1;
		if($iznos_k>=$iznos_max){
		$S_D = mysql_query("DELETE FROM inv WHERE id = $scroll");
		}
	print "Прокастованно удачно!<BR>";
	print "<a href='main.php?act=inv&section=thing' class=us2>вернуться</a>";
}
?>