<?
defined('AntiBK') or die("Доступ запрещен!");

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
  /*Вывод ошибки в умениях*/
  function Skills ($id = 0, $parameters = '')
  {
    echoScript("location.href = 'main.php?action=skills&error=$id&parameters=$parameters';", true);
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
    $parametr = array();
    
    if ($parameters)
      $parametr = split("\|", $parameters);
    
    $err = $this->db->selectRow("SELECT `text`, 
                                        `bold`, 
                                        `hyphen` 
                                 FROM `server_errors` 
                                 WHERE `id` = ?d", $id);
    if (!$err)
      return;
    
    list($err_text, $err_bold, $err_hyph) = array_values($err);
    
    if ($err_bold)
      $err_text = "<b>$err_text</b>";
    
    if ($err_hyph || $needBr)
      $err_text = "$err_text<br>";
    
    vprintf($err_text, $parametr);
  }
}
?>