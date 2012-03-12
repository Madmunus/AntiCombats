<?
defined('AntiBK') or die("Доступ запрещен!");
?>
<link rel="StyleSheet" href="styles/castle.css" type="text/css">
<script src="scripts/move_check.js" type="text/javascript"></script>
<?
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);
$desc = $char->city->getDescription($room, $city);
$room_trade = ($orden == 1 || $orden == 2 || $level > 3 || $admin_level >= 1) ?"solo('km_7');" :"alert('Вход разрешен только Тарманам');";
$prohod1 = "id='passage' alt='Проход через Бойцовский Клуб' onclick=\"alert('Проход через Бойцовский Клуб');\"";
$prohod2 = "id='passage' alt='Проход через Этаж 2' onclick=\"alert('Проход через Этаж 2');\"";
$prohod3 = "id='passage' alt='Вход через Торговый Зал' onclick=\"alert('Вход через Торговый Зал');\"";
$prohod4 = "id='passage' alt='Вход через Рыцарский Зал' onclick=\"alert('Вход через Рыцарский Зал');\"";

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
      echo "<img src='img/room/navig.jpg' border='1' />";
      echo "<img src='img/room/map_bk.png' class='map_bk' alt='Бойцовский Клуб' />";
      echo "<img id='passage' src='img/room/map_klub2.png' class='map_klub2' alt='".$char->city->getRoomOnline('castle2')."' onclick=\"solo('castle2');\" />";
      echo "<img id='passage' src='img/room/map_klub3.png' class='map_klub3' alt='".$char->city->getRoomOnline('hall_2')."' onclick=\"solo('hall_2');\" />";
      echo "<img id='passage' src='img/room/map_klub4.png' class='map_klub4' alt='".$char->city->getRoomOnline('hall_1')."' onclick=\"solo('hall_1');\" />";
      echo "<img id='passage' src='img/room/map_klub5.png' class='map_klub5' alt='".$char->city->getRoomOnline('hall_3')."' onclick=\"solo('hall_3');\" />";
      echo "<img id='passage' src='img/room/map_klub6.png' class='map_klub6' alt='".$char->city->getRoomOnline('boudoir')."' onclick=\"solo('boudoir');\" />";
      echo "<img id='passage' src='img/room/map_klub7.png' class='map_klub7' alt='".$char->city->getRoomOnline('centsquare')."' onclick=\"solo('centsquare');\" />";
      echo "<div class='fl1' style='left: 240px; top: 124px;'>";
  break;
  case 'passage':
      echo "<img src='img/room/navig2.jpg' border='1' />";
      echo "<img src='img/room/map_zal3.png' class='map_zal3' alt='Комната Перехода' />";
      echo "<img id='passage' src='img/room/map_zal2.png' class='map_zal2' alt='".$char->city->getRoomOnline('novice')."' onclick=\"solo('novice');\" />";
      echo "<img id='passage' src='img/room/map_zal1.png' class='map_zal1' alt='".$char->city->getRoomOnline('hall_2')."' onclick=\"solo('hall_2');\" />";
      echo "<div class='fl1' style='left: 115px; top: 72px;'>";
  break;
  case 'novice':
      echo "<img src='img/room/navig2.jpg' border='1' />";
      echo "<img src='img/room/map_zal2.png' class='map_zal2' alt='Комната для новичков' />";
      echo "<img id='passage' src='img/room/map_zal3.png' class='map_zal3' alt='".$char->city->getRoomOnline('passage')."' onclick=\"solo('passage');\" />";
      echo "<img id='passage' src='img/room/map_zal1.png' class='map_zal1' alt='Вход через Комнату Перехода' onclick=\"alert('Вход через Комнату Перехода');\" />";
      echo "<div class='fl1' style='left: 349px; top: 139px;'>";
  break;
  case 'hall_1':
      echo "<img src='img/room/navig.jpg' border='1' />";
      echo "<img src='img/room/map_klub4.png' class='map_klub4' alt='Зал воинов' />";
      echo "<img src='img/room/map_klub1.png' class='map_klub1' $prohod1 />";
      echo "<img src='img/room/map_klub2.png' class='map_klub2' $prohod1 />";
      echo "<img src='img/room/map_klub3.png' class='map_klub3' $prohod1 />";
      echo "<img src='img/room/map_klub5.png' class='map_klub5' $prohod1 />";
      echo "<img src='img/room/map_klub6.png' class='map_klub6' $prohod1 />";
      echo "<img src='img/room/map_klub7.png' class='map_klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/map_bk.png' class='map_bk' alt='".$char->city->getRoomOnline('castle')."' onclick=\"solo('castle');\" />";
      echo "<div class='fl1' style='left: 113px; top: 194px;'>";
  break;
  case 'hall_2':
      echo "<img src='img/room/navig.jpg' border='1' />";
      echo "<img src='img/room/map_klub3.png' class='map_klub3' alt='Зал воинов 2' />";
      echo "<img src='img/room/map_klub1.png' class='map_klub1' $prohod1 />";
      echo "<img src='img/room/map_klub2.png' class='map_klub2' $prohod1 />";
      echo "<img src='img/room/map_klub4.png' class='map_klub4' $prohod1 />";
      echo "<img src='img/room/map_klub5.png' class='map_klub5' $prohod1 />";
      echo "<img src='img/room/map_klub6.png' class='map_klub6' $prohod1 />";
      echo "<img src='img/room/map_klub7.png' class='map_klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/map_bk.png' class='map_bk' alt='".$char->city->getRoomOnline('castle')."' onclick=\"solo('castle');\" />";
      echo "<div class='fl1' style='left: 395px; top: 142px;'>";
  break;
  case 'hall_3':
      echo "<img src='img/room/navig.jpg' border='1' />";
      echo "<img src='img/room/map_klub5.png' class='map_klub5' alt='Зал воинов 3' />";
      echo "<img src='img/room/map_klub1.png' class='map_klub1' $prohod1 />";
      echo "<img src='img/room/map_klub2.png' class='map_klub2' $prohod1 />";
      echo "<img src='img/room/map_klub3.png' class='map_klub3' $prohod1 />";
      echo "<img src='img/room/map_klub4.png' class='map_klub4' $prohod1 />";
      echo "<img src='img/room/map_klub6.png' class='map_klub6' $prohod1 />";
      echo "<img src='img/room/map_klub7.png' class='map_klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/map_bk.png' class='map_bk' alt='".$char->city->getRoomOnline('castle')."' onclick=\"solo('castle');\" />";
      echo "<div class='fl1' style='left: 364px; top: 76px;'>";
  break;
  case 'boudoir':
      echo "<img src='img/room/navig.jpg' border='1' />";
      echo "<img src='img/room/map_klub6.png' class='map_klub6' alt='Будуар' />";
      echo "<img src='img/room/map_klub1.png' class='map_klub1' $prohod1 />";
      echo "<img src='img/room/map_klub2.png' class='map_klub2' $prohod1 />";
      echo "<img src='img/room/map_klub3.png' class='map_klub3' $prohod1 />";
      echo "<img src='img/room/map_klub4.png' class='map_klub4' $prohod1 />";
      echo "<img src='img/room/map_klub5.png' class='map_klub5' $prohod1 />";
      echo "<img src='img/room/map_klub7.png' class='map_klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/map_bk.png' class='map_bk' alt='".$char->city->getRoomOnline('castle')."' onclick=\"solo('castle');\" />";
      echo "<div class='fl1' style='left: 113px; top: 73px;'>";
  break;
  case 'castle2':
      echo "<img src='img/room/navig3.jpg' border='1' />";
      echo "<img src='img/room/map_2stair.png' class='map_2stair' alt='Этаж 2' />";
      echo "<img id='passage' src='img/room/map_sec1.png' class='map_sec1' alt='".$char->city->getRoomOnline('castle')."' onclick=\"solo('castle');\" />";
      echo "<img id='passage' src='img/room/map_sec2.png' class='map_sec2' alt='3 Этаж' />";
      echo "<img src='img/room/map_sec3.png' class='map_sec3' $prohod3 />";
      echo "<img src='img/room/map_sec4.png' class='map_sec4' $prohod4 />";
      echo "<img id='passage' src='img/room/map_sec5.png' class='map_sec5' alt='".$char->city->getRoomOnline('km_7')."' onclick='$room_trade' />";
      echo "<img id='passage' src='img/room/map_sec6.png' class='map_sec6' alt='".$char->city->getRoomOnline('km_6')."' onclick=\"solo('km_6');\" />";
      echo "<img src='img/room/map_sec7.png' class='map_sec7' $prohod4 />";
      echo "<div class='fl1' style='left: 182px; top: 122px;'>";
  break;
  case 'km_6':
      echo "<img src='img/room/navig3.jpg' border='1' />";
      echo "<img src='img/room/map_sec6.png' class='map_sec6' alt='Рыцарский Зал' />";
      echo "<img id='passage' src='img/room/map_2stair.png' class='map_2stair' alt='".$char->city->getRoomOnline('castle2')."' onclick=\"solo('castle2');\" />";
      echo "<img id='passage' src='img/room/map_sec4.png' class='map_sec4' alt='".$char->city->getRoomOnline('Таверна')."' onclick=\"solo('o0');\" />";
      echo "<img src='img/room/map_sec5.png' class='map_sec5' $prohod2 />";
      echo "<img src='img/room/map_sec2.png' class='map_sec2' $prohod2 />";
      echo "<img src='img/room/map_sec1.png' class='map_sec1' $prohod2 />";
      echo "<img id='passage' src='img/room/map_sec7.png' class='map_sec7' alt='".$char->city->getRoomOnline('Башня Рыцарей и Магов')."' onclick=\"solo('o0');\" />";
      echo "<img src='img/room/map_sec3.png' class='map_sec3' $prohod3 />";
      echo "<div class='fl1' style='left: 279px; top: 65px;'>";
  break;
  case 'km_7':
      echo "<img src='img/room/navig3.jpg' border='1' />";
      echo "<img src='img/room/map_sec5.png' class='map_sec5' alt='Торговый Зал' />";
      echo "<img id='passage' src='img/room/map_2stair.png' class='map_2stair' alt='".$char->city->getRoomOnline('castle2')."' onclick=\"solo('castle2');\" />";
      echo "<img src='img/room/map_sec1.png' class='map_sec1' $prohod2 />";
      echo "<img src='img/room/map_sec2.png' class='map_sec2' $prohod2 />";
      echo "<img id='passage' src='img/room/map_sec3.png' class='map_sec3' alt='".$char->city->getRoomOnline('km_5')."' onclick=\"solo('km_5');\" />";
      echo "<img src='img/room/map_sec4.png' class='map_sec4' $prohod4 />";
      echo "<img src='img/room/map_sec6.png' class='map_sec6' $prohod2 />";
      echo "<img src='img/room/map_sec7.png' class='map_sec7' $prohod4 />";
      echo "<div class='fl1' style='left: 256px; top: 179px;'>";
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