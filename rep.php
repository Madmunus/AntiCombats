<?
session_start();
if(empty($login)){
print "<script>top.location.href='index.html';</script>";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=#dedede topmargin=2>
<?
include "conf.php";
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$t) or ereg("[<>\\/-]",$item_id) or ereg("[<>\\/-]",$level)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$t=htmlspecialchars($t);
$item_id=htmlspecialchars($item_id);
$level=htmlspecialchars($level);
/* include "functions.php"; */
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
$city=$db["city"];
$room=$db["room"];

    if($city != "Demons City"){
     print "<script>top.location.href='index.php'</script>";
    }
    if($room != "Ремонтная мастерская"){
     print "<script>top.location.href='index.php'</script>";
    }


if(empty($act)){$act="none";}

if($act=="none"){
        ?>




              <table width="148" align=right border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE"><tr>
                <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
                <td bgcolor="#D3D3D3" nowrap><a href="main.php?act=go&room_go=centplosh" onclick="" class="menutop" title="Переход на центральную площадь">Центральная Площадь</a></td>
              </tr></table>

<BR><br>

<table align=center><td>
<?



        if(!empty($item_id)){
        $detect = mysql_query("SELECT * FROM inv WHERE id='$item_id'");
        $resultat = mysql_fetch_array($detect);
        $iznos = $resultat["iznos"];
        $owner = $resultat["owner"];
        if (!$resultat or $owner!=$login){print"Вещь не найдена в инвентаре."; die();}
        if ($iznos==0){print"Вещь не сломана."; die();}

        $s="select * from inv where id=$item_id AND object_razdel='obj'";
        $q=mysql_query($s);
        $res=mysql_fetch_array($q);
        $obj_type=$res["object_type"];
        $obj_id=$res["object_id"];

        $ss="select * from $obj_type where id=$obj_id";
        $qq=mysql_query($ss);
        $res2=mysql_fetch_array($qq);
        $name=$res2["name"];
        $price1=$res["iznos"]*0.1;
        $price = sprintf ("%01.2f", $price1);
                if($db["money"]>=$price){
                        if($t == 2){
                        $S = mysql_query("UPDATE inv SEt iznos='0' WHERE id='$item_id'");
                        $SS = mysql_query("UPDATE characters SET money=money-$price WHERE login='$login'");
                        }
                        else if($t == 1){
                        if($res["iznos"]>0){
                        $S = mysql_query("UPDATE inv SEt iznos=iznos-1 WHERE id='$item_id'");
                        $SS = mysql_query("UPDATE characters SET money=money-0.1 WHERE login='$login'");
                        $price = "0.1";
                        }
                        }
                print "<b><font color=red>Ремонт произведен удачно!</font></b>";
                }
        }




?>
<table border="0" cellspacing="0" cellpadding="0" width="650">
        <tr>
          <td width="10" height="5"><img border="0" src="img/cor2_l_t.gif"></td>
          <td height="10" bgcolor="#CCCCCC" rowspan="2" valign="middle" colspan="2">
            <p align="center"><b><img border="0" src="img/1_20.gif" width="1" height="10">РЕМОНТ ВЕЩЕЙ</b><br><small><font color=red>* Не забывайте снимать вещи перед ремонтом.<font></small></td>
          <td width="10" height="5"><img border="0" src="img/cor2_r_t.gif"></td>
        </tr>
        <tr>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="10" height="5" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
</table>

<?


$SQL=mysql_query("SELECT * FROM inv WHERE owner='$login' AND object_razdel='obj' AND iznos>0");
while($D = mysql_fetch_array($SQL)){
$at_all++;
}


if($at_all==0){
?>
<table border=0 width=650 bgcolor=#cccccc><TR><TD>
<?
print "<center><B>У вас нет вещей для ремонта!!!";
?>
</td></tr></table>
<?
}
else{


$SQL=mysql_query("SELECT * FROM inv WHERE owner='$login' AND object_razdel='obj' AND iznos>0");
while($data=mysql_fetch_array($SQL)){

    if($data["owner"]==$login){
    print "<table border=0 width=650 bgcolor=#cccccc>";
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
    $price1=$data["iznos"]*0.1;
    $price = sprintf ("%01.2f", $price1);
    $price_gos=$dat["price"];
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
        if($wear==0){
        

print "<tr><td><hr color=#000000 noshade size=1 width=100% align=left><table><tr><td width=55%>";
print "<center><img src='img/$img' border=0 alt='$name($iznos/$tear_max)'><BR>";

print "<a href='?act=none&item_id=$item_id&t=1' class=nick><small>Ремонт 1 ед. за 0.1 кр.</small></a><BR>";
print "<a href='?act=none&item_id=$item_id&t=2' class=nick><small>Полный ремонт за $price кр.</small></a><BR>";

print "</td><td valign=top>";
print "<font color=#003388><B>$name</b></font>&nbsp(Масса: $mass)";
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
print "<br><B>Цена: $price_gos кр.</b><BR>";
print "Долговечность: $iznos/$tear_max<BR>";
print "<B>Требуется минимальное:</b><BR>";
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
print "<B>Параметры:</b><BR>";
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
print "&bull; Мф. фнтикрит: $mf_anticrit<BR>";
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
?>
</td></tr></table></td></tr></table> 
<?

        }    
    }


}    
}
die("<table border=0 width=650 bgcolor=#cccccc><TR><TD>
</td></tr></table>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"650\">
        <tr>
          <td width=\"2\" height=\"20\"><img border=\"0\" src=\"img/cor2_l_b.gif\"></td>
          <td height=\"10\" bgcolor=\"#CCCCCC\" rowspan=\"2\" valign=\"middle\" colspan=\"2\">
            <p align=\"center\"><img border=\"0\" src=\"img/1_20.gif\" width=\"1\" height=\"10\"></td>
          <td width=\"20\" height=\"20\"><img border=\"0\" src=\"img/cor2_r_b.gif\"></td>
        </tr>
</table></td><td valign=top width=\"320\" align=\"right\"><b>У вас в наличии: <FONT COLOR=339900>".$db["money"]."</font> кр.</b></td></table>");
?>
<?
      

}?>