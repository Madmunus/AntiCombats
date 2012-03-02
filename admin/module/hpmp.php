<?
defined('AntiBK') or die ("Доступ запрещен!");

$r_login = (isset($_POST['r_login'])) ?$_POST['r_login'] :"";
$hp = (isset($_POST['hp'])) ?$_POST['hp'] :"";
$mp = (isset($_POST['mp'])) ?$_POST['mp'] :"";
?>
<form method="post" action="">
<strong>Логин</strong><br>
<input type="text" name="r_login" size="25"><br>
<strong>НР</strong><br>
<input type="text" name="hp" size="25"><br>
<strong>Манна</strong><br>
<input type="text" name="mp" size="25"><br>
<input type="submit" name="submit" value="Вылечить"></form>
<?
if (isset($_POST['r_login']) && isset($_POST['hp']) && isset($_POST['mp']))
{
    $sql = $adb->query("    UPDATE `characters` 
                            SET `hp` = '$hp', 
                                `mp` = '$mp' 
                            WHERE `login` = '$login';
                            ");
    echo "Смена маны и здоровья прошли успешно";
}
?>