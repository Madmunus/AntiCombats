<?
defined('AntiBK') or die ("Доступ запрещен!");

$char->showStatAddition();
?>
<script src="scripts/skills.js" type="text/javascript"></script>
<img src="img/1x1.gif" width="1" height="5"><br>
<font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
<table width="100%">
  <tr>
    <td>&nbsp; &nbsp;<?echo $char->info->character();?> <img id='loadbar' src='img/loadbar.gif' class='loadbar'></td>
    <td valign="top" align="right">
      <input type="button" class="nav" value="Обновить" id="refresh">
      <input type="button" class="nav" value="<?echo $lang['return'];?>" id="link" link="inv">
    </td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <td width="30%" valign="top">
    <table border="0" cellspacing="1" cellpadding="0" width="100%">
      <tr><td class="tzS">Характеристики персонажа</td></tr>
      <tr>
        <td style="padding-left: 5px;">
<?          echo "<table cellspacing='0'>";
            foreach ($behaviour as $key => $min_level)
            {
              if ($level < $min_level)
                continue;
              
              $stat_text = (in_array($key, array ('str', 'dex', 'con', 'int'))) ?"<font style='color: ".getStatSkillColor($char_stats[$key], $added[$key]).";'>%s</font></td><td>".getBraces($char_stats[$key], $added[$key], $key)."&nbsp;</td>" :"%s</td><td></td>";
              echo "<tr>";
              echo "<td>&bull; $lang[$key]&nbsp;&nbsp;&nbsp;</td>";
              printf("<td align='right' class='skill'>".$stat_text, "<font id='base_$key'>".$char_stats[$key]."</font>");
              echo ($char_stats['ups'] > 0) ?"<td><img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"changeStat('$key');\" alt='увеличить' /></td>" :"";
              echo "</tr>";
            }
            echo "</table>";
            if ($char_stats['ups'] > 0)
              echo "<font id='all_ups'><br>&nbsp;Возможных увеличений: <font id='ups'>$char_stats[ups]</font></font>";
            if ($char_stats['skills'] > 0 && $level > 0)
              echo "<font id='all_skills'><br>&nbsp;Свободных умений: <font id='skills'>$char_stats[skills]</font></font>";
?>
          <br><br><br><br><small>Подробнее о Силе, Ловкости, Интуиции и Выносливости вы можете прочитать <a href="" target="_blank" class="nick" style="font-size: 7pt;">здесь</a></small>
        </td>
      </tr>
    </table>
  </td>
  <td width="1" bgcolor="#a0a0a0"></td>
  <td valign="top">
<table border="0" cellspacing="1" cellpadding="0" width="100%">
  <tr>
<?
if ($level > 0)
{
?>
  <td class="tz" id="L1">Мастерство</td>
<?
}
if ($level > 1)
{
?>
  <td class="tz" id="L3">Особенности</td>
  <td class="tz" id="L4">Приемы</td>
<?
}
if ($level > 4)
{
?>
  <td class="tz" id="L7">Знания</td>
<?
}
?>
  <td class="tz" id="L5">Состояние</td>
<?
if ($level > 1)
{
?>
  <td class="tz" id="L6">Репутация</td>
<?
}
?>
  <td class="notz">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="1" cellpadding="0" width="100%">
  <td width="100%" style="padding-left: 7px;">
<div class="dtz" id="dL1">
<?
if ($level > 0)
{
  $weapon = array ('sword', 'fail', 'staff', 'knife', 'axe');
  $magic = array ('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
  echo "<table>";
  echo "<tr><td class='skill' colspan='3'>$lang[weapon]</td></tr>";
  foreach ($weapon as $key)
  {
    echo "<tr>";
    echo "<td>&nbsp;&bull; $lang[$key]</td>";
    echo "<td width='40' class='skill' align='right'><font style='color: ".getStatSkillColor($char_stats[$key], $added[$key]).";'><font id='base_$key'>$char_stats[$key]</font></font></td>";
    echo "<td>".getBraces($char_stats[$key], $added[$key], $key)."</td>";
    if ($char_stats['skills'] > 0 && $char_stats[$key] - $added[$key] < 5)
      echo "<td><img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"increaseSkill ('$key', 5)\" alt='увеличить' /></td>";
    echo "</tr>";
  }
  if ($level >= 4)
  {
    echo "<tr><td class='skill' colspan='3'>$lang[magic]</td></tr>";
    foreach ($magic as $key)
    {
      echo "<tr>";
      echo "<td>&nbsp;&bull; $lang[$key]</td>";
      echo "<td width='40' class='skill' align='right'><font style='color: ".getStatSkillColor($char_stats[$key], $added[$key]).";'><font id='base_$key'>$char_stats[$key]</font></font></td>";
      echo "<td>".getBraces($char_stats[$key], $added[$key], $key)."</td>";
      if ($char_stats['skills'] > 0 && $char_stats[$key] - $added[$key] < 10)
        echo "<td><img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"increaseSkill ('$key', 10)\" alt='увеличить' /></td>";
      echo "</tr>";
    }
  }
  echo "</table>";
}
?>
</div>
<div class="dtz" id="dL2">
</div>
<div class="dtz" id="dL3">
Не реализовано!
<?
  // <br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Изворотливый\"?")'>Изворотливый</a><br>
  // <small>Снижение стоимости передач на 0.1 кр.</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Стойкий\"?")'>Стойкий</a><br>
  // <small>Время травмы меньше на 5%.</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Быстрый\"?")'>Быстрый</a><br>
  // <small>Кнопка «Возврат» появляется раньше на 5 минут</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Сообразительный - 2\"?")'>Сообразительный - 2</a><br>
  // <small>Получаемый опыт больше на 2%</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Дружелюбный\"?")'>Дружелюбный</a><br>
  // <small>Cписок друзей больше на 5</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Общительный\"?")'>Общительный</a><br>
  // <small>Увеличение максимального размера раздела "Увлечения / хобби" на 200 символов</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Запасливый\"?")'>Запасливый</a><br>
  // <small>Больше места в рюкзаке на 10 единиц</small><br><br>
  // &bull; <a href="#" onclick='return confirm("Вы уверены, что хотите выбрать особенность \"Коммуникабельный\"?")'>Коммуникабельный</a><br>
  // <small>Лимит передач в день +20</small><br><br>
  // <b>Выбранные особенности:</b><br>
  // &bull; Сообразительный<br>
  // &bull; Двужильный<br>
  // &bull; Двужильный - 2<br>
  // &bull; Двужильный - 3<br>
  // &bull; Двужильный - 4<br>
  // &bull; Здоровый сон<br>
  // &bull; Здоровый сон - 2<br>
?>
</div>
<div class="dtz" id="dL4">
Не реализовано!
</div>
<div class="dtz" id="dL5">
<b>Эффекты:</b><br>
<div style='padding-left: 10'>
<?
  $effects = $adb->select("SELECT * FROM `character_effects` WHERE `guid` = ?d", $guid);
  foreach ($effects as $effect)
  {
    $effect_s = $adb->selectRow("SELECT * FROM `effect_template` WHERE `entry` = ?d", $effect['effect_entry']);
    $name = $effect_s['name'];
    unset($effect_s['entry'], $effect_s['name'], $effect_s['end_time'], $effect_s['set'], $effect_s['power']);
    echo "<b>$name</b><br>";
    foreach ($effect_s as $stat => $value)
    {
      if ($value == 0)
        continue;
      
      if ($value > 0)      echo "&bull; $lang[$stat] +$value<br>";
      else if ($value < 0) echo "&bull; $lang[$stat] $value<br>";
    }
    echo "<br>";
  }
?>
</div>
</div>
<div class="dtz" id="dL6">
Не реализовано!
</div>
<div class="dtz" id="dL7">
Не реализовано!
</div>
</table>
</td>
</table>