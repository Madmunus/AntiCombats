<?
defined('AntiBK') or die ("Доступ запрещен!");

$date = (isset($_POST['date']) && eregi ("^[0-9]+\.[0-9]+", $_POST['date'])) ?utf8_substr (htmlspecialchars ($_POST['date']), 0, 5) :date ('m.y');
$split = split ('\.', $date);
$first_time  = mktime (0, 0, 0, $split[0], 01, $split[1]);
$second_time = mktime (0, 0, 0, $split[0], date ("t", $first_time), $split[1]);

$rows = $adb->select ("SELECT `action`, 
                                `date`, 
                                `ip`, 
                                `comment` 
                         FROM `history_auth` 
                         WHERE `city` = ?s 
                           and `date` <= ?d 
                           and `date` >= ?d 
                           and `guid` = ?d 
                         ORDER BY `id`;", $city ,$second_time ,$first_time ,$guid);
?>
<style>
body {background-color: #e2e0e0;}
</style>
<p align="right"><input type="button" class="nav" value="<?echo $lang['return'];?>" id="link" link="inv"></p>
<h3>Отчет системы безопасности</h3>
<form action="?action=report" method="post">
Вы можете получить отчет о заходах за указанный месяц<br>
<?
if (count($rows) == 0)
  echo "<center><font color='red'>Нет данных за этот период.</font></center>";
?>
Укажите месяц, на который хотите получить отчет <small>(в формате mm.yy)</small>: <input type="text" name="date" value="<?echo $date;?>"> <input type="submit" value="Посмотреть">
</form><br>
<table width="100%" bgcolor="#F0F0F0">
<tr>
<td>
<h3>Отчет системы безопасности за <?echo $date;?></h3>
<?
$reports = '';
foreach ($rows as $auth)
{
  list ($action, $date_a, $ip, $comment) = array_values ($auth);
  $date_a = date ('d.m.y H:i', $date_a);
  $city = $adb->selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $city);
  
  if (!$reports)
    $reports = "<h4>$city</h4>";
  
  switch ($action)
  {
    case 1:                    $reports .= "$date_a Входит \"$login\" $ip<br>";                       break;
    case 0:
      switch ($comment)
      {
        case 'wrong_password': $reports .= "$date_a <B>Неверный пароль</B>, $ip<br>";                 break;
        case 'blocked':        $reports .= "$date_a <B>Персонаж заблокирован</B>, $ip<br>";           break;
      }
    break;
  }
}
echo $reports;
?>
</td>
</tr>
</table>
