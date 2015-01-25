<?
include "conf.php";
include "functions.php";

if($team == 1){
$T = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND over='0'");
}
else if($team == 2){
$T = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND over='0'");
}


$TM1 = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr");
$TM2 = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr");
$TM3 = mysql_query("SELECT * FROM bot_temp WHERE battle_id=$battle AND team='1'");
$TM4 = mysql_query("SELECT * FROM bot_temp WHERE battle_id=$battle AND team='2'");

$price_all_t1 = 0;
$price_all_t2 = 0;
$price_all_t3 = 0;
$price_all_t4 = 0;

$lev_t1 = 0;
$lev_t2 = 0;
$lev_t3 = 0;
$lev_t4 = 0;

$lev_a_t1 = 0;
$lev_a_t2 = 0;
$lev_a_t3 = 0;
$lev_a_t4 = 0;

while($D1 = mysql_fetch_array($TM1)){
$p = $D1["player"];
$SSS1 = mysql_query("SELECT * FROM characters WHERE login='$p'");
$SD1 = mysql_fetch_array($SSS1);
$price_all_t1 += $SD1["cost"];
$lev_t1 += $SD1["level"];
$lev_a_t1++;
}

while($D2 = mysql_fetch_array($TM2)){
$p = $D2["player"];
$SSS2 = mysql_query("SELECT * FROM characters WHERE login='$p'");
$SD2 = mysql_fetch_array($SSS2);
$price_all_t2 += $SD2["cost"];
$lev_t2 += $SD2["level"];
$lev_a_t2++;
}

while($D3 = mysql_fetch_array($TM3)){
$bot_name = $D3["prototype"];
$SSS3 = mysql_query("SELECT * FROM characters WHERE login='$bot_name'");
$SD3 = mysql_fetch_array($SSS3);
$price_all_t3 += $SD3["cost"];
$lev_t3 += $SD3["level"];
$lev_a_t3++;
}
while($D4 = mysql_fetch_array($TM4)){
$bot_name = $D4["prototype"];
$SSS4 = mysql_query("SELECT * FROM characters WHERE login='$bot_name'");
$SD4 = mysql_fetch_array($SSS4);
$price_all_t4 += $SD4["cost"];
$lev_t4 += $SD4["level"];
$lev_a_t4++;
}

$user_level_t1 = floor($lev_t1/$lev_a_t1);
$user_level_t2 = floor($lev_t2/$lev_a_t2);
$user_level_t3 = floor($lev_t3/$lev_a_t3);
$user_level_t4 = floor($lev_t4/$lev_a_t4);

if($team == 1){
$T = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND over='0'");
while($DATA = mysql_fetch_array($T)){


$player=$DATA["player"];
        $WINNER_SQL_D="SELECT * FROM characters WHERE login='$player'";
        $WINNER_QUERY_D=mysql_query($WINNER_SQL_D);
        $WINNER_DATA=mysql_fetch_array($WINNER_QUERY_D);
        
        $exp_table=array();
        $exp_table[0]="5";
        $exp_table[1]="10";
        $exp_table[2]="15";
        $exp_table[3]="15";
        $exp_table[4]="20";
        $exp_table[5]="40";
        $exp_table[6]="50";
        $exp_table[7]="100";
        $exp_table[8]="300";
        $exp_table[9]="600";
        $exp_table[10]="1000";
        
        $pos=$WINNER_DATA["battle_pos"];
        if($team == 1){
        $SS = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND player='$player'");
        }
        if($team == 2){
        $SS = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND player='$player'");
        }
        $DD = mysql_fetch_array($SS);
        $hitted_win=$DD["hitted"];
        
        $new_win=$WINNER_DATA["win"]+1;
        
        $a = $user_level_t2+$price_all_t2+$user_level_t4+$price_all_t4;
        $a1 = $user_level_t1+$price_all_t1+$user_level_t3+$price_all_t3;


        if($WINNER_DATA["orden"]==5){
        $add_exp = floor(floor($a/$a1)*$exp_table[$user_level])/2);
        }
        else{
        $add_exp = floor($a/$a1)*$exp_table[$user_level];
        }
        
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
                say($player,"Внимание!!! Бой окончен! Вы победили! Всего вами нанесено: $hitted_win HP, получено опыта: $w_exp.",$player);
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
else if($team == 2){
$T = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND over='0'");
$T = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND over='0'");
while($DATA = mysql_fetch_array($T)){


$player=$DATA["player"];
        $WINNER_SQL_D="SELECT * FROM characters WHERE login='$player'";
        $WINNER_QUERY_D=mysql_query($WINNER_SQL_D);
        $WINNER_DATA=mysql_fetch_array($WINNER_QUERY_D);

        $exp_table=array();
        $exp_table[0]="5";
        $exp_table[1]="10";
        $exp_table[2]="15";
        $exp_table[3]="15";
        $exp_table[4]="20";
        $exp_table[5]="40";
        $exp_table[6]="50";
        $exp_table[7]="100";
        $exp_table[8]="300";
        $exp_table[9]="600";
        $exp_table[10]="1000";

        $pos=$WINNER_DATA["battle_pos"];
        if($team == 1){
        $SS = mysql_query("SELECT * FROM team1 WHERE battle_id=$cr AND player='$player'");
        }
        if($team == 2){
        $SS = mysql_query("SELECT * FROM team2 WHERE battle_id=$cr AND player='$player'");
        }
        $DD = mysql_fetch_array($SS);
        $hitted_win=$DD["hitted"];

        $new_win=$WINNER_DATA["win"]+1;

        $a = $user_level_t2+$price_all_t2+$user_level_t4+$price_all_t4;
        $a1 = $user_level_t1+$price_all_t1+$user_level_t3+$price_all_t3;


        if($WINNER_DATA["orden"]==5){
        $add_exp = floor(floor($a1/$a)*$exp_table[$user_level])/2);
        }
        else{
        $add_exp = floor($a1/$a)*$exp_table[$user_level];
        }

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
                say($player,"Внимание!!! Бой окончен! Вы победили! Всего вами нанесено: $hitted_win HP, получено опыта: $w_exp.",$player);
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




?>
