<?
session_start();
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
      die('');
    
    $types = $adb->selectCol("SELECT `type` AS ARRAY_KEY FROM `admin_item_create` WHERE `section` = ?s and `type` != 'lang';", $section);
    
    $return = "<select class='field' name='type'><option value='' selected></option>";
    foreach ($types as $type => $n)
      $return .= "<option value='$type'>$type</option>";
    $return .= "</select><br>";
    die($return);
  break;
  case 'showfields':
    $type = getVar('type');
    
    if (!$type)
      die('');
    
    $lang = $adb->selectRow("SELECT * FROM `admin_item_create` WHERE `type` = 'lang';");
    $fields = $adb->selectRow("SELECT * FROM `admin_item_create` WHERE `type` = ?s", $type);
    $table = "<table border='0'>";
    $a = 0;
    foreach ($fields as $field => $val)
    {
      if (!$val || $field == 'section' || $field == 'type')
        continue;
      
      $title = $field;
      switch ($field)
      {
        case 'item_flags':  $title .= " 1-Sellable, 2-Repairable, 4-Artefact, 8-Personal, 16-Left Hand";                                break;
        case 'name':        $return = "<font class='header'>Основные:<hr></font>$table";                       $i = 0; $c = 7;          break;
        case 'min_level':   $return .= "</table><font class='header'>Требования:<hr></font>$table";            $i = 0; $c = 11;         break;
        case 'add_str':     $return .= "</table><font class='header'>Характеристики:<hr></font>$table";        $i = 0; $c = 9;          break;
        case 'def_h':
        case 'def_a':
        case 'def_b':
        case 'def_l':
        case 'attack':
        case 'add_hit_min': if(!$a){$return .= "</table><font class='header'>Защита и урон:<hr></font>$table"; $i = 0; $c = 7; $a = 1;} break;
        case 'res_magic':   $return .= "</table><font class='header'>Резисты:<hr></font>$table";               $i = 0; $c = 12;         break;
        case 'mf_dmg':      $return .= "</table><font class='header'>Мф удара:<hr></font>$table";              $i = 0; $c = 10;         break;
        case 'mf_acrit':    $return .= "</table><font class='header'>Мф усиления:<hr></font>$table";           $i = 0; $c = 9;          break;
        case 'all_magic':   $return .= "</table><font class='header'>Умения:<hr></font>$table";                $i = 0; $c = 12;         break;
        case 'rep_magic':   $return .= "</table><font class='header'>Подавления:<hr></font>$table";            $i = 0; $c = 7;          break;
        case 'ch_sting':    $return .= "</table><font class='header'>Шансы:<hr></font>$table";                 $i = 0; $c = 10;         break;
        case 'inc_count':   $return .= "</table><font class='header'>Дополнительно:<hr></font>$table";         $i = 0; $c = 9;          break;
        case 'description': $return .= '</tr><tr>';                                                                                     break;
      }
      
      switch ($field)
      {
        case 'name':
        case 'personal_owner':
        case 'img':         $size = 150; break;
        case 'validity':
        case 'price':
        case 'price_euro':  $size = 60;  break;
        case 'description': $size = 300;  break;
        default:            $size = 30;  break;
      }
      
      $return .= "<td title='$title'>$lang[$field]:</td><td><input class='field' type='text' name='$field' style='width: ".$size."px;'></td>";
      $i++;
      if (!($i % $c))
        $return .= '</tr><tr>';
    }
    $return .= "</tr></table><input type='submit' name='create' value='Создать'>";
    die($return);
  break;
  case 'createitem':
    $fields = getVar('fields');
    $sql = array();
    $field = explode('$$', $fields);
    unset($field[count($field) - 1]);
    foreach ($field as $fill)
    {
      $f = explode('=', $fill);
      $sql[$f[0]] = $f[1];
    }
    $adb->query("INSERT INTO `item_template` (?#) VALUES (?a);",array_keys($sql), array_values($sql));
    die('complete');
  break;
}
?>