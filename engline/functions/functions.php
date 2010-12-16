<?
defined('AntiBK') or die ("Доступ запрещен!");

/*Функции проверки*/
class Test extends Error
{
  private $guid;
  /*Присваивание guid персонажа переменной класса*/
  function& setguid ($guid)
  {
    $object = new Test;
    $object->guid = $guid;
    return $object;
  }
  /*Проверка существования гайда*/
  function Guid ($guid)
  {
    global $adb, $db;
    $error = "<script>top.main.location.href = 'main.php?action=exit';</script>";
    
    if ($guid == 0 || !is_numeric($guid))
      die ($error);
    
    $db = $adb -> selectRow ("SELECT `block`, `prision`, `battle`, `shut`, `login`, `admin_level` FROM `characters` WHERE `guid` = ?d", $this->guid);
    $stats = $adb -> selectCell ("SELECT `guid` FROM `character_stats` WHERE `guid` = ?d", $this->guid);
    $info = $adb -> selectCell ("SELECT `guid` FROM `character_info` WHERE `guid` = ?d", $this->guid);
    
    if (!$db || !$stats || !$info)
      die ($error);
  }
  /*Проверка блока персонажа*/
  function Block ($block)
  {
    if (!$block)
      return;
    
    die ("<script>top.main.location.href = 'main.php?action=exit';</script>");
  }
  /*Проверка заключения персонажа*/
  function Prision ($prision)
  {
    if (!$prision || floor ($prision - time()) > 0)
      return;
    
    $adb -> query ("UPDATE `characters` 
                    SET `prision` = '0', 
                        `orden` = '0' 
                    WHERE `guid` = ?d", $this->guid);
  }
  /*Проверка участия персонажа в заявке*/
  function Zayavka ()
  {
    global $adb;
    $battle = $adb -> selectCell ("SELECT `battle` FROM `characters` WHERE `guid` = ?d", $this->guid);
    $md1 = $adb -> selectCell ("SELECT `battle_id` FROM `team1` WHERE `player` = ?d", $this->guid);
    $md2 = $adb -> selectCell ("SELECT `battle_id` FROM `team2` WHERE `player` = ?d", $this->guid);
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
    $rows = $adb -> select ("SELECT `creator`, 
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
        goBattle ($this->guid);
    }
    if ($_SESSION['zayavka_c_m'] == 0 && $zayavka_status == "confirm_mine")
    {
      $_SESSION['zayavka_c_m'] = 1;
      die ("<script>top.main.location.href = 'zayavka.php?boy=phisic';</script>");
    }
    
    if ($_SESSION['zayavka_c_o'] == 0 && $t == 0)
      $_SESSION['zayavka_c_o'] = 1;
  }
  /*Проверка участия персонажа в битве*/
  function Battle ($battle)
  {
    if (!$battle)
      return;
    
    die ("<script>top.main.location.href = 'battle.php';</script>");
  }
  /*Проверка молчанки у персонажа*/
  function Shut ($shut)
  {
    if (!$shut || floor (($shut - time()) / 60) > 0)
      return;
    
    $adb -> query ("UPDATE `characters` SET `shut` = '0' WHERE `guid` = ?d", $this->guid);
  }
  /*Восстановление здоровья/маны*/
  function Regen ()
  {
    global $adb;
    $stats = $adb -> selectRow ("SELECT `hp_cure`, `hp_all`, `hp_regen`, 
                                        `mp_cure`, `mp_all`, `mp_regen` 
                                 FROM `character_stats` 
                                 WHERE `guid` = ?d", $this->guid);
    list ($cure["hp"], $all["hp"], $regen["hp"], $cure["mp"], $all["mp"], $regen["mp"]) = array_values ($stats);
    $char = $adb -> selectRow ("SELECT `hp`, `mp` 
                                FROM `characters` 
                                WHERE `guid` = ?d", $this->guid);
    list ($now["hp"], $now["mp"]) = array_values ($char);
    
    if ($adb -> selectCell ("SELECT `battle` FROM `characters` WHERE `guid` = ?d", $this->guid) != 0)
      return;
    
    foreach ($all as $key => $value)
    {
      if ($cure[$key] == 0 && $now[$key] < $value)
      {
        getCureValue ($now[$key], $value, $regen[$key], $cure[$key]);
        $adb -> query ("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key.'_cure' ,$cure[$key] ,$this->guid);
      }
      else if ($cure[$key] == 0)
        continue;
      
      $regenerated = getRegeneratedValue ($value, ($cure[$key] - time ()), $regen[$key]);
      if ($regenerated > 0 && $regenerated < $value)
        $adb -> query ("UPDATE `characters` SET ?# = ?d WHERE `guid` = ?d", $key ,$regenerated ,$this->guid);
      else
      {
        $adb -> query ("UPDATE `characters` SET ?# = ?d WHERE `guid` = ?d", $key ,$value ,$this->guid);
        $adb -> query ("UPDATE `character_stats` SET ?# = '0' WHERE `guid` = ?d", $key.'_cure' ,$this->guid);
        continue;
      }
      getCureValue ($regenerated, $value, $regen[$key], $cure[$key]);
      $adb -> query ("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $key.'_cure' ,$cure[$key] ,$this->guid);
    }
  }
  /*Проверка травм у персонажа*/
  function Travm ()
  {
    global $adb;
    $db = $adb -> selectRow ("SELECT `travm`, 
                                     `travm_old_stat`, 
                                     `travm_stat` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $this->guid);
    list ($travm, $travm_old_stat, $travm_stat) = array_values ($db);
    
    if (!$travm)
      return;
    
    if (floor (($travm - time()) / 60) > 0)
      return;
    
    $adb -> query ("UPDATE `characters` SET `travm` = '0' WHERE `guid` = ?d" ,$this->guid);
    $adb -> query ("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $travm_stat ,$travm_old_stat ,$this->guid);
  }
  /*Проверка на получение апа/лвла*/
  function Up ()
  {
    global $adb, $history, $equip;
    $db = $adb -> selectRow ("SELECT `exp`, 
                                     `next_up`, 
                                     `level` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $this->guid);
    list ($cur_exp, $cur_up, $cur_level) = array_values ($db);
    
    if ($cur_exp < $cur_up)
      return;
    
    $next_up_id = $adb -> selectCell ("SELECT `up` FROM `player_exp_for_level` WHERE `exp` = ?d", $cur_up) + 1;
    $exp_table = $adb -> selectRow ("SELECT `level`, `exp`, 
                                            `ups`, `skills`, 
                                            `money`, `vit`, 
                                            `add_bars`, `status` 
                                     FROM `player_exp_for_level` 
                                     WHERE `up` = ?d", $next_up_id);
    list ($next_level, $next_exp, $next_ups, $next_skills, $next_money, $next_vit, $add_bars, $next_status) = array_values ($exp_table);
    $adb -> query ("UPDATE `characters` 
                    SET `next_up` = ?d, 
                        `money` = `money` + ?d 
                    WHERE `guid` = ?d", $next_exp ,$next_money ,$this->guid);
    $adb -> query ("UPDATE `character_stats` 
                    SET `ups` = `ups` + ?d, 
                        `skills` = `skills` + ?d 
                    WHERE `guid` = ?d", $next_ups ,$next_skills ,$this->guid);
    $history -> transfers ('Get', "$next_money кр.", $_SERVER['REMOTE_ADDR'], 'Level');
    
    if ($next_level <= $cur_level)
      return;
    
    $adb -> query ("UPDATE `characters` 
                    SET `level` = ?d, 
                        `status` = ?s 
                    WHERE `guid` = ?d", $next_level ,$next_status ,$this->guid);
    $equip -> increaseStat ('vit', $next_vit);
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
        $adb -> query ("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $value ,$bar_enums[$value]."|1" ,$this->guid);
      }
    }
  }
  /*Проверка участия персонажа в походе*/
  function Move ()
  {
    global $adb;
    $speed = $adb -> selectCell ("SELECT `speed` FROM `characters` WHERE `guid` = ?d", $this->guid);
    $ld = $adb -> selectRow ("SELECT `time`, 
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
    $to_go_sec = floor (($all_time - time()));    /*seconds*/
    $time_to_go = floor ($len / $speed * 3600);    /*секунд идти*/
    $atg = $time_to_go - $to_go_sec;
    $len_done = getMoney ($speed * $atg / 3600);
    $speed_form = getMoney ($speed / 1000);
    if ($to_go > 0)
    {
      echo "Вы идете.<br>"
         . "Назначение: <b>$dest</b><br>"
         . "Направление: <b>$napr</b><br>"
         . "Расстояние: <b>$len (м)</b><br>"
         . "Пройдено: <b>$len_done (м)</b><br>"
         . "Скорость: <b>$speed_form (км/час)</b><br>"
         . "Осталось времени: <b>".getFormatedTime ($all_time)."</b><br><br>"
         . "<input type='button' onclick=\"location.reload();\" value='Обновить' id='refresh' size='20' class='anketa' style='background-color: #e4e4e4;'>";
      die ();
    }
    else
    {
      echo "Вы пришли в <b>$dest</b>";
      $walk_coef = $len / 10000;
      
      if ($des_g == 'mountown_forest' || $des_g == 'Mountown')
        $room = "forest";
      
      $adb -> query ("UPDATE `characters` 
                      SET `city` = ?s, 
                          `room` = ?s 
                      WHERE `guid` = ?d", $dest ,$room ,$this->guid);
      $adb -> query ("UPDATE `character_stats` SET `walk` = `walk` + ?d WHERE `guid` = ?d", $walk_coef ,$this->guid);
      $adb -> query ("DELETE FROM `goers` WHERE `guid` = ?d", $this->guid);
      die ("<script>location.href = 'main.php?action=go&room_go=$room';</script>");
    }
  }
  /*Проверка правельности перехода*/
  function Go ($room_go)
  {
    if (!$room_go)
      $this -> Map (102);
    
    global $adb;
    $db = $adb -> selectRow ("SELECT `room`, `city`, 
                                     `sex`, `level`, 
                                     `admin_level`, 
                                     `mass`, `maxmass`, 
                                     `orden`, `last_go`, 
                                     `prision` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $this->guid);
    list ($room, $city, $sex, $level, $admin_level, $mass, $maxmass, $orden, $last_go, $prision) = array_values ($db);
    $time_to_go = $adb -> selectCell ("SELECT `time_to_go` FROM `city_rooms` WHERE `room` = ?s", $room);
    $room_info = $adb -> selectRow ("SELECT `room`, `from`, 
                                            `min_level`, 
                                            `need_orden`, 
                                            `sex` 
                                     FROM `city_rooms` 
                                     WHERE `room` = ?s 
                                       and `city` = ?s", $room_go ,$city);
    if (!$room_info)
      $this -> Map (102);
    
    list ($room_go, $from, $min_level, $need_orden, $need_sex) = array_values ($room_info);
    
    if ($prision != 0)
      $this -> Map (100);
    
    if ($mass > $maxmass)
      $this -> Map (103, "$mass|$maxmass");
    
    if ($level < $min_level)
      $this -> Map (101, ($min_level - 1));
    
    if ($need_orden)
      $this -> Map (102);
    
    if ($need_sex && $sex != $need_sex)
    {
      $need_sex = ($need_sex == 'female') ?'женщинам' :'мужчинам';
      $this -> Map (104, $need_sex);
    }
    
    if (!in_array ($room, explode (',', $from)) && $room != $room_go)
      $this -> Map (102);
    
    if (($time_to_go - (time () - $last_go)) > 0)
      $this -> Map (110);
  }
  /*Проверка всех предметов*/
  function Items ()
  {
    global $adb, $equip;
    $wear = $adb -> selectRow ("SELECT `helmet`, `bracer`, 
                                       `hand_r`, `armor`, 
                                       `shirt`, `cloak`, 
                                       `belt`, `earring`, 
                                       `amulet`, `ring1`, 
                                       `ring2`, `ring3`, 
                                       `gloves`, `hand_l`, 
                                       `pants`, `boots` 
                                FROM `character_equip` 
                                WHERE `guid` = ?d", $this->guid);
    foreach ($wear as $key => $value)
    {
      if ($value != 0 && !($equip -> checkItemStats ($value)))
        $equip -> equipItem ($value, -1);
    }
    $rows = $adb -> select ("SELECT `c`.`id`, 
                                    `c`.`wear`, 
                                    `c`.`mailed`, 
                                    `i`.`mass` 
                             FROM `character_inventory` AS `c` 
                             LEFT JOIN `item_template` AS `i` 
                             ON `c`.`item_template` = `i`.`entry` 
                             WHERE `c`.`guid` = ?d", $this->guid);
    $mass = $adb -> selectCell ("SELECT `mass` FROM `characters` WHERE `guid` = ?d", $this->guid);
    $all_mass = 0;
    foreach ($rows as $inventory)
    {
      if (!$inventory['mailed'] && !$inventory['wear'])
        $all_mass += $inventory['mass'];
      
      if ($equip -> checkItemValidity ($inventory['id']))
        continue;
      
      if (!$inventory['wear'])
        $equip -> deleteItem ($inventory['id']);
      else if ($inventory['wear'])
      {
        $equip -> equipItem ($inventory['id'], -1);
        $equip -> deleteItem ($inventory['id']);
      }
    }
    
    if ($all_mass != $mass)
      $adb -> query ("UPDATE `characters` SET `mass` = ?f WHERE `guid` = ?d", $all_mass ,$this->guid);
  }
  /*Проверка доступности комнаты*/
  function Room ()
  {
    global $adb, $action;
    $actions = array ('none', 'go', 'admin', 'enter', 'exit');
    $room = $adb -> selectCell ("SELECT `room` FROM `characters` WHERE `guid` = ?d", $this->guid);
    
    if ($room == 'mail' && !in_array ($action, $actions))
      $this -> Map (105);
    
    if ($room == 'bank' && !in_array ($action, $actions))
      $this -> Map (0);
  }
  /*Проверка состояния персонажа*/
  function Afk ()
  {
    global $adb;
    $db = $adb -> selectCell ("SELECT `last_time`, `dnd` FROM `characters` WHERE `guid` = ?d", $this->guid);
    
    if ((time () - $db['last_time']) >= 300 && !$db['dnd'])
      $adb -> query ("UPDATE `characters` SET `afk` = '1' WHERE `guid` = ?d", $this->guid);
  }
  /*Обновление состояния персонажа*/
  function WakeUp ()
  {
    global $adb;
    $adb -> query ("UPDATE `characters` SET `last_time` = ?d WHERE `guid` = ?d", time () ,$this->guid);
    $adb -> query ("UPDATE `online` SET `last_time` = ?d WHERE `guid` = ?d", time () ,$this->guid);

    if ($adb -> selectCell ("SELECT `afk` FROM `characters` WHERE `guid` = ?d", $this->guid))
      $adb -> query ("UPDATE `characters` SET `afk` = '0', `message` = '' WHERE `guid` = ?d", $this->guid);
  }
}

/*Функции работы с предметами и персонажем*/
class Equip extends Error
{
  private $guid;
  /*Присваивание guid персонажа переменной класса*/
  function& setguid ($guid)
  {
    $object = new Equip;
    $object->guid = $guid;
    return $object;
  }
  /*Вычисление цены продажи предмета*/
  function getSellValue ($item_id, $type = 'none')
{
    if ($item_id == 0 || !is_numeric($item_id))
      return 0;
    
    global $adb;
    $item_info = $adb -> selectRow ("SELECT `i`.`price_euro`, `i`.`price`, 
                                            `c`.`tear_cur`, `c`.`tear_max`, 
                                            `i`.`tear` 
                                     FROM `character_inventory` AS `c` 
                                     LEFT JOIN `item_template` AS `i` 
                                     ON `c`.`item_template` = `i`.`entry` 
                                     WHERE `c`.`id` = ?d
                                       and `c`.`guid` = ?d
                                      and (`i`.`item_flags` & '1');", $item_id ,$this->guid);
    if (!$item_info)
      return 0;
    
    list ($price_euro, $price, $tear_cur, $tear_max, $max_tear) = array_values ($item_info);
    $price = ($type == 'euro') ?$price_euro :$price;
    if ($tear_cur == 0 && $tear_max < $max_tear)
      $cof = abs (2 + (((100 - (($tear_max / $max_tear) * 100)) * 2) / 100));
    else if ($tear_cur == 0 && $tear_max > $max_tear)
      $cof = abs (2 - (((100 - (($max_tear / $tear_max) * 100)) * 2) / 100));
    else if ($tear_cur > 0 && $tear_max <= $max_tear)
      $cof = abs (4 - (((100 - (($tear_cur / $tear_max) * 100)) * 2) / 100) + (((100 - (($tear_max / $max_tear) * 100)) * 2) / 100));
    else if ($tear_cur > 0 && $tear_max > $max_tear)
      $cof = abs (4 - (((100 - (($tear_cur / $tear_max) * 100)) * 2) / 100) + (((100 - (($max_tear / $tear_max) * 100)) * 2) / 100));
    else if ($tear_cur == 0 && $tear_max == $max_tear)
      $cof = 2;
    $sell = round (($price / $cof), 2);
    
    if ($sell < 0.01)
      $sell = 0.01;
    
    return $sell;
  }
  /*Вычисление цены покупки предмета*/
  function getBuyValue (&$value)
  {
    global $adb;
    $trade = $adb -> selectCell ("SELECT `trade` FROM `character_stats` WHERE `guid` = ?d", $this->guid);
    $value = round (($value - $trade / 50), 2);
  }
  /*Проверка характеристик предмета и персонажа*/
  function checkItemStats ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return false;
    
    global $adb;
    $dat = $adb -> selectRow ("SELECT `i`.`min_level`, 
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
    $stats = $adb -> selectRow ("SELECT `c`.`level`, 
                                        `c`.`sex`, `c`.`orden`, 
                                        `s`.`str`, `s`.`dex`, 
                                        `s`.`con`, `s`.`vit`, 
                                        `s`.`int`, `s`.`wis`, 
                                        `s`.`mp_all`, 
                                        `s`.`sword`, `s`.`axe`, 
                                        `s`.`fail`, `s`.`knife`, 
                                        `s`.`staff`, 
                                        `s`.`fire`, `s`.`water`, 
                                        `s`.`air`, `s`.`earth`, 
                                        `s`.`light`, `s`.`gray`, 
                                        `s`.`dark` 
                                 FROM `characters` AS `c` 
                                 LEFT JOIN `character_stats` AS `s` 
                                 ON `c`.`guid` = `s`.`guid` 
                                 WHERE `c`.`guid` = ?d", $this->guid);
    foreach ($stats as $key => $value)
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
    
    global $adb;
    $date = $adb -> selectCell ("SELECT `date` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d", $this->guid ,$item_id);
    
    if ($date != 0 && $date < time ())
      return false;
    
    return true;
  }
  /*Проверка отображения модификаторов*/
  function checkHandStatus ($hand)
  {
    global $adb;
    $wear = $adb -> selectRow ("SELECT `hand_l_free`, `hand_r_free`, 
                                       `hand_l_type`, 
                                       `hand_l`, `hand_r` 
                                FROM `character_equip` 
                                WHERE `guid` = ?d", $this->guid);
    list ($hand_l_free, $hand_r_free, $hand_l_type, $hand_l, $hand_r) = array_values($wear);
    switch ($hand)
    {
      case 'r':
        if ($hand_r != 0 || ($hand_l_free == 1 & $hand_r_free == 1) || $hand_l_type == 'shield')
          return true;
      break;
      case 'l':
        if ($hand_l != 0 && $hand_l_type != 'shield')
          return true;
      break;
      default:
        return false;
      break;
    }
  }
  /*Удаление предмета*/
  function deleteItem ($item_id)
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return;
    
    global $adb, $history;
    $name = $adb -> selectCell ("SELECT `i`.`name`
                                 FROM `character_inventory` AS `c` 
                                 LEFT JOIN `item_template` AS `i` 
                                 ON `c`.`item_template` = `i`.`entry` 
                                 WHERE `c`.`guid` = ?d 
                                   and `c`.`id` = ?d 
                                   and `c`.`wear` = '0' 
                                   and `c`.`mailed` = '0';", $this->guid ,$item_id);
    if (!$name)
      return;
    
    $adb -> query ("DELETE FROM `character_inventory` WHERE `id` = ?d", $item_id);
    $history -> transfers ('Throw out', $name, $_SERVER['REMOTE_ADDR'], 'Dump');
  }
  /*Отображение снаряжения*/
  function showEquipment ($type = '')
  {
    global $adb;
    $wear = $adb -> selectRow ("SELECT * FROM `character_equip` WHERE `guid` = ?d", $this->guid);
    $db = $adb -> selectRow ("SELECT `c`.`login`, `c`.`level`, 
                                     `c`.`shape`, `c`.`block`, 
                                     `c`.`hp`, `s`.`hp_all`, `s`.`hp_regen`, 
                                     `c`.`mp`, `s`.`mp_all`, `s`.`mp_regen` 
                              FROM `characters` AS `c` 
                              LEFT JOIN `character_stats` AS `s` 
                              ON `c`.`guid` = `s`.`guid` 
                              WHERE `c`.`guid` = ?d", $this->guid);
    list ($login, $level, $shape, $block, $hp, $hp_all, $hp_regen, $mp, $mp_all, $mp_regen) = array_values ($db);
    switch ($type)
    {
      case 'inv':
        $name = "alt='$login (Перейти в \"Умения\")' onclick=\"document.location = '?action=skills'\" style='cursor: pointer;'";
        $backup = "<img src='img/items/w20.gif' border='0' alt='Пустой правый карман'><img src='img/items/w20.gif' border='0' alt='Пустой карман'><img src='img/items/w20.gif' border='0' alt='Пустой левый карман'><img src='img/items/w21.gif' border='0' alt='Смена оружия'><img src='img/items/w21.gif' border='0' alt='Смена оружия'><img src='img/items/w21.gif' border='0' alt='Смена оружия'>";
      break;
      case 'info':
        $name = "alt='$login'";
        $backup = "<img src='img/items/slot_bottom0.gif' border='0'>";
      break;
      default:
        $name = "alt='$login (Перейти в \"Инвентарь\")' onclick=\"document.location = '?action=inv&section=1'\" style='cursor: pointer;'";
        $backup = "<img src='img/items/w20.gif' border='0' alt='Пустой правый карман'><img src='img/items/w20.gif' border='0' alt='Пустой карман'><img src='img/items/w20.gif' border='0' alt='Пустой левый карман'><img src='img/items/w21.gif' border='0' alt='Смена оружия'><img src='img/items/w21.gif' border='0' alt='Смена оружия'><img src='img/items/w21.gif' border='0' alt='Смена оружия'>";
      break;
    }
    $armor = ($wear['cloak']) ?$wear['cloak'] :(($wear['armor']) ?$wear['armor'] :$wear['shirt']);
    $hand_l_type = (!$wear['hand_l']) ?((!$wear['hand_l_free']) ?"hand_l" :"hand_l_f") :$wear['hand_l_type'];
    echo "<table border='0' width='227' class='posit' cellspacing='0' cellpadding='0'>";
    
    if ($block)
      echo "<tr><td colspan='3' align='center'><b><font color='#FF0000'>Персонаж заблокирован!</font></b></td></tr>";
    
    echo "<tr bgColor='#dedede'>"
       . "<td width='60' align='left' valign='top'>"
       . $this -> showItemEquiped ($wear['helmet'], "helmet")
       . $this -> showItemEquiped ($wear['bracer'], "bracer")
       . $this -> showItemEquiped ($wear['hand_r'], $wear['hand_r_type'])
       . $this -> showItemEquiped ($armor, "armor")
       . $this -> showItemEquiped ($wear['belt'], "belt")
       . "</td>"
       . "<td width='120' align='center' valign='middle'>"
       . "<table cellspacing='0' cellpadding='0' height='20'>"
       . "<tr><td style='font-size: 9px; position: relative;'><div id='HP'></div><div id='MP'></div></td></tr>"
       . "</table><img src='img/chars/$shape' $name><br>"
       . $backup
       . "</td>"
       . "<td width='60' align='right' valign='top'>"
       . $this -> showItemEquiped ($wear['earring'], "earring")
       . $this -> showItemEquiped ($wear['amulet'], "amulet")
       . $this -> showItemEquiped ($wear['ring1'], "ring")
       . $this -> showItemEquiped ($wear['ring2'], "ring")
       . $this -> showItemEquiped ($wear['ring3'], "ring")
       . $this -> showItemEquiped ($wear['gloves'], "gloves")
       . $this -> showItemEquiped ($wear['hand_l'], $hand_l_type)
       . $this -> showItemEquiped ($wear['pants'], "pants")
       . $this -> showItemEquiped ($wear['boots'], "boots")
       . "</td></tr></table>"
       . "<script>"
       . "showHP ($hp, $hp_all, $hp_regen);"
       . "showMP ($mp, $mp_all, $mp_regen);"
       . "</script>";
  }
  /*Перечисление предметов нуждающихся в ремонте*/
  function needItemRepair ()
  {
    global $adb;
    $rows = $adb -> select ("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                    `i`.`name` 
                             FROM `character_inventory` AS `c` 
                             LEFT JOIN `item_template` AS `i` 
                             ON `c`.`item_template` = `i`.`entry` 
                             WHERE `c`.`guid` = ?d 
                               and `c`.`wear` = '1'", $this->guid);
    $return = '';
    foreach ($rows as $repair)
    {
      list ($tear_cur, $tear_max, $name) = array_values ($repair);
      
      if ($tear_cur >= $tear_max * 0.90)
        $return .= "&nbsp;<b>$name</b> [<font color='#990000'>".floor ($tear_cur)."/".ceil ($tear_max)."</font>] требуется ремонт<br>";
    }
    return $return;
  }
  /*Отображение предмета на персонаже*/
  function showItemEquiped ($item_id, $type)
  {
    global $adb, $action;
    $lang = $adb -> selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");
    switch ($type)
    {
      case 'amulet':
      case 'earring':
        $w = 60;
        $h = 20;
      break;
      case 'armor':
      case 'pants':
        $w = 60;
        $h = 80;
      break;
      case 'belt':
      case 'bracer':
      case 'gloves':
      case 'boots':
        $w = 60;
        $h = 40;
      break;
      case 'ring':
        $w = 20;
        $h = 20;
      break;
      case 'animal':
        $w = 90;
        $h = 60;
      break;
      default:
      case 'axe':
      case 'fail':
      case 'sword':
      case 'knife':
      case 'staff':
      case 'helmet':
      case 'shield':
      case 'acsess':
        $w = 60;
        $h = 60;
      break;
    }
    if ($item_id == 0)
      return "<img src='img/items/w$type.gif' width='$w' height='$h' border='0' alt='".$lang[$type.'_f']."'>";
    if (!($this -> checkItemStats ($item_id)))
    {
      $this -> equipItem ($item_id, -1);
      return;
    }
    $dat = $adb -> selectRow ("SELECT `c`.`tear_cur`, `c`.`tear_max`, 
                                      `i`.`min_attack`, `i`.`max_attack`, 
                                      `i`.`name`, `i`.`img`, 
                                      `i`.`add_hp`, 
                                      `i`.`def_h_min`, `i`.`def_h_max`, 
                                      `i`.`def_a_min`, `i`.`def_a_max`, 
                                      `i`.`def_b_min`, `i`.`def_b_max`, 
                                      `i`.`def_l_min`, `i`.`def_l_max` 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_template` = `i`.`entry` 
                               WHERE `c`.`guid` = ?d
                                 and `c`.`id` = ?d", $this->guid ,$item_id);
    list ($tear_cur, $tear_max, $min_attack, $max_attack, $name, $img, $add_hp, $def_h_min, $def_h_max, $def_a_min, $def_a_max, $def_b_min, $def_b_max, $def_l_min, $def_l_max) = array_values ($dat);
    $tear_show = ($tear_cur >= $tear_max * 0.90) ?"<font color=#990000>".floor ($tear_cur)."/".ceil ($tear_max)."</font>" :floor ($tear_cur)."/".ceil ($tear_max);
    $name = ($action == 'inv') ?"Снять $name" :$name;
    $protect = array (
      'h' => array ($def_h_min, $def_h_max, $this -> getFormatedBrick ($def_h_min, $def_h_max)),
      'a' => array ($def_a_min, $def_a_max, $this -> getFormatedBrick ($def_a_min, $def_a_max)),
      'b' => array ($def_b_min, $def_b_max, $this -> getFormatedBrick ($def_b_min, $def_b_max)),
      'l' => array ($def_l_min, $def_l_max, $this -> getFormatedBrick ($def_l_min, $def_l_max))
    );
    $desc = "$name";
    $return = "";
    $color = ($tear_cur >= $tear_max * 0.90) ?" class='broken'" :"";
    
    if ($min_attack > 0 || $max_attack > 0)
      $desc .= "<br>$lang[damage]: $min_attack - $max_attack";
    
    if ($add_hp > 0)
      $desc .= "<br>$lang[add_hp]: +$add_hp";
    else if ($add_hp < 0)
      $desc .= "<br>$lang[add_hp]: $add_hp";
    
    foreach ($protect as $key => $value)
    {
      if ($value[0] > 0)
        $desc .= "<br>".$lang['def_'.$key].": $value[0]-$value[1] $value[2]";
    }
    $return_format = ($action == 'inv') ?"<a href='main.php?action=unwear_item&item_id=$item_id'>%s</a>" :"%s";
    $return .= "<img src='img/items/$img' width='$w' height='$h' border='0' alt='$desc<br>$lang[durability]: $tear_show'$color>";
    return sprintf ($return_format, $return);
  }
  /*Отображение предмета в инвентаре*/
  function showItemInventory ($item_info, $type, $i, $mail_guid = '')
  {
    global $adb;
    $weapons = array ('knife', 'fail', 'sword', 'axe', 'staff');
    $armors = array ('boots' => '_l', 'light_armor' => '_a', 'heavy_armor' => '_a', 'helmet' => '_h', 'pants' => '_b');
    $types = array ('inv', 'sell', 'mail_to', 'mail_in');
    $lang = $adb -> selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");
    $db = $adb -> selectRow ("SELECT `c`.`money`, `c`.`money_euro`, 
                                     `c`.`level`, `c`.`sex`, 
                                     `s`.`trade`, 
                                     `s`.`str`, `s`.`dex`, 
                                     `s`.`con`, `s`.`vit`, 
                                     `s`.`int`, `s`.`wis`, 
                                     `s`.`mp_all`, 
                                     `s`.`sword`, `s`.`fail`, 
                                     `s`.`staff`, `s`.`knife`, 
                                     `s`.`axe`, 
                                     `s`.`fire`, `s`.`water`, 
                                     `s`.`air`, `s`.`earth` 
                              FROM `characters` AS `c` 
                              LEFT JOIN `character_stats` AS `s` 
                              ON `c`.`guid` = `s`.`guid` 
                              WHERE `c`.`guid` = ?d", $this->guid);
    $money = $db['money'];
    $money_euro = $db['money_euro'];
    $trade = $db['trade'];
    $entry = $item_info['entry'];
    $name = $item_info['name'];
    $img = $item_info['img'];
    $i_type = $item_info['type'];
    $mass = $item_info['mass'];
    $price = $item_info['price'];
    $price_euro = $item_info['price_euro'];
    if ($price_euro > 0)
    {
      $this -> getBuyValue ($price_euro);
      $price_s = ($price_euro > $money_euro) ?"<font color='#FF0000'>$price_euro</font> екр." :"$price_euro екр.";
    }
    else if ($price > 0)
    {
      $this -> getBuyValue ($price);
      $price_s = ($price > $money) ?"<font color='#FF0000'>$price</font> кр." :"$price кр.";
    }
    $item_flags = $item_info['item_flags'];
    $item_id = (isset($item_info['id'])) ?$item_info['id'] :0;
    $made_in = (isset($item_info['made_in'])) ?$adb -> selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $item_info['made_in']) :'';
    $tear_cur = (isset($item_info['tear_cur'])) ?floor ($item_info['tear_cur']) :0;
    $tear_max = (isset($item_info['tear_max'])) ?ceil ($item_info['tear_max']) :$item_info['tear'];
    $color = ($tear_cur >= $tear_max * 0.9) ?" class='broken'" :"";
    $validity = (isset($item_info['date'])) ?$item_info['date'] :$item_info['validity'];
    $gift = (isset($item_info['gift'])) ?$item_info['gift'] :0;
    $gift_author = (isset($item_info['gift_author'])) ?$item_info['gift_author'] :'';
    $inc_count = (isset($item_info['inc_count_p'])) ?$item_info['inc_count_p'] :$item_info['inc_count'];
    $add['str'] = (isset($item_info['inc_str'])) ?$item_info['add_str'] + $item_info['inc_str'] :$item_info['add_str'];
    $add['dex'] = (isset($item_info['inc_dex'])) ?$item_info['add_dex'] + $item_info['inc_dex'] :$item_info['add_dex'];
    $add['con'] = (isset($item_info['inc_con'])) ?$item_info['add_con'] + $item_info['inc_con'] :$item_info['add_con'];
    $add['int'] = (isset($item_info['inc_int'])) ?$item_info['add_int'] + $item_info['inc_int'] :$item_info['add_int'];
    $chet = ($i) ?"C7C7C7" :"D5D5D5";
    $return = "<div id='item_id_$item_id' name='item_entry_$entry'><table width='100%' border='0' cellspacing='1' cellpadding='0' bgColor='#a5a5a5' style='margin-top: -1px;'><tr bgColor='#$chet'>";
    switch ($type)
    {
      case 'inv':
        $wearable = $this -> checkItemStats ($item_id);
        $return .= "<td width='150' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        
        if ($wearable)
          $return .= "<a href='?action=wear_item&item_id=$item_id' class='nick'>надеть</a>&nbsp;";
        
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
        $s_price = ($price_euro > 0) ?$this -> getSellValue ($item_id, 'euro')." екр." :$this -> getSellValue ($item_id)." кр.";
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='javascript:sellItem ($item_id);' onclick=\"if (confirm ('Вы уверены что хотите продать предмет $name за $s_price?')){return true;} else {return false;}\" class='nick'>продать за $s_price</a>";
      break;
      case 'mail_to':
        global $mail;
        $s_price = $mail -> getValue ($item_id)." кр.";
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=send_item&mail_to=$mail_guid&item_id=$item_id' onclick=\"if (confirm ('Отправить предмет $name?')){return true;} else {return false;}\" class='nick'>передать за $s_price</a>";
      break;
      case 'mail_in':
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=get_item&item_id=$item_id' onclick=\"if (confirm ('Забрать предмет $name?')){return true;} else {return false;}\" class='nick'>Забрать</a><br><a href='main.php?do=return_item&item_id=$item_id' onclick=\"if (confirm ('Отказаться от предмета $name?')){return true;} else {return false;}\" class='nick'>Отказаться</a>";
        $return .= "<br><small>(".getFormatedTime ($item_info['delivery_time'] + 5184000).")</small>";
      break;
      case 'money_in':
        $name = sprintf ($name, $item_info['count']);
        $price_s = "$item_info[count] кр.";
        $mail_id = $item_info['id'];
        $return .= "<td width='260' align='center'>";
        $return .= "<img src='img/items/$img' border='0'$color /><br><center style='padding-top: 4px;'>";
        $return .= "<a href='main.php?do=get_money&mail_id=$mail_id' onclick=\"if (confirm ('Забрать $price_s?')){return true;} else {return false;}\" class='nick'>Забрать</a><br><a href='main.php?do=return_money&mail_id=$mail_id' onclick=\"if (confirm ('Отказаться от $price?')){return true;} else {return false;}\" class='nick'>Отказаться</a>";
        $return .= "<br><small>(".getFormatedTime ($item_info['delivery_time'] + 5184000).")</small>";
      break;
    }
    $return .= "</td><td align='left' valign='top' style='padding: 2px;'>";
    $tear_show = ($tear_cur >= $tear_max * 0.90) ?"<font color='#990000'>$tear_cur/$tear_max</font>" :"$tear_cur/$tear_max";
    $required = array ('dex', 'con', 'int', 'level', 'fire', 'water', 'air', 'earth', 'sword', 'axe', 'fail', 'knife', 'staff', 'vit', 'str', 'mp_all', 'wis', 'sex');
    $modifiers = array ('mf_critpower', 'mf_anticrit', 'mf_antiuvorot', 'mf_piercearmor', 'mf_crit', 'mf_parry', 'mf_blockshield', 'mf_uvorot', 'mf_contr', 'repres_all_magic',
                        'repres_fire', 'repres_water', 'repres_air', 'repres_earth', 'mf_all_magic', 'mf_fire', 'mf_water', 'mf_air', 'mf_earth', 'mf_all_damage',
                        'mf_sting', 'mf_slash', 'mf_crush', 'mf_sharp', 'all_magic', 'fire', 'water', 'air', 'earth', 'light', 'gray', 'dark', 'all_mastery',
                        'sword', 'axe', 'fail', 'knife', 'staff', 'shot', 'resist_all_magic', 'resist_fire', 'resist_water', 'resist_air', 'resist_earth',
                        'resist_light', 'resist_gray', 'resist_dark', 'resist_all_damage', 'resist_sting', 'resist_slash', 'resist_crush', 'resist_sharp', 'add_hp',
                        'add_mp', 'mpcons', 'mpreco', 'hpreco', 'add_attack_min', 'add_attack_max');
    $w_modifiers = array ('mf_antiuvorot', 'mf_crit', 'mf_critpower', 'mf_sting', 'mf_slash', 'mf_crush', 'mf_sharp', 'sword', 'axe', 'fail', 'knife', 'mf_piercearmor');
    $chances = array ('chance_sting', 'chance_slash', 'chance_crush', 'chance_sharp', 'chance_fire', 'chance_water', 'chance_air', 'chance_earth', 'chance_light', 'chance_dark');
    $features = array ('resist_all_damage', 'resist_sting', 'resist_slash', 'resist_crush', 'resist_sharp');
    $def = array (
      'h' => array ($item_info['def_h_min'], $item_info['def_h_max'], $this -> getFormatedBrick ($item_info['def_h_min'], $item_info['def_h_max'])),
      'a' => array ($item_info['def_a_min'], $item_info['def_a_max'], $this -> getFormatedBrick ($item_info['def_a_min'], $item_info['def_a_max'])),
      'b' => array ($item_info['def_b_min'], $item_info['def_b_max'], $this -> getFormatedBrick ($item_info['def_b_min'], $item_info['def_b_max'])),
      'l' => array ($item_info['def_l_min'], $item_info['def_l_max'], $this -> getFormatedBrick ($item_info['def_l_min'], $item_info['def_l_max']))
    );
    $min_attack = $item_info['min_attack'];
    $max_attack = $item_info['max_attack'];
    $block = $item_info['block'];
    $hands = $item_info['hands'];
    $url = str_replace ('.gif', '.html', $item_info['img']);
    $orden = "&nbsp;&nbsp;";
    $need_orden = $item_info['orden'];
    if ($need_orden != 0)
    {
      switch ($need_orden)
      {
        case 1:    $orden_dis = "Белое братство";       break;
        case 2:    $orden_dis = "Темное братство";      break;
        case 3:    $orden_dis = "Нейтральное братство"; break;
        case 4:    $orden_dis = "Алхимик";              break;
        case 5:    $orden_dis = "Тюремный заключенный"; break;
      }
      $orden = "<img src='img/orden/align$need_orden.gif' border='0' alt='$lang[min_bent]: <strong>$orden_dis</strong>'>";
    }
    $return .= "<a href='encicl/object/$url' class='nick' target='_blank'><b>$name</b></a>&nbsp;$orden&nbsp;($lang[mass]: $mass)";
    
    if ($gift == 1)
      $return .= "&nbsp;<img src='img/icon/gift.gif' width='14' height='14' border='0' alt='$lang[gift] $gift_author'>";
    
    if ($item_flags & 4)
      $return .= "&nbsp;<img src='img/icon/artefakt.gif' width='16' height='16' border='0' alt='$lang[artefact]'>";
    
    $return .= "<br><b>$lang[price]: $price_s</b>";
    $return .= "<br>$lang[durability]: $tear_show";
    
    if (($type == 'inv' | $type == 'sell') && $validity > 0) $return .= "<br>".sprintf ($lang['validity'], date ('d.m.y H:i', $validity), getFormatedTime ($validity));
    else if ($type == 'shop' && $validity > 0)               $return .= "<br>$lang[val_life]: ".getFormatedTime ($validity * 3600 + time ());
    
    foreach ($required as $key)
    {
      if (($key != 'sex' && $item_info['min_'.$key] > 0) || ($key == 'sex' && $item_info[$key]))
      {
        $return .= "<br><b>$lang[required]:</b>";
        break;
      }
    }
    foreach ($required as $key)
    {
      if ($key != 'sex' && $item_info['min_'.$key] > 0) $return .= ($item_info['min_'.$key] > $db[$key]) ?"<br>&bull; <font color='#FF0000'>$lang[$key]: {$item_info['min_'.$key]}</font>" :"<br>&bull; $lang[$key]: ".$item_info['min_'.$key];
      else if ($key == 'sex' && $item_info[$key] != '') $return .= ($item_info[$key] != $db[$key]) ?"<br>&bull; <font color='#FF0000'>$lang[$key]: ".$lang[$item_info[$key]]."</font>" :"<br>&bull; $lang[$key]: ".$lang[$item_info[$key]];
    }
    $mod_yes = false;
    foreach ($modifiers as $key)
    {
      if ($item_info[$key] == 0)
        continue;
      
      $return .= "<br><b>$lang[act]:</b>";
      $mod_yes = true;
      break;
    }
    if (!$mod_yes && ($add['str'] != 0 || $add['dex'] != 0 || $add['con'] != 0 || $add['int'] != 0 
        || $def['h'][1] != 0 || $def['a'][1] != 0 || $def['b'][1] != 0 || $def['l'][1] != 0 || $inc_count > 0 
        || (!in_array ($i_type, $weapons) && ($max_attack != 0 || $min_attack != 0))))
      $return .= "<br><b>$lang[act]:</b>";
    
    if ($inc_count > 0)              $return .= "<br>&bull; $lang[inc_count]: <span id='inc_count'>$inc_count</span>";
    foreach ($modifiers as $key)
    {
      if ($item_info[$key] > 0)      $return .= "<br>&bull; $lang[$key]: +".$item_info[$key];
      else if ($item_info[$key] < 0) $return .= "<br>&bull; $lang[$key]: ".$item_info[$key];
    }
    foreach ($add as $key => $value)
    {
      if ($value == 0 && $type == 'inv' && $inc_count > 0)    $return .= "<br>&bull; $lang[$key]: <span id='inc_{$item_id}_{$key}_val'>$value</span> ".$this->getIncButton ($item_id, $key);
      else if ($value > 0 && $type == 'inv' && $inc_count > 0)$return .= "<br>&bull; $lang[$key]: <span id='inc_{$item_id}_{$key}_val'>+$value</span> ".$this->getIncButton ($item_id, $key);
      else if ($value > 0)                                    $return .= "<br>&bull; $lang[$key]: +$value";
      else if ($value < 0)                                    $return .= "<br>&bull; $lang[$key]: $value";
    }
    foreach ($def as $key => $value)
    {
      if ($value[1] > 0)
        $return .= "<br>&bull; ".$lang['def_'.$key].": $value[0]-$value[1] $value[2]";
    }
    if (in_array ($i_type, $weapons))
    {
      $return .= "<br><b>$lang[behaviour]:</b>";
      $return .= "<br>&bull; $lang[damage]: $min_attack - $max_attack";
      foreach ($w_modifiers as $key)
      {
        if ($item_info[$key.'_h'] != 0)
          $return .= "<br>&bull; $lang[$key]: ".$item_info[$key.'_h'];
      }
      
      if ($item_flags & 16) $return .= "<br>&bull; $lang[sec_hand]";
      else if ($hands == 2) $return .= "<br>&bull; $lang[two_hands]";
      
      $return .= "<br>&bull; $lang[blocks]: ";
      
      if ($block == 1)      $return .= "+";
      else if ($block == 2) $return .= "++";
      else                  $return .= "-";
      
      foreach ($chances as $key)
      {
        if ($item_info[$key] <= 0)
          continue;
        
        $return .= "<br><b>$lang[features]:</b>";
        break;
      }
      foreach ($chances as $key)
      {
        if ($item_info[$key] <= 0)
          continue;
        
        $this -> getFormatedChance ($item_info[$key]);
        $return .= "<br>&bull; $lang[$key]: ".$lang[$item_info[$key]];
      }
    }
    if (in_array ($i_type, array_keys ($armors)))
    {
      foreach ($features as $key)
      {
        if ($item_info[$key.$armors[$i_type]] <= 0)
          continue;
        
        $return .= "<br><b>$lang[features]:</b>";
        break;
      }
      foreach ($features as $key)
      {
        if ($item_info[$key.$armors[$i_type]] > 0)
          $return .= "<br>&bull; $lang[$key]: ".$item_info[$key.$armors[$i_type]];
      }
    }
    if ($item_info['description'])
      $return .= "<br><small>$lang[description]:<br>$item_info[description]</small>";
    
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
  function equipItem ($item_id, $type = 1, $guid = '')
  {
    if ($item_id == 0 || !is_numeric($item_id))
      return;
    
    global $adb;
    $error_id = ($type == 1) ?213 :214;
    $guid = (!$guid) ?$this->guid :$guid;
    $wear_status = ($type == 1) ?0 :1;
    $wear = $adb -> selectRow ("SELECT * FROM `character_equip` WHERE `guid` = ?d", $guid);
    $stats = $adb -> selectRow ("SELECT * FROM `character_stats` WHERE `guid` = ?d", $guid);
    $dat = $adb -> selectRow ("SELECT * 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_template` = `i`.`entry` 
                               WHERE `c`.`guid` = ?d 
                                 and `c`.`id` = ?d 
                                 and `c`.`wear` = ?d 
                                 and `c`.`mailed` = '0' 
                                 and `i`.`section` = 'item';", $guid ,$item_id ,$wear_status) or $this -> Inventory ($error_id);
    $i_entry = $dat['entry'];
    $i_id = $dat['id'];
    $i_type = ($dat['type'] == 'heavy_armor' || $dat['type'] == 'light_armor') ?"armor" :$dat['type'];
    $i_hands = $dat['hands'];
    
    if ($type == 1 && !($this -> checkItemStats ($i_id)))
      return;
    
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
            if ($wear['hand_r_free'])
              $slot = "hand_r";
            else if (!$wear['hand_r_free'] && $wear['hand_l_free'])
            {
              if ($dat['item_flags'] & 16)
                $slot = "hand_l";
              else
              {
                $this -> equipItem ($wear['hand_r'], -1);
                $this -> equipItem ($i_id);
                return;
              }
            }
            else if (!$wear['hand_r_free'] && !$wear['hand_l_free'])
            {
              $this -> equipItem ($wear['hand_r'], -1);
              $this -> equipItem ($i_id);
              return;
            }
          }
          else if ($i_hands == 2)
          {
            if ($wear['hand_r_free'] && $wear['hand_l_free'])
              $slot = "hand_r";
            else if ($wear['hand_r_free'] && !$wear['hand_l_free'])
            {
              $this -> equipItem ($wear['hand_l'], -1);
              $this -> equipItem ($i_id);
              return;
            }
            else if (!$wear['hand_r_free'] && $wear['hand_l_free'])
            {
              $this -> equipItem ($wear['hand_r'], -1);
              $this -> equipItem ($i_id);
              return;
            }
            else if (!$wear['hand_r_free'] && !$wear['hand_l_free'])
            {
              $this -> equipItem ($wear['hand_r'], -1);
              $this -> equipItem ($wear['hand_l'], -1);
              $this -> equipItem ($i_id);
              return;
            }
          }
          $w_type = $i_type;
        break;
        case 'shield':
          if ($wear['hand_l_free'])
            $slot = "hand_l";
          else if (!$wear['hand_l_free'] && !$wear['hand_r_free'])
          {
            if ($wear['hand_l'])
            {
              $this -> equipItem ($wear['hand_l'], -1);
              $this -> equipItem ($i_id);
              return;
            }
            else
            {
              $this -> equipItem ($wear['hand_r'], -1);
              $this -> equipItem ($i_id);
              return;
            }
          }
          $w_type = $i_type;
        break;
        case 'ring':
          if ($wear['ring1'] == 0)
            $slot = "ring1";
          else if ($wear['ring2'] == 0)
            $slot = "ring2";
          else if ($wear['ring3'] == 0)
            $slot = "ring3";
          if ($wear['ring1'] != 0 && $wear['ring2'] != 0 && $wear['ring3'] != 0)
          {
            $this -> equipItem ($wear['ring1'], -1);
            $this -> equipItem ($i_id);
            return;
          }
        break;
        default:
          if ($wear[$i_type] == 0)
            $slot = $i_type;
          else if ($wear[$i_type] != 0)
          {
            $this -> equipItem ($wear[$i_type], -1);
            $this -> equipItem ($i_id);
            return;
          }
        break;
      }
    }
    else if ($type == -1)
    {
      switch ($i_type)
      {
        case 'sword':
        case 'axe':
        case 'fail':
        case 'staff':
        case 'knife':
          if ($i_id == $wear['hand_r'])
            $slot = "hand_r";
          else if    ($i_id == $wear['hand_l'])
            $slot = "hand_l";
        break;
        case 'shield':
          $slot = "hand_l";
        break;
        case 'ring':
          if ($i_id == $wear['ring1'])
            $slot = "ring1";
          else if ($i_id == $wear['ring2'])
            $slot = "ring2";
          else if ($i_id == $wear['ring3'])
            $slot = "ring3";
        break;
        default:
          $slot = $i_type;
        break;
      }
    }
    $new_sql = array ();
    $resists = array ('', '_h', '_a', '_b', '_l');
    $defs = array ('h', 'a', 'b', 'l');
// Resist damage
    foreach ($resists as $key)
    {
      $new_sql['resist_sting'.$key] = $dat['resist_sting'.$key] + $dat['resist_all_damage'.$key];
      $new_sql['resist_slash'.$key] = $dat['resist_slash'.$key] + $dat['resist_all_damage'.$key];
      $new_sql['resist_crush'.$key] = $dat['resist_crush'.$key] + $dat['resist_all_damage'.$key];
      $new_sql['resist_sharp'.$key] = $dat['resist_sharp'.$key] + $dat['resist_all_damage'.$key];
    }
    // -- magic
    $new_sql['resist_fire'] = $dat['resist_fire'] + $dat['resist_all_magic'];
    $new_sql['resist_water'] = $dat['resist_water'] + $dat['resist_all_magic'];
    $new_sql['resist_air'] = $dat['resist_air'] + $dat['resist_all_magic'];
    $new_sql['resist_earth'] = $dat['resist_earth'] + $dat['resist_all_magic'];
    $new_sql['resist_light'] = $dat['resist_light'] + $dat['resist_all_magic'];
    $new_sql['resist_gray'] = $dat['resist_gray'] + $dat['resist_all_magic'];
    $new_sql['resist_dark'] = $dat['resist_dark'] + $dat['resist_all_magic'];
// Mastery
    $new_sql['sword'] = $dat['sword'] + $dat['all_mastery'];
    $new_sql['axe'] = $dat['axe'] + $dat['all_mastery'];
    $new_sql['fail'] = $dat['fail'] + $dat['all_mastery'];
    $new_sql['knife'] = $dat['knife'] + $dat['all_mastery'];
    // --
    $new_sql['shot'] = $dat['shot'];
    $new_sql['staff'] = $dat['staff'];
    // -- magic
    $new_sql['fire'] = $dat['fire'] + $dat['all_magic'];
    $new_sql['water'] = $dat['water'] + $dat['all_magic'];
    $new_sql['air'] = $dat['air'] + $dat['all_magic'];
    $new_sql['earth'] = $dat['earth'] + $dat['all_magic'];
    $new_sql['light'] = $dat['light'];
    $new_sql['gray'] = $dat['gray'];
    $new_sql['dark'] = $dat['dark'];
// MF damage
    $new_sql['mf_sting'] = $dat['mf_sting'] + $dat['mf_all_damage'];
    $new_sql['mf_slash'] = $dat['mf_slash'] + $dat['mf_all_damage'];
    $new_sql['mf_crush'] = $dat['mf_crush'] + $dat['mf_all_damage'];
    $new_sql['mf_sharp'] = $dat['mf_sharp'] + $dat['mf_all_damage'];
    // -- magic
    $new_sql['mf_fire'] = $dat['mf_fire'] + $dat['mf_all_magic'];
    $new_sql['mf_water'] = $dat['mf_water'] + $dat['mf_all_magic'];
    $new_sql['mf_air'] = $dat['mf_air'] + $dat['mf_all_magic'];
    $new_sql['mf_earth'] = $dat['mf_earth'] + $dat['mf_all_magic'];
    // --
    $new_sql['mf_crit'] = $dat['mf_crit'];
    $new_sql['mf_critpower'] = $dat['mf_critpower'];
    $new_sql['mf_antiuvorot'] = $dat['mf_antiuvorot'];
    $new_sql['mf_piercearmor'] = $dat['mf_piercearmor'];
    // --
    $new_sql['mf_anticrit'] = $dat['mf_anticrit'];
    $new_sql['mf_uvorot'] = $dat['mf_uvorot'];
    $new_sql['mf_contr'] = $dat['mf_contr'];
    $new_sql['mf_parry'] = $dat['mf_parry'];
    $new_sql['mf_blockshield'] = $dat['mf_blockshield'];
// Damage
    $new_sql['wp_min'] = $dat['add_attack_min'];
    $new_sql['wp_max'] = $dat['add_attack_max'];
// Protect
    foreach ($defs as $key)
    {
      $new_sql['def_'.$key.'_min'] = $dat['def_'.$key.'_min'];
      $new_sql['def_'.$key.'_max'] = $dat['def_'.$key.'_max'];
    }
// Stats
    $new_sql['cast'] = $dat['add_cast'];
    $new_sql['trade'] = $dat['add_trade'];
    $new_sql['walk'] = $dat['add_walk'];
    //$new_sql['cost'] = $dat['price'];
    $new_sql['hp_regen'] = $dat['hpreco'];
    $new_sql['mp_regen'] = $dat['mpreco'];
    switch ($slot)
    {
      case 'hand_r':
      case 'hand_l':
        $new_sql[$slot.'_sword'] = $dat['sword_h'];
        $new_sql[$slot.'_axe'] = $dat['axe_h'];
        $new_sql[$slot.'_fail'] = $dat['fail_h'];
        $new_sql[$slot.'_knife'] = $dat['knife_h'];
        $new_sql[$slot.'_sting'] = $dat['mf_sting_h'] + $dat['mf_all_damage_h'];
        $new_sql[$slot.'_slash'] = $dat['mf_slash_h'] + $dat['mf_all_damage_h'];
        $new_sql[$slot.'_crush'] = $dat['mf_crush_h'] + $dat['mf_all_damage_h'];
        $new_sql[$slot.'_sharp'] = $dat['mf_sharp_h'] + $dat['mf_all_damage_h'];
        $new_sql[$slot.'_crit'] = $dat['mf_crit_h'];
        $new_sql[$slot.'_critpower'] = $dat['mf_critpower_h'];
        $new_sql[$slot.'_antiuvorot'] = $dat['mf_antiuvorot_h'];
        $new_sql[$slot.'_piercearmor'] = $dat['mf_piercearmor_h'];
        $new_sql[$slot.'_hitmin'] = $dat['min_attack'];
        $new_sql[$slot.'_hitmax'] = $dat['max_attack'];
      break;
    }
// HP/MP
    $new_sql['hp_all'] = $dat['add_hp'];
    $new_sql['mp_all'] = $dat['add_mp'];
    
    foreach ($new_sql as $key => $value)
    {
      $new_sql[$key] = $value*$type;
      $new_sql[$key] += $stats[$key];
    }
    
    $db = $adb -> selectRow ("SELECT `hp`, 
                                     `mp` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $guid);
    if ($dat['add_hp'] != 0)
      $this -> setTimeToHPMP ($db['hp'], $new_sql['hp_all'], $stats['hp_regen'], 'hp');
    
    if ($dat['add_mp'] != 0)
      $this -> setTimeToHPMP ($db['mp'], $new_sql['mp_all'], $stats['mp_regen'], 'mp');
    
    if ($type == 1)
    {
      $q1 = $adb -> query ("UPDATE `character_inventory` 
                            SET `wear` = '1', 
                                `last_update` = ?d 
                            WHERE `guid` = ?d 
                              and `id` = ?d", time () ,$guid ,$i_id);
      $q2 = $adb -> query ("UPDATE `character_equip` SET ?# = ?d WHERE `guid` = ?d", $slot ,$i_id ,$guid);
    }
    else if ($type == -1)
    {
      $q1 = $adb -> query ("UPDATE `character_inventory` 
                            SET `wear` = '0', 
                                `last_update` = ?d 
                            WHERE `guid` = ?d 
                              and `id` = ?d", time () ,$guid ,$i_id);
      $q2 = $adb -> query ("UPDATE `character_equip` SET ?# = '0' WHERE `guid` = ?d", $slot ,$guid);
    }
    if ($q1 && $q2)
    {
      if ($adb -> query ("UPDATE `character_stats` SET ?a WHERE `guid` = ?d", $new_sql ,$guid))
      {
        $this -> increaseStat ('str', ($dat['add_str'] + $dat['inc_str'])*$type);
        $this -> increaseStat ('dex', ($dat['add_dex'] + $dat['inc_dex'])*$type);
        $this -> increaseStat ('con', ($dat['add_con'] + $dat['inc_con'])*$type);
        $this -> increaseStat ('int', ($dat['add_int'] + $dat['inc_int'])*$type);
      }
      if ($type == 1)
      {
        $adb -> query ("UPDATE `characters` SET `mass` = `mass` - ?f WHERE `guid` = ?d", $dat['mass'] ,$guid);
        if ($i_hands == 2 && $slot == 'hand_r')
          $adb -> query ("UPDATE `character_equip` 
                          SET `hand_r_type` = ?s, 
                              `hand_r_free` = '0', 
                              `hand_l_free` = '0' 
                          WHERE `guid` = ?d", $w_type ,$guid);
        else if ($i_hands == 1)
        {
          $adb -> query ("UPDATE `character_equip` 
                          SET ?# = ?s, 
                              ?# = '0' 
                          WHERE `guid` = ?d", $slot.'_type' ,$w_type ,$slot.'_free' ,$guid);
        }
      }
      else if ($type == -1)
      {
        $adb -> query ("UPDATE `characters` SET `mass` = `mass` + ?f WHERE `guid` = ?d", $dat['mass'] ,$guid);
        if ($i_hands == 2 && $slot == 'hand_r')
          $adb -> query ("UPDATE `character_equip` 
                          SET `hand_r_type` = 'phisic', 
                              `hand_r_free` = '1', 
                              `hand_l_free` = '1' 
                          WHERE `guid` = ?d", $guid);
        else if ($i_hands == 1)
        {
          $adb -> query ("UPDATE `character_equip` 
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
    global $adb;
    $wear = $adb -> selectRow ("SELECT `helmet`, `bracer`, 
                                       `hand_r`, `armor`, 
                                       `belt`, `earring`, 
                                       `amulet`, `ring1`, 
                                       `ring2`, `ring3`, 
                                       `gloves`, `hand_l`, 
                                       `pants`, `boots` 
                                FROM `character_equip` 
                                WHERE `guid` = ?d", $this->guid);
    foreach ($wear as $key => $value)
    {
      if ($value)
        $this -> equipItem ($value, -1);
    }
  }
  /*Время востановления здоровья*/
  function setTimeToHPMP ($now, $all, $regen, $type)
  {
    global $adb;
    $cure = 0;
    if ($now > $all)
    {
      $adb -> query ("UPDATE `characters` SET ?# = ?d WHERE `guid` = ?d", $type ,$all ,$this->guid);
      $adb -> query ("UPDATE `character_stats` SET ?# = '0' WHERE `guid` = ?d", $type.'_cure' ,$this->guid);
    }
    else
    {
      /* $cure = $adb -> selectCell ("SELECT `cure` FROM `character_stats` WHERE `guid` = ?d", $this->guid);
      $cure_full = floor (1200 - $cure * 12 / 2);
      $one = $cure_full / $all;
      $time = $cure_full - $one * $now;
      $put_to_base = time () + $time;
      $add_cure = ($cure < 100) ?0.01 :0; */
      getCureValue ($now, $all, $regen, $cure);
      $adb -> query ("UPDATE `character_stats` SET ?# = ?d WHERE `guid` = ?d", $type.'_cure' ,$cure ,$this->guid);
    }
  }
  /*Увеличение характеристики*/
  function increaseStat ($stat, $count = 1)
  {
    global $adb;
    switch ($stat)
    {
      case 'str':
        $adb -> query ("UPDATE `character_stats` 
                        SET `str` = `str` + ?d, 
                            `wp_min` = `wp_min` + ?d, 
                            `wp_max` = `wp_max` + ?d 
                        WHERE `guid` = ?d", $count ,$count ,$count ,$this->guid);
        return true;
      break;
      case 'dex':
        $mf_uvorot = $count * 7;
        $mf_antiuvorot = $count * 3;
        $adb -> query ("UPDATE `character_stats` 
                        SET `dex` = `dex` + ?d, 
                            `mf_uvorot` = `mf_uvorot` + ?d, 
                            `mf_antiuvorot` = `mf_antiuvorot` + ?d 
                        WHERE `guid` = ?d", $count ,$mf_uvorot ,$mf_antiuvorot ,$this->guid);
        return true;
      break;
      case 'con':
        $mf_crit = $count * 7;
        $mf_anticrit = $count * 3;
        $adb -> query ("UPDATE `character_stats` 
                        SET `con` = `con` + ?d, 
                            `mf_crit` = `mf_crit` + ?d, 
                            `mf_anticrit` = `mf_anticrit` + ?d 
                        WHERE `guid` = ?d", $count ,$mf_crit ,$mf_anticrit ,$this->guid);
        return true;
      break;
      case 'vit':
        $hp = $count * 6;
        $bron = $count * 1.5;
        $adb -> query ("UPDATE `character_stats` 
                        SET `vit` = `vit` + ?d, 
                            `hp_all` = `hp_all` + ?d,  
                            `resist_sting` = `resist_sting` + ?f, 
                            `resist_slash` = `resist_slash` + ?f, 
                            `resist_crush` = `resist_crush` + ?f, 
                            `resist_sharp` = `resist_sharp` + ?f, 
                            `resist_fire` = `resist_fire` + ?f, 
                            `resist_water` = `resist_water` + ?f, 
                            `resist_air` = `resist_air` + ?f, 
                            `resist_earth` = `resist_earth` + ?f 
                        WHERE `guid` = ?d", $count ,$hp ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$bron ,$this->guid);
        $adb -> query ("UPDATE `characters` 
                        SET `maxmass` = `maxmass` + ?d, 
                            `hp` = `hp` + ?d 
                        WHERE `guid` = ?d", $count ,$hp ,$this->guid);
        return true;
      break;
      case 'int':
        $mf = $count * 0.5;
        $adb -> query ("UPDATE `character_stats` 
                        SET `int` = `int` + ?d, 
                            `mf_fire` = `mf_fire` + ?f, 
                            `mf_water` = `mf_water` + ?f, 
                            `mf_air` = `mf_air` + ?f, 
                            `mf_earth` = `mf_earth` + ?f, 
                            `mf_light` = `mf_light` + ?f, 
                            `mf_gray` = `mf_gray` + ?f, 
                            `mf_dark` = `mf_dark` + ?f 
                        WHERE `guid` = ?d", $count ,$mf ,$mf ,$mf ,$mf ,$mf ,$mf ,$mf ,$this->guid);
        return true;
      break;
      case 'wis':
        $mp = $count * 10;
        $adb -> query ("UPDATE `character_stats` 
                        SET `wis` = `wis` + ?d, 
                            `mp_all` = `mp_all` + ?d 
                        WHERE `guid` = ?d", $count ,$mp ,$this->guid);
        $adb -> query ("UPDATE `characters` SET `mp` = `mp` + ?d WHERE `guid` = ?d", $mp ,$this->guid);
        return true;
      break;
      case 'spi':
        $adb -> query ("UPDATE `character_stats` 
                        SET `spi` = `spi` + ?d 
                        WHERE `guid` = ?d", $count ,$this->guid);
        return true;
      break;
      default:
        return false;
      break;
    }
  }
  /*Отображение дополнительной характеристики*/
  function showStatAddition ($type = 'skills')
  {
    global $adb, $added;
    $added = array('str' => 0, 'dex' => 0, 'con' => 0, 'int' => 0, 'sword' => 0, 'axe' => 0, 'fail' => 0, 'knife' => 0, 'staff' => 0, 'shot' => 0, 'fire' => 0, 'water' => 0, 'air' => 0, 'earth' => 0, 'light' => 0, 'gray' => 0, 'dark' => 0);
    $rows = $adb -> select ("SELECT `i`.`add_str`, `c`.`inc_str`, 
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
                             WHERE `c`.`guid` = ?d and `wear` = '1'", $this->guid);
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
  /*Начало работы с банковским счетом*/
  function loginBank ($id, $pass)
  {
    global $adb;
    $seek = $adb -> selectRow ("SELECT `guid`, 
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
  function unloginBank ()
  {
    unset ($_SESSION['bankСredit']);
  }
  /*Проверка доступности образа*/
  function checkShape ($id)
  {
    global $adb;
    $shape = $adb -> selectRow ("SELECT * FROM `player_shapes` WHERE `id` = ?d", $id);
    if (!$shape)
      return false;
    
    $db = $adb -> selectRow ("SELECT `c`.`level`, `c`.`sex`, 
                                     `s`.`str`, `s`.`dex`, 
                                     `s`.`con`, `s`.`vit`, 
                                     `s`.`int`, `s`.`wis`, 
                                     `s`.`sword`, `s`.`fail`, 
                                     `s`.`staff`, `s`.`knife`, 
                                     `s`.`axe`, 
                                     `s`.`fire`, `s`.`water`, 
                                     `s`.`air`, `s`.`earth`, 
                                     `s`.`dark`, `s`.`light`, 
                                     `c`.`next_shape` 
                              FROM `characters` AS `c` 
                              LEFT JOIN `character_stats` AS `s` 
                              ON `c`.`guid` = `s`.`guid` 
                              WHERE `c`.`guid` = ?d", $this->guid);
    $sex = ($db['sex'] == "male") ?"m" :"f";
    $required = array ('str', 'dex', 'con', 'vit', 'fire', 'water', 'air', 'earth', 'dark', 'light', 'int', 'wis', 'level', 'sword', 'axe', 'fail', 'knife');
    
    if ($db['next_shape'] && $db['next_shape'] > time ())
      $this -> Inventory (111, getFormatedTime ($db['next_shape']));
    
    if ($shape['sex'] != $sex)
      return false;
    
    foreach ($required as $key)
    {
      if ($shape[$key] > 0 && $shape[$key] > $db[$key])
        return false;
    }
    return true;
  }
  /*Отображение модуля инвентаря*/
  function showInventoryBar ($type, $value, $max_num)
  {
    global $adb, $behaviour, $mastery;
    $bar = explode ('|', $value);
    $lang = $adb -> selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");
    $stats = $adb -> selectRow ("SELECT * FROM `character_stats` WHERE `guid` = ?d", $this->guid);
    $wear = $adb -> selectRow ("SELECT `hand_r`, 
                                       `hand_l`, 
                                       `hand_r_type`, 
                                       `hand_l_type` 
                                FROM `character_equip` 
                                WHERE `guid` = ?d", $this->guid);
    list ($hand_r, $hand_l, $hand_r_type, $hand_l_type) = array_values($wear);
    $content = '';
    $link_text = '';
    $link = '';
    $flags = ($bar[1]) ?1 :0;
    $flags += ($bar[0] > 1) ?2 :0;
    $flags += ($bar[0] < $max_num) ?4 :0;
    switch ($type)
    {
      default:
      case 'stat':    /*Характеристики*/
        $level = $adb -> selectCell ("SELECT `level` FROM `characters` WHERE `guid` = ?d", $this->guid);
        foreach ($behaviour as $key => $value)
        {
          $content .= ($key != 'str' && $level >= $value && $stats[$key] > 0) ?"<br>" :"";
          $content .= ($level >= $value) ?"$lang[$key]: <b>$stats[$key]</b>" :"";
        }
        $content .= ($stats['ups'] > 0 || $stats['skills'] > 0) ?"<br>" :"";
        $content .= ($stats['ups'] > 0) ?"<a class='nick' href='?action=skills'><b><small>+ $lang[ups]</small></b></a> " :"";
        $content .= ($stats['skills'] > 0) ?"&bull; <a class='nick' href='?action=skills'><b><small> $lang[skills]</small></b></a>" :"";
      break;
      case 'mod':        /*Модификаторы*/
        $wp_min = $stats['wp_min'];
        $wp_max = $stats['wp_max'];
        $hand_r_hitmin = $stats['hand_r_hitmin'];
        $hand_l_hitmin = $stats['hand_l_hitmin'];
        $hand_r_hitmax = $stats['hand_r_hitmax'];
        $hand_l_hitmax = $stats['hand_l_hitmax'];
        $hand_r_critpower = $stats['hand_r_critpower'];
        $hand_l_critpower = $stats['hand_l_critpower'];
        $hand_r_crit = $stats['hand_r_crit'];
        $hand_l_crit = $stats['hand_l_crit'];
        $hand_r_antiuvorot = $stats['hand_r_antiuvorot'];
        $hand_l_antiuvorot = $stats['hand_l_antiuvorot'];
        $mf_critpower = $stats['mf_critpower'];
        $mf_crit = $stats['mf_crit'];
        $mf_uvorot = $stats['mf_uvorot'];
        $mf_anticrit = $stats['mf_anticrit'];
        $mf_antiuvorot = $stats['mf_antiuvorot'];
        $mf_contr = $stats['mf_contr'];
        $mf_parry = $stats['mf_parry'];
        $mf_blockshield = $stats['mf_blockshield'];
        $show_r_udar = ($this -> checkHandStatus ('r')) ?($hand_r_hitmin + $wp_min + $stats[$hand_r_type])."-".($hand_r_hitmax + $wp_max + $stats[$hand_r_type]) :"";
        $show_l_udar = ($this -> checkHandStatus ('l')) ?(($hand_r != 0) ?" / " :"").($hand_l_hitmin + $wp_min + $stats[$hand_l_type])."-".($hand_l_hitmax + $wp_max + $stats[$hand_l_type]) :"";
        $show_r_cpower = ($this -> checkHandStatus ('r')) ?$hand_r_critpower + $mf_critpower :"";
        $show_l_cpower = ($this -> checkHandStatus ('l')) ?(($hand_r != 0) ?" / " :"").($hand_l_critpower + $mf_critpower) :"";
        $show_r_crit = ($this -> checkHandStatus ('r')) ?$hand_r_crit + $mf_crit :"";
        $show_l_crit = ($this -> checkHandStatus ('l')) ?(($hand_r != 0) ?" / " :"").($hand_l_crit + $mf_crit) :"";
        $show_r_antiuvorot = ($this -> checkHandStatus ('r')) ?$hand_r_antiuvorot + $mf_antiuvorot :"";
        $show_l_antiuvorot = ($this -> checkHandStatus ('l')) ?(($hand_r != 0) ?" / " :"").($hand_l_antiuvorot + $mf_antiuvorot) :"";
        $show_r_mastery = ($this -> checkHandStatus ('r')) ?$stats[$hand_r_type] + $stats['hand_r_'.$hand_r_type] :"";
        $show_l_mastery = ($this -> checkHandStatus ('l')) ?(($hand_r != 0) ?" / " :"").($stats[$hand_l_type] + $stats['hand_l_'.$hand_r_type]) :"";
        $content .= "$lang[damage]: $show_r_udar$show_l_udar<br>"
                  . "<span title='$lang[mf_crit_m]'>$lang[mf_crit_i]: $show_r_crit$show_l_crit</span><br>";
        $content .= ($hand_r_critpower != 0 || $hand_l_critpower != 0 || $mf_critpower != 0) ?"<span title='$lang[mf_critpower_m]'>$lang[mf_critpower_i]: $show_r_cpower$show_l_cpower</span><br>" :"";
        $content .= "<span title='$lang[mf_anticrit_m]'>$lang[mf_anticrit_i]: $mf_anticrit</span><br>"
                  . "<span title='$lang[mf_uvorot_m]'>$lang[mf_uvorot_i]: $mf_uvorot</span><br>"
                  . "<span title='$lang[mf_antiuvorot_m]'>$lang[mf_antiuvorot_i]: $show_r_antiuvorot$show_l_antiuvorot</span><br>"
                  . "<span title='$lang[mf_contr_m]'>$lang[mf_contr_i]: $mf_contr</span><br>"
                  . "<span title='$lang[mf_parry_m]'>$lang[mf_parry_i]: $mf_parry</span><br>"
                  . "<span title='$lang[mf_blockshield_m]'>$lang[mf_blockshield_i]: $mf_blockshield</span><br>";
        $content .= ($hand_r != 0 || $hand_l != 0) ?"<span title='$lang[mastery_m]'>$lang[mastery]: $show_r_mastery$show_l_mastery</span><br>" :"";
      break;
      case 'power':    /*Мощность*/
        $mf_damage = array ('sting', 'slash', 'crush', 'sharp');
        $mf_magic = array ('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
        foreach ($mf_damage as $key)
        {
          $show_r[$key] = ($this -> checkHandStatus ('r')) ?$stats['hand_r_'.$key] + $stats['mf_'.$key] :"";
          $show_l[$key] = ($this -> checkHandStatus ('l')) ?(($hand_r != 0) ?"% / +" :"").($stats['hand_l_'.$key] + $stats['mf_'.$key]) :"";
        }
        foreach ($mf_damage as $key)
          $content .= ($stats['mf_'.$key] != 0 || $stats['hand_r_'.$key] != 0 || $stats['hand_l_'.$key] != 0) ?"<span title='".$lang[$key.'_p']."'>".$lang[$key.'_i'].": +$show_r[$key]$show_l[$key]%</span><br>" :"";
        foreach ($mf_magic as $key)
          $content .= ($stats['mf_'.$key] != 0) ?"<span title='".$lang[$key.'_p']."'>".$lang[$key.'_i'].": +".$stats['mf_'.$key]."%</span><br>" :"";
      break;
      case 'def':        /*Защита*/
        $resists = array ('sting', 'slash', 'crush', 'sharp', 'fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
        foreach ($resists as $key)
          $content .= "<span title='".$lang[$key.'_d']."'>".$lang[$key.'_i'].": ".$stats['resist_'.$key]."</span><br>";
      break;
      case 'btn':        /*Кнопки*/
        $content .= "&nbsp;<input type='button' value='$lang[unwear_all]' class='btn' onclick=\"location.href = 'main.php?action=unwear_full';\" style='font-weight: bold;'><br>";
      break;
      case 'set':        /*Комплекты*/
        $sets = $adb -> select ("SELECT * FROM `character_sets`;");
        $link_text = "запомнить";
        $link = "javascript:kmp();";
        $content .= "<div id='allsets'>";
        foreach ($sets as $set)
          $content .= "<div name='$set[name]'><img width='200' height='1' src='img/1x1.gif'><br>&nbsp;&nbsp;<img src='img/icon/close2.gif' width='9' height='9' alt='Удалить комплект' onclick=\"if (confirm('Удалить комплект $set[name]?')) {workSets ('delete', '$set[name]');}\" style='cursor: pointer;'> <a href='main.php?action=wear_set&set_name=$set[name]' class='nick'><small>Надеть \"$set[name]\"</small></a></div>";
        $content .= "</div>";
      break;
    }
    $return = "<table width='100%' border='0' cellspacing='0' cellpadding='1' background='img/back.gif'><tr><td valign='middle'>";
    if ($flags & 1)
      $return .= "<a href=\"javascript:spoilerBar ('$type');\"><img id='spoiler_$type' width='11' height='9' title='Скрыть' border='0' src='img/minus.gif' style='cursor: pointer;' /></a>";
    else
      $return .= "<a href=\"javascript:spoilerBar ('$type');\"><img id='spoiler_$type' width='11' height='9' title='Показать' border='0' src='img/plus.gif' style='cursor: pointer;' /></a>";
    $return .= "</td>";
    $return .= "<td>&nbsp;</td><td bgcolor='#e2e0e0'><small>&nbsp;<b>".$lang['bar_'.$type].":<b>&nbsp;</small></td>";
    if ($link_text)
      $return .= "<td>&nbsp;</td><td bgcolor='#e2e0e0'>&nbsp;<a href='$link' class='nick'><small>$link_text</small></a>&nbsp;</td>";
    $return .= "<td align='right' valign='middle' width='100%'>";
    if ($flags & 2)
      $return .= "<a href=\"javascript:switchBars ('up', '$type');\"><img border='0' width='11' height='9' title='Поднять блок наверх' src='img/up.gif' /></a>";
    else
      $return .= "<img border='0' width='11' height='9' src='img/up-grey.gif'>";
    if ($flags & 4)
      $return .= "<a href=\"javascript:switchBars ('down', '$type');\"><img border='0' width='11' height='9' title='Опустить блок вниз' src='img/down.gif' /></a>";
    else
      $return .= "<img border='0' width='11' height='9' src='img/down-grey.gif'>";
    $return .= "</td>";
    $return .= "</tr></table>";
    $style = ($flags & 1) ?"" :" style='display: none;'";
    $return .= "<div id='{$type}c'$style><small>$content</small></div>";
    return $return;
  }
  /*Получение времени до возможности перехода*/
  function getRoomGoTime (&$mtime)
  {
    global $adb;
    $db = $adb -> selectRow ("SELECT `last_go`, 
                                     `room` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $this->guid);
    list ($last_go, $room) = array_values($db);
    $time_to_go = $adb -> selectCell ("SELECT `time_to_go` FROM `city_rooms` WHERE `room` = ?s", $room);
    
    if (!$time_to_go || !$room)
      return;
    
    $mtime = ($time_to_go - (time () - $last_go));
  }
  /*Вычитание/прибаление денег у персонажа*/
  function Money ($sum, $type = '', $guid = '')
  {
    if (!is_numeric($sum))
      return false;
    
    $sum = round ($sum, 2);
    
    if ($sum == 0)
      return false;
    
    global $adb;
    $guid = (!$guid) ?$this->guid :$guid;
    switch ($type)
    {
      case 'euro':
        $money_euro = $adb -> selectCell ("SELECT `money_euro` FROM `characters` WHERE `guid` = ?d", $guid);

        if (($money_euro = $money_euro - $sum) < 0)
          return false;
        
        $adb -> query ("UPDATE `characters` SET `money_euro` = ?f WHERE `guid` = ?d", $money_euro ,$guid);
      break;
      default:
        $money = $adb -> selectCell ("SELECT `money` FROM `characters` WHERE `guid` = ?d", $guid);

        if (($money = $money - $sum) < 0)
          return false;
        
        $adb -> query ("UPDATE `characters` SET `money` = ?f WHERE `guid` = ?d", $money ,$guid);
      break;
    }
    return true;
  }
  /*Вычитание/прибаление денег у персонажа в банке*/
  function MoneyBank ($sum, $id, $type = '', $guid = '')
  {
    if ($id == 0 || !is_numeric($sum) || !is_numeric($id))
      $this -> Map (326);
    
    $sum = round ($sum, 2);
    
    if ($sum == 0)
      $this -> Map (325);
    
    global $adb;
    $guid = (!$guid) ?$this->guid :$guid;
    switch ($type)
    {
      case 'euro':
        $money = $adb -> selectCell ("SELECT `euro` FROM `character_bank` WHERE `id` = ?d and `guid` = ?d", $id ,$guid);

        if (($money = $money - $sum) < 0)
          $this -> Map (310, $sum);
        
        $adb -> query ("UPDATE `character_bank` SET `euro` = ?f WHERE `id` = ?d and `guid` = ?d", $money ,$id ,$guid);
      break;
      default:
        $money = $adb -> selectCell ("SELECT `cash` FROM `character_bank` WHERE `id` = ?d and `guid` = ?d", $id ,$guid);

        if (($money = $money - $sum) < 0)
          $this -> Map (305, $sum);
        
        $adb -> query ("UPDATE `character_bank` SET `cash` = ?f WHERE `id` = ?d and `guid` = ?d", $money ,$id ,$guid);
      break;
    }
    return true;
  }
  /*Одевание комплекта предметов*/
  function equipSet ($name)
  {
    if ($name == '')
      $this -> Inventory (221);
    
    global $adb;
    $set = $adb -> selectRow ("SELECT `helmet`, `bracer`, 
                                      `hand_r`, `armor`, 
                                      `shirt`, `cloak`, 
                                      `belt`, `earring`, 
                                      `amulet`, `ring1`, 
                                      `ring2`, `ring3`, 
                                      `gloves`, `hand_l`, 
                                      `pants`, `boots` 
                               FROM `character_sets` 
                               WHERE `guid` = ?d 
                                 and `name` = ?s", $this->guid ,$name) or $this -> Inventory (221);
    $this -> unWearAllItems ();
    foreach ($set as $slot => $item_id)
    {
      $item = $adb -> selectRow ("SELECT `wear` 
                                  FROM `character_inventory` 
                                  WHERE `guid` = ?d 
                                    and `id` = ?d 
                                    and `mailed` = '0';", $this->guid ,$item_id);
      if (!$item)
        $adb -> query ("UPDATE `character_sets` SET ?# = '0' WHERE `name` = ?s and `guid` = ?d", $slot ,$name ,$this->guid);
      else if ($item['wear'])
        continue;
      else
        $this -> equipItem ($item_id);
    }
    $this -> Inventory (0);
  }
}

/*Функции почты*/
class Mail extends Error
{
    private $guid;
    /*Присваивание guid персонажа переменной класса*/
    function& setguid ($guid)
    {
      $object = new Mail;
      $object->guid = $guid;
      return $object;
    }
    /*Вычисление цены передачи предмета*/
    function getValue ($item_id)
    {
      if ($item_id == 0 || !is_numeric($item_id))
        return 0;
      
      global $adb;
      $item_info = $adb -> selectRow ("SELECT `i`.`price`, `i`.`mass`, 
                                              `c`.`tear_cur`, `c`.`tear_max`, 
                                              `i`.`tear` 
                                       FROM `character_inventory` AS `c` 
                                       LEFT JOIN `item_template` AS `i` 
                                       ON `c`.`item_template` = `i`.`entry` 
                                       WHERE `c`.`id` = ?d 
                                         and `c`.`guid` = ?d 
                                        and (`i`.`item_flags` & '1') 
                                         and `i`.`price_euro` = '0';", $item_id ,$this->guid);
      list ($price, $mass, $tear_cur, $tear_max, $max_tear) = array_values ($item_info);
      
      if (!$item_info)
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
        $this -> Mail (325);
      
      if ($mail_to == 0 || !is_numeric($mail_to))
        $this -> Mail (106, 'money');
      
      global $adb, $history, $equip;
      $mail_to = $adb -> selectCell ("SELECT `guid` FROM `characters` WHERE `guid` = ?d", $mail_to) or $this -> Mail (106, 'items');
      $transfers = $adb -> selectCell ("SELECT `transfers` FROM `characters` WHERE `guid` = ?d", $this->guid);
      
      if ($transfers <= 0)
        $this -> Mail (113, 'money');
      
      if ($send_money < 1)
        $this -> Mail (410, 'money', 1);
      
      if (!($equip -> Money ($send_money)))
        $this -> Mail (107);
      
      $send_money = round (0.95 * $send_money, 2);
      $adb -> query ("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `count`, `delivery_time`, `date`) 
                      VALUES (?d, ?d, '1000', ?f, ?d, ?d)", $this->guid ,$mail_to ,$send_money ,time () ,time ());
      $history -> mail ('Send', "Деньги: $send_money кр", $_SERVER['REMOTE_ADDR'], $mail_to);
      $this -> Mail (409, 'money', $send_money);
    }
    /*Получение/Возврат денег*/
    function Money ($mail_id, $type)
    {
      if ($mail_id == 0 || !is_numeric($mail_id))
        $this -> Mail (112, 'get_mail');
      
      global $adb, $history, $equip;
      $dat = $adb -> selectRow ("SELECT `m`.`id`, 
                                        `m`.`sender`, 
                                        `i`.`name`, 
                                        `m`.`count` 
                                 FROM `city_mail_items` AS `m` 
                                 LEFT JOIN `item_template` AS `i` 
                                 ON `m`.`item_id` = `i`.`entry` 
                                 WHERE `m`.`to` = ?d 
                                   and `m`.`delivery_time` < ?d
                                   and `m`.`id` = ?d", $this->guid ,time (), $mail_id) or $this -> Mail (112, 'get_mail');
      list ($mail_id, $sender, $name, $money_count) = array_values ($dat);
      $name = sprintf ($name, $money_count);
      echo "<script>top.menu.location.reload();</script>";
      $adb -> query ("DELETE FROM `city_mail_items` WHERE `id` = ?d", $mail_id);
      switch ($type)
      {
        case 'get_money':
          $equip -> Money (-$money_count);
          $history -> mail ('Receive', $name, $_SERVER['REMOTE_ADDR'], $sender);
          $this -> Mail (407, 'get_mail', $name);
        break;
        case 'return_money':
          $adb -> query ("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `count`, `delivery_time`, `date`) 
                          VALUES (?d, ?d, '1000', ?f, ?d, ?d)", $this->guid ,$sender ,$money_count ,time () ,time ());
          $history -> mail ('Return', $name, $_SERVER['REMOTE_ADDR'], $sender);
          $this -> Mail (408, 'get_mail', $name);
        break;
      }
    }
    /*Отправка предмета*/
    function sendItem ($mail_to, $item_id)
    {
      if ($item_id == 0 || !is_numeric($item_id))
        $this -> Mail (213, 'items');
      
      if ($mail_to == 0 || !is_numeric($mail_to))
        $this -> Mail (106, 'items');
      
      if ($mail_to == $this->guid)
        $this -> Mail (218);
      
      global $adb, $history, $equip;
      $mail_to = $adb -> selectCell ("SELECT `guid` FROM `characters` WHERE `guid` = ?d", $mail_to) or $this -> Mail (106, 'items');
      $transfers = $adb -> selectCell ("SELECT `transfers` FROM `characters` WHERE `guid` = ?d", $this->guid);
      
      if ($transfers <= 0)
        $this -> Mail (113, 'items');
      
      $dat = $adb -> selectRow ("SELECT `c`.`id`, 
                                        `i`.`name` 
                                 FROM `character_inventory` AS `c` 
                                 LEFT JOIN `item_template` AS `i` 
                                 ON `c`.`item_template` = `i`.`entry` 
                                 WHERE `c`.`id` = ?d 
                                   and `c`.`guid` = ?d 
                                   and `c`.`wear` = '0' 
                                   and `c`.`mailed` = '0' 
                                   and `i`.`price_euro` = '0';", $item_id ,$this->guid) or $this -> Mail (213, 'items');
      list ($item_id, $name) = array_values ($dat);
      $price = $this -> getValue ($item_id);
      
      if (!($equip -> Money ($price)))
        $this -> Mail (107);
      
      $delivery_time = 1800 + time ();
      $adb -> query ("UPDATE `characters` SET `transfers` = `transfers` - '1' WHERE `guid` = ?d", $this->guid);
      $adb -> query ("UPDATE `character_inventory` SET `mailed` = '1' WHERE `guid` = ?d and `id` = ?d", $this->guid ,$item_id);
      $adb -> query ("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `delivery_time`, `date`) 
                      VALUES (?d, ?d, ?d, ?d, ?d)", $this->guid ,$mail_to ,$item_id ,$delivery_time ,time ());
      $history -> mail ('Send', "$name ($price кр)", $_SERVER['REMOTE_ADDR'], $mail_to);
      $this -> Mail (406, 'items', "$name|$price");
    }
    /*Получение/Возврат предмета*/
    function ItemMail ($item_id, $type)
    {
      if ($item_id == 0 || !is_numeric($item_id))
        $this -> Mail (112, 'get_mail');
      
      global $adb, $history;
      $dat = $adb -> selectRow ("SELECT `m`.`id`, 
                                        `m`.`sender`, 
                                        `i`.`name` 
                                 FROM `city_mail_items` AS `m` 
                                 LEFT JOIN `character_inventory` AS `c` 
                                 ON `m`.`item_id` = `c`.`id` 
                                 LEFT JOIN `item_template` AS `i` 
                                 ON `c`.`item_template` = `i`.`entry` 
                                 WHERE `m`.`to` = ?d 
                                   and `m`.`sender` = `c`.`guid` 
                                   and `m`.`item_id` = ?d 
                                   and `m`.`delivery_time` < ?d 
                                   and `c`.`mailed` = '1';", $this->guid ,$item_id ,time ()) or $this -> Mail (112, 'get_mail');
      list ($mail_id, $sender, $name) = array_values ($dat);
      $adb -> query ("DELETE FROM `city_mail_items` WHERE `id` = ?d", $mail_id);
      echo "<script>top.menu.location.reload();</script>";
      switch ($type)
      {
        case 'get_item':
          $adb -> query ("UPDATE `character_inventory` SET `mailed` = '0', `guid` = ?d, `last_update` = ?d WHERE `guid` = ?d and `id` = ?d", $this->guid ,time () ,$sender ,$item_id);
          $history -> mail ('Receive', $name, $_SERVER['REMOTE_ADDR'], $sender);
          $this -> Mail (407, 'get_mail', $name);
        break;
        case 'return_item':
          $delivery_time = 1800 + time ();
          $adb -> query ("UPDATE `character_inventory` SET `mailed` = '1' WHERE `guid` = ?d and `id` = ?d", $sender ,$item_id);
          $adb -> query ("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `delivery_time`, `date`) 
                          VALUES (?d, ?d, ?d, ?d, ?d)", $this->guid ,$sender ,$item_id ,$delivery_time ,time ());
          $history -> mail ('Return', $name, $_SERVER['REMOTE_ADDR'], $sender);
          $this -> Mail (408, 'get_mail', $name);
        break;
      }
    }
}

/*Функции чата*/
class Chat
{
  /*Отправка сообщения в чат*/
  function say ($to, $text, $sender = '')
  {
    global $adb;
    $db = $adb -> selectRow ("SELECT `login`, 
                                     `room`, 
                                     `city` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $to);
    list ($to, $room, $city) = array_values ($db);
    
    if ($sender == '')
      $class = "sys";
    else
    {
      $class = "private";
      $text = "private [$to] $text</font>";
    }
    
    $adb -> query ("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                    VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $sender ,$to ,$room ,$text ,$class ,time () ,$city);
    echo "<script>top.frames.ref.location = 'refresh.php';</script>";
  }
  /*Выполнение комманд в чате*/
  function executeCommand ($name, $message, $guid)
  {
    global $adb;
    $db = $adb -> selectRow ("SELECT `login`, 
                                     `room`, 
                                     `city` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $guid);
    list ($login, $room, $city) = array_values ($db);
    switch ($name)
    {
      case '/afk':
        $message = str_replace ('/afk', '', $message);
        $message = ($message != '') ?preg_replace ("/ /", "", $message, 1) :'';
        $adb -> query ("UPDATE `characters` SET `afk` = '1', `dnd` = '0', `message` = ?s WHERE `guid` = ?d", $message ,$guid);
        return true;
      break;
      case '/dnd ':
        $message = str_replace ('/dnd ', '', $message);
        
        if ($message == '')
          return false;
        
        $adb -> query ("UPDATE `characters` SET `afk` = '0', `dnd` = '1', `message` = ?s WHERE `guid` = ?d", $message ,$guid);
        return true;
      break;
        case '/e ':
          $message = str_replace ('/e ', '', $message);
          
          if ($message == '')
            return false;
          
          $adb -> query ("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                          VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $login ,'' ,$room ,$message ,'emotion' ,time () ,$city);
          return true;
        break;
        default:
          return false;
        break;
    }
  }
}

/*Функции информации*/
class Info
{
  /*Показ дополнительной информации по персонажу*/
  function showInfDetail ($guid)
  {
    global $adb;
    $db = $adb -> selectRow ("SELECT `block`, 
                                     `block_reason`, 
                                     `shut`, 
                                     `prision`, 
                                     `prision_reason`, 
                                     `travm`, 
                                     `travm_var`, 
                                     `travm_stat` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $guid);
    list ($block, $block_reason, $shut, $prision, $prision_reason, $travm, $travm_var, $travm_stat) = array_values ($db);
    /*Блок*/
    if ($block && $block_reason)
      echo "Причина блока :<br><b><font class='private'>$block_reason</font></b><br>";
    /*Молчанка*/
    if ($shut != 0)
      echo "<img src='img/icon/sleeps0.gif'><small>На персонажа наложено заклятие молчания. Будет молчать еще ".getFormatedTime($shut)."</small><br>";
    /*Тюрьма*/
    if ($prision != 0)
    {
      echo "<small>Персонаж находиться под стражей еще ".getFormatedTime($prision)."</small><br>";
      if ($prision_reason != "")
        echo "Причина тюремного заключения :<br><b><font class='private'>$prision_reason</font></b><br>";
    }
    /*Травма*/
    if ($travm != 0)
    {
      switch ($travm_var)
      {
        case 1: $travm_var = "легкая травма";  break;
        case 2: $travm_var = "средняя травма"; break;
        case 3: $travm_var = "тяжелая травма"; break;
      }
      switch ($travm_stat)
      {
        case 'str': $travm_stat = "сила";         break;
        case 'dex': $travm_stat = "ловкость";     break;
        case 'con': $travm_stat = "интуиция";     break;
        case 'vit': $travm_stat = "выносливость"; break;
      }
      echo "<img src='img/icon/travma2.gif'><small>У персонажа $travm_var - <b>\"ослабленна характеристика $travm_stat\"</b> еще ".getFormatedTime($travm)."</small>";
    }
  }
  /*Показ строки персонажа*/
  function character ($guid, $type = 'clan')
  {
    global $adb;
    $db = $adb -> selectRow ("SELECT `login`, 
                                     `level`, 
                                     `orden`, 
                                     `clan`, 
                                     `clan_short`, 
                                     `block`, 
                                     `rang`, 
                                     `shut`, 
                                     `afk`, 
                                     `dnd`, 
                                     `message`, 
                                     `travm` 
                              FROM `characters` 
                              WHERE `guid` = ?d", $guid);
    list ($login, $level, $orden, $clan_f, $clan_s, $block, $rang, $shut, $afk, $dnd, $message, $travm) = array_values ($db);
    switch ($orden)
    {
      case 1:  $orden_img = "<img src='img/orden/pal/$rang.gif' width='12' height='15' border='0' title='Белое братство'>";  break;
      case 2:  $orden_img = "<img src='img/orden/arm/$rang.gif' width='12' height='15' border='0' title='Темное братство'>"; break;
      case 3:  $orden_img = "<img src='img/orden/3.gif' width='12' height='15' border='0' title='Нейтральное братство'>";    break;
      case 4:  $orden_img = "<img src='img/orden/4.gif' width='12' height='15' border='0' title='Алхимик'>";                 break;
      case 5:  $orden_img = "<img src='img/orden/2.gif' width='12' height='15' border='0' title='Хаос'>";                    break;
      default: $orden_img = "";                                                                                              break;
    }
    $clan = ($clan_s != '') ?"<img src='img/clan/$clan_s.gif' border='0' title='$clan_f'>" :"";
    $login_link = str_replace (" ", "%20", $login);
    $login_info = "<a href='info.php?log=$login_link' target='_blank'><img src='img/inf.gif' border='0' title='Инф. о $login'></a>";
    $mol = ($shut != 0) ?" <img src='img/sleep2.gif' title='Наложено заклятие молчания'>" :"&nbsp";
    $travm = ($travm != 0) ?"<img src='img/travma2.gif' title='Инвалидность'>" :"&nbsp";
    $banned = ($block) ?"<font color='red'><b>- Забанен</b></font>" :"";
    $message = ($message) ?$message :'away from keyboard';
    $afk = ($afk) ?"<font title='$message'><b>afk</b></font>&nbsp;" :(($dnd && $message) ?"<font title='$message'><b>dnd</b></font>&nbsp;" :'');
    switch ($type)
    {
      case 'online': return "&nbsp;<a href=javascript:top.AddToPrivate('$login_link',true);><img border='0' src='img/lock.gif' title='Приватное сообщение'></a>&nbsp;&nbsp;$afk$orden_img$clan<a href=javascript:top.AddTo('$login_link'); class='nick'><b>$login</b></a>[$level]$login_info$mol$travm<br>"; break;
      case 'mults':  return "$orden_img$clan<b>$login</b> [$level]$login_info $banned <br>"; break;
      case 'clan':   return "$orden_img$clan<b>$login</b> [$level]$login_info"; break;
      case 'turn':   return $orden_img; break;
      case 'name':   return $login; break;
      case 'news':   return "$orden_img$clan<font class='header'>$login</font> [$level]$login_info"; break;
      case 'info':   return "<img src='img/icon/lock3.gif' border='0'onclick=window.opener.to('$login'); style='cursor: pointer;'> $orden_img$clan<b>$login</b> [$level]$login_info"; break;
      case 'mail':   return "<font color='red'>$login</font> $login_info"; break;
      default:       return "";
    }
  }
  /*Показ кол-ва человек в комнате*/
  function roomOnline ($name, $type = 'full')
  {
    global $adb;
    $online = $adb -> selectCell ("SELECT COUNT(*) FROM `online` WHERE `room` = ?s", $name);
    $room = $adb -> selectRow ("SELECT `name`, `time_to_go` FROM `city_rooms` WHERE `room` = ?s", $name);
    
    if (!$room)          return "Bug";
    if ($type == 'full') return "<strong>$room[name]</strong><br>Сейчас в комнате: $online";
    if ($type == 'map')  return $online;
    if ($type == 'mini') return "Время перехода: $room[time_to_go] сек.<br>Сейчас в комнате: $online";
                         return "";
  }
  /*Вывод списка профессионалов*/
  function showArch ($prof)
  {
    global $adb;
    $rows = $adb -> selectCol ("SELECT `guid` FROM `characters` WHERE `profession` = ?s ORDER BY `exp` DESC LIMIT 5", $prof);
    if (count ($rows) == 0)
      return "Нет профессионалов в этой сфере.";
    
    foreach ($rows as $num => $char)
      return $this -> character ($char)."<br>";
    return "";
  }
}

/*Функции истории*/
class History
{
  private $guid;
  /*Присваивание guid персонажа переменной класса*/
  function& setguid ($guid)
  {
    $object = new History;
    $object->guid = $guid;
    return $object;
  }
  /*История регистрации/авторизации персонажа*/
  function authorization ($action, $city, $comment = '')
  {
    global $adb;
    $adb -> query ("INSERT INTO `history_auth` (`guid`, `action`, `ip`, `city`, `comment`, `date`) 
                    VALUES (?d, ?d, ?s, ?s, ?s, ?d);", $this->guid ,$action ,$_SERVER['REMOTE_ADDR'] ,$city ,$comment ,time ());
  }
  /*История покупки/продажи/передачи предмета*/
  function transfers ($action, $val, $ip, $to)
  {
    global $adb;
    $adb -> query ("INSERT INTO `history_transfers` (`guid`, `receive`, `action`, `item`, `ip`, `date`)
                    VALUES (?d, ?s, ?s, ?s, ?s, ?d)", $this->guid ,$to ,$action ,$val ,$ip ,time ());
  }
  /*История отправки/получения/возврата предмета по почте*/
  function mail ($action, $val, $ip, $to)
  {
    global $adb;
    $adb -> query ("INSERT INTO `history_mail` (`guid`, `receive`, `action`, `item`, `ip`, `date`)
                    VALUES (?d, ?s, ?s, ?s, ?s, ?d)", $this->guid ,$to ,$action ,$val ,$ip ,time ());
  }
  /*История банковских операций*/
  function bank ($id, $credit2, $cash, $euro, $operation)
  {
    global $adb;
    $adb -> query ("INSERT INTO `history_bank` (`credit`, `credit2`, `cash`, `euro`, `operation`, `date`) 
                    VALUES (?d, ?d, ?f, ?f, ?d, ?d)", $id ,$credit2 ,$cash ,$euro ,$operation ,time ());
  }
}

/*Функции ошибок*/
class Error
{
  /*Вывод ошибки в инвентаре*/
  function Inventory ($id, $parameters = '')
  {
    die ("<script>location.href = 'main.php?action=inv&warning=$id&parameters=$parameters';</script>");
  }
  /*Вывод ошибки в разделе "Анкета"*/
  function Form ($id, $do, $parameters = '')
  {
    die ("<script>location.href = 'main.php?action=form&do=$do&warning=$id&parameters=$parameters';</script>");
  }
  /*Вывод ошибки на карте*/
  function Map ($id, $parameters = '')
  {
    die ("<script>location.href = 'main.php?warning=$id&parameters=$parameters';</script>");
  }
  /*Вывод ошибки на почте*/
  function Mail ($id, $do, $parameters = '')
  {
    die ("<script>location.href = 'main.php?do=$do&warning=$id&parameters=$parameters';</script>");
  }
  /*Вывод ошибки в магазине*/
  function Shop ($id, $parameters = '')
  {
    die ("<script>location.href = 'main.php?warning=$id&parameters=$parameters';</script>");
  }
  /*Оформление вида ошибки*/
  function getFormattedError ($id, $parameters)
  {
    if (!$id)
      return;
    
    global $adb;
    $err_text = "";
    $parametr = array ();
    
    if ($parameters)
      $parametr = split ("\|", $parameters);
    
    $err = $adb -> selectRow ("SELECT `text`, 
                                      `warning`, 
                                      `hyphen` 
                               FROM `server_errors` 
                               WHERE `id` = ?d", $id);
    if (!$err)
      return;
    
    list ($err_text, $err_warn, $err_hyph) = array_values ($err);
    
    if ($err_warn)
      $err_text = "<b>$err_text</b>";
    
    if ($err_hyph)
      $err_text = "$err_text<br>";
    
    vprintf ($err_text, $parametr);
  }
}

/*Получение полосы загрузки*/
function getUpdateBar ()
{
  $return = "<table width='80' border='0' cellspacing='0' cellpadding='0'>"
          . "<tr>"
          . "<td><a href='javascript:location.reload();'><img src='img/room/rel_1.png' width='15' height='16' title='Обновить' border='0' /></a></td>"
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
/*Получение времени восстановления здоровья*/
function getCureValue ($now, $all, $regen, &$value)
{
  $value = floor (((($all - $now) / ($all * 0.01)) * 10) / ($regen * 0.01)) + time ();
}
/*Получение количества восстановленного здоровья*/
function getRegeneratedValue ($all, $cure, $regen)
{
  return $all - floor ((($cure * ($regen * 0.01)) / 10) * ($all * 0.01));
}
/*Получение отформатированного времени*/
function getFormatedTime ($timestamp)
{
  if (!$timestamp)
    return "Вечность";
  
  if (!is_numeric($timestamp))
    $timestamp = time();
  
  $time = abs ($timestamp - time());
  $d = floor ($time / 86400);
  $d = ($d < 0) ?0 :$d;
  $time = $time - $d * 86400;
  $h = floor ($time / 3600);
  $h = ($h < 0) ?0 :$h;
  $time = $time - $h * 3600;
  $m = floor ($time / 60);
  $m = ($m < 0) ?0 :$m;
  $s = $time - $m * 60;
  $s = ($s < 0) ?0 :$s;
  
  if ($d > 0 && $h == 0) return "$d дн.";
  if ($d > 0)            return "$d дн. $h ч.";
  if ($h > 0)            return "$h ч. $m мин.";
  if ($m > 0 && $s == 0) return "$m мин.";
  if ($m > 0)            return "$m мин. $s сек.";
                         return "$s сек.";
}
/*Перевод в float*/
function getMoney ($money)
{
  return sprintf ("%01.2f", $money);
}
/*Получение цвета улучшения*/
function getStatSkillColor ($cur, $add)
{
  $diff = ($add > 0) ?(1 - (($cur - $add) / $cur)) * 255 :($add < 0) ?(1 -(($cur - $add*(-1)) / $cur)) * 255 :-50;
  $diff = abs (floor ($diff)) + 50;
  
  if ($diff > 150 && $add > 0) return "#00AA00";
  if ($diff > 150 && $add < 0) return "#AA0000";
  if ($add > 0)                return "RGB(0, $diff, 0)";
  if ($add < 0)                return "RGB($diff, 0, 0)";
                               return "RGB(0, 0, 0)";
}
/*Получение разбивки статов*/
function getBraces ($stat, $added_stat, $type)
{
  if ($added_stat > 0) return "&nbsp;<small>(<font id='{$type}_inst'>".($stat-$added_stat)."</font>+$added_stat)</small>";
  if ($added_stat < 0) return "&nbsp;<small>(<font id='{$type}_inst'>".($stat-$added_stat)."</font>$added_stat)</small>";
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
    $offset = $this -> utf8_strlen($s) + $offset;
  
  if ($len != 'all')
  {
    if ($len < 0)
      $len = utf8_strlen ($s) - $offset + $len;
    
    $xlen = utf8_strlen ($s) - $offset;
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
function databaseErrorHandler($message, $info)
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
function requestVar ($var, $stand = '', $round = false, $may_cookie = false)
{
  if (isset($_GET[$var]))
    $value = $_GET[$var];
  else if (isset($_POST[$var]))
    $value = $_POST[$var];
  else if (isset($_COOKIE[$var]) && $may_cookie)
    $value = $_COOKIE[$var];
  else
    return $stand;

  if (is_numeric ($stand) && is_numeric ($value)) return (is_numeric ($round)) ?round ($value, 2) :$value;
  else if (!is_numeric ($stand))                  return htmlspecialchars ($value);
  else                                            return $stand;
}
?>