<?
defined('AntiBK') or die("Доступ запрещен!");

$travm = $char_db['travm'];
$stats = array();
$up_text = '';

if (isset($_POST['save_ability']) && !$travm)
{
  foreach ($behaviour as $key => $min_level)
  {
    if (!isset($_POST['base_'.$key]) || $char_stats[$key] == $_POST['base_'.$key] || $level < $min_level)
      continue;
    
    $stats[$key] = abs($_POST['base_'.$key] - $char_stats[$key]);
    $up_text .= "&nbsp; &nbsp;Увеличение способности \"<b>".utf8_substr($lang[$key], 0, -1)."</b>\" произведено удачно<br>";
  }
  $ups = array_sum($stats);
  
  if ($ups > $char_stats['ups'] || $ups == 0)
    $char->error->Skills(200);
  
  if ($char->changeStats($stats) && $adb->query("UPDATE `character_stats` SET `ups` = `ups` - ?d WHERE `guid` = ?d", $ups , $guid))
  {
    $error = 1;
    $parameters = $up_text;
  }
}
else if (isset($_POST['save_skill']) && !$travm)
{
  foreach ($mastery as $key => $min_level)
  {
    if (!isset($_POST['base_'.$key]) || $key == 'phisic' || $char_stats[$key] == $_POST['base_'.$key] || $level < $min_level)
      continue;
    
    $stats[$key] = abs($_POST['base_'.$key] - $char_stats[$key]);
    $up_text .= "&nbsp; &nbsp;Увеличение способности \"<b>".utf8_substr($lang[$key], 0, -1)."</b>\" произведено удачно<br>";
  }
  $ups = array_sum($stats);
  
  if ($ups > $char_stats['skills'] || $ups == 0)
    $char->error->Skills(200);
  
  if ($adb->query("UPDATE `character_stats` SET `skills` = `skills` - ?d WHERE `guid` = ?d", $ups , $guid))
  {
    foreach ($stats as $key => $value)
      $adb->query("UPDATE `character_stats` SET ?# = ?# + ?d WHERE `guid` = ?d", $key ,$key ,$value ,$guid);
    
    $error = 1;
    $parameters = $up_text;
  }
}

$dis_buttons = "<td><img src='img/minus.gif' class='nonactive' title='уменьшить'>&nbsp;<img src='img/plus.gif' class='nonactive' title='увеличить'></td>";
$char->showStatAddition();
?>
<script src="scripts/skills.js" type="text/javascript"></script>
<img src="img/1x1.gif" width="1" height="5"><br>
<font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
<table width="100%">
  <tr>
    <td>&nbsp; &nbsp;<?echo $char->info->character();?></td>
    <td valign="top" align="right">
      <input type="button" class="nav" value="<?echo $lang['refresh'];?>" id="link" link="skills">
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
          <table cellspacing="0">
            <form action='?action=skills' name='SaveAbilityPoints' method='post'>
<?          foreach ($behaviour as $key => $min_level)
            {
              if ($level < $min_level)
                continue;
              
              $stat_text = (in_array($key, array('str', 'dex', 'con', 'int'))) ?"style='color: ".getStatSkillColor($char_stats[$key], $added[$key]).";'></td><td>".getBraces($char_stats[$key], $added[$key], $key)."&nbsp;</td>" :"></td><td></td>";
              echo "<tr>";
              echo "<td>&bull; $lang[$key]&nbsp;&nbsp;&nbsp;</td>";
              printf("<td align='right'><input name='base_$key' type='text' readonly value='$char_stats[$key]' class='show' onFocus='this.blur();' %s", $stat_text);
              echo ($char_stats['ups'] > 0) ?"<td><img id='minus_$key' src='img/minus.gif' class='nonactive' onclick=\"MakeSkillStep(-1, '$key');\" alt='уменьшить' />&nbsp;<img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"MakeSkillStep(1, '$key');\" alt='увеличить' /></td>" :"";
              echo "</tr>";
            }
?>        </table>
          <input type='submit' name='save_ability' value='сохранить' id='save_button0' class='nonactive' disabled><input type='checkbox' onClick='ChangeButtonState(0)' style='vertical-align: middle;'><br>
          </form>
          <font color="green">
<?        if ($char_stats['ups'] > 0)
            echo "<br>&nbsp;Возможных увеличений: <font id='ups'>$char_stats[ups]</font>";
          if ($char_stats['skills'] > 0 && $level > 0)
            echo "<br>&nbsp;Свободных умений: <font id='skills'>$char_stats[skills]</font>";
?>        </font>
          <br><br><br><small>Подробнее о Силе, Ловкости, Интуиции и Выносливости вы можете прочитать <a href="" target="_blank" class="nick" style="font-size: 7pt;">здесь</a></small>
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
<form action="?action=skills" name="SaveAbilityPoints" method="post">
<?
if ($level > 0)
{
  $weapon = array('sword', 'bow', 'crossbow', 'fail', 'staff', 'knife', 'axe');
  $magic = array('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
  $wmax = ($level < 5) ?$level :5;
  $mmax = ($level < 10) ?$level :10;
  echo "<table>";
  echo "<tr><td class='skill' colspan='3'>$lang[weapon]</td></tr>";
  foreach ($weapon as $key)
  {
    $dif = $char_stats[$key] - $added[$key];
    echo "<tr>";
    echo "<td>&nbsp;&bull; $lang[$key]</td>";
    echo "<td width='40' class='skill' align='right'><input name='base_$key' type='text' readonly value='$char_stats[$key]' class='show' style='color: ".getStatSkillColor($char_stats[$key], $added[$key]).";' onFocus='this.blur();'></td>";
    echo "<td>".getBraces($char_stats[$key], $added[$key], $key)."</td>";
    
    if ($char_stats['skills'] > 0 && $dif < 5 && $level >= $mastery[$key])
      echo "<td><img id='minus_$key' src='img/minus.gif' class='nonactive' onclick=\"ChangeAbility('$key', -1, $dif, $wmax)\" title='уменьшить' />&nbsp;<img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"ChangeAbility('$key', 1, $dif, $wmax)\" title='увеличить' /></td>";
    else if ($char_stats['skills'] > 0 && $dif >= 5)
      echo $dis_buttons;
    
    echo "</tr>";
  }
  if ($level >= 4)
  {
    echo "<tr><td class='skill' colspan='3'>$lang[magic]</td></tr>";
    foreach ($magic as $key)
    {
      $dif = $char_stats[$key] - $added[$key];
      echo "<tr>";
      echo "<td>&nbsp;&bull; $lang[$key]</td>";
      echo "<td width='40' class='skill' align='right'><input name='base_$key' type='text' readonly value='$char_stats[$key]' class='show' style='color: ".getStatSkillColor($char_stats[$key], $added[$key]).";' onFocus='this.blur();'></td>";
      echo "<td>".getBraces($char_stats[$key], $added[$key], $key)."</td>";
      if ($char_stats['skills'] > 0 && $dif < 10)
        echo "<td><img id='minus_$key' src='img/minus.gif' class='nonactive' onclick=\"ChangeAbility('$key', -1, $dif, $mmax)\" title='уменьшить' />&nbsp;<img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"ChangeAbility('$key', 1, $dif, $mmax)\" title='увеличить' /></td>";
      else if ($char_stats['skills'] > 0 && $dif[$key] >= 10)
        echo $dis_buttons;
      echo "</tr>";
    }
  }
  echo "<tr><td><input name='save_skill' type='submit' value='сохранить' disabled id='save_button1' class='nonactive'><input type='checkbox' onClick='ChangeButtonState(1)' style='vertical-align: middle;'></td></tr>";
  echo "</table>";
}
?>
</form>
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
    $effect_adds = array('add_hp', 'add_mp', 'mpcons', 'mpreco', 'res_magic', 'res_dmg', 'mf_magic', 'mf_dmg', 'add_hit_min', 'add_hit_max', 'mf_critp', 'mf_acrit', 'mf_dodge', 'mf_adodge');
    echo "<b>$name</b><br>";
    foreach ($effect_adds as $key)
    {
      if ($effect_s[$key] == 0)
        continue;
      
      if ($effect_s[$key] > 0)      echo "&bull; $lang[$key] +$effect_s[$key]<br>";
      else if ($effect_s[$key] < 0) echo "&bull; $lang[$key] $effect_s[$key]<br>";
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