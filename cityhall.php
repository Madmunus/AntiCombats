<?
defined('AntiBK') or die ("Доступ запрещен!");

$prof = requestVar ('prof');
$conf = requestVar ('conf');

// Переменные
$bot = '</div>';
$error_text = array (
  'profession' => '<center>Вы уже имеете професcию! Для того чтобы получить новую профессию, Вам надо уволиться со старой профессии!</center>'.$bot,
  'metka'      => '<center>Вы не прошли паладинскую проверку! Вы не можете получить профессию!</center>'.$bot,
  'level'      => '<center>Получить профессию Вы сможете только после 4-го уровня!</center>'.$bot,
  'money'      => '<center>У Вас недостаточно средств для получения этой профессии!</center>'.$bot,
  'fire'       => '<center>У Вас нет професии, Вы не можете уволиться!</center>'.$bot,
  'fire_money' => '<center>У Вас недостаточно средств для того, чтобы уволиться!</center>'.$bot
);

$professions = array (
//Профессия          |Стоимость     |Статы        |Остальные статы                                                |Описание
  'knight' => array ('1000', array ('str' => 10, 
                                    'vit' => 10), '',                                                            '+10 к Силе, +10 к Выносливости'),
  'mage'   => array ('1300', array ('int' => 10, 
                                    'wis' => 10), '',                                                            '+10 к Интеллекту, +10 к Мудрости'),
  'elf'    => array ('900',  array ('dex' => 15, 
                                    'vit' => 5),  '',                                                            '+15 к Ловкости, +5 к Выносливости'),
  'monk'   => array ('2000', array ('con' => 15, 
                                    'vit' => 5),  '',                                                            '+15 к Интуиции, +5 к Выносливости'),
  'trade'  => array ('1100',        '', array (   'characters'      => array ('maxmass' => $db['maxmass'] + 20), 
                                                  'character_stats' => array ('trade' => $stats['trade'] + 40)), '+40 к навыку Торговли, +20 к максимальной нагрузке')
);
?>
<script type="text/javascript">
$(document).ready(function (){
  var cur_Id = '0';
  $('.us2').click(function (){
    $('#'+cur_Id).css('color', '#000000');
    $('#s'+cur_Id).css('display', 'none');
    cur_Id = $(this).attr('id');
    $('#'+cur_Id).css('color', '#bb0000');
    $('#s'+cur_Id).css('display', 'block');
  });
  $("[name='prof']").click(function (){
    $('#'+cur_Id).css('display', 'none');
    cur_Id = $(this).val();
    $('#'+cur_Id).css('display', 'block');
  });
});
</script>
<table width="100%" height="20" style="border: 2px solid #cccccc; -moz-border-radius: 50px; background: #cccccc; padding: 0 5px 0 5px;">
  <tr>
    <td><b>Академия</b></td>
    <td align="right"><b>У вас в наличии: <font color="green"><?echo $money;?></font> кр.</b></td>
  </tr>
</table>
<br>
<div style="text-align: center; border: 2px solid #cccccc; -moz-border-radius: 50px; background: #cccccc;">
  <input type="button" class="b" value=" Правила " onClick="location.href='?do=profession';">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Получить профессию " onClick="location.href='?do=reg_prof';">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Уволиться " onClick="location.href='?do=fire';">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Архив " onClick="location.href='?do=best_prof';">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Выход " onClick="location.href='?action=go&room_go=centplosh';">
</div>
<br>
<div style="border: 2px solid #cccccc; -moz-border-radius: 15px; background: #cccccc; padding: 0 5px 5px 5px;">
  <center><b>Академия</b></center>
<?
switch ($do)
{
  default:
  case 'profession':
    $allprof = $adb -> selectCell ("SELECT COUNT(*) FROM `characters` WHERE `profession` != '';");
    $city = $adb -> selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $city);
    echo "&nbsp; &nbsp;Добро пожаловать в Академию города <b>$city</b>. Здесь Вы сможете выбрать себе профессию. Вы можете иметь только одну профессию одновременно. Для того чтобы сменить профессию, Вам необходимо уволиться со старой и выбрать новую профессию. Подробнее о выборе профессии и увольнении читайте в разделах \"Получить проффесию\" и \"Уволиться\" соответственно.<br><br>Кол-во профессионалов: $allprof чел.";
  break;
  case 'reg_prof':
    if (!empty($conf))
    {
      if ($db['profession'])
        die ($error_text['profession']);
      
      if (!$db['metka'])
        die ($error_text['metka']);
      
      if ($level < 4)
        die ($error_text['level']);
      
      if ($conf)
      {
        $update = $professions[$prof];
        
        if ($money < $update[0])
          die ($error_text['money']);
        
        if (is_array($update[1]))
        {
          foreach ($update[1] as $stat => $value)
            $equip -> increaseStat ($stat, $value);
        }
        
        if (is_array($update[2]))
        {
          foreach ($update[2] as $database => $stats)
            $adb -> query ("UPDATE ?# SET ?a WHERE `guid` = ?d", $database ,$stats ,$guid);
        }
        
        $adb -> query ("UPDATE `characters` SET `profession` = ?s WHERE `guid` = ?d", $prof ,$guid);
        die ("Вы получили профессию <b>".$lang['prof_'.$prof]."</b>$bot");
      }
    }
    if (!empty($prof))
    {
      echo "<center>Вы уверены что хотите выбрать профессию <b>".$lang['prof_'.$prof]."</b>?<br>";
      echo "<input type='button' class='but' value='Да' onClick=\"location.href='?do=reg_prof&prof=$prof&conf=1'\"> &nbsp;";
      echo "<input type='button' class='but' value='Нет' onClick=\"location.href='?do=reg_prof'\"></center>";
      die ($bot);
    }
?>
  <b>Правила получения профессии:</b>
  <ol>
  <li>Получить профессию можно только после 4-го уровня, только в Академий.</li>
  <li>Для получения профессии необходимо пройти паладинскую проверку.</li>
  <li>На момент получения профессии на Вашем счету должна быть необходимая сумма.</li>
  </ol>
  <b>Профессии</b>:<br>
  <form action="" method="get" style="display: inline;">
  <input type="hidden" name="action" value="none">
  <input type="hidden" name="do" value="reg_prof">
  <ol>
<?  foreach ($professions as $key => $value)
      echo "<li><input type='radio' name='prof' value='$key'><b>".$lang['prof_'.$key]."</b></li><div id='$key' class='prof_desc'><b>Описание</b>: $value[3]<br><b>Стоимость</b>: $value[0] кр.</div>";
?></ol>
  <input type="submit" class="but" value="Получить профессию">
  </form>
<?
  break;
  case 'fire':
    if (!$db['profession'])
      die ($error_text['fire']);
    $prof = $db['profession'];
    $prof_d = $lang['prof_'.$prof];
    if ($conf == 1)
    {
      echo "<center>Вы уверены что хотите уволиться с профессии <b>$prof_d</b>?<br>";
      echo "<input type='button' class='but' value='Да' onClick=\"location.href='?do=fire&conf=2'\"> &nbsp;";
      echo "<input type='button' class='but' value='Нет' onClick=\"location.href='?do=fire'\"></center>";
      die ($bot);
    }
    if ($conf == 2)
    {
      if ($money >= 100)
      {
        $update = $professions[$prof];
        
        if (is_array($update[1]))
        {
          foreach ($update[1] as $stat => $value)
            $equip -> increaseStat ($stat, -$value);
        }
        
        if ($prof == 'trade')
        {
          $adb -> query ("UPDATE `characters` SET `maxmass` = `maxmass` - 20 WHERE `guid` = ?d", $guid);
          $adb -> query ("UPDATE `character_stats` SET `trade` = `trade` - 40 WHERE `guid` = ?d", $guid);
        }
        
        $adb -> query ("UPDATE `characters` 
                        SET `profession` = '', 
                            `money` = `money` - 100 
                        WHERE `guid` = ?d", $guid);
        die ("Вы уволились с профессии <b>$prof_d</b>.$bot");
      }
      else
        die ($error_text['fire_money']);
    }
    echo "Ваша текущая профессия: <b>$prof_d</b><br>";
    echo "<input type='button' class='but' value='Уволиться (100 кр.)' onClick=\"location.href = '?do=fire&conf=1;'\">";
  break;
  case 'best_prof':
    echo "<center><b>Архив:</b></center>";
    echo "Добро пожаловать в Государственный Архив! Здесь Вы можете найти списки 5 лучших профессионалов в каждой профессии.<br>";
    $i = 1;
    foreach ($professions as $key => $value)
    {
      echo "<a href='#' class='us2' id='$i'>".$lang['prof_'.$key].":</a><font id='s$i' class='prof_best'>".$info -> showArch ($key)."</font><br>";
      $i++;
    }
  break;
}
?>