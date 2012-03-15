<?
defined('AntiBK') or die("Доступ запрещен!");
?>
<link rel="StyleSheet" href="styles/club.css" type="text/css">
<script src="scripts/move_check.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){	
	$('img#passage').hover(
		function ()
		{
			var image = $(this).attr('class');
			image = image.replace('right1', 'right');
			image = image.replace('right2', 'right');
			$(this).attr('src', "img/room/club/glow/"+image+".png");
		},
		function ()
		{
			var image = $(this).attr('class');
			image = image.replace('right1', 'right');
			image = image.replace('right2', 'right');
			$(this).attr('src', "img/room/club/"+image+".png");
		}
	);
});
</script>
<?
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);
$desc = $char->city->getDescription($room, $city);
$room_trade = ($orden == 1 || $orden == 2 || $level > 3 || $admin_level >= 1) ?"solo('km_7');" :"alert('Вход разрешен только Тарманам');";
$prohod1 = "id='passage' alt='Проход через Бойцовский Клуб' onclick=\"alert('Проход через Бойцовский Клуб');\"";
$prohod2 = "id='passage' alt='Проход через Этаж 2' onclick=\"alert('Проход через Этаж 2');\"";
$prohod3 = "id='passage' alt='Вход через Торговый Зал' onclick=\"alert('Вход через Торговый Зал');\"";
$prohod4 = "id='passage' alt='Вход через Рыцарский Зал' onclick=\"alert('Вход через Рыцарский Зал');\"";

$night = (date ('H') > 20 || date ('H') < 7) ?1 :0;
$flag = '<img src="img/room/club/fl1.png" alt="Вы находитесь здесь" />';
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
  <td valign="top"><?include("char_map.php");?></td>
  <td align="right" valign="top">
    <img src="img/1x1.gif" width="1" height="5">
    <font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
    <div align="right" class="klub">
<?
switch ($room)
{
  case 'club':
      echo "<img src='img/room/club/navig.jpg' border='1' />";
      echo "<img src='img/room/club/bk.png' class='bk' alt='Бойцовский Клуб' />";
      echo "<img id='passage' src='img/room/club/klub2.png' class='klub2' alt='".$char->city->getRoomOnline('club2')."' onclick=\"solo('club2');\" />";
      echo "<img id='passage' src='img/room/club/klub3.png' class='klub3' alt='".$char->city->getRoomOnline('hall_2')."' onclick=\"solo('hall_2');\" />";
      echo "<img id='passage' src='img/room/club/klub4.png' class='klub4' alt='".$char->city->getRoomOnline('hall_1')."' onclick=\"solo('hall_1');\" />";
      echo "<img id='passage' src='img/room/club/klub5.png' class='klub5' alt='".$char->city->getRoomOnline('hall_3')."' onclick=\"solo('hall_3');\" />";
      echo "<img id='passage' src='img/room/club/klub6.png' class='klub6' alt='".$char->city->getRoomOnline('boudoir')."' onclick=\"solo('boudoir');\" />";
      echo "<img id='passage' src='img/room/club/klub7.png' class='klub7' alt='".$char->city->getRoomOnline('centsquare')."' onclick=\"solo('centsquare');\" />";
      echo "<div class='fl1' style='left: 240px; top: 124px;'>";
  break;
  case 'passage':
      echo "<img src='img/room/club/navig2.jpg' border='1' />";
      echo "<img src='img/room/club/zal3.png' class='zal3' alt='Комната Перехода' />";
      echo "<img id='passage' src='img/room/club/zal2.png' class='zal2' alt='".$char->city->getRoomOnline('novice')."' onclick=\"solo('novice');\" />";
      echo "<img id='passage' src='img/room/club/zal1.png' class='zal1' alt='".$char->city->getRoomOnline('hall_2')."' onclick=\"solo('hall_2');\" />";
      echo "<div class='fl1' style='left: 115px; top: 72px;'>";
  break;
  case 'novice':
      echo "<img src='img/room/club/navig2.jpg' border='1' />";
      echo "<img src='img/room/club/zal2.png' class='zal2' alt='Комната для новичков' />";
      echo "<img id='passage' src='img/room/club/zal3.png' class='zal3' alt='".$char->city->getRoomOnline('passage')."' onclick=\"solo('passage');\" />";
      echo "<img id='passage' src='img/room/club/zal1.png' class='zal1' alt='Вход через Комнату Перехода' onclick=\"alert('Вход через Комнату Перехода');\" />";
      echo "<div class='fl1' style='left: 349px; top: 139px;'>";
  break;
  case 'hall_1':
      echo "<img src='img/room/club/navig.jpg' border='1' />";
      echo "<img src='img/room/club/klub4.png' class='klub4' alt='Зал воинов' />";
      echo "<img src='img/room/club/klub1.png' class='klub1' $prohod1 />";
      echo "<img src='img/room/club/klub2.png' class='klub2' $prohod1 />";
      echo "<img src='img/room/club/klub3.png' class='klub3' $prohod1 />";
      echo "<img src='img/room/club/klub5.png' class='klub5' $prohod1 />";
      echo "<img src='img/room/club/klub6.png' class='klub6' $prohod1 />";
      echo "<img src='img/room/club/klub7.png' class='klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/club/bk.png' class='bk' alt='".$char->city->getRoomOnline('club')."' onclick=\"solo('club');\" />";
      echo "<div class='fl1' style='left: 113px; top: 194px;'>";
  break;
  case 'hall_2':
      echo "<img src='img/room/club/navig.jpg' border='1' />";
      echo "<img src='img/room/club/klub3.png' class='klub3' alt='Зал воинов 2' />";
      echo "<img src='img/room/club/klub1.png' class='klub1' $prohod1 />";
      echo "<img src='img/room/club/klub2.png' class='klub2' $prohod1 />";
      echo "<img src='img/room/club/klub4.png' class='klub4' $prohod1 />";
      echo "<img src='img/room/club/klub5.png' class='klub5' $prohod1 />";
      echo "<img src='img/room/club/klub6.png' class='klub6' $prohod1 />";
      echo "<img src='img/room/club/klub7.png' class='klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/club/bk.png' class='bk' alt='".$char->city->getRoomOnline('club')."' onclick=\"solo('club');\" />";
      echo "<div class='fl1' style='left: 395px; top: 142px;'>";
  break;
  case 'hall_3':
      echo "<img src='img/room/club/navig.jpg' border='1' />";
      echo "<img src='img/room/club/klub5.png' class='klub5' alt='Зал воинов 3' />";
      echo "<img src='img/room/club/klub1.png' class='klub1' $prohod1 />";
      echo "<img src='img/room/club/klub2.png' class='klub2' $prohod1 />";
      echo "<img src='img/room/club/klub3.png' class='klub3' $prohod1 />";
      echo "<img src='img/room/club/klub4.png' class='klub4' $prohod1 />";
      echo "<img src='img/room/club/klub6.png' class='klub6' $prohod1 />";
      echo "<img src='img/room/club/klub7.png' class='klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/club/bk.png' class='bk' alt='".$char->city->getRoomOnline('club')."' onclick=\"solo('club');\" />";
      echo "<div class='fl1' style='left: 364px; top: 76px;'>";
  break;
  case 'boudoir':
      echo "<img src='img/room/club/navig.jpg' border='1' />";
      echo "<img src='img/room/club/klub6.png' class='klub6' alt='Будуар' />";
      echo "<img src='img/room/club/klub1.png' class='klub1' $prohod1 />";
      echo "<img src='img/room/club/klub2.png' class='klub2' $prohod1 />";
      echo "<img src='img/room/club/klub3.png' class='klub3' $prohod1 />";
      echo "<img src='img/room/club/klub4.png' class='klub4' $prohod1 />";
      echo "<img src='img/room/club/klub5.png' class='klub5' $prohod1 />";
      echo "<img src='img/room/club/klub7.png' class='klub7' $prohod1 />";
      echo "<img id='passage' src='img/room/club/bk.png' class='bk' alt='".$char->city->getRoomOnline('club')."' onclick=\"solo('club');\" />";
      echo "<div class='fl1' style='left: 113px; top: 73px;'>";
  break;
  case 'club2':
      echo "<img src='img/room/club/navig3.jpg' border='1' />";
      echo "<img src='img/room/club/stair2.png' class='stair2' alt='Этаж 2' />";
      echo "<img id='passage' src='img/room/club/sec1.png' class='sec1' alt='".$char->city->getRoomOnline('club')."' onclick=\"solo('club');\" />";
      echo "<img id='passage' src='img/room/club/sec2.png' class='sec2' alt='3 Этаж' />";
      echo "<img src='img/room/club/sec3.png' class='sec3' $prohod3 />";
      echo "<img src='img/room/club/sec4.png' class='sec4' $prohod4 />";
      echo "<img id='passage' src='img/room/club/sec5.png' class='sec5' alt='".$char->city->getRoomOnline('km_7')."' onclick='$room_trade' />";
      echo "<img id='passage' src='img/room/club/sec6.png' class='sec6' alt='".$char->city->getRoomOnline('km_6')."' onclick=\"solo('km_6');\" />";
      echo "<img src='img/room/club/sec7.png' class='sec7' $prohod4 />";
      echo "<div class='fl1' style='left: 182px; top: 122px;'>";
  break;
  case 'km_6':
      echo "<img src='img/room/club/navig3.jpg' border='1' />";
      echo "<img src='img/room/club/sec6.png' class='sec6' alt='Рыцарский Зал' />";
      echo "<img id='passage' src='img/room/club/stair2.png' class='stair2' alt='".$char->city->getRoomOnline('club2')."' onclick=\"solo('club2');\" />";
      echo "<img id='passage' src='img/room/club/sec4.png' class='sec4' alt='".$char->city->getRoomOnline('Таверна')."' onclick=\"solo('o0');\" />";
      echo "<img src='img/room/club/sec5.png' class='sec5' $prohod2 />";
      echo "<img src='img/room/club/sec2.png' class='sec2' $prohod2 />";
      echo "<img src='img/room/club/sec1.png' class='sec1' $prohod2 />";
      echo "<img id='passage' src='img/room/club/sec7.png' class='sec7' alt='".$char->city->getRoomOnline('Башня Рыцарей и Магов')."' onclick=\"solo('o0');\" />";
      echo "<img src='img/room/club/sec3.png' class='sec3' $prohod3 />";
      echo "<div class='fl1' style='left: 279px; top: 65px;'>";
  break;
  case 'km_7':
      echo "<img src='img/room/club/navig3.jpg' border='1' />";
      echo "<img src='img/room/club/sec5.png' class='sec5' alt='Торговый Зал' />";
      echo "<img id='passage' src='img/room/club/stair2.png' class='stair2' alt='".$char->city->getRoomOnline('club2')."' onclick=\"solo('club2');\" />";
      echo "<img src='img/room/club/sec1.png' class='sec1' $prohod2 />";
      echo "<img src='img/room/club/sec2.png' class='sec2' $prohod2 />";
      echo "<img id='passage' src='img/room/club/sec3.png' class='sec3' alt='".$char->city->getRoomOnline('km_5')."' onclick=\"solo('km_5');\" />";
      echo "<img src='img/room/club/sec4.png' class='sec4' $prohod4 />";
      echo "<img src='img/room/club/sec6.png' class='sec6' $prohod2 />";
      echo "<img src='img/room/club/sec7.png' class='sec7' $prohod4 />";
      echo "<div class='fl1' style='left: 256px; top: 179px;'>";
  break;
}
?>
      <?echo $flag;?></div>
      <div class="actionbar"><?getUpdateBar();?></div>
    </div>
    <div id="add_text"></div>
    <div class="discrp"><small><?echo $desc;?></small></div>
    <hr>
    <?$char->city->addButtons();?>
    <br>
    <small><b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br><i>Администрация.</i></small><br>Сейчас в клубе <?echo $online;?> чел.
  </td>
</tr></table>