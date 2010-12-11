<?
session_start();
include "conf.php";
if($fuck==1){print "<script>location.href='battle.php'</script>";}
include "functions.php";
?>
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<?
$data = mysql_connect($base_name, $base_user, $base_pass);

mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
if (ereg("[<>\\/-]",$act)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
$creator = $db["battle_pos"];
$opponent = $db["battle_opponent"];
$bid = $db["battle"];
$team = $db["battle_team"];

function showHPMPop($who){
$result = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);
if (ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$log=htmlspecialchars($log);
$level=$db["level"];
$wis=$db["wis"];
$hp[0]=$db["hp"];
$hp[1]=$db["hp_all"];
$mp[0]=$db["mp"];
$mp[1]=$db["mp_all"];
$orden_d = $db["orden"];
$clan_s  = $db["clan_short"];
$clan_f  = $db["clan"];
$travm   = $db["travm"];
$rang = $db["rang"];
$pl1 = str_replace(" ","%20",$who);

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

print "<table valign=\"bottom\" border=0 cellpadding=0 cellspacing=0 width=260><tr valign=\"bottom\"><td align=\"center\" valign=\"bottom\" bgcolor=#dedede><center><b>$orden$clan$who&nbsp</b>[$level]<a href=info.php?log=$pl1 target=_new><img src=img/inf.gif border=0 alt=\"Информация о $who\"></a>$travm_i</td></tr>
</table>";?>


<script language=javascript>
show(<?echo "$hp[0],$hp[1]"?>);
<?
if($level>=6 && $wis!=0){
?>
showMN(<?echo "$mp[0],$mp[1]"?>);
<?
}
?>
function show(min, max){
perc=max/99;
n=max-min;
m2=Math.floor(min/perc);
m1=Math.floor(99-m2);
if(m2==100){m2=99;}
if(m2<30){color='img/icon/red.gif';}
else if(m2<60){color='img/icon/yellow.gif';}
else {color='img/icon/green.gif';}
document.write("<table valign=bottom border=0 cellpadding=0 cellspacing=0 width=260 height=8 bgcolor=#dedede><tr valign=bottom><td><small>"+min+"/"+max+"&nbsp;</small></td><td align=right width=100%><img src="+color+" alt='Уровень жизни' height=8 width="+m2+"%><img src='img/icon/grey.gif' alt='Уровень жизни' height=8 width="+m1+"%></td><td><span style=\"width:1px; height:10px\"></span></td><td align=right><img border=0 src=img/icon/heart_03.gif alt='Уровень жизни' width=10 height=9></td></tr></table>");
}

function showMN(min, max){
perc=max/99;
n=max-min;
m2=Math.floor(min/perc);
m1=Math.floor(99-m2);
if(m2==100){m2=95;}
color='img/icon/blue.gif'
document.write("<table border=0 cellpadding=0 cellspacing=0 width=260 height=8 bgcolor=#dedede><tr><td><small>"+min+"/"+max+"&nbsp;</small></td><td align=right width=100%><img src="+color+" alt='Уровень маны' height=8 width="+m2+"%><img src='img/icon/grey.gif' alt='Уровень маны' height=8 width="+m1+"%></td><td><span style=\"width:1px; height:10px\"></span></td><td align=right><img border=0 src=img/icon/Mherz.gif alt='Уровень маны' width=10 height=9></td></tr></table>");
}

</script>

<?
}
if($db["battle"]==0){
print "<script>location.href='main.php?act=none'</script>";
die();
}

$BB = mysql_query("SELECT status FROM battles WHERE id=$bid");
mysql_query("SET CHARSET cp1251");
$BDD = mysql_fetch_array($BB);
$status = $BDD["status"];
$b = 1;

$winer = 0;
$loser = 0;

if(empty($act)){$act="";}


if($act=="t_win"){
$GET_T = mysql_query("SELECT * FROM timeout WHERE battle_id='$bid'");
mysql_query("SET CHARSET cp1251");
$GET_TD = mysql_fetch_array($GET_T);
$lasthit = $GET_TD["lasthit"];

if($lasthit == ''){
lose(1,$bid,1);
lose(2,$bid,1);
clearZayavka($creator,$bid);
}

$SEEK_T = mysql_query("SELECT timeout FROM zayavka WHERE creator = '$creator'");
mysql_query("SET CHARSET cp1251");
$SEEK_TD = mysql_fetch_array($SEEK_T);
$to = $SEEK_TD["timeout"]*60;
$timeout = $lasthit+$to - time();




    if($timeout<0){
        if($team == 1){
        $SS = mysql_query("UPDATE battles SET win='1',status='finished' WHERE id=$bid");
        mysql_query("SET CHARSET cp1251");
        $winer=1;
        $loser=2;
        }
        else if($team == 2){
        $SS = mysql_query("UPDATE battles SET win='2',status='finished' WHERE id=$bid");
        mysql_query("SET CHARSET cp1251");
        $winer=2;
        $loser=1;
        }
    print "<script>location.href='battle.php?act=exit'</script>";
    die();
    }

}

if($act == "exit"){
    if($db["battle"]!=0){
    $S = mysql_query("SELECT * FROM battles WHERE id=$bid");
    mysql_query("SET CHARSET cp1251");


    $D = mysql_fetch_array($S);
    if($team == 1){$an_team = 2;}
    else{ $an_team = 1;}
        if($team == $D["win"]){
        win($team,$bid);
        lose($an_team,$bid,0);
        clearZayavka($creator,$bid);
        }
        else{
        win($an_team,$bid);
        lose($team,$bid,0);
        clearZayavka($creator,$bid);
        }
    print "<script>location.href='main.php?act=none'</script>";
    die();
    }
}

    $team1_c = 0;
    $team2_c = 0;

    $T1 = mysql_query("SELECT * FROM team1 WHERE battle_id='$creator'");
    while($T1_DATA = mysql_fetch_array($T1)){
    $player=$T1_DATA["player"];
    $S = mysql_query("SELECT hp FROM characters WHERE login='$player'");
    $D = mysql_fetch_array($S);
        if($D["hp"] > 0){$team1_c++;}
    }

    $T2 = mysql_query("SELECT * FROM team2 WHERE battle_id='$creator'");
    while($T2_DATA = mysql_fetch_array($T2)){
    $player=$T2_DATA["player"];
    $S = mysql_query("SELECT hp FROM characters WHERE login='$player'");
    $D = mysql_fetch_array($S);
        if($D["hp"] > 0){$team2_c++;}
    }

    $BOT = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$bid'");
    while($BOTD = mysql_fetch_array($BOT)){
    $player = $BOTD["bot_name"];
    $S = mysql_query("SELECT hp,team FROM bot_temp WHERE battle_id='$bid'");
    $D = mysql_fetch_array($S);
        if($D["team"]==1){
            if($D["hp"]>0){$team1_c++;}
        }
        else if($D["team"]==2){
            if($D["hp"]>0){$team2_c++;}
        }

    }

    if($team1_c == 0 AND $team2_c>0){
    $winer=2;
    $loser=1;
    $SS = mysql_query("UPDATE battles SET win='2',status='finished' WHERE id=$bid");
    }
    if($team2_c == 0 AND $team1_c>0){
    $winer=1;
    $loser=2;
    $SS = mysql_query("UPDATE battles SET win='1',status='finished' WHERE id=$bid");
    }
    if($team1_c == 0 AND $team2_c == 0){
    lose(1,$bid,1);
    lose(2,$bid,1);
    clearZayavka($creator,$bid);
    }

if($opponent == '' AND $b == 1){
    if($team == 1){
    $LIST = mysql_query("SELECT * FROM team2 WHERE battle_id = $creator");
    }
    else if($team == 2){
    $LIST = mysql_query("SELECT * FROM team1 WHERE battle_id = $creator");
    }
    $opp = array();
    $i=0;
    while($LIST_DATA = mysql_fetch_array($LIST)){
    $player = $LIST_DATA["player"];
    $PL_SQL = mysql_query("SELECT battle_opponent FROM characters WHERE login = '$player'");
    $PL_DATA = mysql_fetch_array($PL_SQL);
        if($PL_DATA["battle_opponent"]==''){
        $opp[$i] = $player;
        $i++;
        }
    }
    $j = count($opp);
    $BOT_LIST = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$bid'");
    while($BLD = mysql_fetch_array($BOT_LIST)){
        if($team == 1){
            if($BLD["team"]==2 AND $BLD["hp"]>0){
            $opp[$j] = $BLD["bot_name"];
            $j++;
            }
        }
        else if($team == 2){
            if($BLD["team"]==1 AND $BLD["hp"]>0){
            $opp[$j] = $BLD["bot_name"];
            $j++;
            }
        }
    }

$c = count($opp);
$set_opp = $opp[rand(0,count($opp)-1)];

$U_UPDATE = mysql_query("UPDATE characters SET battle_opponent='$set_opp' WHERE login='$login'");
$OPP_UPDATE = mysql_query("UPDATE characters SET battle_opponent='$login' WHERE login='$set_opp'");

}


if($act == "hit"){
$i = 0;
$p1_set = 0;
$p2_set = 0;

$weapons = array('axe','fail','knife','sword','staff','shot');

$hand_r_s = mysql_query("SELECT object_type FROM inv WHERE id='".$db["hand_r"]."'");
$hand_r_d = mysql_fetch_array($hand_r_s);
$hand_r_type = $hand_r_d["object_type"];

$hand_l_s = mysql_query("SELECT object_type FROM inv WHERE id='".$db["hand_l"]."'");
$hand_l_d = mysql_fetch_array($hand_l_s);
$hand_l_type = $hand_l_d["object_type"];

$hand_r_weapon = false;
$hand_l_weapon = false;
$two_hands     = false;

    for($n=0;$n<count($weapons);$n++){
         if($hand_r_type == $weapons[$n]){
         $hand_r_weapon = true;
        }
        if($hand_l_type == $weapons[$n]){
         $hand_l_weapon = true;
        }
    }

    if($hand_r_weapon == true && $hand_l_weapon == true){
     $two_hands = true;
    }

if($block==1){$D1=1;}
if($block==2){$D2=2;}
if($block==3){$D3=3;}
if($block==4){$D4=4;}
if($block==5){$D5=5;}

    if(!empty($D1)){
    $i++;
    $point1 = 1;
    $p1_set = 1;
    $p2_set = 0;
            if($p1_set == 0){
        $point1 = 2;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=2){
        $point2 = 2;
        $p2_set = 1;
        }
    }
    if(!empty($D2)){
    $i++;
        if($p1_set == 0){
        $point1 = 2;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=2){
        $point2 = 2;
        $p2_set = 1;
        }
            if($p1_set == 0){
        $point1 = 3;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=3){
        $point2 = 3;
        $p2_set = 1;
        }
    }
    if(!empty($D3)){
    $i++;
    if($p1_set == 0){
        $point1 = 3;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=3){
        $point2 = 3;
        $p2_set = 1;
        }
                if($p1_set == 0){
        $point1 = 4;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=4){
        $point2 = 4;
        $p2_set = 1;
        }
    }
    if(!empty($D4)){
    $i++;
        if($p1_set == 0){
        $point1 = 4;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=4){
        $point2 = 4;
        $p2_set = 1;
        }
                if($p1_set == 0){
        $point1 = 5;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=5){
        $point2 = 4;
        $p2_set = 1;
        }
    }
        if(!empty($D5)){
    $i++;
        if($p1_set == 0){
        $point1 = 5;
        $p1_set = 1;
        }
        if($p2_set == 0 && $point1!=5){
        $point2 = 4;
        $p2_set = 1;
        }
                if($p1_set == 0){
        $point1 = 2;
        $p1_set = 1;
        }
    }


    if($i>1){
      print "<center><B>Вы выбрали слишком много($i) зон блока! Надо выбрать одну!</B></center>";
    }
    if($i==0){
      print "<center><B>Вы не выбрали блок!</B></center>";
    }
    else if($i==1 && !empty($hit) && !$two_hands){
      hit($login,$opponent,$hit,0,$point1,$point2);
    }
    else if($i==1 && empty($hit) && !$two_hands){
     print "<center><b>Вы не выбрали удар!</B></center>";
    }
    else if($two_hands){

      if(empty($udar) or empty($udar2)){
      print "<center><B>Надо выбрать две точки удара!</B></center>";
    }
    else{
      if (!ereg("[0-9]",$udar) or !ereg("[0-9]",$udar2)) {print "?!"; exit();}
      hit($login,$opponent,$udar,$udar2,$point1,$point2);
    }

    }
}

$B = mysql_query("SELECT * FROM battles WHERE id=$bid");
$B_DATA = mysql_fetch_array($B);
$status = $B_DATA["status"];

?>
<body topMargin=0 leftMargin=0 rightMargin=0 bottomMargin=0 bgcolor=#dedede>

<script>

function to(name){
var s=top.talk.talker.phrase.value+="to ["+name+"]";
top.talk.talker.phrase.focus();
}
</script>
<script>
function private(name){
var s=top.talk.talker.phrase.value+="private ["+name+"]";
top.talk.talker.phrase.focus();
}
</script>

<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0>
 <TR>
  <TD WIDTH=210 VALIGN=TOP ALIGN=LEFT>
  <?
  showHPMP($login);
  showPlayer($login);
  ?>
  </TD>
  <td width=5><img src="im/spacer.gif" width=5></td>
  <TD VALIGN=TOP>
  <?
  if($winer!=0 AND $loser!=0){
    $b = 0;
  }

     if($b == 1){
      showHeader($login);
      }


    if($act == "magic"){
    $GET_DAT = mysql_query("SELECT * FROM inv WHERE id='$scroll' AND owner='$login'");
    $SCROLL = mysql_fetch_array($GET_DAT);
    $obj_id = $SCROLL["object_id"];
    $GET_SCROLL = mysql_query("SELECT * FROM scroll WHERE id='$obj_id'");
    $SCROLL_DATA = mysql_fetch_array($GET_SCROLL);
    $name = $SCROLL_DATA["name"];
    $min_v = $SCROLL_DATA["min_wis"];
    $min_i = $SCROLL_DATA["min_int"];
    $min_l = $SCROLL_DATA["min_level"];
    $tear_max = $SCROLL_DATA["tear_max"];
    $iznos = $SCROLL["iznos"];
    $orden = $SCROLL_DATA["orden"];
    $mp = $SCROLL_DATA["mp"];
    $school = $SCROLL_DATA["school"];
    $file = $SCROLL_DATA["file"];

    if($min_i == ''){$min_i=0;}
    if(!empty($orden)){
        if($orden == $db["orden"]){
        $ordens = 1;
        }
        else{
        $ordens = 0;
        }
    }
    else{
    $ordens = 1;
    }

    if($db["int"]>=$min_i && $db["wis"]>=$min_v && $db["level"]>=$min_l && $ordens == 1 && $db["mp"]>=$mp){

    $cast_d = $db["cast"];

    $cast = floor(($cast_d/100 + 1)*70.9);

    $cast_suc=array();
    for($i=0;$i<=$cast;$i++){
    $cast_suc[$i]=$i;
    }
    for($i=$cast+1;$i<=100;$i++){
    $cast_suc[$i]="empty";
    }

    $cast_numer=rand(0,100);

    $is_cast="0";
    for($i=0;$i<=100;$i++){
        if($cast_numer==$cast_suc[$i]){
        $is_cast="1";
        }
    }

        if($is_cast == "0"){
        print "<br>Вам неудалось прокастовать это заклинание!<BR>";
        print "<a href='?act=showMagic' class=us2>вернуться</a>";
        $S = mysql_query("UPDATE inv SET iznos = iznos+1 WHERE id=$scroll");
        $S_INV = mysql_query("SELECT * FROM inv WHERE id = $scroll");
        $DAT = mysql_fetch_array($S_INV);
        $iznos = $DAT["iznos"];
        $tear_max = $DAT["tear_max"];
        $iznos_k = $iznos+1;
        if($iznos_k>=$tear_max){
        $S_D = mysql_query("DELETE FROM inv WHERE id = $scroll");
        }
        $SQL = mysql_query("UPDATE characters SET cast = cast+0.1 WHERE login='$login'");
        }
        else{
        include "magic/$file";
        }
        }
    else{
    print "<BR>У Вас недостаточно параметров для кастования этого заклятия!<BR>";
    print "<a href='?act=showMagic' class=us2>вернуться</a>";
    }
    }



  if($db["hp"]<=0 AND $b == 1){
  print "</center>Для вас бой окончен. Ожидаем окончания поединка...<BR>";
  print "<center><input type=button value='Обновить' class=ad onClick=\"location.href='battle.php'\"></center>";
  }
  else{


      if($opponent!='' AND $b == 1){
        if(empty($act) OR $act == "none" OR $act == "hit"){
          genForm($login);

        }

        else if($act == "showMagic" AND $db["level"]>0){
          genMagicForm($login);
        }
        else if($act == "tech" AND $db["level"]>0){
          genTechForm($login);
        }




      }

      else{
      $GET_TIMEOUT = mysql_query("SELECT lasthit FROM timeout WHERE battle_id='$bid'");
      $T_D = mysql_fetch_array($GET_TIMEOUT);
      $lasthit = $T_D["lasthit"];
      $SEEK_T = mysql_query("SELECT timeout FROM zayavka WHERE creator = '$creator'");
      $SEEK_TD = mysql_fetch_array($SEEK_T);
      $to = $SEEK_TD["timeout"]*60;
      $timeout = $lasthit+$to - time();
      $minutes_l = floor($timeout/60);
      $seconds_l = $timeout - $minutes_l*60;

      print "<center><img border=0 src=img/line2.gif width=360 height=10></center>";


      if($winer!=0 AND $loser!=0){
            if($team == $winer){
            print "</center><center>Поздравляем! Вы победили!<br>";
            print "<input type=button value='Вернуться' class=but onClick=\"location.href='battle.php?act=exit'\"></center>";
            $b = 0;
            }
            else{
            print "</center><center>К сожалению вы проиграли!<BR>";
            print "<input type=button value='Вернуться' class=but onClick=\"location.href='battle.php?act=exit'\"></center>";
            $b = 0;
            }
      }

        if($timeout > 0 AND $b == 1){
        print "</center>Ожидаем хода противника... До таймаута осталось<font color=#333399><B> $minutes_l мин. $seconds_l сек.</B></font><BR>";
        print "<center><input type=button value='Обновить' class=ad onClick=\"location.href='battle.php'\"></center>";

        }
        if($timeout < 0 AND $b == 1){
        print "</center>Таймаут:<BR>";
          print "<center><input type=button value='Обновить' class=ad onClick=\"location.href='battle.php'\"></center>";
          print "<center><input type=button value='Победа' class=ad onClick=\"location.href='battle.php?act=t_win'\"></center>";
        }
        print "<center><img border=0 src=img/line2.gif width=360 height=10>";
      }
  }
  print "</center>";
  $dis_file = file("logs/$bid.dis");
  $dis = explode("<BR>",$dis_file[0]);
  $c = count($dis)-1;
  if($c>30){$b = $c; $e = $c-30; $l = 1;}
  else{$b = $c; $e = 0; $l = 0;}
    for($i = $b;$i >= $e;$i--){
    print "$dis[$i]<BR>";
    }
    if($l == 1){
    print "<br><I>Вырезано для уменьшения объема. Полный лог боя <a href='log.php?log=$bid' class=us2 target=_newlog>здесь.</a></I><BR>";
    }
    if($team == 1){
    $P_HIT = mysql_query("SELECT * FROM team1 WHERE battle_id='$creator' AND player='$login'");
    }
    else if($team == 2){
    $P_HIT = mysql_query("SELECT * FROM team2 WHERE battle_id='$creator' AND player='$login'");
    }
  $P_HDATA = mysql_fetch_array($P_HIT);
  $hitted = $P_HDATA["hitted"];
  print "<center><img border=0 src=img/line2.gif width=360 height=10>";
  print "</center>Всего Вами нанесено урона: <B>$hitted</B>.";
  if($hitted==''){
    $UP = mysql_query("UPDATE characters SET battle='0' WHERE login='$login'");
    if($team == 1){
    $CZ = mysql_query("UPDATE team1 SET over='1' WHERE player='$login'");
    }
    if($team == 2){
    $CZ = mysql_query("UPDATE team2 SET over='1' WHERE player='$login'");
    }
    clearZayavka($creator,$bid);
    print "<script>location.href='main.php?act=none'</script>";
    die();
  }
  ?>
  </TD>
  <td width=5><img src="im/spacer.gif" width=5></td>
  <TD WIDTH=210 VALIGN=TOP ALIGN=LEFT>
  <?
  if($opponent!='' AND $db["hp"]>0){
  $bot = 0;
    $BOT_L = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$bid'");
    while($BOT_D = mysql_fetch_array($BOT_L)){
        if($BOT_D["bot_name"] == $opponent){
        $bot = 1;
        $prototype = $BOT_D["prototype"];
        }
    }

    if($bot == 0){
      showHPMPop($opponent);
      showPlayer($opponent);
    }
    else if($bot == 1){
    showHPMPBot($opponent,$bid);
    showPlayer($prototype);
    }
  }
  else{
  $num = rand(1,21);
  print "<img src=\"img/battle/$num.jpg\"  alt=\"Ожидаем хода противника...\">";
  }


  ?>
  </TD>
 </TR>
</TABLE>