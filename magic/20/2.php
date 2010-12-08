<?
/*-= Школа Некромантов II. Нанести вред =-*/

if(empty($target)){
?>
<div align=center>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_t.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_t.gif'></td>
</table>
<table border=0 bgcolor=#cccccc cellpadding=0 cellspacing=0 width=300 height=60>
<tr><td align=left valign=top>
<form name='drink_e' action='battle.php?act=magic&ord=necromant&spell=2' method='post'>
<small>
&nbsp&nbspШкола Некромантов II<BR>
&nbsp&nbspЗаклятие "нанести вред"<BR>
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
else if($db["orden"]==2 AND $db["battle"]!=0){
$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);

	$city_game=$db["city_game"];
	$data="$city_game/online.dat";
        $readdata=fopen($data,"r") or die("Не могу открыть файл $data");
        $data_array=file($data);
        fclose($readdata);
        $online=count($data_array);
	$on1=0;
        for($k=0;$k<$online;$k++){
	$bas=explode("|",$data_array[$k]);
	if($res["login"]==$bas[0]){$on1=1;}
        }

	if(!$res){
	print "Персонаж <B>$target</B> не найден в базе данных.";
	die();
	}
	if($res["battle"] != $db["battle"]){
	print "Персонаж <B>$target</B> не находиться в Вашем бою!";
	die();
	}
	if($res["level"]>$db["level"]){
	print "Вы не можете кастовать это заклятие на персонажа, уровень которого выше Вашего.";
	die();
	}
	if($login == $target){
	print "Вы не можете кастовать это заклятие на самого себя.";
	die();
	}

	if($db["battle_team"] == 1){
	$span1 = "p1";
	$span2 = "p2";
	}
	else{
	$span1 = "p2";
	$span2 = "p1";	
	}

	$hp_proc = $res["hp_all"]/100;
	$proc = rand(5,10);
	$hit_k = floor($hp_proc*$proc*(1 + $db["magic_vit"]/100));

	$date = date("H:i");
	$hp_all = $res["hp_all"];
	$hp_now = $res["hp"];
	$hp_new = $hp_now - $hit_k;

	$battle_id = $db["battle"];

	if($res["sex"]=="male"){$p="";}
	else{$p="а";}
	
	if($db["sex"]=="male"){$pref="";}
	else{$pref="а";}

	if($hit_k >= $hp_now){
		$hp_new = 0;
		$S = mysql_query("SELECT sex FROM users WHERE login='$target'");
		$SS = mysql_fetch_array($S);

			if($SS["sex"]=="male"){$p2="";}
			else{$p2="а";}

		$phrase = "<span class=date>$date</span> <span class=$span1>$login</span> прокастовал$pref магию \"Причинить вред\",и <span class=$span2>$target</span> корчась от боли потерял$p <span class=\"magic\">$hit_k</span> HP <span class=hitted>[$hp_new/$hp_all]</span>.<BR>";
		$phrase .= "<span class=date>$date</span> <B>$target убит$p2.</B><BR>";
		}
		else{
		$phrase = "<span class=date>$date</span> <span class=$span1>$login</span> прокастовал$pref магию \"Причинить вред\",и <span class=$span2>$target</span> корчась от боли потерял$p <span class=\"magic\">$hit_k</span> HP <span class=hitted>[$hp_new/$hp_all]</span>.<BR>";
		}

	$D_UPDATE = mysql_query("UPDATE users SET hp='$hp_new' WHERE login='$target'");
		if($db["battle_team"]==1){
		$U_SQL = mysql_query("SELECT hitted FROM team1 WHERE player='$login'");
		$U_D = mysql_fetch_array($U_SQL);
		$new_hitted = $U_D["hitted"] + $hit_k;
		$U_UPDATE = mysql_query("UPDATE team1 SET hitted='$new_hitted' WHERE player='$login'");
		}
		else{
		$U_SQL = mysql_query("SELECT hitted FROM team2 WHERE player='$login'");
		$U_D = mysql_fetch_array($U_SQL);
		$new_hitted = $U_D["hitted"] + $hit_k;
		$U_UPDATE = mysql_query("UPDATE team2 SET hitted='$new_hitted' WHERE player='$login'");
		}

	$ALL_UPDATE = mysql_query("UPDATE users SET battle_opponent='',mana = mana-5 WHERE login='$login'");
	$U_UP = mysql_query("UPDATE users SET battle_opponent='$login' WHERE login='$target'");

	$tf = fopen("logs/$battle_id.tmp","w");
	$t=time();
	fputs($tf,$t);
	fclose($tf);

	$td = fopen("logs/$battle_id.dis","a");
	fputs($td,$phrase);
	fclose($td);	

print "</center>Заклятие прокастовано удачно.<BR>";
	print "<script>location.href='battle.php'</script>";
}
?>