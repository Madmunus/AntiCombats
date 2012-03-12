<?
defined('AntiBK') or die ("Доступ запрещен!");

$style = requestVar('style');
$conf = requestVar('conf');

// Переменные
$error_text = array (
  'style'   => '<center>Вы уже обучились стилю боя!</center>',
  'checkup' => '<center>Вы не прошли паладинскую проверку!</center>',
  'level'   => '<center>Обучиться стилю боя Вы сможете только после 4-го уровня!</center>',
  'money'   => '<center>У Вас недостаточно средств для обучения этому стилю боя!</center>',
);
$styles = $adb->select("SELECT `style`, `str`, `dex`, `con`, `vit`, `int`, `wis`, `price` FROM `player_styles`");
?>
<script type="text/javascript">
$(function (){
  var cur_Id = '0';
  $('.us2').click(function (){
    $('#'+cur_Id).css('color', '#000000');
    $('#s'+cur_Id).css('display', 'none');
    cur_Id = $(this).attr('id');
    $('#'+cur_Id).css('color', '#bb0000');
    $('#s'+cur_Id).css('display', 'block');
  });
  $("[name='style']").click(function (){
    $('#'+cur_Id).css('display', 'none');
    cur_Id = $(this).val();
    $('#'+cur_Id).css('display', 'block');
  });
});
</script>
<table width="100%" height="20" style="border: 2px solid #cccccc; -moz-border-radius: 50px; background: #cccccc; padding: 0 5px 0 5px;">
  <tr>
    <td><b>Боевая академия</b></td>
    <td align="right"><b>У вас в наличии: <font color="green"><?echo $money;?></font> кр.</b></td>
  </tr>
</table>
<br>
<div style="text-align: center; border: 2px solid #cccccc; -moz-border-radius: 50px; background: #cccccc;">
  <input type="button" class="b" value=" Правила " id="link" link="none&do=info">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Стили Боя " id="link" link="none&do=learn_style">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Архив " id="link" link="none&do=best_fighters">&nbsp; &nbsp; &nbsp;
  <input type="button" class="b" value=" Выход " id="link" link="go&room_go=centsquare">
</div>
<br>
<div style="border: 2px solid #cccccc; -moz-border-radius: 15px; background: #cccccc; padding: 0 5px 5px 5px;">
  <center><b>Боевая академия</b></center>
<?
switch ($do)
{
  default:
  case 'info':
    $allfighters = $adb->selectCell("SELECT COUNT(*) FROM `characters` WHERE `f_style` != '';");
    $city_name = $char->city->getCity($city, 'name');
    echo "&nbsp; &nbsp;Добро пожаловать в Боевую академию города <b>$city_name</b>. Здесь Вы сможете обучиться стилю боя. Подробнее о выборе стиля боя читайте в разделе \"Стили Боя\".<br><br>Кол-во обученных бойцов: $allfighters чел.";
  break;
  case 'learn_style':
    if (!empty($conf))
    {
      if ($f_style)
      {
        echo $error_text['style'];
        break;
      }
      
      if (!$char_db['checkup'])
      {
        echo $error_text['checkup'];
        break;
      }
      
      if ($level < 4)
      {
        echo $error_text['level'];
        break;
      }
      
      $update = $adb->selectRow("SELECT `str`, `dex`, `con`, `vit`, `int`, `wis`, `price` FROM `player_styles` WHERE `style` = ?s", $style);
      
      if (!($char->changeMoney($update['price'])))
      {
        echo $error_text['money'];
        break;
      }
      
      unset($update['price']);
      $char->changeStats($update);
      $adb->query("UPDATE `characters` SET `f_style` = ?s WHERE `guid` = ?d", $style ,$guid);
      echo "Вы обучились стилю боя: <b>".$lang['style_'.$style]."</b>";
      break;
    }
    if (!empty($style))
    {
      echo "<center>Вы уверены что хотите обучиться стилю боя: <b>".$lang['style_'.$style]."</b>?<br>";
      echo "<input type='button' class='but' value='Да' id='link' link='none&do=learn_style&style=$style&conf=1'> &nbsp;";
      echo "<input type='button' class='but' value='Нет' id='link' link='none&do=learn_style'></center>";
      break;
    }
?>
  <b>Правила обучения:</b>
  <ol>
  <li>Обучиться стилю боя можно только после 4-го уровня, только в Боевой академии.</li>
  <li>Для обучения необходимо пройти паладинскую проверку.</li>
  <li>На момент обучения на Вашем счету должна быть необходимая сумма.</li>
  </ol>
  <b>Стили боя</b>:<br>
  <form action="" method="get" style="display: inline;">
  <input type="hidden" name="action" value="none">
  <input type="hidden" name="do" value="learn_style">
<?  foreach ($styles as $style)
    {
      echo "<input type='radio' name='style' value='$style[style]'><b>".$lang['style_'.$style['style']]."</b><br>";
      echo "<font id='$style[style]' class='style_desc'><b>Описание</b>: ".$lang['style_'.$style['style'].'_d']."<br><b>Стоимость</b>: $style[price] кр.</font>";
    }
?><br>
  <input type="submit" class="but" value="Обучиться стилю">
  </form>
<?
  break;
  case 'best_fighters':
    echo "<center><b>Архив:</b></center>";
    echo "Добро пожаловать в Государственный Архив! Здесь Вы можете найти списки 5 лучших бойцов в каждом стиле.<br>";
    $i = 1;
    foreach ($styles as $style)
    {
      echo "<a href='#' class='us2' id='$i'>".$lang['style_'.$style['style']].":</a><font id='s$i' class='style_best'>".$char->info->showArch($style['style'])."</font><br>";
      $i++;
    }
  break;
}
?>
</div>