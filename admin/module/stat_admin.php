<?
defined('AntiBK') or die ("Доступ запрещен!");

$r_login = (isset($_POST['r_login'])) ?$_POST['r_login'] :"";
$status = (isset($_POST['status'])) ?$_POST['status'] :"";
$state = (isset($_POST['state'])) ?$_POST['state'] :"";
?>
<form method="post" action="">
<strong>Логин</strong><br>
<input type="text" name="r_login" size="25"><br>
<strong>Статус</strong><br>
<input type="text" name="status" size="25"><br>
<strong>Подданство</strong><br>
<input type="text" name="state" size="25"><br>
<input type="submit" name="submit" value="Далее"></form>
<?
if (isset($_POST['r_login']) && $r_login == '')
    echo "Вы не ввели Логин.";
else if ($r_login != '')
{
    $sql = $adb->query ("    UPDATE `characters` 
                            SET `status` = '$status', 
                                `state` = '$state' 
                            WHERE `login` = '$login';
                            ");
    echo "Статус и подданство успешно изменены.";
}
?>