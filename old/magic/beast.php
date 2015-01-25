<?
if(empty($conf)){
?>
<div align=right>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_t.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_t.gif'></td>
</table>
<table border=0 bgcolor=#cccccc cellpadding=0 cellspacing=0 width=300 height=60>
<tr><td align=left valign=top>
<form name='ligthning' action='?act=magic&school=earth&scroll=<?echo $scroll?>&conf=1' method='post'>
<small>
&nbsp&nbspСитхия земли<BR>
&nbsp&nbspЗаклятие "Призвать зверя"<BR>
</small>

&nbsp&nbsp<input type=submit value=" Использовать магию " class=new  style="width=200">
</form>
</td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_b.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_b.gif'></td>
</table>
</div>
<?
}
else if($db["battle"]!=0 AND $conf == 1){
$bid = $db["battle"];
$SEEK_BOT = mysql_query("SELECT * FROM characters WHERE login='Волк'");
$BOT_DATA = mysql_fetch_array($SEEK_BOT);
$bot_hp = $BOT_DATA["hp_all"];
$bot_mp = $BOT_DATA["mp_all"];

$SEEK_NAME = mysql_query("SELECT * FROM bot_temp WHERE battle_id='$bid'");
$i = mysql_num_rows($SEEK_NAME)+1;


$bot_name = "Волк (призванный $i)";

$S = mysql_query("INSERT INTO bot_temp(bot_name,hp,hp_all,battle_id,prototype,team,mp,mp_all) VALUES('$bot_name','$bot_hp','$bot_hp','$bid','Волк','$team','$bot_mp','$bot_mp')");

    $chas = date("H");
    $date = date("H:i", mktime($chas-$GSM));
    if($db["battle_team"]==1){$span = "p1";$span2 = "p2";}else{$span = "p2";$span2 = "p1";}
    $text = "<span class=date2>$date</span> <span class=$span>$login</span> призвал к бою <B>$bot_name</B><BR>";
    $ALL_UPDATE = mysql_query("UPDATE characters SET battle_opponent='' WHERE login='$login'");
    $t = time();
    $U_T = mysql_query("UPDATE timeout SET lasthit='$t' WHERE battle_id='$bid'");
    $td = fopen("logs/$bid.dis","a");
    fputs($td,$text);
    fclose($td);

    $SQL = mysql_query("UPDATE characters SET cast = cast+0.5,earth=earth+0.5 WHERE login='$login'");
    $S = mysql_query("UPDATE inv SET iznos = iznos+1 WHERE id=$scroll");
    $S_INV = mysql_query("SELECT * FROM inv WHERE id = $scroll");
    $DATA = mysql_fetch_array($S_INV);
    $iznos = $DATA["iznos"];
    $tear_max = $DATA["tear_max"];
    $iznos_k = $iznos+1;
        if($iznos_k>=$tear_max){
        $S_D = mysql_query("DELETE FROM inv WHERE id = $scroll");
        }

    $mp_new = $db["mp"] - 4;
    $mp_all = $db["mp_all"];
    setMN($login,$mp_new,$mp_all);
    print "Прокастованно удачно!<BR>";
    print "<a href='main.php?act=inv&section=thing' class=us2>вернуться</a>";

}
?>