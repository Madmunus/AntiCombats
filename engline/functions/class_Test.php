<?
defined('AntiBK') or die("Доступ запрещен!");

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
    if ($this->guid == 0 || !is_numeric($this->guid))
      toIndex($type, true, $loc);
    
    $char_db = $this->getChar('char_db', 'guid');
    $char_stats = $this->getChar('char_stats', 'guid');
    $char_info = $this->getChar('char_info', 'guid');
    $ip = $this->db->selectCell("SELECT `ip` FROM `online` WHERE `guid` = ?d", $this->guid);
    
    if (!$char_db || !$char_stats || !$char_info || $ip != $_SERVER['REMOTE_ADDR'])
      toIndex($type, true, $loc);
  }
  /*Проверка на доступ*/
  function Admin ($type = 'main', $loc = '')
  {
    $admin_level = $this->getChar('char_db', 'admin_level');
    
    if (!$admin_level)
      toIndex($type, true, $loc);
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
      echoScript("top.main.location.href = 'zayavka.php';", true);
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
  /*Проверка на получение апа/уровня*/
  function Up ()
  {
    $char_db = $this->getChar('char_db', 'exp', 'next_up', 'level');
    
    if ($char_db['exp'] < $char_db['next_up'])
      return;
    
    $exp_table = $this->db->selectRow("SELECT `up`, `level`, `ups`, 
                                              `skills`, `money`, `vit`, 
                                              `spi`, `hp_regen`, 
                                              `add_bars`, `status` 
                                       FROM `player_exp_for_level` 
                                       WHERE `exp` = ?d", $char_db['next_up']);
    list($this_up, $next_level, $next_ups, $next_skills, $next_money, $next_vit, $next_spi, $next_hpr, $next_bars, $next_status) = array_values($exp_table);
    $next_exp = $this->db->selectCell("SELECT `exp` FROM `player_exp_for_level` WHERE `up` = ?d", ($this_up + 1));
    $this->db->query("UPDATE `characters` 
                      SET `next_up` = ?d, 
                          `money` = `money` + ?f 
                      WHERE `guid` = ?d", $next_exp ,$next_money ,$this->guid);
    $this->db->query("UPDATE `character_stats` 
                      SET `ups` = `ups` + ?d, 
                          `skills` = `skills` + ?d 
                      WHERE `guid` = ?d", $next_ups ,$next_skills ,$this->guid);
    
    if ($next_vit)
      $this->changeStats('vit', $next_vit);
    
    if ($next_spi)
    $this->changeStats('spi', $next_spi);
    
    if ($next_money)
      $this->char->history->Items('Get', "$next_money кр.", 'Level');
    
    if ($next_level <= $char_db['level'])
    {
      if ($char_db['exp'] >= $next_exp)
        $this->Up();
      return;
    }
    
    $this->db->query("UPDATE `characters` 
                      SET `level` = ?d, 
                          `status` = ?s 
                      WHERE `guid` = ?d", $next_level ,$next_status ,$this->guid);
    $this->db->query("UPDATE `character_stats` SET `maxmass` = `maxmass` + ?f, `hp_regen` = `hp_regen` - ?d WHERE `guid` = ?d", 40 ,$next_hpr ,$this->guid);
    if ($next_bars)
    {
      $bar_enums = array('mod' => 2, 'power' => 3, 'def' => 4, 'set' => 5, 'btn' => 6);
      $next_bars = explode(',', $next_bars);
      foreach ($next_bars as $key => $value)
      {
        $this->db->query("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $value ,$bar_enums[$value]."|1" ,$this->guid);
      }
    }
    if ($char_db['exp'] >= $next_exp)
      $this->Up();
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
    $to_go_sec = intval(($all_time - time()));  /*seconds*/
    $time_to_go = intval($len / $speed * 3600); /*секунд идти*/
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
      die();
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
    
    $char_db = $this->getChar('char_db', 'room', 'city', 'sex', 'level', 'prision');
    $char_stats = $this->getChar('char_stats', 'mass', 'maxmass');
    $room_info = $this->char->city->getRoom($room_go, $char_db['city'], 'room', 'from', 'min_level', 'max_level', 'need_orden', 'sex') or $this->char->error->Map(102);
    
    list($room_go, $from, $min_level, $max_level, $need_orden, $need_sex) = array_values($room_info);
    
    if ($char_db['prision'] != 0)
      $this->char->error->Map(100);
    
    if ($char_stats['mass'] > $char_stats['maxmass'])
      $this->char->error->Map(103, "$char_stats[mass]|$char_stats[maxmass]");
    
    if ($char_db['level'] < $min_level)
      $this->char->error->Map(101);
    
    if ($char_db['level'] > $max_level)
      $this->char->error->Map(109, $max_level);
    
    if ($need_orden)
      $this->char->error->Map(102);
    
    if ($need_sex && $char_db['sex'] != $need_sex)
    {
      $need_sex = ($need_sex == 'female') ?'женщинам' :'мужчинам';
      $this->char->error->Map(104, $need_sex);
    }
    
    if (!in_array($char_db['room'], explode(',', $from)) && $char_db['room'] != $room_go)
      $this->char->error->Map(102);
    
    if (($this->char->city->getRoomGoTime()) > 0 && !$return)
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
      list($item_id, $item_wear, $item_mailed) = array_values($inventory);
      
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
    
    if ($char_db['afk'] && $char_db['message'] == 'away from keyboard')
      $this->db->query("UPDATE `characters` SET `afk` = '0', `message` = NULL WHERE `guid` = ?d", $this->guid);
  }
  /*Проверка эффектов*/
  function Effects ()
  {
    $effects = $this->db->select("SELECT * FROM `character_effects` WHERE `guid` = ?d", $this->guid);
    foreach ($effects as $effect)
    {
      if ($effect['end_time'] != 0 && time() > $effect['end_time'])
        $this->deleteEffect($effect['effect_entry']);
    }
  }
  /*Проверка онлайн*/
  function Online ($guid = 0)
  {
    if ($guid == $this->guid)
      return true;
    
    $last_time = $this->getChar('char_db', 'last_time', $guid);
    
    if ((time() - $last_time) > 100)
    {
      $this->db->query("DELETE FROM `online` WHERE `guid` = ?d", $guid);
      return false;
    }
    return true;
  }
}
?>