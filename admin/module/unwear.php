<?
defined('AntiBK') or die ("Доступ запрещен!");

$r_login = (isset($_POST['r_login'])) ?$_POST['r_login'] :"";
?>
<form method="post" action="">
<strong>Логин</strong><br>
<input type="text" name="r_login" size="25">
<input type="submit" name="submit" value="Далее"></form>
<?
if (isset($_POST['r_login']))
{
	$sql1 = $adb -> query ("UPDATE `inv` SET `wear` = '0' WHERE `owner` = '$r_login';");
	$sql2 = $adb -> query ("UPDATE `users` 
							SET `helmet` = '0', 
								`naruchi` = '0', 
								`hand_r` = '0', 
								`hand_r_free` = '1', 
								`hand_r_type` = 'phisic', 
								`armour` = '0', 
								`poyas` = '0', 
								`sergi` = '0', 
								`amulet` = '0', 
								`ring1` = '0', 
								`ring2` = '0', 
								`ring3` = '0', 
								`perchi` = '0', 
								`hand_l` = '0', 
								`hand_l_free` = '1', 
								`hand_l_type` = 'phisic', 
								`pants` = '0', 
								`boots` = '0' 
							WHERE `login` = '$r_login';
							");
	echo "Персонаж вытащен из битвы";
}
?>