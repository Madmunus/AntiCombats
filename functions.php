<?
class database{
    function connect(){
     include "conf.php";//Загружаем конфигурацию...
     $data = mysql_connect($base_name, $base_user, $base_pass);//Подключаем к БД
     mysql_select_db($db_name,$data);
     mysql_query("SET CHARSET cp1251");//Выбераем БД...
    }

    function get_value($column,$table,$login){
     $SQL = mysql_query("SELECT '$column' FROM '$table' WHERE login='$login'");
     $DATA = mysql_fetch_array($SQL);
     return $DATA["$column"];
    }
}

$base = new database();
$base -> connect();


function say ($to,$text,$sender)
{
    $result = mysql_query("SELECT room,city_game FROM characters WHERE login='$sender'");
    $db = mysql_fetch_array($result);
    $login=$to;
    $room = $db["room"];
    $city = $db["city_game"];
    $d=date("H:i");
    $time = time();
    $text = "Смотритель private [$login] <B>$text</b></font>";
    $S = mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','','$room','$text','sys','$time','$city')");
}
/*===============================================================*/
/*===================запись в историю============================*/
function history($who,$act,$val,$ip,$to){
$chas = date("H");
$d=date("d.m.Y", mktime($chas-1));

$time=date("H:i:s", mktime($chas-1));

$S = mysql_query("INSERT INTO perevod(login,action,item,ip,time,date,login2) VALUES('$who','$act','$val','$ip','$time','$d','$to')");
mysql_query("SET CHARSET cp1251");
}
/*===============================================================*/
/*==============установить хп====================================*/
function setHP($who,$val,$all){
$query=mysql_query("SELECT cure FROM characters WHERE login='$who'");
$data=mysql_fetch_array($query);
$cure_nav = $data["cure"];
$cure_full = floor(1200-$cure_nav*12/2);
$one=$cure_full/$all;
$time=$cure_full-$one*$val;
$put_to_base=time()+$time;

             if($data["cure"]<100){
              $add_cure = 0.01;
             }else{
              $add_cure = 0;
             }

$q=mysql_query("UPDATE characters SET cure_hp='$put_to_base',hp='$val',cure=cure+$add_cure WHERE login='$who'");

}
/*===============================================================*/
/*==============установить ману====================================*/
function setMN($who,$val,$all){
$one=1200/$all;
$time=1200-$one*$val;
$put_to_base=time()+$time;

$q=mysql_query("UPDATE characters SET cure_mp='$put_to_base',mp='$val' WHERE login='$who'");
}
/*===============================================================*/
/*======================С Н Я Т Ь================================*/
function unWear($who,$itm){
$user_query=mysql_query("SELECT * FROM characters WHERE login='$who'");
$db=mysql_fetch_array($user_query);

if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$inv_query=mysql_query("SELECT * FROM inv WHERE owner='$who' AND id=$itm");

$inv_data=mysql_fetch_array($inv_query);

$i_type=$inv_data["object_type"];
$item_id=$inv_data["object_id"];

$item_query=mysql_query("SELECT * FROM $i_type WHERE id=$item_id");

$item_data=mysql_fetch_array($item_query);

        if($i_type=="sword" || $i_type=="axe" || $i_type=="fail" || $i_type=="knife" || $i_type=="staff" || $i_type=="shield"){
                if($db["hand_r"] == $itm){$slot = "hand_r";}
                if($db["hand_l"] == $itm){$slot = "hand_l";}
        }
        else if($i_type=="ring"){
                if($db["ring1"]==$itm){
                $slot="ring1";
                }
                else if($db["ring2"]==$itm){
                $slot="ring2";
                }
                else if($db["ring3"]==$itm){
                $slot="ring3";
                }
        }
        else{
        $slot=$i_type;
        }

$slot_v=$db["$slot"];

if($slot_v==$itm){

$new_str=$db["str"]-$item_data["add_str"];
$new_dex=$db["dex"]-$item_data["add_dex"];
$new_con=$db["con"]-$item_data["add_con"];
$new_hp=$db["hp_all"]-$item_data["add_hp"];
$new_int=$db["int"]-$item_data["add_int"];
$new_mp=$db["mp_all"]-$item_data["add_mp"];
$new_phead=$db["bron_head"]-$item_data["def_head"];
$new_pcorp=$db["bron_corp"]-$item_data["def_corp"];
$new_ppoyas=$db["bron_poyas"]-$item_data["def_poyas"];
$new_plegs=$db["bron_legs"]-$item_data["def_legs"];
$new_mfcrit=$db["mf_crit"]-$item_data["mf_crit"];
$new_mfanticrit=$db["mf_anticrit"]-$item_data["mf_anticrit"];
$new_mfuvorot=$db["mf_uvorot"]-$item_data["mf_uvorot"];
$new_mfantiuvorot=$db["mf_antiuvorot"]-$item_data["mf_antiuvorot"];
$new_mfcrit_h=$item_data["mf_crit"];
$new_mfanticrit_h=$item_data["mf_anticrit"];
$new_mfuvorot_h=$item_data["mf_uvorot"];
$new_mfantiuvorot_h=$item_data["mf_antiuvorot"];
$new_wpmin_h=$item_data["min_attack"];
$new_wpmax_h=$item_data["max_attack"];
             if($slot=="hand_l"){
             $new_wpmin=$db["hand_l_hitmin"]-$item_data["min_attack"];
             $new_wpmax=$db["hand_l_hitmax"]-$item_data["max_attack"];
             }
             else if($slot=="hand_r"){
             $new_wpmin=$db["hand_r_hitmin"]-$item_data["min_attack"];
             $new_wpmax=$db["hand_r_hitmax"]-$item_data["max_attack"];
             }
$new_swordvl=$db["sword"]-$item_data["sword"];
$new_axevl=$db["axe"]-$item_data["axe"];
$new_failvl=$db["fail"]-$item_data["fail"];
$new_knifevl=$db["knife"]-$item_data["knife"];
$new_staffvl=$db["staff"]-$item_data["staff"];
$new_shotvl=$db["shot"]-$item_data["shot"];
$new_cost=$db["cost"]-$item_data["price"];
$new_mass=$db["mass"]-$item_data["mass"];
$new_arm_l=$db["no_armor"]-$item_data["add_arm_l"];
$new_arm_m=$db["light_armor"]-$item_data["add_arm_m"];
$new_arm_h=$db["heavy_armor"]-$item_data["add_arm_h"];
$new_fire=$db["fire"]-$item_data["add_fire"];
$new_water=$db["water"]-$item_data["add_water"];
$new_air=$db["air"]-$item_data["add_air"];
$new_earth=$db["earth"]-$item_data["add_earth"];
$new_cast=$db["cast"]-$item_data["add_cast"];
$new_trade=$db["trade"]-$item_data["add_trade"];
$new_cure=$db["cure"]-$item_data["add_cure"];
$new_walk=$db["walk"]-$item_data["add_walk"];
$new_velocity=$db["maxmass"]-$item_data["add_velocity"];
$new_parm=$db["bron_arm"]-$item_data["bron_arm"];
$all=$db["hp_all"]-$item_data["add_hp"];
$hp=$db["hp"];
if($all>$hp){
$hp2=$hp;
}
else{
$r=$hp-$all;
$hp2=$hp-$r;
}
setHP($who,$hp2,$all);

$n_query=mysql_query("UPDATE inv SET wear='0' WHERE id=$itm");


if($n_query){

$new_sql ="UPDATE characters SET str='$new_str',dex='$new_dex',con='$new_con',hp_all='$new_hp',";
$new_sql.="int='$new_int',mp_all='$new_mp',bron_head='$new_phead',bron_corp='$new_pcorp',";
$new_sql.="bron_poyas='$new_ppoyas',bron_legs='$new_plegs',bron_arm='$new_parm',maxmass='$new_velocity',";
$new_sql.="cost='$new_cost',$slot='0',sword='$new_swordvl',axe='$new_axevl',fail='$new_failvl',shot='$new_shotvl',";
if($slot == "hand_r"){
$new_sql.="hand_r_crit='0',hand_r_anticrit='0',hand_r_uvorot='0',hand_r_antiuvorot='0',hand_r_hitmin='0',hand_r_hitmax='0',";
}
else if($slot == "hand_l"){
$new_sql.="hand_l_crit='0',hand_l_anticrit='0',hand_l_uvorot='0',hand_l_antiuvorot='0',hand_l_hitmin='0',hand_l_hitmax='0',";
}
else{
$new_sql.="mf_crit='$new_mfcrit',mf_anticrit='$new_mfcrit',mf_uvorot='$new_mfuvorot',mf_antiuvorot='$new_mfantiuvorot',";
}
$new_sql.="knife='$new_knifevl',staff='$new_staffvl',mass='$new_mass',no_armor='$new_arm_l',";
$new_sql.="light_armor='$new_arm_m',heavy_armor='$new_arm_h',fire='$new_fire',water='$new_water',";
$new_sql.="air='$new_air',earth='$new_earth',cast='$new_cast',trade='$new_trade',cure='$new_cure',walk='$new_walk'";
$new_sql.=" WHERE login='$who'";
$new_query=mysql_query($new_sql);


}

$hands = 1;

        if($db["hand_r"] != 0 && $db["hand_l"] == 0 && $db["hand_l_free"] == 0){$hands = 2;}
        if($hands == 2){
                if($slot=="hand_r"){$n2q=mysql_query("UPDATE characters SET hand_r_type='phisic',hand_r_free='1',hand_l_free='1' WHERE login='$who'");}

                if($slot=="hand_l"){$n2q=mysql_query("UPDATE characters SET hand_l_type='phisic',hand_l_free='1',hand_r_free='1' WHERE login='$who'");}

        }
        else{
                if($slot=="hand_r"){$n2q=mysql_query("UPDATE characters SET hand_r_type='phisic',hand_r_free='1' WHERE login='$who'");}

                if($slot=="hand_l"){$n2q=mysql_query("UPDATE characters SET hand_l_type='phisic',hand_l_free='1' WHERE login='$who'");}

        }
}
print "<script>location.href='main.php?act=inv&section=obj';</script>";
die();
}
/*==========================*/
function unWear_all($who,$itm){
$user_query=mysql_query("SELECT * FROM characters WHERE login='$who'");

$db=mysql_fetch_array($user_query);

if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$inv_query=mysql_query("SELECT * FROM inv WHERE owner='$who' AND id=$itm");

$inv_data=mysql_fetch_array($inv_query);

$i_type=$inv_data["object_type"];
$item_id=$inv_data["object_id"];

$item_query=mysql_query("SELECT * FROM $i_type WHERE id=$item_id");

$item_data=mysql_fetch_array($item_query);

        if($i_type=="sword" || $i_type=="axe" || $i_type=="fail" || $i_type=="knife" || $i_type=="staff" || $i_type=="shield"){
                if($db["hand_r"] == $itm){$slot = "hand_r";}
                if($db["hand_l"] == $itm){$slot = "hand_l";}
        }
        else if($i_type=="ring"){
                if($db["ring1"]==$itm){
                $slot="ring1";
                }
                else if($db["ring2"]==$itm){
                $slot="ring2";
                }
                else if($db["ring3"]==$itm){
                $slot="ring3";
                }
        }
        else{
        $slot=$i_type;
        }

$slot_v=$db["$slot"];

if($slot_v==$itm){

$new_str=$db["str"]-$item_data["add_str"];
$new_dex=$db["dex"]-$item_data["add_dex"];
$new_con=$db["con"]-$item_data["add_con"];
$new_hp=$db["hp_all"]-$item_data["add_hp"];
$new_int=$db["int"]-$item_data["add_int"];
$new_mp=$db["mp_all"]-$item_data["add_mp"];
$new_phead=$db["bron_head"]-$item_data["def_head"];
$new_pcorp=$db["bron_corp"]-$item_data["def_corp"];
$new_ppoyas=$db["bron_poyas"]-$item_data["def_poyas"];
$new_plegs=$db["bron_legs"]-$item_data["def_legs"];
$new_mfcrit=$db["mf_crit"]-$item_data["mf_crit"];
$new_mfanticrit=$db["mf_anticrit"]-$item_data["mf_anticrit"];
$new_mfuvorot=$db["mf_uvorot"]-$item_data["mf_uvorot"];
$new_mfantiuvorot=$db["mf_antiuvorot"]-$item_data["mf_antiuvorot"];
$new_mfcrit_h=$item_data["mf_crit"];
$new_mfanticrit_h=$item_data["mf_anticrit"];
$new_mfuvorot_h=$item_data["mf_uvorot"];
$new_mfantiuvorot_h=$item_data["mf_antiuvorot"];
$new_wpmin_h=$item_data["min_attack"];
$new_wpmax_h=$item_data["max_attack"];
             if($slot=="hand_l"){
             $new_wpmin=$db["hand_l_hitmin"]-$item_data["min_attack"];
             $new_wpmax=$db["hand_l_hitmax"]-$item_data["max_attack"];
             }
             else if($slot=="hand_r"){
             $new_wpmin=$db["hand_r_hitmin"]-$item_data["min_attack"];
             $new_wpmax=$db["hand_r_hitmax"]-$item_data["max_attack"];
             }
$new_swordvl=$db["sword"]-$item_data["sword"];
$new_axevl=$db["axe"]-$item_data["axe"];
$new_failvl=$db["fail"]-$item_data["fail"];
$new_knifevl=$db["knife"]-$item_data["knife"];
$new_staffvl=$db["staff"]-$item_data["staff"];
$new_shotvl=$db["shot"]-$item_data["shot"];
$new_cost=$db["cost"]-$item_data["price"];
$new_mass=$db["mass"]-$item_data["mass"];
$new_arm_l=$db["no_armor"]-$item_data["add_arm_l"];
$new_arm_m=$db["light_armor"]-$item_data["add_arm_m"];
$new_arm_h=$db["heavy_armor"]-$item_data["add_arm_h"];
$new_fire=$db["fire"]-$item_data["add_fire"];
$new_water=$db["water"]-$item_data["add_water"];
$new_air=$db["air"]-$item_data["add_air"];
$new_earth=$db["earth"]-$item_data["add_earth"];
$new_cast=$db["cast"]-$item_data["add_cast"];
$new_trade=$db["trade"]-$item_data["add_trade"];
$new_cure=$db["cure"]-$item_data["add_cure"];
$new_walk=$db["walk"]-$item_data["add_walk"];
$new_velocity=$db["maxmass"]-$item_data["add_velocity"];
$new_parm=$db["bron_arm"]-$item_data["bron_arm"];
$all=$db["hp_all"]-$item_data["add_hp"];
$hp=$db["hp"];
if($all>$hp){
$hp2=$hp;
}
else{
$r=$hp-$all;
$hp2=$hp-$r;
}
setHP($who,$hp2,$all);

$n_query=mysql_query("UPDATE inv SET wear='0' WHERE id=$itm");


if($n_query){

$new_sql ="UPDATE characters SET str='$new_str',dex='$new_dex',con='$new_con',hp_all='$new_hp',";
$new_sql.="int='$new_int',mp_all='$new_mp',bron_head='$new_phead',bron_corp='$new_pcorp',";
$new_sql.="bron_poyas='$new_ppoyas',bron_legs='$new_plegs',bron_arm='$new_parm',maxmass='$new_velocity',";
$new_sql.="cost='$new_cost',$slot='0',sword='$new_swordvl',axe='$new_axevl',fail='$new_failvl',shot='$new_shotvl',";
if($slot == "hand_r"){
$new_sql.="hand_r_crit='0',hand_r_anticrit='0',hand_r_uvorot='0',hand_r_antiuvorot='0',hand_r_hitmin='0',hand_r_hitmax='0',";
}
else if($slot == "hand_l"){
$new_sql.="hand_l_crit='0',hand_l_anticrit='0',hand_l_uvorot='0',hand_l_antiuvorot='0',hand_l_hitmin='0',hand_l_hitmax='0',";
}
else{
$new_sql.="mf_crit='$new_mfcrit',mf_anticrit='$new_mfcrit',mf_uvorot='$new_mfuvorot',mf_antiuvorot='$new_mfantiuvorot',";
}
$new_sql.="knife='$new_knifevl',staff='$new_staffvl',mass='$new_mass',no_armor='$new_arm_l',";
$new_sql.="light_armor='$new_arm_m',heavy_armor='$new_arm_h',fire='$new_fire',water='$new_water',";
$new_sql.="air='$new_air',earth='$new_earth',cast='$new_cast',trade='$new_trade',cure='$new_cure',walk='$new_walk'";
$new_sql.=" WHERE login='$who'";
$new_query=mysql_query($new_sql);

}

$hands = 1;

        if($db["hand_r"] != 0 && $db["hand_l"] == 0 && $db["hand_l_free"] == 0){$hands = 2;}
        if($hands == 2){
                if($slot=="hand_r"){$n2q=mysql_query("UPDATE characters SET hand_r_type='phisic',hand_r_free='1',hand_l_free='1' WHERE login='$who'");}
                if($slot=="hand_l"){$n2q=mysql_query("UPDATE characters SET hand_l_type='phisic',hand_l_free='1',hand_r_free='1' WHERE login='$who'");}

        }
        else{
                if($slot=="hand_r"){$n2q=mysql_query("UPDATE characters SET hand_r_type='phisic',hand_r_free='1' WHERE login='$who'");}
                if($slot=="hand_l"){$n2q=mysql_query("UPDATE characters SET hand_l_type='phisic',hand_l_free='1' WHERE login='$who'");}
        }
}
}
/*===========================О Д Е Т Ь=========================*/
function wear($who,$itm){
$user_query = mysql_query("SELECT * FROM characters WHERE login='$who'");

$db = mysql_fetch_array($user_query);

if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$inv_query = mysql_query("SELECT * FROM inv WHERE owner='$who' AND id=$itm");

$inv_data = mysql_fetch_array($inv_query);

$i_type = $inv_data["object_type"];/*тип предмета*/
$item_id = $inv_data["object_id"];

$item_query = mysql_query("SELECT * FROM $i_type WHERE id=$item_id");

$item_data = mysql_fetch_array($item_query);


$str=$db["str"];
$dex=$db["dex"];
$con=$db["con"];
$vit=$db["vit"];
$int=$db["int"];
$wis=$db["wis"];
$level=$db["level"];
$align=$db["orden"];
$sex=$db["sex"];

$wearable = 0;
$hands = 1;

$min_str=$item_data["min_str"];
$min_dex=$item_data["min_dex"];
$min_con=$item_data["min_con"];
$min_vit=$item_data["min_vit"];
$min_int=$item_data["min_int"];
$min_wis=$item_data["min_wis"];
$min_level=$item_data["min_level"];
$min_str2=$item_data["min_str2"];
$min_dex2=$item_data["min_dex2"];
$min_con2=$item_data["min_con2"];
$min_vit2=$item_data["min_vit2"];
$min_int2=$item_data["min_int2"];
$min_wis2=$item_data["min_wis2"];
$min_level2=$item_data["min_level2"];
$req_align = $item_data["orden"];
$req_sex = $item_data["sex"];


$slot_v = $db["$slot"];

        if($str>=$min_str && $dex>=$min_dex && $con>=$min_con && $vit>=$min_vit && $int>=$min_int && $wis>=$min_wis && $level>=$min_level && $slot_v==0){
        $wearable=1;
        }
        if($item_data["type"]=="two_hand"){
                if($str>=$min_str2 && $dex>=$min_dex2 && $con>=$min_con2 && $vit>=$min_vit2 && $int>=$min_int2 && $wis>=$min_wis2 && $level>=$min_level2 && $slot_v==0){
                $wearable = 1;
                $hands = 1;
                }
                else if($str>=$min_str && $dex>=$min_dex && $con>=$min_con && $vit>=$min_vit && $int>=$min_int && $wis>=$min_wis && $level>=$min_level && $slot_v==0){
                $wearable = 1;
                $hands = 2;
                }
                else{$wearable = 0;}
        }

        if($i_type == "sword" || $i_type == "axe" || $i_type == "fail" || $i_type == "staff" || $i_type == "knife"){
                if($db["hand_r_free"] == 1){$slot = "hand_r";}
                else if($db["hand_r_free"] == 0 && $db["hand_l_free"] == 1){$slot = "hand_l";}
                else if($db["hand_r_free"] == 0 && $db["hand_l_free"] == 0){
                unwear_all($who,$db["hand_r"]);
                wear($who,$itm);
                }
                if($hands == 2){
                        if($db["hand_r_free"] == 1 && $db["hand_l_free"] == 1){
                        $slot = "hand_r";
                        }
                        else if($db["hand_r_free"] == 1 && $db["hand_l_free"] == 0){
                        unwear_all($who,$db["hand_l"]);
                        wear($who,$itm);
                        die();
                        }
                        else if($db["hand_r_free"] == 0 && $db["hand_l_free"] == 1){
                        unwear_all($who,$db["hand_r"]);
                        wear($who,$itm);
                        die();
                        }
                        else if($db["hand_r_free"] == 0 && $db["hand_l_free"] == 0){
                        unwear_all($who,$db["hand_r"]);
                        unwear_all($who,$db["hand_l"]);
                        wear($who,$itm);
                        die();
                        }
                }
        $w_type = $i_type;/*тип оружия*/
        }
        else if($i_type == "shield"){
                if($db["hand_l_free"] == 1){$slot = "hand_l";}
                else if($db["hand_l_free"] == 0 && $db["hand_r_free"] == 1){$slot = "hand_r";}
                else if($db["hand_l_free"] == 0 && $db["hand_r_free"] == 0){
                        if($db["hand_l"]!=0){
                        unwear_all($who,$db["hand_l"]);
                        wear($who,$itm);
                        die();
                        }
                        else{
                        unwear_all($who,$db["hand_r"]);
                        wear($who,$itm);
                        die();
                        }
                }
        $w_type = $i_type;/*тип щита*/
        }
        else if($i_type == "ring"){
                if($db["ring1"] == 0){
                $slot = "ring1";
                }
                else if($db["ring2"] == 0){
                $slot="ring2";
                }
                else if($db["ring3"] == 0){
                $slot = "ring3";
                }
                if($db["ring1"] != 0 and $db["ring2"] != 0 and $db["ring3"] != 0){
                unwear_all($who,$db["ring1"]);
                wear($who,$itm);
                }
        }
        else{
        $slot = $i_type;
        }

if($i_type=="helmet"){if($db["helmet"]!=0){unwear_all($who,$db["helmet"]);}}
if($i_type=="naruchi"){if($db["naruchi"]!=0){unwear_all($who,$db["naruchi"]);}}
if($i_type=="amulet"){if($db["amulet"]!=0){unwear_all($who,$db["amulet"]);}}
if($i_type=="sergi"){if($db["sergi"]!=0){unwear_all($who,$db["sergi"]);}}
if($i_type=="armor"){if($db["armor"]!=0){unwear_all($who,$db["armor"]);}}
if($i_type=="poyas"){if($db["poyas"]!=0){unwear_all($who,$db["poyas"]);}}
if($i_type=="ring1"){if($db["ring1"]!=0){unwear_all($who,$db["ring1"]);}}
if($i_type=="ring2"){if($db["ring2"]!=0){unwear_all($who,$db["ring2"]);}}
if($i_type=="ring3"){if($db["ring3"]!=0){unwear_all($who,$db["ring3"]);}}
if($i_type=="perchi"){if($db["perchi"]!=0){unwear_all($who,$db["perchi"]);}}
if($i_type=="pants"){if($db["pants"]!=0){unwear_all($who,$db["pants"]);}}
if($i_type=="boots"){if($db["boots"]!=0){unwear_all($who,$db["boots"]);}}

$user_query = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($user_query);

if($req_align!=0 && $align!=$req_align){
print "Ваша склонность не позволяет одеть эту вещь.";
}
else if($wearable == 1){

$new_str=$db["str"]+$item_data["add_str"];
$new_dex=$db["dex"]+$item_data["add_dex"];
$new_con=$db["con"]+$item_data["add_con"];
$new_int=$db["int"]+$item_data["add_int"];
$new_mp=$db["mp_all"]+$item_data["add_mp"];
$new_phead=$db["bron_head"]+$item_data["def_head"];
$new_pcorp=$db["bron_corp"]+$item_data["def_corp"];
$new_ppoyas=$db["bron_poyas"]+$item_data["def_poyas"];
$new_plegs=$db["bron_legs"]+$item_data["def_legs"];
$new_mfcrit=$db["mf_crit"]+$item_data["mf_crit"];
$new_mfanticrit=$db["mf_anticrit"]+$item_data["mf_anticrit"];
$new_mfuvorot=$db["mf_uvorot"]+$item_data["mf_uvorot"];
$new_mfantiuvorot=$db["mf_antiuvorot"]+$item_data["mf_antiuvorot"];
$new_mfcrit_h=$item_data["mf_crit"];
$new_mfanticrit_h=$item_data["mf_anticrit"];
$new_mfuvorot_h=$item_data["mf_uvorot"];
$new_mfantiuvorot_h=$item_data["mf_antiuvorot"];
$new_wpmin_h=$item_data["min_attack"];
$new_wpmax_h=$item_data["max_attack"];
if($slot=="hand_l"){
$new_wpmin=$db["hand_l_hitmin"]+$item_data["min_attack"];
$new_wpmax=$db["hand_l_hitmax"]+$item_data["max_attack"];
}
else if($slot=="hand_r"){
$new_wpmin=$db["hand_r_hitmin"]+$item_data["min_attack"];
$new_wpmax=$db["hand_r_hitmax"]+$item_data["max_attack"];
}

$new_swordvl=$db["sword"]+$item_data["sword"];
$new_axevl=$db["axe"]+$item_data["axe"];
$new_failvl=$db["fail"]+$item_data["fail"];
$new_knifevl=$db["knife"]+$item_data["knife"];
$new_staffvl=$db["staff"]+$item_data["staff"];
$new_shotvl=$db["shot"]+$item_data["shot"];
$new_cost=$db["cost"]+$item_data["price"];
$new_mass=$db["mass"]+$item_data["mass"];
$new_arm_l=$db["no_armor"]+$item_data["add_arm_l"];
$new_arm_m=$db["light_armor"]+$item_data["add_arm_m"];
$new_arm_h=$db["heavy_armor"]+$item_data["add_arm_h"];
$new_fire=$db["fire"]+$item_data["add_fire"];
$new_water=$db["water"]+$item_data["add_water"];
$new_air=$db["air"]+$item_data["add_air"];
$new_earth=$db["earth"]+$item_data["add_earth"];
$new_cast=$db["cast"]+$item_data["add_cast"];
$new_trade=$db["trade"]+$item_data["add_trade"];
$new_cure=$db["cure"]+$item_data["add_cure"];
$new_walk=$db["walk"]+$item_data["add_walk"];
$new_hp=$db["hp_all"]+$item_data["add_hp"];
$new_velocity=$db["maxmass"]+$item_data["add_velocity"];
$new_parm=$db["bron_arm"]+$item_data["bron_arm"];
$now_hp = $db["hp"];
setHP($who,$now_hp,$new_hp);

$new_sql ="UPDATE characters SET str='$new_str',dex='$new_dex',con='$new_con',hp_all='$new_hp',";
$new_sql.="int='$new_int',mp_all='$new_mp',bron_head='$new_phead',bron_corp='$new_pcorp',";
$new_sql.="bron_poyas='$new_ppoyas',bron_legs='$new_plegs',bron_arm='$new_parm',maxmass='$new_velocity',";
$new_sql.="cost='$new_cost',$slot='$itm',sword='$new_swordvl',axe='$new_axevl',fail='$new_failvl',shot='$new_shotvl',";
if($slot == "hand_r"){
$new_sql.="hand_r_crit='$new_mfcrit_h',hand_r_anticrit='$new_mfanticrit_h',hand_r_uvorot='$new_mfuvorot_h',hand_r_antiuvorot='$new_mfantiuvorot_h',hand_r_hitmin='$new_wpmin',hand_r_hitmax='$new_wpmax',";
}
else if($slot == "hand_l"){
$new_sql.="hand_l_crit='$new_mfcrit_h',hand_l_anticrit='$new_mfanticrit_h',hand_l_uvorot='$new_mfuvorot_h',hand_l_antiuvorot='$new_mfantiuvorot_h',hand_l_hitmin='$new_wpmin',hand_l_hitmax='$new_wpmax',";
}
else{
$new_sql.="mf_crit='$new_mfcrit',mf_anticrit='$new_mfcrit',mf_uvorot='$new_mfuvorot',mf_antiuvorot='$new_mfantiuvorot',";
}
$new_sql.="knife='$new_knifevl',staff='$new_staffvl',mass='$new_mass',no_armor='$new_arm_l',";
$new_sql.="light_armor='$new_arm_m',heavy_armor='$new_arm_h',fire='$new_fire',water='$new_water',";
$new_sql.="air='$new_air',earth='$new_earth',cast='$new_cast',trade='$new_trade',cure='$new_cure',walk='$new_walk'";
$new_sql.=" WHERE login='$who'";

$new_query=mysql_query($new_sql);
mysql_query("SET CHARSET cp1251");
$n_query=mysql_query("UPDATE inv SET wear='1' WHERE id=$itm");
mysql_query("SET CHARSET cp1251");

        if($hands == 2){
                if($slot=="hand_r"){$n2q=mysql_query("UPDATE characters SET hand_r_type='$w_type',hand_r_free='0',hand_l_free='0' WHERE login='$who'");}
                if($slot=="hand_l"){$n2q=mysql_query("UPDATE characters SET hand_l_type='$w_type',hand_l_free='0',hand_r_free='0' WHERE login='$who'");}
                mysql_query("SET CHARSET cp1251");
        }
        else{
                if($slot=="hand_r"){$n2q=mysql_query("UPDATE characters SET hand_r_type='$w_type',hand_r_free='0' WHERE login='$who'");}
                if($slot=="hand_l"){$n2q=mysql_query("UPDATE characters SET hand_l_type='$w_type',hand_l_free='0' WHERE login='$who'");}
        }
}

print "<script>location.href='main.php?act=inv&section=obj';</script>";
die();
}
/*========================раздеть=======================*/
function unwear_full($who){
$user_query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db=mysql_fetch_array($user_query);

if($db["amulet"]!=0){unwear_all($who,$db["amulet"]);}
if($db["sergi"]!=0){unwear_all($who,$db["sergi"]);}
if($db["hand_l"]!=0){unwear_all($who,$db["hand_l"]);}
if($db["hand_r"]!=0){unwear_all($who,$db["hand_r"]);}
if($db["armor"]!=0){unwear_all($who,$db["armor"]);}
if($db["poyas"]!=0){unwear_all($who,$db["poyas"]);}
if($db["ring1"]!=0){unwear_all($who,$db["ring1"]);}
if($db["ring2"]!=0){unwear_all($who,$db["ring2"]);}
if($db["ring3"]!=0){unwear_all($who,$db["ring3"]);}
if($db["helmet"]!=0){unwear_all($who,$db["helmet"]);}
if($db["naruchi"]!=0){unwear_all($who,$db["naruchi"]);}
if($db["perchi"]!=0){unwear_all($who,$db["perchi"]);}
if($db["pants"]!=0){unwear_all($who,$db["pants"]);}
if($db["boots"]!=0){unwear_all($who,$db["boots"]);}
}
/*======================================================*/
/*==============ПОКАЗАТЬ========================*/
function showItem($who,$itm,$type){
$result=mysql_query("SELECT * FROM inv WHERE owner='$who' and id=$itm");
mysql_query("SET CHARSET cp1251");
$d=mysql_fetch_array($result);
$obj_id=$d["object_id"];
$obj_type=$d["object_type"];

$res=mysql_query("SELECT * FROM $obj_type WHERE id=$obj_id");
mysql_query("SET CHARSET cp1251");
$dat=mysql_fetch_array($res);
$name=$dat["name"];
$img=$dat["img"];
$massa=$dat["mass"];
$prise=$dat["price"];
$min_str=$dat["min_str"];
$min_dex=$dat["min_dex"];
$min_con=$dat["min_con"];
$min_vinoslivost=$dat["min_vit"];
$add_str=$dat["add_str"];
$add_dex=$dat["add_dex"];
$add_con=$dat["add_con"];
$add_vinoslivost=$dat["add_hp"];
$bron_head=$dat["def_head"];
$bron_arm=$dat["bron_arm"];
$bron_corp=$dat["def_corp"];
$bron_poyas=$dat["def_poyas"];
$bron_leg=$dat["def_legs"];
$mf_crit=$dat["mf_crit"];
$mf_anticrit=$dat["mf_anticrit"];
$mf_uvorot=$dat["mf_uvorot"];
$mf_antiuvorot=$dat["mf_antiuvorot"];
$iznos=$d["iznos"];
$iznos_all=$d["tear_max"];
$min_attack=$dat["min_attack"];
$max_attack=$dat["max_attack"];
$add_speed=$dat["add_speed"];
$add_sword=$dat["sword"];
$add_axe=$dat["axe"];
$add_fail=$dat["fail"];
$add_knife=$dat["knife"];
$add_staff=$dat["staff"];
$add_shot=$dat["shot"];
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
$add_velocity=$dat["add_velocity"];


$z=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$d=mysql_fetch_array($z);
if($d["str"]<$min_str or $d["dex"]<$min_dex or $d["con"]<$min_con or $d["vit"]<$min_vinoslivost){
unwear($who,$itm);
}
else{

$desc="";
if($add_str>0){$desc.="\nСила: +$add_str";}else if($add_str<0){$desc.="\nСила: $add_str";}
if($add_dex>0){$desc.="\nЛовкость: +$add_dex";}else if($add_dex<0){$desc.="\nРеакция: $add_dex";}
if($add_con>0){$desc.="\nИнтуиция: +$add_con";}else if($add_con<0){$desc.="\nУдача: $add_con";}
if($add_vinoslivost>0){$desc.="\nНР: +$add_vinoslivost";}else if($add_vinoslivost<0){$desc.="\nУровень ХП: $add_vinoslivost";}
if($mf_crit>0){$desc.="\nМф. крит. удар: +$mf_crit";}else if($mf_crit<0){$desc.="\nМф. крит. удар: $mf_crit";}
if($mf_anticrit>0){$desc.="\nМф. антикрит.: +$mf_anticrit";}else if($mf_anticrit<0){$desc.="\nМф. антикрит.: $mf_anticrit";}
if($mf_uvorot>0){$desc.="\nМф. уворот: +$mf_uvorot";}else if($mf_uvorot<0){$desc.="\nМф. уворот: $mf_uvorot";}
if($mf_antiuvorot>0){$desc.="\nМф. антиуворот: +$mf_antiuvorot";}else if($mf_antiuvorot<0){$desc.="\nМф. антиуворот: $mf_antiuvorot";}
if($add_speed>0){$desc.="\nСкорость: +$add_speed км/ч";}else if($add_speed<0){$desc.="\nСкорость: $add_speed км/ч";}
if($add_velocity>0){$desc.="\nГрузоподъемность: +$add_velocity кг";}else if($add_velocity<0){$desc.="\nГрузоподъемность: $add_velocity кг";}
if($bron_head>0){$desc.="\nБроня головы: +$bron_head";}
if($bron_arm>0){$desc.="\nБроня рук: +$bron_arm";}
if($bron_corp>0){$desc.="\nБроня корпуса: +$bron_corp";}
if($bron_poyas>0){$desc.="\nБроня пояса: +$bron_poyas";}
if($bron_leg>0){$desc.="\nБроня ног: +$bron_leg";}
if($add_sword>0){$desc.="\nВлад. мечом: +$add_sword";}
if($add_axe>0){$desc.="\nВлад. топором: +$add_axe";}
if($add_fail>0){$desc.="\nВлад. молотом: +$add_fail";}
if($add_knife>0){$desc.="\nВлад. кинжалом: +$add_knife";}
if($add_staff>0){$desc.="\nВлад. копьем: +$add_staff";}
if($add_shot>0){$desc.="\nВлад. стрелковым: +$add_shot";}
if($add_arm_l>0){$desc.="\nБездоспешный бой: +$add_arm_l";}
if($add_arm_m>0){$desc.="\nЛегкий доспех: +$add_arm_m";}
if($add_arm_h>0){$desc.="\nТяжелый доспех: +$add_arm_h";}
if($add_fire>0){$desc.="\nСтихия огня: +$add_fire";}
if($add_water>0){$desc.="\nСтихия воды: +$add_water";}
if($add_air>0){$desc.="\nСтихия воздуха: +$add_air";}
if($add_earth>0){$desc.="\nСтихия земли: +$add_earth";}
if($add_cast>0){$desc.="\nКастование: +$add_cast";}
if($add_trade>0){$desc.="\nТорговля: +$add_trade";}
if($add_cure>0){$desc.="\nИсцеление: +$add_cure";}
if($add_walk>0){$desc.="\nПоходы: +$add_walk";}
if($min_attack>0){$desc.="\nМин. урон: $min_attack";}
if($max_attack>0){$desc.="\nМакс. урон: $max_attack";}

if($type=="amulet"){
$w=60;
$h=20;
}
if($type=="sergi"){
$w=60;
$h=20;
}
else if($type=="sword"){
$w=60;
$h=60;
}
else if($type=="axe"){
$w=60;
$h=60;
}
else if($type=="fail"){
$w=60;
$h=60;
}
else if($type=="knife"){
$w=60;
$h=60;
}
else if($type=="staff"){
$w=60;
$h=60;
}
else if($type=="armor"){
$w=60;
$h=80;
}
else if($type=="poyas"){
$w=60;
$h=40;
}
else if($type=="ring"){
$w=20;
$h=20;
}
else if($type=="helmet"){
$w=60;
$h=60;
}
else if($type=="naruchi"){
$w=60;
$h=40;
}
else if($type=="perchi"){
$w=60;
$h=40;
}
else if($type=="shield"){
$w=60;
$h=60;
}
else if($type=="pants"){
$w=60;
$h=80;
}
else if($type=="boots"){
$w=60;
$h=40;
}
else if($type=="acsess"){
$w=60;
$h=60;
}
else if($type=="animal"){
$w=90;
$h=60;
}

print "<img src=img/$img width=$w height=$h alt=\"$name($iznos/$iznos_all)$desc\">";

}
}

/*============ПОКАЗАТЬ ИГРОКА===========================*/
function showPlayer($who){
$result = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);
$amulet=$db["amulet"];
$sergi=$db["sergi"];
$hand_r=$db["hand_r"];
$hand_r_type=$db["hand_r_type"];
$hand_l=$db["hand_l"];
$hand_l_type=$db["hand_l_type"];
$armor=$db["armor"];
$poyas=$db["poyas"];
$obraz=$db["obraz"];
$ring1=$db["ring1"];
$ring2=$db["ring2"];
$ring3=$db["ring3"];
$helmet=$db["helmet"];
$perchi=$db["perchi"];
$naruchi=$db["naruchi"];
$pants=$db["pants"];
$boots=$db["boots"];
$level=$db["level"];
$hp[0]=$db["hp"];
$hp[1]=$db["hp_all"];
$mp[0]=$db["mp"];
$mp[1]=$db["mp_all"];
$str=$db["str"];
$dex=$db["dex"];
$con=$db["con"];
$vit=$db["vit"];
$wis=$db["wis"];
$int=$db["int"];
$acsess1=$db["acsess1"];
$acsess2=$db["acsess2"];
$animal=$db["animal"];
$equip -> showCharacter ();
print "Сила: $str<BR>";
print "Ловкость: $dex<BR>";
print "Интуиция: $con<BR>";
print "Выносливость: $vit<BR>";
if($int>=4){
print "Интеллект: $int<BR>";
}
if($level>=6){
print "Мудрость: $wis<BR>";
}
}
/*============ПОКАЗАТЬ ИГРОКА INF===========================*/
function showPlayer_inf($who){
$result = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);

if (ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$log=htmlspecialchars($log);
$amulet=$db["amulet"];
$sergi=$db["sergi"];
$hand_r=$db["hand_r"];
$hand_r_type=$db["hand_r_type"];
$hand_l=$db["hand_l"];
$hand_l_type=$db["hand_l_type"];
$armor=$db["armor"];
$poyas=$db["poyas"];
$obraz=$db["obraz"];
$ring1=$db["ring1"];
$ring2=$db["ring2"];
$ring3=$db["ring3"];
$helmet=$db["helmet"];
$naruchi=$db["naruchi"];
$perchi=$db["perchi"];
$shield=$db["shield"];
$pants=$db["pants"];
$boots=$db["boots"];
$level=$db["level"];
$hp[0]=$db["hp"];
$hp[1]=$db["hp_all"];
$mp[0]=$db["mp"];
$mp[1]=$db["mp_all"];
$str=$db["str"];
$dex=$db["dex"];
$con=$db["con"];
$vit=$db["vit"];
$wis=$db["wis"];
$int=$db["int"];
$city=$db["city"];
$city_game=$db["city_game"];
$acsess1=$db["acsess1"];
$acsess2=$db["acsess2"];
$animal=$db["animal"];

$online = 0;

$SEARCH = mysql_query("SELECT * FROM online WHERE login = '$who'");
mysql_query("SET CHARSET cp1251");

        if(mysql_fetch_array($SEARCH)){$online = 1;}

$block=$db["block"];
$equip -> showCharacter ($login, "");
?>
<style>
.small {font-size: 9pt; color: #000000}
</style>
<?
print "<center><B>$city</B></center>";
if($online==1){
print "<small>Персонаж сейчас находится в клубе.<BR>";
$room=$db["room"];
print "<center><strong>\"$room\"</strong></center></small>";
}
else if ($db["login"]==Смотритель){
print "<small>Персонаж сейчас находится в клубе.<BR>";
print "<small><center><strong>\"???\"</strong></center></small>";}
else{
print "<small>Персонаж не в клубе или у него выключен чат.</small><BR>";
}
if($db["battle"]!=0){
$id=$db["battle"];
print "<small>Персонаж в <a class=nick href='log.php?log=$id' target=_new2><small>поединке<small></a></small><BR>";
}

}

/*=============ПОКАЗАТЬ ХП/МАНУ=========================*/
function showHPMP($who){
$result = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);
if (ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$log=htmlspecialchars($log);
$level=$db["level"];
$wis=$db["wis"];
$hp[0]=$db["hp"];
$hp[1]=$db["hp_all"];
$cure_hp=$db["cure_hp"];
$mp[0]=$db["mp"];
$mp[1]=$db["mp_all"];
$orden_d = $db["orden"];
$clan_s  = $db["clan_short"];
$clan_f  = $db["clan"];
$travm   = $db["travm"];
$rang = $db["rang"];
$time_to_cure=$cure_hp-time();
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
</table><span id=\"info\"></span>";?>


<script language=javascript>
setsHP(<?echo "$hp[0],$hp[1],100"?>);
<?
if($level>=6 && $wis!=0){
?>
showMN(<?echo "$mp[0],$mp[1]"?>);
<?
}
?>
var rnd = Math.random();
//-- Смена хитпоинтов
var delay = 123;    // Каждые 123сек. увеличение HP на 1%
var redHP = 0.33;    // меньше 30% красный цвет
var yellowHP = 0.66;    // меньше 60% желтый цвет, иначе зеленый
var TimerOn = -1;    // id таймера
var tkHP, maxHP;
var speed=1000;
var mspeed=100;

function setsHP(value, max, newspeed) {
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
document.write("<table border=0 cellpadding=0 cellspacing=0 width=260 height=8 bgcolor=#dedede><tr><td><small>"+min+"/"+max+"&nbsp;</small></td><td align=right width=100%><img src="+color+" alt='Уровень маны' height=8 width="+m2+"%><img src='img/icon/grey.gif' alt='Уровень маны' height=8 width="+m1+"%></td><td><span style=\"width:1px; height:10px\"></span></td><td align=right><img border=0 src=img/icon/Mherz.gif alt='Уровень маны' width=10 height=9></td></tr></table>");
}

</script>

<?
}
/*======================================================*/

/*=============ПОКАЗАТЬ ХП/МАНУ BOT=========================*/
function showHPMPBot($who,$bid){
if (ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$log=htmlspecialchars($log);
$result = mysql_query("SELECT * FROM bot_temp WHERE bot_name='$who' AND battle_id='$bid'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);
$prototype = $db["prototype"];
$SQL_P = mysql_query("SELECT * FROM characters WHERE login='$prototype'");
mysql_query("SET CHARSET cp1251");
$db_p = mysql_fetch_array($SQL_P);

$level=$db_p["level"];
$wis=$db_p["wis"];
$hp[0]=$db["hp"];
$hp[1]=$db["hp_all"];
$mp[0]=$db["mp"];
$mp[1]=$db["mp_all"];
$orden_d = $db_p["orden"];
$clan_s  = $db_p["clan_short"];
$clan_f  = $db_p["clan"];

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
        else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}

print "<table valign=\"bottom\" border=0 cellpadding=0 cellspacing=0 width=260><tr valign=\"bottom\"><td align=\"center\" valign=\"bottom\" bgcolor=#dedede><center><b>$orden$clan$who&nbsp</b>[$level]<a href=info.php?log=$who target=_new><img src=img/inf.gif border=0 alt=\"Информация о $who\"></a>$travm_i</td></tr>
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
/*======================================================*/

/*=====================ПОЛУЧИТЬ ТРАВМУ===========================*/
function getTravm($who,$travmType){
$QUERY=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");

$data=mysql_fetch_array($QUERY);

$time_now=time();
if($travmType==1){$time=rand(15,45);}
else if($travmType==2){$time=rand(45,90);}
else if($travmType==3){$time=rand(90,180);}

$behaviour=array();
$behaviour[0]="str";
$behaviour[1]="dex";
$behaviour[2]="con";

$kill_stat=$behaviour[rand(0,2)];
$stat=$data["$kill_stat"];
$kill_time=$time_now+$time*60;
$min_s = ($stat/100)*($travmType*20);
$write_stat=floor($stat-$min_s);

if($who!='Бот'){
$QUERY2=mysql_query("UPDATE characters SET $kill_stat='$write_stat',travm_var='$travmType',travm='$kill_time',travm_stat='$kill_stat',travm_old_stat='$stat' WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
}
}
/*===============================================================*/
/*================Восстановить хп================================*/
function cureHP($who,$beg,$fin){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$data=mysql_fetch_array($query);
$hp_all=$data["hp_all"];

$r=$fin-$beg;
$raznica=floor((($fin-$beg)/$hp_all)*100);
$time_to_cure=($raznica*1200)/100;
$put_to_base=time()+$time_to_cure;

}

/*===============================================================*/
/*==========передать злотые======================================*/
function give_money($who,$to,$sum){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$data=mysql_fetch_array($query);
$who_money=$data["money"]-$sum;

$query2=mysql_query("SELECT * FROM characters WHERE login='$to'");
mysql_query("SET CHARSET cp1251");
$data2=mysql_fetch_array($query2);
$to_money=$data2["money"]+$sum;

          if($data["money"]>=$sum && $sum>0){
          $uq=mysql_query("UPDATE characters SET money='$who_money' WHERE login='$who'");
          mysql_query("SET CHARSET cp1251");
          $tq=mysql_query("UPDATE characters SET money='$to_money' WHERE login='$to'");
          mysql_query("SET CHARSET cp1251");

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
          $sum_t="$sum кр.";
          history($who,'передал',$sum_t,$ip,$to);
          history($to,'получил',$sum_t,'none',$who);
          $gived=1;
          print "<script>top.ref.location.reload()</script>";
          print "Переведено удачно!";
          }
          else{print "<font color=red>У вас нет такой суммы!</font>";
          }
}
/*===============================================================*/
/*=====================подарить==================================*/
function gift($who,$itm,$to){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section) or ereg("[<>\\/-]",$target)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$target=htmlspecialchars($target);
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$data=mysql_fetch_array($query);

$q=mysql_query("select * from inv where id=$itm");
mysql_query("SET CHARSET cp1251");
$rrr=mysql_fetch_array($q);
$obj_type=$rrr["object_type"];
$obj_id=$rrr["object_id"];

$q2=mysql_query("select * from $obj_type where id=$obj_id");
mysql_query("SET CHARSET cp1251");
$item_info=mysql_fetch_array($q2);
$name=$item_info["name"];
      if($rrr["owner"]==$who){
         if($rrr["gift"]==1){
         print "<script>location.href='main.php?act=inv&section=obj';</script>";
         die();
         }
         else
         {
         $q1=mysql_query("UPDATE inv SET owner='$to',gift='1',gift_author='$who' WHERE id=$itm");
         mysql_query("SET CHARSET cp1251");
             if($q1){

                  if(empty($ip)){
                   if (getenv('HTTP_X_FORWARDED_FOR'))
                        {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                        }
                        else
                        {
                        $ip=getenv('REMOTE_ADDR');
                        }
                   }
             history($who,'подарил',$name,$ip,$to);
             history($to,'принял в подарок',$name,'none',$who);
             print "<script>location.href='main.php?act=perevod&target=$to';</script>";
             print "<script>top.ref.location.reload()</script>";
             }
         }
      }
}
/*=====================передать==================================*/
function give($who,$itm,$to){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section) or ereg("[<>\\/-]",$target)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$target=htmlspecialchars($target);
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$data=mysql_fetch_array($query);

$q=mysql_query("select * from inv where id=$itm");
mysql_query("SET CHARSET cp1251");
$rrr=mysql_fetch_array($q);
$obj_type=$rrr["object_type"];
$obj_id=$rrr["object_id"];

$q2=mysql_query("select * from $obj_type where id=$obj_id");
mysql_query("SET CHARSET cp1251");
$item_info=mysql_fetch_array($q2);
$name=$item_info["name"];

      if($rrr["owner"]==$who){
         if($rrr["gift"]==1){
         print "<script>location.href='main.php?act=perevod&target=$to';</script>";
         die();
         }
         else
         {
         $s1="UPDATE inv SET owner='$to' WHERE id=$itm";
         $q1=mysql_query($s1);
         mysql_query("SET CHARSET cp1251");
             if($q1){

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
             history($who,'передал',$name,$ip,$to);
             history($to,'принял',$name,'none',$who);
             print "<script>location.href='main.php?act=perevod&target=$to';</script>";
             print "<script>top.ref.location.reload()</script>";
             }
         }
      }
}
/*=================RefTopFrame===================================*/
function BattleTest($who){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$data=mysql_fetch_array($query);

      if($data["battle"] == 0){
      $T1 = mysql_query("SELECT * FROM team1");
      $T2 = mysql_query("SELECT * FROM team2");
mysql_query("SET CHARSET cp1251");
            while($TD1 = mysql_fetch_array($T1)){
            $p = $TD1["player"];
                    if($p == $who){
                    $battle = $TD1["battle_id"];
                    $Z = mysql_query("SELECT status FROM zayavka WHERE creator = $battle");
                    mysql_query("SET CHARSET cp1251");
                    $ZD = mysql_fetch_array($Z);
                        if($ZD["status"]==3){
                         goBattle($who);
                        }
                    }
            }
            while($TD2 = mysql_fetch_array($T2)){
            $p = $TD2["player"];
                  if($p == $who){
                  $battle = $TD2["battle_id"];
                  $Z = mysql_query("SELECT status FROM zayavka WHERE creator = $battle");
                  mysql_query("SET CHARSET cp1251");
                  $ZD = mysql_fetch_array($Z);
                       if($ZD["status"]==3){
                        goBattle($who);
                       }
                   }
            }
      }
}
/*=============unwear thing======================================*/
function unwear_t($who,$item_id){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$S = mysql_query("SELECT * FROM inv WHERE owner = '$who' AND object_razdel = 'thing' AND id='$item_id'");
mysql_query("SET CHARSET cp1251");
     while($DATA = mysql_fetch_array($S)){
     $object_type = $DATA["object_type"];
     $object_id = $DATA["object_id"];

        if($object_type=="medal"){
        $SI = mysql_query("SELECT * FROM medal WHERE id='$object_id'");
        mysql_query("SET CHARSET cp1251");
        $D = mysql_fetch_array($SI);
        $add_l = $D["add_l"];
        $add_u = $D["add_u"];
        $S_U = mysql_query("SELECT * FROM characters WHERE login='$who'");
        mysql_query("SET CHARSET cp1251");
        $D_U = mysql_fetch_array($S_U);
        $new_l = $D_U["dex"] - $add_l;
        $new_u = $D_U["con"] - $add_u;
        $U_U = mysql_query("UPDATE characters SET dex='$new_l',con='$new_u' WHERE login='$who'");
        mysql_query("SET CHARSET cp1251");
        $O_U = mysql_query("UPDATE inv SET wear = '0' WHERE id=$item_id");
        mysql_query("SET CHARSET cp1251");
        print "<script>location.href='main.php?act=inv&section=thing'</script>";
        }
     }
}
/*===============wear thing======================================*/
function wear_t($who,$item_id){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$section)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$section=htmlspecialchars($section);
$S = mysql_query("SELECT * FROM inv WHERE owner = '$who' AND object_razdel = 'thing' AND id='$item_id'");
mysql_query("SET CHARSET cp1251");
$DATA = mysql_fetch_array($S);
$object_type = $DATA["object_type"];
$object_id = $DATA["object_id"];

        if($object_type=="medal"){
        $SI = mysql_query("SELECT * FROM medal WHERE id='$object_id'");
        mysql_query("SET CHARSET cp1251");
        $D = mysql_fetch_array($SI);
        $add_l = $D["add_l"];
        $add_u = $D["add_u"];
        $S_U = mysql_query("SELECT * FROM characters WHERE login='$who'");
        mysql_query("SET CHARSET cp1251");
        $D_U = mysql_fetch_array($S_U);
        $new_l = $D_U["dex"] + $add_l;
        $new_u = $D_U["con"] + $add_u;
        $U_U = mysql_query("UPDATE characters SET dex='$new_l',con='$new_u' WHERE login='$who'");
        mysql_query("SET CHARSET cp1251");
        $O_U = mysql_query("UPDATE inv SET wear = '1' WHERE id=$item_id");
        mysql_query("SET CHARSET cp1251");
        print "<script>location.href='main.php?act=inv&section=thing'</script>";
        }
}
/*===============================================================*/
function printShortInf($who){
$SQL = mysql_query("SELECT orden,clan,clan_short,level FROM `characters` WHERE login='$who'");
$DATA = mysql_fetch_array($SQL);
$orden_d = $DATA["orden"];
$clan = $DATA["clan"];
$clan_s = $DATA["clan_short"];

        if($orden_d==1){$orden_dis="Орден Темплиеров.";}
        else if($orden_d==2){$orden_dis="Орден Некромантов.";}
        else if($orden_d==3){$orden_dis="Орден Феникса.";}
        else if($orden_d==4){$orden_dis="Орден Друидов.";}
        else if($orden_d==5){$orden_dis="Тюремный заключеный.";}
        if(empty($clan_s)){$clan_i="";}
        else{$clan_i="<img src='img/clan/$clan_s.gif' border=0 alt='$clan'>";}
        if(empty($orden_d)){$orden="";}
        else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}

        return $orden.$clan_i.$who."[".$DATA["level"]."]<a href=info.php?log=$who target=_new_$who><img src=img/h.gif border=0 alt='Информация о персонаже $who'></a>";
}
/*==============shut say=========================================*/
function knut_say($phrase,$who){
$result = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($result);
$login=$to;
$room=$db["room"];
$city=$db["city_game"];

        $chas = date("H");
        $minute = date("i");
        $mes = date("m");
        $dat = date("d");
        $year = date("Y");

        $dname=date("d.m.Y.H", mktime($chas-$GSM));
        $d=date("H:i:s", mktime($chas-$GSM));

        $S = mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city)
        VALUES('$d','Кнут','$room','$phrase','us','".time()."','$city')");
        mysql_query("SET CHARSET cp1251");
}
/*===============================================================*/
function move($who,$dest){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$data=mysql_fetch_array($query);

        if($dest == "mountown_forest"){
        $destenation = "mountown_forest";
        $dest_game = "Лагерь лесорубов";
        $len = "900.00";/*метров*/
        $room = "forespath";
        $napr = "северо-северо-запад";
        }
        if($dest == "Mountown"){
        $destenation = "Mountown";
        $dest_game = "Mountown";
        $len = "900.00";/*метров*/
        $room = "mountownpath";
        $napr = "юго-юго-восток";
        }

$speed = $data["speed"];

$time_to_go = time()+floor($len/$speed*3600);/*секунд идти*/
$S = mysql_query("INSERT INTO goers(login,time,destenation,dest_game,len,len_done,napr) VALUES('$who','$time_to_go','$dest','$dest_game','$len','0','$napr')");
print "<script>location.href='main.php?act=go&room_go=$room'</script>";
mysql_query("SET CHARSET cp1251");
}

/*===============================================================*/
function river2($who){
$query = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($query);

$LOOK_Q = mysql_query("SELECT login FROM river");
    while($LOOK = mysql_fetch_Array($LOOK_Q)){
     if($LOOK["login"] == $who){
      print "Вы уже добываете ресурс.";
      die();
     }
    }

         $INS = mysql_query("INSERT INTO river(login,time,resource) VALUES('$who','$time','riba')");
         print "<script>location.href='main.php'</script>";
}
/*===============================================================*/
function testRiver($who){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
$db=mysql_fetch_array($query);

$LOOK = mysql_query("SELECT * FROM river WHERE login = '$who'");
    while($data = mysql_fetch_array($LOOK)){
        if($data["login"] == $who){

               print "<script>location.href='river2.php?login=";
    print($who);
    print"'</script>";
        }
    }

}
/*========================================================*/
function river($who,$type,$step){
$S = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($S);


   if($step == 0){
    print "<form name=\"river\" action=\"main.php\" METHOD=\"POST\">";
    print "Рыбачить:<BR>\n";
    print "<input type=hidden name=\"res_count\" value=1>";
    print "&nbsp&nbsp&nbsp<input type=submit class=but value=\"начать\">";
    print "</form>";
   }
   else{
    river2($who);
   }
}
/*===============================================================*/
function mine($who,$locate,$count){
$query = mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db = mysql_fetch_array($query);

$RES_SQL = mysql_query("SELECT * FROM res WHERE locate='$locate'");
mysql_query("SET CHARSET cp1251");
$RES_DATA = mysql_fetch_array($RES_SQL);
$res = $RES_DATA["type"];

$LOOK_Q = mysql_query("SELECT login FROM miners");
mysql_query("SET CHARSET cp1251");
    while($LOOK = mysql_fetch_Array($LOOK_Q)){
     if($LOOK["login"] == $who){
      print "Вы уже добываете ресурс.";
      die();
     }
    }

$navik = array(
 "dub" => "navik_wood",
 "bereza" => "navik_wood",
);
$time = array(
 "dub" => "400",
 "bereza" => "300",
);

$time = time()+floor($count*$time[$locate]/(1 + $db["$navik[$locate]"]));

$crime = 40;
$crime_ar=array();

        for($i=0;$i<=$crime;$i++){
        $crime_ar[$i]=$i;
        }
        for($i=$crime+1;$i<=100;$i++){
        $crime_ar[$i]="empty";
        }

$crime_numer=rand(0,100);

$is_crime="0";

        for($i=0;$i<=100;$i++){
                if($crime_numer==$crime_ar[$i]){
                $is_crime="1";
                }
        }

        if($is_crime == 1){
         $at = rand(1,3);
                if($at == 1){$attacker = 'razboynik';}
                if($at == 2 OR $at == 3){$attacker = 'wolf';}
         attack($who,$attacker,'1');
        die();
        }else if($res["resource"]>$count){
         $DEL = mysql_query("UPDATE res SET resource=resource-$count WHERE locate='$locate'");
         mysql_query("SET CHARSET cp1251");
         $INS = mysql_query("INSERT INTO miners(login,time,resource,count,type) VALUES('$who','$time','wood','$count','$locate')");
         print "<script>location.href='main.php'</script>";
         mysql_query("SET CHARSET cp1251");
        }else{
         print "На участке нет такого колличества ресурсов.";
        }
}
/*===============================================================*/
function testMine($who){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db=mysql_fetch_array($query);

$LOOK = mysql_query("SELECT * FROM miners WHERE login = '$who'");
mysql_query("SET CHARSET cp1251");
    while($data = mysql_fetch_array($LOOK)){
        if($data["login"] == $who){

        $to_mine = floor(($data["time"] - time())/60);/*minutes*/
        $to_mine_sec = floor(($data["time"] - time()));/*seconds*/
        $hours = floor($to_mine/60);
        $min = $to_mine - $hours*60;

        if($data["resource"] == "wood"){$res_class = "Дерево";}
        if($data["type"] == "dub"){$res_type = "Дуб";}

                if($to_mine>0){
                print "Вы добываете <B>$res_class</B><BR>";
                print "Тип ресурса: <B>$res_type</B><BR>";
                print "Добывать еще <B>$hours ч. $min мин.</B><BR><BR>";
                print "<input type=button onclick=\"javascript:location.reload()\" value=\"Обновить\" name=\"refresh\" size=20 style=\"BACKGROUND-COLOR: #E4E4E4; BORDER-BOTTOM: #000000 1px solid;
BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 11px;\">";
                die();
                }
                else{
                $res = $data["resource"];
                $type = $data["type"];
                $count = $data["count"];
                if($type == "dub"){$res_type = 1;}
                for($i=1;$i<=$count;$i++){
                $SSS = mysql_query("INSERT INTO inv(owner,object_id,object_type,object_razdel,gift,wear,iznos) VALUES('$who','$res_type','$res','thing','0','0','0')");
                mysql_query("SET CHARSET cp1251");
                }
                $S = mysql_query("DELETE FROM miners WHERE login='$who'");
                mysql_query("SET CHARSET cp1251");
                $UP = mysql_query("UPDATE characters SET navik_wood=navik_wood+0.0*$count WHERE login='$who'");
                print "Вы удачно добыли <B>$count</B> ед. ресурсов.<BR>";
                mysql_query("SET CHARSET cp1251");
                die();
                }
        }
    }

}
/*===============================================================*/
function addBot($who,$bot,$bot_name){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db=mysql_fetch_array($query);

$COUNT = mysql_query("SELECT id FROM battles");
mysql_query("SET CHARSET cp1251");
$all = mysql_num_rows($COUNT);

$bid = $all+1;

$GET_BOT = mysql_query("SELECT * FROM characters WHERE login='$bot'");
mysql_query("SET CHARSET cp1251");
$GBD = mysql_fetch_array($GET_BOT);
$hp = $GBD["hp_all"];
$hp_all = $hp;
$mp = $GBD["mp_all"];
$mp_all = $mp;

$add_bot = mysql_query("INSERT INTO bot_temp(bot_name,hp,hp_all,battle_id,prototype,team,mp,mp_all) VALUES('$bot_name','$hp','$hp_all','$bid','$bot','2','$mp','$mp_all')");
mysql_query("SET CHARSET cp1251");
$kick_temp = mysql_query("DELETE FROM team2 WHERE player='$bot'");
mysql_query("SET CHARSET cp1251");

}
/*===============================================================*/
function attack($who,$attacker,$dif){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
$db=mysql_fetch_array($query);
$level=$db["level"];

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

        if($attacker == "razboynik"){
        $prototype = "Разбойник";
        $name = "Разбойник";
        }

        if($attacker == "tester"){
        $prototype = "Гоблин [$level]";
        $name = "Гоблин [$level]";
        }

        if($attacker == "wolf"){
        $prototype = "Волк";
        $name = "Волк";
        }


        $mine_id=$db["id"];

        $Z = mysql_query("INSERT INTO zayavka(status,type,timeout,creator) VALUES('3','1','80','$mine_id')");
        $T1 = mysql_query("INSERT INTO team1(player,ip,battle_id,hitted,over) VALUES('$who','$ip','$mine_id','0','0')");
        $T1 = mysql_query("INSERT INTO team2(player,ip,battle_id,hitted,over) VALUES('$prototype','$ip','$mine_id','0','0')");

        addBot($who,$prototype,$name);
        say($who,"Внимание!!! На Вас напал &quot$prototype&quot!!!",$who);
        goBattle($who);

}
/*==============Вызов бота==================================================*/
/*===============================================================*/
function startTrain($who){
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
mysql_query("SET CHARSET cp1251");
$db=mysql_fetch_array($query);

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
        if ($db["level"]==0){
        $bot_name = array();
        $bot_name[0] = "Бот";
        $bot_name[1] = "Бот2";
        $bot_name[2] = "Бот3";
        $bot_name[3] = "Бот4";
        $bot_name[4] = "Бот5";
        $bot_name[5] = "Бот6";
        $bot_name[6] = "Бот7";
        }
        elseif ($db["level"]==1) {
        $bot_name = array();
        $bot_name[0] = "Бот8";
        $bot_name[1] = "Бот9";
        $bot_name[2] = "Бот10";
        $bot_name[3] = "Бот11";
        $bot_name[4] = "Бот12";
        $bot_name[5] = "Бот13";
        $bot_name[6] = "Бот14";
        $bot_name[7] = "Бот15";
        }
        elseif ($db["level"]==2) {
        $bot_name = array();
        $bot_name[0] = "Тестер_01";
        $bot_name[1] = "Тестер_02";
        $bot_name[2] = "Тестер_03";
        $bot_name[3] = "Тестер_04";
        $bot_name[4] = "Тестер_05";
        $bot_name[5] = "Тестер_06";
        $bot_name[6] = "Тестер_07";
        $bot_name[7] = "Тестер_08";
        $bot_name[8] = "Тестер_09";
        $bot_name[9] = "Тестер_10";
        }
        elseif ($db["level"]==3) {
        $bot_name = array();
        $bot_name[0] = "Тестер_11";
        $bot_name[1] = "Тестер_12";
        $bot_name[2] = "Тестер_13";
        $bot_name[3] = "Тестер_14";
        $bot_name[4] = "Тестер_15";
        $bot_name[5] = "Тестер_16";
        $bot_name[6] = "Тестер_17";
        $bot_name[7] = "Тестер_18";
        $bot_name[8] = "Тестер_19";
        $bot_name[9] = "Тестер_20";
        }
        else {
        $bot_name = array();
        $bot_name[0] = "Тестер_21";
        $bot_name[1] = "Тестер_22";
        $bot_name[2] = "Тестер_23";
        $bot_name[3] = "Тестер_24";
        $bot_name[4] = "Тестер_25";
        $bot_name[5] = "Тестер_26";
        $bot_name[6] = "Тестер_27";
        $bot_name[7] = "Тестер_28";
        $bot_name[8] = "Тестер_29";
        $bot_name[9] = "Тестер_30";
        }
        $bot_rand = $bot_name[rand(0,count($bot_name)-1)];
        $prototype = $bot_rand;
        $name = "Бот";


        $mine_id=$db["id"];

        $Z = mysql_query("INSERT INTO zayavka(status,type,timeout,creator) VALUES('3','1','80','$mine_id')");
        $T1 = mysql_query("INSERT INTO team1(player,ip,battle_id,hitted,over) VALUES('$who','$ip','$mine_id','0','0')");
        $T1 = mysql_query("INSERT INTO team2(player,ip,battle_id,hitted,over) VALUES('$prototype','$ip','$mine_id','0','0')");

        addBot($who,$prototype,$name);
        goBattle($who);
}
/*====================показать заголовок боя=============================*/
function showHeader($who){
$QUERY_DATA=mysql_query("SELECT * FROM characters WHERE login='$who'");
$USER_DATA=mysql_fetch_array($QUERY_DATA);
$battle = $USER_DATA["battle"];

$creator = $USER_DATA["battle_pos"];
$team1_printed = "";
$team2_printed = "";

$T1 = mysql_query("SELECT * FROM team1 WHERE battle_id='$creator'");
        while($T1_DATA = mysql_fetch_array($T1)){
        $player1   = $T1_DATA["player"];
        $SQL_USER = "SELECT * FROM characters WHERE login='$player1'";
        $QUERY    = mysql_query($SQL_USER);
        $USER     = mysql_fetch_array($QUERY);
        $player   = $USER["login_sec"];
        $hp_now   = $USER["hp"];
        $hp_all   = $USER["hp_all"];
        $level    = $USER["level"];
        $orden    = $USER["orden"];
        $clan     = $USER["clan"];
        $clan_s   = $USER["clan_short"];
        $rang   = $USER["rang"];

                if($orden==1){$orden_dis="Белое братство";}
                else if($orden==2){$orden_dis="Темное братство";}
                else if($orden==3){$orden_dis="Нейтральное братство";}
                else if($orden==4){$orden_dis="Алхимик";}
                else if($orden==5){$orden_dis="Тюремный заключеный";}
                if(empty($clan)){$clan_img="";}
                else{$clan_img="<img src='img/clan/$clan_s.gif' border=0 alt='$clan'>";}
                if(empty($orden)){$orden_img="";}
            else{
if ($orden==2) {$orden_img="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";}
else{$orden_img="<img src='img/orden/$orden.gif' border=0 alt='$orden_dis'>";}
if ($orden==1) {$orden_img="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} }
                if($hp_now>0){
                if($player==$who){
                $team1_printed.="$orden_img$clan_img$player [$hp_now/$hp_all] ";
                }
                else{
                $team1_printed.="$orden_img$clan_img<a href=\"javascript:to('$player');\" class=p1>$player</a> [$hp_now/$hp_all] ";
                }
                }
        }

$T2 = mysql_query("SELECT * FROM team2 WHERE battle_id='$creator'");
        while($T2_DATA = mysql_fetch_array($T2)){
        $player1   = $T2_DATA["player"];
        $SQL_USER = "SELECT * FROM characters WHERE login='$player1'";
        $QUERY    = mysql_query($SQL_USER);
        $USER     = mysql_fetch_array($QUERY);
        $player   = $USER["login_sec"];
        $hp_now   = $USER["hp"];
        $hp_all   = $USER["hp_all"];
        $level    = $USER["level"];
        $orden    = $USER["orden"];
        $clan     = $USER["clan"];
        $clan_s   = $USER["clan_short"];
        $rang   = $USER["rang"];

                if($orden==1){$orden_dis="Белое братство";}
                else if($orden==2){$orden_dis="Темное братство";}
                else if($orden==3){$orden_dis="Нейтральное братство";}
                else if($orden==4){$orden_dis="Алхимик";}
                else if($orden==5){$orden_dis="Тюремный заключеный";}
                if(empty($clan)){$clan_img="";}
                else{$clan_img="<img src='img/clan/$clan_s.gif' border=0 alt='$clan'>";}
                if(empty($orden)){$orden_img="";}
            else{
if ($orden==2) {$orden_img="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";}
else{$orden_img="<img src='img/orden/$orden.gif' border=0 alt='$orden_dis'>";}
if ($orden==1) {$orden_img="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} }
                if($hp_now>0){
                if($player==$who){
                $team2_printed.="$orden_img$clan_img$player [$hp_now/$hp_all] ";
                }
                else{
                $team2_printed.="$orden_img$clan_img<a href=\"javascript:to('$player');\" class=nick>$player</a> [$hp_now/$hp_all] ";
                }
                }
        }

$bot = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$battle'");
        while($BDATA = mysql_fetch_array($bot)){
        $prototype = $BDATA["prototype"];
        $player = $BDATA["bot_name"];
        $SQL_BOT = mysql_query("SELECT * FROM characters WHERE login='$prototype'");
        $BOT = mysql_fetch_array($SQL_BOT);
        $level = $BOT["level"];
        $hp_now = $BDATA["hp"];
        $hp_all = $BDATA["hp_all"];
                if($BDATA["team"]==1 AND $hp_now>0){
                $team1_printed.="<a href=\"javascript:to('$player');\" class=nick>$player</a> [$hp_now/$hp_all] ";
                }
                else if($BDATA["team"]==2 AND $hp_now>0){
                $team2_printed.="<a href=\"javascript:to('$player');\" class=nick>$player</a> [$hp_now/$hp_all] ";
                }
        }

print "<center><span class=p1>$team1_printed</span> <B>VS</B> <span class=p2>$team2_printed</span><br>";
}
/*=======================================================================*/
function hit_dis($attack,$defend,$type,$blocked,$hit,$hand){
   if($type!=2){       //если не бот
   $ATTACK_QUERY = mysql_query("SELECT * FROM characters WHERE login='$attack'");
   $ATTACK_DATA  = mysql_fetch_array($ATTACK_QUERY);
   }
   else if($type == 2){ //если бот
   $logen = $_SESSION["login"];
   $logen_SQL = mysql_fetch_array(mysql_query("SELECT * FROM characters WHERE login='$logen'"));
   $battlen_id = $logen_SQL["battle"];
   $ATT_SQL = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$battlen_id'");
   $ATT_DATA = mysql_fetch_array($ATT_SQL);

   $ATTACK_QUERY = mysql_query("SELECT * FROM characters WHERE login='".$ATT_DATA["prototype"]."'");
   $ATTACK_DATA  = mysql_fetch_array($ATTACK_QUERY);
   }

   if($type!=1){       //если не бот
   $DEFEND_QUERY = mysql_query("SELECT * FROM characters WHERE login='$defend'");
   $DEFEND_DATA  = mysql_fetch_array($DEFEND_QUERY);
   }
   else if($type == 1){ //если бот
   $logen = $_SESSION["login"];
   $logen_SQL = mysql_fetch_array(mysql_query("SELECT * FROM characters WHERE login='$logen'"));
   $battlen_id = $logen_SQL["battle"];
   $DEF_SQL = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$battlen_id'");
   $DEF_DATA = mysql_fetch_array($DEF_SQL);
   $prototype = $DEF_DATA["prototype"];

   $DEFEND_QUERY = mysql_query("SELECT * FROM characters WHERE login='$prototype'");
   $DEFEND_DATA  = mysql_fetch_array($DEFEND_QUERY);
   }

$chas = date("H");

        if($type!=2){
        $battle_id = $ATTACK_DATA["battle"];
        }
        else if($type == 2){
        $battle_id = $DEFEND_DATA["battle"];
        }

include "calc_g.php";

        /*=====расчет уворота=========================*/
        $p2_mk=array();
        for($i=0;$i<=$mf_uvorot;$i++){
        $p2_mk[$i]=$i;
        }
        for($i=$mf_uvorot+1;$i<=100;$i++){
        $p2_mk[$i]="empty";
        }

        $uvorot_numer=rand(0,100);

        $is_uvorot="0";
        for($i=0;$i<=100;$i++){
                if($uvorot_numer==$p2_mk[$i]){
                $is_uvorot="1";
                }
        }
        /*=============================================*/
        /*=====расчет критического удара===============*/
        $p1_mk=array();
        for($i=0;$i<=$mf_crit;$i++){
        $p1_mk[$i]=$i;
        }
        for($i=$mf_crit+1;$i<=100;$i++){
        $p1_mk[$i]="empty";
        }

        $crit_numer=rand(0,100);

        $is_crit="0";
        for($i=0;$i<=100;$i++){
                if($crit_numer==$p1_mk[$i]){
                $is_crit="1";
                }
        }
        /*=============================================*/
        /*=====расчет удара на травму===============*/
        $p1_mt=array();
        for($i=0;$i<=$mf_crit/2;$i++){
        $p1_mt[$i]=$i;
        }
        for($i=$mf_crit/2+1;$i<=100;$i++){
        $p1_mt[$i]="empty";
        }

        $travm_numer=rand(0,100);

        $is_travm="0";
        for($i=0;$i<=100;$i++){
                if($travm_numer==$p1_mt[$i]){
                $is_travm="1";
                }
        }
        /*=============================================*/

        $date = date("H:i", mktime($chas-$GSM));

    if($type!=2){
       if($ATTACK_DATA["battle_team"] == 1){
       $span1 = "p1";
       $span2 = "p2";
       }else{
       $span1 = "p2";
       $span2 = "p1";
       }
    }
    else if($type==2){
       if($ATT_DATA["team"] == 1){
       $span1 = "p1";
       $span2 = "p2";
       }else{
       $span1 = "p2";
       $span2 = "p1";
       }
    }


        if($ATTACK_DATA["sex"] == "male"){
        $pref = "";
        }
        else{
        $pref = "а";
        }

        if($DEFEND_DATA["sex"] == "male"){
        $pref_d = "";
        }
        else{
        $pref_d = "а";
        }

        include "hit_dis.php";

        $hit_dis=array();
        $hit_dis[1]=$head_dis[rand(0,count($head_dis)-1)];
        $hit_dis[2]=$corp_dis[rand(0,count($corp_dis)-1)];
        $hit_dis[3]=$poyas_dis[rand(0,count($poyas_dis)-1)];
        $hit_dis[4]=$leg_dis[rand(0,count($leg_dis)-1)];

        $hit_dis_phisic=array();
        $hit_dis_phisic[0]="хитро показав колено ударил$pref пальцем в";
        $hit_dis_phisic[1]="подпрыгнув на левой ноге вмазал$pref ногой в ";
        $hit_dis_phisic[2]="недолго думая плюнул$pref в";
        $hit_dis_phisic[3]="засучив рукава и дико вертя глазами ударил$pref кулаком в";

        $hit_dis_txt=$hit_dis_phisic[rand(0,3)];

        $crit_hit_1 = $crit_dis_1[rand(0,count($crit_dis_1)-1)];
        $crit_hit_2 = $crit_dis_2[rand(0,count($crit_dis_2)-1)];
        $uvorot_1 = $uv_dis_1[rand(0,count($uv_dis_1)-1)];/*tryed*/
        $uvorot_2 = $uv_dis_2[rand(0,count($uv_dis_2)-1)];/*but lovkiy*/
        $uvorot_3 = $uv_dis_3[rand(0,count($uv_dis_3)-1)];/*otprignul*/

        if($hit == 1){$bronya = $defend_bron_h ;}
        else if($hit == 2){$bronya_m = $defend_bron_c ;}
        else if($hit == 3){$bronya_m = $defend_bron_p ;}
        else if($hit == 4){$bronya_m = $defend_bron_l ;}

        $def_mass = $DEFEND_DATA["mass"];
        if($def_mass == 0){$def_armor = "no_armor";}
        if($def_mass <= 20){$def_armor = "light_armor";}
        if($def_mass > 20){$def_armor = "heavy_armor";}

        $navik_armor = $DEFEND_DATA["$def_armor"];

        $bronya = floor(($navik_armor/100 + 1)*$bronya_m);

        $hit_t = rand($attack_maxhit,$attack_minhit);
        if($bronya>=$hit_t){
        $hit_k = 0;
        }
        else{
        $hit_k = $hit_t-$bronya;
        }

        if($blocked == 1){
        $phrase = "<span class=date>$date</span> <span class=$span1>$attack</span> хотел$pref ударить в $hit_dis[$hit], но <span class=$span2>$defend</span> заблокировал удар.<BR>";
        }
        else if($is_uvorot == 1){
        $phrase = "<span class=date>$date</span> <span class=$span1>$attack</span> $uvorot_1 $hit_dis[$hit], $uvorot_2 <span class=$span2>$defend</span> $uvorot_3.<BR>";
        }
        else if($is_crit == 1){
        $hit_k = $hit_k*2;

        if($type==2 || $type == 0){
        $hp_all = $DEFEND_DATA["hp_all"];
        $hp_now = $DEFEND_DATA["hp"];
        }
        else if($type != 2 && $type!=0){
        $hp_all = $DEF_DATA["hp_all"];
        $hp_now = $DEF_DATA["hp"];
        }
        $hp_new = $hp_now - $hit_k;


                if($hit_k >= $hp_now){

                $hp_new = 0;
                if($type == 2 || $type == 0){
                $S = mysql_query("SELECT sex FROM characters WHERE login='$defend'");
                $SS = mysql_fetch_array($S);
                }
                else if($type == 1 && $type!=0){
                $S = mysql_query("SELECT sex FROM characters WHERE login='$prototype'");
                $SS = mysql_fetch_array($S);
                }

                        if($SS["sex"]=="male"){$p="";}
                        else{$p="а";}

                        if($is_travm == 1 AND $DEFEND_DATA["travm"]==0){
                                $percent = $hp_all/100;
                                if($hit_k<$percent*20){
                                $travm = 1;
                                }
                                else if($hit_k>=$percent*20 AND $hit_k<$percent*40){
                                $travm = 2;
                                }
                                else if($hit_k>=$percent*40){
                                $travm = 3;
                                }
                        getTravm($defend,$travm);

                        include "travm_dis.php";

                        $travm_dis = array();
                        $travm_dis[1] = $ushib_d;
                        $travm_dis[2] = $perelom_d;
                        $travm_dis[3] = $heavy_d;


                        $phrase = "<span class=date>$date</span> Ничто не предвещало беды...Но <span class=$span1>$attack</span> страшно крикнув нанес удар в $hit_dis[$hit] <span class=$span2>$defend</span> на <span class=crit>-$hit_k</span><span class=hitted> [$hp_new/$hp_all]</span>.<BR>";
                        $phrase .= "<span class=date>$date</span><B> $defend</B> получил$p повреждение: <B><font color='red'>\"$travm_dis[$travm]\"</font></B>.<BR>";
                        $phrase .= "<span class=date>$date</span><B> $defend убит$p.</B><BR>";

                        }
                        else{

                        $phrase = "<span class=date>$date</span> <span class=$span2>$defend</span> $crit_hit_1 <span class=$span1>$attack</span> $crit_hit_2 $hit_dis[$hit] на <span class=crit>-$hit_k</span><span class=hitted> [$hp_new/$hp_all]</span>.<BR>";
                        $phrase .= "<span class=date>$date</span><B> $defend убит$p.</B><BR>";
                        }
                }
                else{
                $phrase = "<span class=date>$date</span> <span class=$span2>$defend</span> $crit_hit_1 <span class=$span1>$attack</span> $crit_hit_2 $hit_dis[$hit] на <span class=crit>-$hit_k</span><span class=hitted> [$hp_new/$hp_all]</span>.<BR>";
                }

                if($type != 1){
                $D_UPDATE = mysql_query("UPDATE characters SET hp='$hp_new' WHERE login='$defend'");
                }
                else if($type == 1){
                $D_UPDATE = mysql_query("UPDATE bot_temp SET hp='$hp_new' WHERE bot_name='$defend' AND battle_id='$battle_id'");
                }
        if($type!=2){
                if($ATTACK_DATA["battle_team"]==1){
                $U_SQL = mysql_query("SELECT hitted FROM team1 WHERE player='$attack'");
                $U_D = mysql_fetch_array($U_SQL);
                $new_hitted = $U_D["hitted"] + $hit_k;
                $U_UPDATE = mysql_query("UPDATE team1 SET hitted='$new_hitted' WHERE player='$attack'");
                }
                else{
                $U_SQL = mysql_query("SELECT hitted FROM team2 WHERE player='$attack'");
                $U_D = mysql_fetch_array($U_SQL);
                $new_hitted = $U_D["hitted"] + $hit_k;
                $U_UPDATE = mysql_query("UPDATE team2 SET hitted='$new_hitted' WHERE player='$attack'");
                }
        }
        }
        else if($blocked == 0){
        if($type!=1){
        $hp_all = $DEFEND_DATA["hp_all"];
        $hp_now = $DEFEND_DATA["hp"];
        }
        else if($type == 1){
        $hp_all = $DEF_DATA["hp_all"];
        $hp_now = $DEF_DATA["hp"];
        }
        $hp_new = $hp_now - $hit_k;
                if($hit_k >= $hp_now){
                $hp_new = 0;
                if($type != 1){
                $S = mysql_query("SELECT sex FROM characters WHERE login='$defend'");
                $SS = mysql_fetch_array($S);
                }
                else if($type == 1){
                $S = mysql_query("SELECT sex FROM characters WHERE login='$prototype'");
                $SS = mysql_fetch_array($S);
                }

                        if($SS["sex"]=="male"){$p="";}
                        else{$p="а";}

                $phrase = "<span class=date>$date</span> <span class=$span1>$attack</span> $hit_dis_txt $hit_dis[$hit] <span class=$span2>$defend</span> на <span class=hitted>-$hit_k [$hp_new/$hp_all]</span>.<BR>";
                $phrase .= "<span class=date>$date</span><B> $defend убит$p.</B><BR>";
                }
        else{
        $phrase = "<span class=date>$date</span> <span class=$span1>$attack</span> $hit_dis_txt $hit_dis[$hit] <span class=$span2>$defend</span> на <span class=hitted>-$hit_k [$hp_new/$hp_all]</span>.<BR>";
        }
                if($type != 1){
                $D_UPDATE = mysql_query("UPDATE characters SET hp='$hp_new' WHERE login='$defend'");
                }
                else if($type == 1){
                $D_UPDATE = mysql_query("UPDATE bot_temp SET hp='$hp_new' WHERE bot_name='$defend' AND battle_id='$battle_id'");
                }
        if($type!=2){
                if($ATTACK_DATA["battle_team"]==1){
                $U_SQL = mysql_query("SELECT hitted FROM team1 WHERE player='$attack'");
                $U_D = mysql_fetch_array($U_SQL);
                $new_hitted = $U_D["hitted"] + $hit_k;
                $U_UPDATE = mysql_query("UPDATE team1 SET hitted='$new_hitted' WHERE player='$attack'");
                }
                else{
                $U_SQL = mysql_query("SELECT hitted FROM team2 WHERE player='$attack'");
                $U_D = mysql_fetch_array($U_SQL);
                $new_hitted = $U_D["hitted"] + $hit_k;
                $U_UPDATE = mysql_query("UPDATE team2 SET hitted='$new_hitted' WHERE player='$attack'");
                }
        }
        }

    if($type!=2){
        $ALL_UPDATE = mysql_query("UPDATE characters SET battle_opponent='' WHERE login='$attack'");
    }
        if($type != 1){
        $U_UP = mysql_query("UPDATE characters SET battle_opponent='$attack' WHERE login='$defend'");
        }
        $t = time();
        $U_T = mysql_query("UPDATE timeout SET lasthit='$t' WHERE battle_id='$battle_id'");
        $td = fopen("logs/$battle_id.dis","a");
        fputs($td,$phrase);
        fclose($td);
}

/*=======================================================================*/
/*===============================УДАР====================================*/
function hit($attack,$defend,$hit1,$hit2,$block1,$block2){
$chas = date("H");
$bot = 0;

$ATTACK_QUERY = mysql_query("SELECT * FROM characters WHERE login='$attack'");
$ATTACK_DATA  = mysql_fetch_array($ATTACK_QUERY);

$battle_id = $ATTACK_DATA["battle"];

$weapons = array('axe','fail','knife','sword','staff','shot');

$hand_r_s = mysql_query("SELECT object_type FROM inv WHERE id='".$ATTACK_DATA["hand_r"]."'");
$hand_r_d = mysql_fetch_array($hand_r_s);
$hand_r_type = $hand_r_d["object_type"];

$hand_l_s = mysql_query("SELECT object_type FROM inv WHERE id='".$ATTACK_DATA["hand_l"]."'");
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

$BOT_SEEK = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$battle_id'");
    while($BOTD = mysql_fetch_array($BOT_SEEK)){
        if($defend == $BOTD["bot_name"]){
        $bot = 1;
        $prototype = $BOTD["prototype"];
        $bot_team = $BOTD["team"];
        }
    }


$S_H = mysql_query("SELECT * FROM hit_temp WHERE attack='$attack' AND defend='$defend'");

$temp_exists = 0;
while($SHD = mysql_fetch_array($S_H)){$temp_exists = 1;}


        if($temp_exists == 0){
    if($bot == 0){
        $H_T = mysql_query("INSERT INTO hit_temp(attack,defend,def_hit1,def_hit2,def_block1,def_block2) VALUES('$defend','$attack','$hit1','$hit2','$block1','$block2')");
    }
    else{
    $H_T = mysql_query("INSERT INTO hit_temp(attack,defend,def_hit1,def_hit2,def_block1,def_block2) VALUES('$attack','$defend','$hit1','$hit2','$block1','$block2')");
    }
          $Q = mysql_query("UPDATE characters SET battle_opponent='' WHERE login='$attack'");
    $_SESSION["battle_ref"] = 0;
           print "<script>location.href='battle.php'</script>";

    $U_U = mysql_query("UPDATE characters SET battle_opponent='$attack' WHERE login='$defend'");
    }else if($bot == 0){
        $S_H = mysql_query("SELECT * FROM hit_temp WHERE attack='$attack' AND defend='$defend'");


               $SHD = mysql_fetch_array($S_H);
               $def_hit1 = $SHD["def_hit1"];
               $def_hit2 = $SHD["def_hit2"];
               $def_block1 = $SHD["def_block1"];
               $def_block2 = $SHD["def_block2"];


        /*======расчет блока==========================*/
        if($hit1 == $def_block1 || $hit1 == $def_block2){
        $def_blocked = 1;
        }
        else{
        $def_blocked = 0;
        }

        if($hit2 == $def_block1 || $hit2 == $def_block2){
        $def_blocked2 = 1;
        }
        else{
        $def_blocked2 = 0;
        }

        if($def_hit1 == $block1 || $def_hit1 == $block2){
        $att_blocked = 1;
        }
        else{
        $att_blocked = 0;
        }
        /*============================================*/


    if($bot == 0){
    $ATT_QUERY = mysql_query("SELECT * FROM characters WHERE login='$defend'");
    $ATT_DATA = mysql_fetch_array($ATT_QUERY);
if($ATT_DATA["hp"]>0){
     hit_dis($attack,$defend,0,$def_blocked,$hit1,0);
}
        if($two_hands){
if($ATT_DATA["hp"]>0){
         hit_dis($attack,$defend,0,$def_blocked2,$hit2,1);
}
        }
    $ATT_QUERY = mysql_query("SELECT * FROM characters WHERE login='$defend'");
    $ATT_DATA = mysql_fetch_array($ATT_QUERY);
if($ATT_DATA["hp"]>0){
     hit_dis($defend,$attack,0,$att_blocked,$def_hit1,0);
}
    }

    $SSS = mysql_query("DELETE FROM hit_temp WHERE attack='$attack' AND defend='$defend'");

    print "<script>location.href='battle.php'</script>";
    die();
    }



if($bot == 1){
        $S_H = mysql_query("SELECT * FROM hit_temp WHERE attack='$attack' AND defend='$defend'");

               if($bot == 1){
               $def_hit1 = rand(1,5);
               $def_hit2 = rand(1,5);
               $def_block1 = rand(1,5);
               $def_block2 = rand(1,5);
               $Q = mysql_query("UPDATE characters SET battle_opponent='' WHERE login='$attack'");
               }

        /*======расчет блока==========================*/
        if($hit1 == $def_block1 || $hit1 == $def_block2){
        $def_blocked = 1;
        }
        else{
        $def_blocked = 0;
        }

        if($hit2 == $def_block1 || $hit2 == $def_block2){
        $def_blocked2 = 1;
        }
        else{
        $def_blocked2 = 0;
        }

        if($def_hit1 == $block1 || $def_hit1 == $block2){
        $att_blocked = 1;
        }
        else{
        $att_blocked = 0;
        }
        /*============================================*/


 if($bot == 1){
    $DEF_QUERY = mysql_query("SELECT * FROM bot_temp WHERE bot_name='$defend' AND battle_id='$battle_id'");
    $DEF_DATA = mysql_fetch_array($DEF_QUERY);

        if($DEF_DATA["hp"]>0){
         hit_dis($attack,$defend,1,$def_blocked,$hit1,0);
        }
        if($two_hands){
           if($DEF_DATA["hp"]>0){
            hit_dis($attack,$defend,1,$def_blocked2,hit2,1);
           }
        }
    $DEF_QUERY = mysql_query("SELECT * FROM bot_temp WHERE bot_name='$defend' AND battle_id='$battle_id'");
    $DEF_DATA = mysql_fetch_array($DEF_QUERY);
if($DEF_DATA["hp"]>0){
    hit_dis($defend,$attack,2,$att_blocked,$def_hit1,0);
}
    }

    $SSS = mysql_query("DELETE FROM hit_temp WHERE attack='$attack' AND defend='$defend'");

    print "<script>location.href='battle.php'</script>";
    die();
}
}
/*====================win================================================*/
function win($team,$battle){
$B = mysql_query("SELECT * FROM battles WHERE id=$battle");
$B_DAT = mysql_fetch_array($B);

$cr = $B_DAT["creator_id"];


if($team == 1){
$T = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND over='0'");
}
else if($team == 2){
$T = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND over='0'");
}

if($team==1){
$T2 = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr");
$T3 = mysql_query("SELECT * FROM bot_temp WHERE battle_id=$battle AND team='2'");
}
else if($team==2){
$T2 = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr");
$T3 = mysql_query("SELECT * FROM bot_temp WHERE battle_id=$battle AND team='1'");
}

$lev = 0;
$lev_a = 0;
$price_all = 0;

while($D = mysql_fetch_array($T2)){
$p = $D["player"];
$SSS = mysql_query("SELECT * FROM characters WHERE login='$p'");
$SD = mysql_fetch_array($SSS);
$lev += $SD["level"];
$price_all += $SD["cost"];
$lev_a++;
}

while($D2 = mysql_fetch_array($T3)){
$bot_name = $D2["prototype"];
$SSS1 = mysql_query("SELECT * FROM characters WHERE login='$bot_name'");
$SD1 = mysql_fetch_array($SSS1);
$lev += $SD1["level"];
$price_all += $SD1["cost"];
$lev_a++;
}

$user_level = floor($lev/$lev_a);
$user_cost = floor($price_all/$lev_a);


while($DATA = mysql_fetch_array($T)){

        $player=$DATA["player"];
        $WINNER_SQL_D="SELECT * FROM characters WHERE login='$player'";
        $WINNER_QUERY_D=mysql_query($WINNER_SQL_D);
        $WINNER_DATA=mysql_fetch_array($WINNER_QUERY_D);

include "basexp.php";

    $base_hp=array();
    $base_hp[0]="40";
    $base_hp[1]="50";
    $base_hp[2]="60";
    $base_hp[3]="70";
    $base_hp[4]="90";
    $base_hp[5]="110";
    $base_hp[6]="140";
    $base_hp[7]="300";
    $base_hp[8]="450";
    $base_hp[9]="550";
    $base_hp[10]="600";
      $base_hp[11]="700";
      $base_hp[12]="850";
      $base_hp[13]="950";
      $base_hp[14]="1050";
    $base_hp[15]="1100";
    $base_hp[16]="1200";
    $base_hp[17]="1250";
    $base_hp[18]="1350";
      $base_hp[19]="1500";
      $base_hp[20]="1600";
      $base_hp[21]="1700";
      $base_hp[22]="1800";
      $base_hp[23]="1900";
      $base_hp[24]="1950";
      $base_hp[25]="2000";
      $base_hp[26]="2050";
    $base_hp[27]="2150";
    $base_hp[28]="2250";
    $base_hp[29]="2350";
    $base_hp[30]="2500";
      $base_hp[31]="2700";
      $base_hp[32]="2850";
      $base_hp[33]="3000";
      $base_hp[34]="3100";
      $base_hp[35]="3200";
      $base_hp[36]="3300";
      $base_hp[37]="3400";
    $base_hp[38]="3500";
    $base_hp[39]="3600";
    $base_hp[40]="3700";
    $base_hp[41]="3800";
      $base_hp[42]="3900";
      $base_hp[43]="4000";
      $base_hp[44]="4100";
      $base_hp[44]="4200";
      $base_hp[45]="4300";
      $base_hp[46]="4400";
      $base_hp[47]="4500";
      $base_hp[48]="4500";
      $base_hp[49]="4500";
      $base_hp[50]="4500";
      $base_hp[51]="4500";
      $base_hp[52]="4500";
      $base_hp[53]="4500";
      $base_hp[54]="4500";
      $base_hp[55]="4500";
      $base_hp[56]="4500";
      $base_hp[57]="4500";
      $base_hp[58]="4500";
      $base_hp[59]="4500";
      $base_hp[60]="4700";
      $base_hp[61]="4700";
      $base_hp[62]="4700";
      $base_hp[63]="4700";
      $base_hp[64]="4700";
      $base_hp[65]="4700";
      $base_hp[66]="4700";
      $base_hp[67]="4700";
      $base_hp[68]="4700";
      $base_hp[69]="4700";
      $base_hp[70]="4700";
      $base_hp[71]="4800";
      $base_hp[72]="4800";
      $base_hp[73]="4800";
      $base_hp[74]="4800";
      $base_hp[75]="4800";
      $base_hp[76]="4800";
      $base_hp[77]="4800";
      $base_hp[78]="4800";
      $base_hp[79]="4800";
      $base_hp[80]="4800";
      $base_hp[81]="4900";
      $base_hp[82]="4900";
      $base_hp[83]="4900";
      $base_hp[84]="4900";
      $base_hp[85]="4900";
      $base_hp[86]="4900";
      $base_hp[87]="4900";
      $base_hp[88]="4900";
      $base_hp[89]="4900";
      $base_hp[90]="4900";
      $base_hp[91]="5000";
      $base_hp[92]="5000";
      $base_hp[93]="5000";
      $base_hp[94]="5000";
      $base_hp[95]="5000";
      $base_hp[96]="5000";
      $base_hp[97]="5000";
      $base_hp[98]="5000";
      $base_hp[99]="5100";
      $base_hp[100]="5100";

        $pos=$WINNER_DATA["battle_pos"];
        if($team == 1){
        $SS = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND player='$player'");
        }
        if($team == 2){
        $SS = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND player='$player'");
        }
        $DD = mysql_fetch_array($SS);
        $hitted_win=$DD["hitted"];

        $cost_r = $WINNER_DATA["cost"];
        $perc = $hitted_win/2;
        $give_exp = floor($perc);

        $new_win=$WINNER_DATA["win"]+1;


        if($WINNER_DATA["orden"]==5){
        $add_exp = floor(($give_exp-floor($cost_r/2))/2);
        }
        else{
        $add_exp = $give_exp-floor($cost_r/2);
        }
        if($add_exp<=$exp_table[$mine_level]){$add_exp = $exp_table[$mine_level];}

        $new_exp=$WINNER_DATA["exp"]+$add_exp;
        $w_exp=$add_exp;





                if($WINNER_DATA["hand_l"]!=0){
                $wp_type=$WINNER_DATA["hand_l_type"];
                        if($wp_type=="sword"){
                        $weapon_t="sword_bt";
                        $vladenie="sword";
                        }
                        else if($wp_type=="axe"){
                        $weapon_t="axe_bt";
                        $vladenie="axe";
                        }
                        else if($wp_type=="fail"){
                        $weapon_t="fail_bt";
                        $vladenie="fail";
                        }
                        else if($wp_type=="knife"){
                        $weapon_t="knife_bt";
                        $vladenie="knife";
                        }
                        else if($wp_type=="staff"){
                        $weapon_t="staff_bt";
                        $vladenie="staff";
                        }
                }
                else{
                $weapon_t="phisic_bt";
                $vladenie="phisic";
                }

        $new_wp_c=$WINNER_DATA["$weapon_t"]+1;
        $new_vl=$WINNER_DATA["$vladenie"]+0.05;

                if($WINNER_DATA["hand_r"]!=0){
                $wp_type=$WINNER_DATA["hand_r_type"];
                        if($wp_type=="sword"){
                        $weapon_t="sword_bt";
                        $vladenie="sword";
                        }
                        else if($wp_type=="axe"){
                        $weapon_t="axe_bt";
                        $vladenie="axe";
                        }
                        else if($wp_type=="fail"){
                        $weapon_t="fail_bt";
                        $vladenie="fail";
                        }
                        else if($wp_type=="knife"){
                        $weapon_t="knife_bt";
                        $vladenie="knife";
                        }
                        else if($wp_type=="staff"){
                        $weapon_t="staff_bt";
                        $vladenie="staff";
                        }
                }
                else{
                $weapon_t="phisic_bt";
                $vladenie="phisic";
                }

        $new_wp_c=$WINNER_DATA["$weapon_t"]+1;
        $new_vl=$WINNER_DATA["$vladenie"]+0.05;

        $mass_all = $WINNER_DATA["mass"];

        if($mass_all == 0){
        $def_type = "no_armor";
        }
        if($mass_all > 0 && $mass_all <=20){
        $def_type = "light_armor";
        }
        if($mass_all > 20){
        $def_type = "heavy_armor";
        }

        $new_def = $WINNER_DATA["$def_type"]+0.1;

        $battle_id=$WINNER_DATA["battle"];
        $BATTLE_SQL_L="UPDATE battles SET status='finished',win='$team' WHERE id='$battle'";
        $BS=mysql_query($BATTLE_SQL_L);

        $WINNER_SQL="UPDATE characters SET battle='0',win='$new_win',exp='$new_exp',$weapon_t='$new_wp_c',$vladenie='$new_vl',$def_type='$new_def',battle_opponent='',battle_pos='',battle_team='' WHERE login='$player'";
        $WINNER=mysql_query($WINNER_SQL);
                if($WINNER && !empty($player)){
        $d=date("H:i");
    $city = $WINNER_DATA["city_game"];
        $time = time();
        $room = $WINNER_DATA["room"];
        $login = $WINNER_DATA["login"];
                $masseg= "private [$login] <font color=black>Бой окончен! Вы победили! Всего вами нанесено: $hitted_win HP, получено опыта: $w_exp.</font>";
                mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','Смотритель','$room','$masseg','us','$time','$city')");

                }
        if($team == 1){
        $TEAM_U = mysql_query("UPDATE team1 SET over = '1' WHERE player='$player'");
        }
        else{
        $TEAM_U = mysql_query("UPDATE team2 SET over = '1' WHERE player='$player'");
        }

        $cur = $WINNER_DATA["hp"];
        $all = $WINNER_DATA["hp_all"];
        setHP($player,$cur,$all);


        $cur_m = $WINNER_DATA["mp"];
        $all_m = $WINNER_DATA["mp_all"];
        setMN($player,$cur_m,$all_m);
    $_SESSION["zayavka_c_m"] = 0;
    $_SESSION["zayavka_c_o"] = 0;
    $_SESSION["battle_ref"]  = 0;

}

}
/*========================lose===========================================*/
function lose($team,$battle,$phrase){
$B = mysql_query("SELECT * FROM battles WHERE id=$battle");
$B_DAT = mysql_fetch_array($B);

$cr = $B_DAT["creator_id"];

if($team==1){
$T = mysql_query("SELECT * FROm team1 WHERE battle_id=$cr AND over='0'");
}
else{
$T = mysql_query("SELECT * FROm team2 WHERE battle_id=$cr AND over='0'");
}

while($DATA = mysql_fetch_array($T)){
        $player = $DATA["player"];

        $LOSER_SQL_D="SELECT * FROM characters WHERE login='$player'";
        $LOSER_QUERY_D=mysql_query($LOSER_SQL_D);
        $LOSER_DATA=mysql_fetch_array($LOSER_QUERY_D);
        $objects = array();
        if($LOSER_DATA["amulet"]!=0){$objects[0] = $LOSER_DATA["amulet"];}
        else{$objects[0] = 0;}
        if($LOSER_DATA["hand_r"]!=0){$objects[1] = $LOSER_DATA["hand_r"];}
        else{$objects[1] = 0;}
        if($LOSER_DATA["armor"]!=0){$objects[2] = $LOSER_DATA["armor"];}
        else{$objects[2] = 0;}
        if($LOSER_DATA["poyas"]!=0){$objects[3] = $LOSER_DATA["poyas"];}
        else{$objects[3] = 0;}
        if($LOSER_DATA["ring1"]!=0){$objects[4] = $LOSER_DATA["ring1"];}
        else{$objects[4] = 0;}
        if($LOSER_DATA["ring2"]!=0){$objects[5] = $LOSER_DATA["ring2"];}
        else{$objects[5] = 0;}
        if($LOSER_DATA["ring3"]!=0){$objects[6] = $LOSER_DATA["ring3"];}
        else{$objects[6] = 0;}
        if($LOSER_DATA["helmet"]!=0){$objects[7] = $LOSER_DATA["helmet"];}
        else{$objects[7] = 0;}
        if($LOSER_DATA["perchi"]!=0){$objects[8] = $LOSER_DATA["perchi"];}
        else{$objects[8] = 0;}
        if($LOSER_DATA["hand_l"]!=0){$objects[9] = $LOSER_DATA["hand_l"];}
        else{$objects[9] = 0;}
        if($LOSER_DATA["boots"]!=0){$objects[10] = $LOSER_DATA["boots"];}
        else{$objects[10] = 0;}
        if($LOSER_DATA["naruchi"]!=0){$objects[11] = $LOSER_DATA["naruchi"];}
        else{$objects[11] = 0;}
        if($LOSER_DATA["sergi"]!=0){$objects[12] = $LOSER_DATA["sergi"];}
        else{$objects[12] = 0;}
        if($LOSER_DATA["pants"]!=0){$objects[13] = $LOSER_DATA["pants"];}
        else{$objects[13] = 0;}
        $damage = 0;
        $i=0;
        while($damage == 0 AND $i<=12){
                $damage = $objects[rand(0,12)];
                $i++;
        }
        if($damage!=0){
        $GET_F_INV = mysql_query("SELECT * FROM inv WHERE id='$damage'");
        $GET_D = mysql_fetch_array($GET_F_INV);
        $iznos_all = $GET_D["tear_max"];
        $iznos = $GET_D["iznos"]+1;
        $obj_type = $GET_D["object_type"];
        $obj_id = $GET_D["object_id"];

        $qq=mysql_query("select * from $obj_type where id=$obj_id");
        $res2=mysql_fetch_array($qq);
        $obj_name=$res2["name"];

        $crit_iznos = floor(($iznos_all/100)*80);

                if($iznos>=$crit_iznos AND $iznos<$iznos_all){
                }

                if($iznos<$iznos_all){
                $UP_INV = mysql_query("UPDATE inv SET iznos = $iznos WHERE id = '$damage'");
                }
                else{
                unwear($player,$damage);
                $DEL_ITM = mysql_query("DELETE FROM inv WHERE id='$damage'");
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
                $bid = $LOSER_DATA["battle"];
                $to = "бой $bid";
                history($player,'пришел в негодность',$obj_name,$ip,$to);
                }
        }

        $new_lose=$LOSER_DATA["lose"]+1;

        if($team == 1){
        $SS = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND player='$player'");
        }
        if($team == 2){
        $SS = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND player='$player'");
        }
        $DD = mysql_fetch_array($SS);
        $hitted_win=$DD["hitted"];

                if($LOSER_DATA["hand_r"]!=0){
                $wp_type=$LOSER_DATA["hand_r_type"];
                        if($wp_type=="sword"){
                        $weapon_t="sword_bt";
                        $vladenie="sword";
                        }
                        else if($wp_type=="axe"){
                        $weapon_t="axe_bt";
                        $vladenie="axe";
                        }
                        else if($wp_type=="fail"){
                        $weapon_t="fail_bt";
                        $vladenie="fail";
                        }
                        else if($wp_type=="knife"){
                        $weapon_t="knife_bt";
                        $vladenie="knife";
                        }
                        else if($wp_type=="staff"){
                        $weapon_t="staff_bt";
                        $vladenie="staff";
                        }
                }
                else{
                $weapon_t="phisic_bt";
                $vladenie="phisic";
                }

        $new_wp_c=$LOSER_DATA["$weapon_t"]+1;
        $new_vl=$LOSER_DATA["$vladenie"]+0;


                if($LOSER_DATA["hand_l"]!=0){
                $wp_type=$LOSER_DATA["hand_l_type"];
                        if($wp_type=="sword"){
                        $weapon_t="sword_bt";
                        $vladenie="sword";
                        }
                        else if($wp_type=="axe"){
                        $weapon_t="axe_bt";
                        $vladenie="axe";
                        }
                        else if($wp_type=="fail"){
                        $weapon_t="fail_bt";
                        $vladenie="fail";
                        }
                        else if($wp_type=="knife"){
                        $weapon_t="knife_bt";
                        $vladenie="knife";
                        }
                        else if($wp_type=="staff"){
                        $weapon_t="staff_bt";
                        $vladenie="staff";
                        }
                }
                else{
                $weapon_t="phisic_bt";
                $vladenie="phisic";
                }

        $new_wp_c=$LOSER_DATA["$weapon_t"]+1;
        $new_vl=$LOSER_DATA["$vladenie"]+0;

        $mass_all = $LOSER_DATA["mass"];

        if($mass_all == 0){
        $def_type = "no_armor";
        }
        if($mass_all > 0 && $mass_all <= 20){
        $def_type = "light_armor";
        }
        if($mass_all > 20){
        $def_type = "heavy_armor";
        }

        $new_def = $LOSER_DATA["$def_type"]+0.01;

        $battle_id=$LOSER_DATA["battle"];
        $BS=mysql_query("UPDATE battles SET status='finished' WHERE id='$battle'");

        $LOSER=mysql_query("UPDATE characters SET battle='0',lose='$new_lose',$weapon_t='$new_wp_c',$vladenie='$new_vl',$def_type='$new_def',battle_opponent='',battle_pos='',battle_team='' WHERE login='$player'");
                if($LOSER && !empty($player)){
                        if($phrase == 0){
        $d=date("H:i");
    $city = $LOSER_DATA["city_game"];
        $time = time();
        $room = $LOSER_DATA["room"];
        $login = $LOSER_DATA["login"];
                $masseg= "private [$login] <font color=black>Бой окончен! Вы проиграли! Всего вами нанесено: $hitted_win HP, получено опыта: 0.</font>";
                mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','Смотритель','$room','$masseg','us','$time','$city')");
                        }
                        else if($phrase == 1){
                        }
                $all_hp=$LOSER_DATA["hp_all"];
                setHP($player,'0',$all_hp);

                $cur_m = $LOSER_DATA["mp"];
                $all_m = $LOSER_DATA["mp_all"];
                setMN($player,$cur_m,$all_m);
                }
        if($team == 1){
        $TEAM_U = mysql_query("UPDATE team1 SET over = '1' WHERE player='$player'");
        }
        else{
        $TEAM_U = mysql_query("UPDATE team2 SET over = '1' WHERE player='$player'");
        }


        }
    $_SESSION["zayavka_c_m"] = 0;
    $_SESSION["zayavka_c_o"] = 0;
    $_SESSION["battle_ref"]  = 0;
}
/*=======================================================================*/
/*=================clear Zayavka=========================================*/
function clearZayavka($creator,$bid){
$all1=0;
$all_over1=0;
$all2=0;
$all_over2=0;


$SS = mysql_query("SELECT * FROM team1 WHERE battle_id = '$creator'");
while($SS_D = mysql_fetch_array($SS)){$all1++;}
$SS2 = mysql_query("SELECT * FROM team1 WHERE battle_id = '$creator' AND over='1'");
while($SS2_D = mysql_fetch_array($SS2)){$all_over1++;}

$SS22 = mysql_query("SELECT * FROM team2 WHERE battle_id = '$creator'");
while($SS22_D = mysql_fetch_array($SS22)){$all2++;}
$SS21 = mysql_query("SELECT * FROM team2 WHERE battle_id = '$creator' AND over='1'");
while($SS21_D = mysql_fetch_array($SS21)){$all_over2++;}

        if($all1 == $all_over1 AND $all2 == $all_over2){
        $BB = mysql_query("SELECT * FROM battles WHERE id=$bid");
        $BD = mysql_fetch_array($BB);
        $T1 = mysql_query("SELECT * FROM team1 WHERE battle_id='$creator'");
        while($TD1 = mysql_fetch_array($T1)){
        $player = $TD1["player"];
        $ip = $TD1["ip"];
        $hitted = $TD1["hitted"];
        $INS = mysql_query("INSERT INTO team1_history(player,ip,hitted,battle_id) VALUES('$player','$ip','$hitted','$bid')");
        $ClearZayavkaTemp = mysql_query("DELETE FROM hit_temp WHERE attack='$player'");
        }
        $T2 = mysql_query("SELECT * FROM team2 WHERE battle_id='$creator'");
        while($TD2 = mysql_fetch_array($T2)){
        $player = $TD2["player"];
        $ip = $TD2["ip"];
        $hitted = $TD2["hitted"];
        $INS = mysql_query("INSERT INTO team2_history(player,ip,hitted,battle_id) VALUES('$player','$ip','$hitted','$bid')");
        }
        $BOT = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$bid'");
        while($BOTD = mysql_fetch_array($BOT)){
                if($BOTD["team"]==1){
                $player = $BOTD["prototype"];
                $ip = "none";
                $INS = mysql_query("INSERT INTO team1_history(player,ip,hitted,battle_id) VALUES('$player','$ip','0','$bid')");
                }
                else{
                $player = $BOTD["prototype"];
                $ip = "none";
                $INS = mysql_query("INSERT INTO team2_history(player,ip,hitted,battle_id) VALUES('$player','$ip','0','$bid')");
                }
        }
        $ClearTeam1 = mysql_query("DELETE FROM team1 WHERE battle_id = '$creator'");
        $ClearTeam2 = mysql_query("DELETE FROM team2 WHERE battle_id = '$creator'");
        $ClearZayavka = mysql_query("DELETE FROM zayavka WHERE creator = '$creator'");
        $ClearZayavkaTime = mysql_query("DELETE FROM timeout WHERE battle_id = '$bid'");
        $KillBots = mysql_query("DELETE FROM bot_temp WHERE battle_id='$bid'");
        }
}
/*=======================================================================*/
/*===============genForm=================================================*/
function genForm($who){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$battle) or ereg("[<>\\/-]",$hit) or ereg("[<>\\/-]",$hit1) or ereg("[<>\\/-]",$hit3)
 or ereg("[<>\\/-]",$hit4) or ereg("[<>\\/-]",$hit5) or ereg("[<>\\/-]",$D1) or ereg("[<>\\/-]",$D3) or ereg("[<>\\/-]",$D4)
 or ereg("[<>\\/-]",$D5) or ereg("[<>\\/-]",$bat)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$battle=htmlspecialchars($battle);
$hit=htmlspecialchars($hit);
$hit1=htmlspecialchars($hit1);
$hit3=htmlspecialchars($hit3);
$hit4=htmlspecialchars($hit4);
$hit5=htmlspecialchars($hit5);
$D1=htmlspecialchars($D1);
$D3=htmlspecialchars($D3);
$D4=htmlspecialchars($D4);
$D5=htmlspecialchars($D5);
$bat=htmlspecialchars($bat);
$S = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($S);

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

        for($i=0;$i<count($weapons);$i++){
             if($hand_r_type == $weapons[$i]){
         $hand_r_weapon = true;
        }
        if($hand_l_type == $weapons[$i]){
         $hand_l_weapon = true;
        }
    }

    if($hand_r_weapon == true && $hand_l_weapon == true){
     $two_hands = true;
    }
?>
<img border="0" src="img/line2.gif" width="360" height="10">
<FORM NAME="battle" ACTION="battle.php?act=hit" METHOD="POST">
<?
 /* if($db["level"]>4){
?>

<center><img border="0" src="buttons/magic.gif" onClick="javascript:location.href='battle.php?act=showMagic';"></center>


<?
  }*/
?>
<table border=0 cellpadding=0 cellspacing=0 width=350><tr>

<td align=center bgcolor=#f2f0f0><B>Атака</B></td>
<td align=center bgcolor=#f2f0f0><B>Защита</B></td>
</tr>
<tr>
<?
  if(!$two_hands){
?>
<td>
<INPUT TYPE=radio NAME="hit" VALUE="1" ID=A1><B><LABEL FOR=A1>удар в голову</LABEL><br>
<INPUT TYPE=radio NAME="hit" VALUE="2" ID=A2><LABEL FOR=A2>удар в грудь</LABEL><br>
<INPUT TYPE=radio NAME="hit" VALUE="3" ID=A3><LABEL FOR=A4>удар в живот</LABEL><br>
<INPUT TYPE=radio NAME="hit" VALUE="4" ID=A4><LABEL FOR=A3>удар в пояс</LABEL><br>
<INPUT TYPE=radio NAME="hit" VALUE="5" ID=A5><LABEL FOR=A4>удар в ноги</LABEL><br></B>
</td>
<?
  }
  else{
?>
<td>
<INPUT TYPE=radio NAME="udar" VALUE="1" ID=b1><INPUT TYPE=radio NAME="udar2" VALUE="1" ID=A1><B><LABEL FOR=A1>удар в голову</LABEL><br>
<INPUT TYPE=radio NAME="udar" VALUE="2" ID=b2><INPUT TYPE=radio NAME="udar2" VALUE="2" ID=A2><LABEL FOR=A2>удар в грудь</LABEL><br>
<INPUT TYPE=radio NAME="udar" VALUE="3" ID=b3><INPUT TYPE=radio NAME="udar2" VALUE="3" ID=A3><LABEL FOR=A3>удар в живот</LABEL><br>
<INPUT TYPE=radio NAME="udar" VALUE="4" ID=b4><INPUT TYPE=radio NAME="udar2" VALUE="4" ID=A4><LABEL FOR=A4>удар в пояс</LABEL><br>
<INPUT TYPE=radio NAME="udar" VALUE="5" ID=b5><INPUT TYPE=radio NAME="udar2" VALUE="5" ID=A5><LABEL FOR=A5>удар в ноги</LABEL><br></B>
</td>
<?
  }
?>
<td>
<INPUT TYPE=radio NAME="block" VALUE="1" ID=D1><B><LABEL FOR=D1>блок головы и груди</LABEL><br>
<INPUT TYPE=radio NAME="block" VALUE="2" ID=D2><LABEL FOR=D2>блок груди и живота</LABEL><br>
<INPUT TYPE=radio NAME="block" VALUE="3" ID=D3><LABEL FOR=D3>блок живота и пояса</LABEL><br>
<INPUT TYPE=radio NAME="block" VALUE="4" ID=D4><LABEL FOR=D4>блок пояса и ног</LABEL><br>
<INPUT TYPE=radio NAME="block" VALUE="5" ID=D5><LABEL FOR=D4>блок ног и головы</LABEL></B>
</td>
</tr>
<input type=hidden name="bat" value="1">

      <tr>
        <td width="100%" bgcolor=#f2f0f0 colspan="2">

          <p align="center"><INPUT type=submit value="Вперед !!!"></td>
      </tr>
</table>
</FORM>
<img border="0" src="img/line2.gif" width="360" height="10">
<?
}
/*=======================================================================*/
/*=============genMagicForm==============================================*/
function genMagicForm($who){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$scroll)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$scroll=htmlspecialchars($scroll);
$S = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($S);
print "</center>Ваши заклинания:<center>";
print "<table border=0 cellpadding=0 cellspacing=0>\n";
print "<tr>\n";
$i = 1;
print "<td valign=top>";
$SEEK = mysql_query("SELECT * FROM inv WHERE object_type='scroll' AND owner='$who' ORDER BY date DESC");
        while($DATA = mysql_fetch_array($SEEK)){
        $obj_id = $DATA["object_id"];
        $GET_SCROLL = mysql_query("SELECT * FROM scroll WHERE id='$obj_id'");
        $SCROLL_DATA = mysql_fetch_array($GET_SCROLL);
        $name = $SCROLL_DATA["name"];
        $img = $SCROLL_DATA["img"];
        $mp = $SCROLL_DATA["mp"];
        $item_id = $DATA["id"];
        $tear_max = $DATA["tear_max"];
        $iznos = $DATA["iznos"];
        print "<a href='?act=magic&scroll=$item_id'><img src='img/$img' border=0 alt='Использовать заклинание:\n$name\nИсп. маны: $mp\nИспользований: $iznos/$tear_max'></a>";
        if($i == 5 OR $i == 10 OR $i ==15 OR $i ==20 OR $i == 25 OR $i ==30){
        print "<BR>";
        }
        $i++;
        }
print "</td>";
if($i == 1){
print "<td>У Вас нет заклинаний!</td>";
}

print "</tr></table></center>\n";
print "<center><input type=button value='вернуться' class=but onClick=\"location.href='battle.php?act=none'\"><BR><BR>";

}
/*=======================================================================*/
/*=============genTechForm==============================================*/
function genTechForm($who){
$S = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($S);

print "</center>У Вас нет технических навыков, которые вы могли бы применить в бою.<BR>";
print "<input type=button value='вернуться' class=but onClick=\"location.href='battle.php?act=none'\">";

}
/*=======================================================================*/
/*==========go battle====================================================*/
function goBattle($who){
include "conf.php";
$chas = date("H");

$SQL = mysql_query("SELECT * FROM team1");
        while($DATA = mysql_fetch_array($SQL)){
                if($DATA["player"] == $who){
                $team = 1;
                $creator = $DATA["battle_id"];
                }
        }
$SQL2 = mysql_query("SELECT * FROM team2");
        while($DATA2 = mysql_fetch_array($SQL2)){
                if($DATA2["player"] == $who){
                $team = 2;
                $creator = $DATA2["battle_id"];
                }
        }

        if(!empty($creator)){
        $B_SQL = mysql_query("SELECT * FROM battles");
        $exists = 0;
                while($B_DATA = mysql_fetch_array($B_SQL)){
                        if($B_DATA["creator_id"] == $creator AND $B_DATA["status"] == "during"){
                        $exists = 1;
                        $b_id = $B_DATA["id"];
                        }
                }
                if($exists == 0){
                $Z_SQL = mysql_query("SELECT * FROM zayavka WHERE creator=$creator");
                $Z_DATA = mysql_fetch_array($Z_SQL);
                $type = $Z_DATA["type"];
                $timeout = $Z_DATA["timeout"]*60;
                $B_CREATE = mysql_query("INSERT INTO battles(type,status,creator_id) VALUES('$type','during','$creator')");
                $b_id=mysql_insert_id();
                $ttt = $Z_DATA["timeout"];

                $U_UPDATE = mysql_query("UPDATE characters SET battle='$b_id',battle_team='$team',battle_pos='$creator',battle_opponent='' WHERE login='$who'");
                        if(!$B_CREATE OR !$U_UPDATE){
                        $num_err=mysql_errno();
                        $msg_err=mysql_error();
                        print "Произошла ошибка!!! Сообщите ближайшему паладину номер и сообщение ошибки!<BR>";
                        print "Номер ошибки: <B>$num_err</B><BR>";
                        print "Сообщение: <B>$msg_err</B>";
                        }
                }
                else if($exists == 1){
                $Z_SQL = mysql_query("SELECT * FROM zayavka WHERE creator=$creator");
                $Z_DATA = mysql_fetch_array($Z_SQL);
                $type = $Z_DATA["type"];
                $U_UPDATE = mysql_query("UPDATE characters SET battle='$b_id',battle_team='$team',battle_pos='$creator',battle_opponent='' WHERE login='$who'");
                        if(!$U_UPDATE){
                        $num_err=mysql_errno();
                        $msg_err=mysql_error();
                        print "Произошла ошибка!!! Сообщите ближайшему паладину номер и сообщение ошибки!<BR>";
                        print "Номер ошибки: <B>$num_err</B><BR>";
                        print "Сообщение: <B>$msg_err</B>";
                        }
                }
        }

        $T1_SQL = mysql_query("SELECT * FROM team1 WHERE battle_id=$creator");
        $team1_p="";
        while($T1_DATA = mysql_fetch_array($T1_SQL)){
        $player = $T1_DATA["player"];
        $team1_p.="$player, ";
                if($type==2 OR $type==3){
                unwear_full($player);
                }
        }

        $T2_SQL = mysql_query("SELECT * FROM team2 WHERE battle_id=$creator");
        $team2_p="";
        while($T2_DATA = mysql_fetch_array($T2_SQL)){
        $player = $T2_DATA["player"];
        $team2_p.="$player, ";
                if($type==2 OR $type==3){
                unwear_full($player);
                }
        }

        $TBOT_SQL = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$b_id'");
        while($TBOT_DATA = mysql_fetch_array($TBOT_SQL)){
        $player = $TBOT_DATA["bot_name"];
                if($TBOT_DATA["team"]==1){
                $team1_p.="$player, ";
                }
                else{
                $team2_p.="$player, ";
                }
        }

$date_s=date("H:i", mktime($chas-$GSM));
$diss=array();
$diss[0]="На часах было <span class=date>$date_s</span>, когда <span class=p1>$team1_p</span> и <span        class=p2>$team2_p</span> завязали драку...";
$diss[1]="Небо было чистым и ничто не предвещало беды...Но когда часы показали <span class=date>$date_s</span>, <span class=p1>$team1_p</span> и <span class=p2>$team2_p</span> принялись варварски избивать друг друга.";
$diss[2]="В этот день у скорой помощи было много работы...И в <span class=date>$date_s</span> поступил еще один вызов - <span class=p1>$team1_p</span> и <span class=p2>$team2_p</span> начали драться прямо на улице.";
$diss[3]="Часы на башне показали <span class=date>$date_s</span>, когда <span class=p1>$team1_p</span> и <span class=p2>$team2_p</span> решили разобраться кто из них круче.";
$diss[4]="Был обычный солнечный день...Но когда тени от стрелок часов показали<span class=date>$date_s</span>,<span class=p1>$team1_p</span> и <span class=p2>$team2_p</span> накинулись друг на друга, так словно не ели три дня.";

$diss_put=$diss[rand(0,4)];

$log_file="logs/$b_id.dis";

$t = file_exists($log_file);
if(!$t){
$f=fopen($log_file,"w");
fputs($f,"$diss_put<BR>");
fclose($f);
}
        $time = time()+$ttt*60;
        $S = mysql_query("INSERT INTO timeout(battle_id,lasthit) VALUES('$b_id','$time')");

print "<script>top.main.location.href='battle.php?fuck=1'</script>";
die();
}
/*=======================================================================*/
function testZayavka($who){
if (ereg("[<>\\/-]",$boy)) {print "?!"; exit();}
$boy=htmlspecialchars($boy);
$S = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($S);

$MINE1 = mysql_query("SELECT * FROM team1");
$MINE2 = mysql_query("SELECT * FROM team2");

$m = 0;
$t = 0;

while($MD1 = mysql_fetch_array($MINE1)){
        if($MD1["player"] == $who){
        $m = $MD1["battle_id"];
        $SS = mysql_query("SELECT * FROM team2 WHERE battle_id=$m");
        $DD = mysql_fetch_array($SS);
        $opponent = $DD["player"];
        $t = 1;
        }
}
while($MD2 = mysql_fetch_array($MINE2)){
        if($MD2["player"] == $who){
        $m = $MD2["battle_id"];
        $SS = mysql_query("SELECT * FROM team1 WHERE battle_id=$m");
        $DD = mysql_fetch_array($SS);
        $opponent = $DD["player"];
        $t = 2;
        }
}

$SQL   = "SELECT * FROM zayavka";
$QUERY = mysql_query($SQL);
        while($DAT=mysql_fetch_array($QUERY)){

          $cr = $DAT["creator"];

        if($m == $DAT["creator"] AND $DAT["status"]==1){$zayavka_status="awaiting";}
        if($m == $DAT["creator"] AND $DAT["status"]==2 AND $t == 1){$zayavka_status="confirm_mine";}
        if($m == $DAT["creator"] AND $DAT["status"]==2 AND $t == 2){$zayavka_status="confirm_opp";}
          if($m == $DAT["creator"] AND $DAT["status"]==3){if($db["battle"]==0){goBattle($who);}}
        }

    if($zayavka_status == "confirm_mine"){
            if($_SESSION["zayavka_c_m"] == 0){
             print "<script>top.main.location.href='zayavka.php?boy=phisic'</script>";
             $_SESSION["zayavka_c_m"] = 1;
        }
    }
    if($t == 0){
            if($_SESSION["zayavka_c_o"] == 0){
             $_SESSION["zayavka_c_o"] = 1;
        }
    }
}
/*========================================================*/
function work($who,$type,$step){
$S = mysql_query("SELECT * FROM characters WHERE login='$who'");
$db = mysql_fetch_array($S);
$SQL = mysql_query("SELECT * FROM res WHERE locate = '$type'");
$DATA = mysql_fetch_array($SQL);

$max_mine = floor($db["vit"]*2);

$title = array(
 "dub" => "Дубовая роща",
 "bereza" => "Березовая роща",
);
$title_short = array(
 "dub" => "Дуб",
 "bereza" => "Береза",
);
$navik = array(
 "dub" => "navik_wood",
 "bereza" => "navik_wood",
);
$time = array(
 "dub" => "400",
 "bereza" => "300",
);

   if($step == 0){
    print $title[$type]."(".$DATA["resource"]."/2000)<BR>\n";
    print "Тип ресурса: дерево(".$title_short[$type].")<BR><BR>\n";
    print "<form name=\"mine\" action=\"main.php\" METHOD=\"POST\">";
    print "Добывать ресурс:<BR>\n";
    print "<select name=\"res_count\" class=new>";
      for($i=1;$i<=5;$i++){
       $time_to_mine = floor($i*$time[$type]/(1 + $db["$navik[$type]"]));
       print "<option value='$i'>$i ед. (~".floor($time_to_mine/60)." мин.)</option>";
      }
    print "</select>";
    print "&nbsp&nbsp&nbsp<input type=submit class=but value=\"работать\">";
    print "</form>";
   }
   else{
    mine($who,$type,$step);
   }
}
?>