<?
defined('AntiBK') or die("Доступ запрещен!");

$sort = getVar('sort', 1);
$sort_c = array(
  1 => 'login_display',
  2 => 'last_time',
  3 => 'room',
  4 => 'city'
);
?>
<form action='' method='post'>
Сортировать по: 
<select class='small' name='sort'>
<?
for ($i = 1; $i <= 4; $i++)
{
    $select = ($sort == $i) ?" selected" :"";
    echo "<option value='$i'$select>$sort_c[$i]</option>\n";
}
?>
</select>
<input type='submit' value='Далее'>
</form>
<table width='100%' border='1' cellspacing='0' cellpadding='3' align='centr'>
    <tr align='center'>
        <td><strong>Логин</strong></td>
        <td><strong>Отображаемый логин</strong></td>
        <td><strong>Последняя активность</strong></td>
        <td><strong>Комната</strong></td>
        <td><strong>Город</strong></td>
    </tr>
<?
$online = $adb->select("SELECT * FROM `online` ORDER BY ?#", $sort_c[$sort]);
foreach ($online as $character)
{
  echo "<tr align='center'>"
     . "<td>".$char->getLogin('clan', $character['guid'])."</td>"
     . "<td>$character[login_display]</td>"
     . "<td>".date("d-m-y H:i:s", $character['last_time'])."</td>"
     . "<td>".$char->city->getRoom($character['room'], $character['city'], 'name')."</td>"
     . "<td>".$char->city->getCity($character['city'], 'name')."</td>"
     . "</tr>";
}
echo "</table>";
?>