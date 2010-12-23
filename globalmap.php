<?
defined('AntiBK') or die ("Доступ запрещен!");
?>
<link rel="StyleSheet" href="styles/room.css" type="text/css">
<script type="text/javascript">
var fireworks_types = new Array('04',21, '03',21, '05',21, '06',21, '07',27, '08',27, '02',34, '09',34, '10',34 );

function fireworks (x,y,type)
{
  return start_fireworks(x,y,type);
}

function start_fireworks (x,y,type)
{
  myFW = new JSFX.FireworkDisplay(1, "img/fw"+fireworks_types[type*2], fireworks_types[type*2+1], x, y);
  myFW.start();
  return false;
}

function stop_fireworks (id)
{
  $('#'+id).css('display', 'none');
  document.getElementById(id).removeNode(true);
  return false;
}
</script>
<script src="scripts/move_check.js" type="text/javascript"></script>
<?
if (in_array (date('m'), array (12, 1, 2)))
  echo '<script src="scripts/snow.js" type="text/javascript"></script>';
$online = $adb -> selectCell ("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);
$room_buduar = ($sex == 'female' || $admin_level >= 1) ?"" :"alert ('Вход разрешен только женщинам');";
$floor_2 = ($level > 1 || $admin_level >= 1) ?"solo ('castle2');" :"alert ('Вход разрешен только со 2-ого уровня');";
$room_trade = ($orden == 1 || $orden == 2 || $level > 3 || $admin_level >= 1) ?"solo ('km_7');" :"alert ('Вход разрешен только Тарманам');";
$room_law = ($orden == 1 || $orden == 2 || $admin_level >= 1) ?"solo ('km_8');" :"alert ('Вход разрешен только c 4-ого уровня');";

$night = (date ('H') > 20 || date ('H') < 7) ?1 :0;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" style="padding-left: 2px;">
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td align="center" valign="top" width="210"><?echo $info -> character ($guid);$equip -> showEquipment ();?></td>
    <td align="left" valign="top" nowrap style="padding-left: 3px;"><br>
<?
foreach ($behaviour as $key => $value)
  echo ($level >= $value) ?"$lang[$key]: $stats[$key]<br>" :"";
echo ($stats['ups'] > 0) ?" <a class='nick' href='?action=skills'>+ Способности</a> " :'';
echo ($stats['skills'] > 0) ?"&bull; <a class='nick' href='?action=skills'><b> Обучение</b></a><br>" :"<br>";
echo "<br>";
echo "Опыт: <b>$exp</b> ($next_up)<br>";
echo "Уровень: $level<br>";
echo "Побед: $win<br>";
echo "Поражений: $lose<br>";
echo "Ничьих: $draw<br>";
echo "Деньги: <b>$money</b> кр.";
echo ($money_euro > 0) ?" <b>$money_euro</b> екр." :'';
echo ($prof) ?"<br>Профессия: <b>".$lang['prof_'.$prof]."</b>" :'';
echo ($clan) ?"<br>Клан: $clan" :'';
$orden_d = $db['orden'];
$orden_dis = ($orden_d == 1) ?"Паладинский орден - " :(($orden_d == 2) ?"Армада - " :"");
echo ($orden_d == 1 || $orden_d == 2) ?"<br><strong>$orden_dis$stat_rang</strong><br></small>" :"<br><small>Статус: <strong>$status</strong>";
$return_status = ((time () - $db['last_return']) >= $db['return_time']) | 0;
?>
    </td>
  </tr>
  <tr><td colspan="2"><small><?echo $equip -> needItemRepair ();?></small></td></tr>
</table>
</td>
<td align="right" valign="top" style="padding-right: 15px;">
<img src="img/1x1.gif" width="1" height="5">
<font color='red' id='error'><?$error -> getFormattedError ($warning, $parameters);?></font>
<table border="0" cellpadding="0" cellspacing="0">
  <tr align="right" valign="top"><td>
    <table cellpadding="0" cellspacing="0" border="0" width="1">
      <tr><td>
<?
switch ($room)
{
    case 'centplosh':
?>
        <div align="right" class="map" id="ione"><img src="img/room/dem_bg1_<?echo $night;?>.jpg" border="1"/>
        <div class="dem_lsh"><img src="img/room/dem_lsh.png" width="45" height="43"></div>
        <div class="dem_dustman_crushed"><img src="img/room/dem_dustman_crushed.png" class="passage" width="44" height="87" alt="<?echo $info -> roomOnline ('Мемориал');?>" onclick="solo('o16')" /></div>
        <div class="dem_shop"><img src="img/room/dem_shop.png" class="passage" width="71" height="99" alt="<?echo $info -> roomOnline ('shop');?>" onclick="solo('shop')" /></div>
        <div class="dem_post"><img src="img/room/dem_post.png" class="passage" width="61" height="80" alt="<?echo $info -> roomOnline ('mail');?>" onclick="solo('mail')" /></div>
        <div class="dem_club"><img src="img/room/dem_club.png" class="passage" width="160" height="124" alt="<?echo $info -> roomOnline ('castle');?>" onclick="solo('castle')" /></div>
        <div class="dem_stellav"><img src="img/room/stellav.gif" width="75" height="90" alt="<?echo $info -> roomOnline ('stella');?>" onclick="solo('stella')" style="cursor: pointer;" /></div>
        <div class="dem_repair"><img src="img/room/dem_repair.png" class="passage" width="69" height="59" alt="<?echo $info -> roomOnline ('rep');?>" onclick="solo('rep')" /></div>
        <div class="dem_temple"><img src="img/room/dem_temple.png" class="passage" width="57" height="83" alt="<?echo $info -> roomOnline ('brak');?>" onclick="solo('brak')" /></div>
        <div class="dem_optshop"><img src="img/room/dem_optshop.png" class="passage" width="50" height="70" alt="<?echo $info -> roomOnline ('Оптовый магазин');?>" onclick="solo('o3')" /></div>
        <div class="dem_station"><img src="img/room/dem_station.png" class="passage" width="99" height="85" alt="<?echo $info -> roomOnline ('cityhall');?>" onclick="solo('cityhall')" /></div>
        <div class="dem_dungeon"><img src="img/room/dem_dungeon.png" class="passage" width="42" height="35" alt="<?echo $info -> roomOnline ('prision');?>" onclick="solo('prision')" /></div>
        <div class="dem_comshop"><img src="img/room/dem_comshop.png" class="passage" width="63" height="60" alt="<?echo $info -> roomOnline ('comok');?>" onclick="solo('comok')" /></div>
        <div class="dem_right1"><img src="img/room/dem_right.png" class="passage" width="21" height="30" alt="<?echo $info -> roomOnline ('fairstreet');?>" onclick="solo('fairstreet')" /></div>
        <div class="actionbar"><?getUpdateBar ();?></div>
        <div id="snow"></div>
        </div>
      </td></tr>
      <tr><td bgcolor="#D3D3D3">
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_club" class="passage" alt="<?echo $info -> roomOnline ('castle', 'mini');?>" onclick="solo('castle')">Бойцовский Клуб</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_shop" class="passage" alt="<?echo $info -> roomOnline ('shop', 'mini');?>" onclick="solo('shop')">Магазин</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_repair" class="passage" alt="<?echo $info -> roomOnline ('s', 'mini');?>">Ремонтная мастерская</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_station" class="passage" alt="<?echo $info -> roomOnline ('cityhall', 'mini');?>" onclick="solo('cityhall')">Академия</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_comshop" class="passage" alt="<?echo $info -> roomOnline ('c', 'mini');?>">Комиссионка</a></span>
        <span class="buttons_under"><img src="img/links.gif" width="9" height="7" />&nbsp;<a href="#" id="dem_post" class="passage" alt="<?echo $info -> roomOnline ('mail', 'mini');?>" onclick="solo('mail')">Почтовое отделение</a></span>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <hr>
<?
    break;
    case 'fairstreet':
?>

        <div align="right" class="map" id="ione"><img src="img/room/dem_bg2_<?echo $night;?>.jpg" border="1"/>
        <div class="dem_bank"><img src="img/room/dem_bank.png" class="passage" width="81" height="64" alt="<?echo $info -> roomOnline ('bank');?>" onclick="solo('bank')" /></div>
        <div class="dem_dtower"><img src="img/room/dem_dtower.png" class="passage" width="73" height="159" alt="Не работает. Находится на реконструкции." onclick="alert('Не работает. Находится на реконструкции.')" /></div>
        <div class="dem_flshop"><img src="img/room/dem_flshop.png" class="passage" width="34" height="38" alt="<?echo $info -> roomOnline ('Цветочный магазин');?>" onclick="solo('o1')" /></div>
        <div class="dem_fire"><img src="img/room/dem_fire.gif" width="17" height="23" /></div>
        <div class="dem_skam1"><img src="img/room/dem_skam1.png" class="passage" width="23" height="15" alt="<?echo $info -> roomOnline ('Маленький камень');?>" onclick="solo('o4')" /></div>
        <div class="dem_skam2"><img src="img/room/dem_skam2.png" class="passage" width="25" height="12" alt="<?echo $info -> roomOnline ('Средний камень');?>" onclick="solo('o5')" /></div>
        <div class="dem_skam3"><img src="img/room/dem_skam3.png" class="passage" width="23" height="16" alt="<?echo $info -> roomOnline ('Большой камень');?>" onclick="solo('o6')" /></div>
        <div class="dem_left"><img src="img/room/dem_left.png" class="passage" width="29" height="25" alt="<?echo $info -> roomOnline ('centplosh');?>" onclick="solo('centplosh')" /></div>
        <div class="dem_hostel"><img src="img/room/dem_hostel.png" class="passage" width="87" height="108" alt="<?echo $info -> roomOnline ('Общежитие');?>" onclick="solo('o10')" /></div>
        <div class="dem_soul_stone"><img src="img/room/dem_soul_stone.png" class="passage" width="65" height="63" alt="Камень Души" onclick="solo('o11')"></div>
        <div class="dem_right2"><img src="img/room/dem_right.png" class="passage" width="21" height="30" alt="<?echo $info -> roomOnline ('Аллея Тьмы');?>" onclick="solo('o12')" /></div>
        <div class="actionbar"><?getUpdateBar ();?></div>
        <div id="snow"></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <hr>
<?
    break;
}
?>
    <small><b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br><i>Администрация.</i></small><br>Сейчас в клубе <?echo $online;?> чел.
    </td>
  </tr>
</table>
    </td>
  </tr>
</table>
<div class="buttons">
<?
if ($return_status)
  echo "<span class='buttons_on_image' onclick=\"location.href = 'main.php?action=return';\">Возврат</span>&nbsp;";
?>
  <span class="buttons_on_image" onclick="window.open('/forum');">Форум</span>&nbsp;
  <span class="buttons_on_image" onclick="showHelp ('top');">Подсказка</span>&nbsp;
</div>