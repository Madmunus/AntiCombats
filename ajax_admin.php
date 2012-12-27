<?
session_start();
define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");
include("token/bootstrap.php");

$guid = getGuid('ajax');

if (!lpg_csrf_token($guid))
  toIndex('ajax');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('ajax');
$char->test->Admin('ajax');

$do = getVar('do', '', 2);
switch ($do)
{
  /*Удаление персонажа*/
  case 'delete_char':
    $d_guid = getVar('d_guid');
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
    $adb->query("DELETE FROM `history_items` WHERE `guid` = ?d", $d_guid);
    returnAjax('complete');
  break;
}
?>