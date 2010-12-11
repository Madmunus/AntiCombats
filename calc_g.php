<?
/*====определение характеристик атакующего===============*/
$attack_str       = $ATTACK_DATA["str"];
$attack_dex    = $ATTACK_DATA["dex"];
$attack_con     = $ATTACK_DATA["con"];
$attack_vit      = $ATTACK_DATA["vit"];
$attack_hp         = $ATTACK_DATA["hp"];
$attack_hpall      = $ATTACK_DATA["hp_all"];
if($hand == 0){
$attack_crit       = $ATTACK_DATA["mf_crit"]+$ATTACK_DATA["hand_r_crit"];
$attack_anticrit   = $ATTACK_DATA["mf_anticrit"]+$ATTACK_DATA["hand_r_anticrit"];
$attack_uvorot     = $ATTACK_DATA["mf_uvorot"]+$ATTACK_DATA["hand_r_uvorot"];
$attack_antiuvorot = $ATTACK_DATA["mf_antiuvorot"]+$ATTACK_DATA["hand_r_antiuvorot"];
$attack_weapon     = $ATTACK_DATA["hand_r"];
$attack_weapon_type = $ATTACK_DATA["hand_r_type"];
}
else if($hand == 1){
$attack_crit       = $ATTACK_DATA["mf_crit"]+$ATTACK_DATA["hand_l_crit"];
$attack_anticrit   = $ATTACK_DATA["mf_anticrit"]+$ATTACK_DATA["hand_l_anticrit"];
$attack_uvorot     = $ATTACK_DATA["mf_uvorot"]+$ATTACK_DATA["hand_l_uvorot"];
$attack_antiuvorot = $ATTACK_DATA["mf_antiuvorot"]+$ATTACK_DATA["hand_l_antiuvorot"];
$attack_weapon     = $ATTACK_DATA["hand_l"];
$attack_weapon_type = $ATTACK_DATA["hand_l_type"];
}



if($attack_weapon_type=="phisic"){
$attack_vlad="phisic";
}
else if($attack_weapon_type=="sword"){
$attack_vlad="sword";
}
else if($attack_weapon_type=="axe"){
$attack_vlad="axe";
}
else if($attack_weapon_type=="fail"){
$attack_vlad="fail";
}
else if($attack_weapon_type=="knife"){
$attack_vlad="knife";
}
else if($attack_weapon_type=="staff"){
$attack_vlad="staff";
}
$attack_vladenie=$ATTACK_DATA["$attack_vlad"];
if($attack_weapon!=0){
    if($hand == 0){
    $attack_wp_min=$ATTACK_DATA["hand_r_hitmin"];
    $attack_wp_max=$ATTACK_DATA["hand_r_hitmax"];
    }
    else if($hand == 1){
    $attack_wp_min=$ATTACK_DATA["hand_l_hitmin"];
    $attack_wp_max=$ATTACK_DATA["hand_l_hitmax"];
    }
$attack_minhit=($attack_wp_min + $attack_str/2)*(1 + $attack_vladenie/100)-3;
$attack_maxhit=($attack_wp_max + $attack_str/2)*(1 + $attack_vladenie/100)+3;
}
else{
$attack_minhit = ($attack_str/2)*(1 + $attack_vladenie/100)-2;
$attack_maxhit = ($attack_str/2)*(1 + $attack_vladenie/100)+4;
}
$attack_bron_h    = $ATTACK_DATA["bron_head"];
$attack_bron_a    = $ATTACK_DATA["bron_arm"];
$attack_bron_c    = $ATTACK_DATA["bron_corp"];
$attack_bron_p    = $ATTACK_DATA["bron_poyas"];
$attack_bron_l    = $ATTACK_DATA["bron_legs"];
$attack_cost      = $ATTACK_DATA["cost"];

/*==========================================================*/
/*====определение характеристик защишаюшегося===============*/
$defend_str       = $DEFEND_DATA["str"];
$defend_dex    = $DEFEND_DATA["dex"];
$defend_con     = $DEFEND_DATA["con"];
$defend_vit      = $DEFEND_DATA["vit"];
$defend_hp         = $DEFEND_DATA["hp"];
$defend_hpall      = $DEFEND_DATA["hp_all"];
$defend_crit       = $DEFEND_DATA["mf_crit"];
$defend_anticrit   = $DEFEND_DATA["mf_anticrit"];
$defend_uvorot     = $DEFEND_DATA["mf_uvorot"];
$defend_antiuvorot = $DEFEND_DATA["mf_antiuvorot"];

$defend_bron_h    = $DEFEND_DATA["bron_head"];
$defend_bron_a    = $DEFEND_DATA["bron_arm"];
$defend_bron_c    = $DEFEND_DATA["bron_corp"];
$defend_bron_p    = $DEFEND_DATA["bron_poyas"];
$defend_bron_l    = $DEFEND_DATA["bron_legs"];
$defend_cost      = $DEFEND_DATA["cost"];
/*======================================================*/

$l_r = $attack_dex - $defend_dex;
$u_r = $attack_con - $defend_con;

if($l_r<0){
$defend_uvorot-=$l_r*5;
}
else if($l_r>0){
$attack_antiuvorot+=$l_r*5;
}
if($u_r<0){
$defend_anticrit-=$u_r*5;
}
else if($u_r>0){
$attack_crit+=$u_r*5;
}

$mf_crit = $attack_crit - $defend_anticrit;
$mf_uvorot = $defend_uvorot - $attack_antiuvorot; 
?>