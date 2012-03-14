<?
defined('AntiBK') or die("Доступ запрещен!");

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
                                  WHERE `id` = ?d
                                    and `guid` = ?d", $id ,$this->guid);
    if (!$seek)
      return 303;
    
    if ($this->guid != $seek['guid'])
      return 322;
        
    if (SHA1($id.':'.$pass) != $seek['password'])
      return 302;
    
    $_SESSION['bankСredit'] = $id;
    return 0;
  }
  /*Конец работы с банковским счетом*/
  function unLogin ()
  {
    unset($_SESSION['bankСredit']);
  }
  /*Увеличение/уменьшение денег в банке у персонажа*/
  function Money ($sum, $id, $type = '', $guid = 0)
  {
    if ($id == 0 || !is_numeric($sum) || !is_numeric($id))
      $this->char->error->Map(326);
    
    $sum = round($sum, 2);
    
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
?>