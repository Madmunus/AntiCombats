<?
defined('AntiBK') or die("Доступ запрещен!");

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
                      VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $sender ,$char_db['login'] ,$char_db['room'] ,$text ,$class ,time() ,$char_db['city']);
    echoScript("try {top.msg.updateMessages();} catch(e) {}");
  }
  /*Выполнение комманд в чате*/
  function executeCommand ($name, $message)
  {
    $char_db = $this->getChar('char_db', 'afk', 'login', 'room', 'city', $this->guid);
    switch ($name)
    {
      case '/afk':
        $message = str_replace('/afk', '', $message);
        
        if (isset($message[0]) && $message[0] != ' ')
          return false;
        
        $message = (isset($message[1])) ?preg_replace("/ /", "", $message, 1) :'away from keyboard';
        $this->setChar('char_db', array('afk' => 1, 'dnd' => 0, 'message' => $message));
        return true;
      break;
      case '/dnd':
        $message = str_replace('/dnd', '', $message);
        
        if ($message == '' || (isset($message[0]) && $message[0] != ' ') || !isset($message[1]))
          return false;
        
        $this->setChar('char_db', array('afk' => 0, 'dnd' => 1, 'message' => $message));
        return true;
      break;
        case '/e':
          $emotion = str_replace('/e', '', $message);
          
          if ($emotion == '' || (isset($emotion[0]) && $emotion[0] != ' ') || !isset($emotion[1]))
            return false;
          
          $this->db->query("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                            VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $char_db['login'] ,'' ,$char_db['room'] ,$emotion ,'emotion' ,time() ,$char_db['city']);
          return true;
        break;
        default:
          return false;
        break;
    }
  }
}
?>