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
  public $history;
  public $error;
  function& initialization ($guid, $adb)
  {
    $object = new Char;
    $object->guid = $guid;
    $object->db = $adb;
    $classes = array('test', 'equip', 'city', 'mail', 'bank', 'chat', 'history', 'error');
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
    $a_num = func_num_args();
    $m_guid = (isset($args[2])) ?$args[2] :"-";
    
    if (is_numeric($args[$a_num-1]))
    {
      $guid = $args[$a_num-1];
      unset($args[$a_num-1]);
    }
    else
      $guid = $this->guid;
    
    $table = getTable($args[0]);
    unset($args[0]);
    
    if ($args[1] == '*')
      return $this->db->selectRow("SELECT * FROM ?# WHERE `guid` = ?d", $table ,$guid);
    else if ($a_num == 2 || ($a_num == 3 && is_numeric($m_guid)))
      return $this->db->selectCell("SELECT ?# FROM ?# WHERE `guid` = ?d", $args ,$table ,$guid);
    else
      return $this->db->selectRow("SELECT ?# FROM ?# WHERE `guid` = ?d", $args ,$table ,$guid);
  }
  /*Обновление информации о персонаже*/
  function setChar ()
  {
    $args = func_get_args();
    $a_num = func_num_args();
    
    if (is_numeric($args[$a_num-1]))
    {
      $guid = $args[$a_num-1];
      unset($args[$a_num-1]);
    }
    else
      $guid = $this->guid;
    
    $table = getTable($args[0]);
    unset($args[0]);
    
    if ($a_num == 4 || ($a_num == 3 && !is_array($args[1])))
      return $this->db->query("UPDATE ?# SET ?# = ? WHERE `guid` = ?d", $table ,$args[1] ,$args[2] ,$guid);
    else
      return $this->db->query("UPDATE ?# SET ?a WHERE `guid` = ?d", $table ,$args[1] ,$guid);
  }
  /*Получение информации о языке*/
  function getLang ()
  {
    $lang = $this->db->selectCell("SELECT `language` FROM `server_info`;");
    return $this->db->selectCol("SELECT `key` AS ARRAY_KEY, ?# FROM `server_language`;", $lang);
  }
  /*Увеличение/уменьшение характеристики*/
  function changeStats ()
  {
    $stats = func_get_args();
    $a_num = func_num_args();
    
    if (is_numeric($stats[$a_num-1]))
    {
      $guid = $stats[$a_num-1];
      unset($stats[$a_num-1]);
    }
    else
      $guid = $this->guid;
    
    $stats = (is_array($stats[0])) ?$stats[0] :array($stats[0] => $stats[1]);
    foreach ($stats as $stat => $count)
    {
      switch ($stat)
      {
        case 'str':
          $this->db->query("UPDATE `character_stats` 
                            SET `str` = `str` + ?d, 
                                `hitmin` = `hitmin` + ?d, 
                                `hitmax` = `hitmax` + ?d 
                            WHERE `guid` = ?d", $count ,$count ,$count ,$guid);
          $this->statsBonus($stat);
        break;
        case 'dex':
          $mf_dodge = $count * 7;
          $mf_adodge = $count * 3;
          $this->db->query("UPDATE `character_stats` 
                            SET `dex` = `dex` + ?d, 
                                `mf_dodge` = `mf_dodge` + ?d, 
                                `mf_adodge` = `mf_adodge` + ?d 
                            WHERE `guid` = ?d", $count ,$mf_dodge ,$mf_adodge ,$guid);
          $this->statsBonus($stat);
        break;
        case 'con':
          $mf_crit = $count * 7;
          $mf_acrit = $count * 3;
          $this->db->query("UPDATE `character_stats` 
                            SET `con` = `con` + ?d, 
                                `mf_crit` = `mf_crit` + ?d, 
                                `mf_acrit` = `mf_acrit` + ?d 
                            WHERE `guid` = ?d", $count ,$mf_crit ,$mf_acrit ,$guid);
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
                            WHERE `guid` = ?d", $count ,$hp ,$hp ,$count ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$guid);
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
                            WHERE `guid` = ?d", $count ,$mf ,$mf ,$mf ,$mf ,$mf ,$mf ,$mf ,$guid);
          $this->statsBonus($stat);
        break;
        case 'wis':
          $mp = $count * 10;
          $this->db->query("UPDATE `character_stats` 
                            SET `wis` = `wis` + ?d, 
                                `mp` = `mp` + ?d, 
                                `mp_all` = `mp_all` + ?d 
                            WHERE `guid` = ?d", $count ,$mp ,$mp ,$guid);
          $this->statsBonus($stat);
        break;
        case 'spi':
          $this->db->query("UPDATE `character_stats` 
                            SET `spi` = `spi` + ?d 
                            WHERE `guid` = ?d", $count ,$guid);
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
    
    $sum = round($sum, 2);
    
    if ($sum == 0)
      return false;
    
    $guid = $this->getGuid($guid);
    switch ($type)
    {
      case 'euro':
        $money_euro = $this->getChar('char_db', 'money_euro');

        if (($money_euro = $money_euro + $sum) < 0)
          return false;
        
        $this->setChar('char_db', array('money_euro' => $money_euro), $guid);
      break;
      default:
        $money = $this->getChar('char_db', 'money');

        if (($money = $money + $sum) < 0)
          return false;
        
        $this->setChar('char_db', array('money' => $money), $guid);
      break;
    }
    return true;
  }
  /*Увеличение/уменьшение переносимой массы персонажем*/
  function changeMass ($mass, $guid = 0)
  {
    if (checki($mass))
      return false;
    
    $guid = $this->getGuid($guid);
    $this->db->query("UPDATE `character_stats` SET `mass` = `mass` + ?f WHERE `guid` = ?d", $mass ,$guid);
    return true;
  }
  /*Время востановления здоровья*/
  function setTimeToHPMP ($now, $all, $regen, $type, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    if ($now > $all)
      $this->setChar('char_stats', array($type => $all, $type.'_cure' => 0), $guid);
    else
    {
      getCureValue($now, $all, $regen, $cure);
      $this->setChar('char_stats', $type.'_cure', $cure, $guid);
    }
  }
  /*Отображение дополнительной характеристики*/
  function showStatAddition ($type = 'skills')
  {
    global $added;
    $added = array('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0, 'sword' => 0, 'bow' => 0, 'crossbow' => 0, 'axe' => 0, 'fail' => 0, 'knife' => 0, 'staff' => 0, 'fire' => 0, 'water' => 0, 'air' => 0, 'earth' => 0, 'light' => 0, 'gray' => 0, 'dark' => 0);
    $items = $this->db->select("SELECT `i`.`add_str`, `c`.`inc_str`, 
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
                                  and `c`.`wear` = '1';", $this->guid);
    foreach ($items as $dat)
    {
      $added['str'] += $dat['add_str'] + $dat['inc_str'];
      $added['dex'] += $dat['add_dex'] + $dat['inc_dex'];
      $added['con'] += $dat['add_con'] + $dat['inc_con'];
      $added['int'] += $dat['add_int'] + $dat['inc_int'];
    }
    
    $travms = $this->db->select("SELECT `stats` FROM `character_travms` WHERE `guid` = ?d and `stats` != '';", $this->guid);
    foreach ($travms as $travm)
    {
      $stats = split(",", $travm['stats']);
      foreach ($stats as $stat)
      {
        $stat = split("=", $stat);
        
        if (array_key_exists($stat[0], $added))
          $added[$stat[0]] += -$stat[1];
      }
    }
    
    if ($type != 'skills')
      return;
    
    foreach ($items as $dat)
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
    $char_feat = array_merge($char_db, $char_stats);
    $sex = ($char_feat['sex'] == "male") ?"m" :"f";
    
    if ($char_feat['next_shape'] && $char_feat['next_shape'] > time())
      $this->error->Inventory(111, getFormatedTime($char_feat['next_shape']));
    
    if ($shape['sex'] != $sex)
      return false;
    
    unset($char_feat['sex'], $char_feat['next_shape']);
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
    $flag = explode('|', $value);
    $lang = $this->getLang();
    $char_stats = $this->getChar('char_stats', '*');
    $char_equip = $this->getChar('char_equip', 'hand_r', 'hand_l', 'hand_r', 'hand_r_type', 'hand_l_type');
    list($hand_r, $hand_l, $hand_r_type, $hand_l_type) = array_values($char_equip);
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
        $mf_damage = array('sting', 'slash', 'crush', 'sharp');
        $mf_magic = array('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
        foreach ($mf_damage as $key)
        {
          $plus_r = $char_stats['hand_r_'.$key] + $char_stats['mf_'.$key];
          $plus_l = $char_stats['hand_l_'.$key] + $char_stats['mf_'.$key];
          $show_r[$key] = ($this->equip->checkHandStatus('r')) ?(($plus_r > 0) ?'+' :'')."$plus_r" :"";
          $show_l[$key] = ($this->equip->checkHandStatus('l')) ?(($hand_r != 0) ?"% / ".(($plus_l > 0) ?'+' :'') :"").$plus_l :"";
        }
        foreach ($mf_damage as $key)
          $content .= ($char_stats['mf_'.$key] != 0 || $char_stats['hand_r_'.$key] != 0 || $char_stats['hand_l_'.$key] != 0) ?"<span alt='".$lang[$key.'_p']."'>".$lang[$key.'_i']." $show_r[$key]$show_l[$key]%</span><br>" :"";
        foreach ($mf_magic as $key)
          $content .= ($char_stats['mf_'.$key] != 0) ?"<span alt='".$lang[$key.'_p']."'>".$lang[$key.'_i']." ".(($char_stats['mf_'.$key] > 0) ?'+' :'')."".$char_stats['mf_'.$key]."%</span><br>" :"";
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
    return "<div name='".str_replace(" ", "_", $name)."'><img width='200' height='1' src='img/1x1.gif'><br>&nbsp;&nbsp;<img src='img/icon/inf2.gif' width='10' height='10' alt='Просмотр' onclick=\"workSets('show', '$name');\" style='cursor: pointer;'><img src='img/icon/close2.gif' width='9' height='9' alt='$lang[set_delete]' onclick=\"if (confirm('$lang[set_delete] $name?')) {workSets('delete', '$name');}\" style='cursor: pointer;'> <a href='main.php?action=wear_set&set_name=$name' class='nick'><small>$lang[equip] \"$name\"</small></a></div>";
  }
  /*Добавление/Обновление/Удаление эффекта*/
  function workEffect ($effect, $type = 1, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    
    if (checki($effect))
      return;
    
    $char_eff = $this->db->selectCell("SELECT `guid` FROM `character_effects` WHERE `effect_id` = ?d and `guid` = ?d", $effect ,$guid);
    
    if ((($type == -1 || $type == 0) && !$char_eff) || ($type == 1 && $char_eff))
      return;
    
    $e_info = $this->db->selectRow("SELECT * FROM `player_effects` WHERE `id` = ?d", $effect);
    
    $char_e = $this->db->selectCell("SELECT `c`.`effect_id` 
                                     FROM `character_effects` AS `c` 
                                     LEFT JOIN `player_effects` AS `i` 
                                     ON `c`.`effect_id` = `i`.`id` 
                                     WHERE `c`.`guid` = ?d 
                                       and `i`.`set` = ?s", $guid ,$e_info['set']);
    
    if ($char_e && $char_e != $effect)
      $this->workEffect($char_e, -1);
    
    if ($type == 0)
    {
      if ($char_eff)
      {
        $this->db->query("UPDATE `character_effects` SET `end_time` = ?d WHERE `guid` = ?d and `effect_id` = ?d", (time() + $e_info['duration']) ,$guid ,$effect);
        return;
      }
      else
        $type = 1;
    }
    
    $char_stats = $this->getChar('char_stats', '*', $guid);
    
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
    $new_sql['hp_all'] = $e_info['add_hp'];
    $new_sql['mp_all'] = $e_info['add_mp'];
    $new_sql['mp_regen'] = $e_info['mp_regen'];
    $new_sql['mp_cons'] = -$e_info['mp_cons'];
    
    foreach ($new_sql as $key => $value)
    {
      $new_sql[$key] = $value*$type;
      $new_sql[$key] += $char_stats[$key];
    }
    
    $char_hpmp = $this->getChar('char_stats', 'hp', 'mp', $guid);
    foreach ($char_hpmp as $key => $value)
    {
      if ($e_info['add_'.$key] != 0)
        $this->setTimeToHPMP($value, $new_sql[$key.'_all'], $char_stats[$key.'_regen'], $key, $guid);
    }
    
    if ($type == 1)
    {
      $time = ($e_info['duration'] == 0) ?0 :time() + $e_info['duration'];
      $this->db->query("INSERT INTO `character_effects` (`guid`, `effect_id`, `end_time`) 
                        VALUES (?d, ?d, ?d)", $guid ,$effect ,$time);
    }
    else if ($type == -1)
      $this->db->query("DELETE FROM `character_effects` WHERE `guid` = ?d and `effect_id` = ?d", $guid ,$effect);
    $this->setChar('char_stats', $new_sql, $guid);
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
    
    $entry = $this->db->selectCell("SELECT `id` FROM `player_effects` WHERE `set` = ?s and `power` = ?d", $stat ,$power);
    $this->workEffect($entry, 1);
  }
  /*Добавление/Удаление травмы*/
  function workTravm ($travm, $type = 1, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    
    if (checki($travm))
      return;
    
    $char_trm = $this->db->selectCell("SELECT `guid` FROM `character_travms` WHERE `travm_id` = ?d and `guid` = ?d", $travm ,$guid);
    
    if (($type == -1 && !$char_trm) || ($type == 1 && $char_trm))
      return;
    
    if ($type == 1)
      $t_info = $this->db->selectRow("SELECT * FROM `player_travms` WHERE `id` = ?d", $travm);
    else
      $t_info = $this->db->selectRow("SELECT * 
                                      FROM `character_travms` AS `c` 
                                      LEFT JOIN `player_travms` AS `i` 
                                      ON `c`.`travm_id` = `i`.`id` 
                                      WHERE `c`.`guid` = ?d 
                                        and `c`.`travm_id` = ?d", $guid ,$travm);
    
    $level = $this->getChar('char_db', 'level', $guid);
    $char_stats = $this->getChar('char_stats', '*', $guid);
    
    $stats = array('str' => 0, 'dex' => 0, 'con' => 0);
    $new_sql = array();
    
    if ($type == 1)
    {
      $t_info['stats'] = '';
      switch ($t_info['type'])
      {
        case 0:
          if ($t_info['id'] == 100)
            $t_info['stats'] = "mf_sting=50,mf_slash=50,mf_crush=50,mf_sharp=50,mf_fire=50,mf_water=50,mf_air=50,mf_earth=50,mf_light=50,mf_gray=50,mf_dark=50";
        break;
        case 1:
          if ($this->db->selectRow("SELECT * FROM `character_travms` AS `c` LEFT JOIN `player_travms` AS `i` ON `c`.`travm_id` = `i`.`id` WHERE `c`.`guid` = ?d and `i`.`type` = '1';", $guid))
            return;
          
          $shuffle = shuffle_arr($stats);
          foreach ($shuffle as $key => $value)
          {
            $stats[$key] = $char_stats[$key];
            $minus = ($t_info['power'] == 1) ?$level*$t_info['power'] :$level*($t_info['power'] + 2);
            if ($char_stats[$key] > $minus)
            {
              $t_info['stats'] = "$key=$minus";
              break;
            }
          }
          
          if (!$t_info['stats'])
          {
            arsort($stats);
            foreach ($stats as $key => $value)
            {
              $minus = $char_stats[$key]-1;
              $t_info['stats'] = "$key=$minus";
              break;
            }
          }
        break;
        case 2:
          if ($this->db->selectRow("SELECT * FROM `character_travms` AS `c` LEFT JOIN `player_travms` AS `i` ON `c`.`travm_id` = `i`.`id` WHERE `c`.`guid` = ?d and `i`.`type` = '2';", $guid))
            return;
          
          $minus = 25*$t_info['power'];
          $t_info['stats'] = "mp_regen=$minus";
        break;
      }
      $stats = array('str' => 0, 'dex' => 0, 'con' => 0);
    }
    
    if ($t_info['stats'])
    {
      $modifiers = split(",", $t_info['stats']);
      foreach ($modifiers as $modifier)
      {
        $stat = split("=", $modifier);
        
        if (array_key_exists($stat[0], $stats))
          $stats[$stat[0]] = -$stat[1]*$type;
        else
          $new_sql[$stat[0]] = -$stat[1]*$type + $char_stats[$stat[0]];
      }
      $this->changeStats($stats, $guid);
      if ($new_sql)
        $this->setChar('char_stats', $new_sql, $guid);
    }
    
    if ($type == 1)
    {
      $time = ($t_info['dur_max'] == 0) ?0 :time() + rand($t_info['dur_min'], $t_info['dur_max']);
      $this->db->query("INSERT INTO `character_travms` (`guid`, `travm_id`, `stats`, `end_time`) 
                        VALUES (?d, ?d, ?s, ?d)", $guid ,$travm ,$t_info['stats'] ,$time);
    }
    else if ($type == -1)
      $this->db->query("DELETE FROM `character_travms` WHERE `guid` = ?d and `travm_id` = ?d", $guid ,$travm);
  }
  /*Показ строки персонажа*/
  function getLogin ($type = 'clan', $guid = 0)
  {
    $guid = $this->getGuid($guid);
    $char_db = $this->getChar('char_db', 'login', 'level', 'orden', 'clan', 'clan_short', 'block', 'rang', 'chat_shut', 'afk', 'dnd', 'message', $guid);
    list($login, $level, $orden, $clan_f, $clan_s, $block, $rang, $chat_shut, $afk, $dnd, $message) = array_values($char_db);
    $travm = $this->db->select("SELECT `c`.`travm_id` FROM `character_travms` AS `c` LEFT JOIN `player_travms` AS `i` ON `c`.`travm_id` = `i`.`id` WHERE `c`.`guid` = ?d and (`i`.`type` = '1' or `i`.`type` = '2');", $guid);
    switch ($orden)
    {
      case 1:  $orden_img = "<img src='img/orden/pal/$rang.gif' width='12' height='15' border='0' title='Белое братство'>";  break;
      case 2:  $orden_img = "<img src='img/orden/arm/$rang.gif' width='12' height='15' border='0' title='Темное братство'>"; break;
      case 3:  $orden_img = "<img src='img/orden/3.gif' width='12' height='15' border='0' title='Нейтральное братство'>";    break;
      case 4:  $orden_img = "<img src='img/orden/4.gif' width='12' height='15' border='0' title='Алхимик'>";                 break;
      case 5:  $orden_img = "<img src='img/orden/5.gif' width='12' height='15' border='0' title='Хаос'>";                    break;
      default: $orden_img = "";                                                                                              break;
    }
    $clan = ($clan_s != '') ?"<img src='img/clan/$clan_s.gif' border='0' title='$clan_f'>" :"";
    $login_link = str_replace(" ", "%20", $login);
    $login_info = "<a href='info.php?log=$login_link' target='_blank'><img src='img/inf.gif' border='0' title='Инф. о $login'></a>";
    $mol = ($chat_shut) ?" <img src='img/sleep2.gif' title='Наложено заклятие молчания'>" :"&nbsp";
    $travm = ($travm) ?"<img src='img/travma.gif' title='Инвалидность'>" :"&nbsp";
    $banned = ($block) ?"<font color='red'><b>- Забанен</b></font>" :"";
    $afk = ($afk) ?"<font title='$message'><b>afk</b></font>&nbsp;" :(($dnd && $message) ?"<font title='$message'><b>dnd</b></font>&nbsp;" :'');
    switch ($type)
    {
      case 'online': return "&nbsp;<a href=javascript:top.AddToPrivate('$login_link',true);><img border='0' src='img/lock.gif' title='Приват'></a>&nbsp;&nbsp;$afk$orden_img$clan<a href=javascript:top.AddTo('$login_link'); class='nick'><b>$login</b></a>[$level]$login_info$mol$travm<br>";
      case 'mults':  return "$orden_img$clan<b>$login</b> [$level]$login_info $banned <br>";
      case 'clan':   return "$orden_img$clan<b>$login</b> [$level]$login_info";
      case 'turn':   return $orden_img;
      case 'name':   return $login;
      case 'news':   return "$orden_img$clan<font class='header'>$login</font> [$level]$login_info";
      case 'mail':   return "<font color='red'>$login</font> $login_info";
      default:       return "";
    }
  }
  /*Распознает наличие гайда*/
  function getGuid ($guid)
  {
    return (!$guid) ?$this->guid :$guid;
  }
}
?>