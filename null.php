<?
session_start ();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

if (empty($_SESSION['guid']))
	die ("<script>top.location.href = 'index.php';</script>");
else
  $guid = $_SESSION['guid'];

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/data/data.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$test = Test::setguid($guid);
$chat = new Chat;

$test -> GuidForm ($guid, &$db);

global $h;

$db = $adb -> selectRow ("SELECT `login`, 
                                 `room`, 
                                 `city`, 
                                 `shut`, 
                                 `chat_s` 
                          FROM `characters` 
                          WHERE `guid` = ?d", $guid);
list ($login, $room, $city, $shut, $chat_s) = array_values ($db);

$commands = $adb -> selectCol ("SELECT `name` FROM `server_commands`;");
$command_a = false;

if (!$h || $shut || $chat_s == 2) exit ();
$color = $adb -> selectCell ("SELECT `color` FROM `character_info` WHERE `guid` = ?d", $guid);

foreach ($commands as $num => $name)
{
  if (utf8_substr ($h, 0, utf8_strlen($name)) == $name)
  {
    $command_a = $chat -> executeCommand ($name, $h, $guid);
    break;
  }
}
if (!$command_a)
{
  $h = htmlspecialchars ($h);
  $h = str_replace ("\n", "", $h);
  $to = split (']', str_replace (array('to [', 'private ['), "]", $h));
  $h = preg_replace ("/private \[$to[1]/", "private [", $h, 1);
  $to = str_replace (", ", ",", $to[1]);
  
  if (utf8_substr ($h, 0, 4) == 'to [')
    $class = 'to';
  else if (utf8_substr ($h, 0, 9) == 'private [')
    $class = 'private';
  else
    $class = 'all';
  
  $adb -> query ("UPDATE `characters` SET `afk` = '0' WHERE `guid` = ?d", $guid);
  $adb -> query ("INSERT INTO `city_chat` (`sender`, `to`, `room`, `msg`, `class`, `date_stamp`, `city`) 
                  VALUES (?s, ?s, ?s, ?s, ?s, ?d, ?s)", $login ,$to ,$room ,"<font color=$color>$h</font>" ,$class ,time () ,$city);
}
?>
<script type="text/javascript">
  top.ref.document.location.reload();
  parent.talk.document.talker.phrase.value = '';
  parent.talk.document.talker.phrase.focus();
</script>