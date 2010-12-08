<?
defined('AntiBK') or die ("Доступ запрещен!");

$sort = (isset($_POST['sort'])) ?$_POST['sort'] :1;
$sort_c = array (
	1	=>	'`id`',
	2	=>	'`login`',
	3	=>	'`login_display`',
	4	=>	'`last_time`',
	5	=>	'`room`',
	6	=>	'`city`'
);
$online = $adb -> select ("SELECT * FROM `online` ORDER BY $sort_c[$sort];");
$count = count ($online);
?>
<form action='' method='post'>
Сортировать по: 
<select class='small' name='sort'>
<?
for ($i = 1; $i <= 6; $i++)
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
		<td><strong>№</strong></td>
		<td><strong>id</strong></td>
		<td><strong>Логин</strong></td>
		<td><strong>Отображаемый логин</strong></td>
		<td><strong>Время входа</strong></td>
		<td><strong>Комната</strong></td>
		<td><strong>Город</strong></td>
	</tr>
<?
for ($i = 0; $i < $count; $i++)
{
	$id = $online[$i]['id'];
	$login_s = character ($online[$i]['login']);
	$login_display = $online[$i]['login_display'];
	$last_time = date ("d-m-y H:i:s", $online[$i]['last_time']);
	$room = $online[$i]['room'];
	$city = $online[$i]['city'];
	echo "<tr align='center'>"
	   . "<td align='right'>".($i + 1)."</td>"
	   . "<td>$id</td>"
	   . "<td>$login_s</td>"
	   . "<td>$login_display</td>"
	   . "<td>$last_time</td>"
	   . "<td>$room</td>"
	   . "<td>$city</td>"
	   . "</tr>";
}
echo "</table>";
$last = character ($adb -> selectCell ("SELECT `login` FROM `online` ORDER BY `last_time` DESC;"));
if ($count > 0)
	echo "<center><em><strong>Последний Зашедший юзер:</em> $last <em>Всего:</strong></em><strong> $i</strong></center>";
else
	echo "<center><em><strong>Нету игроков онлайн.</strong></em></center>";
?>