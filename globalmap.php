<?
defined('AntiBK') or die ("Доступ запрещен!");
?>
<link rel="StyleSheet" href="styles/room.css" type="text/css">
<script src="scripts/fireworks.js" type="text/javascript"></script>
<script src="scripts/move_check.js" type="text/javascript"></script>
<?
if (in_array (date('m'), array (12, 1, 2)))
  echo '<script src="scripts/snow.js" type="text/javascript"></script>';
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);

$night = (date ('H') > 20 || date ('H') < 7) ?1 :0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" style="padding-left: 2px;">
<?
include("char_map.php");
?>
</td>
<td align="right" valign="top">
<img src="img/1x1.gif" width="1" height="5">
<font color="red" id="error"><?$char->error->getFormattedError($error, $parameters);?></font>
<table border="0" cellpadding="0" cellspacing="0">
  <tr align="right" valign="top"><td>
    <table cellpadding="0" cellspacing="0" border="0" width="1">
      <tr><td>
        <div align="right" class="map" id="ione">
<?
switch ($room)
{
    case 'centplosh':
?>
        <img src="img/room/dem_bg1_<?echo $night;?>.jpg" border="1"/>
        <img src="img/room/dem_lsh.png" class="dem_lsh" />
        <img id="passage" src="img/room/dem_dustman_crushed.png" class="dem_dustman_crushed" alt="<?echo $char->city->getRoomOnline('Мемориал');?>" onclick="solo('o16')" />
        <img id="passage" src="img/room/dem_shop.png" class="dem_shop" alt="<?echo $char->city->getRoomOnline('shop');?>" onclick="solo('shop')" />
        <img id="passage" src="img/room/dem_post.png" class="dem_post" alt="<?echo $char->city->getRoomOnline('mail');?>" onclick="solo('mail')" />
        <img id="passage" src="img/room/dem_club.png" class="dem_club" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo('castle')" />
        <img src="img/room/stellav.gif" class="dem_stellav" alt="<?echo $char->city->getRoomOnline('stella');?>" onclick="solo('stella')" style="cursor: pointer;" />
        <img id="passage" src="img/room/dem_repair.png" class="dem_repair" alt="<?echo $char->city->getRoomOnline('rep');?>" onclick="solo('rep')" />
        <img id="passage" src="img/room/dem_temple.png" class="dem_temple" alt="<?echo $char->city->getRoomOnline('brak');?>" onclick="solo('brak')" />
        <img id="passage" src="img/room/dem_optshop.png" class="dem_optshop" alt="<?echo $char->city->getRoomOnline('Оптовый магазин');?>" onclick="solo('o3')" />
        <img id="passage" src="img/room/dem_station.png" class="dem_station" alt="<?echo $char->city->getRoomOnline('cityhall');?>" onclick="solo('cityhall')" />
        <img id="passage" src="img/room/dem_dungeon.png" class="dem_dungeon" alt="<?echo $char->city->getRoomOnline('prision');?>" onclick="solo('prision')" />
        <img id="passage" src="img/room/dem_comshop.png" class="dem_comshop" alt="<?echo $char->city->getRoomOnline('comok');?>" onclick="solo('comok')" />
        <img id="passage" src="img/room/dem_right.png" class="dem_right1" alt="<?echo $char->city->getRoomOnline('fairstreet');?>" onclick="solo('fairstreet')" />
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
      <tr><td bgcolor="#D3D3D3">
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_club" class="passage" alt="<?echo $char->city->getRoomOnline('castle', 'mini');?>" onclick="solo('castle')">Бойцовский Клуб</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_shop" class="passage" alt="<?echo $char->city->getRoomOnline('shop', 'mini');?>" onclick="solo('shop')">Магазин</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_repair" class="passage" alt="<?echo $char->city->getRoomOnline('s', 'mini');?>">Ремонтная мастерская</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_station" class="passage" alt="<?echo $char->city->getRoomOnline('cityhall', 'mini');?>" onclick="solo('cityhall')">Академия</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_comshop" class="passage" alt="<?echo $char->city->getRoomOnline('c', 'mini');?>">Комиссионка</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_post" class="passage" alt="<?echo $char->city->getRoomOnline('mail', 'mini');?>" onclick="solo('mail')">Почтовое отделение</a></span>
<?
    break;
    case 'fairstreet':
?>
        <img src="img/room/dem_bg2_<?echo $night;?>.jpg" border="1"/>
        <img id="passage" src="img/room/dem_bank.png" class="dem_bank" alt="<?echo $char->city->getRoomOnline('bank');?>" onclick="solo('bank')" />
        <img id="passage" src="img/room/dem_dtower.png" class="dem_dtower" alt="Не работает. Находится на реконструкции." onclick="alert('Не работает. Находится на реконструкции.')" />
        <img id="passage" src="img/room/dem_flshop.png" class="dem_flshop" alt="<?echo $char->city->getRoomOnline('Цветочный магазин');?>" onclick="solo('o1')" />
        <img src="img/room/dem_fire.gif" class="dem_fire" />
        <img id="passage" src="img/room/dem_skam1.png" class="dem_skam1" alt="<?echo $char->city->getRoomOnline('Маленький камень');?>" onclick="solo('o4')" />
        <img id="passage" src="img/room/dem_skam2.png" class="dem_skam2" alt="<?echo $char->city->getRoomOnline('Средний камень');?>" onclick="solo('o5')" />
        <img id="passage" src="img/room/dem_skam3.png" class="dem_skam3" alt="<?echo $char->city->getRoomOnline('Большой камень');?>" onclick="solo('o6')" />
        <img id="passage" src="img/room/dem_left.png" class="dem_left" alt="<?echo $char->city->getRoomOnline('centplosh');?>" onclick="solo('centplosh')" />
        <img id="passage" src="img/room/dem_hostel.png" class="dem_hostel" alt="<?echo $char->city->getRoomOnline('Общежитие');?>" onclick="solo('o10')" />
        <img id="passage" src="img/room/dem_soul_stone.png" class="dem_soul_stone" alt="Камень Души" onclick="solo('o11')">
        <img id="passage" src="img/room/dem_right.png" class="dem_right2" alt="<?echo $char->city->getRoomOnline('Аллея Тьмы');?>" onclick="solo('o12')" />
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
<?
    break;
}
?>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <hr>
      <small><b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br><i>Администрация.</i></small><br>Сейчас в клубе <?echo $online;?> чел.
    </td>
  </tr>
</table>
    </td>
  </tr>
</table>
<div class="buttons"><?$char->city->addButtons('loc');?></div>