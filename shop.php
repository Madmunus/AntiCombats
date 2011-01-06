<?
defined('AntiBK') or die ("Доступ запрещен!");

$room_info = $char->city->getRoom ($room, $city, 'shop', 'shop_section');
$section_shop = requestVar ('section_shop', '', 7);
$section_shop = (array_key_exists ($section_shop, $data['sections_shop'])) ?$section_shop :$room_info['shop_section'];
?>
<script src="scripts/shop.js" type="text/javascript"></script>
<script src="scripts/move_check.js" type="text/javascript"></script>
<table border='0' width='100%' cellpadding='0' cellspacing='0'>
<tr>
<td valign='top'>
<center><h3>Магазин</h3></center>
  <font color='red' id='error'><?$char->error->getFormattedError ($warning, $parameters);?></font>
  <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#A5A5A5' style='margin-left: 2.5px;'>
    <tr><td align='center'><b>Отдел "<span id="shop_title"><?echo $lang[$data['sections_shop'][$section_shop][1]].$lang['shop_'.$section_shop];?></span>"</b>
<?    if ($section_shop == 'sell') echo "<br>Здесь вы можете продать свои вещи, за жалкие гроши...<br>У вас в наличии:";?>
    </td></tr>
    <tr><td align='left'>
<?if ($section_shop != 'sell'){?>
      <form action="" method="post" style="display: inline;" onsubmit="shopSection (); return false;">
        <table cellspacing='4' cellpadding='0' width='100%'><tr>
          <td width='60'><b>Фильтр:</b>&nbsp;</td>
          <td width='60'>ур.:<input type="text" name="level_filter" size="4" value='<?echo $level_filter;?>'></td>
          <td width='180'>название:<input type="text" name="name_filter" value='<?echo $name_filter;?>'></td>
          <td width='60'><input type="submit" value="Применить"></td>
          <td align='right'><img id='loadbar' src='img/loadbar.gif' class='loadbar'></td>
        </tr></table>
      </form>
<?}?>
    </td></tr>
  </table>
  <div id="section" style='margin-left: 5px;'>
<?
$check_level = ($level_filter > 0 || $level_filter == '0');
if ($section_shop == 'sell')
{
  $rows = $adb->select ("SELECT * 
                         FROM `character_inventory` AS `c` 
                         LEFT JOIN `item_template` AS `i` 
                         ON `c`.`item_template` = `i`.`entry` 
                         WHERE (`i`.`item_flags` & '1') 
                            and `c`.`wear` = '0' 
                            and `c`.`mailed` = '0' 
                            and `c`.`guid` = ?d 
                         ORDER BY `c`.`last_update` DESC", $guid);
  $i = true;
  foreach ($rows as $item_info)
  {
    echo $char->equip->showItemInventory ($item_info, 'sell', $i);
    $i = !$i;
  }
  if (!count($rows))
    echo "<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#E2E0E0' align='center'>У вас нет подходящих вещей в рюкзаке</td></tr></table>";
}
else
  echo "<script>$(document).ready(function (){shopSection ('$section_shop');});</script>";
?>
  </div>
</td>
<td width='260' valign='top'>
  <div align='right'><?getUpdateBar ();?></div>
  <table width="148" align='right' border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
    <tr>
      <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
      <td bgcolor="#D3D3D3" nowrap><a href="?action=go&room_go=centplosh" class="passage" alt="<?echo $char->city->getRoomOnline ('centplosh', 'mini');?>">Центральная Площадь</a></td>
    </tr>
  </table><br><br>
  <div align='right'><small>
  Масса: <b><?echo "<span id='mass'>$mass</span>/$maxmass";?></b><br>
  У вас в наличии: <b><font color='#339900' id='money'><?echo getMoney ($money);?></font></b> кр.
<?
  if ($money_euro > 0) echo "<br> <b><font color='#339900' id='money_euro'>".getMoney ($money_euro)."</font></b> екр.";
?>
  </small></div>
<div style="margin-left: 25px; margin-top: 10px;">
<?
if ($section_shop == 'sell')
{
  $link = (empty($_COOKIE['section_shop'])) ?$room_info['shop_section'] :$_COOKIE['section_shop'];
  echo "<input type='button' value='Купить вещи' id='link' link='none&section_shop=$link' class='nav'>";
}
else
  echo "<input type='button' value='Продать вещи' id='link' link='none&section_shop=sell' class='nav'>";
?>
<div style="background-color: #A5A5A5; padding: 1px; font-weight: bold; text-align: center;">Отделы магазина</div>
<?
foreach ($data['sections_shop'] as $key => $value)
{
  if ($section_shop == 'sell')
  {
    echo "<div style='background-color: #C7C7C7'><a class='nick' href='?section_shop=$key'>".$lang[$value[2]]."</a></div><br>";
    break;
  }
  $show_in = explode (',', $value[0]);
  foreach ($show_in as $key2 => $value2)
  {
    if ($value2 != 'shop')
      continue;
    
    echo "<div id='section_shop_$key'><a class='nick' href=\"javascript:shopSection ('$key');\">".$lang[$value[2]].$lang['shop_'.$key]."</a><br></div>";
  }
}
?>
</div>
</td>
</tr>
</table>