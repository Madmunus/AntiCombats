<?
defined('AntiBK') or die("Доступ запрещен!");

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
  /*Вычисление цены продажи предмета*/
  function getSellValue ($i_info, $text = false)
  {
    if (!$i_info)
      return 0;
    
    $price = ($i_info['price_euro'] > 0) ?$i_info['price_euro'] :$i_info['price'];
    $tmax_diff = ($i_info['tear_max'] < $i_info['tear']) ?$price * 0.7 * (1 - $i_info['tear_max'] / $i_info['tear']) :0;
    $price_diff = $price * 0.7 - $tmax_diff;
    $tear_diff = ($i_info['tear_cur'] > 0) ?$price_diff * ($i_info['tear_cur'] / $i_info['tear_max']) :0;
    $sell_price = $price * 0.75 - $tmax_diff - $tear_diff;
    $sell_price = rdf($sell_price);
    
    if ($sell_price < 0.01)
      $sell_price = 0.01;
    
    $sell_price = ($text) ?$sell_price." кр." :$sell_price;
    return $sell_price;
  }
  /*Проверка характеристик предмета и персонажа*/
  function checkItemStats ($item_id)
  {
    if (checki($item_id))
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
                                 ON `c`.`item_entry` = `i`.`entry` 
                                 WHERE `c`.`guid` = ?d
                                   and `c`.`id` = ?d", $this->guid ,$item_id);
    $char_db = $this->getChar('char_db', 'level', 'sex', 'orden');
    $char_stats = $this->getChar('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'mp_all', 'sword', 'axe', 'fail', 'knife', 'staff', 'fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
    $char_feat = array_merge($char_db, $char_stats);
    foreach ($char_feat as $key => $value)
    {
      if ($key != 'sex' && $key != 'orden' && $value < $dat['min_'.$key])   return false;
      if ($key == 'sex' && $dat['sex'] != '' && $value != $dat['sex'])      return false;
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
    if (checki($item_id))
      return false;
    
    $date = $this->db->selectCell("SELECT `date` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d", $this->guid ,$item_id);
    
    if ($date != 0 && $date < time())
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
  /*Отображение снаряжения*/
  function showCharacter ($type = '', $guid = 0)
  {
    $guid = $this->getGuid($guid);
    $char_equip = $this->getChar('char_equip', '*', $guid);
    $char_db = $this->getChar('char_db', 'level', 'login', 'shape', $guid);
    $char_stats = $this->getChar('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'spi', 'hp', 'hp_all', 'hp_regen', 'mp', 'mp_all', 'mp_regen', $guid);
    $char_feat = array_merge($char_db, $char_stats);
    $lang = $this->getLang();
    $char_type = 'clan';
    switch ($type)
    {
      case 'inv':
        $char_feat['name'] = "alt='$char_feat[login] (Перейти в \"$lang[abilities]\")' id='link' link='skills'";
      break;
      case 'fight':
        global $behaviour;
        $char_feat['name'] = "alt='<b>$char_feat[login]</b>";
        foreach ($behaviour as $key => $min_level)
          $char_feat['name'] .= ($char_feat['level'] >= $min_level) ?"<br>$lang[$key] $char_feat[$key]" :"";
        $char_feat['name'] .= "'";
      break;
      default:
        $char_feat['name'] = "alt='$char_feat[login] (Перейти в \"Инвентарь\")' id='link' link='inv'";
      break;
    }
    $char_equip['armor'] = ($char_equip['cloak']) ?$char_equip['cloak'] :(($char_equip['armor']) ?$char_equip['armor'] :$char_equip['shirt']);
    $char_equip['hand_l_s'] = (!$char_equip['hand_l_free']) ?"hand_l" :"hand_l_f";
    
    echo $this->getLogin($char_type, $guid);
    echo $this->getCharacterEquipped($char_equip, $char_feat, $type, $guid);
    if ($type != 'smart')
      echoScript("showHP($char_feat[hp], $char_feat[hp_all], $char_feat[hp_regen]);".
                 "showMP($char_feat[mp], $char_feat[mp_all], $char_feat[mp_regen]);");
  }
  /*Получение одетых вещей*/
  function getCharacterEquipped ($char_equip, $char_feat, $type, $guid = 0)
  {
    if (!$char_equip || !$char_feat)
      return;
    
    $guid = $this->getGuid($guid);
    $backup = ($type == 'smart') ?"<img src='../img/items/slot_bottom0.gif' border='0'>" :"<img src='../img/items/w20.gif' border='0' alt='Пустой правый карман'><img src='../img/items/w20.gif' border='0' alt='Пустой карман'><img src='../img/items/w20.gif' border='0' alt='Пустой левый карман'><br><img src='../img/items/w21.gif' border='0' alt='Смена оружия'><img src='../img/items/w21.gif' border='0' alt='Смена оружия'><img src='../img/items/w21.gif' border='0' alt='Смена оружия'>";
    $effects = $this->getEffects($type, $guid);
    $equipped = "<table border='0' width='227' class='posit' cellspacing='0' cellpadding='0'>"
              . "<tr bgColor='#dedede'>"
              . "<td width='60' align='left' valign='top'>"
              . $this->getItemEquiped($char_equip['helmet'], "helmet", $type, $guid)
              . $this->getItemEquiped($char_equip['bracer'], "bracer", $type, $guid)
              . $this->getItemEquiped($char_equip['hand_r'], "hand_r", $type, $guid)
              . $this->getItemEquiped($char_equip['armor'], "armor", $type, $guid)
              . $this->getItemEquiped($char_equip['belt'], "belt", $type, $guid)
              . "</td>"
              . "<td width='120' height='220' align='center' valign='middle'><table cellspacing='0' cellpadding='0'>"
              . "<tr height='20'><td style='font-size: 9px; position: relative;'>".(($type != 'smart') ?"<div id='HP'></div><div id='MP'></div>" :'')."</td></tr>"
              . "<tr height='220'><td><div style='position: relative; z-index: 1; width: 120px; height: 220px;'><img src='../img/chars/$char_feat[shape]' $char_feat[name]>$effects</div></td></tr>"
              . "<tr height='40'><td>$backup</td></tr>"
              . "</table></td>"
              . "<td width='60' align='right' valign='top'>"
              . $this->getItemEquiped($char_equip['earring'], "earring", $type, $guid)
              . $this->getItemEquiped($char_equip['amulet'], "amulet", $type, $guid)
              . $this->getItemEquiped($char_equip['ring1'], "ring", $type, $guid)
              . $this->getItemEquiped($char_equip['ring2'], "ring", $type, $guid)
              . $this->getItemEquiped($char_equip['ring3'], "ring", $type, $guid)
              . $this->getItemEquiped($char_equip['gloves'], "gloves", $type, $guid)
              . $this->getItemEquiped($char_equip['hand_l'], $char_equip['hand_l_s'], $type, $guid)
              . $this->getItemEquiped($char_equip['pants'], "pants", $type, $guid)
              . $this->getItemEquiped($char_equip['boots'], "boots", $type, $guid)
              . "</td></tr></table>";
    return $equipped;
  }
  /*Получение отображаемых эффектов*/
  function getEffects ($type, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    $i = 1;
    $left = 0;
    $top = 0;
    $return = '';
    $lang = $this->getLang();
    $travms = $this->db->select("SELECT * FROM `character_travms` AS `c` LEFT JOIN `player_travms` AS `i` ON `c`.`travm_id` = `i`.`id` WHERE `c`.`guid` = ?d and `c`.`stats` != '';", $guid);
    foreach ($travms as $travm)
    {
      $name = (isset($lang['travm_p_'.$travm['power']])) ?$lang['travm_p_'.$travm['power']].' ('.$travm['name'].')' :$travm['name'];
      $stats = ($travm['type'] == 1) ?'<br>У персонажа '.lowercase($lang['travm_p_'.$travm['power']]).' - ослаблены характеристики.' :'';
      $modifiers = split(",", $travm['stats']);
      foreach ($modifiers as $modifier)
      {
        $stat = split("=", $modifier);
        $stats .= '<br>'.$lang[$stat[0]].' -'.$stat[1];
      }
      $end_time = 'Осталось: '.getFormatedTime($travm['end_time']);
      $img = ($travm['type'] == 0) ?'' :$travm['power'];
      $return .= "<img src='../img/icon/effects/eff_travma$img.gif' style='position: absolute; left: {$left}px; top: {$top}px; z-index: 100;' alt='<u><b>$name</b></u> (Эффект)<br>$end_time<br>$stats' width='36' height='23'>";
      $left += 36;
      
      if ($i % 3 == 0)
      {
        $top += 23;
        $left = 0;
      }
      
      $i++;
    }
    return $return;
  }
  /*Получение изображения предмета, одетого на персонажа*/
  function getItemEquiped ($item_id, $i_type, $type, $guid = 0)
  {
    $lang = $this->getLang();
    $image = $this->db->selectRow("SELECT `width`, `height`, `default`, `low_level`, `level`  FROM `server_images` WHERE `name` = ?s", 'item_'.$i_type);
    $default = "<img src='../img/items/$image[default]' width='$image[width]' height='$image[height]' border='0' alt='".$lang[$i_type.'_f']."'>";
    
    if (!is_numeric($item_id))
      return $default;
    
    $guid = $this->getGuid($guid);
    $level = $this->getChar('char_db', 'level', $guid);
    
    if ($item_id == 0 && $level < $image['level'])
      return "<img src='../img/items/$image[low_level]' width='$image[width]' height='$image[height]' border='0' alt='".$lang[$i_type.'_l']."'>";
    else if ($item_id == 0)
      return $default;
    
    $color = '';
    $img = $image['default'];
    $desc = $this->getItemAlt($item_id, $type, $color, $img, $guid);
    
    if (!$desc)
      return $default;
    
    $slot = $this->getItemSlot($item_id);
    $return_format = ($type == 'inv') ?"<a href='main.php?action=unwear_item&item_slot=$slot'>%s</a>" :"%s";
    return sprintf($return_format, "<img src='../img/items/$img' width='$image[width]' height='$image[height]' border='0' alt='$desc'$color>");
  }
  /*Получение всплывающей подсказки о предмете*/
  function getItemAlt ($item_id, $type, &$color = '', &$img = '', $guid = 0)
  {
    if (checki($item_id))
      return '';
    
    $guid = $this->getGuid($guid);
    $lang = $this->getLang();
    $i_info = $this->db->selectRow("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                           `i`.`attack`, `i`.`brick`, 
                                           `i`.`name`, `i`.`img`, 
                                           `i`.`add_hp`, `i`.`add_mp`, 
                                           `i`.`def_h`, `i`.`def_a`, 
                                           `i`.`def_b`, `i`.`def_l` 
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `c`.`guid` = ?d
                                      and `c`.`id` = ?d", $guid ,$item_id);
    if (!$i_info)
      return '';
    
    $img = $i_info['img'];
    $tear_check = ($i_info['tear_cur'] >= $i_info['tear_max'] * 0.90);
    $tear_show = ($tear_check) ?'<font color=#990000>%s</font>' :'%s';
    $color = ($tear_check) ?" class='broken'" :'';
    $name = (($type == 'inv') ?"Снять " :'').$i_info['name'];
    $def = array('h', 'a', 'b', 'l');
    $desc = "$name";
    
    if ($i_info['attack'] > 0)
      $desc .= "<br>$lang[damage] $i_info[attack] - ".($i_info['attack'] + $i_info['brick']);
    
    if ($i_info['add_hp'] > 0)      $desc .= "<br>$lang[add_hp] +".$i_info['add_hp'];
    else if ($i_info['add_hp'] < 0) $desc .= "<br>$lang[add_hp] ".$i_info['add_hp'];
    if ($i_info['add_mp'] > 0)      $desc .= "<br>$lang[add_mp] +".$i_info['add_mp'];
    else if ($i_info['add_mp'] < 0) $desc .= "<br>$lang[add_mp] ".$i_info['add_mp'];
    
    foreach ($def as $key)
    {
      if ($i_info['def_'.$key] > 0)
        $desc .= "<br>".$lang['def_'.$key]." ".$i_info['def_'.$key]."-".($i_info['def_'.$key] + $i_info['brick'])." ".$this->getFormatedBrick($i_info['def_'.$key], $i_info['brick']);
    }
    $desc .= "<br>$lang[durability] ".sprintf($tear_show, intval($i_info['tear_cur'])."/".intval($i_info['tear_max']));
    return $desc;
  }
  /*Перечисление предметов нуждающихся в ремонте*/
  function needItemRepair ()
  {
    $rows = $this->db->select("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                      `i`.`name` 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_entry` = `i`.`entry` 
                               WHERE `c`.`guid` = ?d 
                                 and `c`.`wear` = '1';", $this->guid);
    $return = '';
    foreach ($rows as $repair)
    {
      list ($tear_cur, $tear_max, $name) = array_values ($repair);
      
      if ($tear_cur >= $tear_max * 0.90)
        $return .= "&nbsp;<b>$name</b> [<font color='#990000'>".intval($tear_cur)."/".intval($tear_max)."</font>] требуется ремонт<br>";
    }
    return $return;
  }
  /*Добавление предмета*/
  function addItem ($item_entry, $type = 'buy', $guid = 0)
  {
    $guid = $this->getGuid($guid);
    
    if (checki($item_entry))
      return false;
    
    $i_info = $this->db->selectRow("SELECT `name`, 
                                           `price`, 
                                           `price_euro`, 
                                           `mass`, 
                                           `tear`, 
                                           `inc_count`, 
                                           `validity` 
                                    FROM `item_template` 
                                    WHERE `entry` = ?d", $item_entry);
    if (!$i_info)
      return false;
    
    $time = ($i_info['validity'] > 0) ?time() + $i_info['validity'] * 3600 :0;
    $city = $this->getChar('char_db', 'city');
    $id = ($this->db->selectCell("SELECT MAX(`id`) FROM `character_inventory` WHERE `guid` = ?d", $guid)) + 1;
    $this->changeMass($i_info['mass']);
    $this->db->query("INSERT INTO `character_inventory` (`id`, `guid`, `item_entry`, `tear_max`, `inc_count_p`, `made_in`, `date`, `last_update`) 
                      VALUES (?d, ?d, ?d, ?f, ?d, ?s, ?d, ?d)", $id ,$guid ,$item_entry ,rdf($i_info['tear']) ,$i_info['inc_count'] ,$city ,$time ,time());
    if ($type == 'buy')
    {
      $room = $this->getChar('char_db', 'room');
      if ($i_info['price'] > 0)
        $this->char->history->Items('Buy', "$i_info[name] за $i_info[price] кр.", $room);
      else if ($i_info['price_euro'] > 0)
        $this->char->history->Items('Buy', "$i_info[name] за $i_info[price_euro] екр.", $room);
    }
    else if ($type == 'get')
      $this->char->history->Items('Get', $i_info['name'], '');
    return true;
  }
  /*Отображение предмета в инвентаре*/
  function showItem ($i_info, $mode, $i, $mail_guid = '')
  {
    $weapons = array('knife', 'fail', 'sword', 'axe', 'staff');
    $armors = array('boots' => '_l', 'light_armor' => '_a', 'heavy_armor' => '_a', 'helmet' => '_h', 'pants' => '_b');
    $types = array('inv', 'sell', 'mail_to', 'mail_in');
    $lang = $this->getLang();
    $char_db = $this->getChar('char_db', 'money', 'level', 'sex');
    $char_stats = $this->getChar('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'mp_all', 'sword', 'axe', 'fail', 'knife', 'staff', 'fire', 'water', 'air', 'earth');
    $char_feat = array_merge($char_db, $char_stats);
    
    $money = $char_feat['money'];
    $entry = $i_info['entry'];
    $name = $i_info['name'];
    $img = $i_info['img'];
    $type = $i_info['type'];
    $mass = $i_info['mass'];
    $price = $i_info['price'];
    $price_euro = $i_info['price_euro'];
    
    if ($price_euro > 0)
      $price_s = $price_euro." екр.";
    else if ($price > 0)
      $price_s = ($mode == 'shop') ?(compare($price, $money))." кр." :$price." кр.";
    
    $item_flags = $i_info['item_flags'];
    $item_id = (isset($i_info['id'])) ?$i_info['id'] :0;
    $made_in = (isset($i_info['made_in'])) ?$this->char->city->getCity($i_info['made_in'], 'name') :'';
    $tear_cur = (isset($i_info['tear_cur'])) ?intval($i_info['tear_cur']) :0;
    $tear_max = (isset($i_info['tear_max'])) ?ceil($i_info['tear_max']) :$i_info['tear'];
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
        $return .= "<img src='../img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= ($wearable) ?"<a href='?action=wear_item&item_id=$item_id' class='nick'>надеть</a>&nbsp;" :"";
        $return .= "<a href=\"javascript:drop($item_id, '$img', '$name');\"><img src='../img/icon/clear.gif' width='14' height='14' border='0' alt='Выбросить предмет'></a>";
      break;
      case 'shop':
        $s_price = ($price_euro > 0) ?$price_euro :$price;
        $s_kr = ($price_euro > 0) ?"екр." :"кр.";
        $return .= "<td width='200' align='center'>";
        $return .= "<img src='../img/items/$img' border='0' /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='javascript:buyItem($entry);' class='nick'>купить</a>&nbsp;<img src='../img/icon/plus.gif' width='11' height='11' border='0' alt='Купить несколько штук' style='cursor: pointer;' onclick=\"AddCount('$entry', '$name', '$s_price', '$s_kr');\"></center>";
      break;
      case 'sell':
        $s_price = $this->getSellValue($i_info, true);
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='../img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='javascript:sellItem ($item_id);' onclick=\"if (confirm('Вы уверены что хотите продать предмет $name за $s_price?')){return true;} else {return false;}\" class='nick'>продать за $s_price</a>";
      break;
      case 'mail_to':
        $s_price = $this->char->mail->getPrice($item_id)." кр.";
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='../img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=send_item&mail_to=$mail_guid&item_id=$item_id' onclick=\"if (confirm('Отправить предмет $name?')){return true;} else {return false;}\" class='nick'>передать за $s_price</a>";
      break;
      case 'mail_in':
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='../img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=get_item&item_id=$item_id' onclick=\"if (confirm('Забрать предмет $name?')){return true;} else {return false;}\" class='nick'>Забрать</a><br><a href='main.php?do=return_item&item_id=$item_id' onclick=\"if (confirm('Отказаться от предмета $name?')){return true;} else {return false;}\" class='nick'>Отказаться</a>";
        $return .= "<br><small>(".getFormatedTime($i_info['delivery_time'] + 5184000).")</small>";
      break;
      case 'money_in':
        $name = sprintf($name, $i_info['count']);
        $price_s = "$i_info[count] кр.";
        $mail_id = $i_info['id'];
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='../img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=get_money&mail_id=$mail_id' onclick=\"if (confirm('Забрать $price_s?')){return true;} else {return false;}\" class='nick'>Забрать</a><br><a href='main.php?do=return_money&mail_id=$mail_id' onclick=\"if (confirm ('Отказаться от $price?')){return true;} else {return false;}\" class='nick'>Отказаться</a>";
        $return .= "<br><small>(".getFormatedTime($i_info['delivery_time'] + 5184000).")</small>";
      break;
    }
    $return .= "</td><td align='left' valign='top' style='padding: 2px;'>";
    $tear_show = compare($tear_cur, $tear_max * 0.90, "$tear_cur/$tear_max");
    $required = array('dex', 'con', 'int', 'level', 'fire', 'water', 'air', 'earth', 'sword', 'axe', 'fail', 'knife', 'staff', 'vit', 'str', 'mp_all', 'wis', 'sex');
    $modifiers = array('mf_critp', 'mf_acrit', 'mf_adodge', 'mf_parmour', 'mf_crit', 'mf_parry', 'mf_shieldb', 'mf_dodge', 'mf_contr', 'rep_magic',
                       'rep_fire', 'rep_water', 'rep_air', 'rep_earth', 'mf_magic', 'mf_fire', 'mf_water', 'mf_air', 'mf_earth', 'mf_light', 'mf_gray', 
                       'mf_dark', 'mf_dmg', 'mf_sting', 'mf_slash', 'mf_crush', 'mf_sharp', 'all_magic', 'fire', 'water', 'air', 'earth', 'light', 'gray', 
                       'dark', 'all_mastery', 'sword', 'axe', 'fail', 'knife', 'staff', 'res_magic', 'res_fire', 'res_water', 'res_air', 
                       'res_earth', 'res_light', 'res_gray', 'res_dark', 'res_dmg', 'res_sting', 'res_slash', 'res_crush', 'res_sharp', 
                       'add_hp', 'add_mp', 'mp_cons', 'mp_regen', 'hp_regen', 'add_hit_min', 'add_hit_max');
    $w_modifiers = array('mf_adodge', 'mf_crit', 'mf_critp', 'mf_sting', 'mf_slash', 'mf_crush', 'mf_sharp', 'sword', 'axe', 'fail', 'knife', 'mf_parmour');
    $chances = array('ch_sting', 'ch_slash', 'ch_crush', 'ch_sharp', 'ch_fire', 'ch_water', 'ch_air', 'ch_earth', 'ch_light', 'ch_dark');
    $features = array('res_dmg', 'res_sting', 'res_slash', 'res_crush', 'res_sharp');
    $brick = $i_info['brick'];
    $def = array(
      'h' => array($i_info['def_h'], ($i_info['def_h'] + $brick), $this->getFormatedBrick($i_info['def_h'], $brick)),
      'a' => array($i_info['def_a'], ($i_info['def_a'] + $brick), $this->getFormatedBrick($i_info['def_a'], $brick)),
      'b' => array($i_info['def_b'], ($i_info['def_b'] + $brick), $this->getFormatedBrick($i_info['def_b'], $brick)),
      'l' => array($i_info['def_l'], ($i_info['def_l'] + $brick), $this->getFormatedBrick($i_info['def_l'], $brick))
    );
    $attack = $i_info['attack'];
    $block = $i_info['block'];
    $hands = $i_info['hands'];
    $url = str_replace('.gif', '.html', $i_info['img']);
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
      $orden = "<img src='../img/orden/align$need_orden.gif' border='0' alt='$lang[min_bent] <strong>$orden_dis</strong>'>";
    }
    $return .= "<a href='encicl/object/$url' class='nick' target='_blank'><b>$name</b></a>&nbsp;$orden&nbsp;($lang[mass] $mass)";
    
    if ($gift == 1)
      $return .= "&nbsp;<img src='../img/icon/gift.gif' width='14' height='14' border='0' alt='$lang[gift] $gift_author'>";
    
    if ($item_flags & 4)
      $return .= "&nbsp;<img src='../img/icon/artefakt.gif' width='16' height='16' border='0' alt='$lang[artefact]'>";
    
    if (isset($price_s))
      $return .= "<br><b>$lang[price] $price_s</b>";
    
    $return .= "<br>$lang[durability] $tear_show";
    
    if (($mode == 'inv' || $mode == 'sell') && $validity > 0)$return .= "<br>".sprintf($lang['validity'], date('d.m.y H:i', $validity), getFormatedTime($validity));
    else if ($mode == 'shop' && $validity > 0)               $return .= "<br>$lang[val_life] ".getFormatedTime($validity * 3600 + time());
    
    $val = "";
    $require = "";
    foreach ($required as $key)
    {
      if (($key != 'sex' && $i_info['min_'.$key] <= 0) || ($key == 'sex' && $i_info[$key] == ''))
        continue;
      
      if (!$val)
        $val = "<br><b>$lang[required]</b>";
      
      if ($key != 'sex' && $i_info['min_'.$key] > 0) $require .= "<br>&bull; ".(compare($i_info['min_'.$key], $char_feat[$key], "$lang[$key] ".$i_info['min_'.$key]));
      else if ($key == 'sex' && $i_info[$key] != '') $require .= "<br>&bull; ".(compare($i_info[$key], $char_feat[$key], "$lang[$key] ".$lang['sex_'.$i_info[$key]]));
    }
    $return .= $val.$require;
    
    $val = "";
    if (($add['str'] != 0 || $add['dex'] != 0 || $add['con'] != 0 || $add['int'] != 0 
        || $i_info['def_h'] != 0 || $i_info['def_a'] != 0 || $i_info['def_b'] != 0 || $i_info['def_l'] != 0 || $inc_count > 0 
        || (!in_array($type, $weapons) && $attack != 0)))
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
    foreach ($def as $key => $value)
    {
      if ($value[0] > 0)
        $return .= "<br>&bull; ".$lang['def_'.$key]." $value[0]-$value[1] $value[2]";
    }
    if (in_array($type, $weapons))
    {
      $return .= "<br><b>$lang[behaviour]</b>";
      $return .= "<br>&bull; $lang[damage] $attack - ".($attack + $brick);
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
    if (in_array($type, array_keys($armors)))
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
  private function getFormatedBrick ($min, $brick)
  {
    $first = $min - 1;
    $second = $brick + 1;
    if ($min == 1)    return "(d$second)";
    if ($brick == 0)  return '';
    if ($min <= 0)    return '';
                      return "($first+d$second)";
  }
  /*Получение кнопки прибавления характеристик вещи*/
  private function getIncButton ($item_id, $stat)
  {
    return "<input type='image' id='inc_{$item_id}_btn' src='img/icon/plus.gif' style='border: 0px; vertical-align: bottom;' onclick=\"increaseItemStat('$item_id', '$stat'); this.blur();\">";
  }
  /*Одеть/Снять предмет*/
  function equipItem ($item, $type = 1, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    $item_id = ($type == 1) ?$item :$this->getChar('char_equip', $item, $guid);
    
    if (checki($item_id))
      return;
    
    $error_id = ($type == 1) ?213 :214;
    $wear_status = ($type == 1) ?0 :1;
    $char_equip = $this->getChar('char_equip', '*', $guid);
    $i_info = $this->db->selectRow("SELECT * 
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_entry` = `i`.`entry` 
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
            $slot = "hand_r";
            
            if (!$char_equip['hand_r_free'] && $char_equip['hand_l_free'])
            {
              if ($i_info['item_flags'] & 16)
                $slot = "hand_l";
              else
                $this->equipItem('hand_r', -1, $guid);
            }
            else if (!$char_equip['hand_r_free'] && !$char_equip['hand_l_free'])
              $this->equipItem('hand_r', -1, $guid);
          }
          else if ($i_hands == 2)
          {
            $slot = "hand_r";
            
            if (!$char_equip['hand_r_free'])
              $this->equipItem('hand_r', -1, $guid);
            
            if (!$char_equip['hand_l_free'])
              $this->equipItem('hand_l', -1, $guid);
          }
          $w_type = $i_type;
        break;
        case 'shield':
          $slot = "hand_l";
          
          if ($char_equip['hand_l'])
            $this->equipItem('hand_l', -1, $guid);
          
          if ($char_equip['hand_r'] && !$char_equip['hand_l_free'])
            $this->equipItem('hand_r', -1, $guid);
          
          $w_type = $i_type;
        break;
        case 'ring':
          $slot = "ring1";
          
          if (!$char_equip['ring1'])
            $slot = "ring1";
          else if (!$char_equip['ring2'])
            $slot = "ring2";
          else if (!$char_equip['ring3'])
            $slot = "ring3";
          else
            $this->equipItem('ring1', -1, $guid);
        break;
        default:
          $slot = $i_type;
          
          if ($char_equip[$i_type])
            $this->equipItem($i_type, -1, $guid);
        break;
      }
    }
    else if ($type == -1)
    {
      unset($char_equip['guid'], $char_equip['hand_r_free'], $char_equip['hand_r_type'], $char_equip['hand_l_free'], $char_equip['hand_l_type']);
      foreach ($char_equip as $key => $value)
      {
        if ($i_id == $value)
        {
          $slot = $key;
          break;
        }
      }
    }
    
    $char_stats = $this->getChar('char_stats', '*', $guid);
    
    $new_sql = array();
    $ress = array('', '_h', '_a', '_b', '_l');
    $defs = array('h', 'a', 'b', 'l');
// Resist damage
    foreach ($ress as $key)
    {
      $new_sql['res_sting'.$key] = $i_info['res_sting'.$key] + $i_info['res_dmg'.$key];
      $new_sql['res_slash'.$key] = $i_info['res_slash'.$key] + $i_info['res_dmg'.$key];
      $new_sql['res_crush'.$key] = $i_info['res_crush'.$key] + $i_info['res_dmg'.$key];
      $new_sql['res_sharp'.$key] = $i_info['res_sharp'.$key] + $i_info['res_dmg'.$key];
    }
    // -- magic
    $new_sql['res_fire'] = $i_info['res_fire'] + $i_info['res_magic'];
    $new_sql['res_water'] = $i_info['res_water'] + $i_info['res_magic'];
    $new_sql['res_air'] = $i_info['res_air'] + $i_info['res_magic'];
    $new_sql['res_earth'] = $i_info['res_earth'] + $i_info['res_magic'];
    $new_sql['res_light'] = $i_info['res_light'] + $i_info['res_magic'];
    $new_sql['res_gray'] = $i_info['res_gray'] + $i_info['res_magic'];
    $new_sql['res_dark'] = $i_info['res_dark'] + $i_info['res_magic'];
// Mastery
    $new_sql['sword'] = $i_info['sword'] + $i_info['all_mastery'];
    $new_sql['bow'] = $i_info['bow'] + $i_info['all_mastery'];
    $new_sql['crossbow'] = $i_info['crossbow'] + $i_info['all_mastery'];
    $new_sql['axe'] = $i_info['axe'] + $i_info['all_mastery'];
    $new_sql['fail'] = $i_info['fail'] + $i_info['all_mastery'];
    $new_sql['knife'] = $i_info['knife'] + $i_info['all_mastery'];
    // --
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
    $new_sql['mf_sting'] = $i_info['mf_sting'] + $i_info['mf_dmg'];
    $new_sql['mf_slash'] = $i_info['mf_slash'] + $i_info['mf_dmg'];
    $new_sql['mf_crush'] = $i_info['mf_crush'] + $i_info['mf_dmg'];
    $new_sql['mf_sharp'] = $i_info['mf_sharp'] + $i_info['mf_dmg'];
    // -- magic
    $new_sql['mf_fire'] = $i_info['mf_fire'] + $i_info['mf_magic'];
    $new_sql['mf_water'] = $i_info['mf_water'] + $i_info['mf_magic'];
    $new_sql['mf_air'] = $i_info['mf_air'] + $i_info['mf_magic'];
    $new_sql['mf_earth'] = $i_info['mf_earth'] + $i_info['mf_magic'];
    // --
    $new_sql['mf_crit'] = $i_info['mf_crit'];
    $new_sql['mf_critp'] = $i_info['mf_critp'];
    $new_sql['mf_adodge'] = $i_info['mf_adodge'];
    $new_sql['mf_parmour'] = $i_info['mf_parmour'];
    // --
    $new_sql['mf_acrit'] = $i_info['mf_acrit'];
    $new_sql['mf_dodge'] = $i_info['mf_dodge'];
    $new_sql['mf_contr'] = $i_info['mf_contr'];
    $new_sql['mf_parry'] = $i_info['mf_parry'];
    $new_sql['mf_shieldb'] = $i_info['mf_shieldb'];
// Damage
    $new_sql['hitmin'] = $i_info['add_hit_min'];
    $new_sql['hitmax'] = $i_info['add_hit_max'];
// Protect
    foreach ($defs as $key)
    {
      if ($i_info['def_'.$key] > 0)
      {
        $new_sql['def_'.$key.'_min'] = $i_info['def_'.$key];
        $new_sql['def_'.$key.'_max'] = $i_info['def_'.$key] + $i_info['brick'];
      }
    }
    //$new_sql['cost'] = $i_info['price'];
    $new_sql['hp_regen'] = $i_info['hp_regen'];
    $new_sql['mp_regen'] = $i_info['mp_regen'];
    $new_sql['mp_cons'] = -$i_info['mp_cons'];
// Hand
    switch ($slot)
    {
      case 'hand_r':
      case 'hand_l':
        $new_sql[$slot.'_sword'] = $i_info['sword_h'];
        $new_sql[$slot.'_axe'] = $i_info['axe_h'];
        $new_sql[$slot.'_fail'] = $i_info['fail_h'];
        $new_sql[$slot.'_knife'] = $i_info['knife_h'];
        $new_sql[$slot.'_sting'] = $i_info['mf_sting_h'] + $i_info['mf_dmg_h'];
        $new_sql[$slot.'_slash'] = $i_info['mf_slash_h'] + $i_info['mf_dmg_h'];
        $new_sql[$slot.'_crush'] = $i_info['mf_crush_h'] + $i_info['mf_dmg_h'];
        $new_sql[$slot.'_sharp'] = $i_info['mf_sharp_h'] + $i_info['mf_dmg_h'];
        $new_sql[$slot.'_crit'] = $i_info['mf_crit_h'];
        $new_sql[$slot.'_critp'] = $i_info['mf_critp_h'];
        $new_sql[$slot.'_adodge'] = $i_info['mf_adodge_h'];
        $new_sql[$slot.'_parmour'] = $i_info['mf_parmour_h'];
        $new_sql[$slot.'_hitmin'] = $i_info['attack'];
        $new_sql[$slot.'_hitmax'] = $i_info['attack'] + $i_info['brick'];
      break;
    }
// HP/MP
    $new_sql['hp_all'] = $i_info['add_hp'];
    $new_sql['mp_all'] = $i_info['add_mp'];
    
    foreach ($new_sql as $key => $value)
    {
      if ($value == 0)
      {
        unset($new_sql[$key]);
        continue;
      }
      
      $new_sql[$key] = $value*$type;
      $new_sql[$key] += $char_stats[$key];
    }
    
    $char_hpmp = $this->getChar('char_stats', 'hp', 'mp', $guid);
    foreach ($char_hpmp as $key => $value)
    {
      if ($i_info['add_'.$key] != 0)
        $this->setTimeToHPMP($value, $new_sql[$key.'_all'], $char_stats[$key.'_regen'], $key, $guid);
    }
    
    $stats = array ('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0);
    foreach ($stats as $key => $value)
    {
      $stats[$key] = ($i_info['add_'.$key] + $i_info['inc_'.$key])*$type;
      
      if ($stats[$key] == 0)
        unset($stats[$key]);
    }
    
    if ($type == 1)
    {
      $q1 = $this->db->query("UPDATE `character_inventory` 
                              SET `wear` = '1', 
                                  `last_update` = ?d 
                              WHERE `guid` = ?d 
                                and `id` = ?d", time() ,$guid ,$i_id);
      $q2 = $this->setChar('char_equip', $slot, $i_id, $guid);
    }
    else if ($type == -1)
    {
      $q1 = $this->db->query("UPDATE `character_inventory` 
                              SET `wear` = '0', 
                                  `last_update` = ?d 
                              WHERE `guid` = ?d 
                                and `id` = ?d", time() ,$guid ,$i_id);
      $q2 = $this->setChar('char_equip', $slot, 0, $guid);
    }
    if ($q1 && $q2)
    {
      $this->db->query("UPDATE `character_stats` SET ?a WHERE `guid` = ?d", $new_sql ,$guid);
      $this->changeStats($stats, $guid);
      if ($type == 1)
      {
        if ($i_hands == 2)
          $this->setChar('char_equip', array('hand_r_type' => $w_type, 'hand_r_free' => 0, 'hand_l_free' => 0), $guid);
        else if ($i_hands == 1)
          $this->setChar('char_equip', array($slot.'_type' => $w_type, $slot.'_free' => 0), $guid);
      }
      else if ($type == -1)
      {
        if ($i_hands == 2)
          $this->setChar('char_equip', array('hand_r_type' => 'phisic', 'hand_r_free' => 1, 'hand_l_free' => 1), $guid);
        else if ($i_hands == 1)
          $this->setChar('char_equip', array($slot.'_type' => 'phisic', $slot.'_free' => 1), $guid);
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
  /*Удаление предмета*/
  function deleteItem ($item_id, $type = 'delete', $guid = 0)
  {
    $guid = $this->getGuid($guid);
    
    if (checki($item_id))
      return false;
    
    $i_info = $this->db->selectRow("SELECT `i`.`name`, 
                                           `i`.`mass`, 
                                           `i`.`price`, 
                                           `i`.`price_euro`, 
                                           `c`.`tear_cur`, `c`.`tear_max`, 
                                           `i`.`tear` 
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `c`.`guid` = ?d 
                                      and `c`.`id` = ?d 
                                      and `c`.`wear` = '0' 
                                      and `c`.`mailed` = '0';", $guid ,$item_id);
    if (!$i_info)
      return false;
    
    $this->changeMass(-$i_info['mass']);
    $this->db->query("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
    if ($type == 'delete')
      $this->char->history->Items('Throw out', $i_info['name'], 'Dump');
    else if ($type == 'sell')
    {
      $sell_price = $this->getSellValue($i_info);
      $this->char->history->Items('Sell', "$i_info[name] за $sell_price кр.", 'Shop');
    }
    return true;
  }
  /*Получение слота в который одет предмет*/
  function getItemSlot ($item_id)
  {
    if (checki($item_id))
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
  }
}
?>