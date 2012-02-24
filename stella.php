<?
defined('AntiBK') or die ("Доступ запрещен!");

$dat = $adb->selectRow("SELECT * FROM `city_stella_main` WHERE `city` = ?s", $city);
$state = $adb->selectCell("SELECT `state` FROM `character_info` WHERE `guid` = ?d", $guid);
$open = ($dat['open']) ?"Голосование открыто" :"Голосование окончено";

if (isset($_POST['vote']) && $level >= $dat['min_level'] && $char_db['vote'] > 0 && $state == $dat['city'])
{
  $quest = $adb->selectCell("SELECT `answer` FROM `city_stella_question` WHERE `id` = ?d and `question` = ?d", $_POST['stella'] ,$dat['id']);
  $chat->say($guid, "Вы выбрали ответ: <b>$quest</b> - спасибо что проголосавали");
  $adb->query("UPDATE `characters` SET `vote` = `vote` - '1' WHERE `guid` = ?d", $guid);
  $adb->query("UPDATE `city_stella_question` SET `count` = `count` + '1' WHERE `id` = ?d and `question` = ?d", $_POST['stella'] ,$dat['id']);
}
$vote = $adb->selectCell("SELECT `vote` FROM `characters` WHERE `guid` = ?d", $guid);
?>
<script src="scripts/move_check.js" type="text/javascript"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
<tr>
  <td><h3>Голосование</h3></td>
  <td align="right">
    <?getUpdateBar();?>
    <table width="148" border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
      <tr>
        <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
        <td bgcolor="#D3D3D3" nowrap><a href="main.php?action=go&room_go=centplosh" class="passage" alt="<?echo $char->city->getRoomOnline('centplosh', 'mini');?>">Центральная Площадь</a></td>
      </tr>
    </table>
  </td>
</tr>
</table>
<br>
<table width="98%" border="0" cellpadding="0" cellspacing="1" align="center"><td>
<form name="vote" method="post">
<?
$rows = $adb->select("SELECT `id`, 
                             `answer`, 
                             `count` 
                      FROM `city_stella_question` 
                      WHERE `question` = ?d ORDER BY `id`", $dat['id']);
$count = $adb->selectCell("SELECT SUM(count) FROM `city_stella_question` WHERE `question` = ?d ORDER BY `id`", $dat['id']);
echo "<fieldset><legend><b>$dat[question]</b></legend>";
if ($vote > 0 && $level > $dat['min_level'] && $state == $dat['city'])
{
  foreach ($rows as $answers)
  {
    $id = $answers['id'];
    echo "<input type='radio' name='stella' value='$id' id='$id' align='center'><b><label for='$id'>$answers[answer]</label></b><br>";
  }
  echo "<br>&nbsp;&nbsp;<input type='submit' name='vote' value='Голосовать' size='30' class='new'>";
}
else
{
  foreach ($rows as $answers)
  {
    $p = round (($answers['count'] / $count) * 100, 1);
    echo "&nbsp;&nbsp;<b>$answers[answer]</b> ($p%)<br>";
  }
}
?>
</fieldset>
</form>
</td></tr></table>
</div>
<?
  echo "Всего голосов: $count<br>";
  echo "Время голосования: <b>$open</b><br>";
  echo "Минимальный уровень: $dat[min_level]<br>";
  echo "Можете голосовать раз: $vote<br>";
?>
<br><br>
Голосовать имеют право лишь лица достигшие указанного уровня, родившиеся в городе, где проводится голосование.