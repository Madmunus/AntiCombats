<?
session_start();
include "conf.php";
include "functions.php";
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$log=htmlspecialchars($log);


$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$S = mysql_query("SELECT * FROM characters WHERE login='$login'");
$db = mysql_fetch_array($S);
$orden = $db["orden"];
$orden_d = $db["orden"];
$clan_s  = $db["clan_short"];
$clan_f  = $db["clan"];
$travm   = $db["travm"];
$level   = $db["level"];
$room   = $db["room"];
$rang   = $db["rang"];
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
    <td  align=right valign=middle><input type=button value="Обновить" onclick="javascript:location.href='during.php'">
<input type=button value="Вернуться" onclick="javascript:location.href='main.php?act=none'">

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
<TD class=s><A href=\"during.php\" class=nick>Текущие</A></TD>
<TD class=m><A href=\"archive.php\" class=nick>Завершенные</A></TD>

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
&nbsp;&nbsp; <b><font size="2">Текущие поединки:</font></b><BR>
<?
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);

$S = mysql_query("SELECT * FROm zayavka WHERE status=3");
while($D = mysql_fetch_array($S)){
$cr = $D["creator"];
$T1 = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr");
$T2 = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr");
    $team1 = "";
    while($T1D = mysql_fetch_array($T1)){
    $p = $T1D["player"];
        $p1 = str_replace(" ","%20",$p);
    $SP = mysql_query("SELECT level,battle,orden,clan_short,clan,rang FROM characters WHERE login='$p'");
    $SPD = mysql_fetch_array($SP);
    $lev = $SPD["level"];
    $bid = $SPD["battle"];
    $orden = $SPD["orden"];
    $clan_s = $SPD["clan_short"];
    $clan = $SPD["clan"];
    $rang = $SPD["rang"];
    if($orden!=0){ 
if ($orden==2) {$orden_d="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
else{$orden_d="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}
if ($orden==1) {$orden_d="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";}
    }
    if($clan!=''){
    $clan_i = "<img src='img/clan/$clan_s.gif' alt='$clan'>";
    }
    $team1.="$orden_d$clan_i$p [$lev]<a href='info.php?log=$p1' target=$p.i><img src='img/inf.gif' border=0></a> ";
    }
    $team2 = "";
    while($T2D = mysql_fetch_array($T2)){
    $p = $T2D["player"];
        $p1 = str_replace(" ","%20",$p);
    $SP = mysql_query("SELECT level,battle,orden,clan_short,clan,rang FROM characters WHERE login='$p'");
    $SPD = mysql_fetch_array($SP);
    $lev = $SPD["level"];
    $bid = $SPD["battle"];
    $orden = $SPD["orden"];
    $clan_s = $SPD["clan_short"];
    $clan = $SPD["clan"];
    $rang = $SPD["rang"];
    if($orden!=0){
if ($orden==2) {$orden_d="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
else{$orden_d="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}
if ($orden==1) {$orden_d="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
    }
    if($clan!=''){
    $clan_i = "<img src='img/clan/$clan_s.gif' alt='$clan'>";
    }
    $team2.="$orden_d$clan_i$p [$lev]<a href='info.php?log=$p1' target=$p.i><img src='img/inf.gif' border=0></a> ";
    }

print "$team1 <B>VS</B> $team2 <a href='log.php?log=$bid' class=us2 target=_new>смотреть<small>>>></small></a><BR>";
}


?>