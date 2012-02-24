<?
defined('AntiBK') or die ("Доступ запрещен!");

/*Интерфейс персонажа*/
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
    $classes = array ('test', 'equip', 'city', 'mail', 'bank', 'chat', 'info', 'history', 'error');
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
    
    if (is_numeric ($args[$args_num-1]))
    {
      $guid = $args[$args_num-1];
      unset ($args[$args_num-1]);
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
    
    unset ($args[0]);
    
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
                                 `wp_min` = `wp_min` + ?d, 
                                 `wp_max` = `wp_max` + ?d 
                             WHERE `guid` = ?d", $count ,$count ,$count ,$this->guid);
          break;
        case 'dex':
          $mf_uvorot = $count * 7;
          $mf_antiuvorot = $count * 3;
          $this->db->query("UPDATE `character_stats` 
                             SET `dex` = `dex` + ?d, 
                                 `mf_uvorot` = `mf_uvorot` + ?d, 
                                 `mf_antiuvorot` = `mf_antiuvorot` + ?d 
                             WHERE `guid` = ?d", $count ,$mf_uvorot ,$mf_antiuvorot ,$this->guid);
          break;
        case 'con':
          $mf_crit = $count * 7;
          $mf_anticrit = $count * 3;
          $this->db->query("UPDATE `character_stats` 
                             SET `con` = `con` + ?d, 
                                 `mf_crit` = `mf_crit` + ?d, 
                                 `mf_anticrit` = `mf_anticrit` + ?d 
                             WHERE `guid` = ?d", $count ,$mf_crit ,$mf_anticrit ,$this->guid);
          break;
        case 'vit':
          $hp = $count * 6;
          $bron = $count * 1.5;
          $this->db->query("UPDATE `character_stats` 
                             SET `vit` = `vit` + ?d, 
                                 `hp` = `hp` + ?d, 
                                 `hp_all` = `hp_all` + ?d, 
                                 `maxmass` = `maxmass` + ?d, 
                                 `resist_sting` = `resist_sting` + ?f, 
                                 `resist_slash` = `resist_slash` + ?f, 
                                 `resist_crush` = `resist_crush` + ?f, 
                                 `resist_sharp` = `resist_sharp` + ?f, 
                                 `resist_fire` = `resist_fire` + ?f, 
                                 `resist_water` = `resist_water` + ?f, 
                                 `resist_air` = `resist_air` + ?f, 
                                 `resist_earth` = `resist_earth` + ?f 
                             WHERE `guid` = ?d", $count ,$hp ,$hp ,$count ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$this->guid);
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
          break;
        case 'wis':
          $mp = $count * 10;
          $this->db->query("UPDATE `character_stats` 
                             SET `wis` = `wis` + ?d, 
                                 `mp` = `mp` + ?d, 
                                 `mp_all` = `mp_all` + ?d 
                             WHERE `guid` = ?d", $count ,$mp ,$mp ,$this->guid);
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
    $mass = $this->getChar('char_stats', 'mass');
    return $mass;
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
    $added = array('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0, 'sword' => 0, 'axe' => 0, 'fail' => 0, 'knife' => 0, 'staff' => 0, 'shot' => 0, 'fire' => 0, 'water' => 0, 'air' => 0, 'earth' => 0, 'light' => 0, 'gray' => 0, 'dark' => 0);
    $rows = $this->db->select("SELECT `i`.`add_str`, `c`.`inc_str`, 
                                       `i`.`add_dex`, `c`.`inc_dex`, 
                                       `i`.`add_con`, `c`.`inc_con`, 
                                       `i`.`add_int`, `c`.`inc_int`, 
                                       `i`.`all_mastery`, 
                                       `i`.`sword`, `i`.`axe`, 
                                       `i`.`fail`, `i`.`knife`, 
                                       `i`.`staff`, `i`.`shot`, 
                                       `i`.`all_magic`, 
                                       `i`.`fire`, `i`.`water`, 
                                       `i`.`air`, `i`.`earth`, 
                                       `i`.`light`, `i`.`gray`, 
                                       `i`.`dark` 
                                FROM `character_inventory` AS `c` 
                                LEFT JOIN `item_template` AS `i` 
                                ON `c`.`item_template` = `i`.`entry` 
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
      $added['axe'] += $dat['axe'] + $dat['all_mastery'];
      $added['fail'] += $dat['fail'] + $dat['all_mastery'];
      $added['knife'] += $dat['knife'] + $dat['all_mastery'];
      $added['staff'] += $dat['staff'];
      $added['shot'] += $dat['shot'];
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
    
    if ($char_feat['next_shape'] && $char_feat['next_shape'] > time ())
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
    global $behaviour, $mastery;
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
        {
          $content .= (($level >= $min_level) ?"$lang[$key] <b>$char_stats[$key]</b>" :"").(($key != 'spi' && $level >= $min_level) ?"<br>" :"");
        }
        $content .= ($char_stats['ups'] > 0 || $char_stats['skills'] > 0) ?"<br>" :"";
        $content .= ($char_stats['ups'] > 0) ?"<a class='nick' href='?action=skills'><b><small>+ $lang[ups]</small></b></a> " :"";
        $content .= ($char_stats['skills'] > 0) ?"&bull; <a class='nick' href='?action=skills'><b><small> $lang[skills]</small></b></a>" :"";
      break;
      case 'mod':        /*Модификаторы*/
        $wp_min = $char_stats['wp_min'];
        $wp_max = $char_stats['wp_max'];
        $hand_r_hitmin = $char_stats['hand_r_hitmin'];
        $hand_l_hitmin = $char_stats['hand_l_hitmin'];
        $hand_r_hitmax = $char_stats['hand_r_hitmax'];
        $hand_l_hitmax = $char_stats['hand_l_hitmax'];
        $hand_r_critpower = $char_stats['hand_r_critpower'];
        $hand_l_critpower = $char_stats['hand_l_critpower'];
        $hand_r_crit = $char_stats['hand_r_crit'];
        $hand_l_crit = $char_stats['hand_l_crit'];
        $hand_r_antiuvorot = $char_stats['hand_r_antiuvorot'];
        $hand_l_antiuvorot = $char_stats['hand_l_antiuvorot'];
        $mf_critpower = $char_stats['mf_critpower'];
        $mf_crit = $char_stats['mf_crit'];
        $mf_uvorot = $char_stats['mf_uvorot'];
        $mf_anticrit = $char_stats['mf_anticrit'];
        $mf_antiuvorot = $char_stats['mf_antiuvorot'];
        $mf_contr = $char_stats['mf_contr'];
        $mf_parry = $char_stats['mf_parry'];
        $mf_blockshield = $char_stats['mf_blockshield'];
        $hand_status_r = $this->equip->checkHandStatus('r');
        $hand_status_l = $this->equip->checkHandStatus('l');
        $show_r_udar = ($hand_status_r) ?($hand_r_hitmin + $wp_min + $char_stats[$hand_r_type])."-".($hand_r_hitmax + $wp_max + $char_stats[$hand_r_type]) :"";
        $show_l_udar = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_hitmin + $wp_min + $char_stats[$hand_l_type])."-".($hand_l_hitmax + $wp_max + $char_stats[$hand_l_type]) :"";
        $show_r_cpower = ($hand_status_r) ?$hand_r_critpower + $mf_critpower :"";
        $show_l_cpower = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_critpower + $mf_critpower) :"";
        $show_r_crit = ($hand_status_r) ?$hand_r_crit + $mf_crit :"";
        $show_l_crit = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_crit + $mf_crit) :"";
        $show_r_antiuvorot = ($hand_status_r) ?$hand_r_antiuvorot + $mf_antiuvorot :"";
        $show_l_antiuvorot = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($hand_l_antiuvorot + $mf_antiuvorot) :"";
        $show_r_mastery = ($hand_status_r) ?$char_stats[$hand_r_type] + $char_stats['hand_r_'.$hand_r_type] :"";
        $show_l_mastery = ($hand_status_l) ?(($hand_r != 0) ?" / " :"").($char_stats[$hand_l_type] + $char_stats['hand_l_'.$hand_r_type]) :"";
        $content .= "$lang[damage] $show_r_udar$show_l_udar<br>"
                  . "<span alt='$lang[mf_crit_m]'>$lang[mf_crit_i] $show_r_crit$show_l_crit</span><br>";
        $content .= ($hand_r_critpower != 0 || $hand_l_critpower != 0 || $mf_critpower != 0) ?"<span alt='$lang[mf_critpower_m]'>$lang[mf_critpower_i] $show_r_cpower$show_l_cpower</span><br>" :"";
        $content .= "<span alt='$lang[mf_anticrit_m]'>$lang[mf_anticrit_i] $mf_anticrit</span><br>"
                  . "<span alt='$lang[mf_uvorot_m]'>$lang[mf_uvorot_i] $mf_uvorot</span><br>"
                  . "<span alt='$lang[mf_antiuvorot_m]'>$lang[mf_antiuvorot_i] $show_r_antiuvorot$show_l_antiuvorot</span><br>"
                  . "<span alt='$lang[mf_contr_m]'>$lang[mf_contr_i] $mf_contr</span><br>"
                  . "<span alt='$lang[mf_parry_m]'>$lang[mf_parry_i] $mf_parry</span><br>"
                  . "<span alt='$lang[mf_blockshield_m]'>$lang[mf_blockshield_i] $mf_blockshield</span><br>";
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
        $resists = array ('sting', 'slash', 'crush', 'sharp', 'fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
        foreach ($resists as $key)
          $content .= "<span alt='".$lang[$key.'_d']."'>".$lang[$key.'_i']." ".$char_stats['resist_'.$key]."</span><br>";
      break;
      case 'btn':        /*Кнопки*/
        $content .= "&nbsp;<input type='button' value='$lang[unwear_all]' class='btn' id='link' link='unwear_full' style='font-weight: bold;'><br>";
      break;
      case 'set':        /*Комплекты*/
        $sets = $this->db->select("SELECT * FROM `character_sets`;");
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
      $return .= "<img id='spoiler_$bar' width='11' height='9' alt='Скрыть' border='0' src='img/minus.gif' style='cursor: pointer;' onclick=\"javascript:spoilerBar ('$bar');\" />";
    else
      $return .= "<img id='spoiler_$bar' width='11' height='9' alt='Показать' border='0' src='img/plus.gif' style='cursor: pointer;' onclick=\"javascript:spoilerBar ('$bar');\" />";
    $return .= "</td>";
    $return .= "<td>&nbsp;</td><td bgcolor='#e2e0e0'><small>&nbsp;<b>".$lang['bar_'.$bar]."<b>&nbsp;</small></td>";
    if ($link_text)
      $return .= "<td>&nbsp;</td><td bgcolor='#e2e0e0'>&nbsp;<a href='$link' class='nick'><small>$link_text</small></a>&nbsp;</td>";
    $return .= "<td align='right' valign='middle' width='100%'>";
    if ($flags & 2)
      $return .= "<img border='0' width='11' height='9' alt='Поднять блок наверх' src='img/up.gif' style='cursor: pointer;' onclick=\"javascript:switchBars ('up', '$bar');\" />";
    else
      $return .= "<img border='0' width='11' height='9' src='img/up-grey.gif'>";
    if ($flags & 4)
      $return .= "<img border='0' width='11' height='9' alt='Опустить блок вниз' src='img/down.gif' style='cursor: pointer;' onclick=\"javascript:switchBars ('down', '$bar');\" />";
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
}
/*Функции проверки*/
class Test extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Проверка существования персонажа*/
  function Guid ($type = 'main', $loc = '')
  {
    $error = getError($type, $loc);
    
    if ($this->guid == 0 || !is_numeric($this->guid))
      die ($error);
    
    $char_db = $this->getChar('char_db', 'guid');
    $char_stats = $this->getChar('char_stats', 'guid');
    $char_info = $this->getChar('char_info', 'guid');
    
    if (!$char_db || !$char_stats || !$char_info)
      echoScript($error, true);
  }
  /*Проверка на доступ*/
  function Admin ($type = 'main', $loc = '')
  {
    $error = getError($type, $loc);
    
    $admin_level = $this->getChar('char_db', 'admin_level');
    
    if (!$admin_level)
      echoScript($error, true);
  }
  /*Проверка блока персонажа*/
  function Block ()
  {
    $block = $this->getChar('char_db', 'block');
    
    if (!$block)
      return;
    
    echoScript("top.main.location.href = 'main.php?action=exit';", true);
  }
  /*Проверка заключения персонажа*/
  function Prision ()
  {
    $prision = $this->getChar('char_db', 'prision');
    
    if (!$prision || intval ($prision - time()) > 0)
      return;
    
    $this->db->query("UPDATE `characters` 
                       SET `prision` = '0', 
                           `orden` = '0' 
                       WHERE `guid` = ?d", $this->guid);
  }
  /*Проверка участия персонажа в заявке*/
  function Zayavka ()
  {
    $battle = $this->getChar('char_db', 'battle');
    $md1 = $this->db->selectCell("SELECT `battle_id` FROM `team1` WHERE `player` = ?d", $this->guid);
    $md2 = $this->db->selectCell("SELECT `battle_id` FROM `team2` WHERE `player` = ?d", $this->guid);
    $t = 0;
    if ($md1)
    {
      $m = $md1;
      $t = 1;
    }
    else if ($md2)
    {
      $m = $md2;
      $t = 2;
    }
    $rows = $this->db->select("SELECT `creator`, 
                                       `status` 
                                FROM `zayavka`;");
    foreach ($rows as $dat)
    {
      $cr = $dat['creator'];
      
      if ($m == $dat['creator'] && $dat['status'] == 1)
        $zayavka_status = "awaiting";
      
      if ($m == $dat['creator'] && $dat['status'] == 2 && $t == 1)
        $zayavka_status = "confirm_mine";
      
      if ($m == $dat['creator'] && $dat['status'] == 2 && $t == 2)
        $zayavka_status = "confirm_opp";
      
      if ($m == $dat['creator'] && $dat['status'] == 3 && $battle == 0)
        goBattle($this->guid);
    }
    if ($_SESSION['zayavka_c_m'] == 0 && $zayavka_status == "confirm_mine")
    {
      $_SESSION['zayavka_c_m'] = 1;
      echoScript("top.main.location.href = 'zayavka.php?boy=phisic';", true);
    }
    
    if ($_SESSION['zayavka_c_o'] == 0 && $t == 0)
      $_SESSION['zayavka_c_o'] = 1;
  }
  /*Проверка участия персонажа в битве*/
  function Battle ()
  {
    $battle = $this->getChar('char_db', 'battle');
    
    if (!$battle)
      return;
    
    echoScript("top.main.location.href = 'battle.php';", true);
  }
  /*Проверка молчанки у персонажа*/
  function Shut ()
  {
    $shut = $this->getChar('char_db', 'shut');
    
    if (!$shut || intval (($shut - time()) / 60) > 0)
      return;
    
    $this->db->query("UPDATE `characters` SET `shut` = '0' WHERE `guid` = ?d", $this->guid);
  }
  /*Восстановление здоровья/маны*/
  function Regen ()
  {
    $char_stats = $this->getChar('char_stats', 'hp', 'hp_cure', 'hp_all', 'hp_regen', 'mp', 'mp_cure', 'mp_all', 'mp_regen');
    list ($now["hp"], $cure["hp"], $all["hp"], $regen["hp"], $now["mp"], $cure["mp"], $all["mp"], $regen["mp"]) = array_values ($char_stats);
    $battle = $this->getChar('char_db', 'battle');
    
    if ($battle != 0)
      return;
    
    foreach ($all as $key => $value)
    {
      if ($cure[$key] == 0 && $now[$key] < $value)
      {
        getCureValue($now[$key], $value, $regen[$key], $cure[$key]);
        $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key.'_cure' ,$cure[$key] ,$this->guid);
      }
      else if ($cure[$key] == 0)
        continue;
      
      $regenerated = getRegeneratedValue($value, ($cure[$key] - time ()), $regen[$key]);
      if ($regenerated >= 0 && $regenerated < $value)
        $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key ,$regenerated ,$this->guid);
      else
      {
        $this->db->query("UPDATE `character_stats` SET ?# = ?d, ?# = '0' WHERE `guid` = ?d", $key ,$value ,$key.'_cure' ,$this->guid);
        continue;
      }
      getCureValue($regenerated, $value, $regen[$key], $cure[$key]);
      $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key.'_cure' ,$cure[$key] ,$this->guid);
    }
  }
  /*Проверка травм у персонажа*/
  function Travm ()
  {
    $char_db = $this->getChar('char_db', 'travm', 'travm_old_stat', 'travm_stat');
    
    if (!$char_db['travm'])
      return;
    
    if (intval (($char_db['travm'] - time()) / 60) > 0)
      return;
    
    $this->db->query("UPDATE `characters` SET `travm` = '0' WHERE `guid` = ?d" ,$this->guid);
    $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $char_db['travm_stat'] ,$char_db['travm_old_stat'] ,$this->guid);
  }
  /*Проверка на получение апа/лвла*/
  function Up ()
  {
    $char_db = $this->getChar('char_db', 'exp', 'next_up', 'level');
    
    if ($char_db['exp'] < $char_db['next_up'])
      return;
    
    $next_up_id = $this->db->selectCell("SELECT `up` FROM `player_exp_for_level` WHERE `exp` = ?d", $char_db['next_up']) + 1;
    $exp_table = $this->db->selectRow("SELECT `level`, `exp`, 
                                               `ups`, `skills`, 
                                               `money`, `vit`, 
                                               `add_bars`, `status` 
                                        FROM `player_exp_for_level` 
                                        WHERE `up` = ?d", $next_up_id);
    list ($next_level, $next_exp, $next_ups, $next_skills, $next_money, $next_vit, $add_bars, $next_status) = array_values ($exp_table);
    $this->db->query("UPDATE `characters` 
                       SET `next_up` = ?d, 
                           `money` = `money` + ?d 
                       WHERE `guid` = ?d", $next_exp ,$next_money ,$this->guid);
    $this->db->query("UPDATE `character_stats` 
                       SET `ups` = `ups` + ?d, 
                           `skills` = `skills` + ?d 
                       WHERE `guid` = ?d", $next_ups ,$next_skills ,$this->guid);
    $this->char->history->transfers('Get', "$next_money кр.", $_SERVER['REMOTE_ADDR'], 'Level');
    
    if ($next_level <= $char_db['level'])
      return;
    
    $this->db->query("UPDATE `characters` 
                       SET `level` = ?d, 
                           `status` = ?s 
                       WHERE `guid` = ?d", $next_level ,$next_status ,$this->guid);
    $this->changeStats('vit', $next_vit);
    if ($add_bars)
    {
      $bar_enums = array (
        'power' => 3,
        'def'   => 4,
        'set'   => 5,
        'btn'   => 6
      );
      $add_bars = explode (',', $add_bars);
      foreach ($add_bars as $key => $value)
      {
        $this->db->query("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $value ,$bar_enums[$value]."|1" ,$this->guid);
      }
    }
  }
  /*Проверка участия персонажа в походе*/
  function Move ()
  {
    $speed = $this->getChar('char_db', 'speed');
    $ld = $this->db->selectRow("SELECT `time`, 
                                        `destenation`, 
                                        `dest_game`, 
                                        `len`, 
                                        `napr` 
                                 FROM `goers` 
                                 WHERE `guid` = ?d", $this->guid);
    if (!$ld)
      return;
    
    list ($all_time, $dest_g, $dest, $len, $napr) = array_values ($ld);
    $to_go = $all_time - time();
    $to_go_sec = intval (($all_time - time()));  /*seconds*/
    $time_to_go = intval ($len / $speed * 3600); /*секунд идти*/
    $atg = $time_to_go - $to_go_sec;
    $len_done = getMoney($speed * $atg / 3600);
    $speed_form = getMoney($speed / 1000);
    if ($to_go > 0)
    {
      echo "Вы идете.<br>"
         . "Назначение: <b>$dest</b><br>"
         . "Направление: <b>$napr</b><br>"
         . "Расстояние: <b>$len (м)</b><br>"
         . "Пройдено: <b>$len_done (м)</b><br>"
         . "Скорость: <b>$speed_Form(км/час)</b><br>"
         . "Осталось времени: <b>".getFormatedTime($all_time)."</b><br><br>"
         . "<input type='button' onclick=\"location.reload();\" value='Обновить' id='refresh' size='20' class='anketa' style='background-color: #e4e4e4;'>";
      die ();
    }
    else
    {
      echo "Вы пришли в <b>$dest</b>";
      $walk_coef = $len / 10000;
      
      if ($des_g == 'mountown_forest' || $des_g == 'Mountown')
        $room = "forest";
      
      $this->db->query("UPDATE `characters` 
                         SET `city` = ?s, 
                             `room` = ?s 
                         WHERE `guid` = ?d", $dest ,$room ,$this->guid);
      $this->db->query("UPDATE `character_stats` SET `walk` = `walk` + ?d WHERE `guid` = ?d", $walk_coef ,$this->guid);
      $this->db->query("DELETE FROM `goers` WHERE `guid` = ?d", $this->guid);
      echoScript("location.href = 'main.php?action=go&room_go=$room';", true);
    }
  }
  /*Проверка правельности перехода*/
  function Go ($room_go, $return = false)
  {
    if (!$room_go)
      $this->char->error->Map(102);
    
    $char_db = $this->getChar('char_db', 'room', 'city', 'sex', 'level', 'last_go', 'prision');
    $char_stats = $this->getChar('char_stats', 'mass', 'maxmass');
    $time_to_go = $this->char->city->getRoom($char_db['room'], $char_db['city'], 'time_to_go');
    $room_info = $this->char->city->getRoom($room_go, $char_db['city'], 'room', 'from', 'min_level', 'need_orden', 'sex') or $this->char->error->Map(102);
    
    list ($room_go, $from, $min_level, $need_orden, $need_sex) = array_values ($room_info);
    
    if ($char_db['prision'] != 0)
      $this->char->error->Map(100);
    
    if ($char_stats['mass'] > $char_stats['maxmass'])
      $this->char->error->Map(103, "$char_stats[mass]|$char_stats[maxmass]");
    
    if ($char_db['level'] < $min_level)
      $this->char->error->Map(101, ($min_level - 1));
    
    if ($need_orden)
      $this->char->error->Map(102);
    
    if ($need_sex && $char_db['sex'] != $need_sex)
    {
      $need_sex = ($need_sex == 'female') ?'женщинам' :'мужчинам';
      $this->char->error->Map(104, $need_sex);
    }
    
    if (!in_array ($char_db['room'], explode (',', $from)) && $char_db['room'] != $room_go)
      $this->char->error->Map(102);
    
    if (($time_to_go - (time () - $char_db['last_go'])) > 0 && !$return)
      $this->char->error->Map(110);
  }
  /*Проверка всех предметов*/
  function Items ()
  {
    $char_equip = $this->getChar('char_equip', 'helmet', 'bracer', 'hand_r', 'armor', 'shirt', 'cloak', 'belt', 'earring', 'amulet', 'ring1', 'ring2', 'ring3', 'gloves', 'hand_l', 'pants', 'boots');
    foreach ($char_equip as $key => $value)
    {
      if ($value != 0 && !($this->char->equip->checkItemStats($value)))
        $this->char->equip->equipItem($key, -1);
    }
    $rows = $this->db->select("SELECT `id`, 
                                       `wear`, 
                                       `mailed` 
                                FROM `character_inventory` 
                                WHERE `guid` = ?d", $this->guid);
    foreach ($rows as $inventory)
    {
      list ($item_id, $item_wear, $item_mailed) = array_values ($inventory);
      
      if ($this->char->equip->checkItemValidity($item_id))
        continue;
      
      if (!$item_wear && !$item_mailed)
        $this->char->equip->deleteItem($item_id);
      else if ($item_wear && !$item_mailed)
      {
        $slot = $this->char->equip->getItemSlot($item_id);
        $this->char->equip->equipItem($slot, -1);
        $this->char->equip->deleteItem($item_id);
      }
    }
  }
  /*Проверка доступности комнаты*/
  function Room ()
  {
    global $action;
    $actions = array ('none', 'go', 'admin', 'enter', 'exit', '');
    $room = $this->getChar('char_db', 'room');
    
    if ($room == 'mail' && !in_array ($action, $actions))
      $this->char->error->Map(105);
    
    if ($room == 'bank' && !in_array ($action, $actions))
      $this->char->error->Map();
  }
  /*Проверка состояния персонажа*/
  function Afk ()
  {
    $char_db = $this->getChar('char_db', 'last_time', 'dnd', 'afk');
    
    if ($char_db['afk'])
      return;
    
    if ((time () - $char_db['last_time']) >= 300 && !$char_db['dnd'])
      $this->db->query("UPDATE `characters` SET `afk` = '1', `message` = 'away from keyboard' WHERE `guid` = ?d", $this->guid);
  }
  /*Обновление состояния персонажа*/
  function WakeUp ()
  {
    $char_db = $this->getChar('char_db', 'afk', 'message');
    $this->db->query("UPDATE `characters` SET `last_time` = ?d WHERE `guid` = ?d", time () ,$this->guid);
    $this->db->query("UPDATE `online` SET `last_time` = ?d WHERE `guid` = ?d", time () ,$this->guid);

    if ($char_db['afk'] && $char_db['message'] == 'away from keyboard')
      $this->db->query("UPDATE `characters` SET `afk` = '0', `message` = NULL WHERE `guid` = ?d", $this->guid);
  }
}
/*Функции работы с предметами*/
class Equip extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Вычисление цены покупки предмета*/
  function getBuyValue (&$value)
  {
    $trade = $this->getChar('char_stats', 'trade');
    $value = round (($value - $trade / 50), 2);
  }
  /*Проверка характеристик предмета и персонажа*/
  function checkItemStats ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return false;
    
    $dat = $this->db->selectRow("SELECT `i`.`min_level`, 
                                         `i`.`sex`, `i`.`orden`, 
                                         `i`.`min_str`, `i`.`min_dex`, 
                                         `i`.`min_con`, `i`.`min_vit`, 
                                         `i`.`min_int`, `i`.`min_wis`, 
                                         `i`.`min_mp_all`, 
                                         `i`.`min_sword`, `i`.`min_axe`, 
                                         `i`.`min_fail`, `i`.`min_knife`, 
                                         `i`.`min_staff`, 
                                         `i`.`min_fire`, `i`.`min_water`, 
                                         `i`.`min_air`, `i`.`min_earth`, 
                                         `i`.`min_light`, `i`.`min_gray`, 
                                         `i`.`min_dark`, 
                                         `c`.`is_personal`, `c`.`personal_owner`, 
                                         `c`.`tear_cur`, `c`.`tear_max` 
                                  FROM `character_inventory` AS `c` 
                                  LEFT JOIN `item_template` AS `i` 
                                  ON `c`.`item_template` = `i`.`entry` 
                                  WHERE `c`.`guid` = ?d
                                    and `c`.`id` = ?d", $this->guid ,$item_id);
    $char_db = $this->getChar('char_db', 'level', 'sex', 'orden');
    $char_stats = $this->getChar('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'mp_all', 'sword', 'axe', 'fail', 'knife', 'staff', 'fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
    $char_feat = array_merge ($char_db, $char_stats);
    foreach ($char_feat as $key => $value)
    {
      if ($key != 'sex' && $key != 'orden' && $value < $dat['min_'.$key])   return false;
      if ($key == 'sex' && $dat['sex'] && $value != $dat['sex'])            return false;
      if ($key == 'orden' && $dat['orden'] != 0 && $value != $dat['orden']) return false;
    }
    
    if ($dat['is_personal'] && $dat['personal_owner'] != $this->guid)
      return false;
    
    if ($dat['tear_cur'] >= $dat['tear_max'])
      return false;
    
    return true;
  }
  /*Проверка годности предмета*/
  function checkItemValidity ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return false;
    
    $date = $this->db->selectCell("SELECT `date` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d", $this->guid ,$item_id);
    
    if ($date != 0 && $date < time ())
      return false;
    
    return true;
  }
  /*Проверка отображения модификаторов*/
  function checkHandStatus ($hand)
  {
    $char_equip = $this->getChar('char_equip', 'hand_l_free', 'hand_r_free', 'hand_l_type', 'hand_l', 'hand_r');
    switch ($hand)
    {
      case 'r':
        if ($char_equip['hand_r'] != 0 || ($char_equip['hand_l_free'] == 1 & $char_equip['hand_r_free'] == 1) || $char_equip['hand_l_type'] == 'shield')
          return true;
      case 'l':
        if ($char_equip['hand_l'] != 0 && $char_equip['hand_l_type'] != 'shield')
          return true;
    }
    return false;
  }
  /*Удаление предмета*/
  function deleteItem ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return;
    
    $name = $this->db->selectCell("SELECT `i`.`name`
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_template` = `i`.`entry` 
                                    WHERE `c`.`guid` = ?d 
                                      and `c`.`id` = ?d 
                                      and `c`.`wear` = '0' 
                                      and `c`.`mailed` = '0';", $this->guid ,$item_id);
    if (!$name)
      return;
    
    $this->db->query("DELETE FROM `character_inventory` WHERE `id` = ?d", $item_id);
    $this->char->history->transfers('Throw out', $name, $_SERVER['REMOTE_ADDR'], 'Dump');
  }
  /*Отображение снаряжения*/
  function showCharacter($type = '', $guid = 0)
  {
    $guid = (!$guid) ?$this->guid :$guid;
    $char_equip = $this->getChar('char_equip', '*');
    $char_db = $this->getChar('char_db', 'login', 'shape', 'block');
    $char_stats = $this->getChar('char_stats', 'hp', 'hp_all', 'hp_regen', 'mp', 'mp_all', 'mp_regen');
    $char_feat = array_merge ($char_db, $char_stats);
    $lang = $this->getLang();
    $char_type = 'clan';
    switch ($type)
    {
      case 'inv':
        $char_feat['name'] = "alt='$char_feat[login] (Перейти в \"$lang[abilities]\")' id='link' link='skills'";
      break;
      case 'info':
        $char_type = 'info';
        $char_feat['name'] = "alt='$char_feat[login]'";
      break;
      default:
        $char_feat['name'] = "alt='$char_feat[login] (Перейти в \"Инвентарь\")' id='link' link='inv'";
      break;
    }
    $char_equip['armor'] = ($char_equip['cloak']) ?$char_equip['cloak'] :(($char_equip['armor']) ?$char_equip['armor'] :$char_equip['shirt']);
    $char_equip['hand_l_s'] = (!$char_equip['hand_l_free']) ?"hand_l" :"hand_l_f";
    
    echo $this->char->info->character($char_type);
    echo ($type == 'info') ?"<div style='height: 9px;'></div>" :'';
    echo $this->getCharacterEquipped($char_equip, $char_feat, $type);
    echoScript("showHP ($char_feat[hp], $char_feat[hp_all], $char_feat[hp_regen]);".
               "showMP ($char_feat[mp], $char_feat[mp_all], $char_feat[mp_regen]);");
  }
  /*Получение одетых вещей*/
  function getCharacterEquipped ($char_equip, $char_feat, $type)
  {
    if (!$char_equip || !$char_feat)
      return;
    
    $backup = ($type == 'info' || $type == 'smart') ?"<img src='img/items/slot_bottom0.gif' border='0'>" :"<img src='img/items/w20.gif' border='0' alt='Пустой правый карман'><img src='img/items/w20.gif' border='0' alt='Пустой карман'><img src='img/items/w20.gif' border='0' alt='Пустой левый карман'><img src='img/items/w21.gif' border='0' alt='Смена оружия'><img src='img/items/w21.gif' border='0' alt='Смена оружия'><img src='img/items/w21.gif' border='0' alt='Смена оружия'>";
    $equipped = "<table border='0' width='227' class='posit' cellspacing='0' cellpadding='0'>";
    
    if ($type != 'smart' && $char_feat['block'])
      $equipped .= "<tr><td colspan='3' align='center'><b><font color='#FF0000'>Персонаж заблокирован!</font></b></td></tr>";
    
    $equipped .= "<tr bgColor='#dedede'>"
               . "<td width='60' align='left' valign='top'>"
               . $this->getItemEquiped($char_equip['helmet'], "helmet", $type)
               . $this->getItemEquiped($char_equip['bracer'], "bracer", $type)
               . $this->getItemEquiped($char_equip['hand_r'], "hand_r", $type)
               . $this->getItemEquiped($char_equip['armor'], "armor", $type)
               . $this->getItemEquiped($char_equip['belt'], "belt", $type)
               . "</td>"
               . "<td width='120' align='center' valign='middle'>"
               . "<table cellspacing='0' cellpadding='0' height='20'>"
               . "<tr><td style='font-size: 9px; position: relative;'>".(($type != 'smart') ?"<div id='HP'></div><div id='MP'></div>" :'')."</td></tr>"
               . "</table><img src='img/chars/$char_feat[shape]' $char_feat[name]><br>"
               . $backup
               . "</td>"
               . "<td width='60' align='right' valign='top'>"
               . $this->getItemEquiped($char_equip['earring'], "earring", $type)
               . $this->getItemEquiped($char_equip['amulet'], "amulet", $type)
               . $this->getItemEquiped($char_equip['ring1'], "ring", $type)
               . $this->getItemEquiped($char_equip['ring2'], "ring", $type)
               . $this->getItemEquiped($char_equip['ring3'], "ring", $type)
               . $this->getItemEquiped($char_equip['gloves'], "gloves", $type)
               . $this->getItemEquiped($char_equip['hand_l'], $char_equip['hand_l_s'], $type)
               . $this->getItemEquiped($char_equip['pants'], "pants", $type)
               . $this->getItemEquiped($char_equip['boots'], "boots", $type)
               . "</td></tr></table>";
    return $equipped;
  }
  /*Получение изображения предмета, одетого на персонажа*/
  function getItemEquiped ($item_id, $i_type, $type)
  {
    $lang = $this->getLang();
    $image = $this->db->selectRow("SELECT `width`, `height`, `default` FROM `server_images` WHERE `name` = ?s", 'item_'.$i_type);
    $default = "<img src='img/items/$image[default]' width='$image[width]' height='$image[height]' border='0' alt='".$lang[$i_type.'_f']."'>";
    
    if (!is_numeric($item_id) || $item_id == 0)
      return $default;
    
    $color = '';
    $img = $image['default'];
    $desc = $this->getItemAlt($item_id, $type, $color, $img);
    
    if (!$desc)
      return $default;
    
    $slot = $this->getItemSlot($item_id);
    $return_format = ($type == 'inv') ?"<a href='main.php?action=unwear_item&item_slot=$slot'>%s</a>" :"%s";
    return sprintf ($return_format, "<img src='img/items/$img' width='$image[width]' height='$image[height]' border='0' alt='$desc'$color>");
  }
  /*Получение всплывающей подсказки о предмете*/
  function getItemAlt ($item_id, $type, &$color = '', &$img = '')
  {
    if (!is_numeric($item_id) || $item_id == 0)
      return '';
    
    $lang = $this->getLang();
    $i_info = $this->db->selectRow("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                           `i`.`min_attack`, `i`.`max_attack`, 
                                           `i`.`name`, `i`.`img`, 
                                           `i`.`add_hp`, `i`.`add_mp`, 
                                           `i`.`def_h_min`, `i`.`def_h_max`, 
                                           `i`.`def_a_min`, `i`.`def_a_max`, 
                                           `i`.`def_b_min`, `i`.`def_b_max`, 
                                           `i`.`def_l_min`, `i`.`def_l_max` 
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_template` = `i`.`entry` 
                                    WHERE `c`.`guid` = ?d
                                      and `c`.`id` = ?d", $this->guid ,$item_id);
    if (!$i_info)
      return '';
    
    $img = $i_info['img'];
    $tear_check = ($i_info['tear_cur'] >= $i_info['tear_max'] * 0.90);
    $tear_show = ($tear_check) ?'<font color=#990000>%s</font>' :'%s';
    $color = ($tear_check) ?" class='broken'" :'';
    $name = (($type == 'inv') ?"Снять " :'').$i_info['name'];
    $protect = array ('h', 'a', 'b', 'l');
    $desc = "$name";
    
    if ($i_info['min_attack'] > 0 || $i_info['max_attack'] > 0)
      $desc .= "<br>$lang[damage] $i_info[min_attack] - $i_info[max_attack]";
    
    if ($i_info['add_hp'] > 0)      $desc .= "<br>$lang[add_hp] +".$i_info['add_hp'];
    else if ($i_info['add_hp'] < 0) $desc .= "<br>$lang[add_hp] ".$i_info['add_hp'];
    if ($i_info['add_mp'] > 0)      $desc .= "<br>$lang[add_mp] +".$i_info['add_mp'];
    else if ($i_info['add_mp'] < 0) $desc .= "<br>$lang[add_mp] ".$i_info['add_mp'];
    
    foreach ($protect as $key)
    {
      if ($i_info['def_'.$key.'_min'] > 0)
        $desc .= "<br>".$lang['def_'.$key]." ".$i_info['def_'.$key.'_min']."-".$i_info['def_'.$key.'_max']." ".$this->getFormatedBrick($i_info['def_'.$key.'_min'], $i_info['def_'.$key.'_max']);
    }
    $desc .= "<br>$lang[durability] ".sprintf ($tear_show, intval ($i_info['tear_cur'])."/".ceil ($i_info['tear_max']));
    return $desc;
  }
  /*Перечисление предметов нуждающихся в ремонте*/
  function needItemRepair ()
  {
    $rows = $this->db->select("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                       `i`.`name` 
                                FROM `character_inventory` AS `c` 
                                LEFT JOIN `item_template` AS `i` 
                                ON `c`.`item_template` = `i`.`entry` 
                                WHERE `c`.`guid` = ?d 
                                  and `c`.`wear` = '1';", $this->guid);
    $return = '';
    foreach ($rows as $repair)
    {
      list ($tear_cur, $tear_max, $name) = array_values ($repair);
      
      if ($tear_cur >= $tear_max * 0.90)
        $return .= "&nbsp;<b>$name</b> [<font color='#990000'>".intval ($tear_cur)."/".intval ($tear_max)."</font>] требуется ремонт<br>";
    }
    return $return;
  }
  /*Отображение предмета в инвентаре*/
  function showItem ($i_info, $mode, $i, $mail_guid = '')
  {
    $weapons = array ('knife', 'fail', 'sword', 'axe', 'staff');
    $armors = array ('boots' => '_l', 'light_armor' => '_a', 'heavy_armor' => '_a', 'helmet' => '_h', 'pants' => '_b');
    $types = array ('inv', 'sell', 'mail_to', 'mail_in');
    $lang = $this->getLang();
    $char_db = $this->getChar('char_db', 'money', 'money_euro', 'level', 'sex');
    $char_stats = $this->getChar('char_stats', 'trade', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'mp_all', 'sword', 'axe', 'fail', 'knife', 'staff', 'fire', 'water', 'air', 'earth');
    $char_feat = array_merge ($char_db, $char_stats);
    
    $money = $char_feat['money'];
    $money_euro = $char_feat['money_euro'];
    $trade = $char_feat['trade'];
    $entry = $i_info['entry'];
    $name = $i_info['name'];
    $img = $i_info['img'];
    $type = $i_info['type'];
    $mass = $i_info['mass'];
    $price = $i_info['price'];
    $price_euro = $i_info['price_euro'];
    if ($price_euro > 0)
    {
      $this->getBuyValue($price_euro);
      $price_s = (compare ($price_euro, $money_euro))." екр.";
    }
    else if ($price > 0)
    {
      $this->getBuyValue($price);
      $price_s = (compare ($price, $money))." кр.";
    }
    $item_flags = $i_info['item_flags'];
    $item_id = (isset($i_info['id'])) ?$i_info['id'] :0;
    $made_in = (isset($i_info['made_in'])) ?$this->char->city->getCity($i_info['made_in'], 'name') :'';
    $tear_cur = (isset($i_info['tear_cur'])) ?intval ($i_info['tear_cur']) :0;
    $tear_max = (isset($i_info['tear_max'])) ?ceil ($i_info['tear_max']) :$i_info['tear'];
    $color = ($tear_cur >= $tear_max * 0.9) ?" class='broken'" :"";
    $validity = (isset($i_info['date'])) ?$i_info['date'] :$i_info['validity'];
    $gift = (isset($i_info['gift'])) ?$i_info['gift'] :0;
    $gift_author = (isset($i_info['gift_author'])) ?$i_info['gift_author'] :'';
    $inc_count = (isset($i_info['inc_count_p'])) ?$i_info['inc_count_p'] :$i_info['inc_count'];
    $add['str'] = $i_info['add_str'] + ((isset($i_info['inc_str'])) ?$i_info['inc_str'] :0);
    $add['dex'] = $i_info['add_dex'] + ((isset($i_info['inc_dex'])) ?$i_info['inc_dex'] :0);
    $add['con'] = $i_info['add_con'] + ((isset($i_info['inc_con'])) ?$i_info['inc_con'] :0);
    $add['int'] = $i_info['add_int'] + ((isset($i_info['inc_int'])) ?$i_info['inc_int'] :0);
    $chet = ($i) ?"C7C7C7" :"D5D5D5";
    $return = "<div id='item_id_$item_id' name='item_entry_$entry'><table width='100%' border='0' cellspacing='1' cellpadding='0' bgColor='#a5a5a5' style='margin-top: -1px;'><tr bgColor='#$chet'>";
    switch ($mode)
    {
      case 'inv':
        $wearable = $this->checkItemStats($item_id);
        $return .= "<td width='150' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= ($wearable) ?"<a href='?action=wear_item&item_id=$item_id' class='nick'>надеть</a>&nbsp;" :"";
        $return .= "<a href=\"javascript:drop ($item_id, '$img', '$name');\"><img src='img/icon/clear.gif' width='14' height='14' border='0' alt='Выбросить предмет'></a>";
      break;
      case 'shop':
        $s_price = ($price_euro > 0) ?$price_euro :$price;
        $s_kr = ($price_euro > 0) ?"екр." :"кр.";
        $return .= "<td width='200' align='center'>";
        $return .= "<img src='img/items/$img' border='0' /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='javascript:buyItem ($entry);' class='nick'>купить</a>&nbsp;<img src='img/icon/plus.gif' width='11' height='11' border='0' alt='Купить несколько штук' style='cursor: pointer;' onclick=\"AddCount('$entry', '$name', '$s_price', '$s_kr')\"></center>";
      break;
      case 'sell':
        $s_price = getSellValue($i_info, true);
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='javascript:sellItem ($item_id);' onclick=\"if (confirm ('Вы уверены что хотите продать предмет $name за $s_price?')){return true;} else {return false;}\" class='nick'>продать за $s_price</a>";
      break;
      case 'mail_to':
        global $mail;
        $s_price = $mail -> getPrice($item_id)." кр.";
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=send_item&mail_to=$mail_guid&item_id=$item_id' onclick=\"if (confirm ('Отправить предмет $name?')){return true;} else {return false;}\" class='nick'>передать за $s_price</a>";
      break;
      case 'mail_in':
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=get_item&item_id=$item_id' onclick=\"if (confirm ('Забрать предмет $name?')){return true;} else {return false;}\" class='nick'>Забрать</a><br><a href='main.php?do=return_item&item_id=$item_id' onclick=\"if (confirm ('Отказаться от предмета $name?')){return true;} else {return false;}\" class='nick'>Отказаться</a>";
        $return .= "<br><small>(".getFormatedTime($i_info['delivery_time'] + 5184000).")</small>";
      break;
      case 'money_in':
        $name = sprintf ($name, $i_info['count']);
        $price_s = "$i_info[count] кр.";
        $mail_id = $i_info['id'];
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=get_money&mail_id=$mail_id' onclick=\"if (confirm ('Забрать $price_s?')){return true;} else {return false;}\" class='nick'>Забрать</a><br><a href='main.php?do=return_money&mail_id=$mail_id' onclick=\"if (confirm ('Отказаться от $price?')){return true;} else {return false;}\" class='nick'>Отказаться</a>";
        $return .= "<br><small>(".getFormatedTime($i_info['delivery_time'] + 5184000).")</small>";
      break;
    }
    $return .= "</td><td align='left' valign='top' style='padding: 2px;'>";
    $tear_show = compare ($tear_cur, $tear_max * 0.90, "$tear_cur/$tear_max");
    $required = array ('dex', 'con', 'int', 'level', 'fire', 'water', 'air', 'earth', 'sword', 'axe', 'fail', 'knife', 'staff', 'vit', 'str', 'mp_all', 'wis', 'sex');
    $modifiers = array ('mf_critpower', 'mf_anticrit', 'mf_antiuvorot', 'mf_piercearmor', 'mf_crit', 'mf_parry', 'mf_blockshield', 'mf_uvorot', 'mf_contr', 'repres_all_magic',
                        'repres_fire', 'repres_water', 'repres_air', 'repres_earth', 'mf_all_magic', 'mf_fire', 'mf_water', 'mf_air', 'mf_earth', 'mf_light', 'mf_gray', 
                        'mf_dark', 'mf_all_damage', 'mf_sting', 'mf_slash', 'mf_crush', 'mf_sharp', 'all_magic', 'fire', 'water', 'air', 'earth', 'light', 'gray', 
                        'dark', 'all_mastery', 'sword', 'axe', 'fail', 'knife', 'staff', 'shot', 'resist_all_magic', 'resist_fire', 'resist_water', 'resist_air', 
                        'resist_earth', 'resist_light', 'resist_gray', 'resist_dark', 'resist_all_damage', 'resist_sting', 'resist_slash', 'resist_crush', 'resist_sharp', 
                        'add_hp', 'add_mp', 'mpcons', 'mpreco', 'hpreco', 'add_attack_min', 'add_attack_max');
    $w_modifiers = array ('mf_antiuvorot', 'mf_crit', 'mf_critpower', 'mf_sting', 'mf_slash', 'mf_crush', 'mf_sharp', 'sword', 'axe', 'fail', 'knife', 'mf_piercearmor');
    $chances = array ('chance_sting', 'chance_slash', 'chance_crush', 'chance_sharp', 'chance_fire', 'chance_water', 'chance_air', 'chance_earth', 'chance_light', 'chance_dark');
    $features = array ('resist_all_damage', 'resist_sting', 'resist_slash', 'resist_crush', 'resist_sharp');
    $def = array (
      'h' => array ($i_info['def_h_min'], $i_info['def_h_max'], $this->getFormatedBrick($i_info['def_h_min'], $i_info['def_h_max'])),
      'a' => array ($i_info['def_a_min'], $i_info['def_a_max'], $this->getFormatedBrick($i_info['def_a_min'], $i_info['def_a_max'])),
      'b' => array ($i_info['def_b_min'], $i_info['def_b_max'], $this->getFormatedBrick($i_info['def_b_min'], $i_info['def_b_max'])),
      'l' => array ($i_info['def_l_min'], $i_info['def_l_max'], $this->getFormatedBrick($i_info['def_l_min'], $i_info['def_l_max']))
    );
    $min_attack = $i_info['min_attack'];
    $max_attack = $i_info['max_attack'];
    $block = $i_info['block'];
    $hands = $i_info['hands'];
    $url = str_replace ('.gif', '.html', $i_info['img']);
    $orden = "&nbsp;&nbsp;";
    $need_orden = $i_info['orden'];
    if ($need_orden != 0)
    {
      switch ($need_orden)
      {
        case 1: $orden_dis = "Белое братство";       break;
        case 2: $orden_dis = "Темное братство";      break;
        case 3: $orden_dis = "Нейтральное братство"; break;
        case 4: $orden_dis = "Алхимик";              break;
        case 5: $orden_dis = "Тюремный заключенный"; break;
      }
      $orden = "<img src='img/orden/align$need_orden.gif' border='0' alt='$lang[min_bent] <strong>$orden_dis</strong>'>";
    }
    $return .= "<a href='encicl/object/$url' class='nick' target='_blank'><b>$name</b></a>&nbsp;$orden&nbsp;($lang[mass] $mass)";
    
    if ($gift == 1)
      $return .= "&nbsp;<img src='img/icon/gift.gif' width='14' height='14' border='0' alt='$lang[gift] $gift_author'>";
    
    if ($item_flags & 4)
      $return .= "&nbsp;<img src='img/icon/artefakt.gif' width='16' height='16' border='0' alt='$lang[artefact]'>";
    
    if (isset($price_s))
      $return .= "<br><b>$lang[price] $price_s</b>";
    
    $return .= "<br>$lang[durability] $tear_show";
    
    if (($mode == 'inv' | $mode == 'sell') && $validity > 0) $return .= "<br>".sprintf ($lang['validity'], date ('d.m.y H:i', $validity), getFormatedTime($validity));
    else if ($mode == 'shop' && $validity > 0)               $return .= "<br>$lang[val_life] ".getFormatedTime($validity * 3600 + time ());
    
    $val = "";
    $require = "";
    foreach ($required as $key)
    {
      if (($key != 'sex' && $i_info['min_'.$key] <= 0) || ($key == 'sex' && $i_info[$key] == ''))
        continue;
      
      if (!$val)
        $val = "<br><b>$lang[required]</b>";
      
      if ($key != 'sex' && $i_info['min_'.$key] > 0) $require .= "<br>&bull; ".(compare ($i_info['min_'.$key], $char_feat[$key], "$lang[$key] {$i_info['min_'.$key]}"));
      else if ($key == 'sex' && $i_info[$key])       $require .= "<br>&bull; ".(compare ($i_info[$key], $char_feat[$key], "$lang[$key] ".$lang[$i_info[$key]]));
    }
    $return .= $val.$require;
    
    $val = "";
    if (($add['str'] != 0 || $add['dex'] != 0 || $add['con'] != 0 || $add['int'] != 0 
        || $i_info['def_h_max'] != 0 || $i_info['def_a_max'] != 0 || $i_info['def_b_max'] != 0 || $i_info['def_l_max'] != 0 || $inc_count > 0 
        || (!in_array ($type, $weapons) && ($max_attack != 0 || $min_attack != 0))))
      $val = "<br><b>$lang[act]</b>";
    
    $inc = ($inc_count > 0) ?"<br>&bull; $lang[inc_count] <span id='inc_count_$item_id'>$inc_count</span>" :"";
    $modifier = "";
    foreach ($modifiers as $key)
    {
      if ($i_info[$key] == 0)
        continue;
      
      if (!$val)
        $val = "<br><b>$lang[act]</b>";
      
      if ($i_info[$key] > 0)      $modifier .= "<br>&bull; $lang[$key] +".$i_info[$key];
      else if ($i_info[$key] < 0) $modifier .= "<br>&bull; $lang[$key] ".$i_info[$key];
    }
    $return .= $val.$inc.$modifier;
    foreach ($add as $key => $value)
    {
      if ($value == 0 && $mode == 'inv' && $inc_count > 0)    $return .= "<br>&bull; $lang[$key] <span id='inc_{$item_id}_{$key}_val'>$value</span> ".$this->getIncButton($item_id, $key);
      else if ($value > 0 && $mode == 'inv' && $inc_count > 0)$return .= "<br>&bull; $lang[$key] <span id='inc_{$item_id}_{$key}_val'>+$value</span> ".$this->getIncButton($item_id, $key);
      else if ($value > 0)                                    $return .= "<br>&bull; $lang[$key] +$value";
      else if ($value < 0)                                    $return .= "<br>&bull; $lang[$key] $value";
    }
    foreach ($def as $key)
    {
      if ($value[1] > 0)
        $return .= "<br>&bull; ".$lang['def_'.$key]." $value[0]-$value[1] $value[2]";
    }
    if (in_array ($type, $weapons))
    {
      $return .= "<br><b>$lang[behaviour]</b>";
      $return .= "<br>&bull; $lang[damage] $min_attack - $max_attack";
      foreach ($w_modifiers as $key)
      {
        if ($i_info[$key.'_h'] != 0)
          $return .= "<br>&bull; $lang[$key] ".$i_info[$key.'_h'];
      }
      
      if ($item_flags & 16) $return .= "<br>&bull; $lang[sec_hand]";
      else if ($hands == 2) $return .= "<br>&bull; $lang[two_hands]";
      
      $return .= "<br>&bull; $lang[blocks] ";
      
      if ($block == 1)      $return .= "+";
      else if ($block == 2) $return .= "++";
      else                  $return .= "-";
      
      $val = "";
      $chance = "";
      foreach ($chances as $key)
      {
        if ($i_info[$key] <= 0)
          continue;
        
        if (!$val)
          $val = "<br><b>$lang[features]</b>";
        
        $this->getFormatedChance($i_info[$key]);
        $chance .= "<br>&bull; $lang[$key] ".$lang[$i_info[$key]];
      }
      $return .= $val.$chance;
    }
    if (in_array ($type, array_keys ($armors)))
    {
      $val = "";
      $armor = "";
      foreach ($features as $key)
      {
        if ($i_info[$key.$armors[$type]] <= 0)
          continue;
        
        if (!$val)
          $val = "<br><b>$lang[features]</b>";
        
        $armor .= "<br>&bull; $lang[$key] ".$i_info[$key.$armors[$type]];
      }
      $return .= $val.$armor;
    }
    if ($i_info['description'])
      $return .= "<br><small>$lang[description]<br>$i_info[description]</small>";
    
    if ($made_in)
      $return .= "<br><small>$lang[made_in] $made_in</small>";
    
    if (!($item_flags & 2))
      $return .= "<br><small><font color='brown'>$lang[no_repair]</font></small>";
    
    $return .= "</td></tr></table></div>";
    return $return;
  }
  /*Получение отформатированного шанса*/
  private function getFormatedChance (&$chance)
  {
    if ($chance == 0)                    $chance = "never";
    if ($chance > 0 && $chance < 10)     $chance = "ex_rarely";
    if ($chance >= 10 && $chance < 20)   $chance = "rarely";
    if ($chance >= 20 && $chance < 26)   $chance = "little";
    if ($chance >= 26 && $chance < 60)   $chance = "naa";
    if ($chance >= 60 && $chance < 81)   $chance = "regular";
    if ($chance >= 81 && $chance < 91)   $chance = "often";
    if ($chance >= 91 && $chance <= 100) $chance = "always";
  }
  /*Получение отформатированного кубика*/
  private function getFormatedBrick ($min, $max)
  {
    $fist = $min - 1;
    $second = $max - $fist;
    if ($min == 1)    return "(d$second)";
    if ($min == $max) return '';
    if ($min <= 0)    return '';
                      return "($fist+d$second)";
  }
  /*Получение кнопки прибавления характеристик вещи*/
  private function getIncButton ($item_id, $stat)
  {
    return "<input type='image' id='inc_{$item_id}_btn' src='img/icon/plus.gif' style='border: 0px; vertical-align: bottom;' onclick=\"increaseItemStat ('$item_id', '$stat'); this.blur();\">";
  }
  /*Одеть/Снять предмет*/
  function equipItem ($item, $type = 1, $guid = 0)
  {
    $guid = (!$guid) ?$this->guid :$guid;
    $item_id = ($type == 1) ?$item :$this->getChar('char_equip', $item);
    
    if (!$item_id || $item_id == 0 || !is_numeric($item_id))
      return;
    
    $error_id = ($type == 1) ?213 :214;
    $wear_status = ($type == 1) ?0 :1;
    $char_equip = $this->getChar('char_equip', '*', $guid);
    $char_stats = $this->getChar('char_stats', '*', $guid);
    $i_info = $this->db->selectRow("SELECT * 
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_template` = `i`.`entry` 
                                    WHERE `c`.`guid` = ?d 
                                      and `c`.`id` = ?d 
                                      and `c`.`wear` = ?d 
                                      and `c`.`mailed` = '0' 
                                      and `i`.`section` = 'item';", $guid ,$item_id ,$wear_status) or $this->char->error->Inventory($error_id);
    $i_entry = $i_info['entry'];
    $i_id = $i_info['id'];
    $i_type = ($i_info['type'] == 'heavy_armor' || $i_info['type'] == 'light_armor') ?"armor" :$i_info['type'];
    $i_hands = $i_info['hands'];
    
    if ($type == 1)
    {
      switch ($i_type)
      {
        case 'sword':
        case 'axe':
        case 'fail':
        case 'staff':
        case 'knife':
          if ($i_hands == 1)
          {
            if ($char_equip['hand_r_free'])
              $slot = "hand_r";
            else if (!$char_equip['hand_r_free'] && $char_equip['hand_l_free'])
            {
              if ($i_info['item_flags'] & 16)
                $slot = "hand_l";
              else
              {
                $this->equipItem('hand_r', -1);
                $this->equipItem($i_id);
                return;
              }
            }
            else if (!$char_equip['hand_r_free'] && !$char_equip['hand_l_free'])
            {
              $this->equipItem('hand_r', -1);
              $this->equipItem($i_id);
              return;
            }
          }
          else if ($i_hands == 2)
          {
            if ($char_equip['hand_r_free'] && $char_equip['hand_l_free'])
              $slot = "hand_r";
            else if ($char_equip['hand_r_free'] && !$char_equip['hand_l_free'])
            {
              $this->equipItem('hand_l', -1);
              $this->equipItem($i_id);
              return;
            }
            else if (!$char_equip['hand_r_free'] && $char_equip['hand_l_free'])
            {
              $this->equipItem('hand_r', -1);
              $this->equipItem($i_id);
              return;
            }
            else if (!$char_equip['hand_r_free'] && !$char_equip['hand_l_free'])
            {
              $this->equipItem('hand_r', -1);
              $this->equipItem('hand_l', -1);
              $this->equipItem($i_id);
              return;
            }
          }
          $w_type = $i_type;
        break;
        case 'shield':
          if ($char_equip['hand_l_free'])
            $slot = "hand_l";
          else if ($char_equip['hand_l'])
          {
            $this->equipItem('hand_l', -1);
            $this->equipItem($i_id);
            return;
          }
          else if ($char_equip['hand_r'])
          {
            $this->equipItem('hand_r', -1);
            $this->equipItem($i_id);
            return;
          }
          $w_type = $i_type;
        break;
        case 'ring':
          if (!$char_equip['ring1'])
            $slot = "ring1";
          else if (!$char_equip['ring2'])
            $slot = "ring2";
          else if (!$char_equip['ring3'])
            $slot = "ring3";
          else
          {
            $this->equipItem('ring1', -1);
            $this->equipItem($i_id);
            return;
          }
        break;
        default:
          if (!$char_equip[$i_type])
            $slot = $i_type;
          else
          {
            $this->equipItem($i_type, -1);
            $this->equipItem($i_id);
            return;
          }
        break;
      }
    }
    else if ($type == -1)
    {
      unset ($char_equip['guid'], $char_equip['hand_r_free'], $char_equip['hand_r_type'], $char_equip['hand_l_free'], $char_equip['hand_l_type']);
      foreach ($char_equip as $key => $value)
      {
        if ($i_id == $value)
        {
          $slot = $key;
          break;
        }
      }
    }
    $new_sql = array ();
    $resists = array ('', '_h', '_a', '_b', '_l');
    $defs = array ('h', 'a', 'b', 'l');
// Resist damage
    foreach ($resists as $key)
    {
      $new_sql['resist_sting'.$key] = $i_info['resist_sting'.$key] + $i_info['resist_all_damage'.$key];
      $new_sql['resist_slash'.$key] = $i_info['resist_slash'.$key] + $i_info['resist_all_damage'.$key];
      $new_sql['resist_crush'.$key] = $i_info['resist_crush'.$key] + $i_info['resist_all_damage'.$key];
      $new_sql['resist_sharp'.$key] = $i_info['resist_sharp'.$key] + $i_info['resist_all_damage'.$key];
    }
    // -- magic
    $new_sql['resist_fire'] = $i_info['resist_fire'] + $i_info['resist_all_magic'];
    $new_sql['resist_water'] = $i_info['resist_water'] + $i_info['resist_all_magic'];
    $new_sql['resist_air'] = $i_info['resist_air'] + $i_info['resist_all_magic'];
    $new_sql['resist_earth'] = $i_info['resist_earth'] + $i_info['resist_all_magic'];
    $new_sql['resist_light'] = $i_info['resist_light'] + $i_info['resist_all_magic'];
    $new_sql['resist_gray'] = $i_info['resist_gray'] + $i_info['resist_all_magic'];
    $new_sql['resist_dark'] = $i_info['resist_dark'] + $i_info['resist_all_magic'];
// Mastery
    $new_sql['sword'] = $i_info['sword'] + $i_info['all_mastery'];
    $new_sql['axe'] = $i_info['axe'] + $i_info['all_mastery'];
    $new_sql['fail'] = $i_info['fail'] + $i_info['all_mastery'];
    $new_sql['knife'] = $i_info['knife'] + $i_info['all_mastery'];
    // --
    $new_sql['shot'] = $i_info['shot'];
    $new_sql['staff'] = $i_info['staff'];
    // -- magic
    $new_sql['fire'] = $i_info['fire'] + $i_info['all_magic'];
    $new_sql['water'] = $i_info['water'] + $i_info['all_magic'];
    $new_sql['air'] = $i_info['air'] + $i_info['all_magic'];
    $new_sql['earth'] = $i_info['earth'] + $i_info['all_magic'];
    $new_sql['light'] = $i_info['light'];
    $new_sql['gray'] = $i_info['gray'];
    $new_sql['dark'] = $i_info['dark'];
// MF damage
    $new_sql['mf_sting'] = $i_info['mf_sting'] + $i_info['mf_all_damage'];
    $new_sql['mf_slash'] = $i_info['mf_slash'] + $i_info['mf_all_damage'];
    $new_sql['mf_crush'] = $i_info['mf_crush'] + $i_info['mf_all_damage'];
    $new_sql['mf_sharp'] = $i_info['mf_sharp'] + $i_info['mf_all_damage'];
    // -- magic
    $new_sql['mf_fire'] = $i_info['mf_fire'] + $i_info['mf_all_magic'];
    $new_sql['mf_water'] = $i_info['mf_water'] + $i_info['mf_all_magic'];
    $new_sql['mf_air'] = $i_info['mf_air'] + $i_info['mf_all_magic'];
    $new_sql['mf_earth'] = $i_info['mf_earth'] + $i_info['mf_all_magic'];
    // --
    $new_sql['mf_crit'] = $i_info['mf_crit'];
    $new_sql['mf_critpower'] = $i_info['mf_critpower'];
    $new_sql['mf_antiuvorot'] = $i_info['mf_antiuvorot'];
    $new_sql['mf_piercearmor'] = $i_info['mf_piercearmor'];
    // --
    $new_sql['mf_anticrit'] = $i_info['mf_anticrit'];
    $new_sql['mf_uvorot'] = $i_info['mf_uvorot'];
    $new_sql['mf_contr'] = $i_info['mf_contr'];
    $new_sql['mf_parry'] = $i_info['mf_parry'];
    $new_sql['mf_blockshield'] = $i_info['mf_blockshield'];
// Damage
    $new_sql['wp_min'] = $i_info['add_attack_min'];
    $new_sql['wp_max'] = $i_info['add_attack_max'];
// Protect
    foreach ($defs as $key)
    {
      $new_sql['def_'.$key.'_min'] = $i_info['def_'.$key.'_min'];
      $new_sql['def_'.$key.'_max'] = $i_info['def_'.$key.'_max'];
    }
// Stats
    $new_sql['cast'] = $i_info['add_cast'];
    $new_sql['trade'] = $i_info['add_trade'];
    $new_sql['walk'] = $i_info['add_walk'];
    //$new_sql['cost'] = $i_info['price'];
    $new_sql['hp_regen'] = $i_info['hpreco'];
    $new_sql['mp_regen'] = $i_info['mpreco'];
// Hand
    switch ($slot)
    {
      case 'hand_r':
      case 'hand_l':
        $new_sql[$slot.'_sword'] = $i_info['sword_h'];
        $new_sql[$slot.'_axe'] = $i_info['axe_h'];
        $new_sql[$slot.'_fail'] = $i_info['fail_h'];
        $new_sql[$slot.'_knife'] = $i_info['knife_h'];
        $new_sql[$slot.'_sting'] = $i_info['mf_sting_h'] + $i_info['mf_all_damage_h'];
        $new_sql[$slot.'_slash'] = $i_info['mf_slash_h'] + $i_info['mf_all_damage_h'];
        $new_sql[$slot.'_crush'] = $i_info['mf_crush_h'] + $i_info['mf_all_damage_h'];
        $new_sql[$slot.'_sharp'] = $i_info['mf_sharp_h'] + $i_info['mf_all_damage_h'];
        $new_sql[$slot.'_crit'] = $i_info['mf_crit_h'];
        $new_sql[$slot.'_critpower'] = $i_info['mf_critpower_h'];
        $new_sql[$slot.'_antiuvorot'] = $i_info['mf_antiuvorot_h'];
        $new_sql[$slot.'_piercearmor'] = $i_info['mf_piercearmor_h'];
        $new_sql[$slot.'_hitmin'] = $i_info['min_attack'];
        $new_sql[$slot.'_hitmax'] = $i_info['max_attack'];
      break;
    }
// HP/MP
    $new_sql['hp_all'] = $i_info['add_hp'];
    $new_sql['mp_all'] = $i_info['add_mp'];
    
    foreach ($new_sql as $key => $value)
    {
      $new_sql[$key] = $value*$type;
      $new_sql[$key] += $char_stats[$key];
    }
    
    $char_hpmp = $this->getChar('char_stats', 'hp', 'mp', $guid);
    foreach ($char_hpmp as $key => $value)
    {
      if ($i_info['add_'.$key] != 0)
        $this->setTimeToHPMP($value, $new_sql[$key.'_all'], $char_stats[$key.'_regen'], $key);
    }
    
    $stats = array ('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0);
    foreach ($stats as $key => $value)
    {
      $stats[$key] = ($i_info['add_'.$key] + $i_info['inc_'.$key])*$type;
    }
    
    if ($type == 1)
    {
      $q1 = $this->db->query("UPDATE `character_inventory` 
                               SET `wear` = '1', 
                                   `last_update` = ?d 
                               WHERE `guid` = ?d 
                                 and `id` = ?d", time () ,$guid ,$i_id);
      $q2 = $this->db->query("UPDATE `character_equip` SET ?# = ?d WHERE `guid` = ?d", $slot ,$i_id ,$guid);
    }
    else if ($type == -1)
    {
      $q1 = $this->db->query("UPDATE `character_inventory` 
                               SET `wear` = '0', 
                                   `last_update` = ?d 
                               WHERE `guid` = ?d 
                                 and `id` = ?d", time () ,$guid ,$i_id);
      $q2 = $this->db->query("UPDATE `character_equip` SET ?# = '0' WHERE `guid` = ?d", $slot ,$guid);
    }
    if ($q1 && $q2)
    {
      $this->db->query("UPDATE `character_stats` SET ?a WHERE `guid` = ?d", $new_sql ,$guid);
      $this->changeStats($stats);
      if ($type == 1)
      {
        $this->changeMass(-$i_info['mass']);
        if ($i_hands == 2 && $slot == 'hand_r')
          $this->db->query("UPDATE `character_equip` 
                             SET `hand_r_type` = ?s, 
                                 `hand_r_free` = '0', 
                                 `hand_l_free` = '0' 
                             WHERE `guid` = ?d", $w_type ,$guid);
        else if ($i_hands == 1)
        {
          $this->db->query("UPDATE `character_equip` 
                             SET ?# = ?s, 
                                 ?# = '0' 
                             WHERE `guid` = ?d", $slot.'_type' ,$w_type ,$slot.'_free' ,$guid);
        }
      }
      else if ($type == -1)
      {
        $this->changeMass($i_info['mass']);
        if ($i_hands == 2 && $slot == 'hand_r')
          $this->db->query("UPDATE `character_equip` 
                             SET `hand_r_type` = 'phisic', 
                                 `hand_r_free` = '1', 
                                 `hand_l_free` = '1' 
                             WHERE `guid` = ?d", $guid);
        else if ($i_hands == 1)
        {
          $this->db->query("UPDATE `character_equip` 
                             SET ?# = 'phisic', 
                                 ?# = '1' 
                             WHERE `guid` = ?d", $slot.'_type' ,$slot.'_free' ,$guid);
        }
      }
    }
  }
  /*Снять все предметы*/
  function unWearAllItems ()
  {
    $char_equip = $this->getChar('char_equip', 'helmet', 'bracer', 'hand_r', 'armor', 'shirt', 'cloak', 'belt', 'earring', 'amulet', 'ring1', 'ring2', 'ring3', 'gloves', 'hand_l', 'pants', 'boots');
    foreach ($char_equip as $key => $value)
    {
      if ($value)
        $this->equipItem($key, -1);
    }
  }
  /*Получение слота в который одет предмет*/
  function getItemSlot ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return;
    
    $char_equip = $this->getChar('char_equip', 'helmet', 'bracer', 'hand_r', 'armor', 'shirt', 'cloak', 'belt', 'earring', 'amulet', 'ring1', 'ring2', 'ring3', 'gloves', 'hand_l', 'pants', 'boots');
    foreach ($char_equip as $key => $value)
    {
      if ($item_id == $value)
        return $key;
    }
    return;
  }
  /*Одевание комплекта предметов*/
  function equipSet ($name)
  {
    if ($name == '')
      $this->char->error->Inventory(221);
    
    $set = $this->db->selectRow("SELECT `helmet`, `bracer`, 
                                         `hand_r`, `armor`, 
                                         `shirt`, `cloak`, 
                                         `belt`, `earring`, 
                                         `amulet`, `ring1`, 
                                         `ring2`, `ring3`, 
                                         `gloves`, `hand_l`, 
                                         `pants`, `boots` 
                                  FROM `character_sets` 
                                  WHERE `guid` = ?d 
                                    and `name` = ?s", $this->guid ,$name) or $this->char->error->Inventory(221);
    foreach ($set as $slot => $item_id)
    {
      $item = $this->db->selectRow("SELECT `wear`, 
                                            `mailed` 
                                     FROM `character_inventory` 
                                     WHERE `guid` = ?d 
                                       and `id` = ?d", $this->guid ,$item_id);
      if (!$item || $item['mailed'])
        $this->db->query("UPDATE `character_sets` SET ?# = '0' WHERE `name` = ?s and `guid` = ?d", $slot ,$name ,$this->guid);
      else if ($item['wear'])
        continue;
      else
      {
        $this->equipItem($slot, -1);
        $this->equipItem($item_id);
      }
    }
    $this->char->error->Inventory();
  }
}
/*Функции города*/
class City extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Получение информации о комнате*/
  function getRoom ()
  {
    $args = func_get_args();
    $args_num = func_num_args();
    $room = $args[0];
    $city = $args[1];
    unset ($args[0], $args[1]);
    
    if ($args_num == 3)
      return $this->db->selectCell("SELECT ?# FROM `city_rooms` WHERE `room` = ?s and city = ?s", $args ,$room ,$city);
    else
      return $this->db->selectRow("SELECT ?# FROM `city_rooms` WHERE `room` = ?s and city = ?s", $args ,$room ,$city);
  }
  /*Получение времени до возможности перехода*/
  function getRoomGoTime (&$mtime)
  {
    $char_db = $this->getChar('char_db', 'last_go', 'room', 'city');
    $time_to_go = $this->getRoom($char_db['room'], $char_db['city'], 'time_to_go');
    
    if (!$time_to_go || !$char_db['room'])
      return;
    
    $mtime = ($time_to_go - (time () - $char_db['last_go']));
  }
  /*Получение кол-ва человек в комнате*/
  function getRoomOnline ($room, $type = 'full')
  {
    $city = $this->getChar('char_db', 'city');
    $online = $this->db->selectCell("SELECT COUNT(*) FROM `online` WHERE `room` = ?s", $room);
    $room_info = $this->getRoom($room, $city, 'name', 'time_to_go');
    
    if (!$room_info) return "Bug";
    switch ($type)
    {
      case 'full':   return "<strong>$room_info[name]</strong><br>Сейчас в комнате: $online";
      case 'map':    return $online;
      case 'mini':   return "Время перехода: $room_info[time_to_go] сек.<br>Сейчас в комнате: $online";
      default:       return "Bug";
    }
  }
  /*Получение информации о городе*/
  function getCity ()
  {
    $args = func_get_args();
    $args_num = func_num_args();
    $city = $args[0];
    unset ($args[0]);
    
    if ($args_num == 2)
      return $this->db->selectCell("SELECT ?# FROM `server_cities` WHERE city = ?s", $args ,$city);
    else
      return $this->db->selectRow("SELECT ?# FROM `server_cities` WHERE city = ?s", $args ,$city);
  }
}
/*Функции почты*/
class Mail extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Вычисление цены передачи предмета*/
  function getPrice ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return 0;
    
    $i_info = $this->db->selectRow("SELECT `i`.`price`, `i`.`mass`, 
                                            `c`.`tear_cur`, `c`.`tear_max`, 
                                            `i`.`tear` 
                                     FROM `character_inventory` AS `c` 
                                     LEFT JOIN `item_template` AS `i` 
                                     ON `c`.`item_template` = `i`.`entry` 
                                     WHERE `c`.`id` = ?d 
                                       and `c`.`guid` = ?d 
                                      and (`i`.`item_flags` & '1') 
                                       and `i`.`price_euro` = '0';", $item_id ,$this->guid);
    list ($price, $mass, $tear_cur, $tear_max, $max_tear) = array_values ($i_info);
    
    if (!$i_info)
      return 0;
    
    $cof = abs (100 - $mass * 1.5);
    $sell = round (($price / $cof), 2);
    
    if ($sell < 0.01)
      $sell = 0.01;
    
    return $sell;
  }
  /*Отправка денег*/
  function sendMoney ($mail_to, $send_money)
  {
    if ($send_money == 0 || !is_numeric($send_money))
      $this->char->error->Mail(325);
    
    if ($mail_to == 0 || !is_numeric($mail_to))
      $this->char->error->Mail(106, 'money');
    
    $mail_to = $this->getChar('char_db', 'guid', $mail_to);
    
    if (!$mail_to)
      $this->char->error->Mail(106, 'items');
    
    $transfers = $this->getChar('char_db', 'transfers');
    
    if ($transfers <= 0)
      $this->char->error->Mail(113, 'money');
    
    if ($send_money < 1)
      $this->char->error->Mail(410, 'money', 1);
    
    if (!($this->changeMoney(-$send_money)))
      $this->char->error->Mail(107);
    
    $send_money = round (0.95 * $send_money, 2);
    $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `count`, `delivery_time`, `date`) 
                       VALUES (?d, ?d, '1000', ?f, ?d, ?d)", $this->guid ,$mail_to ,$send_money ,time () ,time ());
    $this->char->history->mail('Send', "Деньги: $send_money кр", $_SERVER['REMOTE_ADDR'], $mail_to);
    $this->char->error->Mail(409, 'money', $send_money);
  }
  /*Получение/Возврат денег*/
  function getMoney ($mail_id, $type)
  {
    if ($mail_id == 0 || !is_numeric($mail_id))
      $this->char->error->Mail(112, 'get_mail');
    
    $m_info = $this->db->selectRow("SELECT `m`.`id`, 
                                            `m`.`sender`, 
                                            `i`.`name`, 
                                            `m`.`count` 
                                     FROM `city_mail_items` AS `m` 
                                     LEFT JOIN `item_template` AS `i` 
                                     ON `m`.`item_id` = `i`.`entry` 
                                     WHERE `m`.`to` = ?d 
                                       and `m`.`delivery_time` < ?d
                                       and `m`.`id` = ?d", $this->guid ,time (), $mail_id) or $this->char->error->Mail(112, 'get_mail');
    list ($mail_id, $sender, $name, $money_count) = array_values ($m_info);
    $name = sprintf ($name, $money_count);
    echoScript("top.menu.location.reload();");
    $this->db->query("DELETE FROM `city_mail_items` WHERE `id` = ?d", $mail_id);
    switch ($type)
    {
      case 'get_money':
        $this->Money (-$money_count);
        $this->char->history->mail('Receive', $name, $_SERVER['REMOTE_ADDR'], $sender);
        $this->char->error->Mail(407, 'get_mail', $name);
      break;
      case 'return_money':
        $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `count`, `delivery_time`, `date`) 
                           VALUES (?d, ?d, '1000', ?f, ?d, ?d)", $this->guid ,$sender ,$money_count ,time () ,time ());
        $this->char->history->mail('Return', $name, $_SERVER['REMOTE_ADDR'], $sender);
        $this->char->error->Mail(408, 'get_mail', $name);
      break;
    }
  }
  /*Отправка предмета*/
  function sendItem ($mail_to, $item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      $this->char->error->Mail(213, 'items');
    
    if ($mail_to == 0 || !is_numeric($mail_to))
      $this->char->error->Mail(106, 'items');
    
    if ($mail_to == $this->guid)
      $this->char->error->Mail(218);
    
    $mail_to = $this->getChar('char_db', 'guid', $mail_to);
    
    if (!$mail_to)
      $this->char->error->Mail(106, 'items');
    
    $transfers = $this->getChar('char_db', 'transfers');
    
    if ($transfers <= 0)
      $this->char->error->Mail(113, 'items');
    
    $i_info = $this->db->selectRow("SELECT `i`.`name`, 
                                            `i`.`mass` 
                                     FROM `character_inventory` AS `c` 
                                     LEFT JOIN `item_template` AS `i` 
                                     ON `c`.`item_template` = `i`.`entry` 
                                     WHERE `c`.`id` = ?d 
                                       and `c`.`guid` = ?d 
                                       and `c`.`wear` = '0' 
                                       and `c`.`mailed` = '0' 
                                       and `i`.`price_euro` = '0';", $item_id ,$this->guid) or $this->char->error->Mail(213, 'items');
    list ($i_name, $i_mass) = array_values ($i_info);
    $price = $this->getPrice($item_id);
    
    if (!($this->changeMoney(-$price)))
      $this->char->error->Mail(107);
    
    $delivery_time = 1800 + time ();
    $this->db->query("UPDATE `characters` SET `transfers` = `transfers` - '1' WHERE `guid` = ?d", $this->guid);
    $this->db->query("UPDATE `character_inventory` SET `mailed` = '1' WHERE `guid` = ?d and `id` = ?d", $this->guid ,$item_id);
    $this->changeMass(-$i_mass);
    $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `delivery_time`, `date`) 
                        VALUES (?d, ?d, ?d, ?d, ?d)", $this->guid ,$mail_to ,$item_id ,$delivery_time ,time ());
    $this->char->history->mail('Send', "$i_name ($price кр)", $_SERVER['REMOTE_ADDR'], $mail_to);
    $this->char->error->Mail(406, 'items', "$i_name|$price");
  }
  /*Получение/Возврат предмета*/
  function getItem ($item_id, $type)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      $this->char->error->Mail(112, 'get_mail');
    
    global $history;
    $i_info = $this->db->selectRow("SELECT `m`.`id`, 
                                            `m`.`sender`, 
                                            `i`.`name`, 
                                            `i`.`mass` 
                                     FROM `city_mail_items` AS `m` 
                                     LEFT JOIN `character_inventory` AS `c` 
                                     ON `m`.`item_id` = `c`.`id` 
                                     LEFT JOIN `item_template` AS `i` 
                                     ON `c`.`item_template` = `i`.`entry` 
                                     WHERE `m`.`to` = ?d 
                                       and `m`.`sender` = `c`.`guid` 
                                       and `m`.`item_id` = ?d 
                                       and `m`.`delivery_time` < ?d 
                                       and `c`.`mailed` = '1';", $this->guid ,$item_id ,time ()) or $this->char->error->Mail(112, 'get_mail');
    list ($mail_id, $sender, $i_name, $i_mass) = array_values ($i_info);
    $this->db->query("DELETE FROM `city_mail_items` WHERE `id` = ?d", $mail_id);
    echoScript("top.menu.location.reload();");
    switch ($type)
    {
      case 'get_item':
        $this->db->query("UPDATE `character_inventory` SET `mailed` = '0', `guid` = ?d, `last_update` = ?d WHERE `guid` = ?d and `id` = ?d", $this->guid ,time () ,$sender ,$item_id);
        $this->changeMass($i_mass);
        $this->char->history->mail('Receive', $i_name, $_SERVER['REMOTE_ADDR'], $sender);
        $this->char->error->Mail(407, 'get_mail', $i_name);
      break;
      case 'return_item':
        $delivery_time = 1800 + time ();
        $this->db->query("UPDATE `character_inventory` SET `mailed` = '1' WHERE `guid` = ?d and `id` = ?d", $sender ,$item_id);
        $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `delivery_time`, `date`) 
                            VALUES (?d, ?d, ?d, ?d, ?d)", $this->guid ,$sender ,$item_id ,$delivery_time ,time ());
        $this->char->history->mail('Return', $i_name, $_SERVER['REMOTE_ADDR'], $sender);
        $this->char->error->Mail(408, 'get_mail', $i_name);
      break;
    }
  }
}
/*Функции банка*/
class Bank extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Начало работы с банковским счетом*/
  function Login ($id, $pass)
  {
    $seek = $this->db->selectRow("SELECT `guid`, 
                                          `password` 
                                   FROM `character_bank` 
                                   WHERE `id` = ?d", $id);
    if (!$seek)
      return 303;
    
    if ($this->guid != $seek['guid'])
      return 322;
        
    if (SHA1 ($id.':'.$pass) != $seek['password'])
      return 302;
    
    $_SESSION['bankСredit'] = $id;
    return 0;
  }
  /*Конец работы с банковским счетом*/
  function unLogin ()
  {
    unset ($_SESSION['bankСredit']);
  }
  /*Увеличение/уменьшение денег в банке у персонажа*/
  function bMoney ($sum, $id, $type = '', $guid = 0)
  {
    if ($id == 0 || !is_numeric($sum) || !is_numeric($id))
      $this->char->error->Map(326);
    
    $sum = round ($sum, 2);
    
    if ($sum == 0)
      $this->char->error->Map(325);
    
    $guid = (!$guid) ?$this->guid :$guid;
    switch ($type)
    {
      case 'euro':
        $money = $this->db->selectCell("SELECT `euro` FROM `character_bank` WHERE `id` = ?d and `guid` = ?d", $id ,$guid);

        if (($money = $money - $sum) < 0)
          $this->char->error->Map(310, $sum);
        
        $this->db->query("UPDATE `character_bank` SET `euro` = ?f WHERE `id` = ?d and `guid` = ?d", $money ,$id ,$guid);
      break;
      default:
        $money = $this->db->selectCell("SELECT `cash` FROM `character_bank` WHERE `id` = ?d and `guid` = ?d", $id ,$guid);

        if (($money = $money - $sum) < 0)
          $this->char->error->Map(305, $sum);
        
        $this->db->query("UPDATE `character_bank` SET `cash` = ?f WHERE `id` = ?d and `guid` = ?d", $money ,$id ,$guid);
      break;
    }
    return true;
  }
}
/*Функции чата*/
class Chat extends Char
{
  public $db;
  public $char;
  function Init ($object)
  {
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Отправка сообщения в чат*/
  function say ($to, $text, $sender = '')
  {
    $char_db = $this->getChar('char_db', 'login', 'room', 'city', $to);
    
    if ($sender == '')
      $class = "sys";
    else
    {
      $class = "private";
      $text = "private [$char_db[login]] $text</font>";
    }
    
    $this->db->query("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                      VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $sender ,$char_db['login'] ,$char_db['room'] ,$text ,$class ,time () ,$char_db['city']);
    echoScript("if(top.msg.updateMessages()) top.msg.updateMessages();");
  }
  /*Выполнение комманд в чате*/
  function executeCommand ($name, $message, $guid)
  {
    $char_db = $this->getChar('char_db', 'afk', 'login', 'room', 'city', $guid);
    switch ($name)
    {
      case '/afk':
        $message = str_replace ('/afk', '', $message);
        
        if (isset($message[0]) && $message[0] != ' ')
          return false;
        
        $message = (isset($message[1])) ?preg_replace ("/ /", "", $message, 1) :'away from keyboard';
        $this->db->query("UPDATE `characters` SET `afk` = '1', `dnd` = '0', `message` = ?s WHERE `guid` = ?d", $message ,$guid);
        return true;
      break;
      case '/dnd':
        $message = str_replace ('/dnd', '', $message);
        
        if ($message == '' || (isset($message[0]) && $message[0] != ' ') || !isset($message[1]))
          return false;
        
        $this->db->query("UPDATE `characters` SET `afk` = '0', `dnd` = '1', `message` = ?s WHERE `guid` = ?d", $message ,$guid);
        return true;
      break;
        case '/e':
          $emotion = str_replace ('/e', '', $message);
          
          if ($emotion == '' || (isset($emotion[0]) && $emotion[0] != ' ') || !isset($emotion[1]))
            return false;
          
          $this->db->query("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                             VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $char_db['login'] ,'' ,$char_db['room'] ,$emotion ,'emotion' ,time () ,$char_db['city']);
          return true;
        break;
        default:
          return false;
        break;
    }
  }
}
/*Функции информации*/
class Info extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Показ дополнительной информации по персонажу*/
  function showInfDetail ($guid)
  {
    $char_db = $this->getChar('char_db', 'block', 'block_reason', 'shut', 'prision', 'prision_reason', 'travm', 'travm_var', $guid);
    /*Блок*/
    if ($char_db['block'] && $char_db['block_reason'])
      echo "Причина блока :<br><b><font class='private'>$char_db[block_reason]</font></b><br>";
    /*Молчанка*/
    if ($char_db['shut'] != 0)
      echo "<img src='img/icon/sleeps0.gif'><small>На персонажа наложено заклятие молчания. Будет молчать еще ".getFormatedTime($char_db['shut'])."</small><br>";
    /*Тюрьма*/
    if ($char_db['prision'] != 0)
    {
      echo "<small>Персонаж находиться под стражей еще ".getFormatedTime($char_db['prision'])."</small><br>";
      if ($char_db['prision_reason'] != "")
        echo "Причина тюремного заключения :<br><b><font class='private'>$char_db[prision_reason]</font></b><br>";
    }
    /*Травма*/
    if ($char_db['travm'] != 0)
    {
      switch ($char_db['travm_var'])
      {
        case 1: $travm_var = "легкая травма";  break;
        case 2: $travm_var = "средняя травма"; break;
        case 3: $travm_var = "тяжелая травма"; break;
      }
      echo "<img src='img/icon/travma2.gif'><small>У персонажа $travm_var, еще ".getFormatedTime($char_db['travm'])."</small>";
    }
  }
  /*Показ строки персонажа*/
  function character ($type = 'clan', $guid = 0)
  {
    $guid = (!$guid) ?$this->guid :$guid;
    $char_db = $this->getChar('char_db', 'login', 'level', 'orden', 'clan', 'clan_short', 'block', 'rang', 'shut', 'afk', 'dnd', 'message', 'travm', $guid);
    list ($login, $level, $orden, $clan_f, $clan_s, $block, $rang, $shut, $afk, $dnd, $message, $travm) = array_values ($char_db);
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
    $login_link = str_replace (" ", "%20", $login);
    $login_info = "<a href='info.php?log=$login_link' target='_blank'><img src='img/inf.gif' border='0' title='Инф. о $login'></a>";
    $mol = ($shut != 0) ?" <img src='img/sleep2.gif' title='Наложено заклятие молчания'>" :"&nbsp";
    $travm = ($travm != 0) ?"<img src='img/travma2.gif' title='Инвалидность'>" :"&nbsp";
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
      case 'info':   return "<img src='img/icon/lock3.gif' border='0' onclick=window.opener.top.AddToPrivate('$login',true); style='cursor: pointer;'> $orden_img$clan<b>$login</b> [$level]$login_info";
      case 'mail':   return "<font color='red'>$login</font> $login_info";
      default:       return "";
    }
  }
  /*Вывод списка профессионалов*/
  function showArch ($f_style)
  {
    $rows = $this->db->selectCol("SELECT `guid` FROM `characters` WHERE `f_style` = ?s ORDER BY `exp` DESC LIMIT 5", $f_style);
    if (count ($rows) == 0)
      return "Нет таких бойцов.";
    
    foreach ($rows as $num => $char)
      return $this->character('clan', $char)."<br>";
    return "";
  }
}
/*Функции истории*/
class History extends Char
{
  public $guid;
  public $db;
  public $char;
  function Init ($object)
  {
    $this->guid = $object->guid;
    $this->db = $object->db;
    $this->char = $object;
  }
  /*История регистрации/авторизации персонажа*/
  function authorization ($action, $city, $comment = '')
  {
    $this->db->query("INSERT INTO `history_auth` (`guid`, `action`, `ip`, `city`, `comment`, `date`) 
                       VALUES (?d, ?d, ?s, ?s, ?s, ?d);", $this->guid ,$action ,$_SERVER['REMOTE_ADDR'] ,$city ,$comment ,time ());
  }
  /*История покупки/продажи/передачи предмета*/
  function transfers ($action, $val, $ip, $to)
  {
    $this->db->query("INSERT INTO `history_transfers` (`guid`, `receive`, `action`, `item`, `ip`, `date`)
                       VALUES (?d, ?s, ?s, ?s, ?s, ?d)", $this->guid ,$to ,$action ,$val ,$ip ,time ());
  }
  /*История отправки/получения/возврата предмета по почте*/
  function mail ($action, $val, $ip, $to)
  {
    $this->db->query("INSERT INTO `history_mail` (`guid`, `receive`, `action`, `item`, `ip`, `date`)
                       VALUES (?d, ?s, ?s, ?s, ?s, ?d)", $this->guid ,$to ,$action ,$val ,$ip ,time ());
  }
  /*История банковских операций*/
  function bank ($id, $credit2, $cash, $euro, $operation)
  {
    $this->db->query("INSERT INTO `history_bank` (`credit`, `credit2`, `cash`, `euro`, `operation`, `date`) 
                       VALUES (?d, ?d, ?f, ?f, ?d, ?d)", $id ,$credit2 ,$cash ,$euro ,$operation ,time ());
  }
}
/*Функции ошибок*/
class Error extends Char
{
  public $db;
  public $char;
  function Init ($object)
  {
    $this->db = $object->db;
    $this->char = $object;
  }
  /*Вывод ошибки в инвентаре*/
  function Inventory ($id = 0, $parameters = '')
  {
    echoScript("location.href = 'main.php?action=inv&error=$id&parameters=$parameters';", true);
  }
  /*Вывод ошибки в разделе "Анкета"*/
  function Form ($id, $do, $parameters = '')
  {
    echoScript("location.href = 'main.php?action=form&do=$do&error=$id&parameters=$parameters';", true);
  }
  /*Вывод ошибки на карте*/
  function Map ($id = 0, $parameters = '')
  {
    echoScript("location.href = 'main.php?error=$id&parameters=$parameters';", true);
  }
  /*Вывод ошибки на почте*/
  function Mail ($id = 0, $do, $parameters = '')
  {
    echoScript("location.href = 'main.php?do=$do&error=$id&parameters=$parameters';", true);
  }
  /*Оформление вида ошибки*/
  function getFormattedError ($id, $parameters, $needBr = false)
  {
    if (!$id)
      return;
    
    $err_text = "";
    $parametr = array ();
    
    if ($parameters)
      $parametr = split ("\|", $parameters);
    
    $err = $this->db->selectRow("SELECT `text`, 
                                         `bold`, 
                                         `hyphen` 
                                  FROM `server_errors` 
                                  WHERE `id` = ?d", $id);
    if (!$err)
      return;
    
    list ($err_text, $err_bold, $err_hyph) = array_values ($err);
    
    if ($err_bold)
      $err_text = "<b>$err_text</b>";
    
    if ($err_hyph || $needBr)
      $err_text = "$err_text<br>";
    
    vprintf ($err_text, $parametr);
  }
}

/*Вывод js скрипта*/
function echoScript ($str, $die = false)
{
  echo "<script>$str</script>";
  if ($die)
    die();
}
/*Преобразование массива в переменные*/
function ArrToVar ($arr, $pref = '')
{
  foreach ($arr as $key => $value)
  {
    $var = ($pref != '') ?$pref.$key :$key;
    global ${$var};
    ${$var} = $value;
  }
}
/*Получение полосы загрузки*/
function getUpdateBar ()
{
  $return = "<table width='80' border='0' cellspacing='0' cellpadding='0'>"
          . "<tr>"
          . "<td><a href='javascript:location.reload();'><img src='img/room/rel_1.png' width='15' height='16' alt='Обновить' border='0' /></a></td>"
          . "<td>"
          . "<table width='80' border='0' cellspacing='0' cellpadding='0'>"
          . "<tr><td colspan='3' align='center'><img src='img/navigatin_462s.gif' width='80' height='3' /></td></tr>"
          . "<tr width='80'>"
          . "<td><img src='img/navigatin_481.gif' width='9' height='8' /></td>"
          . "<td width='100%' bgcolor='#000000' nowrap><div id='prcont' align='center' style='font-size: 4px; padding: 0px; border: solid black 0px; text-align: center;'>";
  for ($i = 1; $i <= 32; $i++)
  {
    $return .= "<span id='progress$i' style='background-color: #00CC00;'>&nbsp;</span>";
    if ($i < 32)
      $return .= "&nbsp;";
  }
  $return .= "</div></td>"
          . "<td><img src='img/navigatin_50s.gif' width='7' height='8' /></td>"
          . "</tr>"
          . "<tr><td colspan='3'><img src='img/navigatin_tt1_532.gif' width='80' height='5' /></td></tr>"
          . "</table></td></tr></table>";
  return print $return;
}
/*Вычисление цены продажи предмета*/
function getSellValue ($i_info, $text = false)
{
  if (!$i_info)
    return 0;
  
  $price = ($i_info['price_euro'] > 0) ?$i_info['price_euro'] :$i_info['price'];
  $tmax_diff = ($i_info['tear_max'] < $i_info['tear']) ?$price*0.7*(1 - $i_info['tear_max']/$i_info['tear']) :0;
  $price_diff = $price*0.7 - $tmax_diff;
  $tear_diff = ($i_info['tear_cur'] > 0) ?$price_diff*($i_info['tear_cur']/$i_info['tear_max']) :0;
  $sell_price = $price*0.75 - $tmax_diff - $tear_diff;
  $sell_price = round ($sell_price, 2);
  
  if ($sell_price < 0.01)
    $sell_price = 0.01;
  
  $sell_price = ($text) ?(($i_info['price_euro'] > 0) ?$sell_price." екр." :$sell_price." кр.") :$sell_price;
  return $sell_price;
}
/*Получение времени восстановления здоровья*/
function getCureValue ($now, $all, $regen, &$value)
{
  $value = intval (((($all - $now) / ($all * 0.01)) * 10) / ($regen * 0.01)) + time ();
}
/*Получение количества восстановленного здоровья*/
function getRegeneratedValue ($all, $cure, $regen)
{
  return $all - intval ((($cure * ($regen * 0.01)) / 10) * ($all * 0.01));
}
/*Получение отформатированного времени*/
function getFormatedTime ($timestamp)
{
  if (!$timestamp)
    return "Вечность";
  
  if (!is_numeric($timestamp))
    $timestamp = time();
  
  $seconds = abs ($timestamp - time());
  $d = intval ($seconds / 86400);
  $seconds %= 86400;
  $h = intval ($seconds / 3600);
  $seconds %= 3600;
  $m = intval ($seconds / 60);
  $seconds %= 60;
  $s = $seconds;
  
  if ($d && $h == 0) return "$d дн.";
  if ($d)            return "$d дн. $h ч.";
  if ($h && $m == 0) return "$h ч.";
  if ($h)            return "$h ч. $m мин.";
  if ($m && $s == 0) return "$m мин.";
  if ($m)            return "$m мин. $s сек.";
                     return "$s сек.";
}
/*Перевод в float*/
function getMoney ($money)
{
  return sprintf ("%01.2f", $money);
}
/*Внедрение пробела*/
function getExp ($exp)
{
  return number_format ($exp, 0, "", " ");
}
/*Получение цвета улучшения*/
function getStatSkillColor ($cur, $add)
{
  $diff = ($add > 0) ?(1 - (($cur - $add) / $cur)) * 255 :($add < 0) ?(1 -(($cur - $add*(-1)) / $cur)) * 255 :-50;
  $diff = abs (intval ($diff)) + 50;
  
  if ($diff > 150 && $add > 0) return "#00AA00";
  if ($diff > 150 && $add < 0) return "#AA0000";
  if ($add > 0)                return "RGB(0, $diff, 0)";
  if ($add < 0)                return "RGB($diff, 0, 0)";
                               return "RGB(0, 0, 0)";
}
/*Получение разбивки статов*/
function getBraces ($stat, $added_stat, $type = '')
{
  if ($added_stat > 0) return "&nbsp;<small>(<font id='inst_$type'>".($stat-$added_stat)."</font> + $added_stat)</small>";
  if ($added_stat < 0) return "&nbsp;<small>(<font id='inst_$type'>".($stat-$added_stat)."</font> - ".abs ($added_stat).")</small>";
}
/*Сравнение двух переменных*/
function compare ($var1, $var2, $var3 = 0)
{
  $format = '%1$s';
  if (is_numeric ($var1) && is_numeric ($var2))
    $format = ($var1 > $var2) ?"<font color=\"#FF0000\">$format</font>" :$format;
  else if (is_string ($var1) && is_string ($var2))
    $format = ($var1 != $var2) ?"<font color=\"#FF0000\">$format</font>" :$format;
  $text = ($var3) ?$var3 :$var1;
  return sprintf ($format, $text);
}
/*UTF-8 размер строки*/
function utf8_strlen ($s)
{
  return preg_match_all('/./u', $s, $tmp);
}
/*UTF-8 сокращение строки*/
function utf8_substr ($s, $offset, $len = 'all')
{
  if ($offset < 0)
    $offset = $char -> utf8_strlen($s) + $offset;
  
  if ($len != 'all')
  {
    if ($len < 0)
      $len = utf8_strlen($s) - $offset + $len;
    
    $xlen = utf8_strlen($s) - $offset;
    $len = ($len > $xlen) ?$xlen :$len;
    preg_match ('/^.{' . $offset . '}(.{0,'.$len.'})/us', $s, $tmp);
  }
  else
    preg_match ('/^.{' . $offset . '}(.*)/us', $s, $tmp);
  return (isset($tmp[1])) ?$tmp[1] :false;
}
/*Экранирование запроса LIKE*/
function escapeLike ($s)
{
  return "%" . str_replace (array("'", '"', "%", "_"), array("\'", '\"', "", ""), $s) . "%";
}
/*Error log function*/
function databaseErrorHandler ($message, $info)
{
  if (!error_reporting())
    return;
  
  echo "<table class = report>";
  echo "<tbody>";
  echo "<tr><td>SQL Error: $message<br><pre>".print_r($info, true)."</pre></td></tr>";
  echo "</tbody>";
  echo "</table>";
}
/*Получение переменной GET, POST и COOKIE*/
function requestVar ($var, $stand = '', $flags = 3)
{
  if (isset($_GET[$var]) && ($flags & 1))
    $value = $_GET[$var];
  else if (isset($_POST[$var]) && ($flags & 2))
    $value = $_POST[$var];
  else if (isset($_COOKIE[$var]) && ($flags & 4))
    $value = $_COOKIE[$var];
  else
    return $stand;

  if (is_numeric ($stand) && is_numeric ($value)) return ($flags & 8) ?round ($value, 2) :$value;
  else if (!is_numeric ($stand))                  return htmlspecialchars ($value);
  else                                            return $stand;
}
/*Преобразование русско-язычной строки в нижний и верхний регистр*/
define('UPCASE', 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯABCDEFGHIKLMNOPQRSTUVWXYZ');
define('LOCASE', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяabcdefghiklmnopqrstuvwxyz');

function mb_str_split ($str)
{        
    preg_match_all ('/.{1}|[^\x00]{1}$/us', $str, $ar);
    return $ar[0];
}
function mb_strtr ($str, $from, $to)
{
  return str_replace (mb_str_split($from), mb_str_split($to), $str);
}
function lowercase ($arg = '')
{
  return mb_strtr($arg, UPCASE, LOCASE);
}
function uppercase ($arg = '')
{
  return mb_strtr($arg, LOCASE, UPCASE);
}
/*Возврат значения ajax запроса*/
function returnAjax ()
{
  $args = func_get_args();
  $str = implode ('A_D', $args);
  die ($str);
}
/*Получение место перехода*/
function getError ($type = 'main', $loc = '')
{
  switch ($type)
  {
    case 'main':  return "top.location.href = '{$loc}index.php';";
    case 'game':  return "location.href = '{$loc}index.php';";
    case 'ajax':  return "ajax_error";
  }
}
/*Получение guid персонажа*/
function getGuid ($type = 'main', $loc = '')
{
  if (empty($_SESSION['guid']))
    echoScript(getError($type, $loc), true);
  
  return $_SESSION['guid'];
}
?>