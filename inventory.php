<?
defined('AntiBK') or die ("Доступ запрещен!");
?>
<script src="scripts/inventory.js" type="text/javascript"></script>
<?
switch ($action)
{
  case 'wear_item':   $char->equip->equipItem($item_id);       break;
  case 'wear_set':    $char->equip->equipSet($set_name);       break;
  case 'unwear_item': $char->equip->equipItem($item_slot, -1); break;
  case 'unwear_full': $char->equip->unWearAllItems();          break;
}

$bars = $char->getChar('char_bars', 'stat', 'mod', 'power', 'def', 'btn', 'set');
foreach ($bars as $key => $value)
{
  if ($value == 0)
    unset($bars[$key]);
}
asort($bars);

$countitems = $adb->selectCell("SELECT COUNT(*) FROM `character_inventory` WHERE `guid` = ?d and `wear` = '0' and `mailed` = '0';", $guid) | 0;

$money = getMoney($money);
$chat_shut = $char_db['chat_shut'];

$bank = $adb->selectCol("SELECT `id` FROM `character_bank` WHERE `guid` = ?d", $guid);
foreach ($bank as $num => $bank_id)
{
  if (empty($credits))
    $credits = $bank_id;
  else
    $credits .= ",".$bank_id;
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="210" align="center" valign="top">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr><td width="210" align="center"><?$char->equip->showCharacter('inv');?><br></td></tr>    
<?
if ($chat_shut)
  echo "<tr><td valign='top'><p style='margin-left: 10px;'><small><img src='img/icon/sleep.gif' width='40' height='25'>$lang[shut_desc] ".getFormatedTime($chat_shut)."<br></small></p></td></tr>";
?>
      </table>
    </td>
    <td align="center" valign="top" bgcolor="#dedede">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="top" bgcolor="#dedede">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5" align="left" valign="top"></td>
                <td width="225" align="left" valign="top" style="padding-right: 5px; padding-top: 17px;"><small>
<?
echo "$lang[exp] <b>".getExp($exp)."</b> (".getExp($next_up).")<br>"
   . "$lang[games] &nbsp; <b>$win <img src='img/icon/wins.gif' border='0' title='$lang[wins] $win'> &nbsp; $lose <img src='img/icon/looses.gif' border='0' title='$lang[loses] $lose'> &nbsp; $draw <img src='img/icon/draw.gif' border='0' title='$lang[draws] $draw'></b><br>"
   . "$lang[money] <b>$money</b> кр.<br>";
if ($bank)
{
  echo "<br>$lang[bank] <span id='loginbank'>";
  if (empty($_SESSION['bankСredit']))
    echo "<a href=\"javascript:bank_open ('$credits');\" class='nick' style='font-size: 7pt;'>$lang[credit_choose]</a>";
  else if (!empty($_SESSION['bankСredit']))
  {
    $bank_info = $adb->selectRow("SELECT `cash`, `euro` FROM `character_bank` WHERE `id` = ?d", $_SESSION['bankСredit']);
    echo "<b>".getMoney($bank_info['cash'])."</b>кр. <b>".getMoney($bank_info['euro'])."</b>екр.<a href='javascript:UnLoginbank();'><img border='0' valign='bottom' width='13' height='9' title='$lang[credit_exit]' src='img/icon/close_bank.gif'></a>";
  }
  echo "</span>";
}
else if ($level > 0)
  echo "<br>Банк: <a href='javascript:bank_info();' class='nick' style='font-size: 7pt;'>информация</a>";
echo "</small>";
foreach ($bars as $bar => $value)
  echo "<div id='bar_$bar'>".$char->showInventoryBar($bar, $value, count($bars))."</div>";
echo "<small>";
echo ($clan) ?"$lang[clan] <strong><a href='clan_inf.php?clan=$name_s' class='us2' target='_blank' style='font-size: 10px;'>$clan</a> ($chin)</strong><br>" :"";
?>
                </small></td>
                <td align="center" valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="25" align="right" valign="middle">
                        <font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
                        <input type="button" class="nav" value="<?echo $lang['shape'];?>" title="<?echo $lang['shape_choose'];?>" id="link" link="shape">
                        <input type="button" class="nav" value="<?echo $lang['abilities'];?>" id="link" link="skills">
                        <input type="button" class="nav" value="<?echo $lang['form'];?>" title="<?echo $lang['form'];?>" id="link" link="info">
                        <input type="button" class="nav" value="<?echo $lang['security'];?>" title="<?echo $lang['change_pass_mail'];?>" style="font-weight: bold;" id="link" link="security">
                        <input type="button" class="help" value="<?echo $lang['hint'];?>" id="hint" link="invent">
                        <input type="button" class="nav" value="<?echo $lang['return'];?>" id="link" link="none">
                      </td>
                    </tr>
                  </table>
                  <table border="0" width="100%" bgColor="#d4d2d2" cellpadding="3" cellspacing="0">
                    <tr>
                      <td width="25%" align="center" id="section_1" bgcolor="#<?echo ($section == 1) ?"a5a5a5" :"d4d2d2";?>"><a href="javascript:showInventory(1, 'inv');" class="nick"><b><?echo $lang['sec_item'];?></b></a></td>
                      <td width="25%" align="center" id="section_2" bgcolor="#<?echo ($section == 2) ?"a5a5a5" :"d4d2d2";?>"><a href="javascript:showInventory(2, 'inv');" class="nick"><b><?echo $lang['sec_thing'];?></b></a></td>
                      <td width="25%" align="center" id="section_3" bgcolor="#<?echo ($section == 3) ?"a5a5a5" :"d4d2d2";?>"><a href="javascript:showInventory(3, 'inv');" class="nick"><b><?echo $lang['sec_elix'];?></b></a></td>
                      <td width="25%" align="center" id="section_4" bgcolor="#<?echo ($section == 4) ?"a5a5a5" :"d4d2d2";?>"><a href="javascript:showInventory(4, 'inv');" class="nick"><b><?echo $lang['sec_other'];?></b></a></td>
                    </tr>
                  </table>
                  <div align="center" style="background: #a5a5a5;"><b><?echo $lang['back_pack'];?> (<?echo lowercase($lang['mass'])." <span id='mass'>$mass</span>/$maxmass";?>, <?echo $lang['count_items'];?> <span id="count_items"><?echo $countitems;?></span>)</div>
                  <div id="inventory">
<?
    $rows = $adb->select("SELECT * 
                          FROM `character_inventory` AS `c` 
                          LEFT JOIN `item_template` AS `i` 
                          ON `c`.`item_entry` = `i`.`entry` 
                          WHERE `i`.`section` = ?s 
                            and `c`.`guid` = ?d 
                            and `c`.`wear` = '0' 
                            and `c`.`mailed` = '0' 
                          ORDER BY `c`.`last_update` DESC", $data['sections'][$section] ,$guid);
    if (count($rows) > 0)
    {
      $i = 1;
      foreach ($rows as $item_info)
      {
        echo $char->equip->showItem($item_info, 'inv', $i);
        $i = !$i;
      }
    }
    else
      echo "<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#a5a5a5'><tr><td bgcolor='#e2e0e0' align='center'>$lang[empty]</td></tr></table>";
?>
                  </div>
                  <table border="0" width="100%" bgColor="#a5a5a5" cellpadding="3" cellspacing="0">
                  <td align="left">
                    <?echo $lang['sort_by'];?> 
                    <input type="button" class="nav" value="<?echo $lang['sort_name'];?>" id="sort_name" name="1" onclick="sortInventory('name');">
                    <input type="button" class="nav" value="<?echo $lang['sort_price'];?>" id="sort_price" name="1" onclick="sortInventory('price');">
                    <input type="button" class="nav" value="<?echo $lang['sort_type'];?>" id="sort_type" name="1" onclick="sortInventory('type');">
                  <td align="right"><input type="button" value="<?echo $lang['drop_trash'];?>"></td>
                  </table>
<?
/*
    case 'thing':
        $rows = $adb->select("    SELECT *
                                    FROM `character_inventory` AS `c` 
                                    LEFT JOIN `item_template` AS `i` 
                                    ON `c`.`item_entry` = `i`.`entry` 
                                    WHERE `i`.`section` = ?s 
                                            and `c`.`guid` = ?d", $section ,$guid);
        $i = 0;
        foreach ($rows as $dat)
        {
            switch ($dat['type'])
            {
                case 'wood':
                    $obj_id = $dat['object_id'];
                    $item_id = $dat['id'];
                    $obj_data = $adb->selectRow("SELECT * FROM `wood` WHERE `id` = ?d", $obj_id);
                    $name = $obj_data['name'];
                    $img = $obj_data['img'];
                    $mass = $obj_data['mass'];
                    $price = $obj_data['price'];
                    $chet = ($i % 2 === 0) ?"C7C7C7" :"D5D5D5";
                    echo "<table width='100%' border='0' cellspacing='2' cellpadding='0' bgColor='#a5a5a5'><tr bgColor='#$chet'><td width='100' align='center' valign='middle'>";
                    echo "<img src='img/$img' title='$name'><br>";
                    echo "<center><a href='main.php?act=del_item&item=$item_id'><img src='img/icon/clear.gif' width='14' height='14' border='0' title='Выбросить предмет $name'></a></center>";
                    echo "</td><td align='left' valign='top'><font color='#003388'><b>$name</b></font>&nbsp&nbsp&nbsp&nbsp(Масса: $mass)<br>";
                    echo "Цена: $price зл.<br>";
                    echo "Масса: $mass ед.<br>";
                    echo "</td></tr></table>";
                    $i++;
                break;
                case 'medal':
                    $obj_id = $dat['object_id'];
                    $item_id = $dat['id'];
                    $wear = $dat['wear'];
                    $gift_author = $dat['gift_author'];
                    $obj_data = $adb->selectRow("SELECT * FROM `medal` WHERE `id` = ?d", $obj_id);
                    $name = $obj_data['name'];
                    $img = $obj_data['img'];
                    $msg = $obj_data['msg'];
                    $add_l = $obj_data['add_l'];
                    $add_u = $obj_data['add_u'];
                    $disc = $obj_data['disc'];
                    $chet = ($i % 2 === 0) ?"C7C7C7" :"D5D5D5";
                    echo "<table width='100%' border='0' cellspacing='2' cellpadding='0' bgColor='#a5a5a5'><tr bgColor='#$chet'><td width='100' align='center' valign='middle'>";
                    echo "<img src='img/$img' title='$msg'><br><center>";
                    if ($wear == 0)
                        echo "<a href='main.php?act=wear_thing&item_id=$item_id' class='us2'>одеть</a>";
                    else if ($wear == 1)
                        echo "<a href='main.php?act=unwear_thing&item_id=$item_id' class='us2'>снять</a>";
                    echo "<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/clear.gif' width='14' height='14' border='0' title='Выбросить предмет $name'></a></center>";
                    echo "</td><td align='left' valign='top'><font color='#003388'><b>$name</b></font><br>";
                    if (!empty($add_l))
                        echo "Реакция: +$add_l<br>";
                    if (!empty($add_u))
                        echo "Удача: +$add_u<br>";
                    echo "$disc";
                    echo "</td></tr></table>";
                    $i++;
                break;
                case 'book':
                    $obj_id = $dat['object_id'];
                    $item_id = $dat['id'];
                    $pages_used = $dat['pages_used'];
                    $gift_author = $dat['gift_author'];
                    $book_name = $dat['book_name'];
                    $iznos = $dat['iznos'];
                    $iznos_all = $dat['tear_max'];
                    $obj_data = $adb->selectRow("SELECT * FROM `book` WHERE `id` = ?d", $obj_id);
                    $name = $obj_data['name'];
                    $img = $obj_data['img'];
                    $min_i = $obj_data['min_int'];
                    $min_v = $obj_data['min_wis'];
                    $min_level = $obj_data['min_level'];
                    $add_i = $obj_data['add_int'];
                    $add_mp = $obj_data['add_mp'];
                    $add_water = $obj_data['add_water'];
                    $add_earth = $obj_data['add_earth'];
                    $add_fire = $obj_data['add_fire'];
                    $add_air = $obj_data['add_fire'];
                    $pages = $obj_data['pages'];
                    if (empty($book_name))
                        $book_name = "Без названия.";
                    echo "<table width='100%' border='0' cellspacing='2' cellpadding='0' bgColor='#a5a5a5'><tr bgColor='#$chet'><td width='100' align='center' valign='middle'>";
                    echo "<img src='img/$img' title='$name\n$book_name'><br><center>";
                    if ($book_name == "Без названия.")
                        echo "<a href='main.php?act=giveName&book=$item_id' title='Написать заглавие для этой книги.' class='us2'>заглавие</a>";
                    echo "<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/clear.gif' width='14' height='14' border='0' title='Выбросить предмет $name'></a></center>";
                    echo "</td><td align='left' valign='top'><font color='#003388'><b>$name</b></font><br>";
                    echo "Заглавие: $book_name<br>";
                    echo "Использований: $iznos/$iznos_all<br>";
                    if (!empty($add_i))
                        echo "Разум: <font color='#00990'>+$add_i</font><br>";
                    if (!empty($add_mp))
                        echo "Уровень маны: <font color='#009900'>+$add_mp</font><br>";
                    if ($add_water > 0)
                        echo "Магия воды: <font color='#009900'>+$add_water</font><br>";
                    if ($add_earth > 0)
                        echo "Магия земли: <font color='#009900'>+$add_earth</font><br>";
                    if ($add_fire > 0)
                        echo "Магия огня: <font color='#009900'>+$add_fire</font><br>";
                    if ($add_air > 0)
                        echo "Магия воздуха: <font color='#009900'>+$add_air</font><br>";
                    echo "Страниц: <font color='#000099'>$pages_used/$pages</font><br>";
                    echo "</td></tr></table>";
                    $i++;
                break;
                case 'scroll':
                    $obj_id = $dat['object_id'];
                    $item_id = $dat['id'];
                    $gift_author = $dat['gift_author'];
                    $iznos = $dat['iznos'];
                    $iznos_all = $dat['tear_max'];
                    $obj_data = $adb->selectRow("SELECT * FROM `scroll` WHERE `id` = ?d", $obj_id);
                    $name = $obj_data['name'];
                    $img = $obj_data['img'];
                    $min_i = $obj_data['min_int'];
                    $min_v = $obj_data['min_wis'];
                    $min_level = $obj_data['min_level'];
                    // $desc = $obj_data['desc'];
                    // $type = $obj_data['type'];
                    $mp = $obj_data['mp'];
                    $mass = $obj_data['mass'];
                    $veroyat = $obj_data['veroyat'];
                    echo "<table width='100%' border='0' cellspacing='2' cellpadding='0' bgColor='#a5a5a5'><tr bgColor='#$chet'><td width='100' align='center' valign='middle'>";
                    echo "<img src='img/$img' border='0' title='$name ($iznos/$iznos_all)'><br><center>";
                    if ($level >= $min_level && $wisdom >= $min_v && $int >= $min_i && $mp >= $mp) // && $type != "battle"
                        echo "<center><a href=\"javascript: magickLogin('$name', '?act=magic&school=earth&scroll=$item_id', 'spell_vitup10', '1', '', '', '6');\" title='Прочитать это заклинание.' class='nick'>исп-ть</a><br>";
                    else
                        echo "<center><small>нельзя исп-ть</small><br>";
                    echo "<a href='main.php?act=del_item&item=$item_id'><img src='img/icon/clear.gif' width='14' height='14' border='0' title='Выбросить предмет $name'></a></center>";
                    echo "</td><td align='left' valign='top'><font color='#003388'><b>$name</b></font>&nbsp&nbsp&nbsp&nbsp(Масса: $mass)<br>";
                    echo "<br>Долговечность: $iznos/$iznos_all<br>";
                    if (!empty($veroyat))
                        echo "Вероятность срабатывания: $veroyat%<br>";
                    echo "<b>Требуется минимальное:</b><br>";
                    if ($min_level > $level)
                        echo "&bull; Уровень: <font color='#D50000'>$min_level</font><br>";
                    else if ($min_level <= $level)
                        echo "&bull; Уровень: $min_level<br>";
                    if (!empty($min_i) && $min_i > $int)
                        echo "&bull; Интеллект: <font color='#D50000'>$min_i</font><br>";
                    else if (!empty($min_i) && $min_i <= $int)
                        echo "&bull; Интеллект: $min_i<br>";
                    if (!empty($min_v) && $min_v > $wisdom)
                        echo "&bull; Мудрость: <font color='#D50000'>$min_v</font><br>";
                    else if (!empty($min_v) && $min_v <= $wisdom)
                        echo "&bull; Мудрость: $min_v<br>";
                    if (!empty($mp) && $mp <= $mp)
                        echo "&bull; Исп. маны: $mp<br>";
                    else if ($mp > $mp)
                        echo "&bull; Исп. маны: <font color='#D50000'>$mp</font><br>";
                    // if (!empty($desc))
                        // echo "<b>Параметры:</b><br>";
                    // echo "$desc";
                    echo "</td></tr></table>";
                    $i++;
                break;
            }
        }
    break;
} */
?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>