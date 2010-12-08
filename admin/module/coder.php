<?
defined('AntiBK') or die ("Доступ запрещен!");

$tot = (isset($_POST['tot'])) ?$_POST['tot'] :"";
?>
<table>
	<form method="post">
	<tr>
		<td>
			<input type="radio" name="tac" checked value="1">B64 Decode 
			<input type="radio" name="tac" value="2">B64 Encode<br>
			<input type="radio" name="tac" value="3">md5 Hash<br>
			<input type="radio" name="tac" value="4">sha1 Hash
		</td>
	</tr>
	<tr>
		<td>
			<textarea name="tot" rows="5" cols="42"><?echo $tot;?></textarea><br>
			<input type="submit" value="Выполнить">
		</td>
	</tr>
</table>
<?
if (isset($_POST['tot']) && $tot == '')
	echo "Вы не ввели что закодировать.";
if ($tot != '')
{
	switch($_POST['tac'])
	{
		case 1:	echo "Раскодированный текст: <b>".base64_decode ($_POST['tot'])."</b>";
		break;
		case 2:	echo "Кодированный текст: <b>".base64_encode ($_POST['tot'])."</b>";
		break;
		case 3:	echo "Кодированный текст: <b>".md5 ($_POST['tot'])."</b>";
		break;
		case 4:	echo "Кодированный текст: <b>".sha1 ($_POST['tot'])."</b>";
		break;
	}
}
?>