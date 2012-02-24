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

$(function (){
  $('input[type=button]#forum').live('click', function (){
    window.open('/forum');
  }).val('Форум');
  $('input[type=button]#fights').live('click', function (){
    location.href = 'zayavka.php';
  }).val('Поединки').css({'font-weight': 'bold', 'width': '102px'});
});
</script>
<script src="img/fireworks2.js" type="text/javascript"></script>
<script src="scripts/move_check.js" type="text/javascript"></script>
<?
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `city` = ?s", $city);
$room_buduar = ($sex == 'female' || $admin_level >= 1) ?"" :"alert ('Вход разрешен только женщинам');";
$floor_2 = ($level > 1 || $admin_level >= 1) ?"solo ('castle2');" :"alert ('Вход разрешен только со 2-ого уровня');";
$room_trade = ($orden == 1 || $orden == 2 || $level > 3 || $admin_level >= 1) ?"solo ('km_7');" :"alert ('Вход разрешен только Тарманам');";
$room_law = ($orden == 1 || $orden == 2 || $admin_level >= 1) ?"solo ('km_8');" :"alert ('Вход разрешен только c 4-ого уровня');";

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
<font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
<table border="0" cellpadding="0" cellspacing="0">
  <tr align="right" valign="top"><td>
    <table cellpadding="0" cellspacing="0" border="0" width="1">
      <tr><td>
<?
switch ($room)
{
  case 'castle':
?>
        <div align="right" class="map"><img src="img/room/navig.jpg" border="1"/>
        <div class="map_klub2"><img src="img/room/map_klub2.png" class="passage" width="58" height="49" alt="<?echo $char->city->getRoomOnline('castle2');?>" onclick="<?echo $floor_2;?>" /></div>
        <div class="map_klub3"><img src="img/room/map_klub3.png" class="passage" width="123" height="31" alt="<?echo $char->city->getRoomOnline('km_2');?>" onclick="solo ('km_2');" /></div>
        <div class="map_klub4"><img src="img/room/map_klub4.png" class="passage" width="123" height="31" alt="<?echo $char->city->getRoomOnline('km_1');?>" onclick="solo ('km_1');" /></div>
        <div class="map_klub5"><img src="img/room/map_klub5.png" class="passage" width="123" height="30" alt="<?echo $char->city->getRoomOnline('km_3');?>" onclick="solo ('km_3');" /></div>
        <div class="map_klub6"><img src="img/room/map_klub6.png" class="passage" width="123" height="30" alt="<?echo $char->city->getRoomOnline('km_4');?>" onclick="solo ('km_4');" /></div>
        <div class="map_klub7"><img src="img/room/map_klub7.png" class="passage" width="103" height="47" alt="<?echo $char->city->getRoomOnline('centplosh');?>" onclick="solo ('centplosh');" /></div>
        <div class="map_bk"><img src="img/room/map_bk.png" width="120" height="35" title="Бойцовский Клуб" /></div>
        <div class="fl1" style="left: 240px; top: 124px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <div class="map_discrp"><small>Благородный дон желает стоять как столб посреди комнаты, и пугать своим видом новичков, или все-таки поднимется на второй этаж, где творятся настоящие дела?</small></div>
      <hr>
<?
  break;
  case 'km_1':
?>
        <div align="right" class="map"><img src="img/room/navig.jpg" border="1"/>
        <div class="map_klub1"><img src="img/room/map_klub1.png" class="passage" width="56" height="13" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub2"><img src="img/room/map_klub2.png" class="passage" width="58" height="49" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub3"><img src="img/room/map_klub3.png" class="passage" width="123" height="31" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub4"><img src="img/room/map_klub4.png" width="123" height="31" title="Зал воинов" /></div>
        <div class="map_klub5"><img src="img/room/map_klub5.png" class="passage" width="123" height="30" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub6"><img src="img/room/map_klub6.png" class="passage" width="123" height="30" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub7"><img src="img/room/map_klub7.png" class="passage" width="103" height="47" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_bk"><img src="img/room/map_bk.png" class="passage" width="120" height="35" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo ('castle');" /></div>
        <div class="fl1" style="left: 113px; top: 194px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <div class="map_discrp"><small>Возможно, вы ошиблись этажом - настоящие сражения проходят выше.</small></div>
      <hr>
      <input type="button" class="btn2" id="fights" />
<?
  break;
  case 'km_2':
?>
        <div align="right" class="map"><img src="img/room/navig.jpg" border="1"/>
        <div class="map_klub1"><img src="img/room/map_klub1.png" class="passage" width="56" height="13" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub2"><img src="img/room/map_klub2.png" class="passage" width="58" height="49" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub3"><img src="img/room/map_klub3.png" width="123" height="31" title="Зал воинов 2" /></div>
        <div class="map_klub4"><img src="img/room/map_klub4.png" class="passage" width="123" height="31" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub5"><img src="img/room/map_klub5.png" class="passage" width="123" height="30" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub6"><img src="img/room/map_klub6.png" class="passage" width="123" height="30" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub7"><img src="img/room/map_klub7.png" class="passage" width="103" height="47" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_bk"><img src="img/room/map_bk.png" class="passage" width="120" height="35" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo ('castle');" /></div>
        <div class="fl1" style="left: 395px; top: 142px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <div class="map_discrp"><small>Если вы пришли сюда не за завтраком, обедом или ужином, то может быть вы ошиблись этажом?</small></div>
      <hr>
      <input type="button" class="btn2" id="fights" />
<?
  break;
  case 'km_3':
?>
        <div align="right" class="map"><img src="img/room/navig.jpg" border="1"/>
        <div class="map_klub1"><img src="img/room/map_klub1.png" class="passage" width="56" height="13" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub2"><img src="img/room/map_klub2.png" class="passage" width="58" height="49" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub3"><img src="img/room/map_klub3.png" class="passage" width="123" height="31" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub4"><img src="img/room/map_klub4.png" class="passage" width="123" height="31" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub5"><img src="img/room/map_klub5.png" width="123" height="30" title="Зал воинов 3" /></div>
        <div class="map_klub6"><img src="img/room/map_klub6.png" class="passage" width="123" height="30" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub7"><img src="img/room/map_klub7.png" class="passage" width="103" height="47" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_bk"><img src="img/room/map_bk.png" class="passage" width="120" height="35" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo ('castle');" /></div>
        <div class="fl1" style="left: 364px; top: 76px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <div class="map_discrp"><small>Если вы пришли сюда не за завтраком, обедом или ужином, то может быть вы ошиблись этажом?</small></div>
      <hr>
      <input type="button" class="btn2" id="fights" />
<?
  break;
  case 'km_4':
?>
        <div align="right" class="map"><img src="img/room/navig.jpg" border="1"/>
        <div class="map_klub1"><img src="img/room/map_klub1.png" class="passage" width="56" height="13" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub2"><img src="img/room/map_klub2.png" class="passage" width="58" height="49" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub3"><img src="img/room/map_klub3.png" class="passage" width="123" height="31" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub4"><img src="img/room/map_klub4.png" class="passage" width="123" height="31" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub5"><img src="img/room/map_klub5.png" class="passage" width="123" height="30" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_klub6"><img src="img/room/map_klub6.png" width="123" height="30" title="Будуар" /></div>
        <div class="map_klub7"><img src="img/room/map_klub7.png" class="passage" width="103" height="47" title="Проход через Бойцовский Клуб" onclick="alert ('Проход через Бойцовский Клуб');" /></div>
        <div class="map_bk"><img src="img/room/map_bk.png" class="passage" width="120" height="35" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo ('castle');" /></div>
        <div class="fl1" style="left: 113px; top: 73px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <hr>
      <input type="button" class="btn2" id="fights" />
<?
  break;
  case 'castle2':
?>
        <div align="right" class="map"><img src="img/room/navig3.jpg" border="1"/>
        <div class="map_2stair"><img src="img/room/map_2stair.png" width="120" height="35" title="Этаж 2"/></div>
        <div class="map_sec1"><img src="img/room/map_sec1.png" class="passage" width="91" height="43" alt="<?echo $char->city->getRoomOnline('castle');?>" onclick="solo ('castle');" /></div>
        <div class="map_sec2"><img src="img/room/map_sec2.png" class="passage" width="63" height="40" title="3 Этаж" /></div>
        <div class="map_sec3"><img src="img/room/map_sec3.png" class="passage" width="101" height="37" title="Вход через Торговый Зал" onclick="alert ('Вход через Торговый Зал');" /></div>
        <div class="map_sec4"><img src="img/room/map_sec4.png" class="passage" width="89" height="32" title="Вход через Рыцарский Зал" onclick="alert ('Вход через Рыцарский Зал');" /></div>
        <div class="map_sec5"><img src="img/room/map_sec5.png" class="passage" width="122" height="31" alt="<?echo $char->city->getRoomOnline('km_7');?>" onclick="<?echo $room_trade;?>" /></div>
        <div class="map_sec6"><img src="img/room/map_sec6.png" class="passage" width="123" height="32" alt="<?echo $char->city->getRoomOnline('km_6');?>" onclick="solo ('km_6');" /></div>
        <div class="map_sec7"><img src="img/room/map_sec7.png" class="passage" width="123" height="39" title="Вход через Рыцарский Зал" onclick="alert ('Вход через Рыцарский Зал');" /></div>
        <div class="fl1" style="left: 182px; top: 122px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <div class="map_discrp"><small>Если есть желание купить, продать, лечить, точить – посетите Торговый Зал. Если есть желание изменить себя, освоить новые умения и поправить расшатанное эликсирами здоровье - пройдите в комнату Знахаря. Если есть желание драться, то вам в Рыцарский Зал. Если есть желание драться, драться, драться и ещё раз драться, обсуждая в перерывах превосходство мощного крита в репу над всякой магической заумью, то вам в Башню Рыцарей Магов.</small></div>
      <hr>
<?
  break;
  case 'km_7':
?>
        <div align="right" class="map"><img src="img/room/navig3.jpg" border="1"/>
        <div class="map_2stair"><img src="img/room/map_2stair.png" class="passage" width="120" height="35" alt="<?echo $char->city->getRoomOnline('castle2');?>" onclick="solo ('castle2');" /></div>
        <div class="map_sec1"><img src="img/room/map_sec1.png" class="passage" width="91" height="43" title="Проход через Этаж 2" onclick="alert ('Проход через Этаж 2');" /></div>
        <div class="map_sec2"><img src="img/room/map_sec2.png" class="passage" width="63" height="40" title="Проход через Этаж 2" onclick="alert ('Проход через Этаж 2');" /></div>
        <div class="map_sec3"><img src="img/room/map_sec3.png" class="passage" width="101" height="37" alt="<?echo $char->city->getRoomOnline('km_5');?>" onclick="solo ('km_5');" /></div>
        <div class="map_sec4"><img src="img/room/map_sec4.png" class="passage" width="89" height="32" title="Вход через Рыцарский Зал" onclick="alert ('Вход через Рыцарский Зал');" /></div>
        <div class="map_sec5"><img src="img/room/map_sec5.png" width="122" height="31" title="Торговый Зал" /></div>
        <div class="map_sec6"><img src="img/room/map_sec6.png" class="passage" width="123" height="32" title="Проход через Этаж 2" onclick="alert ('Проход через Этаж 2');" /></div>
        <div class="map_sec7"><img src="img/room/map_sec7.png" class="passage" width="123" height="39" title="Вход через Рыцарский Зал" onclick="alert ('Вход через Рыцарский Зал');" /></div>
        <div class="fl1" style="left: 256px; top: 179px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
      <div id="add_text"></div>
      <div class="map_discrp"><small>Ищете лекаря? Ваш доспех вам жмет и вы хотите другой? Нужен умелый наемник? Вы попали по адресу. Именно здесь можно купить или продать любой товар или услугу. Здешние умельцы и оденут и обуют вас в один момент.<br>Орден света предупреждает – настоящий воин должен быть немногословным.</small></div>
      <hr>
      <input type="button" class="btn2" id="fights" />
<?
  break;
  case 'km_6':
?>
        <div align="right" class="map"><img src="img/room/navig3.jpg" border="1"/>
        <div class="map_2stair"><img src="img/room/map_2stair.png" class="passage" width="120" height="35" alt="<?echo $char->city->getRoomOnline('castle2');?>" onclick="solo ('castle2');" /></div>
        <div class="map_sec4"><img src="img/room/map_sec4.png" class="passage" width="89" height="32" alt="<?echo $char->city->getRoomOnline('Таверна');?>" class="passage" onclick="solo ('o0');" /></div>
        <div class="map_sec5"><img src="img/room/map_sec5.png" class="passage" width="122" height="31" title="Проход через Этаж 2" onclick="alert ('Проход через Этаж 2');" /></div>
        <div class="map_sec6"><img src="img/room/map_sec6.png" width="123" height="32" title="Рыцарский Зал" /></div>
        <div class="map_sec2"><img src="img/room/map_sec2.png" class="passage" width="63" height="40" title="Проход через Этаж 2" onclick="alert ('Проход через Этаж 2');" /></div>
        <div class="map_sec1"><img src="img/room/map_sec1.png" class="passage" width="91" height="43" title="Проход через Этаж 2" onclick="alert ('Проход через Этаж 2');" /></div>
        <div class="map_sec7"><img src="img/room/map_sec7.png" class="passage" width="123" height="39" alt="<?echo $char->city->getRoomOnline('Башня Рыцарей и Магов');?>" onclick="solo ('o0');" /></div>
        <div class="map_sec3"><img src="img/room/map_sec3.png" class="passage" width="101" height="37" title="Вход через Торговый Зал" onclick="alert ('Вход через Торговый Зал');" /></div>
        <div class="fl1" style="left: 279px; top: 65px;"><img src="img/room/fl1.png" width="16" height="18" /></div>
        <div class="actionbar"><?getUpdateBar();?></div>
        </div>
      </td></tr>
    </table>
  </td></tr>
  <tr align="right">
    <td width="700" align="right">
        <div id="add_text"></div>
        <div class="map_discrp"><small>Вы уже не новичок. Вы уже боец. И не просто боец а Боец с большой буквы. Осталось объяснить это вооон тому артнику...</small></div>
        <hr>
        <input type="button" class="btn2" id="fights" />
<?
  break;
}

if ($return_status)
  echo "<input type='button' class='btn2' value='Возврат' id='link' link='return' style='font-weight: bold; width: 102px;' />";
?>
        <input type="button" class="btn2" value="Карта клуба" id="link" link="map" style="font-weight: bold; width: 102px;" />
        <input type="button" class="btn2" id="forum" />
        <input type="button" class="btn2" value="<?echo $lang['hint'];?>" style="width: 102px;" id="hint" link="top" /><br>
        <small><b>Внимание!</b> Никогда и никому не говорите пароль от своего персонажа. Не вводите пароль на других сайтах, типа "новый город", "лотерея", "там, где все дают на халяву". Пароль не нужен ни паладинам, ни кланам, ни администрации, <u>только взломщикам</u> для кражи вашего героя.<br><i>Администрация.</i></small><br>Сейчас в клубе <?echo $online;?> чел.
      </td>
    </tr>
</table>
    </td>
  </tr>
</table>