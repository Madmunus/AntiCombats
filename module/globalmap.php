<?
defined('AntiBK') or die("Доступ запрещен!");
?>
<link rel="StyleSheet" href="styles/globalmap.css" type="text/css">
<link rel="StyleSheet" href="styles/city_<?echo $city;?>.css" type="text/css">
<script src="scripts/fireworks.js" type="text/javascript"></script>
<script src="scripts/move_check.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
	if ($('#ione'))
		$('.buttons').appendTo('#ione');
	
	$('img#passage').hover(
		function ()
		{
			var image = $(this).attr('class');
			image = image.replace('right2', 'right');
      image = image.replace('arrow_left2', 'arrow_left');
      image = image.replace('arrow_right2', 'arrow_right');
			$(this).attr('src', "img/room/"+top.city+"/glow/"+image+".png");
		},
		function ()
		{
			var image = $(this).attr('class');
			image = image.replace('right2', 'right');
      image = image.replace('arrow_left2', 'arrow_left');
      image = image.replace('arrow_right2', 'arrow_right');
			$(this).attr('src', "img/room/"+top.city+"/"+image+".png");
		}
	);
	$('.buttons_on_image').hover(
		function ()
		{
			$(this).css('color', 'white');
		},
		function ()
		{
			$(this).css('color', '#D8D8D8');
		}
	);
	$('a.passage').hover(
		function ()
		{
			if (!($(this).attr('id')))
				return;
			
			var image = $('.'+$(this).attr('id'));
			image.attr('src', "img/room/"+top.city+"/glow/"+$(this).attr('id')+".png");
		},
		function ()
		{
			if (!($(this).attr('id')))
				return;
			
			var image = $('.'+$(this).attr('id'));
			image.attr('src', "img/room/"+top.city+"/"+$(this).attr('id')+".png");
		}
	);
});
</script>
<?
echoScript("top.city = '$city';");
if (in_array (date('m'), array (12, 1, 2)))
  echo '<script src="scripts/snow.js" type="text/javascript"></script>';
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);

$night = (date('H') > 19 || date('H') < 8) ?1 :0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
  <td valign="top" style="min-width: 600px;"><?include("char_map.php");?></td>
  <td align="right" valign="top">
    <img src="img/1x1.gif" width="1" height="5">
    <font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
    <div align="right" class="map" id="ione">
<?
switch ($city)
{
  case 'dem':
    switch ($room)
    {
      case 'centsquare':
?>
      <img src="img/room/dem/bg1_<?echo $night;?>.jpg" border="1" />
      <img src="img/room/dem/lsh.png" class="lsh" />
      <img src="img/room/dem/stella.gif" class="stella" alt="<?echo $char->city->getRoomOnline('stella');?>" onclick="solo('stella')" style="cursor: pointer;" />
      <img id="passage" src="img/room/dem/dustman_crushed.png" class="dustman_crushed" alt="<?echo $char->city->getRoomOnline('Мемориал');?>" onclick="solo('o16');" />
      <img id="passage" src="img/room/dem/shop.png" class="shop" alt="<?echo $char->city->getRoomOnline('shop');?>" onclick="solo('shop');" />
      <img id="passage" src="img/room/dem/post.png" class="post" alt="<?echo $char->city->getRoomOnline('mail');?>" onclick="solo('mail');" />
      <img id="passage" src="img/room/dem/club.png" class="club" alt="<?echo $char->city->getRoomOnline('club');?>" onclick="solo('club');" />
      <img id="passage" src="img/room/dem/repair.png" class="repair" alt="<?echo $char->city->getRoomOnline('rep');?>" onclick="solo('rep');" />
      <img id="passage" src="img/room/dem/temple.png" class="temple" alt="<?echo $char->city->getRoomOnline('brak');?>" onclick="solo('brak');" />
      <img id="passage" src="img/room/dem/optshop.png" class="optshop" alt="<?echo $char->city->getRoomOnline('Оптовый магазин');?>" onclick="solo('o3');" />
      <img id="passage" src="img/room/dem/station.png" class="station" alt="<?echo $char->city->getRoomOnline('station');?>" onclick="solo('station');" />
      <img id="passage" src="img/room/dem/dungeon.png" class="dungeon" alt="<?echo $char->city->getRoomOnline('dungeon');?>" onclick="solo('dungeon');" />
      <img id="passage" src="img/room/dem/comshop.png" class="comshop" alt="<?echo $char->city->getRoomOnline('comok');?>" onclick="solo('comok');" />
      <img id="passage" src="img/room/dem/right.png" class="right" alt="<?echo $char->city->getRoomOnline('fairstreet');?>" onclick="solo('fairstreet');" />
      <div class="actionbar"><?getUpdateBar();?></div>
    </div>
    <div style="width: 500px; text-align: left;">
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="club" class="passage" alt="<?echo $char->city->getRoomOnline('club', 'mini');?>" onclick="solo('club');">Бойцовский Клуб</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="shop" class="passage" alt="<?echo $char->city->getRoomOnline('shop', 'mini');?>" onclick="solo('shop');">Магазин</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="repair" class="passage" alt="<?echo $char->city->getRoomOnline('s', 'mini');?>">Ремонтная мастерская</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="station" class="passage" alt="<?echo $char->city->getRoomOnline('station', 'mini');?>" onclick="solo('station');">Вокзал</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="comshop" class="passage" alt="<?echo $char->city->getRoomOnline('c', 'mini');?>">Комиссионка</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="post" class="passage" alt="<?echo $char->city->getRoomOnline('mail', 'mini');?>" onclick="solo('mail');">Почтовое отделение</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="right" class="passage" alt="<?echo $char->city->getRoomOnline('fairstreet', 'mini');?>" onclick="solo('fairstreet');">Страшилкина улица</a></span>
<?
      break;
      case 'fairstreet':
?>
      <img src="img/room/dem/bg2_<?echo $night;?>.jpg" border="1" />
      <img src="img/room/dem/fire.gif" class="fire" />
      <img id="passage" src="img/room/dem/soul_stone.png" class="soul_stone" alt="Камень Души" onclick="solo('o11');">
      <img id="passage" src="img/room/dem/dtower.png" class="dtower" alt="Не работает. Находится на реконструкции." onclick="alert('Не работает. Находится на реконструкции.');" />
      <img id="passage" src="img/room/dem/bank.png" class="bank" alt="<?echo $char->city->getRoomOnline('bank');?>" onclick="solo('bank');" />
      <img id="passage" src="img/room/dem/flshop.png" class="flshop" alt="<?echo $char->city->getRoomOnline('Цветочный магазин');?>" onclick="solo('o1');" />
      <img id="passage" src="img/room/dem/skam1.png" class="skam1" alt="<?echo $char->city->getRoomOnline('Маленький камень');?>" onclick="solo('o4');" />
      <img id="passage" src="img/room/dem/skam2.png" class="skam2" alt="<?echo $char->city->getRoomOnline('Средний камень');?>" onclick="solo('o5');" />
      <img id="passage" src="img/room/dem/skam3.png" class="skam3" alt="<?echo $char->city->getRoomOnline('Большой камень');?>" onclick="solo('o6');" />
      <img id="passage" src="img/room/dem/left.png" class="left" alt="<?echo $char->city->getRoomOnline('centsquare');?>" onclick="solo('centsquare');" />
      <img id="passage" src="img/room/dem/hostel.png" class="hostel" alt="<?echo $char->city->getRoomOnline('Общежитие');?>" onclick="solo('o10');" />
      <img id="passage" src="img/room/dem/right.png" class="right2" alt="<?echo $char->city->getRoomOnline('Аллея Тьмы');?>" onclick="solo('o12');" />
      <div class="actionbar"><?getUpdateBar();?></div>
<?
      break;
    }
  break;
  case 'low':
    switch ($room)
    {
      case 'centsquare':
?>
      <img src="img/room/low/bg1_<?echo $night;?>.jpg" border="1" />
      <img src="img/room/low/monument.png" class="monument" />
      <img src="img/room/low/stella.gif" class="stella" alt="<?echo $char->city->getRoomOnline('stella');?>" onclick="solo('stella');" style="cursor: pointer;" />
      <img src="img/room/low/arrow_left.png" class="arrow_left" alt="Прохода нет" />
      <img id="passage" src="img/room/low/temple.png" class="temple" alt="Храм" onclick="alert('На реконструкции');" />
      <img id="passage" src="img/room/low/shop.png" class="shop" alt="<?echo $char->city->getRoomOnline('shop');?>" onclick="solo('shop');" />
      <img id="passage" src="img/room/low/comission.png" class="comission" alt="<?echo $char->city->getRoomOnline('comission');?>" onclick="solo('comission');" />
      <img id="passage" src="img/room/low/station.png" class="station" alt="<?echo $char->city->getRoomOnline('station');?>" onclick="solo('station');" />
      <img id="passage" src="img/room/low/repare.png" class="repare" alt="<?echo $char->city->getRoomOnline('repare');?>" onclick="solo('repare');" />
      <img id="passage" src="img/room/low/post.png" class="post" alt="<?echo $char->city->getRoomOnline('mail');?>" onclick="solo('mail');" />
      <img id="passage" src="img/room/low/club.png" class="club" alt="<?echo $char->city->getRoomOnline('club');?>" onclick="solo('club');" />
      <img id="passage" src="img/room/low/arrow_right.png" class="arrow_right" alt="<?echo $char->city->getRoomOnline('fairstreet');?>" onclick="solo('fairstreet');" />
      <div class="actionbar"><?getUpdateBar();?></div>
    </div>
    <div style="width: 500px; text-align: left;">
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="club" class="passage" alt="<?echo $char->city->getRoomOnline('club', 'mini');?>" onclick="solo('club');">Бойцовский Клуб</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="station" class="passage" alt="<?echo $char->city->getRoomOnline('station', 'mini');?>" onclick="solo('station');">Вокзал</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="arrow_right" class="passage" alt="<?echo $char->city->getRoomOnline('fairstreet', 'mini');?>" onclick="solo('fairstreet');">Страшилкина улица</a></span>
<?
      break;
      case 'fairstreet':
?>
      <img src="img/room/low/bg2_<?echo $night;?>.jpg" border="1" />
      <img id="passage" src="img/room/low/dtower.png" class="dtower" alt="Загадочная Башня заперта.." onclick="alert('Загадочная Башня заперта..');" />
      <img id="passage" src="img/room/low/bank.png" class="bank" alt="<?echo $char->city->getRoomOnline('bank');?>" onclick="solo('bank');" />
      <img id="passage" src="img/room/low/room_small.png" class="room_small" alt="<?echo $char->city->getRoomOnline('room_small');?>" onclick="solo('room_small');" />
      <img id="passage" src="img/room/low/room_medium.png" class="room_medium" alt="<?echo $char->city->getRoomOnline('room_medium');?>" onclick="solo('room_medium');" />
      <img id="passage" src="img/room/low/room_big.png" class="room_big" alt="<?echo $char->city->getRoomOnline('room_big');?>" onclick="solo('room_big');" />
      <img id="passage" src="img/room/low/arrow_left.png" class="arrow_left2" alt="<?echo $char->city->getRoomOnline('centsquare');?>" onclick="solo('centsquare');" />
      <img id="passage" src="img/room/low/house.png" class="house" alt="<?echo $char->city->getRoomOnline('house');?>" onclick="solo('house');" />
      <img id="passage" src="img/room/low/dung.png" class="dung" alt="<?echo $char->city->getRoomOnline('dung');?>" onclick="solo('dung');" />
      <img id="passage" src="img/room/low/zoo.png" class="zoo" alt="<?echo $char->city->getRoomOnline('zoo');?>" onclick="solo('zoo');" />
      <img id="passage" src="img/room/low/flshop.png" class="flshop" alt="<?echo $char->city->getRoomOnline('flshop');?>" onclick="solo('flshop');" />
      <div class="actionbar"><?getUpdateBar();?></div>
<?
      break;
    }
  break;
  case 'drm':
    switch ($room)
    {
      case 'centsquare':
?>
      <img src="img/room/drm/bg1_<?echo $night;?>.jpg" border="1" />
      <img src="img/room/drm/monument.png" class="monument" />
      <img src="img/room/drm/stella.gif" class="stella" alt="<?echo $char->city->getRoomOnline('stella');?>" onclick="solo('stella');" style="cursor: pointer;" />
      <img src="img/room/drm/arrow_left.png" class="arrow_left" alt="Прохода нет" />
      <img id="passage" src="img/room/drm/temple.png" class="temple" alt="Храм" onclick="alert('На реконструкции');" />
      <img id="passage" src="img/room/drm/shop.png" class="shop" alt="<?echo $char->city->getRoomOnline('shop');?>" onclick="solo('shop');" />
      <img id="passage" src="img/room/drm/comission.png" class="comission" alt="<?echo $char->city->getRoomOnline('comission');?>" onclick="solo('comission');" />
      <img id="passage" src="img/room/drm/station.png" class="station" alt="<?echo $char->city->getRoomOnline('station');?>" onclick="solo('station');" />
      <img id="passage" src="img/room/drm/repare.png" class="repare" alt="<?echo $char->city->getRoomOnline('repare');?>" onclick="solo('repare');" />
      <img id="passage" src="img/room/drm/post.png" class="post" alt="<?echo $char->city->getRoomOnline('mail');?>" onclick="solo('mail');" />
      <img id="passage" src="img/room/drm/club.png" class="club" alt="<?echo $char->city->getRoomOnline('club');?>" onclick="solo('club');" />
      <img id="passage" src="img/room/drm/arrow_right.png" class="arrow_right" alt="<?echo $char->city->getRoomOnline('fairstreet');?>" onclick="solo('fairstreet');" />
      <div class="actionbar"><?getUpdateBar();?></div>
    </div>
    <div style="width: 518px; text-align: left;">
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="club" class="passage" alt="<?echo $char->city->getRoomOnline('club', 'mini');?>" onclick="solo('club');">Бойцовский Клуб</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="station" class="passage" alt="<?echo $char->city->getRoomOnline('station', 'mini');?>" onclick="solo('station');">Вокзал</a></span>
      <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="arrow_right" class="passage" alt="<?echo $char->city->getRoomOnline('fairstreet', 'mini');?>" onclick="solo('fairstreet');">Страшилкина улица</a></span>
<?
      break;
      case 'fairstreet':
?>
      <img src="img/room/drm/bg2_<?echo $night;?>.jpg" border="1" />
      <img src="img/room/drm/arrow_right.png" class="arrow_right2" alt="Проход закрыт" />
      <img id="passage" src="img/room/drm/dtower.png" class="dtower" alt="Загадочная Башня заперта.." onclick="alert('Загадочная Башня заперта..');" />
      <img id="passage" src="img/room/drm/bank.png" class="bank" alt="<?echo $char->city->getRoomOnline('bank');?>" onclick="solo('bank');" />
      <img id="passage" src="img/room/drm/room_small.png" class="room_small" alt="<?echo $char->city->getRoomOnline('room_small');?>" onclick="solo('room_small');" />
      <img id="passage" src="img/room/drm/room_medium.png" class="room_medium" alt="<?echo $char->city->getRoomOnline('room_medium');?>" onclick="solo('room_medium');" />
      <img id="passage" src="img/room/drm/room_big.png" class="room_big" alt="<?echo $char->city->getRoomOnline('room_big');?>" onclick="solo('room_big');" />
      <img id="passage" src="img/room/drm/arrow_left.png" class="arrow_left2" alt="<?echo $char->city->getRoomOnline('centsquare');?>" onclick="solo('centsquare');" />
      <img id="passage" src="img/room/drm/house.png" class="house" alt="<?echo $char->city->getRoomOnline('house');?>" onclick="solo('house');" />
      <img id="passage" src="img/room/drm/dung.png" class="dung" alt="<?echo $char->city->getRoomOnline('dung');?>" onclick="solo('dung');" />
      <img id="passage" src="img/room/drm/zoo.png" class="zoo" alt="<?echo $char->city->getRoomOnline('zoo');?>" onclick="solo('zoo');" />
      <img id="passage" src="img/room/drm/flshop.png" class="flshop" alt="<?echo $char->city->getRoomOnline('flshop');?>" onclick="solo('flshop');" />
      <div class="actionbar"><?getUpdateBar();?></div>
<?
      break;
    }
  break;
}
?>
    </div>
    <div id="add_text"></div>
    <hr>
    <small><b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br><i>Администрация.</i></small><br>Сейчас в клубе <?echo $online;?> чел.
  </td>
</tr></table>
<div class="buttons"><?$char->city->addButtons('loc');?></div>