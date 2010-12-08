<?php
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

if (empty($log))
	die ("<script>location.href = 'index.php';</script>");

include_once ("engline/config.php");
include_once ("engline/dbsimple/Generic.php");
include_once ("engline/data/data.php");
include_once ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$log = (isset($_GET['log']) && !preg_match('//u', $_GET['log'])) ?iconv("CP1251", "UTF-8", rawurldecode($_GET['log'])) :$_GET['log'];

$top = "Произошла ошибка:<br><br>";
$bot = "<br><br><a href='javascript: window.history.go(-1);'>Назад</a><hr>";

$db = $adb -> selectRow ("	SELECT * 
							FROM `characters` 
							WHERE `login` = ?s", $log) or die ("$top Указанный персонаж не найден.$bot");
$guid = $db['guid'];
$login = $db['login'];
$sex = ($db['sex'] == 'male') ?"Мужской" :"Женский";
$last_time = $db['last_time'];

$form = $adb -> selectRow ("	SELECT 	`name`, 
										`icq`, 
										`hide_icq`, 
										`url`, 
										`town`, 
										`deviz`, 
										`hobie`, 
										`state`, 
										`date` 
								FROM `character_info` 
								WHERE `guid` = ?d", $guid) or die ("$top Дополнительная информация о персонаже не найдена.$bot");
list ($r_name, $icq, $hide_icq, $url, $town, $deviz, $hobie, $state, $date) = array_values ($form);

$stats = $adb -> selectRow ("	SELECT 	`str`, 
										`dex`, 
										`con`, 
										`vit`, 
										`int`, 
										`wis`, 
										`spi` 
								FROM `character_stats` 
								WHERE `guid` = ?d", $guid) or die ("$top Информация о характеристиках персонажа не найдена.$bot");
list ($str, $dex, $con, $vit, $int, $wis, $spi) = array_values ($stats);
$lang = $adb -> selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");

$info = new Info;
$equip = Equip::setguid($guid);
$test = Test::setguid($guid);

$test -> Regen ();

$lose = $db['lose'];
$win = $db['win'];
$draw = $db['draw'];

$exp = $db['exp'];
$level = $db['level'];
$admin_level = $db['admin_level'];
$clan = $db['clan'];
$name_s = $db['clan_short'];
$chin = $db['chin'];
$orden = $db['orden'];
$orden_dis = ($orden == 1) ?"Орден Паладинов - " :(($orden == 2) ?"Армада - " :"");
$status = $db['status'];
$prof = $db['profession'];
$metka = $db['metka'];
$ip = $db['reg_ip'];
$date = ($admin_level > 0) ?"До начала времен" :date ('d.m.y H:i', $date);
$state = ($admin_level > 0) ?"Этого никто не знает" :$adb -> selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $state);
$stat_rang = $db['stat_rang'];
$delo = $db['delo'];
$room = $adb -> selectCell ("SELECT `name` FROM `city_rooms` WHERE `room` = ?s", $db['room']);
$city = $adb -> selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $db['city']);
$online = $adb -> selectCell ("SELECT COUNT(*) FROM `online` WHERE `guid` = ?d", $guid);

$added = $equip -> showStatAddition ('info');
?>
<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico">
<title>Анти Бойцовский Клуб - Информация о <?echo $login;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<script src="scripts/jquery-1.4.3.js" type="text/javascript"></script>
<script src="scripts/main.js" type="text/javascript"></script>
<script src="scripts/show.js" type="text/javascript"></script>
</head>
<body style="margin: 10px; margin-top: 5px;" bgcolor="#e2e0e0">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
<tr valign="top">
	<td align="center" width="227" style="padding-right: 10px;">
<?		echo $info -> character ($guid, "info")."<div style='height: 9px;'></div>";
		$equip -> showEquipment ('info');
		echo "<strong>$city</strong><br>";
		echo ($online) ?"<small>Персонаж сейчас находится в клубе.<br>\"<strong>$room</strong>\"</small>" :(($guid == 3) ?"<small>Персонаж не в клубе</small>" :"<small>Персонаж не в клубе, но был тут:<br>".date ('d.m.y H:i', $last_time)." <img src='img/clok3_2.png' alt='Время сервера' border='0'><br> (".getFormatedTime ($last_time)." назад)</small>");
?>
		<br>
	</td>
	<td align="left" style="padding-top: 10px;"><br>
<?		echo "Сила: <font style='font-weight: bold; color: ".getStatSkillColor ($str, $added['str']).";'>$str</font>".getBraces ($str, $added['str'], 'str')."<br>"
		   . "Ловкость: <font style='font-weight: bold; color: ".getStatSkillColor ($dex, $added['dex']).";'>$dex</font>".getBraces ($dex, $added['dex'], 'dex')."<br>"
		   . "Интуиция: <font style='font-weight: bold; color: ".getStatSkillColor ($con, $added['con']).";'>$con</font>".getBraces ($con, $added['con'], 'con')."<br>"
		   . "Выносливость: <b>$vit</b><br>";
		echo ($level >= 4) ?"Интеллект: <font style='font-weight: bold; color: ".getStatSkillColor ($int, $added['int']).";'>$int</font>".getBraces ($int, $added['int'], 'int')."<br>" :"";
		echo ($level >= 6) ?"Мудрость: <b>$wis</b><br>" :"";
		echo ($level >= 10) ?"Духовность: <b>$spi</b><br>" :"";
		echo "<hr align='left' width='300' size='1'>"
		   . "<small>Уровень: $level<br>"
		   . "Побед: $win<br>"
		   . "Поражений: $lose<br>"
		   . "Ничьих: $draw<br>";
		echo ($prof) ?"Профессия: <b>".$lang['prof_'.$prof]."</b><br>" :"";
		echo ($clan) ?"Клан: <strong><a href='clan_inf.php?clan=$name_s' class='us2' target='_blank' style='font-size: 10px; color: #003388;'>$clan</a> - $chin</strong><br>" :"";
		echo ($orden) ?"<strong>$orden_dis$stat_rang</strong><br>" :(($status) ?"Статус: <strong>$status</strong><br>" :"");
		echo ($state) ?"Место рождения: <strong>$state</strong><br>" :"";
		echo ($date) ?"Дата рождения персонажа: $date</small><br>" :"";
		echo "<hr align='left' width='300' size='1'>";
if ($db['dealer'])
{
	switch ($db['dealer'])
	{
		case 1:
			$d_i = "bronz";
			$d_d = "Бронзовый диллер.";
		break;
		case 2:
			$d_i = "silver";
			$d_d = "Серебрянный диллер.";
		break;
		case 3:
			$d_i = "gold";
			$d_d = "Регистрированный алхимик.";
		break;
	}
	echo "<img src='img/dealer_$d_i.gif' width='35' height='24' alt='$d_d<br>Персонаж имеет право продавать услуги Анти Бойцовского Клуба.' border='0'>";
}
$info -> showInfDetail ($guid);
?>
	</td>
    <td align="center" valign="top"><br><br>
<?
if ($db['admin_level'] < 1)
{
	echo ($metka) ?"<br><b>$metka</b> - пройдена проверка." :"";
	echo ($delo) ?"<br><b>Личное дело:</b><br>$delo" :"";
}
?>
    </td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top">
<?
$rows = $adb -> select ("	SELECT 	`c`.`id`, 
									`c`.`gift_author` 
							FROM `character_inventory` AS `c` 
							LEFT JOIN `item_template` AS `i` 
							ON `c`.`item_template` = `i`.`entry` 
							WHERE 	`c`.`guid` = ?d 
									and `i`.`section` = 'thing'
									and `i`.`type` = 'medal'
									and `c`.`wear` = '0'", $guid);
foreach ($rows as $dat_t)
{
	$item_id = $dat_t['id'];
	$gift_author = $dat_t['gift_author'];
	$obj_data = $adb -> selectRow ("SELECT 	`name`, 
											`img`, 
											`msg` 
									FROM `medal` 
									WHERE `id` = ?d", $item_id);
	list ($name, $img, $msg) = array_values ($obj_data);
	echo "<img src='$img' alt='$name<br>$msg<br>от $gift_author'>&nbsp";
}
?>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top">
			<hr align="left" size="1">
			<h3>Анкетные данные</h3>
<?
			echo "Имя: $r_name<br>";
			echo "Пол: $sex";
			echo ($icq && !$hide_icq) ?"<br>ICQ: $icq" :"";
			echo ($url) ?"<br>Домашняя страница: <a href='$url' target='_blank' class='nick'>$url</a>" :"";
			echo ($town) ?"<br>Город: $town" :"";
			echo ($deviz) ?"<br>Девиз: <code>$deviz</code>" :"";
			echo ($hobie) ?"<br>Увлечения / хобби:<br><code>".str_replace (array("\'", '\&quot;'), array("'", '"'), $hobie)."</code>" :"";
?>
		</td>
	</tr>
</table>
<div id="mmoves" class="mmoves"></div>
</body>
</html>