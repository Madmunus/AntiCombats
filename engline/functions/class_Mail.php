<?
defined('AntiBK') or die("Доступ запрещен!");

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
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `c`.`id` = ?d 
                                      and `c`.`guid` = ?d 
                                     and (`i`.`item_flags` & '1') 
                                      and `i`.`price_euro` = '0';", $item_id ,$this->guid);
    list($price, $mass, $tear_cur, $tear_max, $max_tear) = array_values($i_info);
    
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
                      VALUES (?d, ?d, '1000', ?f, ?d, ?d)", $this->guid ,$mail_to ,$send_money ,time() ,time());
    $this->char->history->Mail('Send', "Деньги: $send_money кр", $mail_to);
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
    list($mail_id, $sender, $name, $money_count) = array_values($m_info);
    $name = sprintf ($name, $money_count);
    echoScript("top.menu.location.reload();");
    $this->db->query("DELETE FROM `city_mail_items` WHERE `id` = ?d", $mail_id);
    switch ($type)
    {
      case 'get_money':
        $this->Money (-$money_count);
        $this->char->history->Mail('Receive', $name, $sender);
        $this->char->error->Mail(407, 'get_mail', $name);
      break;
      case 'return_money':
        $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `count`, `delivery_time`, `date`) 
                          VALUES (?d, ?d, '1000', ?f, ?d, ?d)", $this->guid ,$sender ,$money_count ,time() ,time());
        $this->char->history->Mail('Return', $name, $sender);
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
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `c`.`id` = ?d 
                                      and `c`.`guid` = ?d 
                                      and `c`.`wear` = '0' 
                                      and `c`.`mailed` = '0' 
                                      and `i`.`price_euro` = '0';", $item_id ,$this->guid) or $this->char->error->Mail(213, 'items');
    list($i_name, $i_mass) = array_values($i_info);
    $price = $this->getPrice($item_id);
    
    if (!($this->changeMoney(-$price)))
      $this->char->error->Mail(107);
    
    $delivery_time = 1800 + time ();
    $this->db->query("UPDATE `characters` SET `transfers` = `transfers` - '1' WHERE `guid` = ?d", $this->guid);
    $this->db->query("UPDATE `character_inventory` SET `mailed` = '1' WHERE `guid` = ?d and `id` = ?d", $this->guid ,$item_id);
    $this->changeMass(-$i_mass);
    $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `delivery_time`, `date`) 
                      VALUES (?d, ?d, ?d, ?d, ?d)", $this->guid ,$mail_to ,$item_id ,$delivery_time ,time());
    $this->char->history->Mail('Send', "$i_name ($price кр)", $mail_to);
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
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `m`.`to` = ?d 
                                      and `m`.`sender` = `c`.`guid` 
                                      and `m`.`item_id` = ?d 
                                      and `m`.`delivery_time` < ?d 
                                      and `c`.`mailed` = '1';", $this->guid ,$item_id ,time()) or $this->char->error->Mail(112, 'get_mail');
    list($mail_id, $sender, $i_name, $i_mass) = array_values($i_info);
    $this->db->query("DELETE FROM `city_mail_items` WHERE `id` = ?d", $mail_id);
    echoScript("top.menu.location.reload();");
    switch ($type)
    {
      case 'get_item':
        $this->db->query("UPDATE `character_inventory` SET `mailed` = '0', `guid` = ?d, `last_update` = ?d WHERE `guid` = ?d and `id` = ?d", $this->guid ,time() ,$sender ,$item_id);
        $this->changeMass($i_mass);
        $this->char->history->Mail('Receive', $i_name, $sender);
        $this->char->error->Mail(407, 'get_mail', $i_name);
      break;
      case 'return_item':
        $delivery_time = 1800 + time();
        $this->db->query("UPDATE `character_inventory` SET `mailed` = '1' WHERE `guid` = ?d and `id` = ?d", $sender ,$item_id);
        $this->db->query("INSERT INTO `city_mail_items` (`sender`, `to`, `item_id`, `delivery_time`, `date`) 
                          VALUES (?d, ?d, ?d, ?d, ?d)", $this->guid ,$sender ,$item_id ,$delivery_time ,time());
        $this->char->history->Mail('Return', $i_name, $sender);
        $this->char->error->Mail(408, 'get_mail', $i_name);
      break;
    }
  }
}
?>