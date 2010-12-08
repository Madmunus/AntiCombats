<?
session_start();

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$test = new test;

if (empty($login))
	echo "<script>top.location.href='index.php';</script>";

include ("functions.php");

if (ereg ("[<>\\/-]", $act) || ereg ("[<>\\/-]", $log) || ereg ("[<>\\/-]", $boy) || ereg ("[<>\\/-]", $train)) {echo "?!"; exit();}
$act = htmlspecialchars ($act);
$log = htmlspecialchars ($log);
$boy = htmlspecialchars ($boy);

$login = $adb -> _performEscape ($login);
$db = $adb -> selectRow ("SELECT * FROM `characters` WHERE `login` = $login;");
$login = $db['login'];
$orden = $db['orden'];
$orden_d = $db['orden'];
$clan_s = $db['clan_short'];
$clan_f = $db['clan'];
$travm = $db['travm'];
$level = $db['level'];
$room = $db['room'];
$cure_hp = $db['cure_hp'];
$cure_mp = $db['cure_mp'];
$time_to_cure = $cure_hp - time();
$hhh = $db['hp_all'];

$test -> Move ($login, $db);
$test -> Battle ($db);

if ($db['battle'] == 0)
{
	if ($time_to_cure > 0)
	{
		$percent_hp = floor ((100 * $time_to_cure) / 1200);
		$percent = 100 - $percent_hp;
		$hp[0] = floor (($hhh * $percent) / 100);
		$q = $adb -> query ("	UPDATE `characters` 
								SET `hp` = '$hp[0]' 
								WHERE `login` = '$login';
							");
	}
	else
	{
		$hp[0] = $db['hp_all'];
		$q = $adb -> query ("	UPDATE `characters` 
								SET `hp` = '$hp[0]', 
									`cure_hp` = '0' 
								WHERE `login` = '$login';
								");
		$time_to_cure_f = 0;
	}
}

$travm_i = ($travm != 0) ?"<img src='img/travma2.gif' title='Персонаж повежден'>" :"";
$orden_dis = ($orden_d == 1) ?"Белое братство" :(($orden_d == 2) ?"Темное братство" :(($orden_d == 3) ?"Нейтральное братство" :(($orden_d == 4) ?"Алхимик" :(($orden_d == 5) ?"Хаос" :""))));
$clan = (empty($clan_s)) ?"" :"<img src='img/clan/$clan_s.gif' border='0' title='$clan_f'>";
$orden = ($orden_d == 1) ?"<img src='img/orden/pal/$rang.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 2) ?"<img src='img/orden/arm/$rang.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 3) ?"<img src='img/orden/3.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 4) ?"<img src='img/orden/4.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 5) ?"<img src='img/orden/2.gif' width='12' height='15' border='0' title='$orden_dis'>" :""))));
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Refresh" content="30"; url="group_zayavka.php">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<title>Анти Бойцовский Клуб</title>
</head>
<body bgColor="#e2e0e0" leftMargin="5" topMargin="5" marginheight="5" marginwidth="5">
<div align="left">
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="middle" width="50%"><b><font size="2"><?showHPMP($login);?></font></b></td>
		<td align="right" valign="middle">
			<input type="button" value="Обновить" onclick="location.href = 'boy_bot.php';">
			<input type="button" value="Вернуться" onclick="location.href = 'main.php?act=none';">
		</td>
	</tr>
</table>
<table align="center" cellSpacing="1" cellPadding="1" width="100%">
	<tr>
<?
if($room == "Зал воинов" || $room == "Зал воинов 2" || $room == "Зал воинов 3" || $room == "Будуар" || $room == "Рыцарский Зал" || $room == "Комната Знахаря" || $room == "Торговый Зал" || $room == "Зал закона")
{
echo "<td class='m' width='40'>&nbsp;<b>Бои:</b></td>";
echo "<td class='m'><a href='zayavka.php?boy=phisic' class='nick'>Физические</a></td>";
echo "<td class='s'><a href='boy_bot.php' class='nick'>С ботом</a></td>";
echo "<td class='m'><a href='group_zayavka.php' class='nick'>Групповые</a></td>";
echo "<td class='m'><a href='during.php' class='nick'>Текущие</a></td>";
echo "<td class='m'><a href='archive.php' class='nick'>Завершенные</a></td>";
echo "</tr>";
echo "</table>";
}
else
{
echo "<td class='m' width='40'>&nbsp;<b>Бои:</b></td>";
echo "<td class='m'><a href='#' class='nick'>Физические</a></td>";
echo "<td class='m'><a href='#' class='nick'>С ботом</a></td>";
echo "<td class='m'><a href='#' class='nick'>Групповые</a></td>";
echo "<td class='m'><a href='#' class='nick'>Текущие</a></td>";
echo "<td class='m'><a href='#' class='nick'>Завершенные</a></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<center><b>Бои проводятся только в залах Бойцовского клуба!</b></center>";
die ();
}
?>
</div>
<table width="100%"><td align="right"><input type="button" value="Обновить" onclick="location.href = 'boy_bot.php';"></td></table>
<table width="65%" align="center"><td align="center">Бои с ботом - это бои где вы принимаете участие в поединке с ботом вашего уровня. Для того чтобы начать поединок нажмите на кнопку "Начать поединок".<br><small><font color="red">* Бои с ботом проводятся без обмундирования.</font></small></td></table>
<center><br>
<?
if (isset($train))
{
	$q_team1 = $adb -> selectCell ("SELECT `player` FROM `team1` WHERE `player` = '$login';");
	$q_team2 = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `player` = '$login';");
	if ($q_team1 || $q_team2)
	{
		echo "Вы не можете принять этот вызов! Сначала отзовите свою заявку.<br>";
		die ();

	}
	if ($db['hp_all'] / 3 > $db['hp'])
	{
		echo "Вы слишком ослаблены для поединка! Восстановитесь!<br>";
		die ();
	}
	if ($db['level'] > 5)
	{
		echo "К сожалению, эти поединки проводятся до 5-го уровня.";
		die ();
	}
	else
	{
		unwear_full ($login);
		startTrain ($login);
	}
}
else
{
	echo "<input type='button' value=' Начать поединок ' class='but' onClick=\"location.href = '?train=1';\">";
}
?>
</center>