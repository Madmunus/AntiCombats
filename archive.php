<?
session_start();
include ("conf.php");
include ("functions.php");

$act=htmlspecialchars($act);
$date=htmlspecialchars($date);
$target=htmlspecialchars($target);
$view=htmlspecialchars($view);
$scan=htmlspecialchars($scan);
$log=htmlspecialchars($log);
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$S = mysql_query("SELECT * FROM characters WHERE login='$login'");
$db = mysql_fetch_array($S);
$orden = $db["orden"];
if(empty($date)){$date = date("Y.m.d");$date_t=$date;}
else{$date_t = $date;}
if(empty($target)){$target = $login;$login_t = $login;}
else{$login_t = $target;}

$orden_d = $db["orden"];
$clan_s  = $db["clan_short"];
$clan_f  = $db["clan"];
$travm   = $db["travm"];
$level   = $db["level"];
$room   = $db["room"];
$rang = $db["rang"];

$cure_hp=$db["cure_hp"];
$cure_mp=$db["cure_mp"];
$time_to_cure=$cure_hp-time();
$hhh=$db["hp_all"];
if($db["battle"]==0){
if($time_to_cure>0){
$percent_hp=floor((100*$time_to_cure)/1200);
$percent=100-$percent_hp;
$percent=$percent;
$hp[0]=floor(($hhh*$percent)/100);
$sss="UPDATE characters SET hp='$hp[0]' WHERE login='$login'";
$q=mysql_query($sss);
}
else{
$hp[0]=$db["hp_all"];
$SS = mysql_query("UPDATE characters SET hp='$hp[0]',cure_hp='0' WHERE login='$login'");
$time_to_cure_f=0;
}
}

	if($travm!=0){
	$travm_i = "<img src='img/travma2.gif' alt='Персонаж поврежден'>";
	}
	else{$travm_i="";}

	if($orden_d==1){$orden_dis="Белое братство";}
	else if($orden_d==2){$orden_dis="Темное братство";}
	else if($orden_d==3){$orden_dis="Нейтральное братство";}
	else if($orden_d==4){$orden_dis="Алхимик";}
	else if($orden_d==5){$orden_dis="Тюремный заключеный";}
	if(empty($clan_s)){$clan="";}
	else{$clan="<img src='img/clan/$clan_s.gif' border=0 alt='$clan_f'>";}
	if(empty($orden_d)){$orden="";}
	else{
if ($orden_d==2) {$orden="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}
if ($orden_d==1) {$orden="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<title>АнтиБК+</title>

<BODY bgColor=#e2e0e0 leftMargin=5 topMargin=5 marginheight="5" marginwidth="5">
<table align=center width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align=left valign=middle width=50%>
<b><font size="2">
<? showHPMP($login); ?>
</font></b>
</td>
    <td  align=right valign=middle><input type=button value="Обновить" onclick="javascript:location.href='archive.php'">
<input type=button value="Вернуться">

</td>
  </tr>
</table>
<table align=center cellSpacing=1 cellPadding=1 width="100%">
  <tr>
  
<?if($room == "Зал воинов" or $room == "Зал воинов 2" or $room == "Зал воинов 3" or $room == "Будуар" or $room == "Рыцарский Зал" or $room == "Комната Знахаря" or $room == "Торговый Зал" or $room == "Зал закона"){  
print"<TD class=m width=40>&nbsp;<B>Бои:</B></TD>
<TD class=m><A href=\"zayavka.php?boy=phisic\" class=nick>Физические</A></TD>
<TD class=m><A href=\"boy_bot.php\" class=nick>С ботом</A></TD>
<TD class=m><A href=\"group_zayavka.php\" class=nick>Групповые</A></TD>
<TD class=m><A href=\"during.php\" class=nick>Текущие</A></TD>
<TD class=s><A href=\"archive.php\" class=nick>Завершенные</A></TD>


  </tr>
</table>";
}
else {
print"<TD class=m width=40>&nbsp;<B>Бои:</B></TD>
<TD class=m><A href=\"#\" class=nick>Физические</A></TD>
<TD class=m><A href=\"#\" class=nick>С ботом</A></TD>
<TD class=m><A href=\"#\" class=nick>Групповые</A></TD>
<TD class=m><A href=\"#\" class=nick>Текущие</A></TD>
<TD class=m><A href=\"#\" class=nick>Завершенные</A></TD>

  </tr>
</table>
<br><br>
<center><b>Бои проводятся только в залах Бойцовского клуба!</b></center>

</html>";
die();}
?>

<form action='archive.php?act=view' method="POST">
Архив поединков:<BR>
Укажите логин и дату проведения боя:<BR>
<table border=0><TR>
<td>
Login:<BR>
<input type=text class=new style="width=150" name=target value="<?echo $login_t?>">
</td><td>
дата(гггг.мм.дд):<BR>
<input type=text class=new style="width=150" name=date value="<?echo $date_t?>">
</td>
</tr><tr><td>
<input type=submit name="view" class=but value="просмотреть" style="width=150">
<?
if($db["orden"]==1 && $db["admin_level"]>=5 or $db["login"]=='Мироздатель' or $db["login"]=='Смотритель' or $db["orden"]==2 && $db["admin_level"]>=5){
print "</td><td><input type=submit name=\"scan\" class=but value=\"ip-scan\" style=\"width=150\">";
}
?>
</td></tr></table>
</form>
<hr color=#000000 size=1 width=50% align=left>
Список боев персонажа <B><?echo $target;?></B> за <B><?echo $date;?></B>
<BR>
<hr color=#000000 size=1 width=50% align=left>
<?

if(!empty($target) AND !empty($view)){
$date = str_replace(".","",$date);
$SEEK = mysql_query("SELECT * FROM battles WHERE status='finished'");
$i=1;
	while($DATA = mysql_fetch_array($SEEK)){
	$date_db = substr($DATA["date"],0,10);
    $date_db = str_replace("-","",$date_db);
		if($date == $date_db){
		$bid = $DATA["id"];
		$TEAM1 = mysql_query("SELECT player,ip FROM team1_history WHERE battle_id='$bid'");
		$TEAM2 = mysql_query("SELECT player,ip FROM team2_history WHERE battle_id='$bid'");

		while($T1_D = mysql_fetch_array($TEAM1)){
				if($T1_D["player"] == $target){
				$team1 = "";
				$team2 = "";
				if($DATA["win"]==1){$win1 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win2="";}
				else{$win2 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win1="";}
				$LIST_TEAM1 = mysql_query("SELECT player,ip FROM team1_history WHERE battle_id='$bid'");
				while($T1_LISTD = mysql_fetch_array($LIST_TEAM1)){
				$pl = $T1_LISTD["player"];
                                $pl1 = str_replace(" ","%20",$pl);
				if($orden == 1){
				$ip = $T1_LISTD["ip"];
				$ip_t = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
				}
				else{$ip_t = "";}
				$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
				$PL_LD = mysql_fetch_array($PL_L);
				$lev = $PL_LD["level"];
				$team1 .= "$pl$ip_t&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
				}
				$LIST_TEAM2 = mysql_query("SELECT player,ip FROM team2_history WHERE battle_id='$bid'");
				while($T2_LISTD = mysql_fetch_array($LIST_TEAM2)){
				$pl = $T2_LISTD["player"];
                                $pl1 = str_replace(" ","%20",$pl);
				if($orden == 1){
				$ip = $T2_LISTD["ip"];
				$ip_t = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
				}
				else{$ip_t = "";}
				$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
				$PL_LD = mysql_fetch_array($PL_L);
				$lev = $PL_LD["level"];
				$team2 .= "$pl$ip_t&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
				}
				print "$i. <span class=p1>$team1</span>$win1 <B>VS</b> <span class=p2>$team2</span>$win2 - <a href='log.php?log=$bid' class=us2 target=battle_$bid>смотреть <small>>>></small></a><BR>";
				$i++;
				}
			}
			while($T2_D = mysql_fetch_array($TEAM2)){
				if($T2_D["player"] == $target){
				$team1 = "";
				$team2 = "";
				if($DATA["win"]==1){$win1 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win2="";}
				else{$win2 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win1="";}
				$LIST_TEAM1 = mysql_query("SELECT player,ip FROM team1_history WHERE battle_id='$bid'");
				while($T1_LISTD = mysql_fetch_array($LIST_TEAM1)){
				$pl = $T1_LISTD["player"];
                                $pl1 = str_replace(" ","%20",$pl);
				if($orden == 1){
				$ip = $T1_LISTD["ip"];
				$ip_t = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
				}
				else{$ip_t = "";}
				$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
				$PL_LD = mysql_fetch_array($PL_L);
				$lev = $PL_LD["level"];
				$team1 .= "$pl$ip_t&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
				}
				$LIST_TEAM2 = mysql_query("SELECT player,ip FROM team2_history WHERE battle_id='$bid'");
				while($T2_LISTD = mysql_fetch_array($LIST_TEAM2)){
				$pl = $T2_LISTD["player"];
                                $pl1 = str_replace(" ","%20",$pl);
				if($orden == 1){
				$ip = $T2_LISTD["ip"];
				$ip_t = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
				}
				else{$ip_t = "";}
				$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
				$PL_LD = mysql_fetch_array($PL_L);
				$lev = $PL_LD["level"];
				$team2 .= "$pl$ip_t&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
				}
				print "$i. <span class=p1>$team1</span>$win1 <B>VS</b> <span class=p2>$team2</span>$win2 - <a href='log.php?log=$bid' class=us2 target=battle_$bid>смотреть <small>>>></small></a><BR>";
				$i++;
				}
			}
		}
	}
}

if(!empty($target) AND !empty($scan)){
$GET_DB = mysql_query("SELECT * FROM characters WHERE login='$target'");
$GDB = mysql_fetch_array($GET_DB);
$ip_target = $GDB["reg_ip"];

$SEEK_IP1 = mysql_query("SELECT * FROM team1_history WHERE ip = '$ip_target'");
	while($DAT = mysql_fetch_array($SEEK_IP1)){
	$bid = $DAT["battle_id"];
	$T1 = mysql_query("SELECT player FROM team1_history WHERE battle_id='$bid'");
	$team1 = "";
		while($TD1 = mysql_fetch_array($T1)){
		$pl = $TD1["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$team1 .= "$pl&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}

	$T2 = mysql_query("SELECT player FROM team2_history WHERE battle_id='$bid'");
	$team2 = "";
		while($TD2 = mysql_fetch_array($T2)){
		$pl = $TD2["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$team2 .= "$pl&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}

	$bat .= "$bid. <span class=p1>$team1</span> <B>VS</B> <span class=p2>$team2</span> - <a href='log.php?log=$bid' class=us2 target=battle_$bid>смотреть <small>>>></small></a><BR>";
	}

$SEEK_IP2 = mysql_query("SELECT * FROM team2_history WHERE ip = '$ip_target'");
	while($DAT = mysql_fetch_array($SEEK_IP2)){
	$bid = $DAT["battle_id"];
	$T12 = mysql_query("SELECT player FROM team1_history WHERE battle_id='$bid'");
	$team1 = "";
		while($TD12 = mysql_fetch_array($T12)){
		$pl = $TD12["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$team1 .= "$pl&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}

	$T22 = mysql_query("SELECT player FROM team2_history WHERE battle_id='$bid'");
	$team2 = "";
		while($TD22 = mysql_fetch_array($T22)){
		$pl = $TD22["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$team2 .= "$pl&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}

	$bat .= "$bid. <span class=p1>$team1</span> <B>VS</B> <span class=p2>$team2</span> - <a href='log.php?log=$bid' class=us2 target=battle_$bid>смотреть <small>>>></small></a><BR>";
	}

print "Бои-multyIP,проведенные с одного IP-адреса.:<BR>";

$bat_MIP = "";
$i=1;

$LOOK = mysql_query("SELECT * FROM team1_history WHERE player='$target'");

	while($LD = mysql_fetch_array($LOOK)){
	$ip_t = $LD["ip"];
	$bid = $LD["battle_id"];
	$MT = mysql_query("SELECT * FROM team2_history WHERE battle_id='$bid' AND ip='$ip_t'");
		while($DAT = mysql_fetch_array($MT)){
		$B = $DAT["battle_id"];
		if(!empty($B)){
		$B_SEEK = mysql_query("SELECT * FROM battles WHERE id='$B'");
		$BSD = mysql_fetch_array($B_SEEK);
		if($BSD["win"]==1){$win1 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win2="";}
		else{$win2 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win1="";}
		$T12 = mysql_query("SELECT player,ip FROM team1_history WHERE battle_id='$B'");
		$team1 = "";
		while($TD12 = mysql_fetch_array($T12)){
		$pl = $TD12["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$ip = $TD12["ip"];
		if($ip == $ip_t){$ip = "<font color=#D50000>$ip</FONT>";}
		$ip_t2 = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
		$team1 .= "$pl$ip_t2&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}

		$T22 = mysql_query("SELECT player,ip FROM team2_history WHERE battle_id='$B'");
		$team2 = "";
		while($TD22 = mysql_fetch_array($T22)){
		$pl = $TD22["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$ip = $PL_LD["ip"];
		$ip = $TD22["ip"];
		if($ip == $ip_t){$ip = "<font color=#D50000>$ip</FONT>";}
		$ip_t2 = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
		$team2 .= "$pl$ip_t2&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}
		}
	$bat_MIP .= "$i. <span class=p1>$team1</span>$win1 <B>VS</B> <span class=p2>$team2</span>$win2 - <a href='log.php?log=$B' class=us2 target=battle_$B>смотреть <small>>>></small></a><BR>";
	$i++;
		}
	}

$LOOK2 = mysql_query("SELECT * FROM team2_history WHERE player='$target'");

	while($LD = mysql_fetch_array($LOOK2)){
	$ip_t = $LD["ip"];
	$bid = $LD["battle_id"];
	$MT = mysql_query("SELECT * FROM team1_history WHERE battle_id='$bid' AND ip='$ip_t'");
		while($DAT = mysql_fetch_array($MT)){
		$B = $DAT["battle_id"];
		if(!empty($B)){
		$B_SEEK = mysql_query("SELECT * FROM battles WHERE id='$B'");
		$BSD = mysql_fetch_array($B_SEEK);
		if($BSD["win"]==1){$win1 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win2="";}
		else{$win2 = "<img src='img/icon/unlock.gif' alt='Победа за этой командой'>";$win1="";}
		$T12 = mysql_query("SELECT player,ip FROM team1_history WHERE battle_id='$B'");
		$team1 = "";
		while($TD12 = mysql_fetch_array($T12)){
		$pl = $TD12["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$ip = $TD12["ip"];
		if($ip == $ip_t){$ip = "<font color=#D50000>$ip</FONT>";}
		$ip_t2 = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
		$team1 .= "$pl$ip_t2&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}

		$T22 = mysql_query("SELECT player,ip FROM team2_history WHERE battle_id='$B'");
		$team2 = "";
		while($TD22 = mysql_fetch_array($T22)){
		$pl = $TD22["player"];
                $pl1 = str_replace(" ","%20",$pl);
		$PL_L = mysql_query("SELECT level FROM characters WHERE login='$pl'");
		$PL_LD = mysql_fetch_array($PL_L);
		$lev = $PL_LD["level"];
		$ip = $PL_LD["ip"];
		$ip = $TD22["ip"];
		if($ip == $ip_t){$ip = "<font color=#D50000>$ip</FONT>";}
		$ip_t2 = "<span class=us2>(<i>ip: <small>$ip</small></I>)</span>";
		$team2 .= "$pl$ip_t2&nbsp[$lev]<a href='info.php?log=$pl1' target=$pl><img src='img/inf.gif' border=0></a>,";
		}
		}
	$bat_MIP .= "$i. <span class=p1>$team1</span>$win1 <B>VS</B> <span class=p2>$team2</span>$win2 - <a href='log.php?log=$B' class=us2 target=battle_$B>смотреть <small>>>></small></a><BR>";
	$i++;
		}
	}

print "$bat_MIP<hr size=1 noshade color=#000000 width=45% align=left><BR>";

}

?>