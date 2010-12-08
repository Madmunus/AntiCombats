<?
defined('AntiBK') or die ("Доступ запрещен!");

function formatfilesize ($data) 
{
	// bytes
	if( $data < 1024 )			return $data." bytes";
	// kilobytes
	else if( $data < 1024000 )	return round (( $data / 1024 ), 1)." kb";
	// megabytes
	else						return round (( $data / 1024000 ), 1)." mb";
}
function character ($login)
{
	global $adb;
	$db = $adb -> selectRow ("	SELECT 	`login`, 
										`level`, 
										`orden`, 
										`clan`, 
										`block`, 
										`clan_short`, 
										`rang`, 
										`shut`, 
										`travm` 
								FROM `characters` 
								WHERE `login` = '$login';
								");
	$login = $db['login'];
	$level = $db['level'];
	$orden = $db['orden'];
	$clan_f = $db['clan'];
	$clan_s = $db['clan_short'];
	$rang = $db['rang'];
	switch ($orden)
	{
		case 1:
			$orden_dis = "Белое братство";
			$orden_img = "<img src='../img/orden/pal/$rang.gif' width='12' height='15' border='0' title='$orden_dis'>";
		break;
		case 2:
			$orden_dis = "Темное братство";
			$orden_img = "<img src='../img/orden/arm/$rang.gif' width='12' height='15' border='0' title='$orden_dis'>";
		break;
		case 3:
			$orden_dis = "Нейтральное братство";
			$orden_img = "<img src='../img/orden/3.gif' width='12' height='15' border='0' title='$orden_dis'>";
		break;
		case 4:
			$orden_dis = "Алхимик";
			$orden_img = "<img src='../img/orden/4.gif' width='12' height='15' border='0' title='$orden_dis'>";
		break;
		case 5:
			$orden_dis = "Хаос";
			$orden_img = "<img src='../img/orden/2.gif' width='12' height='15' border='0' title='$orden_dis'>";
		break;
		default:
			$orden_dis = "";
			$orden_img = "";
		break;
	}
	$clan = ($clan_s != '') ?"<img src='../img/clan/$clan_s.gif' border='0' title='$clan_f'>" :"";
	$login_link = str_replace (" ", "%20", $login);
	return "$orden_img$clan<b>$login</b> [$level]<a href='../info.php?log=$login_link' target='_blank' onclick='this.blur ();'><img src='../img/inf.gif' border='0' title='Инф. о $login'></a>";
}
?>