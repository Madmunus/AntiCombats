<?
defined('AntiBK') or die ("Доступ запрещен!");

$answer = (isset($_POST['answer'])) ?$_POST['answer'] :"";
?>
<form method="post" action="">
<strong>Достать всех из битвы</strong><br>
<select name="answer">
<option value="no">Нет</option>
<option value="yes">Да</option>
</select>
<input type="submit" name="submit" value="Далее"></form>
<?
if ($answer == 'yes')
{
    $sql = $adb->query("    UPDATE `characters` 
                            SET `battle` = '0', 
                                `battle_pos` = '', 
                                `battle_team` = '', 
                                `battle_opponent` = '';
                            ");
    echo "Все персонажи вытащены из битвы.";
}
?>