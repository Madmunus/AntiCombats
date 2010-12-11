<?
include "conf.php";
$orden=$db["orden"];
$cast_d = $db["cast"];
if(empty($cast)){$cast = 0;}
if(empty($db["orden"])){$db["orden"] = 0;}

$INV_S = mysql_query("SELECT * FROM inv WHERE id=$scroll");
while($D = mysql_fetch_array($INV_S)){
$scroll_id = $D["object_id"];
}

$DATA_S = mysql_query("SELECT * FROM scroll WHERE id=$scroll_id");

while($DATA = mysql_fetch_array($DATA_S)){
$min_i = $DATA["min_int"];
$min_v = $DATA["min_wis"];
$min_l = $DATA["min_level"];
$orden = $DATA["orden"];
if(empty($orden)){$orden = 0;}
$iznos_min = $DATA["iznos_min"];
$tear_max = $DATA["tear_max"];
$name = $DATA["name"];
$mp = $DATA["mp"];
$file = $DATA["file"];
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

    include "magic/$file";

    }
    else{
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=3\";</script>";
    }
}
?>