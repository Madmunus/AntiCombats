<?
defined('AntiBK') or die("Доступ запрещен!");

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
  function Auth ($action, $city, $comment = '')
  {
    $id = ($this->db->selectCell("SELECT MAX(`id`) FROM `history_auth` WHERE `guid` = ?d", $this->guid)) + 1;
    $this->db->query("INSERT INTO `history_auth` (`id`, `guid`, `action`, `ip`, `city`, `comment`, `date`) 
                      VALUES (?d, ?d, ?d, ?s, ?s, ?s, ?d);", $id ,$this->guid ,$action ,$_SERVER['REMOTE_ADDR'] ,$city ,$comment ,time());
  }
  /*История покупки/продажи/передачи предмета*/
  function Items ($action, $val, $to, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    $id = ($this->db->selectCell("SELECT MAX(`id`) FROM `history_items` WHERE `guid` = ?d", $guid)) + 1;
    $this->db->query("INSERT INTO `history_items` (`id`, `guid`, `receive`, `action`, `item`, `date`)
                      VALUES (?d, ?d, ?s, ?s, ?s, ?d)", $id ,$guid ,$to ,$action ,$val ,time());
  }
  /*История отправки/получения/возврата предмета по почте*/
  function Mail ($action, $val, $to, $guid = 0)
  {
    $guid = $this->getGuid($guid);
    $id = ($this->db->selectCell("SELECT MAX(`id`) FROM `history_mail` WHERE `guid` = ?d", $guid)) + 1;
    $this->db->query("INSERT INTO `history_mail` (`id`, `guid`, `receive`, `action`, `item`, `date`)
                      VALUES (?d, ?d, ?s, ?s, ?s, ?d)", $id ,$guid ,$to ,$action ,$val ,time());
  }
  /*История банковских операций*/
  function Bank ($credit, $credit2, $cash, $euro, $operation)
  {
    $id = ($this->db->selectCell("SELECT MAX(`id`) FROM `history_bank` WHERE `credit` = ?d", $credit)) + 1;
    $this->db->query("INSERT INTO `history_bank` (`id`, `credit`, `credit2`, `cash`, `euro`, `operation`, `date`) 
                      VALUES (?d, ?d, ?d, ?f, ?f, ?d, ?d)", $id ,$credit ,$credit2 ,rdf($cash) ,rdf($euro) ,$operation ,time());
  }
}
?>