<?
$user_sql="SELECT * FROM characters WHERE login='$login'";


$SQL =    mysql_query("UPDATE characters SET str = str=3, hp_now = hp_now=18, energy_now = energy_now=6 WHERE login='$login'");

    

    $nms="Всё прошло удачно...<br>Ваши параметры сброшены!";
    $alldone=1;


?>