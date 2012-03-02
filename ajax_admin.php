<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$guid = getGuid('ajax');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('ajax');
$char->test->Admin('ajax');

$do = requestVar('do');
switch ($do)
{
  /*Удаление персонажа*/
  case 'delete_char':
    $d_guid = requestVar('guid');
    $adb->query("DELETE FROM `character_bank` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_bars` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_effects` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_equip` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_info` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_inventory` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_sets` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `character_stats` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `characters` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `history_auth` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `history_mail` WHERE `guid` = ?d", $d_guid);
    $adb->query("DELETE FROM `history_transfers` WHERE `guid` = ?d", $d_guid);
    returnAjax('complete');
  break;
}
?>