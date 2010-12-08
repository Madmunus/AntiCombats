<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>



<SCRIPT LANGUAGE="JavaScript" SRC="scripts/magic-main.js"></SCRIPT>
  <div id=hint4></div>



<?

include "conf.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);

mysql_query("SET CHARSET cp1251");


$money1=$db["money"];
$money = sprintf ("%01.2f", $money1);
?>

<body bgcolor="#E5D18C">

<table cellpadding="0" cellspacing="0" width="100%">

<td align="right"><b>У вас с собой:<?echo $money;?></B> кр.</td>
</table>

<table cellpadding="0" cellspacing="0" width="100%" height=100%>
<tr>

<td align="center" valign="top" bgcolor="#E5D18C" >

<table cellpadding="0" cellspacing="0" border="0" width=100%>
<tr height=47px>
<td width="20px" background="img/index/il.jpg" style="background-position:left top;"></td>
<td background="img/index/ibg.jpg" width="*" style="background-position:top;" valign="top">

<table cellpadding="0" cellspacing="0" border="0" width=100% height=35px><td valign="bottom">
<b><font color="#ffffff"><center>Комиссионный магазин</center></font></b>
</td></table>

</td>
<td width="19px" background="img/index/ir.jpg" style="background-position:right top;"></td>
</tr>
<tr >
<td width="20px" background="img/index/t4.jpg"></td>
<td style="BACKGROUND-COLOR: #E5D18C;">


<center>

<table width="100%" cellspacing="0" border="0" cellpadding="0" bgcolor="#E5D18C" >
<?
$bgcolor="#EEEEEE";
if(empty($type)){$type='sword';}
if(empty($act)){$act="";}
if(empty($deist)){$deist="";}
if($deist=="zabrat"){
if($do==2 and $ids!="" and $price!="")
{


$result=mysql_query("SELECT
            id,object_type,object_id
            FROM comok
            WHERE owner='$login' and id='$ids'");
while($datas = mysql_fetch_array($result))
{
$obj_id=$datas["object_id"];
$obj_type=$datas["object_type"];
$q2="SELECT name,price FROM $obj_type WHERE id='$obj_id'";
 $ress=mysql_query($q2);
$g_price=mysql_fetch_array($ress);
$gos_price=sprintf ("%01.2f", $g_price["price"]);
if(0.4*$gos_price>$price){
print "<tr><td align=center colspan=4><font color='#990000'><b>мы не принимаем вещи дешевле чем за 40 процентов от гос. цены<br>
      Гос. цена &laquo; ".$g_price["name"]." &raquo; составляет $gos_price кредитов <br>
      В то время как вы указали $price кредитов</b></font></td></tr>
      ";
}elseif($db["money"]<1){ print "<tr><td align=center colspan=4><font color='#990000'>У вас недостаточно средств для того чтобы изменить цену \" ".$obj["name"]." \"</td></tr>";}
else{
$INS = mysql_query("UPDATE `comok` SET price='$price' WHERE owner='$login' and id='$ids'");

               if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                }
                       else
                {
                        $ip=getenv('REMOTE_ADDR');
                }
$name2=$g_price["name"]."(1 кр)";
history($login,'сменил цену',$name2,$ip,'комиссионный магазин');

$s2=mysql_query("UPDATE characters SET money=money-'1' WHERE login='$login'");
print "<tr><td align=center colspan=4><font color='#990000'><b>Вы удачно изменили цену на &laquo; ".$g_price["name"]." &raquo; <br> и заплатили за это 1 кр.</b></font></td></tr>";
}

}

}
if($do==3 and $ids!="")
{

$result=mysql_query("SELECT
            *
            FROM comok
            WHERE owner='$login' and id='$ids'");
while($to_inv = mysql_fetch_array($result))
{
$obj_id=$to_inv["object_id"];
$obj_type=$to_inv["object_type"];
$q2="SELECT name FROM $obj_type WHERE id='$obj_id'";
$ress=mysql_query($q2);
$obj=mysql_fetch_array($ress);
if($db["money"]>="1"){
$INS = mysql_query("INSERT INTO `inv`(owner,object_id,object_type,object_razdel,iznos,tear_max,term,is_modified) VALUES ('".$_SESSION["login"]."','".$to_inv["object_id"]."','".$to_inv["object_type"]."','".$to_inv["object_razdel"]."','".$to_inv["iznos"]."','".$to_inv["tear_max"]."','".$to_inv["term"]."','".$to_inv["is_modified"]."')");
$DEl = mysql_query("DELETE FROM `comok` WHERE id = '$ids'");
$s2=mysql_query("UPDATE characters SET money=money-'1' WHERE login='$login'");
               if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                }
                       else
                {
                        $ip=getenv('REMOTE_ADDR');
                }
$name2=$obj["name"]."(1 кр)";
history($login,'забрал',$name2,$ip,'комиссионный магазин');
print "<tr><td align=center colspan=4><font color='#990000'><b>Вы удачно забрали &laquo; ".$obj["name"]." &raquo; из комиссионного магазина и заплатили за это 1 кр.<br></b></font></td></tr>";
    }else{ print "<tr><td align=center colspan=4><font color='#990000'>У вас недостаточно средств для того чтобы забрать ".$obj["name"]."</td></tr>";}
     }
}

$res1=mysql_query("SELECT
            id,object_type,object_id,price
            FROM comok
            WHERE owner='$login'");
$count="0";
$price_all="0";
$price_all_gos="0";
while($count_obj = mysql_fetch_array($res1)){
$count=$count+1;
$price_all=$price_all+$count_obj["price"];
$obj_id=$count_obj["object_id"];
$obj_type=$count_obj["object_type"];
$q2="SELECT price FROM $obj_type WHERE id=$obj_id";
$s2=mysql_query($q2);
$price_c=mysql_fetch_array($s2);
$price_all_gos=$price_all_gos+$price_c["price"];
 }
 if($count=="0"){$cmsg="<center><b>Ваших вещей в магазине нет</b></center>";}else{$cmsg="<center><b>Ваши вещи в магазине:</b></center>";}
print " <tr><td colspan=4><b>
<center>Внимание ! <br />
Если вы забираете предмет из комиссионного магазина, то с вас снимается 1 кр. за хранение
<br />
За смену цены предмета  с вас снимается 1 кр, услуга платная.
</b></center>
<br /><table width=100%><td align=center valign=middle>
<h4><br /><font color='#aa0000'>$cmsg</font> </h4>
</td><td width=250px>
Всего ваших вещей: <b>$count</b>
<br />На сумму <b>$price_all кр.</b>
<br />Реальная стоимость вещей <b>$price_all_gos кр.</b>
</td></table>

</td></tr>
";
$result=mysql_query("SELECT * FROM comok WHERE owner='$login'");

while($data = mysql_fetch_array($result)){
$item_id=$data["id"];
$obj_id=$data["object_id"];
$obj_type=$data["object_type"];
$obj_section=$data["object_razdel"];
$owner=$data["owner"];
$iznos=$data["iznos"];
$tear_max=$data["tear_max"];

$q2="SELECT * FROM $obj_type WHERE id=$obj_id";
$r2=mysql_query($q2);
$dat=mysql_fetch_array($r2);
$name=$dat["name"];
$name=str_replace(" ","&nbsp;",$name);
$img=$dat["img"];
$is_artefact=$dat["is_artefact"];
$mass = $dat["mass"];
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
$need_orden=$dat["orden"];
$add_speed=$dat["add_speed"];
$sex = $dat["sex"];
                $desc = $dat["desc"];
                $type = $dat["type"];
                $mp = $dat["mp"];

  if($obj_type == "book"){
        $add_i=$dat["add_int"];
        $add_mp=$dat["add_mp"];
        $add_water=$dat["add_water"];
        $add_earth=$dat["add_earth"];
        $add_fire=$dat["add_fire"];
        $add_air=$dat["add_air"];
        $pages=$dat["pages"];
    }
    if($obj_type == "scroll"){
        $vstr = $dat["to_book"];
        $need_mn = $dat["mp"];
        $school = $dat["school"];
        if($school == "air"){$school_d = "Воздух";}
        if($school == "water"){$school_d = "Вода";}
        if($school == "fire"){$school_d = "Огонь";}
        if($school == "earth"){$school_d = "Земля";}
     }

$price_gos1=$data["price"];
$price_gos = sprintf ("%01.2f", $price_gos1);
$min_iznos=$dat["iznos_min"];
$max_iznos=$dat["tear_max"];
if($dat["type"]=="two_hand"){
        $min_s2=$dat["min_str2"];
        $min_l2=$dat["min_dex2"];
        $min_u2=$dat["min_con2"];
        $min_p2=$dat["min_vit2"];
        $min_i2=$dat["min_int2"];
        $min_v2=$dat["min_wis2"];
        $min_level2=$dat["min_level2"];
      }
$add_i=$dat["add_int"];
$add_mp=$dat["add_mp"];
$addshot=$dat["shot"];
$p_a=$dat["bron_arm"];
$add_velocity=$dat["add_velocity"];
$add_arm_l=$dat["add_arm_l"];
$add_arm_m=$dat["add_arm_m"];
$add_arm_h=$dat["add_arm_h"];
$add_fire=$dat["add_fire"];
$add_water=$dat["add_water"];
$add_air=$dat["add_air"];
$add_earth=$dat["add_earth"];
$add_cast=$dat["add_cast"];
$add_trade=$dat["add_trade"];
$add_cure=$dat["add_cure"];
$add_walk=$dat["add_walk"];
$th = 0;
        if($dat["type"]=="two_hand"){
        $th = 1;
        }
$d=$db;
$my_orden=$d["orden"];
if($need_orden==''){$need_orden=0;}
if($my_orden==''){$my_orden=0;}
if(!empty($obj_id)){
if ($bgcolor=="#EEEEEE"){$bgcolor="#cccccc";}elseif($bgcolor=="#cccccc"){$bgcolor="#EEEEEE";}

print"<tr>
      <td rowspan=2 valign=middle bgcolor=$bgcolor class=us2 width=120px align=center
      style=\"border:1px solid #999999;border-bottom:none\">";
print "<img src='img/$img' alt='$name'><br />";

print "<a style=\"cursor:hand\" onclick=\"bMag('Сменить цену :', '?deist=zabrat&ids=$item_id&do=2', 'price', '','0','2', '$name ($iznos/$tear_max)')\" title='Изменить цену.' class=us2>сменить цену</a><br />";
print "<a style=\"cursor:hand\" href=\"?deist=zabrat&ids=$item_id&do=3\" title='Забрать вещи.' class=us2>Забрать</a></center>";




print "</td>";
print"<td colspan='3'  bgcolor=$bgcolor class=us2 valign=middle style=\"border: 1px solid #999999;border-left:none\" ><span class=usuallyb>";

print "&nbsp;<B>$name</B>";

if($need_orden!=0){
if($need_orden==1){$orden_dis="Орден темплиеров";}
if($need_orden==2){$orden_dis="Орден некромантов";}
if($need_orden==3){$orden_dis="Орден фениксов";}
if($need_orden==4){$orden_dis="Орден друидов";}
if($need_orden==5){$orden_dis="Тюремный заключенный";}
print "<img src='img/orden/$need_orden.gif' border=0 alt='Требуемый орден:\n$orden_dis'>";
                    }
if($is_artefact==1){
        print "<img src='img/icon/artefakt.gif' width=20 height=16 border=0 alt='Артефактная вещь'>&nbsp&nbsp";}
		$wearable=0;
print " (Масса: $mass ед.)<BR>";
print "<table cellpadding=0 cellspacing=0 width=100%><td width=160px><span class=usuallyb>&nbsp;<b>";
print "<b>Цена</b>: <b>$price_gos</b> кр.<BR>";

print "<td><span class=usuallyb><b>";
if($data["object_type"]=="scroll"){print "Использований ";}else{print "Износ ";}
if($iznos > ($max_iznos*8/10)){
print "<font color=red>$iznos</font>/$max_iznos<BR>";
}else{
print "$iznos/$max_iznos<BR>";
}
print"</b></td></table>";
print"</td></tr><tr>";
print "<td valign=top width=5px bgcolor=$bgcolor class=us2  style=\"border: none\"></td>";
print "<td valign=top width=160px bgcolor=$bgcolor class=us2  style=\"border: none;\"><span class=usuallyb><font face=\"Tahoma\">";


print "<b>Требуется минимум:</b><BR>";
if($min_s>0){if($min_s>$db["str"]){$min_s="<font color=#D50000><b>$min_s</b></font>";}
print "<li>Сила: <b>$min_s</b>";
if($th == 1 && $min_s2>0){
                if($db["str"]>=$min_s2){
                print " [<b>$min_s2</b>]";
                }else{
                print " [<font color=#D50000><b>$min_s2</b></font>]";}
                }
print "<BR>";}
if($min_l>0){
if($min_l>$db["dex"]){$min_l="<font color=#D50000><b>$min_l</b></font>";}
print "<li>Реакция: <b>$min_l</b>";
        if($th == 1 && $min_l2>0){
                if($db["dex"]>=$min_l2){
                print " [<b>$min_l2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_l2</b></font>]";
                }
        }
print "<BR>";
}
if($min_u>0){
if($min_u>$db["con"]){$min_u="<font color=#D50000><b>$min_u</b></font>";}
print "<li>Удача: <b>$min_u</b>";
        if($th == 1 && $min_u2>0){
                if($db["con"]>=$min_u2){
                print " [<b>$min_u2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_u2</b></font>]";
                }
        }
print "<BR>";
}

if($min_p>0){
if($min_p>$db["vit"]){$min_p="<font color=#D50000><b>$min_p</b></font>";}
print "<li>Выносливость: <b>$min_p</b>";
        if($th == 1 && $min_p2>0){
                if($db["vit"]>=$min_p2){
                print " [<b>$min_p2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_p2</b></font>]";
                }
        }
print "<BR>";
}

if($min_i>0){
if($min_i>$db["int"]){
$min_i="<font color=#D50000><b>$min_i</b></font>";
}
print "<li>Интеллект: <b>$min_i</b>";
        if($th == 1 && $min_i2>0){
                if($db["int"]>=$min_i2){
                print " [<b>$min_i2</b>]";
                }else{
               print " [<font color=#D50000><b>$min_i2</b></font>]";
                }
        }
print "<BR>";
}


if($min_v>0){
if($min_v>$db["wis"]){
$min_v="<font color=#D50000>$min_v</font>";
}
print "<li>Воссприятие: <b>$min_v</b>";
        if($th == 1 && $min_v2>0){
                if($db["wis"]>=$min_v2){
                print " [<b>$min_v2</b>]";
                }else{
                print " [<font color=#D50000><b>$min_v2</b></font>]";
                }
        }
print "<BR>";
}

if($min_level>$db["level"]){
$min_level="<font color=#D50000><b>$min_level</b></font>";
}

print "<li>Уровень: <b>$min_level</b>";
           if($th == 1 && $min_level2>0){
                if($db["level"]>=$min_level2){
                print " [<b>$min_level2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_level2</b></font>]";
                }
        }
if(!empty($sex)){
         if($sex == "female" && $sex!=$db["sex"]){$req_sex = "<font color=#D50000>женский</font>";}
    else if($sex == "female" && $sex==$db["sex"]){$req_sex = "<font color=#009900>женский</font>";}
    else if($sex == "male" && $sex==$db["sex"]){$req_sex = "<font color=#009900>мужской</font>";}
    else if($sex == "male" && $sex!=$db["sex"]){$req_sex = "<font color=#D50000>мужской</font>";}
         print "<BR><li>Пол: <b>$req_sex</b><BR>";
}
print "<BR>";
print "</td><td width=* bgcolor=$bgcolor class=us2 valign=top style=\"border-top: none; border-right: 1px solid #999999; border-bottom: none; border-left: none;\"><span class=usuallyb>";




print "<font face=\"Tahoma\"><b>Свойства:</b><BR>";
if($th==1){print "<b>Двуручное оружие</b><BR>";}
if ($dat["desc"]!=""){print $dat["desc"];print "<br />";}
if($data["object_type"] == "scroll"){
print "<li>Стихия: <B>$school_d</B><BR>";
print "<li>Исп. маны: <B>$need_mn</B><BR>";
if($vstr>0){
print "<li><b>Записываемый в книгу.</b><BR>";
}
}
if($data["object_type"] == "book"){
if($add_i>0){
print "<li>Интеллект:<b>+$add_i</b><BR>";
}
else if($add_i<0){
print "<li>Интеллект: <font color=#D50000><b>$add_i</b></font><BR>";
}
if($add_mp>0){
print "<li>Уровень маны: <b>+$add_mp</b><BR>";
}
else if($add_mp<0){
print "<li>Уровень маны: <font color=#D50000><b>$add_mp</b></font><BR>";
}
if($add_water>0){
print "<li>Магия воды: <b>+$add_water</b><BR>";
}
if($add_earth>0){
print "<li>Магия земли:<b>+$add_earth</b><BR>";
}
if($add_fire>0){
print "<li>Магия огня: <b>+$add_fire</b><BR>";
}
if($add_air>0){
print "<li>Магия воздуха: <b>+$add_air</b><BR>";
}
if($pages>0){
print "<li>Страниц: <b>$pages</b><BR>";
}
}
if($data["object_type"] != "book" and $data["object_type"] != "scroll"){
if($min_a>0){print "<li>Мин. удар: <b>$min_a</b><BR>";}
if($max_a>0){print "<li>Макс. удар: <b>$max_a</b><BR>";}
if($add_s>0){print "<li>Сила: <b>+$add_s</b><BR>";}
elseif($add_s<0){print "<li>Сила: <font color=#D50000><b>$add_s</b></font><BR>";}
if($add_l>0){print "<li>Ловкость: <b>+$add_l</b><BR>";}
elseif($add_l<0){print "<li>Ловкость: <font color=#D50000><b>$add_l</b></font><BR>";}
if($add_u>0){print "<li>Удача: <b>+$add_u</b><BR>";}
elseif($add_u<0){print "<li>Удача: <font color=#D50000><b>$add_u</b></font><BR>";}
if($add_i>0){print "<li>Интеллект: <b>+$add_i</b><BR>";}
elseif($add_i<0){print "<li>Интеллект: <font color=#D50000><b>$add_i</b></font><BR>";}
if($mf_crit>0){print "<li>Мф. крит. удара: <b>+$mf_crit</b>%<BR>";}
elseif($mf_crit<0){print "<li>Мф. крит. удара: <font color=#D50000><b>$mf_crit%</b></font><BR>";}
if($mf_anticrit>0){print "<li>Мф. антикрит: <b>+$mf_anticrit</b>%<BR>";}
elseif($mf_anticrit<0){print "<li>Мф. антикрит: <font color=#D50000>$mf_anticrit</font>%<BR>";}
if($mf_uvorot>0){print "<li>Мф. уворота: <b>+$mf_uvorot</b>%<BR>";}
elseif($mf_uvorot<0){print "<li>Мф. уворота: <font color=#D50000><b>$mf_uvorot</b></font>%<BR>";}
if($mf_antiuvorot>0){print "<li>Мф. антиуворота: <b>+$mf_antiuvorot</b>%<BR>";}
elseif($mf_uvorot<0){print "<li>Мф. антиуворота: <font color=#D50000><b>$mf_antiuvorot</b><?font>%<BR>";}

if($add_hp>0){print "<li>Уровень HP: <b>+$add_hp</b><BR>";}
elseif($add_hp<0){print "<li>Уровень HP: <font color=#D50000><b>$add_hp</b></font><BR>";}
if($add_mp>0){print "<li>Уровень маны: <b>+$add_mp</b><BR>";}
elseif($add_mp<0){print "<li>Уровень маны: <font color=#D50000><b>$add_mp</b></font><BR>";}
if($addsword>0){print "<li>Владение мечами: <b>+$addsword</b>%<BR>";}
if($addaxe>0){print "<li>Владение топорами: <b>+$addaxe</b>%<BR>";}
if($addfail>0){print "<li>Владение дубинами: <b>+$addfail</b>%<BR>";}
if($addknife>0){print "<li>Владение ножами: <b>+$addknife</b>%<BR>";}
if($addstaff>0){print "<li>Владение копьями: <b>+$addstaff</b>%<BR>";}
if($addshot>0){print "<li>Владение луками: <b>+$addshot</b>%<BR>";}
if($add_speed>0){print "<li>Скорость: <B>+$add_speed</B> (км/ч)<BR>";}
if($add_speed<0){print "<li>Скорость: <font color=#D50000><B>$add_speed</B></font> (км/ч)<BR>";}
if($add_velocity>0){print "<li>Грузоподъемность: <B>+$add_velocity</B> (кг)<BR>";}
if($add_velocity<0){print "<li>Грузоподъемность: <font color=#D50000><B>$add_velocity</B></font> (кг)<BR>";}
if($p_h>0){print "<li>Броня головы: <b>$p_h</b><BR>";}
if($p_a>0){print "<li>Броня рук: <b>$p_a</b><BR>";}
if($p_c>0){print "<li>Броня корпуса: <b>$p_c</b><BR>";}
if($p_p>0){print "<li>Броня пояса: <b>$p_p</b><BR>";}
if($p_l>0){print "<li>Броня ног: <b>$p_l</b><BR>";}
if($add_arm_l>0){print "<li>Бездоспешный бой: <b>+$add_arm_l</b><BR>";}
if($add_arm_m>0){print "<li>Легкие доспехи: <b>+$add_arm_l</b><BR>";}
if($add_arm_h>0){print "<li>Тяжелые доспехи: <b>+$add_arm_h</b><BR>";}
if($add_fire>0) {print "<li>Стихия огня: <b>+$add_fire</b><BR>";}
if($add_water>0){print "<li>Стихия воды: <b>+$add_water</b><BR>";}
if($add_air>0)  {print "<li>Стихия воздуха: <b>+$add_air</b><BR>";}
if($add_earth>0){print "<li>Стихия земли: <b>+$add_earth</b><BR>";}
if($add_cast>0){print "<li>Кастование: <b>+$add_cast</b><BR>";}
if($add_trade>0){print "<li>Торговля: <b>+$add_trade</b><BR>";}
if($add_cure>0){print "<li>Исцеление: <b>+$add_cure</b><BR>";}
if($add_walk>0){print "<li>Походы: <b>+$add_walk</b><BR>";}
}
print "</span></td><td></td></tr>";

  }
  }


}
elseif($deist=="sdat"){
?>
<div align=center><b>Сдать вещи в магазин </b> <br />
При продаже вашей вещи взымается комиссия 10% от стоимости сделки, но не меньше 1 кр.<br />
Владелец магазина оставляет за собой право изменения процента комиссии без уведомления клиентов.</div>
<?

//сдать в комок


if($do=="1" and $ids!="" and $price!="")
{
$resu=mysql_query("SELECT * FROM inv WHERE owner='$login' and(object_razdel='obj' or object_razdel='magic' or object_razdel='amunition') and wear='0' and (gift='0' or gift='' or gift is null) and object_type<>'book' and id='$ids' ORDER BY date DESC");
while($to_comok = mysql_fetch_array($resu)){
$sql_price=mysql_query("SELECT name,price FROM ".$to_comok["object_type"]." WHERE id='".$to_comok["object_id"]."'");
$g_price=mysql_fetch_array($sql_price);
$gos_price=sprintf ("%01.2f", $g_price["price"]);
if(0.4*$gos_price>$price){
print "<tr><td align=center colspan=4><font color='#990000'><b>мы не принимаем вещи дешевле чем за 40 процентов от гос. цены<br>
      Гос. цена &laquo; ".$g_price["name"]." &raquo; составляет $gos_price кредитов <br>
      В то время как вы указали $price кредитов</b></font></td></tr>
      ";
}else{
$INS = mysql_query("INSERT INTO `comok`(owner,price,object_id,object_type,object_razdel,iznos,tear_max,term,is_modified) VALUES ('".$_SESSION["login"]."','".$price."','".$to_comok["object_id"]."','".$to_comok["object_type"]."','".$to_comok["object_razdel"]."','".$to_comok["iznos"]."','".$to_comok["tear_max"]."','".$to_comok["term"]."','".$to_comok["is_modified"]."')");
$DEl = mysql_query("DELETE FROM `inv` WHERE id = '$ids'");}
}
echo mysql_error();
}


// список вещей в инвентори
$result=mysql_query("SELECT id,object_type,object_razdel,object_id,owner,iznos,tear_max FROM inv WHERE owner='$login' and(object_razdel='obj' or object_razdel='magic' or object_razdel='amunition') and wear='0' and (gift='0' or gift='' or gift is null) and object_type<>'book' ORDER BY date DESC");
while($data = mysql_fetch_array($result)){
$item_id=$data["id"];
$obj_id=$data["object_id"];
$obj_type=$data["object_type"];
$obj_section=$data["object_razdel"];
$owner=$data["owner"];
$iznos=$data["iznos"];
$tear_max=$data["tear_max"];
$q2="SELECT * FROM $obj_type WHERE id=$obj_id";
$r2=mysql_query($q2);
$dat=mysql_fetch_array($r2);
$name=$dat["name"];
$name=str_replace(" ","&nbsp;",$name);
$img=$dat["img"];
$is_artefact=$dat["is_artefact"];
$mass = $dat["mass"];
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
$need_orden=$dat["orden"];
$add_speed=$dat["add_speed"];
$sex = $dat["sex"];
                $desc = $dat["desc"];
                $type = $dat["type"];
                $mp = $dat["mp"];

  if($obj_type == "book"){
        $add_i=$dat["add_int"];
        $add_mp=$dat["add_mp"];
        $add_water=$dat["add_water"];
        $add_earth=$dat["add_earth"];
        $add_fire=$dat["add_fire"];
        $add_air=$dat["add_air"];
        $pages=$dat["pages"];
    }
    if($obj_type == "scroll"){
        $vstr = $dat["to_book"];
        $need_mn = $dat["mp"];
        $school = $dat["school"];
        if($school == "air"){$school_d = "Воздух";}
        if($school == "water"){$school_d = "Вода";}
        if($school == "fire"){$school_d = "Огонь";}
        if($school == "earth"){$school_d = "Земля";}
     }

        $price_gos1=$dat["price"];
$price_gos = sprintf ("%01.2f", $price_gos1);
$min_iznos=$dat["iznos_min"];
$max_iznos=$dat["tear_max"];
if($dat["type"]=="two_hand"){
        $min_s2=$dat["min_str2"];
        $min_l2=$dat["min_dex2"];
        $min_u2=$dat["min_con2"];
        $min_p2=$dat["min_vit2"];
        $min_i2=$dat["min_int2"];
        $min_v2=$dat["min_wis2"];
        $min_level2=$dat["min_level2"];
      }
$add_i=$dat["add_int"];
$add_mp=$dat["add_mp"];
$addshot=$dat["shot"];
$p_a=$dat["bron_arm"];
$add_velocity=$dat["add_velocity"];
$add_arm_l=$dat["add_arm_l"];
$add_arm_m=$dat["add_arm_m"];
$add_arm_h=$dat["add_arm_h"];
$add_fire=$dat["add_fire"];
$add_water=$dat["add_water"];
$add_air=$dat["add_air"];
$add_earth=$dat["add_earth"];
$add_cast=$dat["add_cast"];
$add_trade=$dat["add_trade"];
$add_cure=$dat["add_cure"];
$add_walk=$dat["add_walk"];
$sex = $dat["sex"];
$th = 0;
        if($dat["type"]=="two_hand"){
        $th = 1;
        }
$d=$db;
$my_orden=$d["orden"];
if($need_orden==''){$need_orden=0;}
if($my_orden==''){$my_orden=0;}
if(!empty($obj_id)){

if ($bgcolor=="#EEEEEE"){$bgcolor="#cccccc";}elseif($bgcolor=="#cccccc"){$bgcolor="#EEEEEE";}

print"<tr>
      <td rowspan=2 valign=middle bgcolor=$bgcolor class=us2 width=90px align=center
      style=\"border:1px solid #999999;border-bottom:none\">";
print "<img src='img/$img' alt='$name'><br />";
print "<a style=\"cursor:hand\" onclick=\"bMag('Продать :', 'comok.php?deist=sdat&ids=$item_id', 'price', '','0','2', '$name ($iznos/$tear_max)')\" title='Сдать в магазин.' class=us2>Сдать в магазин</a></center>";
print "<a href='comok.php?deist=sdat&ids=$item_id' class=nick>продать</a>";



print "</td>";
print"<td colspan='3'  bgcolor=$bgcolor class=us2 valign=middle style=\"border: 1px solid #999999;border-left:none\" ><span class=usuallyb>";

print "&nbsp;<B>$name</B>";

if($need_orden!=0){
if($need_orden==1){$orden_dis="Орден темплиеров";}
if($need_orden==2){$orden_dis="Орден некромантов";}
if($need_orden==3){$orden_dis="Орден фениксов";}
if($need_orden==4){$orden_dis="Орден друидов";}
if($need_orden==5){$orden_dis="Тюремный заключенный";}
print "<img src='img/orden/$need_orden.gif' border=0 alt='Требуемый орден:\n$orden_dis'>";
                    }
if($is_artefact==1){
        print "<img src='img/icon/artefakt.gif' width=20 height=16 border=0 alt='Артефактная вещь'>&nbsp&nbsp";}
print " (Масса: $mass ед.)<BR>";
print "<table cellpadding=0 cellspacing=0 width=100%><td width=160px><span class=usuallyb>&nbsp;<b>";
print "<b>Цена</b>: <b>$price_gos</b> кр.<BR>";

print "<td><span class=usuallyb><b>";
if($data["object_type"]=="scroll"){print "Использований ";}else{print "Износ ";}
if($iznos > ($max_iznos*8/10)){
print "<font color=red>$iznos</font>/$max_iznos<BR>";
}else{
print "$iznos/$max_iznos<BR>";
}
print"</b></td></table>";
print"</td></tr><tr>";
print "<td valign=top width=5px bgcolor=$bgcolor class=us2  style=\"border: none\"></td>";
print "<td valign=top width=160px bgcolor=$bgcolor class=us2  style=\"border: none;\"><span class=usuallyb><font face=\"Tahoma\">";


print "<b>Требуется минимум:</b><BR>";
if($min_s>0){if($min_s>$db["str"]){$min_s="<font color=#D50000><b>$min_s</b></font>";}
print "<li>Сила: <b>$min_s</b>";
if($th == 1 && $min_s2>0){
                if($db["str"]>=$min_s2){
                print " [<b>$min_s2</b>]";
                }else{
                print " [<font color=#D50000><b>$min_s2</b></font>]";}
                }
print "<BR>";}
if($min_l>0){
if($min_l>$db["dex"]){$min_l="<font color=#D50000><b>$min_l</b></font>";}
print "<li>Реакция: <b>$min_l</b>";
        if($th == 1 && $min_l2>0){
                if($db["dex"]>=$min_l2){
                print " [<b>$min_l2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_l2</b></font>]";
                }
        }
print "<BR>";
}
if($min_u>0){
if($min_u>$db["con"]){$min_u="<font color=#D50000><b>$min_u</b></font>";}
print "<li>Удача: <b>$min_u</b>";
        if($th == 1 && $min_u2>0){
                if($db["con"]>=$min_u2){
                print " [<b>$min_u2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_u2</b></font>]";
                }
        }
print "<BR>";
}

if($min_p>0){
if($min_p>$db["vit"]){$min_p="<font color=#D50000><b>$min_p</b></font>";}
print "<li>Выносливость: <b>$min_p</b>";
        if($th == 1 && $min_p2>0){
                if($db["vit"]>=$min_p2){
                print " [<b>$min_p2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_p2</b></font>]";
                }
        }
print "<BR>";
}

if($min_i>0){
if($min_i>$db["int"]){
$min_i="<font color=#D50000><b>$min_i</b></font>";
}
print "<li>Интеллект: <b>$min_i</b>";
        if($th == 1 && $min_i2>0){
                if($db["int"]>=$min_i2){
                print " [<b>$min_i2</b>]";
                }else{
               print " [<font color=#D50000><b>$min_i2</b></font>]";
                }
        }
print "<BR>";
}


if($min_v>0){
if($min_v>$db["wis"]){
$min_v="<font color=#D50000>$min_v</font>";
}
print "<li>Воссприятие: <b>$min_v</b>";
        if($th == 1 && $min_v2>0){
                if($db["wis"]>=$min_v2){
                print " [<b>$min_v2</b>]";
                }else{
                print " [<font color=#D50000><b>$min_v2</b></font>]";
                }
        }
print "<BR>";
}

if($min_level>$db["level"]){
$min_level="<font color=#D50000><b>$min_level</b></font>";
}

print "<li>Уровень: <b>$min_level</b>";
           if($th == 1 && $min_level2>0){
                if($db["level"]>=$min_level2){
                print " [<b>$min_level2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_level2</b></font>]";
                }
        }
if(!empty($sex)){
         if($sex == "female" && $sex!=$db["sex"]){$req_sex = "<font color=#D50000>женский</font>";}
    else if($sex == "female" && $sex==$db["sex"]){$req_sex = "<font color=#009900>женский</font>";}
    else if($sex == "male" && $sex==$db["sex"]){$req_sex = "<font color=#009900>мужской</font>";}
    else if($sex == "male" && $sex!=$db["sex"]){$req_sex = "<font color=#D50000>мужской</font>";}
         print "<BR><li>Пол: <b>$req_sex</b><BR>";
}
print "<BR>";
print "</td><td width=* bgcolor=$bgcolor class=us2 valign=top style=\"border-top: none; border-right: 1px solid #999999; border-bottom: none; border-left: none;\"><span class=usuallyb>";




print "<font face=\"Tahoma\"><b>Свойства:</b><BR>";
if($th==1){print "<b>Двуручное оружие</b><BR>";}
if ($dat["desc"]!=""){print $dat["desc"];print "<br />";}
if($data["object_type"] == "scroll"){
print "<li>Стихия: <B>$school_d</B><BR>";
print "<li>Исп. маны: <B>$need_mn</B><BR>";
if($vstr>0){
print "<li><b>Записываемый в книгу.</b><BR>";
}
}
if($data["object_type"] == "book"){
if($add_i>0){
print "<li>Интеллект:<b>+$add_i</b><BR>";
}
else if($add_i<0){
print "<li>Интеллект: <font color=#D50000><b>$add_i</b></font><BR>";
}
if($add_mp>0){
print "<li>Уровень маны: <b>+$add_mp</b><BR>";
}
else if($add_mp<0){
print "<li>Уровень маны: <font color=#D50000><b>$add_mp</b></font><BR>";
}
if($add_water>0){
print "<li>Магия воды: <b>+$add_water</b><BR>";
}
if($add_earth>0){
print "<li>Магия земли:<b>+$add_earth</b><BR>";
}
if($add_fire>0){
print "<li>Магия огня: <b>+$add_fire</b><BR>";
}
if($add_air>0){
print "<li>Магия воздуха: <b>+$add_air</b><BR>";
}
if($pages>0){
print "<li>Страниц: <b>$pages</b><BR>";
}
}
if($data["object_type"] != "book" and $data["object_type"] != "scroll"){
if($min_a>0){print "<li>Мин. удар: <b>$min_a</b><BR>";}
if($max_a>0){print "<li>Макс. удар: <b>$max_a</b><BR>";}
if($add_s>0){print "<li>Сила: <b>+$add_s</b><BR>";}
elseif($add_s<0){print "<li>Сила: <font color=#D50000><b>$add_s</b></font><BR>";}
if($add_l>0){print "<li>Ловкость: <b>+$add_l</b><BR>";}
elseif($add_l<0){print "<li>Ловкость: <font color=#D50000><b>$add_l</b></font><BR>";}
if($add_u>0){print "<li>Удача: <b>+$add_u</b><BR>";}
elseif($add_u<0){print "<li>Удача: <font color=#D50000><b>$add_u</b></font><BR>";}
if($add_i>0){print "<li>Интеллект: <b>+$add_i</b><BR>";}
elseif($add_i<0){print "<li>Интеллект: <font color=#D50000><b>$add_i</b></font><BR>";}
if($mf_crit>0){print "<li>Мф. крит. удара: <b>+$mf_crit</b>%<BR>";}
elseif($mf_crit<0){print "<li>Мф. крит. удара: <font color=#D50000><b>$mf_crit%</b></font><BR>";}
if($mf_anticrit>0){print "<li>Мф. антикрит: <b>+$mf_anticrit</b>%<BR>";}
elseif($mf_anticrit<0){print "<li>Мф. антикрит: <font color=#D50000>$mf_anticrit</font>%<BR>";}
if($mf_uvorot>0){print "<li>Мф. уворота: <b>+$mf_uvorot</b>%<BR>";}
elseif($mf_uvorot<0){print "<li>Мф. уворота: <font color=#D50000><b>$mf_uvorot</b></font>%<BR>";}
if($mf_antiuvorot>0){print "<li>Мф. антиуворота: <b>+$mf_antiuvorot</b>%<BR>";}
elseif($mf_uvorot<0){print "<li>Мф. антиуворота: <font color=#D50000><b>$mf_antiuvorot</b><?font>%<BR>";}

if($add_hp>0){print "<li>Уровень HP: <b>+$add_hp</b><BR>";}
elseif($add_hp<0){print "<li>Уровень HP: <font color=#D50000><b>$add_hp</b></font><BR>";}
if($add_mp>0){print "<li>Уровень маны: <b>+$add_mp</b><BR>";}
elseif($add_mp<0){print "<li>Уровень маны: <font color=#D50000><b>$add_mp</b></font><BR>";}
if($addsword>0){print "<li>Владение мечами: <b>+$addsword</b>%<BR>";}
if($addaxe>0){print "<li>Владение топорами: <b>+$addaxe</b>%<BR>";}
if($addfail>0){print "<li>Владение дубинами: <b>+$addfail</b>%<BR>";}
if($addknife>0){print "<li>Владение ножами: <b>+$addknife</b>%<BR>";}
if($addstaff>0){print "<li>Владение копьями: <b>+$addstaff</b>%<BR>";}
if($addshot>0){print "<li>Владение луками: <b>+$addshot</b>%<BR>";}
if($add_speed>0){print "<li>Скорость: <B>+$add_speed</B> (км/ч)<BR>";}
if($add_speed<0){print "<li>Скорость: <font color=#D50000><B>$add_speed</B></font> (км/ч)<BR>";}
if($add_velocity>0){print "<li>Грузоподъемность: <B>+$add_velocity</B> (кг)<BR>";}
if($add_velocity<0){print "<li>Грузоподъемность: <font color=#D50000><B>$add_velocity</B></font> (кг)<BR>";}
if($p_h>0){print "<li>Броня головы: <b>$p_h</b><BR>";}
if($p_a>0){print "<li>Броня рук: <b>$p_a</b><BR>";}
if($p_c>0){print "<li>Броня корпуса: <b>$p_c</b><BR>";}
if($p_p>0){print "<li>Броня пояса: <b>$p_p</b><BR>";}
if($p_l>0){print "<li>Броня ног: <b>$p_l</b><BR>";}
if($add_arm_l>0){print "<li>Бездоспешный бой: <b>+$add_arm_l</b><BR>";}
if($add_arm_m>0){print "<li>Легкие доспехи: <b>+$add_arm_l</b><BR>";}
if($add_arm_h>0){print "<li>Тяжелые доспехи: <b>+$add_arm_h</b><BR>";}
if($add_fire>0) {print "<li>Стихия огня: <b>+$add_fire</b><BR>";}
if($add_water>0){print "<li>Стихия воды: <b>+$add_water</b><BR>";}
if($add_air>0)  {print "<li>Стихия воздуха: <b>+$add_air</b><BR>";}
if($add_earth>0){print "<li>Стихия земли: <b>+$add_earth</b><BR>";}
if($add_cast>0){print "<li>Кастование: <b>+$add_cast</b><BR>";}
if($add_trade>0){print "<li>Торговля: <b>+$add_trade</b><BR>";}
if($add_cure>0){print "<li>Исцеление: <b>+$add_cure</b><BR>";}
if($add_walk>0){print "<li>Походы: <b>+$add_walk</b><BR>";}
}
print "</span></td><td></td></tr>";
  }
  }

}elseif($type!="" and $set!=""){
//вывод витрины предметов
$sql="SELECT
        c.price as price_com,
        c.iznos as iznos_c_min,
        c.tear_max as iznos_c_max,
        c.id as comok_id,
        o.*
      FROM
        comok AS c
      LEFT JOIN $type AS o ON ( o.id = c.object_id )
      WHERE c.object_id='$set' and c.object_type = '$type'";
$comok_type_sql = mysql_query($sql);
while($dat = mysql_fetch_array($comok_type_sql)){
    $id=$dat["id"];
    $cid=$dat["comok_id"];
    $orden=$db["orden"];
    $name=$dat["name"];
    $img=$dat["img"];
    $mass=$dat["mass"];
    $price1=$dat["price_com"];
    $price = sprintf ("%01.2f", $price1);
    $min_s=$dat["min_str"];
    $min_l=$dat["min_dex"];
    $min_u=$dat["min_con"];
    $min_p=$dat["min_vit"];
    $min_i=$dat["min_int"];
    $min_v=$dat["min_wis"];
    $min_level=$dat["min_level"];
    $min_iznos=$dat["iznos_c_min"];
    $max_iznos=$dat["iznos_c_max"];
    $th = 0;
    if($dat["type"]=="two_hand"){
        $th = 1;
        $min_s2=$dat["min_str2"];
        $min_l2=$dat["min_dex2"];
        $min_u2=$dat["min_con2"];
        $min_p2=$dat["min_vit2"];
        $min_i2=$dat["min_int2"];
        $min_v2=$dat["min_wis2"];
        $min_level2=$dat["min_level2"];
        }
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
    $addshot=$dat["shot"];
    $p_h=$dat["def_head"];
    $p_a=$dat["bron_arm"];
    $p_c=$dat["def_corp"];
    $p_p=$dat["def_poyas"];
    $p_l=$dat["def_legs"];
    $mf_crit=$dat["mf_crit"];
    $mf_anticrit=$dat["mf_anticrit"];
    $mf_uvorot=$dat["mf_uvorot"];
    $mf_antiuvorot=$dat["mf_antiuvorot"];
    $min_a=$dat["min_attack"];
    $max_a=$dat["max_attack"];
    $need_orden=$dat["orden"];
    $add_speed=$dat["add_speed"];
    $add_velocity=$dat["add_velocity"];
    $add_arm_l=$dat["add_arm_l"];
    $add_arm_m=$dat["add_arm_m"];
    $add_arm_h=$dat["add_arm_h"];
    $add_fire=$dat["add_fire"];
    $add_water=$dat["add_water"];
    $add_air=$dat["add_air"];
    $add_earth=$dat["add_earth"];
    $add_cast=$dat["add_cast"];
    $add_trade=$dat["add_trade"];
    $add_cure=$dat["add_cure"];
    $add_walk=$dat["add_walk"];
    $sex = $dat["sex"];
    $is_artefact=$dat["is_artefact"];
    if($type == "book"){
        $add_i=$dat["add_int"];
        $add_mp=$dat["add_mp"];
        $add_water=$dat["add_water"];
        $add_earth=$dat["add_earth"];
        $add_fire=$dat["add_fire"];
        $add_air=$dat["add_air"];
        $pages=$dat["pages"];
    }
    if($type == "scroll"){
        $vstr = $dat["to_book"];
        $need_mn = $dat["mp"];
        $school = $dat["school"];
        if($school == "air"){$school_d = "Воздух";}
        if($school == "water"){$school_d = "Вода";}
        if($school == "fire"){$school_d = "Огонь";}
        if($school == "earth"){$school_d = "Земля";}
     }

if(!empty($name)){
if ($bgcolor=="#EEEEEE"){$bgcolor="#cccccc";}elseif($bgcolor=="#cccccc"){$bgcolor="#EEEEEE";}

print"<tr>
      <td rowspan=2 valign=middle bgcolor=$bgcolor class=us2 width=90px align=center
      style=\"border:1px solid #999999;border-bottom:none\">";
print "<img src='img/$img' alt='$name'><br />";
if($price1<=$db["money"]){print "<a href='?type=$type&item=$cid' class=us2>купить</a>";}
else{print "<small><B>нельзя купить</B></small>";}
print "</td>";
print"<td colspan='3'  bgcolor=$bgcolor class=us2 valign=middle style=\"border: 1px solid #999999;border-left:none\" ><span class=usuallyb>";

print "&nbsp;<B>$name</B>";

if($need_orden!=0){
if($need_orden==1){$orden_dis="Орден темплиеров";}
if($need_orden==2){$orden_dis="Орден некромантов";}
if($need_orden==3){$orden_dis="Орден фениксов";}
if($need_orden==4){$orden_dis="Орден друидов";}
if($need_orden==5){$orden_dis="Тюремный заключенный";}
print "<img src='img/orden/$need_orden.gif' border=0 alt='Требуемый орден:\n$orden_dis'>";
                    }
if($is_artefact==1){
        print "<img src='img/icon/artefakt.gif' width=20 height=16 border=0 alt='Артефактная вещь'>&nbsp&nbsp";}
print " (Масса: $mass ед.)<BR>";
print "<table cellpadding=0 cellspacing=0 width=100%><td width=160px><span class=usuallyb>&nbsp;<b>";
if($price>$db["money"]){
print "Цена: <font color=#990000>$price</font> кр. </b></td>";
}else{
print "Цена: $price кр. </b></td>";
}

print "<td><span class=usuallyb>&nbsp;";

if($type=="scroll"){print "Использований ";}else{print "Износ ";}
if($min_iznos > ($max_iznos*8/10)){
print "<font color=red>$min_iznos</font>/$max_iznos<BR>";
}else{
print "$min_iznos/$max_iznos<BR>";
}
      print"</td></table>";
print"</td></tr><tr>";
print "<td valign=top width=5px bgcolor=$bgcolor class=us2  style=\"border: none\"></td>";
print "<td valign=top width=160px bgcolor=$bgcolor class=us2  style=\"border: none;\"><span class=usuallyb><font face=\"Tahoma\">";

print "<b>Требуется минимум:</b><BR>";
if($min_s>0){if($min_s>$db["str"]){$min_s="<font color=#D50000><b>$min_s</b></font>";}
print "<li>Сила: <b>$min_s</b>";
if($th == 1 && $min_s2>0){
                if($db["str"]>=$min_s2){
                print " [<b>$min_s2</b>]";
                }else{
                print " [<font color=#D50000><b>$min_s2</b></font>]";}
                }
print "<BR>";}
if($min_l>0){
if($min_l>$db["dex"]){$min_l="<font color=#D50000><b>$min_l</b></font>";}
print "<li>Реакция: <b>$min_l</b>";
        if($th == 1 && $min_l2>0){
                if($db["dex"]>=$min_l2){
                print " [<b>$min_l2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_l2</b></font>]";
                }
        }
print "<BR>";
}
if($min_u>0){
if($min_u>$db["con"]){$min_u="<font color=#D50000><b>$min_u</b></font>";}
print "<li>Удача: <b>$min_u</b>";
        if($th == 1 && $min_u2>0){
                if($db["con"]>=$min_u2){
                print " [<b>$min_u2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_u2</b></font>]";
                }
        }
print "<BR>";
}

if($min_p>0){
if($min_p>$db["vit"]){$min_p="<font color=#D50000><b>$min_p</b></font>";}
print "<li>Выносливость: <b>$min_p</b>";
        if($th == 1 && $min_p2>0){
                if($db["vit"]>=$min_p2){
                print " [<b>$min_p2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_p2</b></font>]";
                }
        }
print "<BR>";
}

if($min_i>0){
if($min_i>$db["int"]){
$min_i="<font color=#D50000><b>$min_i</b></font>";
}
print "<li>Интеллект: <b>$min_i</b>";
        if($th == 1 && $min_i2>0){
                if($db["int"]>=$min_i2){
                print " [<b>$min_i2</b>]";
                }else{
               print " [<font color=#D50000><b>$min_i2</b></font>]";
                }
        }
print "<BR>";
}


if($min_v>0){
if($min_v>$db["wis"]){
$min_v="<font color=#D50000>$min_v</font>";
}
print "<li>Воссприятие: <b>$min_v</b>";
        if($th == 1 && $min_v2>0){
                if($db["wis"]>=$min_v2){
                print " [<b>$min_v2</b>]";
                }else{
                print " [<font color=#D50000><b>$min_v2</b></font>]";
                }
        }
print "<BR>";
}

if($min_level>$db["level"]){
$min_level="<font color=#D50000><b>$min_level</b></font>";
}

print "<li>Уровень: <b>$min_level</b>";
           if($th == 1 && $min_level2>0){
                if($db["level"]>=$min_level2){
                print " [<b>$min_level2</b>]";
                }
                else{
                print " [<font color=#D50000><b>$min_level2</b></font>]";
                }
        }
if(!empty($sex)){
         if($sex == "female" && $sex!=$db["sex"]){$req_sex = "<font color=#D50000>женский</font>";}
    else if($sex == "female" && $sex==$db["sex"]){$req_sex = "<font color=#009900>женский</font>";}
    else if($sex == "male" && $sex==$db["sex"]){$req_sex = "<font color=#009900>мужской</font>";}
    else if($sex == "male" && $sex!=$db["sex"]){$req_sex = "<font color=#D50000>мужской</font>";}
         print "<BR><li>Пол: <b>$req_sex</b><BR>";
}
print "<BR>";
print "</td><td width=* bgcolor=$bgcolor class=us2 valign=top style=\"border-top: none; border-right: 1px solid #999999; border-bottom: none; border-left: none;\"><span class=usuallyb>";




print "<font face=\"Tahoma\"><b>Свойства:</b><BR>";
if($th==1){print "<b>Двуручное оружие</b><BR>";}
if ($dat["desc"]!=""){print $dat["desc"];print "<br />";}
if($type == "scroll"){
print "<li>Стихия: <B>$school_d</B><BR>";
print "<li>Исп. маны: <B>$need_mn</B><BR>";
if($vstr>0){
print "<li><b>Записываемый в книгу.</b><BR>";
}
}
if($type == "book"){
if($add_i>0){
print "<li>Интеллект:<b>+$add_i</b><BR>";
}
else if($add_i<0){
print "<li>Интеллект: <font color=#D50000><b>$add_i</b></font><BR>";
}
if($add_mp>0){
print "<li>Уровень маны: <b>+$add_mp</b><BR>";
}
else if($add_mp<0){
print "<li>Уровень маны: <font color=#D50000><b>$add_mp</b></font><BR>";
}
if($add_water>0){
print "<li>Магия воды: <b>+$add_water</b><BR>";
}
if($add_earth>0){
print "<li>Магия земли:<b>+$add_earth</b><BR>";
}
if($add_fire>0){
print "<li>Магия огня: <b>+$add_fire</b><BR>";
}
if($add_air>0){
print "<li>Магия воздуха: <b>+$add_air</b><BR>";
}
if($pages>0){
print "<li>Страниц: <b>$pages</b><BR>";
}
}
if($type != "book" and $type != "scroll"){
if($min_a>0){print "<li>Мин. удар: <b>$min_a</b><BR>";}
if($max_a>0){print "<li>Макс. удар: <b>$max_a</b><BR>";}
if($add_s>0){print "<li>Сила: <b>+$add_s</b><BR>";}
elseif($add_s<0){print "<li>Сила: <font color=#D50000><b>$add_s</b></font><BR>";}
if($add_l>0){print "<li>Ловкость: <b>+$add_l</b><BR>";}
elseif($add_l<0){print "<li>Ловкость: <font color=#D50000><b>$add_l</b></font><BR>";}
if($add_u>0){print "<li>Удача: <b>+$add_u</b><BR>";}
elseif($add_u<0){print "<li>Удача: <font color=#D50000><b>$add_u</b></font><BR>";}
if($add_i>0){print "<li>Интеллект: <b>+$add_i</b><BR>";}
elseif($add_i<0){print "<li>Интеллект: <font color=#D50000><b>$add_i</b></font><BR>";}
if($mf_crit>0){print "<li>Мф. крит. удара: <b>+$mf_crit</b>%<BR>";}
elseif($mf_crit<0){print "<li>Мф. крит. удара: <font color=#D50000><b>$mf_crit%</b></font><BR>";}
if($mf_anticrit>0){print "<li>Мф. антикрит: <b>+$mf_anticrit</b>%<BR>";}
elseif($mf_anticrit<0){print "<li>Мф. антикрит: <font color=#D50000>$mf_anticrit</font>%<BR>";}
if($mf_uvorot>0){print "<li>Мф. уворота: <b>+$mf_uvorot</b>%<BR>";}
elseif($mf_uvorot<0){print "<li>Мф. уворота: <font color=#D50000><b>$mf_uvorot</b></font>%<BR>";}
if($mf_antiuvorot>0){print "<li>Мф. антиуворота: <b>+$mf_antiuvorot</b>%<BR>";}
elseif($mf_uvorot<0){print "<li>Мф. антиуворота: <font color=#D50000><b>$mf_antiuvorot</b><?font>%<BR>";}

if($add_hp>0){print "<li>Уровень HP: <b>+$add_hp</b><BR>";}
elseif($add_hp<0){print "<li>Уровень HP: <font color=#D50000><b>$add_hp</b></font><BR>";}
if($add_mp>0){print "<li>Уровень маны: <b>+$add_mp</b><BR>";}
elseif($add_mp<0){print "<li>Уровень маны: <font color=#D50000><b>$add_mp</b></font><BR>";}
if($addsword>0){print "<li>Владение мечами: <b>+$addsword</b>%<BR>";}
if($addaxe>0){print "<li>Владение топорами: <b>+$addaxe</b>%<BR>";}
if($addfail>0){print "<li>Владение дубинами: <b>+$addfail</b>%<BR>";}
if($addknife>0){print "<li>Владение ножами: <b>+$addknife</b>%<BR>";}
if($addstaff>0){print "<li>Владение копьями: <b>+$addstaff</b>%<BR>";}
if($addshot>0){print "<li>Владение луками: <b>+$addshot</b>%<BR>";}
if($add_speed>0){print "<li>Скорость: <B>+$add_speed</B> (км/ч)<BR>";}
if($add_speed<0){print "<li>Скорость: <font color=#D50000><B>$add_speed</B></font> (км/ч)<BR>";}
if($add_velocity>0){print "<li>Грузоподъемность: <B>+$add_velocity</B> (кг)<BR>";}
if($add_velocity<0){print "<li>Грузоподъемность: <font color=#D50000><B>$add_velocity</B></font> (кг)<BR>";}
if($p_h>0){print "<li>Броня головы: <b>$p_h</b><BR>";}
if($p_a>0){print "<li>Броня рук: <b>$p_a</b><BR>";}
if($p_c>0){print "<li>Броня корпуса: <b>$p_c</b><BR>";}
if($p_p>0){print "<li>Броня пояса: <b>$p_p</b><BR>";}
if($p_l>0){print "<li>Броня ног: <b>$p_l</b><BR>";}
if($add_arm_l>0){print "<li>Бездоспешный бой: <b>+$add_arm_l</b><BR>";}
if($add_arm_m>0){print "<li>Легкие доспехи: <b>+$add_arm_l</b><BR>";}
if($add_arm_h>0){print "<li>Тяжелые доспехи: <b>+$add_arm_h</b><BR>";}
if($add_fire>0) {print "<li>Стихия огня: <b>+$add_fire</b><BR>";}
if($add_water>0){print "<li>Стихия воды: <b>+$add_water</b><BR>";}
if($add_air>0)  {print "<li>Стихия воздуха: <b>+$add_air</b><BR>";}
if($add_earth>0){print "<li>Стихия земли: <b>+$add_earth</b><BR>";}
if($add_cast>0){print "<li>Кастование: <b>+$add_cast</b><BR>";}
if($add_trade>0){print "<li>Торговля: <b>+$add_trade</b><BR>";}
if($add_cure>0){print "<li>Исцеление: <b>+$add_cure</b><BR>";}
if($add_walk>0){print "<li>Походы: <b>+$add_walk</b><BR>";}
}
print "</span></td><td></td></tr>";

}
}
}
else
{
//покупка предмета
if($type!="" and $item!=""){
$sql="SELECT
                c. * , o.name
      FROM
                comok AS c
      LEFT JOIN
                $type AS o ON ( o.id = c.object_id )
      WHERE
                c.id='$item' and c.object_type='$type'";

$bye_sql = mysql_query($sql);
while($to_inv = mysql_fetch_array($bye_sql)){
if($db["money"]>=$to_inv["price"]){
$INS = mysql_query("INSERT INTO `inv`(owner,object_id,object_type,object_razdel,iznos,tear_max,term,is_modified) VALUES ('".$_SESSION["login"]."','".$to_inv["object_id"]."','".$to_inv["object_type"]."','".$to_inv["object_razdel"]."','".$to_inv["iznos"]."','".$to_inv["tear_max"]."','".$to_inv["term"]."','".$to_inv["is_modified"]."')");
$DEl = mysql_query("DELETE FROM `comok` WHERE id = '$item'");
$price_com=$to_inv["price"];
$nalog=$price_com*0.1;
if($nalog<1){$nalog="1";}
$money_to_owner=$price_com-$nalog;




$s2=mysql_query("UPDATE characters SET money=money-'$price_com' WHERE login='$login'");
if($db["trade"]<90){
$trade=mysql_query("UPDATE `characters` SET trade=trade+0.00 WHERE login='$login'");
echo mysql_error();
}
$s2=mysql_query("UPDATE characters SET money=money+'$money_to_owner' WHERE login='".$to_inv["owner"]."'");
say($login,"Вы удачно купили &laquo;".$to_inv["name"]."&raquo; за $price_com кр.",$login);
say($to_inv["owner"],"Ваш товар &laquo;".$to_inv["name"]."&raquo; был куплен в комиссионном магазине. За вычетом налогов вам переведено $money_to_owner кр.",$to_inv["owner"]);
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
$name2=$to_inv["name"]."($price_com кр)";
history($login,'купил',$name2,$ip,'комиссионный магазин');
$name3=$to_inv["name"]."($money_to_owner кр)";
history($to_inv["owner"],'продал',$name3,$ip,'комиссионный магазин');
}else{print "У вас недостаточно средств чтобы купить ".$to_inv["name"]."";} }
}

//вывод витрины раздела
$sql= "SELECT
        c. * , o.name, o.img, o.mass,
         count( c.object_id ) AS count,
         min( c.price ) AS price_min,
         max( c.price ) AS price_max,
         min( c.iznos ) AS iznos_m_min,
         max( c.iznos ) AS iznos_m_max
      FROM
         comok AS c
      LEFT JOIN $type AS o ON ( o.id = c.object_id )
      WHERE c.object_type = '$type'
      GROUP BY c.object_id ";
$comok_type_sql = mysql_query($sql);
echo mysql_error();
while($comok_type = mysql_fetch_array($comok_type_sql)){
if ($bgcolor=="#EEEEEE"){$bgcolor="#cccccc";}elseif($bgcolor=="#cccccc"){$bgcolor="#EEEEEE";}

?>
<tr>
        <tr height=87px>
          <td width=80  style=" border: 1px solid #999999; border-bottom: none;border-left: none;" bgcolor="#E5D18C" align=center>

<? print"<img border=\"0\" src=\"img/".$comok_type["img"]."\" alt='".$comok_type["name"]."'>"; ?>
<br /><? print "<a href=\"?type=$type&set=".$comok_type["object_id"]."\" class=us2>подробнее</a>";?>

</td>
        <td style="border:none; border-top: 1px solid #999999" width="10px" bgcolor="<?echo $bgcolor;?>">&nbsp;</td>
        <td align="left" width=*  style="border:none; border-top: 1px solid #999999" bgcolor="#E5D18C" class=us2>
          <font face="Tahoma">
<?
$price_min = sprintf ("%01.2f", $comok_type["price_min"]);
$price_max = sprintf ("%01.2f", $comok_type["price_max"]);
$mass=$comok_type["mass"];
$count=$comok_type["count"];
$iznos_m_min=$comok_type["iznos_m_min"];
$iznos_m_max=$comok_type["iznos_m_max"];
if($iznos_m_min != $iznos_m_max){$iznos_min="$iznos_m_min-$iznos_m_max";}else{$iznos_min=$iznos_m_min;}
$tear_max=$comok_type["tear_max"];
print "<b>".$comok_type["name"]."</b>";
print "<li>Масса: <b>$mass</b><br>";
print "<li>Цена: <b>$price_min</b>";
if($price_max!=$price_min){print" - <b>$price_max</b>";}
print " кр. <br>";
print "<li>Количество: <b>$count</b><br>";
print "<li>Долговечность: <b>$iznos_min</b> / <b>$tear_max</b>";
print "</td></tr>";
}







}






?>
</table>

</td>
<td width="19px" background="img/index/t6.jpg" style="background-position:right;"></td>
</tr>
<tr height="22px">
<td width="21px" background="img/index/t7.jpg" style="background-position: bottom left;"></td>
<td background="img/index/t8.jpg" width="*" style="background-position: bottom;" bgcolor="#E5D18C">&nbsp;</td>
<td width="19px" background="img/index/t9.jpg" style="background-position: bottom right;"></td>
</tr>


</table>




<br />

  </td>
  <td width=210px valign="top">
<table cellpadding="0" cellspacing="0" border="0" width=100%>
<tr height=53px>
<td width="25px" background="img/index/il.jpg"></td>
<td background="img/index/ibg.jpg" width="*">
<b><font color="#ffffff"><center>прилавки</center></font></b>
</td>
<td width="25px" background="img/index/ir.jpg"></td>
</tr>
<tr >
<td width="25px" background="img/index/t4.jpg"></td>
<td style="BACKGROUND-COLOR: #F7F7F7;">
&nbsp&nbsp<a class=us2 href='?deist=sdat'>Приём вещей</a><br />
&nbsp&nbsp<a class=us2 href='?deist=zabrat'>Мои вещи</a><br /><br />
&nbsp&nbsp&nbsp&nbsp<b>Оружие:</b><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=sword'>Мечи</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=axe'>Топоры, Секиры</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=fail'>Дубины,  Булавы</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=knife'>Ножи, Кастеты</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=staff'>Посохи,Жезлы</a><br>
&nbsp&nbsp&nbsp&nbsp<b>Обмундирование:</b><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=light_armor'>Легкая Броня</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=armor'>Тяжёлая Броня</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=helmet'>Шлемы</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=shield'>Щиты</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=pants'>Штаны</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=boots'>Обувь</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=perchi'>Перчатки</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=poyas'>Пояса</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=naruci'>Наручи</a><br>
&nbsp&nbsp&nbsp&nbsp<b>Ювелир. товары:</b><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=amulet'>Амулеты</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=ring'>Кольца</a><br>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=sergi'>Серьги</a><br>

<b>Заклинания</b><br />
&nbsp&nbsp<a class=us2 href='?type=scroll'>Магические свитки</a><br />
<br />
&nbsp&nbsp<a class=us2 href='main.php?act=go&room_go=centplosh'>Выйти</a><br />

</td>
<td width="25px" background="img/index/t6.jpg"></td>
</tr>
<tr height=27px>
<td width="25px" background="img/index/t7.jpg"></td>
<td background="img/index/t8.jpg" width="*">&nbsp;</td>
<td width="25px" background="img/index/t9.jpg"></td>
</tr>


</table>
  </td>
  </tr>
</table>