<?
defined('AntiBK') or die ("Доступ запрещен!");

$answer = (isset($_POST['answer'])) ?$_POST['answer'] :"";
?>
<form method="post" action="">
<strong>Вылечить у всех травмы</strong><br>
<select name="answer">
<option value="no">Нет</option>
<option value="yes">Да</option>
</select>
<input type="submit" name="submit" value="Далее"></form>
<?
if ($answer == 'yes')
{
    $rows = $adb->select("SELECT `travm_old_stat`, `travm_stat`, `login` FROM `characters`;");
    foreach ($rows as $data)
    {
        $who = $data['login'];
        $o_stat = $data['travm_old_stat'];
        $t_stat = $data['travm_stat'];
        $sql = $adb->query("    UPDATE `characters` 
                                SET `$t_stat` = '$o_stat', 
                                    `travm` = '0' 
                                WHERE `login` = '$who';
                                ");
    }
    echo "Все игроки вылечены.";
}
?>