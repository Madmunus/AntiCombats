<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/data/data.php");
include("engline/functions/functions.php");

$guid = getGuid('ajax');

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid('ajax');

$char_db = $char->getChar('char_db', '*');
$char_stats = $char->getChar('char_stats', '*');
$char_feat = array_merge ($char_db, $char_stats);

$lang = $char->getLang();

$login = $char_feat['login'];
$sex = $char_feat['sex'];
$mass = $char_feat['mass'];
$city = $char_feat['city'];
$room = $char_feat['room'];
$money = $char_feat['money'];
$money_euro = $char_feat['money_euro'];
$shut = $char_feat['shut'];

$do = requestVar('do');
switch ($do)
{
  case 'geterror':
    $char->error->getFormattedError($_POST['error'], $_POST['parameters']);
    die ();
  break;
  case 'getroomname':
    $room = requestVar('room');
    $name = $char->city->getRoom($room, $city, 'name');
    $name = "Вы перейдете в: <strong>$name</strong> (<a href='#' class='nick' onclick='return clear_solo ();'>отмена</a>)";
    returnAjax($name);
  break;
  case 'showshapes':
    $available = requestVar('available', 1);
    $sex = ($sex == "male") ?"m" :"f";
    $shapes = $adb->select("SELECT * FROM `player_shapes` WHERE `sex` = ?s ORDER BY `id`;", $sex);
    $required = array ('str', 'dex', 'con', 'vit', 'fire', 'water', 'air', 'earth', 'dark', 'light', 'int', 'wis', 'level', 'sword', 'axe', 'fail', 'knife');
    $return = "<table cellspacing='0' cellpadding='0' border='0' align='center'><tr>";
    $i = 0;
    foreach ($shapes as $shape)
    {
      $availabled = $char->checkShape($shape['id']);
      $requirement = "";
      $title = "";
      foreach ($required as $key)
      {
        if ($shape[$key] <= 0)
          continue;
        
        if (!$requirement)
          $requirement = "$lang[min_stat]<br>";
        
        $title .= (compare ($shape[$key], $char_feat[$key], "&bull; $lang[$key] $shape[$key]"))."<br>";
      }
      if ($availabled)
      {
        $return .= "<td class='shape'><a href='javascript:chooseShape ($shape[id]);'><img src='img/chars/$shape[sex]/$shape[img]' alt='<strong>$lang[select_shape]</strong><br>$requirement$title' border='0' style='opacity: 0.6;' onmouseover=\"this.style.opacity = '1';\" onmouseout=\"this.style.opacity = '0.6';\"></a></td>";
        $i++;
      }
      else if (!$available)
      {
        $return .= "<td class='shape dis_shape'><img src='img/chars/$shape[sex]/$shape[img]' alt='$requirement$title' border='0' style='opacity: 0.6;'></td>";
        $i++;
      }
      
      if ($i % 8 === 0)
        $return .= "</tr><tr>";
    }
    $return .= "</tr></table>";
    returnAjax($return);
  break;
  case 'chooseshape':
    $shape = requestVar('shape', 0);
    
    if (!$shape || !($char->checkShape($shape)))
      returnAjax('error', 215);
    
    $shape = ($sex == "male") ?"m/$shape.gif" :"f/$shape.gif";
    $adb->query("UPDATE `characters` SET `shape` = ?s, `next_shape` = ?d WHERE `guid` = ?d", $shape ,time () + 86400 ,$guid);
    returnAjax('complete');
  break;
  /*Invetory*/
  case 'showinventory':
    $mail_guid = requestVar('mail_guid');
    $section = requestVar('section', 1);
    $type = requestVar('type');
    switch ($type)
    {
      default:
      case 'inv':
        $rows = $adb->select("SELECT * 
                              FROM `character_inventory` AS `c` 
                              LEFT JOIN `item_template` AS `i` 
                              ON `c`.`item_template` = `i`.`entry` 
                              WHERE `i`.`section` = ?s 
                                and `c`.`guid` = ?d 
                                and `c`.`wear` = '0' 
                                and `c`.`mailed` = '0' 
                              ORDER BY `c`.`last_update` DESC", $data['sections'][$section] ,$guid);
      break;
      case 'mail_to':
        $rows = $adb->select("SELECT * 
                              FROM `character_inventory` AS `c` 
                              LEFT JOIN `item_template` AS `i` 
                              ON `c`.`item_template` = `i`.`entry` 
                              WHERE (`i`.`item_flags` & '1') 
                                and `c`.`wear` = '0' 
                                and `c`.`mailed` = '0' 
                                and `i`.`section` = ?s 
                                and `c`.`guid` = ?d 
                                and `i`.`price_euro` = '0' 
                              ORDER BY `c`.`last_update` DESC;", $data['sections'][$section] ,$guid);
      break;
    }
    if (count($rows) > 0)
    {
      $inventory = '';
      $i = 1;
      foreach ($rows as $item_info)
      {
        $inventory .= $char->equip->showItem($item_info, $type, $i, $mail_guid);
        $i = !$i;
      }
      returnAjax($inventory);
    }
    else
      returnAjax("<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>$lang[empty]</td></tr></table>");
  break;
  case 'sortinventory':
    $type = requestVar('type');
    $section = requestVar('section', 1, 7);
    $sort = ($_POST['num']) ?' DESC' :'';
    $items = $adb->selectCol("SELECT `c`.`id` AS ARRAY_KEY, `i`.?# 
                              FROM `character_inventory` AS `c` 
                              LEFT JOIN `item_template` AS `i` 
                              ON `c`.`item_template` = `i`.`entry` 
                              WHERE `c`.`guid` = ?d 
                                and `c`.`wear` = '0' 
                                and `c`.`mailed` = '0' 
                                and `i`.`section` = ?s 
                              ORDER BY `i`.?#$sort", $type ,$guid ,$data['sections'][$section] ,$type);
    $i = 0;
    foreach ($items as $id => $value)
    {
      $q1 = $adb->query("UPDATE `character_inventory` SET `last_update` = ?d WHERE `guid` = ?d and `id` = ?d", time () + $i ,$guid ,$id);
      $i++;
    }
    returnAjax('complete');
  break;
  case 'deleteitem':
    $item_id = requestVar('id', 0);
    $dropall = requestVar('dropall', 0);
    
    if ($item_id == 0 || !is_numeric($item_id))
      returnAjax('error', 213);
    
    switch ($dropall)
    {
      default:
      case 0:
        $item_info = $adb->selectRow("SELECT `i`.`name`, 
                                             `i`.`mass` 
                                      FROM `character_inventory` AS `c` 
                                      LEFT JOIN `item_template` AS `i` 
                                      ON `c`.`item_template` = `i`.`entry` 
                                      WHERE `c`.`guid` = ?d 
                                        and `c`.`id` = ?d 
                                        and `c`.`wear` = '0' 
                                        and `c`.`mailed` = '0';", $guid ,$item_id) or returnAjax('error', 213);
        $mass = $char->changeMass(-$item_info['mass']);
        $adb->query("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
        $char->history->transfers('Throw out', $item_info['name'], $_SERVER['REMOTE_ADDR'], 'Dump');
        returnAjax('complete', $mass, 1);
      break;
      case 1:
        $item_entry = $adb->selectCell("SELECT `item_template` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d and `wear` = '0' and `mailed` = '0';", $guid ,$item_id) or returnAjax('error', 213);
        $items = $adb->select("SELECT `c`.`id`, 
                                      `i`.`name`, 
                                      `i`.`mass` 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_template` = `i`.`entry` 
                               WHERE `c`.`guid` = ?d 
                                 and `c`.`item_template` = ?d 
                                 and `c`.`wear` = '0' 
                                 and `c`.`mailed` = '0';", $guid ,$item_entry) or returnAjax('error', 213);
        $i = 0;
        foreach ($items as $item_info)
        {
          $mass = $char->changeMass(-$item_info['mass']);
          $adb->query("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_info['id'] ,$guid);
          $char->history->transfers('Throw out', $item_info['name'], $_SERVER['REMOTE_ADDR'], 'Dump');
          $i++;
        }
        returnAjax('complete', $mass, $i, $item_entry);
      break;
    }
  break;
  case 'switchbars':
    $bar = requestVar('bar');
    $type = requestVar('type');
    $bars = $adb->selectRow("SELECT `stat`, `mod`, `power`, `def`, `btn`, `set` FROM `character_bars` WHERE `guid` = ?d", $guid) or returnAjax('error');
    foreach ($bars as $key => $value)
    {
      if ($value == 0)
        unset ($bars[$key]);
    }
    asort ($bars);

    if ($bar && in_array ($bar, array_keys ($bars)) && $type && count ($bars) != 1)
    {
      $d_b_v = explode ('|', $bars[$bar]);
      list ($d_b_n, $d_b_s) = array_values ($d_b_v);
      if (($type == 'down' & $d_b_n != count ($bars)) || ($type == 'up' & $d_b_n != 1))
      {
        $c_b_a = ($type == 'down') ?array_slice ($bars, $d_b_n, 1) :array_slice ($bars, $d_b_n - 2, 1);
        list ($c_b_k) = array_keys ($c_b_a);
        list ($c_b_v) = array_values ($c_b_a);
        $c_b_v = explode ('|', $c_b_v);
        list ($c_b_n, $c_b_s) = array_values ($c_b_v);
        $d_b_n += ($type == 'down') ?1 :-1;
        $c_b_n += ($type == 'down') ?-1 :1;
        if ($adb->query("UPDATE `character_bars` SET ?# = ?s, ?# = ?s WHERE `guid` = ?d", $bar ,$d_b_n."|".$d_b_s ,$c_b_k ,$c_b_n."|".$c_b_s ,$guid))
        {
          $bars = $adb->selectRow("SELECT `stat`, `mod`, `power`, `def`, `btn`, `set` FROM `character_bars` WHERE `guid` = ?d", $guid);
          foreach ($bars as $key => $value)
          {
            if ($value == 0)
              unset ($bars[$key]);
          }
          asort ($bars);
          returnAjax('complete', $bar, $char->showInventoryBar($bar, $bars[$bar], count ($bars)), $c_b_k, ($char->showInventoryBar($c_b_k, $bars[$c_b_k], count ($bars))));
        }
      }
      else
        returnAjax('error');
    }
    else
      returnAjax('error');
  break;
  case 'spoilerbar':
    $bar = requestVar('bar');
    $barr = $adb->selectCell("SELECT ?# FROM `character_bars` WHERE `guid` = ?d", $bar ,$guid) or returnAjax('error');
    $bar_v = explode ('|', $barr);
    list ($bar_n, $bar_s) = array_values ($bar_v);
    if ($bar_s == 1)
    {
      $adb->query("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $bar ,$bar_n."|0" ,$guid);
      returnAjax('hide');
    }
    else if ($bar_s == 0)
    {
      $adb->query("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $bar ,$bar_n."|1" ,$guid);
      returnAjax('show');
    }
  break;
  case 'worksets':
    $type = requestVar('type');
    $name = requestVar('name');
    
    if ($name == '')
      returnAjax('error', 222);
    
    switch ($type)
    {
      case 'create':
        $cur_set = $adb->selectRow("SELECT * FROM `character_equip` WHERE `guid` = ?d", $guid) or returnAjax('error', 221);
        $cur_set['name'] = $name;
        unset($cur_set['hand_r_free'], $cur_set['hand_r_type'], $cur_set['hand_l_free'], $cur_set['hand_l_type']);
        $adb->query("DELETE FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name);
        $adb->query("INSERT INTO `character_sets` (?#) 
                      VALUES (?a);", array_keys($cur_set), array_values($cur_set)) or die ("errorA_D222");
        returnAjax('complete', $char->getSetRow($name));
      break;
      case 'delete':
        $set = $adb->selectRow("SELECT * FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name) or returnAjax('error', 221);
        $adb->query("DELETE FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name);
        returnAjax('complete');
      break;
      case 'show':
        $set = $adb->selectRow("SELECT * FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name) or returnAjax('error', 221);
        $set['hand_l_s'] = "hand_l";
        $char_feat = $char->getChar('char_db', 'shape', 'guid');
        $char_feat['name'] = '';
        returnAjax('complete', $char->equip->getCharacterEquipped($set, $char_feat, 'smart'));
      break;
    }
  break;
  case 'increaseitemstat':
    $item_id = requestVar('id', 0);
    $stat = requestVar('stat');
    $count = requestVar('count', 1);
    
    if ($item_id == 0 || !is_numeric($item_id))
      returnAjax('error', 213);
    
    $i_info = $adb->selectRow("SELECT `c`.`inc_count_p`, 
                                      `c`.?#, 
                                      `i`.?# 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_template` = `i`.`entry` 
                               WHERE `c`.`guid` = ?d 
                                 and `c`.`id` = ?d 
                                 and `c`.`wear` = '0' 
                                 and `c`.`mailed` = '0';", 'inc_'.$stat ,'add_'.$stat ,$guid ,$item_id) or returnAjax('error', 213);
    if ($i_info['inc_count_p'] - $count < 0)
      returnAjax('error', 216);
    
    switch ($stat)
    {
      case 'str':
      case 'dex':
      case 'con':
      case 'int': 
                  $inc = $i_info['inc_'.$stat] + $count;
                  $inc_p = $i_info['inc_count_p']-$count;
                  $adb->query("UPDATE `character_inventory` 
                               SET ?# = ?d, 
                                   `inc_count_p` = ?d, 
                                   `last_update` = ?d 
                               WHERE `guid` = ?d 
                                 and `id` = ?d", 'inc_'.$stat ,$inc ,$inc_p ,time () ,$guid ,$item_id);
                  returnAjax('complete', $inc + $i_info['add_'.$stat], $inc_p);
        break;
        default:  returnAjax('error', 219);
        break;
    }
  break;
  case 'inventoryloginbank':
    $credit = requestVar('credit', 0);
    $pass = requestVar('pass');
    $bank_info = $adb->selectRow("SELECT `guid`, 
                                          `password`, 
                                          `cash`, 
                                          `euro` 
                                   FROM `character_bank` 
                                   WHERE `id` = ?d", $credit) or returnAjax('error', 303);
    if ($guid != $bank_info['guid'])
      returnAjax('error', 322);
    
    if (SHA1 ($credit.':'.$pass) != $bank_info['password'])
      returnAjax('error', 302);
    
    $_SESSION['bankСredit'] = $credit;
    returnAjax('complete', "<b>".getMoney($bank_info['cash'])."</b>кр. <b>".getMoney($bank_info['euro'])."</b>екр.<a href='javascript:inventoryUnLoginbank();'><img border='0' valign='bottom' width='13' height='9' title='$lang[credit_exit]' src='img/icon/close_bank.gif'></a>");
  break;
  case 'inventoryunloginbank':
    unset ($_SESSION['bankСredit']);
    $bank = $adb->selectCol("SELECT `id` FROM `character_bank` WHERE `guid` = ?d", $guid) or die ("error");
    foreach ($bank as $num => $bank_id)
    {
      if (empty($credits))
        $credits = $bank_id;
      else
        $credits .= ",".$bank_id;
    }
    returnAjax("<a href=\"javascript:bank_open ('$credits');\" class='nick' style='font-size: 7pt;'>$lang[credit_choose]</a>");
  break;
  /*Shop*/
  case 'getshoptitle':
    $section_shop = requestVar('section_shop');
    returnAjax($lang[$data['sections_shop'][$section_shop][1]].$lang['shop_'.$section_shop]);
  break;
  case 'showshopsection':
    $room_shop = $char->city->getRoom($room, $city, 'shop') or returnAjax("<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>$lang[shop_no]</td></tr></table>");
    $section_shop = requestVar('section_shop', '', 7);
    $level_filter = requestVar('level_filter', '', 7);
    $check_level = ($level_filter > 0 || $level_filter == '0');
    $name_filter = requestVar('name_filter', '', 7);
    setCookie('level_filter', $level_filter,  time () + 3600);
    setCookie('name_filter', $name_filter,  time () + 3600);
    $rows = $adb->select("SELECT * 
                           FROM `item_template` AS `i` 
                           LEFT JOIN `item_amount` AS `a` 
                           ON `i`.`entry` = `a`.`entry` 
                           WHERE `i`.`type` = ?s 
                             and `a`.?# > '0' 
                            {and `i`.`min_level` = ?d} 
                            {and `i`.`name` LIKE (?)} 
                            {and !(`i`.`item_flags` & ?d) 
                             and `i`.`price_euro` = '0'} 
                           ORDER BY `min_level`;", $section_shop ,$city.'-'.$room,
                           (($check_level) ?$level_filter :DBSIMPLE_SKIP),
                           (($name_filter) ?escapeLike($name_filter) :DBSIMPLE_SKIP),
                           (($room != 'shop') ?4 :DBSIMPLE_SKIP));
    if (count($rows) > 0)
    {
      $section = '';
      $i = true;
      foreach ($rows as $item_info)
      {
        $section .= $char->equip->showItem($item_info, 'shop', $i);
        $i = !$i;
      }
      returnAjax($section);
    }
    else
      returnAjax("<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>$lang[shop_empty]</td></tr></table>");
  break;
  case 'buyitem':
    $item_entry = requestVar('entry', 0);
    $count = requestVar('count', 1);
    
    if ($item_entry == 0 || !is_numeric($item_entry))
      returnAjax('error', 403);
    
    $buycount = 0;
    $amount = $city.'-'.$room;
    $room_shop = $char->city->getRoom($room, $city, 'shop') or returnAjax('error', 403);
    $dat = $adb->selectRow("SELECT `i`.`name`, 
                                    `i`.`mass`, 
                                    `i`.`price`, 
                                    `i`.`price_euro`, 
                                    `i`.`tear`, 
                                    `i`.`inc_count`, 
                                    `i`.`validity` 
                             FROM `item_template` AS `i` 
                             LEFT JOIN `item_amount` AS `a` 
                             ON `i`.`entry` = `a`.`entry` 
                             WHERE `i`.`entry` = ?d 
                               and `a`.?# > '0';", $item_entry ,$amount) or returnAjax('error', 403);
    list ($name, $i_mass, $price, $price_euro, $tear, $inc_count, $validity) = array_values ($dat);
    
    for ($i = 1; $i <= $count; $i++)
    {
      $time = ($validity > 0) ?time () + $validity * 3600 :0;
      $char->equip->getBuyValue($price);
      $char->equip->getBuyValue($price_euro);
      
      if (($price > 0 && !($char->changeMoney(-$price))) || ($price_euro > 0 && !($char->changeMoney(-$price_euro, 'euro'))))
        continue;
      
      $money = $money - $price;
      $money_euro = $money_euro - $price_euro;
      $mass = $char->changeMass($i_mass);
      //$adb->query("UPDATE `character_stats` SET `trade` = `trade` + '0.01' WHERE `guid` = ?d", $guid);
      $adb->query("INSERT INTO `character_inventory` (`guid`, `item_template`, `tear_max`, `inc_count_p`, `made_in`, `date`, `last_update`) 
                    VALUES (?d, ?d, ?f, ?d, ?s, ?d, ?d)", $guid ,$item_entry ,$tear ,$inc_count ,$city ,$time ,time ());
      $adb->query("UPDATE `item_amount` SET ?# = ?# - '1' WHERE `entry` = ?d", $amount ,$amount ,$item_entry);
      if ($price > 0)
        $char->history->transfers('Buy', "$name ($price кр)", $_SERVER['REMOTE_ADDR'], $room);
      else if ($price_euro > 0)
        $char->history->transfers('Buy', "$name ($price_euro екр)", $_SERVER['REMOTE_ADDR'], $room);
      $buycount++;
    }
    if ($buycount != 0 && $price > 0)
      returnAjax('complete', getMoney($money), $mass, 400, "$name|".($price*$buycount)."|$buycount");
    else if ($buycount != 0 && $price_euro > 0)
      returnAjax('complete', getMoney($money_euro), $mass, 401, "$name|".($price_euro*$buycount)."|$buycount");
    else
      returnAjax('error', 107);
  break;
  case 'sellitem':
    $item_id = requestVar('id', 0);
    
    if ($item_id == 0 || !is_numeric($item_id))
      returnAjax('error', 213);
    
    $dat = $adb->selectRow("SELECT `i`.`name`, 
                                    `i`.`mass`, 
                                    `i`.`price`, 
                                    `i`.`price_euro`, 
                                    `c`.`tear_cur`, `c`.`tear_max`, 
                                    `i`.`tear` 
                             FROM `character_inventory` AS `c` 
                             LEFT JOIN `item_template` AS `i` 
                             ON `c`.`item_template` = `i`.`entry` 
                             WHERE (`i`.`item_flags` & '1') 
                                and `c`.`id` = ?d 
                                and `c`.`guid` = ?d 
                                and `c`.`wear` = '0' 
                                and `c`.`mailed` = '0';", $item_id ,$guid) or returnAjax('error', 213);
    list ($name, $i_mass, $price, $price_euro, $tear_cur, $tear_max, $tear) = array_values ($dat);
    $sell_price = getSellValue($dat);
    $mass = $char->changeMass(-$i_mass);
    if ($price > 0)
    {
      $char->changeMoney($sell_price);
      $money = $money + $sell_price;
      $adb->query("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
      $char->history->transfers('Sell', "$name ($sell_price кр)", $_SERVER['REMOTE_ADDR'], 'Shop');
      returnAjax('complete', getMoney($money), $mass, 404, "$name|$sell_price");
    }
    else if ($price_euro > 0)
    {
      $char->changeMoney($sell_price, 'euro');
      $money_euro = $money_euro + $sell_price_euro;
      $adb->query("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
      $char->history->transfers('Sell', "$name ($sell_price екр)", $_SERVER['REMOTE_ADDR'], 'Shop');
      returnAjax('complete', getMoney($money_euro), $mass, 405, "$name|$sell_price");
    }
  break;
  /*Skills*/
  case 'increasestat':
    $stat = requestVar('stat');
    $travm = $char_feat['travm'];
    $s_stat = str_replace (':', '', $lang[$stat]);
    if ($char_stats['ups'] > 0 && $travm == 0 && isset($behaviour[$stat]) && $char_feat['level'] >= $behaviour[$stat] && $char->changeStats($stat, 1))
    {
      $adb->query("UPDATE `character_stats` SET `ups` = `ups` - '1' WHERE `guid` = ?d", $guid);
      returnAjax('complete', 200, $s_stat);
    }
    else
      returnAjax('error', 199, $s_stat);
  break;
  case 'increaseskill':
    $stat = requestVar('stat');
    $travm = $char_feat['travm'];
    $weapon = array ('sword', 'fail', 'staff', 'knife', 'axe');
    $magic = array ('fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');
    $char->showStatAddition();
    $s_stat = str_replace (':', '', $lang[$stat]);
    if ($char_stats['skills'] > 0 && $travm == 0 && isset($mastery[$stat]) && $char_feat['level'] >= $mastery[$stat] && 
       ((in_array ($stat, $weapon) & ($char_feat[$stat] - $added[$stat]) < 5) || (in_array ($stat, $magic) & ($char_feat[$stat] - $added[$stat]) < 10)))
    {
      if ($adb->query("UPDATE `character_stats` SET ?# = ?# + '1' WHERE `guid` = ?d", $stat ,$stat ,$guid))
        $adb->query("UPDATE `character_stats` SET `skills` = `skills` - '1' WHERE `guid` = ?d", $guid);
      returnAjax('complete', 200, $s_stat);
    }
    else
      returnAjax('error', 199, $s_stat);
  break;
}
?>