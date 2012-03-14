<?
defined('AntiBK') or die("Доступ запрещен!");

class Char
{
  public $guid;
  public $db;
  public $test;
  public $equip;
  public $city;
  public $mail;
  public $bank;
  public $chat;
  public $info;
  public $history;
  public $error;
  function& initialization ($guid, $adb)
  {
    $object = new Char;
    $object->guid = $guid;
    $object->db = $adb;
    $classes = array('test', 'equip', 'city', 'mail', 'bank', 'chat', 'info', 'history', 'error');
    foreach ($classes as $class)
    {
      $object->{$class} = new $class;
    }
    foreach ($classes as $class)
    {
      $object->{$class}->Init($object);
    }
    return $object;
  }
  /*Получение информации о персонаже*/
  function getChar ()
  {
    $args = func_get_args();
    $args_num = func_num_args();
    
    if (is_numeric($args[$args_num-1]))
    {
      $guid = $args[$args_num-1];
      unset($args[$args_num-1]);
    }
    else
      $guid = $this->guid;
    
    switch ($args[0])
    {
      case 'char_db':    $table = 'characters';      break;
      case 'char_stats': $table = 'character_stats'; break;
      case 'char_info':  $table = 'character_info';  break;
      case 'char_equip': $table = 'character_equip'; break;
      case 'char_bars':  $table = 'character_bars';  break;
    }
    
    unset($args[0]);
    
    if ($args[1] == '*')
      return $this->db->selectRow("SELECT * FROM ?# WHERE `guid` = ?d", $table ,$guid);
    else if ($args_num == 2 || ($args_num == 3 && $guid != $this->guid))
      return $this->db->selectCell("SELECT ?# FROM ?# WHERE `guid` = ?d", $args ,$table ,$guid);
    else
      return $this->db->selectRow("SELECT ?# FROM ?# WHERE `guid` = ?d", $args ,$table ,$guid);
  }
  /*Получение информации о языке*/
  function getLang ()
  {
    return $this->db->selectCol("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");
  }
  /*Увеличение/уменьшение характеристики*/
  function changeStats ()
  {
    $stats = func_get_args();
    $a_num = func_num_args();
    $stats = ($a_num == 1 && is_array($stats[0])) ?$stats[0] :array($stats[0] => $stats[1]);
    foreach ($stats as $stat => $count)
    {
      switch ($stat)
      {
        case 'str':
          $this->db->query("UPDATE `character_stats` 
                            SET `str` = `str` + ?d, 
                                `hitmin` = `hitmin` + ?d, 
                                `hitmax` = `hitmax` + ?d 
                            WHERE `guid` = ?d", $count ,$count ,$count ,$this->guid);
          $this->statsBonus($stat);
        break;
        case 'dex':
          $mf_dodge = $count * 7;
          $mf_adodge = $count * 3;
          $this->db->query("UPDATE `character_stats` 
                            SET `dex` = `dex` + ?d, 
                                `mf_dodge` = `mf_dodge` + ?d, 
                                `mf_adodge` = `mf_adodge` + ?d 
                            WHERE `guid` = ?d", $count ,$mf_dodge ,$mf_adodge ,$this->guid);
          $this->statsBonus($stat);
        break;
        case 'con':
          $mf_crit = $count * 7;
          $mf_acrit = $count * 3;
          $this->db->query("UPDATE `character_stats` 
                            SET `con` = `con` + ?d, 
                                `mf_crit` = `mf_crit` + ?d, 
                                `mf_acrit` = `mf_acrit` + ?d 
                            WHERE `guid` = ?d", $count ,$mf_crit ,$mf_acrit ,$this->guid);
          $this->statsBonus($stat);
        break;
        case 'vit':
          $hp = $count * 6;
          $bron = $count * 1.5;
          $this->db->query("UPDATE `character_stats` 
                            SET `vit` = `vit` + ?d, 
                                `hp` = `hp` + ?d, 
                                `hp_all` = `hp_all` + ?d, 
                                `maxmass` = `maxmass` + ?d, 
                                `res_sting` = `res_sting` + ?f, 
                                `res_slash` = `res_slash` + ?f, 
                                `res_crush` = `res_crush` + ?f, 
                                `res_sharp` = `res_sharp` + ?f, 
                                `res_fire` = `res_fire` + ?f, 
                                `res_water` = `res_water` + ?f, 
                                `res_air` = `res_air` + ?f, 
                                `res_earth` = `res_earth` + ?f, 
                                `res_light` = `res_light` + ?f, 
                                `res_gray` = `res_gray` + ?f, 
                                `res_dark` = `res_dark` + ?f 
                            WHERE `guid` = ?d", $count ,$hp ,$hp ,$count ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$this->guid);
          $this->statsBonus($stat);
        break;
        case 'int':
          $mf = $count * 0.5;
          $this->db->query("UPDATE `character_stats` 
                            SET `int` = `int` + ?d, 
                                `mf_fire` = `mf_fire` + ?f, 
                                `mf_water` = `mf_water` + ?f, 
                                `mf_air` = `mf_air` + ?f, 
                                `mf_earth` = `mf_earth` + ?f, 
                                `mf_light` = `mf_light` + ?f, 
                                `mf_gray` = `mf_gray` + ?f, 
                                `mf_dark` = `mf_dark` + ?f 
                            WHERE `guid` = ?d", $count ,$mf ,$mf ,$mf ,$mf ,$mf ,$mf ,$mf ,$this->guid);
          $this->statsBonus($stat);
        break;
        case 'wis':
          $mp = $count * 10;
          $this->db->query("UPDATE `character_stats` 
                            SET `wis` = `wis` + ?d, 
                                `mp` = `mp` + ?d, 
                                `mp_all` = `mp_all` + ?d 
                            WHERE `guid` = ?d", $count ,$mp ,$mp ,$this->guid);
          $this->statsBonus($stat);
        break;
        case 'spi':
          $this->db->query("UPDATE `character_stats` 
                            SET `spi` = `spi` + ?d 
                            WHERE `guid` = ?d", $count ,$this->guid);
        break;
        default:
          return false;
      }
    }
    return true;
  }
  /*Увеличение/уменьшение кол-ва денег у персонажа*/
  function changeMoney ($sum, $type = '', $guid = 0)
  {
    if (!is_numeric($sum))
      return false;
    
    $sum = round ($sum, 2);
    
    if ($sum == 0)
      return false;
    
    $guid = (!$guid) ?$this->guid :$guid;
    switch ($type)
    {
      case 'euro':
        $money_euro = $this->getChar('char_db', 'money_euro');

        if (($money_euro = $money_euro + $sum) < 0)
          return false;
        
        $this->db->query("UPDATE `characters` SET `money_euro` = ?f WHERE `guid` = ?d", $money_euro ,$guid);
      break;
      default:
        $money = $this->getChar('char_db', 'money');

        if (($money = $money + $sum) < 0)
          return false;
        
        $this->db->query("UPDATE `characters` SET `money` = ?f WHERE `guid` = ?d", $money ,$guid);
      break;
    }
    return true;
  }
  /*Увеличение/уменьшение переносимой массы персонажем*/
  function changeMass ($mass, $guid = 0)
  {
    if (!is_numeric($mass) || $mass == 0)
      return false;
    
    $guid = (!$guid) ?$this->guid :$guid;
    $this->db->query("UPDATE `character_stats` SET `mass` = `mass` + ?f WHERE `guid` = ?d", $mass ,$guid);
    return true;
  }
  /*Время востановления здоровья*/
  function setTimeToHPMP ($now, $all, $regen, $type)
  {
    if ($now > $all)
      $this->db->query("UPDATE `character_stats` SET ?# = ?d, ?# = '0' WHERE `guid` = ?d", $type ,$all ,$type.'_cure' ,$this->guid);
    else
    {
      getCureValue($now, $all, $regen, $cure);
      $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $type.'_cure' ,$cure ,$this->guid);
    }
  }
  /*Отображение дополнительной характеристики*/
  function showStatAddition ($type = 'skills')
  {
    global $added;
    $added = array('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0, 'sword' => 0, 'bow' => 0, 'crossbow' => 0, 'axe' => 0, 'fail' => 0, 'knife' => 0, 'staff' => 0, 'fire' => 0, 'water' => 0, 'air' => 0, 'earth' => 0, 'light' => 0, 'gray' => 0, 'dark' => 0);
    $rows = $this->db->select("SELECT `i`.`add_str`, `c`.`inc_str`, 
                                      `i`.`add_dex`, `c`.`inc_dex`, 
                                      `i`.`add_con`, `c`.`inc_con`, 
                                      `i`.`add_int`, `c`.`inc_int`, 
                                      `i`.`all_mastery`, 
                                      `i`.`sword`, `i`.`axe`, 
                                      `i`.`bow`, `i`.`crossbow`,
                                      `i`.`fail`, `i`.`knife`, 
                                      `i`.`staff`, 
                                      `i`.`all_magic`, 
                                      `i`.`fire`, `i`.`water`, 
                                      `i`.`air`, `i`.`earth`, 
                                      `i`.`light`, `i`.`gray`, 
                                      `i`.`dark` 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_entry` = `i`.`entry` 
                               WHERE `c`.`guid` = ?d 
                                 and `c`.`wear` = '1'", $this->guid);
    foreach ($rows as $dat)
    {
      $added['str'] += $dat['add_str'] + $dat['inc_str'];
      $added['dex'] += $dat['add_dex'] + $dat['inc_dex'];
      $added['con'] += $dat['add_con'] + $dat['inc_con'];
      $added['int'] += $dat['add_int'] + $dat['inc_int'];
    }
    
    if ($type != 'skills')
      return;
    
    foreach ($rows as $dat)
    {
      $added['sword'] += $dat['sword'] + $dat['all_mastery'];
      $added['bow'] += $dat['bow'] + $dat['all_mastery'];
      $added['crossbow'] += $dat['crossbow'] + $dat['all_mastery'];
      $added['axe'] += $dat['axe'] + $dat['all_mastery'];
      $added['fail'] += $dat['fail'] + $dat['all_mastery'];
      $added['knife'] += $dat['knife'] + $dat['all_mastery'];
      $added['staff'] += $dat['staff'];
      $added['fire'] += $dat['fire'] + $dat['all_magic'];
      $added['water'] += $dat['water'] + $dat['all_magic'];
      $added['air'] += $dat['air'] + $dat['all_magic'];
      $added['earth'] += $dat['earth'] + $dat['all_magic'];
      $added['light'] += $dat['light'];
      $added['gray'] += $dat['gray'];
      $added['dark'] += $dat['dark'];
    }
  }
  /*Проверка доступности образа*/
  function checkShape ($id)
  {
    $shape = $this->db->selectRow("SELECT * FROM `player_shapes` WHERE `id` = ?d", $id);
    if (!$shape)
      return false;
    
    $char_db = $this->getChar('char_db', 'level', 'sex', 'next_shape');
    $char_stats = $this->getChar('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'sword', 'axe', 'fail', 'knife', 'fire', 'water', 'air', 'earth', 'light', 'dark');
    $char_feat = array_merge ($char_db, $char_stats);
    $sex = ($char_feat['sex'] == "male") ?"m" :"f";
    
    if ($char_feat['next_shape'] && $char_feat['next_shape'] > time())
      $this->error->Inventory(111, getFormatedTime($char_feat['next_shape']));
    
    if ($shape['sex'] != $sex)
      return false;
    
    unset ($char_feat['sex'], $char_feat['next_shape']);
    foreach ($char_feat as $key => $value)
    {
      if ($shape[$key] > 0 && $shape[$key] > $value)
        return false;
    }
    return true;
  }
  /*Отображение модуля инвентаря*/
  function showInventoryBar ($bar, $value, $max_num)
  {
    global $behaviour;
    $flag = explode ('|', $value);
    $lang = $this->getLang();
    $char_stats = $this->getChar('char_stats', '*');
    $char_equip = $this->getChar('char_equip', 'hand_r', 'hand_l', 'hand_r', 'hand_r_type', 'hand_l_type');
    list ($hand_r, $hand_l, $hand_r_type, $hand_l_type) = array_values($char_equip);
    $content = '';
    $link_text = '';
    $link = '';
    $flags = ($flag[1]) ?1 :0;
    $flags += ($flag[0] > 1) ?2 :0;
    $flags += ($flag[0] < $max_num) ?4 :0;
    switch ($bar)
    {
      default:
      case 'stat':       /*Характеристики*/
        $level = $this->db->selectCell("SELECT `level` FROM `characters` WHERE `guid` = ?d", $this->guid);
        foreach ($behaviour as $key => $min_level)
          $content .= ($level >= $min_level) ?"$lang[$key] <b>$char_stats[$key]</b><br>" :"";
        $content .= ($char_stats['ups'] > 0) ?"<a class='nick' href='?action=skills'><b><small>+ $lang[ups]</small></b></a> " :"";
        $content .= ($char_stats['skills'] > 0) ?"&bull; <a class='nick' href='?action=skills'><b><small> $lang[skills]</small></b></a>" :"";
      break;
      case 'mod':        /*Модификаторы*/
        $hitmin = $char_stats['hitmin'];
        $hitmax = $char_stats['hitmax'];
        $hand_r_hitmin = $char_stats['hand_r_hitmin'];
        $hand_l_hitmin = $char_stats['hand_l_hitmin'];
        $hand_r_hitmax = $char_stats['hand_r_hitmax'];
        $hand_l_hitmax = $char_stats['hand_l_hitmax'];
        $hand_r_critp = $char_stats['hand_r_critp'];
        $hand_l_critp = $char_stats['hand_l_critp'];
        $hand_r_crit = $char_stats['hand_r_crit'];
        $hand_l_crit = $char_stats['hand_l_crit'];
        $hand_r_adodge = $char_stats['hand_r_adodge'];
        $hand_l_adodge = $char_stats['hand_l_adodge'];
        $mf_critp = $char_stats['mf_critp'];
        $mf_crit = $char_stats['mf_crit'];
        $mf_dodge = $char_stats['mf_dodge'];
        $mf_acrit = $char_stats['mf_acrit'];
        $mf_adodge = $char_stats['mf_adodge'];
        $mf_contr = $char_stats['mf_contr'];
        $mf_parry = $char_stats['mf_parry'];
        $mf_shieldb = $char_stats['mf_shieldb'];
        $hand_status_r = $this->equip->checkHandStatus('r');
        $hand_status_l = $this->equip->checkHandStatus('l');
        $show_r_udar = ($hand_status_r) ?($hand_r_hitmin + $hitmin + $char_stats[$hand_r_type])."-".($hand_r_hitmax + $hitmax + $char_stats[$hand_r_type]) :"";
        $show_l_udar = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_hitmin + $hitmin + $char_stats[$hand_l_type])."-".($hand_l_hitmax + $hitmax + $char_stats[$hand_l_type]) :"";
        $show_r_cpower = ($hand_status_r) ?$hand_r_critp + $mf_critp :"";
        $show_l_cpower = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_critp + $mf_critp) :"";
        $show_r_crit = ($hand_status_r) ?$hand_r_crit + $mf_crit :"";
        $show_l_crit = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_crit + $mf_crit) :"";
        $show_r_adodge = ($hand_status_r) ?$hand_r_adodge + $mf_adodge :"";
        $show_l_adodge = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_adodge + $mf_adodge) :"";
        $show_r_mastery = ($hand_status_r) ?$char_stats[$hand_r_type] + $char_stats['hand_r_'.$hand_r_type] :"";
        $show_l_mastery = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($char_stats[$hand_l_type] + $char_stats['hand_l_'.$hand_r_type]) :"";
        $content .= "$lang[damage] $show_r_udar$show_l_udar<br>"
                  . "<span alt='$lang[mf_crit_m]'>$lang[mf_crit_i] $show_r_crit$show_l_crit</span><br>";
        $content .= ($hand_r_critp != 0 || $hand_l_critp != 0 || $mf_critp != 0) ?"<span alt='$lang[mf_critp_m]'>$lang[mf_critp_i] $show_r_cpower$show_l_cpower</span><br>" :"";
        $content .= "<span alt='$lang[mf_acrit_m]'>$lang[mf_acrit_i] $mf_acrit</span><br>"
                  . "<span alt='$lang[mf_dodge_m]'>$lang[mf_dodge_i] $mf_dodge</span><br>"
                  . "<span alt='$lang[mf_adodge_m]'>$lang[mf_adodge_i] $show_r_adodge$show_l_adodge</span><br>"
                  . "<span alt='$lang[mf_contr_m]'>$lang[mf_contr_i] $mf_contr</span><br>"
                  . "<span alt='$lang[mf_parry_m]'>$lang[mf_parry_i] $mf_parry</span><br>"
                  . "<span alt='$lang[mf_shieldb_m]'>$lang[mf_shieldb_i] $mf_shieldb</span><br>";
        $content .= ($hand_r != 0 || $hand_l != 0) ?"<span alt='$lang[mastery_m]'>$lang[mastery] $show_r_mastery$show_l_mastery</span><br>" :"";
      break;
      case 'power':      /*Мощность*/
        $mf_damage = array ('sting', 'slash', 'crush', 'sharp');
        $mf_magic = array ('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
        foreach ($mf_damage as $key)
        {
          $show_r[$key] = ($this->equip->checkHandStatus('r')) ?$char_stats['hand_r_'.$key] + $char_stats['mf_'.$key] :"";
          $show_l[$key] = ($this->equip->checkHandStatus('l')) ?(($hand_r != 0) ?"% / +" :"").($char_stats['hand_l_'.$key] + $char_stats['mf_'.$key]) :"";
        }
        foreach ($mf_damage as $key)
          $content .= ($char_stats['mf_'.$key] != 0 || $char_stats['hand_r_'.$key] != 0 || $char_stats['hand_l_'.$key] != 0) ?"<span alt='".$lang[$key.'_p']."'>".$lang[$key.'_i']." +$show_r[$key]$show_l[$key]%</span><br>" :"";
        foreach ($mf_magic as $key)
          $content .= ($char_stats['mf_'.$key] != 0) ?"<span alt='".$lang[$key.'_p']."'>".$lang[$key.'_i']." +".$char_stats['mf_'.$key]."%</span><br>" :"";
      break;
      case 'def':        /*Защита*/
        $ress = array ('sting', 'slash', 'crush', 'sharp', 'fire', 'water', 'air', 'earth', 'light', 'dark', 'gray');
        foreach ($ress as $key)
          $content .= "<span alt='".$lang[$key.'_d']."'>".$lang[$key.'_i']." ".$char_stats['res_'.$key]."</span><br>";
      break;
      case 'btn':        /*Кнопки*/
        $content .= "&nbsp;<input type='button' value='$lang[unwear_all]' class='btn' id='link' link='unwear_full' style='font-weight: bold;'><br>";
      break;
      case 'set':        /*Комплекты*/
        $sets = $this->db->select("SELECT * FROM `character_sets` WHERE `guid` = ?d", $this->guid);
        $link_text = "запомнить";
        $link = "javascript:kmp();";
        $content .= "<div id='allsets'>";
        foreach ($sets as $set)
          $content .= $this->getSetRow($set['name']);
        $content .= "</div>";
      break;
    }
    $return = "<table width='100%' border='0' cellspacing='0' cellpadding='1' background='img/back.gif'><tr><td valign='middle'>";
    if ($flags & 1)
      $return .= "<img id='spoiler_$bar' width='11' height='9' alt='Скрыть' border='0' src='img/minus.gif' style='cursor: pointer;' onclick=\"javascript:spoilerBar('$bar');\" />";
    else
      $return .= "<img id='spoiler_$bar' width='11' height='9' alt='Показать' border='0' src='img/plus.gif' style='cursor: pointer;' onclick=\"javascript:spoilerBar('$bar');\" />";
    $return .= "</td>";
    $return .= "<td>&nbsp;</td><td bgcolor='#e2e0e0'><small>&nbsp;<b>".$lang['bar_'.$bar]."<b>&nbsp;</small></td>";
    if ($link_text)
      $return .= "<td>&nbsp;</td><td bgcolor='#e2e0e0'>&nbsp;<a href='$link' class='nick'><small>$link_text</small></a>&nbsp;</td>";
    $return .= "<td align='right' valign='middle' width='100%'>";
    if ($flags & 2)
      $return .= "<img border='0' width='11' height='9' alt='Поднять блок наверх' src='img/up.gif' style='cursor: pointer;' onclick=\"javascript:switchBars('up', '$bar');\" />";
    else
      $return .= "<img border='0' width='11' height='9' src='img/up-grey.gif'>";
    if ($flags & 4)
      $return .= "<img border='0' width='11' height='9' alt='Опустить блок вниз' src='img/down.gif' style='cursor: pointer;' onclick=\"javascript:switchBars('down', '$bar');\" />";
    else
      $return .= "<img border='0' width='11' height='9' src='img/down-grey.gif'>";
    $return .= "</td>";
    $return .= "</tr></table>";
    $style = ($flags & 1) ?"" :" style='display: none;'";
    $return .= "<div id='{$bar}c'$style><small>$content</small></div>";
    return $return;
  }
  /*Получение строки комплекта*/
  function getSetRow ($name)
  {
    $lang = $this->getLang();
    return "<div name='$name'><img width='200' height='1' src='img/1x1.gif'><br>&nbsp;&nbsp;<img src='img/icon/inf2.gif' width='10' height='10' alt='Просмотр' onclick=\"workSets ('show', '$name');\" style='cursor: pointer;'><img src='img/icon/close2.gif' width='9' height='9' alt='$lang[set_delete]' onclick=\"if (confirm('$lang[set_delete] $name?')) {workSets ('delete', '$name');}\" style='cursor: pointer;'> <a href='main.php?action=wear_set&set_name=$name' class='nick'><small>$lang[equip] \"$name\"</small></a></div>";
  }
  /*Добавление/Обновление/Удаление эффекта*/
  function workEffect ($effect, $type = 1)
  {
    if (!$effect || $effect == 0 || !is_numeric($effect))
      return;
    
    $char_eff = $this->db->selectCell("SELECT `guid` FROM `character_effects` WHERE `effect_entry` = ?d and `guid` = ?d", $effect ,$this->guid);
    
    if ((($type == -1 || $type == 0) && !$char_eff) || ($type == 1 && $char_eff))
      return;
    
    $e_info = $this->db->selectRow("SELECT * FROM `effect_template` WHERE `entry` = ?d", $effect);
    
    $char_e = $this->db->selectCell("SELECT `c`.`effect_entry` 
                                     FROM `character_effects` AS `c` 
                                     LEFT JOIN `effect_template` AS `i` 
                                     ON `c`.`effect_entry` = `i`.`entry` 
                                     WHERE `c`.`guid` = ?d 
                                       and `i`.`set` = ?s", $this->guid ,$e_info['set']);
    
    if ($char_e && $char_e != $effect)
      $this->workEffect($char_e, -1);
    
    if ($type == 0)
    {
      if ($char_eff)
      {
        $this->db->query("UPDATE `character_effects` SET `end_time` = ?d WHERE `guid` = ?d", (time() + $e_info['duration']) ,$this->guid);
        return;
      }
      else
        $type = 1;
    }
    
    $char_stats = $this->getChar('char_stats', '*', $this->guid);
    
    $new_sql = array();
    $new_sql['res_sting'] = $e_info['res_dmg'];
    $new_sql['res_slash'] = $e_info['res_dmg'];
    $new_sql['res_crush'] = $e_info['res_dmg'];
    $new_sql['res_sharp'] = $e_info['res_dmg'];
    $new_sql['res_fire'] = $e_info['res_magic'];
    $new_sql['res_water'] = $e_info['res_magic'];
    $new_sql['res_air'] = $e_info['res_magic'];
    $new_sql['res_earth'] = $e_info['res_magic'];
    $new_sql['res_light'] = $e_info['res_magic'];
    $new_sql['res_gray'] = $e_info['res_magic'];
    $new_sql['res_dark'] = $e_info['res_magic'];
    $new_sql['mf_sting'] = $e_info['mf_dmg'];
    $new_sql['mf_slash'] = $e_info['mf_dmg'];
    $new_sql['mf_crush'] = $e_info['mf_dmg'];
    $new_sql['mf_sharp'] = $e_info['mf_dmg'];
    $new_sql['mf_fire'] = $e_info['mf_magic'];
    $new_sql['mf_water'] = $e_info['mf_magic'];
    $new_sql['mf_air'] = $e_info['mf_magic'];
    $new_sql['mf_earth'] = $e_info['mf_magic'];
    $new_sql['mf_critp'] = $e_info['mf_critp'];
    $new_sql['mf_adodge'] = $e_info['mf_adodge'];
    $new_sql['mf_acrit'] = $e_info['mf_acrit'];
    $new_sql['mf_dodge'] = $e_info['mf_dodge'];
    $new_sql['hitmin'] = $e_info['add_hit_min'];
    $new_sql['hitmax'] = $e_info['add_hit_max'];
    $new_sql['mp_regen'] = $e_info['mpreco'];
    $new_sql['hp_all'] = $e_info['add_hp'];
    $new_sql['mp_all'] = $e_info['add_mp'];
    
    foreach ($new_sql as $key => $value)
    {
      $new_sql[$key] = $value*$type;
      $new_sql[$key] += $char_stats[$key];
    }
    
    $char_hpmp = $this->getChar('char_stats', 'hp', 'mp', $this->guid);
    foreach ($char_hpmp as $key => $value)
    {
      if ($e_info['add_'.$key] != 0)
        $this->setTimeToHPMP($value, $new_sql[$key.'_all'], $char_stats[$key.'_regen'], $key);
    }
    
    if ($type == 1)
    {
      $time = ($e_info['duration'] == 0) ?0 :time() + $e_info['duration'];
      $this->db->query("INSERT INTO `character_effects` (`guid`, `effect_entry`, `end_time`) 
                        VALUES (?d, ?d, ?d)", $this->guid ,$effect ,$time);
    }
    else if ($type == -1)
      $this->db->query("DELETE FROM `character_effects` WHERE `guid` = ?d and `effect_entry` = ?d", $this->guid ,$effect);
    $this->db->query("UPDATE `character_stats` SET ?a WHERE `guid` = ?d", $new_sql ,$this->guid);
  }
  /*Бонусные эффекты от статов*/
  function statsBonus ($stat)
  {
    $stat_value = $this->getChar('char_stats', $stat);
    
    if ($stat_value < 25)
      return;
    
    if ($stat_value >= 25 && $stat_value < 50)        $power = 1;
    else if ($stat_value >= 50 && $stat_value < 75)   $power = 2;
    else if ($stat_value >= 75 && $stat_value < 100)  $power = 3;
    else if ($stat_value >= 100 && $stat_value < 125) $power = 4;
    else if ($stat_value >= 125 && $stat_value < 150) $power = 5;
    else if ($stat_value >= 150)                      $power = 6;
    
    $entry = $this->db->selectCell("SELECT `entry` FROM `effect_template` WHERE `set` = ?s and `power` = ?d", $stat ,$power);
    $this->workEffect($entry, 1);
  }
}
?>