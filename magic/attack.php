<?
if(empty($param)){
?><br><p align=right><input type=button value="Вернуться" class=nav onclick="javascript:location.href='main.php?act=none'"></p>
<div align=center><br><br><br>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_t.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_t.gif'></td>
</table>
<table border=0 bgcolor=#cccccc cellpadding=0 cellspacing=0 width=300 height=60>
<tr><td align=left valign=top>
<form name='attack' action='?act=magic&school=earth&scroll=<?echo $scroll?>' method='post'>
<small>
&nbsp&nbspЗаклятие "Нападение"<BR>
</small>
&nbsp&nbspУкажите логин персонажа,на которго Вы хотите напасть:<BR>
&nbsp&nbsp<input type=text name='param' class=new style="width=200">
<BR>
&nbsp&nbsp<input type=submit value=" Напасть " class=new  style="width=200">
</form>
</td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=300><tr>
<td width=10><img src='img/cor_l_b.gif'></td><td bgcolor=#cccccc><img src='img/10_10.gif'></td><td width=10><img src='img/cor_r_b.gif'></td>
</table>
</div>
<?
}
else if($db["battle"]==0){
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$school) or ereg("[<>\\/-]",$scroll) or ereg("[<>\\/-]",$param)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$school=htmlspecialchars($school);
$scroll=htmlspecialchars($scroll);
$param=htmlspecialchars($param);
$S="select * from characters where login='$param'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
$on1 = 0;
$text ="";
    $chas = date("H");
    $date = date("H:i", mktime($chas-$GSM));
    $sss = mysql_query("SELECT * FROM online");
    while($D = mysql_fetch_array($sss)){
        if($D["login"] == $param){
        $on1 = 1;
        }
    }
$user_sql="SELECT * FROM characters WHERE login='$login'";
$user_q=mysql_query($user_sql);
$user_dat=mysql_fetch_array($user_q);
$shans = rand(0,100);
    if(!$res){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=4&param=$param\";</script>";
    die();
    }
    if($param==$login){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=6\";</script>";
    die();
    }
    if($on1 == 0){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=7&param=$param\";</script>";
    die();
    }
        if($user_dat["room"]!=$res["room"]){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=8&param=$param\";</script>";
        die();
        }
    if(!empty($res["battle"])){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=9&param=$param\";</script>";
    die();
    }
    if($res["hp"] < '15'){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=10&param=$param\";</script>";
    die();
    }
    if($res["level"]=='0'){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=11\";</script>";
    die();
    }
    if($param=='Мироздатель'){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=12&param=$param\";</script>";
    die();
    }
$mine_id=$db["id"];
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
        if($shans>70){
        print"<script>location.href=\"main.php?act=inv&section=thing&warning=13\";</script>";
    die();
    }


    $Z = mysql_query("INSERT INTO zayavka(status,type,timeout,creator) VALUES('3','1','3','$mine_id')");
    $T1 = mysql_query("INSERT INTO team2(player,ip,battle_id,hitted,over) VALUES('$login','$ip','$mine_id','0','0')"); 
    $T2 = mysql_query("INSERT INTO team1(player,ip,battle_id,hitted,over) VALUES('$param','unknown','$mine_id','0','0')"); 
    goBattle($login);
    goBattle($param);


}

?>