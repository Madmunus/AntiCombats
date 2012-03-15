<?
defined('AntiBK') or die("Доступ запрещен!");

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
  /*Получение времени до возможности перехода*/
  function getRoomGoTime ()
  {
    $char_db = $this->getChar('char_db', 'last_go', 'room', 'city');
    $time = $this->getRoom($char_db['room'], $char_db['city'], 'time');
    
    if (!$time || !$char_db['room'])
      return 0;
    
    $time_to_go = $time - (time() - $char_db['last_go']);
    
    return ($time_to_go >= 0) ?$time_to_go :0;
  }
  /*Получение кол-ва человек в комнате*/
  function getRoomOnline ($room, $type = 'full')
  {
    $city = $this->getChar('char_db', 'city');
    $online = $this->db->selectCell("SELECT COUNT(*) FROM `online` WHERE `room` = ?s", $room);
    $room_info = $this->getRoom($room, $city, 'name', 'time');
    
    if (!$room_info) return "Bug";
    switch ($type)
    {
      case 'full':   return "<strong>$room_info[name]</strong><br>Сейчас в комнате: $online";
      case 'map':    return $online;
      case 'mini':   return "Время перехода: $room_info[time] сек.<br>Сейчас в комнате: $online";
      default:       return "Bug";
    }
  }
  /*Информация по комнате на карте*/
  function showRoomOnMap ($id)
  {
    $char_db = $this->getChar('char_db', 'room', 'city');
    $name = $this->getRoom($id, $char_db['city'], 'name');
    $flag = ($char_db['room'] == $id) ?"<img src='img/icon/flag2.gif' width='20' height='20' alt='Вы находитесь здесь' align='right'>" :'';
    echo $flag."<strong>$name</strong> (<strong>".$this->getRoomOnline($id, 'map')."</strong>)";
  }
  /*Добавление кнопок в клубе*/
  function addButtons ($loc = 'club')
  {
    $lang = $this->getLang();
    $char_db = $this->getChar('char_db', 'room', 'city', 'last_return', 'return_time');
    $return_status = ((time() - $char_db['last_return']) >= $char_db['return_time']) | false;
    $format = ($loc == 'club') ?'<input type="button" class="btn2" value="%1$s" %2$s /> ' :'<span class="buttons_on_image" %2$s>%1$s</span>&nbsp;';
    $arr = $this->getRoom($char_db['room'], $char_db['city'], 'buttons');
    $buttons = explode (',', $arr);
    foreach ($buttons as $button)
    {
      switch ($button)
      {
        default:       $values = "";
        break;
        case 'fights': $values = array($lang['fights'], "id='link' link='zayavka' style='font-weight: bold; width: 102px;'");
        break;
        case 'return': $values = ($return_status) ?array($lang['return_b'], "id='link' link='return' style='font-weight: bold; width: 102px;'") :"";
        break;
        case 'map':    $values = array($lang['map'], "id='link' link='map' style='font-weight: bold; width: 102px;'");
        break;
        case 'forum':  $values = array($lang['forum'], "id='forum'");
        break;
        case 'hint':   $values = array($lang['hint'], "id='hint' link='top' style='width: 102px;'");
        break;
      }
      if (is_array($values))
        vprintf($format, $values);
    }
  }
  /*Получение подсказки комнаты*/
  function getDescription ($room, $city)
  {
    $char_db = $this->getChar('char_db', 'login', 'room', 'city', 'level', 'exp');
    $descs = $this->getRoom($char_db['room'], $char_db['city'], 'desc1', 'desc2', 'desc3');
    $needs = $this->getRoom($char_db['room'], $char_db['city'], 'desc1_need', 'desc2_need', 'desc3_need');
    
    foreach ($needs as $key => $need)
    {
      if (!$need)
        continue;
      
      $need = split('\=', $need);
      
      if ($char_db[$need[0]] >= $need[1])
      {
        $desc_num = utf8_substr($key, 0, -5);
        return $descs[$desc_num];
      }
    }
    if ($room == 'novice')
      return sprintf($descs['desc3'], $char_db['login']);
    else
      return $descs['desc3'];
  }
}
?>