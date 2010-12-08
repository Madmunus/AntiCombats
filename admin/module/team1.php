
<?php
include "conf.php" ;
//
/*----Для айди персонажа--//

$connect = @mysql_connect($base_name,$base_user,$base_pass)or die ("Не возможно подключиться к Базе данных")  ;

           $db = @mysql_select_db($db_name,$connect) or die ("Невозможно выбрать Базу данных");
           $sql = "SELECT id, login  FROM  users  ";         //ORDER BY id
           $result = @mysql_query($sql,$connect) or die ("Невозможно выполнить запрос");
           while ($row = mysql_fetch_array($result));

           $login_use = $row['login'];


//----Для айди персонажа--/*/


if ($sort == "ip") {$s = " order by id";}
if ($sort == "u") {$s = " order by username";}
$connect = @mysql_connect($base_name,$base_user,$base_pass)or die ("Не возможно подключиться к Базе данных")  ;

           $db = @mysql_select_db($db_name,$connect) or die ("Невозможно выбрать Базу данных");
           $sql = "SELECT * FROM  team1  ";         //ORDER BY id
           $result = @mysql_query($sql,$connect) or die ("Невозможно выполнить запрос");
         while ($row = mysql_fetch_array($result)) {
                  $i++;
                  $t_end = $i%30;
/*/echo " = t_end<br>";

                     if ($login_use = $login){
                             $id_use= $id ;

                             }  */
    if ($i == 1 or $t_end == 1) {

echo "<table width='270' border='1' cellspacing='0' cellpadding='3' align='centr'>
  <tr align='center'>
    <td width='20'><strong>#</strong></td>
    <td width='120' align='center'><strong>ID боя</strong></td>
    <td width='130' align='center'><strong>Логин</strong></td>
        <td width='150' align='center'>Дата подачи</strong></td>
    <td width='170' align='center'><strong>Незнаю</strong></td>
    <td width='180' align='center'><strong>Незнаю</strong></td>
    <td width='190' align='center'><strong>IP подачи</strong></td>

  </tr>";

            }
                 $id    = $row['battle_id '];
                 $login = $row['player'];
                 $login_display = $row['date'];
                 $last_time = $row['hitted'];
                 $room = $row['over'];
                 $room = $row['ip'];


                 echo " <tr>
    <td align='right'>$i</td>
    <td>$id</td>
    <td><a href='info.php?log=$login' target='_blank'><font color='darkgreen'>$login</font></a></td>
    <td>$login</td>

    <td>$last_time</td>
    <td>$room</td>
    <td>$city</td>
  </tr>";

    if ($t_end == 0) {echo "</table>";}

}






               ?>