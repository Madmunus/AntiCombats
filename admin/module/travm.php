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
	$data = $adb -> selectRow ("SELECT `travm_old_stat`, `travm_stat` FROM `users` WHERE `login` = '$r_login';") or die ("Персонаж не найден!");
	$o_stat = $data['travm_old_stat'];
	$t_stat = $data['travm_stat'];
	$sql = $adb -> query ("	UPDATE `users` 
							SET `$t_stat` = '$o_stat', 
								`travm` = '0' 
							WHERE `login` = '$who';
							");
}
?>