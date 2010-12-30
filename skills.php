<?
defined('AntiBK') or die ("Доступ запрещен!");

?>
<script type="text/javascript">
var clevel = '';
var arrChange = { };
var skillsArr = new Array ();
skillsArr["sword"] = 0;
skillsArr["fail"] = 0;
skillsArr["staff"] = 0;
skillsArr["knife"] = 0;
skillsArr["axe"] = 0;
skillsArr["fire"] = 0;
skillsArr["water"] = 0;
skillsArr["air"] = 0;
skillsArr["earth"] = 0;
skillsArr["light"] = 0;
skillsArr["gray"] = 0;
skillsArr["dark"] = 0;

function SetAllSkills (isOn)
{
  var arrSkills = new Array ("str", "dex", "con", "vit", "int", "wis", "spi");
  for (var i in arrSkills)
  {
    var clname = (isOn) ?"skill" :"nonactive";
    $('#plus_'+arrSkills[i]).attr('class', clname);
  }
}

function setlevel (nm)
{
  if (clevel != '' && clevel != nm)
  {
    $('#'+clevel).removeClass('tzSet tzOver');
    $('#d'+clevel).css('display', 'none');
  }
  clevel = nm || 'L1';
  setCookie ('clevel', clevel, getTimePlusHour ());
  $('#'+clevel).addClass('tzSet');
  $('#d'+clevel).css('display', 'block');
}

function ChangeButtonState (bid)
{
  if ($('#save_button'+bid).is(':disabled'))
    $('#save_button'+bid).attr({'class': 'active', 'disabled': ''});
  else
    $('#save_button'+bid).attr({'class': 'nonactive', 'disabled': 'disabled'});
}

function MakeSkillStep (nDelta, id)
{
  var n_UP = parseFloat($('#up').val()) | 0;
  if ((n_UP - nDelta ) < 0)
    return;
  
  if (!arrChange[id])
    arrChange[id] = 0;
  
  if ((arrChange[id] + nDelta) < 0 )
  {
    $('#minus_'+id).attr('class', 'nonactive');
    return;
  }
  
  SetAllSkills ((n_UP - nDelta));
  arrChange[id] += nDelta;
  $('input[name='+id+'_base]').val(parseFloat($('input[name='+id+'_base]').val()) + nDelta);
  $('#'+id+"_inst").html(parseFloat($('#'+id+"_inst").html()) + nDelta);
  $('#up').val(n_UP -= nDelta);
  
  if (arrChange[id] == 0)
    $('#minus_'+id).attr('class', 'nonactive');
  else
    $('#minus_'+id).attr('class', 'skill');
}

function ChangeAbility (id, nDelta, inst, maxval)
{
  var nm_UP = parseFloat($('#skill').val()) | 0;
  if ((nm_UP - nDelta) < 0)
    return;
  
  if (!arrChange[id])
    arrChange[id] = 0;
  
  if ((arrChange[id] + nDelta ) == 0)
    $('#minus_'+id).attr('class', 'nonactive');
  
  if (nDelta > 0 && (arrChange[id] + nDelta + inst) == maxval)
  {
    skillsArr[id] = 1;
    $('#plus_'+id).attr('class', 'nonactive');
  }
  
  if ((arrChange[id] + nDelta) < 0 )
    return;
  
  if (nDelta > 0 && (arrChange[id] + nDelta + inst) > maxval)
    return;
  
  arrChange[id] += nDelta;
  if ((nm_UP - nDelta) == 0)
  {
    for (var i in skillsArr)
    {
      $('#plus_'+id).attr('class', 'nonactive');
    }
  }
  $('[name='+id+'_base]').val(parseFloat($('[name='+id+'_base]').val()) + nDelta);
  $('#'+id+'_inst').html(parseFloat($('#'+id+'_inst').html()) + nDelta);
  $('#skill').val(nm_UP -= nDelta);
  $('[name=skills_base]').val($('#skill').val());
  if (nDelta > 0)
    prefix = "minus_";
  else
  {
    prefix = "plus_";
    skillsArr[id] = 0;
    for (var i in skillsArr)
    {
      if (skillsArr[i] == 0)
        $('#plus_'+i).attr('class', 'skill');
    }
  }
  $('#'+prefix+id).attr('class', 'skill');
}

$(document).ready(function (){
  if (c = getCookie ('clevel'))
    clevel = c;
  else
    clevel = 'L5';
  setlevel (clevel);
  $('.tz').hover(
    function ()
    {
      if (clevel != $(this).attr('id'))
        $(this).addClass('tzOver');
    },
    function ()
    {
      if (clevel != $(this).attr('id'))
        $(this).removeClass('tzOver');
    }
  ).click(function (){
    setlevel ($(this).attr('id'));
  });
});
</script>
<?
$travm = $char_db['travm'];
$up_text = "";
if (isset($_POST['save_ability']) && $travm == 0 && $char_stats['ups'] != $_POST['ups_base'])
{
  foreach ($behaviour as $key => $min_level)
  {
    if (!isset($_POST[$key.'_base']) || $char_stats[$key] == $_POST[$key.'_base'] || $level < $min_level)
      continue;
    
    if ($equip -> increaseStat ($key, $_POST[$key.'_base'] - $char_stats[$key]))
      $up_text .= "&nbsp; &nbsp;Увеличение способности \"<b>$lang[$key]</b>\" произведено удачно<br>";
  }
  $adb -> query ("UPDATE `character_stats` SET `ups` = ?d WHERE `guid` = ?d", $_POST['ups_base'] , $guid);
}
else if (isset($_POST['save_skill']) && $travm == 0 && $char_stats['skills'] != $_POST['skills_base'])
{
  foreach ($mastery as $key => $min_level)
  {
    if (!isset($_POST[$key.'_base']) || $key == 'phisic' || $char_stats[$key] == $_POST[$key.'_base'] || $level < $min_level)
      continue;
    
    if ($adb -> query ("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key ,$_POST[$key.'_base'] ,$guid))
      $up_text .= "&nbsp; &nbsp;Увеличение способности \"<b>$lang[$key]</b>\" произведено удачно<br>";
  }
  $adb -> query ("UPDATE `character_stats` SET `skills` = ?d WHERE `guid` = ?d", $_POST['skills_base'] , $guid);
}

$equip -> showStatAddition ();

$char_stats = $equip -> getChar ('char_stats', '*');
$dis_buttons = "<td><img src='img/minus.gif' class='nonactive' title='уменьшить'>&nbsp;<img src='img/plus.gif' class='nonactive' title='увеличить'></td>";
?>
<img src="img/1x1.gif" width="1" height="5"><br>
<?
$up_format = "<font color='red'>%s</font>";
printf ($up_format, $up_text);
?>
<table width="100%">
  <tr>
    <td>&nbsp; &nbsp;<?echo $info -> character ($guid);?></td>
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
          <table cellSpacing="0">
          <form action="?action=skills" name="SaveAbilityPoints" method="post">
<?
            foreach ($behaviour as $key => $min_level)
            {
              if ($level < $min_level)
                continue;
              
              echo "<tr>";
              echo "<td>&bull; $lang[$key] </td>";
              echo "<td align='right'><input name='{$key}_base' type='text' readonly value='$char_stats[$key]' class='show'";
              echo (in_array($key, array('str', 'dex', 'con', 'int'))) ?" style='color: ".getStatSkillColor ($char_stats[$key], $added[$key]).";'" :"";
              echo " onFocus='this.blur();'></td>";
              echo (in_array($key, array('str', 'dex', 'con', 'int'))) ?"<td>".getBraces ($char_stats[$key], $added[$key], $key)."&nbsp;</td>" :"<td></td>";
              echo ($char_stats['ups'] > 0) ?"<td><img id='minus_$key' src='img/minus.gif' class='nonactive' onclick=\"MakeSkillStep (-1, '$key');\" title='уменьшить' />&nbsp;<img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"MakeSkillStep (1, '$key');\" title='увеличить' /></td>" :"";
              echo "</tr>";
            }
            echo "</table>";
            echo "<input name='save_ability' type='submit' value='сохранить' disabled id='save_button0' class='nonactive'><input type='checkbox' onClick='ChangeButtonState(0)' style='vertical-align: middle;'>";
            if ($char_stats['ups'] > 0)
              echo "<br>&nbsp;Возможных увеличений: <input name='ups_base' type='text' readonly value='$char_stats[ups]' class='show' style='font-weight: normal; text-align: left;' onFocus='this.blur();' id='up'>";
            if ($char_stats['skills'] > 0)
              echo "<br>&nbsp;Свободных умений: <input type='text' readonly value='$char_stats[skills]' class='show' style='font-weight: normal; text-align: left;' onFocus='this.blur();' id='skill'>";
?>
        </td>
      </tr>
    </form>
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
  $weapon = array('sword', 'fail', 'staff', 'knife', 'axe');
  $magic = array('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
  $dif = array();
?>
  <table>
  <form action="?action=skills" name="SaveAbilityPoints" method="post">
<?
  echo "<input name='skills_base' type='hidden' value='$char_stats[skills]'>";
  echo "<tr><td colspan='3'><b>$lang[weapon]</b></td></tr>";
  foreach ($weapon as $key)
  {
    $dif[$key] = $char_stats[$key] - $added[$key];
    echo "<tr>";
    echo "<td>&nbsp;&bull; $lang[$key]</td>";
    echo "<td width='40' class='skill' align='right'><input name='{$key}_base' type='text' readonly value='$char_stats[$key]' class='show' style='color: ".getStatSkillColor ($char_stats[$key], $added[$key]).";' onFocus='this.blur();' /></td>";
    echo "<td>".getBraces ($char_stats[$key], $added[$key], $key)."</td>";
    if ($char_stats['skills'] > 0 && $dif[$key] < 5)
      echo "<td><img id='minus_$key' src='img/minus.gif' class='nonactive' onclick=\"ChangeAbility('$key', -1, $dif[$key], 5)\" title='уменьшить' />&nbsp;<img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"ChangeAbility('$key', 1, $dif[$key], 5)\" title='увеличить' /></td>";
    else if ($char_stats['skills'] > 0 && $dif[$key] >= 5)
      echo $dis_buttons;
    echo "</tr>";
  }
if ($level >= 4)
{
  echo "<tr><td colspan='3'><b>$lang[magic]<b></td></tr>";
  foreach ($magic as $key)
  {
    $dif[$key] = $char_stats[$key] - $added[$key];
    echo "<tr>";
    echo "<td>&nbsp;&bull; $lang[$key]</td>";
    echo "<td class='skill' align='right'><input name='{$key}_base' type='text' readonly value='$char_stats[$key]' class='show' style='color: ".getStatSkillColor ($char_stats[$key], $added[$key]).";' onFocus='this.blur();' id='{$key}_base' \></td>";
    echo "<td>".getBraces ($char_stats[$key], $added[$key], $key)."</td>";
    if ($char_stats['skills'] > 0 && $dif[$key] < 10)
      echo "<td><img id='minus_$key' src='img/minus.gif' class='nonactive' onclick=\"ChangeAbility('$key', -1, $dif[$key], 10)\" title='уменьшить' />&nbsp;<img id='plus_$key' src='img/plus.gif' class='skill' onclick=\"ChangeAbility('$key', 1, $dif[$key], 10)\" title='увеличить' /></td>";
    else if ($char_stats['skills'] > 0 && $dif[$key] >= 10)
      echo $dis_buttons;
    echo "</tr>";
  }
}
  echo "<tr><td><input name='save_skill' type='submit' value='сохранить' disabled id='save_button1' class='nonactive'><input type='checkbox' onClick='ChangeButtonState(1)' style='vertical-align: middle;'></td></tr>";
?>
  </form>
  </table>
<?
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
Не реализовано!
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