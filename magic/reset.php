<?
$user_sql="SELECT * FROM users WHERE login='$login'";


$SQL =	mysql_query("UPDATE users SET str = str=3, hp_now = hp_now=18, energy_now = energy_now=6 WHERE login='$login'");

	

	$nms="Всё прошло удачно...<br>Ваши параметры сброшены!";
	$alldone=1;


?>