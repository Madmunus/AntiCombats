<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("../engline/config.php");
include("../engline/dbsimple/Generic.php");
include("../engline/data/data.php");
include("../engline/functions/functions.php");

$guid = getGuid('ajax', '../');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('ajax', '../');
$char->test->Admin('ajax', '../');

$do = getVar('do');

switch ($do)
{
  case 'showtypes':
    $section = getVar('section');
    
    if (!$section)
      die ('');
    
    $types = $adb->selectCol("SELECT `type` AS ARRAY_KEY FROM `admin_item_create` WHERE `section` = ?s and `type` != 'lang';", $section);
    
    $return = "<select class='field' name='type'><option value='' selected></option>";
    foreach ($types as $type => $n)
      $return .= "<option value='$type'>$type</option>";
    $return .= "</select><br>";
    die ($return);
  break;
  case 'showfields':
    $type = getVar('type');
    
    if (!$type)
      die ('');
    
    $lang = $adb->selectRow("SELECT * FROM `admin_item_create` WHERE `type` = 'lang';");
    $fields = $adb->selectRow("SELECT * FROM `admin_item_create` WHERE `type` = ?s", $type);
    $return = "<table border='0' width='100%'><tr><td colspan='8' class='header'>Основные:<hr></td></tr><tr>";
    $i = 0;
    foreach ($fields as $field => $val)
    {
      switch ($field)
      {
        case 'min_dex':   $return .= "</tr><tr><td colspan='8' class='header'>Требования:<hr></td></tr><tr>";     $i = 0; break;
        case 'add_str':   $return .= "</tr><tr><td colspan='8' class='header'>Характеристики:<hr></td></tr><tr>"; $i = 0; break;
        case 'def_h_min': $return .= "</tr><tr><td colspan='8' class='header'>Защита:<hr></td></tr><tr>";         $i = 0; break;
        case 'res_magic': $return .= "</tr><tr><td colspan='8' class='header'>Резисты:<hr></td></tr><tr>";        $i = 0; break;
        case 'mf_dmg':    $return .= "</tr><tr><td colspan='8' class='header'>Мф удара:<hr></td></tr><tr>";       $i = 0; break;
        case 'mf_acrit':  $return .= "</tr><tr><td colspan='8' class='header'>Мф усиления:<hr></td></tr><tr>";    $i = 0; break;
        case 'all_magic': $return .= "</tr><tr><td colspan='8' class='header'>Умения:<hr></td></tr><tr>";         $i = 0; break;
        case 'min_hit':   $return .= "</tr><tr><td colspan='8' class='header'>Урон:<hr></td></tr><tr>";           $i = 0; break;
        case 'rep_magic': $return .= "</tr><tr><td colspan='8' class='header'>Подавления:<hr></td></tr><tr>";     $i = 0; break;
        case 'ch_sting':  $return .= "</tr><tr><td colspan='8' class='header'>Шансы:<hr></td></tr><tr>";          $i = 0; break;
        case 'inc_count': $return .= "</tr><tr><td colspan='8' class='header'>Дополнительно:<hr></td></tr><tr>";  $i = 0; break;
      }
      
      if (!$val || $field == 'section' || $field == 'type')
        continue;
      
      $size = ($field == 'name') ?20 :10;
      $return .= "<td>$lang[$field]:</td><td><input class='field' type='text' name='$field' size='$size'></td>";
      $i++;
      if (!($i % 4))
        $return .= '</tr><tr>';
    }
    $return .= "</tr></table><input type='submit' name='create' value='Создать'>";
    die ($return);
  break;
  case 'createitem':
    $fields = getVar('fields');
    $sql = array();
    $field = explode('A_D', $fields);
    unset ($field[count($field) - 1]);
    foreach ($field as $fill)
    {
      $f = explode('=', $fill);
      $sql[$f[0]] = $f[1];
    }
    if ($adb->query("INSERT INTO `item_template` (?#) VALUES (?a);",array_keys($sql), array_values($sql)))
    {
      $entry = $adb->selectCell("SELECT MAX(`entry`) FROM `item_template`;");
      $adb->query("INSERT INTO `item_amount` (`entry`) VALUES (?d);", $entry);
      die('complete');
    }
  break;
}
?>