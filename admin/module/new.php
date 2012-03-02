<?
defined('AntiBK') or die ("Доступ запрещен!");

$r_login = (isset($_POST['r_login'])) ?$_POST['r_login'] :"";
$r_login_new = (isset($_POST['r_login_new'])) ?$_POST['r_login_new'] :"";

echo "<form method='post' action=''>"
   . "<strong>Логин</strong><br>"
   . "<input type='text' name='r_login' size='25' value='$r_login'><br>"
   . "<strong>Новый Логин</strong><br>"
   . "<input type='text' name='r_login_new' size='25' value='$r_login_new'><br>"
   . "<input type='submit' name='submit' value='Перебросить'></form>";

if (isset($_POST['r_login']) && $r_login == '')
    echo "Вы не ввели Логин.";
else if (isset($_POST['r_login_new']) && $r_login_new == '')
    echo "Вы не ввели Новый Логин.";
else if ($r_login != '' && $r_login_new != '')
{
    $sql = $adb->query("    UPDATE `inv` 
                            SET `owner` = '$r_login_new' 
                            WHERE `owner` = '$r_login';
                            ");
    echo "Вещи были переброшены.";
}
?>