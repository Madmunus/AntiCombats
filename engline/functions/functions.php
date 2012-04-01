<?
defined('AntiBK') or die("Доступ запрещен!");

/*Функции персонажа*/
include("class_Char.php");
/*Функции проверок*/
include("class_Test.php");
/*Функции предметов*/
include("class_Equip.php");
/*Функции города*/
include("class_City.php");
/*Функции почты*/
include("class_Mail.php");
/*Функции банка*/
include("class_Bank.php");
/*Функции чата*/
include("class_Chat.php");
/*Функции истории*/
include("class_History.php");
/*Функции ошибок*/
include("class_Error.php");
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
/*Получение полосы загрузки*/
function getUpdateBar ()
{
  echo "<table width='80' border='0' cellspacing='0' cellpadding='0'>"
     . "<tr>"
     . "<td><a href='?action=none'><img src='img/room/rel_1.png' width='15' height='16' alt='Обновить' border='0' /></a></td>"
     . "<td>"
     . "<table width='80' border='0' cellspacing='0' cellpadding='0'>"
     . "<tr><td colspan='3' align='center'><img src='img/room/navigatin_462s.gif' width='80' height='3' /></td></tr>"
     . "<tr width='80'>"
     . "<td><img src='img/room/navigatin_481.gif' width='9' height='8' /></td>"
     . "<td width='100%' bgcolor='#000000' nowrap><div id='prcont' align='center' style='font-size: 4px; padding: 0px; border: solid black 0px; text-align: center;'>";
  for ($i = 1; $i <= 32; $i++)
  {
    echo "<span id='progress$i' style='background-color: #00CC00;'>&nbsp;</span>";
    if ($i < 32)
      echo "&nbsp;";
  }
  echo "</div></td>"
     . "<td><img src='img/room/navigatin_50s.gif' width='7' height='8' /></td>"
     . "</tr>"
     . "<tr><td colspan='3'><img src='img/room/navigatin_tt1_532.gif' width='80' height='5' /></td></tr>"
     . "</table></td></tr></table>";
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
    return "0 сек.";
  
  if (!is_numeric($timestamp))
    $timestamp = time();
  
  $seconds = $timestamp - time();
  $seconds = ($seconds > 0) ?$seconds :0;
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
/*Перевод в float*/
function getMoney ($money)
{
  return sprintf("%01.2f", $money);
}
/*Внедрение пробела*/
function getExp ($exp)
{
  return number_format($exp, 0, "", " ");
}
/*Получение цвета улучшения*/
function getColor ($cur, $add)
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
/*Сравнение двух переменных*/
function compare ($var1, $var2, $var3 = 0)
{
  $format = '%1$s';
  if (is_numeric($var1) && is_numeric($var2))
    $format = ($var1 > $var2) ?"<font color=\"#FF0000\">$format</font>" :$format;
  else if (is_string($var1) && is_string($var2))
    $format = ($var1 != $var2) ?"<font color=\"#FF0000\">$format</font>" :$format;
  $text = ($var3) ?$var3 :$var1;
  return sprintf($format, $text);
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
    $offset = $char -> utf8_strlen($s) + $offset;
  
  if ($len != 'all')
  {
    if ($len < 0)
      $len = utf8_strlen($s) - $offset + $len;
    
    $xlen = utf8_strlen($s) - $offset;
    $len = ($len > $xlen) ?$xlen :$len;
    preg_match('/^.{' . $offset . '}(.{0,'.$len.'})/us', $s, $tmp);
  }
  else
    preg_match('/^.{' . $offset . '}(.*)/us', $s, $tmp);
  return (isset($tmp[1])) ?$tmp[1] :false;
}
/*Экранирование запроса LIKE*/
function escapeLike ($s)
{
  return "%".str_replace(array("'", '"', "%", "_"), array("\'", '\"', "", ""), $s)."%";
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
function getVar ($var, $stand = '', $flags = 3)
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
/*Проверка существования переменной SESSION*/
function checks ()
{
  $args = func_get_args();
  $a_num = func_num_args();
  
  if ($a_num == 1)
    return isset($_SESSION[$args[0]]);
  
  foreach ($args as $arg)
  {
    if (!isset($_SESSION[$arg]))
      return false;
  }
  return true;
}
/*Проверка существования и правильного формата числа*/
function checki ($int)
{
  return (!is_numeric($int) || $int == 0);
}
/*Преобразование русско-язычной строки в нижний и верхний регистр*/
define('UPCASE', 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯABCDEFGHIKLMNOPQRSTUVWXYZ');
define('LOCASE', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяabcdefghiklmnopqrstuvwxyz');

function mb_str_split ($str)
{        
    preg_match_all('/.{1}|[^\x00]{1}$/us', $str, $ar);
    return $ar[0];
}
function mb_strtr ($str, $from, $to)
{
  return str_replace(mb_str_split($from), mb_str_split($to), $str);
}
function lowercase ($arg = '')
{
  return mb_strtr($arg, UPCASE, LOCASE);
}
function uppercase ($arg = '')
{
  return mb_strtr($arg, LOCASE, UPCASE);
}
/*Возврат значения ajax запроса*/
function returnAjax ()
{
  $args = func_get_args();
  $str = implode('$$', $args);
  die($str);
}
/*Получение место перехода*/
function toIndex ($type = 'main', $die = true, $loc = '')
{
  switch ($type)
  {
    case 'main':
      deleteSession();
      echoScript("top.location.href = '{$loc}index.php';", $die);
    break;
    case 'game':
      deleteSession();
      echoScript("location.href = '{$loc}index.php';", $die);
    break;
    case 'ajax':
      die("ajax_error");
    break;
  }
}
/*Получение guid персонажа*/
function getGuid ($type = 'main', $loc = '')
{
  if (empty($_SESSION['guid']))
    toIndex($type, true, $loc);
  
  return $_SESSION['guid'];
}
/*Получение названия таблицы*/
function getTable ($name)
{
  switch ($name)
  {
    case 'char_db':    return 'characters';
    case 'char_stats': return 'character_stats';
    case 'char_info':  return 'character_info';
    case 'char_equip': return 'character_equip';
    case 'char_bars':  return 'character_bars';
    case 'online':     return 'online';
  }
}
/*Удаление переменных сессии*/
function deleteSession ()
{
  unset($_SESSION['guid'], $_SESSION['bankСredit'], $_SESSION['last']);
}
/*Смешивает порядок ключей массива сохраняя значения*/
function shuffle_arr ($array)
{
  $keys = array_keys($array);
  shuffle($keys);
  return array_merge(array_flip($keys), $array);
} 
?>