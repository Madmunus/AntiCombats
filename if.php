<?
session_start();
DEFINE("chisto_tolyan",0);
include "conf.php";
include "functions.php";


$chas = date("H");
$server_date=date("d.m.Y", mktime($chas-$GSM));
$server_time=date("H:i:s", mktime($chas-$GSM));

$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_query("SET CHARSET cp1251");
    if(!mysql_select_db($db_name,$data)){
     print "Ошибка при подключении к БД<BR>";
     echo mysql_error();
     die();
    }


if ($act == "yes") {
$UPDATE = mysql_query("UPDATE characters SET quest_unknown = '1' WHERE login = '$login'");
include "post/quest.php";
}

if ($act == "change") {

$quest_unknow = "quest_unknown";
$SSS = mysql_query("DELETE FROM inv WHERE object_type='$quest_unknow' AND owner='$login' AND object_id='1'" );
$S = mysql_query("INSERT INTO `inv` (`owner`, `object_id`, `object_type`, `object_razdel`, `gift`, `wear`, `tear_cur`, `gift_author`, `tear_max`, `pages_used`, `book_name`, `term`, `msg`, `is_modified`) VALUES 
('$login', '1000', 'sword', 'obj', NULL, '0', '0', NULL, '30', '', '', '', '', '');");


}

if ($act == "search") {

$QUERY=mysql_query("SELECT * FROM characters WHERE login='$login'");
$data=mysql_fetch_array($QUERY);
$time_now=time();
$travmType= "3";

$time=300;
$behaviour="str";
$kill_stat=$behaviour;
$stat=$data["$kill_stat"];
$kill_time=$time_now+$time*60;
$min_s = ($stat/100)*($travmType*20);
$write_stat=floor($stat-$min_s);
$QUERY2=mysql_query("UPDATE characters SET $kill_stat='$write_stat',travm_var='$travmType',travm='$kill_time',travm_stat='$kill_stat',travm_old_stat='$stat' WHERE login='$login'");
$find=rand(300,325);
if ($find>321) {
$quest_unknow = "quest_unknown";
$S = mysql_query("INSERT INTO `inv` (`owner`, `object_id`, `object_type`, `object_razdel`, `gift`, `wear`, `tear_cur`, `gift_author`, `tear_max`, `pages_used`, `book_name`, `term`, `msg`, `is_modified`) VALUES 
('$login', '1', '$quest_unknow', 'obj', NULL, '0', '0', NULL, '30', '', '', '', '', '');");
print "Поздравляем. Вы нашли Стальной меч.";
}
else {print "Вы ничего не нашли. Пока вы работали, силы покинули вас.";};
}



if ($act == "move") {
$s2=mysql_query("Update characters Set podval ='Подвал $ox$x$oy' where login='$login'");
$QUERY=mysql_query("SELECT * FROM characters WHERE login='$login'");
$data=mysql_fetch_array($QUERY);
if ($data["battle"]=="0") {
	$at = 1;
	if($at == 1){
		$attacker = 'tester';
		attack($login,$attacker,'1');
	}
}

}

if ($act == "add_res") {
$QUERT=mysql_query("SELECT * FROM podval WHERE type='$res'");
$dat=mysql_fetch_array($QUERT);
$number=$dat["number"];

$wood = mysql_query("SELECT * FROM inv WHERE owner='$login'  AND object_id  = '$res' AND object_type = 'wood' ");
if($wood){
while ($wooda = mysql_fetch_array($wood)) {
$ida = $wooda["id"];
$object_ids = $wooda["object_id"];
$b++;
}
if ($object_ids == $res) {$idas = $ida; $add= "true"; $a++;}
else {$idas = ""; $add = "false";}
}
else {print " ";}

$DEL = mysql_query("DELETE FROM inv WHERE object_id  = '$res' AND object_type='wood'");
say($who,"Удален предмет $res.",$who);
$EL = mysql_query("select FROM inv WHERE owner  = '$login' AND object_type='wood'");
$num=$number+$b;
$s2=mysql_query("Update podval Set number ='$num' where type='$res'");

$QUERY=mysql_query("SELECT * FROM characters WHERE login='$login'");
$datab=mysql_fetch_array($QUERY);
$add_resourses = $datab["add_resourses"];
$res_add = $add_resourses + $b;
$s3=mysql_query("Update characters Set add_resourses ='$res_add' where login='$login'");

print"<script>location.href='main.php?act=testgo'</script>";

}
?>