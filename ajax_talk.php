<?
session_start ();
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/data/data.php");
include ("engline/functions/functions.php");

$guid = getGuid ('ajax');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid ('ajax');

$char_db = $char->getChar ('char_db', '*');
$char_stats = $char->getChar ('char_stats', '*');
$char_feat = array_merge ($char_db, $char_stats);

$lang = $char->getLang ();

$do = requestVar ('do');

$login = $char_feat['login'];
$city = $char_feat['city'];
$room = $char_feat['room'];
$shut = $char_feat['shut'];

switch ($do)
{
  case 'sendmessage':
    $h = requestVar ('h');
    
    $commands = $adb->selectCol ("SELECT `name` FROM `server_commands`;");
    $command = false;

    if (!$h || $shut)
      returnAjax ('none');
    
    $color = $char->getChar ('char_info', 'color');
    
    if ($h[0] == '/')
    {
      foreach ($commands as $num => $name)
      {
        if (utf8_substr ($h, 0, utf8_strlen($name)) == $name && $command = $char->chat->executeCommand ($name, $h, $guid))
          returnAjax ('complete');
      }
    }
    
    $h = str_replace ("\n", "", $h);
    $to = split (']', str_replace (array('to [', 'private ['), "]", $h));
    
    if (isset ($to[1]))
    {
      $h = preg_replace ("/private \[$to[1]/", "private [", $h, 1);
      $to = str_replace (", ", ",", $to[1]);
    }
    else
      $to = $to[0];
    
    if (utf8_substr ($h, 0, 4) == 'to [')
      $class = 'to';
    else if (utf8_substr ($h, 0, 9) == 'private [')
      $class = 'private';
    else
      $class = 'all';
    
    $adb->query ("UPDATE `characters` SET `afk` = '0' WHERE `guid` = ?d", $guid);
    if ($adb->query ("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                      VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $login ,$to ,$room ,"<font color=$color>$h</font>" ,$class ,time () ,$city))
      returnAjax ('complete');
  break;
}
?>