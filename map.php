<?
defined('AntiBK') or die ("Доступ запрещен!");
?>
<style>
.clubitem {
  font-size: 10px;
  background-color: #999999;
  border-width: 3px;
  border-color: #333333;
  border-style: solid;
  padding: 1px;
}
body {background-color: #e2e0e0;}
</style>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td align="left" nowrap><h3 style="padding: 0px; margin: 0px;">
<?
switch ($room)
{
  case 'club':
  case 'hall_1':
  case 'hall_2':
  case 'hall_3':
  case 'boudoir':
  case 'novice':
  case 'passage':
    echo "Бойцовский Клуб. Карта";
  break;
  case 'club2':
    echo "Этаж 2. Карта";
  break;
}
?>
    </h3></td>
    <td width="100%" align="right">
      <input type="button" class="nav" value="<?echo $lang['refresh'];?>" id="refresh">&nbsp;
      <input type="button" class="nav" value="<?echo $lang['return'];?>" id="link" link="none">
    </td>
  </tr>
</table>
<br>
<?
switch ($room)
{
  case 'club':
  case 'hall_1':
  case 'hall_2':
  case 'hall_3':
  case 'boudoir':
  case 'passage':
  case 'novice':
?>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div style="width: 90px; height: 60px;" class="clubitem"><?$char->city->showRoomOnMap('hall_1')?></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img src="img/icon/maparrv.gif" width="20" height="20" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td><div style="width: 90px; height: 60px;" class="clubitem"><?$char->city->showRoomOnMap('boudoir')?></div></td>
    <td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
    <td>
      <div style="width: 160px; height: 100px;" class="clubitem">
        <table cellpadding="0" cellspacing="0" width="100%" height="100%">
          <tr valign="top"><td align="center" style="font-size: 10px;"><?$char->city->showRoomOnMap('club')?></td></tr>
          <tr valign="bottom"><td align="left" style="font-size: 10px;">Переходы:<br><strong>&nbsp;Центральная площадь<br>&nbsp;Этаж 2</strong></td></tr>
        </table>
      </div>
    </td>
    <td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
    <td><div style="width: 90px; height: 60px;" class="clubitem"><?$char->city->showRoomOnMap('hall_2')?></div></td>
    <td><img src="img/icon/maparrhl.gif" width="20" height="20" /></td>
    <td>
      <div style="width: 90px; height: 60px;" class="clubitem">
      <table cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr valign="top"><td align="center" style="font-size: 10px;"><?$char->city->showRoomOnMap('passage')?></td></tr>
        <tr valign="bottom"><td align="left" style="font-size: 10px;">Последний рубеж детства</td></tr>
      </table>
      </div>
    </td>
    <td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
    <td>
      <div style="width: 90px; height: 100px;" class="clubitem">
      <table cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr valign="top"><td align="center" style="font-size: 10px;"><?$char->city->showRoomOnMap('novice')?></td></tr>
        <tr valign="bottom"><td align="left" style="font-size: 10px;">Уровень: <strong>0-3</strong></td></tr>
      </table>
      </div>
    </td>
  </tr>
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><img src="img/icon/maparrv.gif" width="20" height="20" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div style="width: 90px; height: 60px;" class="clubitem"><?$char->city->showRoomOnMap('hall_3')?></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
    break;
    case 'club2':
    case 'km_6':
    case 'km_7':
?>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center" valign="middle">
    <td><div style="width: 120px; height: 80px;" class="clubitem"><strong>Башня рыцарей-магов</strong> (<strong>3</strong>)</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td><img src="img/icon/maparrv.gif" width="20" height="20" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td><div style="width: 120px; height: 80px;" class="clubitem"><?$char->city->showRoomOnMap('km_6')?></div></td>
    <td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
    <td><div style="width:120px; height:80px;" class="clubitem"><strong>Таверна -Зеленый Котел-</strong> (<strong>0</strong>)</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td><img src="img/icon/maparrv.gif" width="20" height="20" /></td>
    <td>&nbsp;</td>
    <td><img src="img/icon/maparrv.gif" width="20" height="20" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center" valign="middle">
    <td>
      <div style="width: 120px; height: 80px;" class="clubitem">
      <table cellpadding="0" cellspacing="0" width="100%" height="100%">
        <tr valign="top"><td align="center" style="font-size: 10px;"><?$char->city->showRoomOnMap('club2')?></td></tr>
        <tr valign="bottom"><td align="left" style="font-size: 10px;">Переходы:<br><strong>&nbsp;Бойцовский Клуб<br>&nbsp;Этаж 3</strong></td></tr>
      </table>
      </div>
    </td>
    <td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
    <td><div style="width: 120px; height: 80px;" class="clubitem"><?$char->city->showRoomOnMap('km_7')?></div></td>
    <td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
    <td><div style="width: 120px; height: 80px;" class="clubitem"><strong>Комната Знахаря</strong> (<strong>0</strong>)</div></td>
  </tr>
</table>
<?
  break;
}
?>