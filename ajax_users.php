<?
session_start ();
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$guid = getGuid ('ajax');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid ('ajax');
$char->test->Afk ();

$char_db = $char->getChar ('char_db', 'city', 'room');
ArrToVar ($char_db);

$do = requestVar ('do');
switch ($do)
{
  case 'refreshusers':
    $room_online = $adb->selectCell ("SELECT COUNT(*) FROM `online` WHERE `city` = ?s and `room` = ?s", $city ,$room);
    $room_name = $char->city->getRoom ($room, $city, 'name');
    $user_list = "<font style='color: #8f0000; font-size: 10pt; font-weight: bold;'>$room_name ($room_online)</font><br>";

    $rows = $adb->selectCol ("SELECT `guid` 
                              FROM `online` 
                              WHERE `city` = ?s 
                                and `room` = ?s 
                              ORDER by `login_display`", $city ,$room);
    foreach ($rows as $num => $online_guid)
      $user_list .= $char->info->character ('online', $online_guid);
    returnAjax ($user_list);
  break;
}
?>