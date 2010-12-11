<?
session_start();
include "functions.php";
include "conf.php";
if (ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$log=htmlspecialchars($log);
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<title>Просмотр лога боя #<?echo $log;?></title>
<body bgcolor=#dedede>
<?
if(empty($log)){
print "Не указан ID боя!";
die();
}
else{
$text_f="logs/$log.dis";
if(!file_exists($text_f)){
print "Лог боя не найден!";
die();
}
$text_a=file($text_f);
$text=explode("<BR>",$text_a[0]);
$c=count($text);
print "<B>АнтиБК+</B><BR>";
$S = mysql_query("SELECT * FROM battles WHERE id='$log'");
$DATA = mysql_fetch_array($S);
$status = $DATA["status"];
    if($status == "finished"){$s_t = "Поединок завершен.";}
    else{$s_t = "Поединок идет.";}
$yyyy = substr($DATA["date"],0,4);
$mm = substr($DATA["date"],5,2);
$dd = substr($DATA["date"],8,2);
$hh = substr($DATA["date"],11,2) - $GSM;
$m = substr($DATA["date"],14,2);

if($hh<10){$hh = "0$hh";}

$win = $DATA["win"];
if($win == 1){
$seek = mysql_query("SELECT * FROM `team1_history` WHERE `battle_id`=$log");
$span = "p1";
}
else{
$seek = mysql_query("SELECT * FROM `team2_history` WHERE `battle_id`=$log");
$span = "p2";
}
$status = $DATA["status"];
    if($status == "finished"){
while($dat=mysql_fetch_array($seek)){
    $p = $dat["player"];
    $winner .= "$p";
    }
$w = "Победа за <span class=$span>$winner</span>";

}
    else{
print "";
}




print "Дата проведения поединка: $dd.$mm.$yyyy - $hh:$m<BR>";
print "$s_t $w<BR>";
print "<hr color=#000000 width=70% noshade size=1 align=left>";
for($i=0;$i<$c;$i++){
print "$text[$i]<BR>";
}
}
?>