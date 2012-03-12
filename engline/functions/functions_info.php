<?
defined('AntiBK') or die("Доступ запрещен!");

/*Информация о персонаже*/
class Info
{
  public $guid;
  public $db;
  function& initialization ($guid, $adb)
  {
    $object = new Info;
    $object->guid = $guid;
    $object->db = $adb;
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
  /*Проверка существования персонажа*/
  function Guid ()
  {
    if ($this->guid == 0 || !is_numeric($this->guid))
      toIndex();
    
    $char_db = $this->getChar('char_db', 'guid');
    $char_stats = $this->getChar('char_stats', 'guid');
    $char_info = $this->getChar('char_info', 'guid');
    
    if (!$char_db || !$char_stats || !$char_info)
      toIndex();
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
  /*Проверка молчанки у персонажа*/
  function Shut ()
  {
    $chat_shut = $this->getChar('char_db', 'chat_shut');
    
    if (!$chat_shut || $chat_shut > time())
      return;
    
    $this->db->query("UPDATE `characters` SET `chat_shut` = '0' WHERE `guid` = ?d", $this->guid);
  }
  /*Восстановление здоровья/маны*/
  function Regen ()
  {
    $char_stats = $this->getChar('char_stats', 'hp', 'hp_cure', 'hp_all', 'hp_regen', 'mp', 'mp_cure', 'mp_all', 'mp_regen');
    list($now["hp"], $cure["hp"], $all["hp"], $regen["hp"], $now["mp"], $cure["mp"], $all["mp"], $regen["mp"]) = array_values($char_stats);
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
      
      $regenerated = getRegeneratedValue($value, ($cure[$key] - time()), $regen[$key]);
      if ($regenerated >= 0 && $regenerated < $value)
        $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key ,$regenerated ,$this->guid);
      else
      {
        $this->db->query("UPDATE `character_stats` SET ?# = ?d, ?# = '0' WHERE `guid` = ?d", $key ,$value ,$key.'_cure' ,$this->guid);
        continue;
      }
    }
  }
  /*Проверка травм у персонажа*/
  function Travm ()
  {
    $char_db = $this->getChar('char_db', 'travm', 'travm_old_stat', 'travm_stat');
    
    if (!$char_db['travm'])
      return;
    
    if (intval(($char_db['travm'] - time()) / 60) > 0)
      return;
    
    $this->db->query("UPDATE `characters` SET `travm` = '0' WHERE `guid` = ?d" ,$this->guid);
    $this->db->query("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $char_db['travm_stat'] ,$char_db['travm_old_stat'] ,$this->guid);
  }
  /*Проверка онлайн*/
  function Online ()
  {
    $last_time = $this->getChar('char_db', 'last_time');
    
    if ((time() - $last_time) > 100)
      $this->db->query("DELETE FROM `online` WHERE `guid` = ?d", $this->guid);
  }
  /*Отображение дополнительной характеристики*/
  function showStatAddition ()
  {
    global $added;
    $added = array('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0);
    $rows = $this->db->select("SELECT `i`.`add_str`, `c`.`inc_str`, 
                                      `i`.`add_dex`, `c`.`inc_dex`, 
                                      `i`.`add_con`, `c`.`inc_con`, 
                                      `i`.`add_int`, `c`.`inc_int` 
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
  }
  /*Отображение снаряжения*/
  function showCharacter ()
  {
    $char_equip = $this->getChar('char_equip', '*');
    $char_db = $this->getChar('char_db', 'login', 'shape', 'block');
    $char_stats = $this->getChar('char_stats', 'hp', 'hp_all', 'hp_regen', 'mp', 'mp_all', 'mp_regen');
    $char_feat = array_merge($char_db, $char_stats);
    $lang = $this->getLang();
    $char_feat['name'] = "alt='$char_feat[login]'";
    $char_equip['armor'] = ($char_equip['cloak']) ?$char_equip['cloak'] :(($char_equip['armor']) ?$char_equip['armor'] :$char_equip['shirt']);
    $char_equip['hand_l_s'] = (!$char_equip['hand_l_free']) ?"hand_l" :"hand_l_f";
    
    echo $this->character();
    echo "<div style='height: 9px;'></div>";
    echo $this->getCharacterEquipped($char_equip, $char_feat);
    echoScript("showHP($char_feat[hp], $char_feat[hp_all], $char_feat[hp_regen]);".
               "showMP($char_feat[mp], $char_feat[mp_all], $char_feat[mp_regen]);");
  }
  /*Получение одетых вещей*/
  function getCharacterEquipped ($char_equip, $char_feat)
  {
    if (!$char_equip || !$char_feat)
      return;
    
    $equipped = "<table border='0' width='227' class='posit' cellspacing='0' cellpadding='0'>";
    
    if ($char_feat['block'])
      $equipped .= "<tr><td colspan='3' align='center'><b><font color='#FF0000'>Персонаж заблокирован!</font></b></td></tr>";
    
    $equipped .= "<tr bgColor='#dedede'>"
               . "<td width='60' align='left' valign='top'>"
               . $this->getItemEquiped($char_equip['helmet'], "helmet")
               . $this->getItemEquiped($char_equip['bracer'], "bracer")
               . $this->getItemEquiped($char_equip['hand_r'], "hand_r")
               . $this->getItemEquiped($char_equip['armor'], "armor")
               . $this->getItemEquiped($char_equip['belt'], "belt")
               . "</td>"
               . "<td width='120' align='center' valign='middle'>"
               . "<table cellspacing='0' cellpadding='0' height='20'>"
               . "<tr><td style='font-size: 9px; position: relative;'><div id='HP'></div><div id='MP'></div></td></tr>"
               . "</table><img src='img/chars/$char_feat[shape]' $char_feat[name]><br>"
               . "<img src='img/items/slot_bottom0.gif' border='0'>"
               . "</td>"
               . "<td width='60' align='right' valign='top'>"
               . $this->getItemEquiped($char_equip['earring'], "earring")
               . $this->getItemEquiped($char_equip['amulet'], "amulet")
               . $this->getItemEquiped($char_equip['ring1'], "ring")
               . $this->getItemEquiped($char_equip['ring2'], "ring")
               . $this->getItemEquiped($char_equip['ring3'], "ring")
               . $this->getItemEquiped($char_equip['gloves'], "gloves")
               . $this->getItemEquiped($char_equip['hand_l'], $char_equip['hand_l_s'])
               . $this->getItemEquiped($char_equip['pants'], "pants")
               . $this->getItemEquiped($char_equip['boots'], "boots")
               . "</td></tr></table>";
    return $equipped;
  }
  /*Получение изображения предмета, одетого на персонажа*/
  function getItemEquiped ($item_id, $i_type)
  {
    if (!is_numeric($item_id))
      return $default;
    
    $lang = $this->getLang();
    $level = $this->getChar('char_db', 'level');
    $image = $this->db->selectRow("SELECT `width`, `height`, `default`, `low_level`, `level`  FROM `server_images` WHERE `name` = ?s", 'item_'.$i_type);
    $default = "<img src='img/items/$image[default]' width='$image[width]' height='$image[height]' border='0' alt='".$lang[$i_type.'_f']."'>";
    
    if ($item_id == 0 && $level < $image['level'])
      return "<img src='img/items/$image[low_level]' width='$image[width]' height='$image[height]' border='0' alt='".$lang[$i_type.'_l']."'>";
    else if ($item_id == 0)
      return $default;
    
    $color = '';
    $img = $image['default'];
    $desc = $this->getItemAlt($item_id, $color, $img);
    
    if (!$desc)
      return $default;
    
    $slot = $this->getItemSlot($item_id);
    return "<img src='img/items/$img' width='$image[width]' height='$image[height]' border='0' alt='$desc'$color>";
  }
  /*Получение всплывающей подсказки о предмете*/
  function getItemAlt ($item_id, &$color = '', &$img = '')
  {
    if (!is_numeric($item_id) || $item_id == 0)
      return '';
    
    $lang = $this->getLang();
    $i_info = $this->db->selectRow("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                           `i`.`min_hit`, `i`.`max_hit`, 
                                           `i`.`name`, `i`.`img`, 
                                           `i`.`add_hp`, `i`.`add_mp`, 
                                           `i`.`def_h_min`, `i`.`def_h_max`, 
                                           `i`.`def_a_min`, `i`.`def_a_max`, 
                                           `i`.`def_b_min`, `i`.`def_b_max`, 
                                           `i`.`def_l_min`, `i`.`def_l_max` 
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `c`.`guid` = ?d
                                      and `c`.`id` = ?d", $this->guid ,$item_id);
    if (!$i_info)
      return '';
    
    $img = $i_info['img'];
    $tear_check = ($i_info['tear_cur'] >= $i_info['tear_max'] * 0.90);
    $tear_show = ($tear_check) ?'<font color=#990000>%s</font>' :'%s';
    $color = ($tear_check) ?" class='broken'" :'';
    $protect = array ('h', 'a', 'b', 'l');
    $desc = $i_info['name'];
    
    if ($i_info['min_hit'] > 0 || $i_info['max_hit'] > 0)
      $desc .= "<br>$lang[damage] $i_info[min_hit] - $i_info[max_hit]";
    
    if ($i_info['add_hp'] > 0)      $desc .= "<br>$lang[add_hp] +".$i_info['add_hp'];
    else if ($i_info['add_hp'] < 0) $desc .= "<br>$lang[add_hp] ".$i_info['add_hp'];
    if ($i_info['add_mp'] > 0)      $desc .= "<br>$lang[add_mp] +".$i_info['add_mp'];
    else if ($i_info['add_mp'] < 0) $desc .= "<br>$lang[add_mp] ".$i_info['add_mp'];
    
    foreach ($protect as $key)
    {
      if ($i_info['def_'.$key.'_min'] > 0)
        $desc .= "<br>".$lang['def_'.$key]." ".$i_info['def_'.$key.'_min']."-".$i_info['def_'.$key.'_max']." ".$this->getFormatedBrick($i_info['def_'.$key.'_min'], $i_info['def_'.$key.'_max']);
    }
    $desc .= "<br>$lang[durability] ".sprintf($tear_show, intval($i_info['tear_cur'])."/".ceil($i_info['tear_max']));
    return $desc;
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
  /*Показ строки персонажа*/
  function character ()
  {
    $char_db = $this->getChar('char_db', 'login', 'level', 'orden', 'clan', 'clan_short', 'block', 'rang', 'chat_shut', 'afk', 'dnd', 'message', 'travm');
    list($login, $level, $orden, $clan_f, $clan_s, $block, $rang, $chat_shut, $afk, $dnd, $message, $travm) = array_values($char_db);
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
    $mol = ($chat_shut != 0) ?" <img src='img/sleep2.gif' title='Наложено заклятие молчания'>" :"&nbsp";
    $travm = ($travm != 0) ?"<img src='img/travma2.gif' title='Инвалидность'>" :"&nbsp";
    $banned = ($block) ?"<font color='red'><b>- Забанен</b></font>" :"";
    $afk = ($afk) ?"<font title='$message'><b>afk</b></font>&nbsp;" :(($dnd && $message) ?"<font title='$message'><b>dnd</b></font>&nbsp;" :'');
    return "<img src='img/icon/lock3.gif' border='0' onclick=window.opener.top.AddToPrivate('$login',true); style='cursor: pointer;'> $orden_img$clan<b>$login</b> [$level]$login_info";
  }
  /*Показ дополнительной информации по персонажу*/
  function showInfDetail ()
  {
    $char_db = $this->getChar('char_db', 'block', 'block_reason', 'chat_shut', 'prision', 'prision_reason', 'travm', 'travm_var');
    /*Блок*/
    if ($char_db['block'] && $char_db['block_reason'])
      echo "Причина блока :<br><b><font class='private'>$char_db[block_reason]</font></b><br>";
    /*Молчанка*/
    if ($char_db['chat_shut'] != 0)
      echo "<img src='img/icon/sleeps0.gif'><small>На персонажа наложено заклятие молчания. Будет молчать еще ".getFormatedTime($char_db['chat_shut'])."</small><br>";
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
  /*Получение информации о городе*/
  function getCity ()
  {
    $args = func_get_args();
    $args_num = func_num_args();
    $city = $args[0];
    unset($args[0]);
    
    if ($args_num == 2)
      return $this->db->selectCell("SELECT ?# FROM `server_cities` WHERE `city` = ?s", $args ,$city);
    else
      return $this->db->selectRow("SELECT ?# FROM `server_cities` WHERE `city` = ?s", $args ,$city);
  }
  /*Получение информации о комнате*/
  function getRoom ()
  {
    $args = func_get_args();
    $args_num = func_num_args();
    $room = $args[0];
    $city = $this->getCity($args[1], 'flag');
    unset($args[0], $args[1]);
    
    if ($args_num == 3)
      return $this->db->selectCell("SELECT ?# FROM `city_rooms` WHERE `room` = ?s and `city` & ?d", $args ,$room ,$city);
    else
      return $this->db->selectRow("SELECT ?# FROM `city_rooms` WHERE `room` = ?s and `city` & ?d", $args ,$room ,$city);
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
/*Получение времени восстановления здоровья*/
function getCureValue ($now, $all, $regen, &$value)
{
  $value = intval(30000*($all-$now)/($all*$regen)) + time();
}
/*Получение количества восстановленного здоровья*/
function getRegeneratedValue ($all, $cure, $regen)
{
  return $all - intval(0.0001*$all*$cure*$regen/3);
}
/*Получение отформатированного времени*/
function getFormatedTime ($timestamp)
{
  if (!$timestamp)
    return "Вечность";
  
  if (!is_numeric($timestamp))
    $timestamp = time();
  
  $seconds = abs($timestamp - time());
  $d = intval($seconds / 86400);
  $seconds %= 86400;
  $h = intval($seconds / 3600);
  $seconds %= 3600;
  $m = intval($seconds / 60);
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
  if ($added_stat < 0) return "&nbsp;<small>(<font id='inst_$type'>".($stat-$added_stat)."</font> - ".abs($added_stat).")</small>";
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

  if (is_numeric($stand) && is_numeric($value)) return ($flags & 8) ?round($value, 2) :$value;
  else if (!is_numeric($stand))                 return htmlspecialchars($value);
  else                                          return $stand;
}
/*Получение место перехода*/
function toIndex ()
{
  echoScript("location.href = 'index.php';", true);
}
/*Определение знака зодиака*/
function getZodiac ($birthday)
{
  $b = split('\.', $birthday);
  $zodiac = array('1.3.21.4.20', '2.4.21.5.20', '3.5.21.6.20', '4.6.21.7.22', '5.7.23.8.22', '6.8.23.9.23', '7.9.24.10.23', '8.10.24.11.21', '9.11.22.12.21', '10.12.22.1.19', '11.1.20.2.18', '12.2.19.3.20');
  foreach ($zodiac as $value)
  {
    $d = split('\.', $value);
    
    if (($b[1] == $d[1] && $b[0] >= $d[2] && $b[0] <= 31) || ($b[1] == $d[3] && $b[0] >= 1 && $b[0] <= $d[4]))
      return $d[0];
  }
}
?>