<?
session_start();
include "conf.php";
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$log) or ereg("[<>\\/-]",$boy) or ereg("[<>\\/-]",$timeout) or ereg("[<>\\/-]",$enemy_count)
 or ereg("[<>\\/-]",$friend_count) or ereg("[<>\\/-]",$battle_type) or ereg("[<>\\/-]",$wait) or ereg("[<>\\/-]",$friend_minlevel) or ereg("[<>\\/-]",$friend_maxlevel)
 or ereg("[<>\\/-]",$enemy_minlevel) or ereg("[<>\\/-]",$enemy_maxlevel) or ereg("[<>]",$comment)) {print "Недопустимые символы!!!"; exit();}
$act=htmlspecialchars($act);
$log=htmlspecialchars($log);
$boy=htmlspecialchars($boy);
$timeout=htmlspecialchars($timeout);
$enemy_count=htmlspecialchars($enemy_count);
$friend_count=htmlspecialchars($friend_count);
$battle_type=htmlspecialchars($battle_type);
$wait=htmlspecialchars($wait);
$friend_minlevel=htmlspecialchars($friend_minlevel);
$friend_maxlevel=htmlspecialchars($friend_maxlevel);
$enemy_minlevel=htmlspecialchars($enemy_minlevel);
$enemy_maxlevel=htmlspecialchars($enemy_maxlevel);
$comment=htmlspecialchars($comment);
function showHPMPg($who){
$result = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);
$level=$db["level"];
$hp[0]=$db["hp"];
$hp[1]=$db["hp_all"];
$mp[0]=$db["mp"];
$mp[1]=$db["mp_all"];
$orden_d = $db["orden"];
$clan_s  = $db["clan_short"];
$clan_f  = $db["clan"];
$travm   = $db["travm"];
$rang = $db["rang"];
$pl = str_replace(" ","%20",$who);
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
mysql_query("SET CHARSET cp1251");
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

print "<table valign=\"bottom\" border=0 cellpadding=0 cellspacing=0 width=260><tr valign=\"bottom\"><td align=\"center\" valign=\"bottom\" bgcolor=#dedede><center><b>$orden$clan$who&nbsp</b>[$level]<a href=info.php?log=$pl target=_new><img src=img/inf.gif border=0 alt=\"Информация о $who\"></a>$travm_i</td></tr>
</table><span id=\"info\"></span>";?>


<script language=javascript>
show(<?echo "$hp[0],$hp[1],100"?>);
<?
if($level>=6){
?>
showMN(<?echo "$mp[0],$mp[1]"?>);
<?
}
?>
var rnd = Math.random();
//-- Смена хитпоинтов
var delay = 123;	// Каждые 123сек. увеличение HP на 1%
var redHP = 0.33;	// меньше 30% красный цвет
var yellowHP = 0.66;    // меньше 60% желтый цвет, иначе зеленый
var TimerOn = -1;	// id таймера
var tkHP, maxHP;
var speed=1000;
var mspeed=100;

function show(value, max, newspeed) {
	tkHP=value; maxHP=max;
	if (TimerOn>=0) { clearTimeout(TimerOn); TimerOn=-1; }
	speed=newspeed;
	setHPlocal();
}
function setHPlocal() {
	if (tkHP>maxHP) { tkHP=maxHP; }
	var le=Math.round(tkHP)+"/"+maxHP;
	le=260 - (le.length + 2)*7;
	var sz1 = Math.round(((le-1)/maxHP)*tkHP);
	var sz2 = le - sz1;
		if (tkHP/maxHP < redHP) { imag="img/icon/red.gif"; }
		else {
			if (tkHP/maxHP < yellowHP) { imag="img/icon/yellow.gif"; }
			else { imag="img/icon/green.gif"; }
		}
        rhp=Math.round(tkHP)+"/"+maxHP;
	tkHP = (tkHP+(maxHP/100)*speed/1000);
	if (tkHP<maxHP) { TimerOn=setTimeout('setHPlocal()', delay*100); }
	else { TimerOn=-1; }

info.innerHTML="<table valign=bottom border=0 cellpadding=0 cellspacing=0 width=260 height=8 bgcolor=#dedede><tr valign=bottom><td><small>"+rhp+"</small></td><td align=right width=100%><img src='"+imag+"' alt='Уровень жизни' width="+sz1+" height='8'><img src='img/icon/grey.gif' alt='Уровень жизни' width="+sz2+" height='8'></td><td><span style='width:1px; height:10px'></span></td><td align=right><img border=0 src=img/icon/heart_03.gif alt='Уровень жизни' width=10 height=9></td></tr></table>";

}

function showMN(min, max){
perc=max/99;
n=max-min;
m2=Math.floor(min/perc);
m1=Math.floor(99-m2);
if(m2==100){m2=95;}
color='img/icon/blue.gif'
document.write("<table border=0 cellpadding=0 cellspacing=0 width=260 height=8 bgcolor=#dedede><tr><td><small>"+min+"/"+max+"&nbsp;</small></td><td align=right width=100%><img src="+color+" height=8 width="+m2+"%><img src='img/icon/grey.gif' height=8 width="+m1+"%></td><td><span style=\"width:1px; height:10px\"></span></td><td align=right><img border=0 src=img/icon/Mherz.gif width=10 height=9></td></tr></table>");
}

</script>
<?
}

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
$rang = $db["rang"];

	if($travm!=0){
	$travm_i = "<img src='img/travma2.gif' alt='Персонаж повежден'>";
	}
	else{$travm_i="";}

	if($orden_d==1){$orden_dis="Белое братство";}
	else if($orden_d==2){$orden_dis="Темное братство";}
	else if($orden_d==3){$orden_dis="Нейтральное братсво";}
	else if($orden_d==4){$orden_dis="Алхимик";}
	else if($orden_d==5){$orden_dis="Тюремный заключеный";}
	if(empty($clan_s)){$clan="";}
	else{$clan="<img src='img/clan/$clan_s.gif' border=0 alt='$clan_f'>";}
	if(empty($orden_d)){$orden="";}
	else{ 
if ($orden_d==2) {$orden="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}
if ($orden_d==1) {$orden="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";}}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<META HTTP-EQUIV="Refresh" CONTENT="60"; URL="group_zayavka.php">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<title>АнтиБК+</title>
</head>

<BODY bgColor=#e2e0e0 leftMargin=5 topMargin=5 marginheight="5" marginwidth="5">
<div align="left">
<table align=center width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
<td align=left valign=middle width=50%>
<b><font size="2">
<? showHPMPg($login); ?>
</font></b>
</td>

    <td align=right valign=middle><input type=button value="Обновить" onclick="javascript:location.href='group_zayavka.php'">
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
<TD class=s><A href=\"group_zayavka.php\" class=nick>Групповые</A></TD>
<TD class=m><A href=\"during.php\" class=nick>Текущие</A></TD>
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
</div> 
<?
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);



if(empty($act)){$act="";}

if($act=="get" && !empty($in)){

if(empty($ip))
{
               if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                }
                       else
                {
                        $ip=getenv('REMOTE_ADDR');
                }
}

$Q2=mysql_query("SELECT * FROM team1 WHERE battle_id='$in'");
$t1_a=0;
while($DATAS=mysql_fetch_array($Q2)){
$t1_a++;
}

$Q3=mysql_query("SELECT * FROM team2 WHERE battle_id='$in'");
$t2_a=0;
while($DATAS=mysql_fetch_array($Q3)){
$t2_a++;
}

if($db["hp_all"]/3 > $db["hp"]){
 print "Вы слишком ослаблены для поединка! Восстановитесь!<BR>";
 print "<a href=\"javascript:history.back(-1)\" class=us2>назад</a>";
 die();
}

$Q_TEAM1=mysql_query("SELECT * FROM team1 WHERE player='$login'");
$Q_TEAM2=mysql_query("SELECT * FROM team2 WHERE player='$login'");
while($D1=mysql_fetch_array($Q_TEAM1)){
        if($D1["player"]==$login){
        print "Вы не можете принять этот вызов! Сначала отзовите свою заявку.<BR>";
        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
        die();
        }
}
while($D2=mysql_fetch_array($Q_TEAM2)){
        if($D2["player"]==$login){
        print "Вы не можете принять этот вызов! Сначала отзовите свою заявку.<BR>";
        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
        die();
        }
}


$Q=mysql_query("SELECT * FROM zayavka WHERE creator='$in'");

        while($D=mysql_fetch_array($Q)){
        $status  = $D["status"];
        $type    = $D["type"];
        $timeout = $D["timeout"];
        $minlev1 = $D["minlev1"];
        $minlev2 = $D["minlev2"];
        $maxlev1 = $D["maxlev1"];
        $maxlev2 = $D["maxlev2"];
        $limit1  = $D["limit1"];
        $limit2  = $D["limit2"];
        $wait    = $D["wait"];
                if($team==1){
                $id=$D["id"];
                        if($t1_a>=$D["limit1"]){
                        print "В этой комманде нет места для Вас!<BR>";
                        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
                        die();
                        }
                        if($db["level"]<$D["minlev1"] || $db["level"]>$D["maxlev1"]){
                        print "Вы не подходите по уровню для этого поединка.!<BR>";
                        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
                        die();
                        }
            $S=mysql_query("INSERT INTO team1(player,ip,battle_id,hitted,over) VALUES('$login','$ip','$in','0','0')");
                }
                else if($team==2){
                $id=$D["id"];
                        if($t2_a>=$D["limit2"]){
                        print "В этой комманде нет места для Вас!<BR>";
                        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
                        die();
                        }
                        if($db["level"]<$D["minlev2"] || $db["level"]>$D["maxlev2"]){
                        print "Вы не подходите по уровню для этого поединка.!<BR>";
                        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
                        die();
                        }
                $S=mysql_query("INSERT INTO team2(player,ip,battle_id,hitted,over) VALUES('$login','$ip','$in','0','0')");
                }
        }

}

if($act=="submit"){
/*=============================================================*/
$back_f='group_zayavka.php';

 if($db["hp_all"]/3 > $db["hp"]){
 print "Вы слишком ослаблены для поединка! Восстановитесь!<BR>";
 print "<a href=\"javascript:history.back(-1)\" class=us2>назад</a>";
 die();
 }
if($friend_level==1){$friend_minlevel="0"; $friend_maxlevel=21;}
if($friend_level==2){$friend_minlevel=0; $friend_maxlevel=$db["level"];}
if($friend_level==3){$friend_minlevel=0; $friend_maxlevel=$db["level"]-1;}
if($friend_level==4){$friend_minlevel=$db["level"]; $friend_maxlevel=$db["level"];}
if($friend_level==5){$friend_minlevel=0; $friend_maxlevel=$db["level"]+1;}
if($friend_level==6){$friend_minlevel=$db["level"]-1; $friend_maxlevel=21;}
if($friend_level==7){$friend_minlevel=$db["level"]-1; $friend_maxlevel=$db["level"]+1;}

if($enemy_level==1){$enemy_minlevel="0"; $enemy_maxlevel=21;}
if($enemy_level==2){$enemy_minlevel=0; $enemy_maxlevel=$db["level"];}
if($enemy_level==3){$enemy_minlevel=0; $enemy_maxlevel=$db["level"]-1;}
if($enemy_level==4){$enemy_minlevel=$db["level"]; $enemy_maxlevel=$db["level"];}
if($enemy_level==5){$enemy_minlevel=0; $enemy_maxlevel=$db["level"]+1;}
if($enemy_level==6){$enemy_minlevel=$db["level"]-1; $enemy_maxlevel=21;}
if($enemy_level==7){$enemy_minlevel=$db["level"]-1; $enemy_maxlevel=$db["level"]+1;}

if(empty($friend_count) || empty($enemy_count)){
print "Вы заполнили не все поля.<BR>";
print "<a href=$back_f class=us2>Вернуться</a>";
die();
}
if($friend_count>99 || $enemy_count>99){
print "Максимальное колличество бойцов в группе - 99.<BR>";
print "<a href=$back_f class=us2>Вернуться</a>";
die();
}
if($friend_count<1 || $enemy_count<2){
print "Неверный ввод колличества бойцов. Минимальное количество противников - 2 человека.<BR>";
print "<a href=$back_f class=us2>Вернуться</a>";
die();
}
if($friend_minlevel<0 || $friend_maxlevel>30 || $enemy_minlevel<0 || $enemy_maxlevel>30){
print "Неверный ввод ограничения уровня.<BR>";
print "<a href=$back_f class=us2>Вернуться</a>";
die();
}

if(empty($ip))
{
               if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                }
                       else
                {
                        $ip=getenv('REMOTE_ADDR');
                }
}

$Q_TEAM1=mysql_query("SELECT * FROM team1 WHERE player='$login'");
$Q_TEAM2=mysql_query("SELECT * FROM team2 WHERE player='$login'");
while($D1=mysql_fetch_array($Q_TEAM1)){
        if($D1["player"]==$login){
        print "Вы не можете подать заявку! Сначала отзовите свою.<BR>";
        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
        die();
        }
}
while($D2=mysql_fetch_array($Q_TEAM2)){
        if($D2["player"]==$login){
        print "Вы не можете подать заявку!Сначала отзовите свою.<BR>";
        print "<a href='group_zayavka.php' class=us2>Вернуться</a>";
        die();
        }
}

$time=date("H:i");
$mine_id=$db["id"];
$wait_to=$wait*60+time();
$comment=htmlspecialchars($comment);
$SQL="INSERT INTO zayavka(status,type,date,timeout,creator,minlev1,maxlev1,minlev2,maxlev2,limit1,limit2,wait,comment) VALUES('1','$battle_type','$time','10','$mine_id','$friend_minlevel','$friend_maxlevel','$enemy_minlevel','$enemy_maxlevel','$friend_count','$enemy_count','$wait_to','$comment')";
$QUERY=mysql_query($SQL);
$SQL_T="INSERT INTO team1(player,ip,battle_id,hitted,over) VALUES('$login','$ip','$mine_id','0','0')";
$QUERY2=mysql_query($SQL_T);

if(!$QUERY OR !$QUERY2){echo mysql_error();}

/*=============================================================*/
}
else
{
if(empty($act)){
?>
<table border=0 width=100%><tr><TD align=left valign=top>
<input type=button value='Подать заявку' onClick="javascript:location.href='group_zayavka.php?act=podat'">
</td>
<td align=right valign=top>
<input type=button value="Обновить" onclick="javascript:location.href='group_zayavka.php'">
</td>
</tr></table>
<?
}
else if($act=="podat"){
$enemy_count=htmlspecialchars($enemy_count);
$friend_count=htmlspecialchars($friend_count);
$battle_type=htmlspecialchars($battle_type);
$wait=htmlspecialchars($wait);
$friend_minlevel=htmlspecialchars($friend_minlevel);
$friend_maxlevel=htmlspecialchars($friend_maxlevel);
$enemy_minlevel=htmlspecialchars($enemy_minlevel);
$enemy_maxlevel=htmlspecialchars($enemy_maxlevel);
$comment=htmlspecialchars($comment);
?>

<table border=0 width=100%><tr><TD width=400>
<form action='group_zayavka.php?act=submit' name='zayava' method='post'>
<center><H3><p style="COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; TEXT-ALIGN: center">Подать заявку</p></H3></center>
Ваша команда <input type=text name=friend_count size=4> бойцов.<br>

Уровни союзников <select name=friend_level>
<option value=1>любой
<option value=2>только моего и ниже
<option value=3>только ниже моего уровня
<option value=4>только моего уровня
<option value=5>не старше меня более чем на уровень
<option value=6>не младше меня более чем на уровень
<option value=7>мой уровень +/- 1
</select>
<br><br>

Противники <input type=text name=enemy_count size=4> бойцов.<br>

Уровни противников <select name=enemy_level>
<option value=1>любой
<option value=2>только моего и ниже
<option value=3>только ниже моего уровня
<option value=4>только моего уровня
<option value=5>не старше меня более чем на уровень
<option value=6>не младше меня более чем на уровень
<option value=7>мой уровень +/- 1
</select><br><br>

Тип боя <select name=battle_type>
<option value=4>с оружием
<option value=3>кулачный
</select><br>

Таймаут <select name=wait>
<option value=1>1 минута
<option value=3>3 минуты
<option value=5>5 минут
<option value=10>10 минут
<option value=15>15 минут
<option value=20>20 минут
<option value=30>30 минут
</select><br>
Комментарий к бою:<input type=text name=comment size=50><br>
<center><input type=submit value='Подать!'></center>




</td><td valign=top align=right>
<input type=button value="Обновить" onclick="javascript:location.href='group_zayavka.php'">
</td></tr></table>
</form>
<?
}
}


if($act=="get" or $act=="submit"){
?>
<table border=0 width=100%><tr><TD align=left valign=top>
<input type=button value='Подать заявку' onClick="javascript:location.href='group_zayavka.php?act=podat'">
</td>
<td align=right valign=top>
<input type=button value="Обновить" onclick="javascript:location.href='group_zayavka.php'">
</td>
</tr></table>
<?
}

$creator=array();
$team1_limit=array();
$team2_limit=array();
$t1_minlev=array();
$t1_maxlev=array();
$t2_minlev=array();
$t2_maxlev=array();
$t1_all=array();
$t2_all=array();
$btype=array();
$wait=array();
$comment=array();
$time=array();
$i=0;

$Q=mysql_query('SELECT * FROM zayavka WHERE type=3 OR type=4 ORDER BY creator');
$t1_ready=0;
$t2_ready=0;

while($DATA=mysql_fetch_array($Q)){
   $cr=$DATA["creator"];
   $mine_z[$i] = 0;

   $Q2=mysql_query("SELECT * FROM team1 WHERE battle_id='$cr'");
   $t1_all[$i]=0;
   while($DATAS=mysql_fetch_array($Q2)){
      $t1_all[$i]++;
   }

   $Q3=mysql_query("SELECT * FROM team2 WHERE battle_id='$cr'");
   $t2_all[$i]=0;
   while($DATAS=mysql_fetch_array($Q3)){
      $t2_all[$i]++;
   }

   $creator[$i]=$DATA["creator"];
   $team1_limit[$i]=$DATA["limit1"];
   $team2_limit[$i]=$DATA["limit2"];
   $t1_minlev[$i]=$DATA["minlev1"];
   $t1_maxlev[$i]=$DATA["maxlev1"];
   $t2_minlev[$i]=$DATA["minlev1"];
   $t2_maxlev[$i]=$DATA["maxlev2"];
   $btype[$i]=$DATA["type"];
   $wait[$i]=$DATA["wait"];
   $comment[$i]=$DATA["comment"];
   $time[$i]=$DATA["date"];
   $i++;
}

include "functions.php";

for($n=0;$n<$i;$n++){
  if($t2_all[$n]==''){$t2_all[$n]=0;}

  $wait_sec=$wait[$n];
  $now=time();
  $left_time=$wait_sec-$now;
  $left_min=floor($left_time/60);
  $left_sec=$left_time-$left_min*60;

  $QUER=mysql_query("SELECT * FROM team2 WHERE battle_id='$creator[$n]'");
  while($DATAS=mysql_fetch_array($QUER)){
    $p2=$DATAS["player"];
    if($p2!=''){
       $QQ2=mysql_query("SELECT level,orden,clan,clan_short FROM characters WHERE login='$p2'");
       $DD2=mysql_fetch_array($QQ2);
       if($p2 == $login){$mine_z[$n] = 1;} // указывает, что н-ый массив относится к текущему перцу
    }
  }

  $QUER=mysql_query("SELECT * FROM team1 WHERE battle_id='$creator[$n]'");
  while($DATAS=mysql_fetch_array($QUER)){
    $p1=$DATAS["player"];
    if($p1!=''){
       $QQ2=mysql_query("SELECT level,orden,clan,clan_short FROM characters WHERE login='$p1'");
       $DD2=mysql_fetch_array($QQ2);
       if($p1 == $login){$mine_z[$n] = 1;}
    }
  }

  if($left_time>0){


print "<BR> <span class=date>$time[$n]</span> <b>$team1_limit[$n] (</b>$t1_minlev[$n]-$t1_maxlev[$n]<b>) на $team2_limit[$n] (</b>$t2_minlev[$n]-$t2_maxlev[$n]<b>)</b>";
print " <a href='group_zayavka.php?act=get&in=$creator[$n]&team=1' class=nick title='Вступить в эту команду'>=></a>(";


  $QUER=mysql_query("SELECT * FROM team1 WHERE battle_id='$creator[$n]' ORDER BY date ASC");
  while($DATAS=mysql_fetch_array($QUER)){
  $p1=$DATAS["player"];
  $p = str_replace(" ","%20",$p1);
     if($p1!=""){
        $QQ=mysql_query("SELECT level,orden,clan,clan_short FROM characters WHERE login='$p1'");
        $DD=mysql_fetch_array($QQ);
        $lev=$DD["level"];
        if($p1 == $login){$mine_z[$n] = 1;}
        $p1="<b>$p1</b> [$lev]<a href='info.php?log=$p' target=new_$p1><img src='img/inf.gif' border=0></a>";
  if($t1_all[$n]==1){print "$p1";}else{
        print "$p1, ";}
     }
  }

print ") ";
print "<i>против</i> <a href='group_zayavka.php?act=get&in=$creator[$n]&team=2' class=nick title='Вступить в эту команду'>=></a>(";

  if($t2_all[$n]==0){print "группа не набрана";}
  $QUER=mysql_query("SELECT * FROM team2 WHERE battle_id='$creator[$n]'");
  while($DATAS=mysql_fetch_array($QUER)){
  $p2=$DATAS["player"];
  $p = str_replace(" ","%20",$p2);
     if($p2!=''){
        $QQ2=mysql_query("SELECT level,orden,clan,clan_short FROM characters WHERE login='$p2'");
        $DD2=mysql_fetch_array($QQ2);
        $lev2=$DD2["level"];
        if($p2 == $login){$mine_z[$n] = 1;}
        $p2="<b>$p2</b> [$lev2]<a href='info.php?log=$p' target=new_$p2><img src='img/inf.gif' border=0></a>";
  if($t2_all[$n]==1){print "$p2";}else{
        print "$p2, ";}
     }
  }
print ")";

  if($t2_all[$n]==$team2_limit[$n] AND $t1_all[$n]==$team1_limit[$n] AND $mine_z[$n] == 1){
    goBattle($login);
  }

  $btype_n=$btype[$n];  // 
  if($btype[$n]==3){$btype[$n]="<img src='img/icon/fighttype5.gif' width=\"20\" height=\"20\" alt='Кулачный бой'>";}
  if($btype[$n]==4){$btype[$n]="<img src='img/icon/fighttype1.gif' width=\"20\" height=\"20\" alt='Физический бой'>";}
  print " тип боя: $btype[$n]";
if(!empty($comment[$n])){
  print " (<i>Комментарий: $comment[$n]</i>)";}
  print " Начало через $left_min мин. $left_sec сек.&nbsp";
}


if($left_time<0){
   $t2_a=0;
   $Q_T2=mysql_query("SELECT player FROM team2 WHERE battle_id='$creator[$n]'");
   while($QDAT=mysql_fetch_array($Q_T2)){
     $t2_a++;
   }

   if($t2_a==0){
      $Q_DZ=mysql_query("DELETE FROM zayavka WHERE creator=$creator[$n]");
      $Q_T1=mysql_query("SELECT * FROM team1");
      while($Q_T1DAT=mysql_fetch_array($Q_T1)){
        if($Q_T1DAT["battle_id"]==$creator[$n]){
           $cur_player=$Q_T1DAT["player"];
        }
      }
      $Q_D2=mysql_query("DELETE FROM team1 WHERE battle_id=$creator[$n]");
   }else if($mine_z[$n]==1){
      goBattle($login);
   }
}



}

?></body>
