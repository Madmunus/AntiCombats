<?
defined('AntiBK') or die ("Доступ запрещен!");

$r_login = (isset($_POST['r_login'])) ?$_POST['r_login'] :"";
?>
<form method="post" action="">
<strong>Логин</strong><br>
<input type="text" name="r_login" size="25" value="<?echo $r_login;?>">
<input type="submit" name="submit" value="Далее">
</form>
<?
if (isset($_POST['r_login']) && $r_login == '')
	echo "Вы не ввели Логин.";
else if ($r_login != '')
{
	$sql = $adb -> query ("	UPDATE `users` 
							SET `battle` = '0', 
								`battle_pos` = '', 
								`battle_team` = '', 
								`battle_opponent` = '' 
							WHERE `login` = '$r_login';
							");
	echo "Персонаж вытащен из битвы";
}
?>