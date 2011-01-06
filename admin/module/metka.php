<?
defined('AntiBK') or die ("Доступ запрещен!");

$r_login = (isset($_POST['r_login'])) ?$_POST['r_login'] :"";
$metka = (isset($_POST['metka'])) ?$_POST['metka'] :"";
?>
<form method="post" action="">
<strong>Логин</strong><br>
<input type="text" name="r_login" size="25"><br>
<strong>Метка</strong><br>
<input type="text" name="metka" size="25"><br>
<input type="submit" name="submit" value="Далее"></form>
<?
if (isset($_POST['r_login']) && $r_login == '')
    echo "Вы не ввели Логин.";
else if (isset($_POST['metka']) && $metka == '')
    echo "Вы не ввели Метку.";
else if ($r_login != '' && $metka != '')
{
    $sql = $adb->query ("    UPDATE `characters` 
                            SET `metka` = '$metka' 
                            WHERE `login` = '$r_login';
                            ");
    echo "Персонаж проверен.";
}
?>