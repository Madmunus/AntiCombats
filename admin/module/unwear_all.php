<?
defined('AntiBK') or die ("Доступ запрещен!");

$answer = (isset($_POST['answer'])) ?$_POST['answer'] :"";
?>
<form method="post" action="">
<strong>Раздеть всех персонажей</strong><br>
<select name="answer">
<option value="no">Нет</option>
<option value="yes">Да</option>
</select>
<input type="submit" name="submit" value="Далее"></form>
<?
if ($answer == 'yes')
{
    $sql1 = $adb->query("UPDATE `inv` SET `wear` = '0';");
    $sql2 = $adb->query("UPDATE `characters` 
                            SET `helmet` = '0', 
                                `naruchi` = '0', 
                                `hand_r` = '0', 
                                `hand_r_free` = '1', 
                                `hand_r_type` = 'phisic', 
                                `armor` = '0', 
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
                            ");
    echo "Все игроки раздеты.";
}
?>