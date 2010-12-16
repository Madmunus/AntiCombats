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

$db = $adb -> selectRow ("SELECT * FROM `characters` AS `c` LEFT JOIN `character_stats` AS `s` ON `c`.`guid` = `s`.`guid`  WHERE `c`.`guid` = ?d", $guid) or die ("<script>top.location.href = 'index.php';</script>");
$lang = $adb -> selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");

$equip = Equip::setguid($guid);
$mail = Mail::setguid($guid);
$history = History::setguid($guid);
$error = new Error;

$do = requestVar ('do');

$sex = $db['sex'];
$mass = $db['mass'];
$city = $db['city'];
$room = $db['room'];
$money = $db['money'];
$money_euro = $db['money_euro'];

switch ($do)
{
  case 'geterror':
    $error -> getFormattedError ($_POST['warning'], $_POST['parameters']);
    die ();
  break;
  case 'showinventory':
    $mail_guid = requestVar ('mail_guid');
    $section = requestVar ('section');
    switch ($_POST['type'])
    {
      default:
      case 'inv':
        $rows = $adb -> select ("SELECT * 
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
        $rows = $adb -> select ("SELECT * 
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
      $i = true;
      foreach ($rows as $item_info)
      {
        echo $equip -> showItemInventory ($item_info, $_POST['type'], $i, $mail_guid);
        $i = !$i;
      }
      die ();
    }
    else
      die ("<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>ПУСТО</td></tr></table>");
  break;
  case 'sortinventory':
    $type = requestVar ('type');
    $section = requestVar ('section', 1, false, true);
    $sort = ($_POST['num'] == 1) ?' DESC' :'';
    $items = $adb -> selectCol ("SELECT `c`.`id` AS ARRAY_KEY, `i`.?#
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
      $q1 = $adb -> query ("UPDATE `character_inventory` SET `last_update` = ?d WHERE `guid` = ?d and `id` = ?d", time () + $i ,$guid ,$id);
      $i++;
    }
    die ("complete");
  break;
  case 'showshopsection':
    $room_shop = $adb -> selectCell ("SELECT `shop` FROM `city_rooms` WHERE `city` = ?s and `room` = ?s", $city ,$room);
    if (!$room_shop)
      die ("<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>Это место не является магазином</td></tr></table>");
    
    $section_shop = requestVar ('section_shop', '', false, true);
    $level_filter = requestVar ('level_filter', '', false, true);
    $check_level = ($level_filter > 0 || $level_filter == '0');
    $name_filter = requestVar ('name_filter', '', false, true);
    setCookie ('level_filter', $level_filter,  time () + 3600);
    setCookie ('name_filter', $name_filter,  time () + 3600);
    $rows = $adb -> select ("SELECT * 
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
                             (($name_filter) ?escapeLike ($name_filter) :DBSIMPLE_SKIP),
                             (($room == 'shop') ?4 :DBSIMPLE_SKIP));
    if (count($rows) > 0)
    {
      $i = true;
      foreach ($rows as $item_info)
      {
        echo $equip -> showItemInventory ($item_info, 'shop', $i);
        $i = !$i;
      }
      die ();
    }
    else
      die ("<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>Прилавок магазина пустой</td></tr></table>");
  break;
  case 'getshoptitle':
    $section_shop = requestVar ('section_shop');
    die ($lang[$data['sections_shop'][$section_shop][1]].$lang['shop_'.$section_shop]);
  break;
  case 'getroomname':
    $room = requestVar ('room');
    $name = $adb -> selectCell ("SELECT `name` FROM `city_rooms` WHERE `city` = ?s and `room` = ?s", $city ,$room);
    die ($name);
  break;
  case 'switchbars':
    $bar = requestVar ('bar');
    $type = requestVar ('type');
    $bars = $adb -> selectRow ("SELECT `stat`, `mod`, `power`, `def`, `btn`, `set` FROM `character_bars` WHERE `guid` = ?d", $guid);
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
        if ($adb -> query ("UPDATE `character_bars` SET ?# = ?s, ?# = ?s WHERE `guid` = ?d", $bar ,$d_b_n."|".$d_b_s ,$c_b_k ,$c_b_n."|".$c_b_s ,$guid))
        {
          $bars = $adb -> selectRow ("SELECT `stat`, `mod`, `power`, `def`, `btn`, `set` FROM `character_bars` WHERE `guid` = ?d", $guid);
          foreach ($bars as $key => $value)
          {
            if ($value == 0)
              unset ($bars[$key]);
          }
          asort ($bars);
          echo "completeA_D";                                                        //0
          echo $bar."A_D";                                                            //1
          echo $equip -> showInventoryBar ($bar, $bars[$bar], count ($bars))."A_D";    //2
          echo $c_b_k."A_D";                                                        //3
          die ($equip -> showInventoryBar ($c_b_k, $bars[$c_b_k], count ($bars)));    //4
        }
      }
      else
        die ("error");
    }
    else
      die ("error");
  break;
  case 'spoilerbar':
    $bar = requestVar ('bar');
    $row = $adb -> selectRow ("SELECT ?# FROM `character_bars` WHERE `guid` = ?d", $bar ,$guid);
    
    if (!$row[$bar])
      die ("error");
    
    $bar_v = explode ('|', $row[$bar]);
    list ($bar_n, $bar_s) = array_values ($bar_v);
    if ($bar_s == 1)
    {
      $bar_s = 0;
      $adb -> query ("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $bar ,$bar_n."|".$bar_s ,$guid);
      die ("hide");
    }
    else if ($bar_s == 0)
    {
      $bar_s = 1;
      $adb -> query ("UPDATE `character_bars` SET ?# = ?s WHERE `guid` = ?d", $bar ,$bar_n."|".$bar_s ,$guid);
      die ("show");
    }
  break;
  case 'increaseitemstat':
    $item_id = requestVar ('id', 0);
    $stat = requestVar ('stat');
    $count = requestVar ('count', 1);
    
    if ($item_id == 0 || !is_numeric($item_id))
      die ("errorA_D213");
    
    global $adb, $lang;
    $inc_count_p = $adb -> selectCell ("SELECT `inc_count_p` 
                                        FROM `character_inventory` 
                                        WHERE `guid` = ?d 
                                          and `id` = ?d 
                                          and `wear` = '0' 
                                          and `mailed` = '0';", $guid ,$item_id) or die ("errorAJAX_DELIMITER213");
    if ($inc_count_p - $count < 0)
      die ("errorA_D216");
    
    switch ($stat)
    {
      case 'str':
      case 'dex':
      case 'con':
      case 'int': $adb -> query ("UPDATE `character_inventory` 
                                  SET ?# = ?# + ?d, 
                                      `inc_count_p` = `inc_count_p` - ?d, 
                                      `last_update` = ?d 
                                  WHERE `guid` = ?d 
                                    and `id` = ?d", 'inc_'.$stat ,'inc_'.$stat ,$count ,$count ,time () ,$guid ,$item_id);
                  $inc = $adb -> selectRow ("SELECT ?#, `inc_count_p` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d", 'inc_'.$stat ,$guid ,$item_id);
                  die ("completeA_D".$inc['inc_'.$stat]."A_D".$inc['inc_count_p']);
        break;
        default:  die ("errorA_D219");
        break;
    }
  break;
  case 'showshapes':
    $available = requestVar ('available', 1);
    $sex = ($sex == "male") ?"m" :"f";
    $shapes = $adb -> select ("SELECT * FROM `player_shapes` WHERE `sex` = ?s ORDER BY `id`;", $sex);
    $required = array ('str', 'dex', 'con', 'vit', 'fire', 'water', 'air', 'earth', 'dark', 'light', 'int', 'wis', 'level', 'sword', 'axe', 'fail', 'knife');
    $return = "<table cellspacing='0' cellpadding='0' border='0' align='center'><tr>";
    $i = 0;
    foreach ($shapes as $shape)
    {
      $availabled = $equip -> checkShape ($shape['id']);
      $requirement = "";
      $title = "";
      foreach ($required as $key)
      {
        if ($shape[$key] <= 0)
          continue;
                
        $requirement = "$lang[min_stat]:<br>";
        if ($shape[$key] > $db[$key])
          $title .= "<font color=\"#FF0000\">&bull; $lang[$key]: $shape[$key]</font><br>";
        else
          $title .= "&bull; $lang[$key]: $shape[$key]<br>";
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
    die ($return);
  break;
  case 'chooseshape':
    $shape = requestVar ('shape', 0);
    
    if (!$shape || !($equip -> checkShape ($shape)))
      die ("errorA_D215");
    
    $shape = ($sex == "male") ?"m/$shape.gif" :"f/$shape.gif";
    $adb -> query ("UPDATE `characters` SET `shape` = ?s, `next_shape` = ?d WHERE `guid` = ?d", $shape ,time () + 86400 ,$guid);
    die ("complete");
  break;
  case 'inventoryloginbank':
    $credit = requestVar ('credit', 0);
    $pass = requestVar ('pass');
    $bank_info = $adb -> selectRow ("SELECT `guid`, 
                                            `password`, 
                                            `cash`, 
                                            `euro` 
                                     FROM `character_bank` 
                                     WHERE `id` = ?d", $credit) or die ("errorA_D303");
    if ($guid != $bank_info['guid'])
      die ("errorA_D322");
    
    if (SHA1 ($credit.':'.$pass) != $bank_info['password'])
      die ("errorA_D302");
    
    $_SESSION['bankСredit'] = $credit;
    die ("completeA_D<b>".getMoney ($bank_info['cash'])."</b>кр. <b>".getMoney ($bank_info['euro'])."</b>екр.<a href='javascript:inventoryUnLoginBank ();'><img border='0' valign='bottom' width='13' height='9' title='Закончить работу со счётом' src='img/icon/close_bank.gif'></a>");
  break;
  case 'inventoryunloginbank':
    unset ($_SESSION['bankСredit']);
    $bank = $adb -> selectCol ("SELECT `id` FROM `character_bank` WHERE `guid` = ?d", $guid);
    if (!$bank)
      die ("-");
    
    foreach ($bank as $num => $bank_id)
    {
      if (empty($credits))
        $credits = $bank_id;
      else
        $credits .= ",".$bank_id;
    }
    die ("<a href=\"javascript:bank_open ('$credits');\" class='nick' style='font-size: 7pt;'>выбрать счёт</a>");
  break;
  case 'worksets':
    $type = requestVar ('type');
    $name = requestVar ('name');
    switch ($type)
    {
      case 'create':
        if ($name == '')
          die("errorA_D222");
        
        $cur_set = $adb -> selectRow ("SELECT * FROM `character_equip` WHERE `guid` = ?d", $guid);
        $cur_set['name'] = $name;
        unset($cur_set['hand_r_free'], $cur_set['hand_r_type'], $cur_set['hand_l_free'], $cur_set['hand_l_type']);
        $adb -> query ("DELETE FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name);
        $adb -> query ("INSERT INTO `character_sets` (?#) 
                        VALUES (?a);", array_keys($cur_set), array_values($cur_set)) or die ("errorA_D222");
        die ("completeA_D<div name='$name' style='display: none;'><img width='200' height='1' src='img/1x1.gif'><br>&nbsp;&nbsp;<img src='img/icon/close2.gif' width='9' height='9' alt='Удалить комплект' onclick=\"if (confirm('Удалить комплект $name?')) {workSets ('delete', '$name');}\" style='cursor: pointer;'> <a href='main.php?action=wear_set&set_name=$name' class='nick'><small>Надеть \"$name\"</small></a></div>");
      break;
      case 'delete':
        if ($name == '')
          die ("errorA_D221");
        
        $set = $adb -> selectRow ("SELECT * FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name) or die ("errorA_D221");
        $adb -> query ("DELETE FROM `character_sets` WHERE `guid` = ?d and `name` = ?s", $guid ,$name);
        die ("complete");
      break;
    }
  break;
  case 'buyitem':
    $item_entry = requestVar ('entry', 0);
    $count = requestVar ('count', 1);
    
    if ($item_entry == 0 || !is_numeric($item_entry))
      die ("errorA_D403");
    
    $buycount = 0;
    $amount = $city.'-'.$room;
    $room_shop = $adb -> selectCell ("SELECT `shop` FROM `city_rooms` WHERE `city` = ?s and `room` = ?s", $city ,$room);
    if (!$room_shop)
      die ("errorA_D403");
      
    $dat = $adb -> selectRow ("SELECT `i`.`name`, 
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
                                 and `a`.?# > '0';", $item_entry ,$amount) or die ("errorA_D403");
    list ($name, $i_mass, $price, $price_euro, $tear, $inc_count, $validity) = array_values ($dat);
    
    for ($i = 1; $i <= $count; $i++)
    {
      $time = ($validity > 0) ?time () + $validity * 3600 :0;
      $equip -> getBuyValue ($price);
      $equip -> getBuyValue ($price_euro);
      
      if (($price > 0 && !($equip -> Money ($price))) || ($price_euro > 0 && !($equip -> Money ($price_euro, 'euro'))))
        continue;
      
      $money = $money - $price;
      $money_euro = $money_euro - $price_euro;
      $mass = $mass + $i_mass;
      $adb -> query ("UPDATE `characters` SET `mass` = ?f WHERE `guid` = ?d", $mass ,$guid);
      //$adb -> query ("UPDATE `character_stats` SET `trade` = `trade` + '0.01' WHERE `guid` = ?d", $guid);
      $adb -> query ("INSERT INTO `character_inventory` (`guid`, `item_template`, `tear_max`, `inc_count_p`, `made_in`, `date`, `last_update`) 
                      VALUES (?d, ?d, ?f, ?d, ?s, ?d, ?d)", $guid ,$item_entry ,$tear ,$inc_count ,$city ,$time ,time ());
      $adb -> query ("UPDATE `item_amount` SET ?# = ?# - '1' WHERE `entry` = ?d", $amount ,$amount ,$item_entry);
      if ($price > 0)
        $history -> transfers ('Buy', "$name ($price кр)", $_SERVER['REMOTE_ADDR'], $room);
      else if ($price_euro > 0)
        $history -> transfers ('Buy', "$name ($price_euro екр)", $_SERVER['REMOTE_ADDR'], $room);
      $buycount++;
    }
    if ($buycount != 0 && $price > 0)
      die ("completeA_D".$money."A_D".$mass."A_D400A_D$name|".($price*$buycount)."|$buycount");
    else if ($buycount != 0 && $price_euro > 0)
      die ("completeA_D".$money_euro."A_D".$mass."A_D401A_D$name|".($price_euro*$buycount)."|$buycount");
    else
      die ("errorA_D107");
  break;
  case 'sellitem':
    $item_id = requestVar ('id', 0);
    
    if ($item_id == 0 || !is_numeric($item_id))
      die ("errorA_D213");
    
    $dat = $adb -> selectRow ("SELECT `i`.`name`, 
                                      `i`.`mass`, 
                                      `i`.`price`, 
                                      `i`.`price_euro` 
                               FROM `character_inventory` AS `c` 
                               LEFT JOIN `item_template` AS `i` 
                               ON `c`.`item_template` = `i`.`entry` 
                               WHERE (`i`.`item_flags` & '1') 
                                  and `c`.`id` = ?d 
                                  and `c`.`guid` = ?d 
                                  and `c`.`wear` = '0' 
                                  and `c`.`mailed` = '0';", $item_id ,$guid) or die ("errorA_D213");
    list ($name, $i_mass, $price, $price_euro) = array_values ($dat);
    if ($price > 0)
    {
      $price = $equip -> getSellValue ($item_id);
      $equip -> Money (-$price);
      $money = $money + $price;
      $mass = $mass - $i_mass;
      $adb -> query ("UPDATE `characters` SET `mass` = ?f WHERE `guid` = ?d", $mass ,$guid);
      $adb -> query ("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
      $history -> transfers ('Sell', "$name ($price кр)", $_SERVER['REMOTE_ADDR'], 'Shop');
      die ("completeA_D".$money."A_D".$mass."A_D404A_D$name|$price");
    }
    else if ($price_euro > 0)
    {
      $price_euro = $equip -> getSellValue ($item_id, 'euro');
      $equip -> Money (-$price_euro, 'euro');
      $money_euro = $money_euro + $price_euro;
      $mass = $mass - $i_mass;
      $adb -> query ("UPDATE `characters` SET `mass` = ?f WHERE `guid` = ?d", $mass ,$guid);
      $adb -> query ("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
      $history -> transfers ('Sell', "$name ($price екр)", $_SERVER['REMOTE_ADDR'], 'Shop');
      die ("completeA_D".$money_euro."A_D".$mass."A_D405A_D$name|$price");
    }
  break;
  case 'deleteitem':
    $item_id = requestVar ('id', 0);
    $dropall = requestVar ('dropall', 0);
    
    if ($item_id == 0 || !is_numeric($item_id))
      die ("errorA_D213");
    
    switch ($dropall)
    {
      default:
      case 0:
        $dat = $adb -> selectRow ("SELECT `i`.`name`, 
                                          `i`.`mass` 
                                   FROM `character_inventory` AS `c` 
                                   LEFT JOIN `item_template` AS `i` 
                                   ON `c`.`item_template` = `i`.`entry` 
                                   WHERE `c`.`guid` = ?d 
                                     and `c`.`id` = ?d 
                                     and `c`.`wear` = '0' 
                                     and `c`.`mailed` = '0';", $guid ,$item_id) or die ("errorA_D213");
        $mass = $mass - $dat['mass'];
        $adb -> query ("UPDATE `characters` SET `mass` = ?f WHERE `guid` = ?d", $mass ,$guid);
        $adb -> query ("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_id ,$guid);
        $history -> transfers ('Throw out', $dat['name'], $_SERVER['REMOTE_ADDR'], 'Dump');
        die ("completeA_D".$mass."A_D1");
      break;
      case 1:
        $item_entry = $adb -> selectCell ("SELECT `item_template` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d and `wear` = '0' and `mailed` = '0';", $guid ,$item_id) or die ("errorA_D213");
        $dat = $adb -> select ("SELECT `c`.`id`, 
                                       `i`.`name`, 
                                       `i`.`mass` 
                                FROM `character_inventory` AS `c` 
                                LEFT JOIN `item_template` AS `i` 
                                ON `c`.`item_template` = `i`.`entry` 
                                WHERE `c`.`guid` = ?d 
                                  and `c`.`item_template` = ?d 
                                  and `c`.`wear` = '0' 
                                  and `c`.`mailed` = '0';", $guid ,$item_entry) or die ("errorA_D213");
        $i = 0;
        foreach ($dat as $item_info)
        {
          $mass = $mass - $item_info['mass'];
          $adb -> query ("UPDATE `characters` SET `mass` = ?f WHERE `guid` = ?d", $mass ,$guid);
          $adb -> query ("DELETE FROM `character_inventory` WHERE `id` = ?d and `guid` = ?d", $item_info['id'] ,$guid);
          $history -> transfers ('Throw out', $item_info['name'], $_SERVER['REMOTE_ADDR'], 'Dump');
          $i++;
        }
        die ("completeA_D".$mass."A_D".$i."A_D".$item_entry);
      break;
    }
  break;
}
?>