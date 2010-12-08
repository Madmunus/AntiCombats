<?
defined('AntiBK') or die ("Доступ запрещен!");

$flag = "<img src='img/icon/flag2.gif' width='20' height='20' alt='Вы находитесь здесь' align='right'>";
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
	case 'castle':
	case 'km_4':
	case 'km_1':
	case 'km_2':
	case 'km_3':
	case 'Комната Перехода':
	case 'Комната для новичков':
		echo "Бойцовский Клуб. Карта";
	break;
	case 'castle2':
		echo "Этаж 2. Карта";
	break;
}
?>
		</h3></td>
		<td width="100%" align="right">
			<input type="button" class="nav" value="Обновить" id="refresh">&nbsp;
			<input type="button" class="nav" value="Вернуться" id="revert" link="none">
		</td>
	</tr>
</table>
<br>
<?
switch ($room)
{
	case 'castle':
	case 'km_4':
	case 'km_1':
	case 'km_2':
	case 'km_3':
	case 'Комната Перехода':
	case 'Комната для новичков':
?>
<table border="0" align="center" cellpadding="0" cellspacing="0">
	<tr align="center" valign="middle">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><div style="width: 90px; height: 60px;" class="clubitem"><?if ($room == 'km_1') echo $flag;?><strong>Зал воинов</strong> (<strong><?echo $info -> roomOnline ('km_1', 'map');?></strong>)</div></td>
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
		<td><div style="width: 90px; height: 60px;" class="clubitem"><?if ($room == 'km_4') echo $flag;?><strong>Будуар</strong> (<strong><?echo $info -> roomOnline ('km_4', 'map');?></strong>)</div></td>
		<td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
		<td>
			<div style="width: 160px; height: 100px;" class="clubitem">
				<table cellpadding="0" cellspacing="0" width="100%" height="100%">
					<tr valign="top"><td align="center" style="font-size: 10px;"><?if ($room == 'castle') echo $flag;?><strong>Бойцовский Клуб</strong> (<strong><?echo $info -> roomOnline ('castle', 'map');?></strong>)</td></tr>
					<tr valign="bottom"><td align="left" style="font-size: 10px;">Переходы:<br><strong>&nbsp;Центральная площадь<br>&nbsp;Этаж 2</strong></td></tr>
				</table>
			</div>
		</td>
		<td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
		<td><div style="width: 90px; height: 60px;" class="clubitem"><?if ($room == 'km_2') echo $flag;?><strong>Зал воинов 2</strong> (<strong><?echo $info -> roomOnline ('km_2', 'map');?></strong>)</div></td>
		<td><img src="img/icon/maparrhl.gif" width="20" height="20" /></td>
		<td>
			<div style="width: 90px; height: 60px;" class="clubitem">
			<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr valign="top"><td align="center" style="font-size: 10px;"><?if ($room == 'Комната Перехода') echo $flag;?><strong>Комната Перехода</strong> (<strong><?echo $info -> roomOnline ('Комната Перехода', 'map');?></strong>)</td></tr>
				<tr valign="bottom"><td align="left" style="font-size: 10px;">Последний рубеж детства</td></tr>
			</table>
			</div>
		</td>
		<td><img src="img/icon/maparrh.gif" width="20" height="20" /></td>
		<td>
			<div style="width: 90px; height: 100px;" class="clubitem">
			<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr valign="top"><td align="center" style="font-size: 10px;"><?if ($room == 'Комната для новичков') echo $flag;?><strong>Комната для новичков</strong> (<strong><?echo $info -> roomOnline ('Комната для новичков', 'map');?></strong>)</td></tr>
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
		<td><div style="width: 90px; height: 60px;" class="clubitem"><?if ($room == 'km_3') echo $flag;?><strong>Зал воинов 3</strong> (<strong><?echo $info -> roomOnline ('km_3', 'map');?></strong>)</div></td>
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
	case 'castle2':
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
		<td><img src="http://img.combats.com/i/maparrv.gif" width="20" height="20" alt="" /></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr align="center" valign="middle">
		<td><div style="width: 120px; height: 80px;" class="clubitem"><?if ($room == 'km_6') echo $flag;?><strong>Рыцарский зал</strong> (<strong><?echo $info -> roomOnline ('km_6', 'map');?></strong>)</div></td>
		<td><img src="http://img.combats.com/i/maparrh.gif" width="20" height="20" alt="" /></td>
		<td><div style="width:120px; height:80px;" class="clubitem"><strong>Таверна -Зеленый Котел-</strong> (<strong>0</strong>)</div></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr align="center" valign="middle">
		<td><img src="http://img.combats.com/i/maparrv.gif" width="20" height="20" alt="" /></td>
		<td>&nbsp;</td>
		<td><img src="http://img.combats.com/i/maparrv.gif" width="20" height="20" alt="" /></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr align="center" valign="middle">
		<td>
			<div style="width: 120px; height: 80px;" class="clubitem">
			<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr valign="top"><td align="center" style="font-size: 10px;"><?if ($room == 'castle2') echo $flag;?><strong>Этаж 2</strong> (<strong><?echo $info -> roomOnline ('castle2', 'map');?></strong>) </td></tr>
				<tr valign="bottom"><td align="left" style="font-size: 10px;">Переходы:<br><strong>&nbsp;Бойцовский Клуб<br>&nbsp;Этаж 3</strong></td></tr>
			</table>
			</div>
		</td>
		<td><img src="http://img.combats.com/i/maparrh.gif" width="20" height="20" /></td>
		<td><div style="width: 120px; height: 80px;" class="clubitem"><?if ($room == 'km_7') echo $flag;?><strong>Торговый Зал</strong> (<strong><?echo $info -> roomOnline ('km_7', 'map');?></strong>)</div></td>
		<td><img src="http://img.combats.com/i/maparrh.gif" width="20" height="20" /></td>
		<td><div style="width: 120px; height: 80px;" class="clubitem"><strong>Комната Знахаря</strong> (<strong>0</strong>)</div></td>
	</tr>
</table>
<?
	break;
}
?>