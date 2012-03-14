<?
defined('AntiBK') or die("Доступ запрещен!");

class Info extends Char
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
  /*Показ строки персонажа*/
  function character ($type = 'clan', $guid = 0)
  {
    $guid = (!$guid) ?$this->guid :$guid;
    $char_db = $this->getChar('char_db', 'login', 'level', 'orden', 'clan', 'clan_short', 'block', 'rang', 'chat_shut', 'afk', 'dnd', 'message', 'travm', $guid);
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
    switch ($type)
    {
      case 'online': return "&nbsp;<a href=javascript:top.AddToPrivate('$login_link',true);><img border='0' src='img/lock.gif' title='Приват'></a>&nbsp;&nbsp;$afk$orden_img$clan<a href=javascript:top.AddTo('$login_link'); class='nick'><b>$login</b></a>[$level]$login_info$mol$travm<br>";
      case 'mults':  return "$orden_img$clan<b>$login</b> [$level]$login_info $banned <br>";
      case 'clan':   return "$orden_img$clan<b>$login</b> [$level]$login_info";
      case 'turn':   return $orden_img;
      case 'name':   return $login;
      case 'news':   return "$orden_img$clan<font class='header'>$login</font> [$level]$login_info";
      case 'mail':   return "<font color='red'>$login</font> $login_info";
      default:       return "";
    }
  }
  /*Вывод списка профессионалов*/
  function showArch ($f_style)
  {
    $rows = $this->db->selectCol("SELECT `guid` FROM `characters` WHERE `f_style` = ?s ORDER BY `exp` DESC LIMIT 5", $f_style);
    if (count($rows) == 0)
      return "Нет таких бойцов.";
    
    foreach ($rows as $num => $char)
      return $this->character('clan', $char)."<br>";
    return "";
  }
}
?>