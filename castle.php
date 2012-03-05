<?
defined('AntiBK') or die("Доступ запрещен!");
?>
<link rel="StyleSheet" href="styles/room.css" type="text/css">
<script src="scripts/move_check.js" type="text/javascript"></script>
<?
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);
$desc = $char->city->getDescription($room, $city);
$room_buduar = ($sex == 'female' || $admin_level >= 1) ?"" :"alert('Вход разрешен только женщинам');";
$room_trade = ($orden == 1 || $orden == 2 || $level > 3 || $admin_level >= 1) ?"solo('km_7');" :"alert('Вход разрешен только Тарманам');";
$room_law = ($orden == 1 || $orden == 2 || $admin_level >= 1) ?"solo('km_8');" :"alert('Вход разрешен только c 4-ого уровня');";

$night = (date ('H') > 20 || date ('H') < 7) ?1 :0;
$flag = '<img src="img/room/fl1.png" alt="Вы находитесь здесь" />';
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
  <td valign="top"><?include("char_map.php");?></td>
  <td align="right" valign="top">
    <img src="img/1x1.gif" width="1" height="5">
    <font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
    <div align="right" class="map_klub">
<?
switch ($room)
{
  case 'castle':
?>
      <img src="img/room/navig.jpg" border="1"/>
      <img src="img/room/map_bk.png" class="map_bk" alt="Бойцовский Клуб" />
      <img id="passage" src="img/room/map_klub2.png" class="map_klub2" alt="<?echo $char->city->getRoomOnline('castle2');?>" onclick="solo('castle2');" />
      <img id="passage" src="img/room/map_klub3.png" class="map_klub3" alt="<?echo $char->city->getRoomOnline('km_2');?>" onclick="solo('km_2');" />
      <img id="passage" src="img/room/map_klub4.png" class="map_klub4" alt="<?echo $char->city->getRoomOnline('km_1');?>" onclick="solo('km_1');" />
      <img id="passage" src="img/room/map_klub5.png" class="map_klub5" alt="<?echo $char->city->getRoomOnline('km_3');?>" onclick="solo('km_3');" />
      <img id="passage" src="img/room/map_klub6.png" class="map_klub6" alt="<?echo $char->city->getRoomOnline('km_4');?>" onclick="solo('km_4');" />
      <img id="passage" src="img/room/map_klub7.png" class="map_klub7" alt="<?echo $char->city->getRoomOnline('centplosh');?>" onclick="solo('centplosh');" />
      <div class="fl1" style="left: 240px; top: 124px;">
<?
  break;
  case 'perehod':
?>
      <img src="img/room/navig2.jpg" border="1"/>
      <img src="img/room/map_zal3.png" class="map_zal3" alt="Комната Перехода" />
      <img id="passage" src="img/room/map_zal2.png" class="map_zal2" alt="<?echo $char->city->getRoomOnline('km_0');?>" onclick="solo('km_0');" />
      <img id="passage" src="img/room/map_zal1.png" class="map_zal1" alt="<?echo $char->city->getRoomOnline('km_2');?>" onclick="solo('km_2');" />
      <div class="fl1" style="left: 115px; top: 72px;">
<?
  break;
  case 'km_0':
?>
      <img src="img/room/navig2.jpg" border="1"/>
      <img src="img/room/map_zal2.png" class="map_zal2" alt="Комната для новичков" />
      <img id="passage" src="img/room/map_zal3.png" class="map_zal3" alt="<?echo $char->city->getRoomOnline('perehod');?>" onclick="solo('perehod');" />
      <img id="passage" src="img/room/map_zal1.png" class="map_zal1" title="Вход через Комнату Перехода" onclick="alert('Вход через Комнату Перехода');" />
      <div class="fl1" style="left: 349px; top: 139px;">
<?
  break;
  case 'km_1':
?>
      <img src="img/room/navig.jpg" border="1"/>
      <img src="img/room/map_klub4.png" class="map_klub4" title="Зал воинов" />
      <img id="passage" src="img/room/map_klub1.png" class="map_klub1" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub2.png" class="map_klub2" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub3.png" class="map_klub3" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub5.png" class="map_klub5" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub6.png" class="map_klub6" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub7.png" class="map_klub7" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_bk.png" class="map_bk" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo('castle');" />
      <div class="fl1" style="left: 113px; top: 194px;">
<?
  break;
  case 'km_2':
?>
      <img src="img/room/navig.jpg" border="1"/>
      <img src="img/room/map_klub3.png" class="map_klub3" title="Зал воинов 2" />
      <img id="passage" src="img/room/map_klub1.png" class="map_klub1" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub2.png" class="map_klub2" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub4.png" class="map_klub4" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub5.png" class="map_klub5" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub6.png" class="map_klub6" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub7.png" class="map_klub7" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_bk.png" class="map_bk" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo('castle');" />
      <div class="fl1" style="left: 395px; top: 142px;">
<?
  break;
  case 'km_3':
?>
      <img src="img/room/navig.jpg" border="1"/>
      <img src="img/room/map_klub5.png" class="map_klub5" title="Зал воинов 3" />
      <img id="passage" src="img/room/map_klub1.png" class="map_klub1" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub2.png" class="map_klub2" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub3.png" class="map_klub3" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub4.png" class="map_klub4" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub6.png" class="map_klub6" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub7.png" class="map_klub7" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_bk.png" class="map_bk" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo('castle');" />
      <div class="fl1" style="left: 364px; top: 76px;">
<?
  break;
  case 'km_4':
?>
      <img src="img/room/navig.jpg" border="1"/>
      <img src="img/room/map_klub6.png" class="map_klub6" title="Будуар" />
      <img id="passage" src="img/room/map_klub1.png" class="map_klub1" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub2.png" class="map_klub2" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub3.png" class="map_klub3" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub4.png" class="map_klub4" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub5.png" class="map_klub5" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_klub7.png" class="map_klub7" title="Проход через Бойцовский Клуб" onclick="alert('Проход через Бойцовский Клуб');" />
      <img id="passage" src="img/room/map_bk.png" class="map_bk" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo('castle');" />
      <div class="fl1" style="left: 113px; top: 73px;">
<?
  break;
  case 'castle2':
?>
      <img src="img/room/navig3.jpg" border="1"/>
      <img src="img/room/map_2stair.png" class="map_2stair" title="Этаж 2"/></div>
      <img id="passage" src="img/room/map_sec1.png" class="map_sec1" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo('castle');" />
      <img id="passage" src="img/room/map_sec2.png" class="map_sec2" title="3 Этаж" />
      <img id="passage" src="img/room/map_sec3.png" class="map_sec3" title="Вход через Торговый Зал" onclick="alert('Вход через Торговый Зал');" />
      <img id="passage" src="img/room/map_sec4.png" class="map_sec4" title="Вход через Рыцарский Зал" onclick="alert('Вход через Рыцарский Зал');" />
      <img id="passage" src="img/room/map_sec5.png" class="map_sec5" alt="<?echo $char->city->getRoomOnline('km_7');?>" onclick="<?echo $room_trade;?>" />
      <img id="passage" src="img/room/map_sec6.png" class="map_sec6" alt="<?echo $char->city->getRoomOnline('km_6');?>" onclick="solo('km_6');" />
      <img id="passage" src="img/room/map_sec7.png" class="map_sec7" title="Вход через Рыцарский Зал" onclick="alert('Вход через Рыцарский Зал');" />
      <div class="fl1" style="left: 182px; top: 122px;">
<?
  break;
  case 'km_6':
?>
      <img src="img/room/navig3.jpg" border="1"/>
      <img src="img/room/map_sec6.png" class="map_sec6" title="Рыцарский Зал" />
      <img id="passage" src="img/room/map_2stair.png" class="map_2stair" alt="<?echo $char->city->getRoomOnline('castle2');?>" onclick="solo('castle2');" />
      <img id="passage" src="img/room/map_sec4.png" class="map_sec4" alt="<?echo $char->city->getRoomOnline('Таверна');?>" id="passage" onclick="solo('o0');" />
      <img id="passage" src="img/room/map_sec5.png" class="map_sec5" title="Проход через Этаж 2" onclick="alert('Проход через Этаж 2');" />
      <img id="passage" src="img/room/map_sec2.png" class="map_sec2" title="Проход через Этаж 2" onclick="alert('Проход через Этаж 2');" />
      <img id="passage" src="img/room/map_sec1.png" class="map_sec1" title="Проход через Этаж 2" onclick="alert('Проход через Этаж 2');" />
      <img id="passage" src="img/room/map_sec7.png" class="map_sec7" alt="<?echo $char->city->getRoomOnline('Башня Рыцарей и Магов');?>" onclick="solo('o0');" />
      <img id="passage" src="img/room/map_sec3.png" class="map_sec3" title="Вход через Торговый Зал" onclick="alert('Вход через Торговый Зал');" />
      <div class="fl1" style="left: 279px; top: 65px;">
<?
  break;
  case 'km_7':
?>
      <img src="img/room/navig3.jpg" border="1"/>
      <img src="img/room/map_sec5.png" class="map_sec5" title="Торговый Зал" />
      <img id="passage" src="img/room/map_2stair.png" class="map_2stair" alt="<?echo $char->city->getRoomOnline('castle2');?>" onclick="solo('castle2');" />
      <img id="passage" src="img/room/map_sec1.png" class="map_sec1" title="Проход через Этаж 2" onclick="alert('Проход через Этаж 2');" />
      <img id="passage" src="img/room/map_sec2.png" class="map_sec2" title="Проход через Этаж 2" onclick="alert('Проход через Этаж 2');" />
      <img id="passage" src="img/room/map_sec3.png" class="map_sec3" alt="<?echo $char->city->getRoomOnline('km_5');?>" onclick="solo('km_5');" />
      <img id="passage" src="img/room/map_sec4.png" class="map_sec4" title="Вход через Рыцарский Зал" onclick="alert('Вход через Рыцарский Зал');" />
      <img id="passage" src="img/room/map_sec6.png" class="map_sec6" title="Проход через Этаж 2" onclick="alert('Проход через Этаж 2');" />
      <img id="passage" src="img/room/map_sec7.png" class="map_sec7" title="Вход через Рыцарский Зал" onclick="alert('Вход через Рыцарский Зал');" />
      <div class="fl1" style="left: 256px; top: 179px;">
<?
  break;
}
?>
      <?echo $flag;?></div>
      <div class="actionbar"><?getUpdateBar();?></div>
    </div>
    <div id="add_text"></div>
    <div class="map_discrp"><small><?echo $desc;?></small></div>
    <hr>
    <?$char->city->addButtons();?>
    <br>
    <small><b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br><i>Администрация.</i></small><br>Сейчас в клубе <?echo $online;?> чел.
  </td>
</tr></table>