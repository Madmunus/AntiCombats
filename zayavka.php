<?
session_start();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

if (empty($_SESSION['guid']))
	die ("<script>top.location.href = 'index.php';</script>");
else
  $guid = $_SESSION['guid'];

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/data/data.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$test = Test::setguid($guid);

$act = htmlspecialchars ($act);
$boy = htmlspecialchars ($boy);
$battle_type = htmlspecialchars ($battle_type);
$timeout = htmlspecialchars ($timeout);
$log = htmlspecialchars ($log);
$ac = htmlspecialchars ($ac);
$accept = htmlspecialchars ($accept);
$accept2 = htmlspecialchars ($accept2);
$otkaz = htmlspecialchars ($otkaz);
$id = htmlspecialchars ($id);
$denie = htmlspecialchars ($denie);

$login = $adb -> _performEscape ($login);
$db = $adb -> selectrow ("SELECT * FROM `characters` WHERE `login` = $login;");
$login = $db['login'];
$orden_d = $db['orden'];
$clan_s = $db['clan_short'];
$clan_f = $db['clan'];
$travm = $db['travm'];
$level = $db['level'];
$room = $db['room'];
$rang = $db['rang'];
$city_game = $db['city_game'];
$travm_i = ($travm != 0) ?"<img src='img/travma2.gif' title='Персонаж поврежден'>" :"";
$orden_dis = ($orden_d == 1) ?"Белое братство" :(($orden_d == 2) ?"Темное братство" :(($orden_d == 3) ?"Нейтральное братство" :(($orden_d == 4) ?"Алхимик" :(($orden_d == 5) ?"Хаос" :""))));
$clan = (empty($clan_s)) ?"" :"<img src='img/clan/$clan_s.gif' border='0' title='$clan_f'>";
$orden = ($orden_d == 1) ?"<img src='img/orden/pal/$rang.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 2) ?"<img src='img/orden/arm/$rang.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 3) ?"<img src='img/orden/3.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 4) ?"<img src='img/orden/4.gif' width='12' height='15' border='0' title='$orden_dis'>" :(($orden_d == 5) ?"<img src='img/orden/2.gif' width='12' height='15' border='0' title='$orden_dis'>" :""))));

$test -> Move ();
$test -> Battle ();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Refresh" content="30"; url="zayavka.php">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<title>Анти Бойцовский Клуб</title>
</head>
<body bgColor="#e2e0e0" leftMargin="5" topMargin="5" marginheight="5" marginwidth="5">
<?
$look_m = $adb -> selectCell ("SELECT `login` FROM `miners` WHERE `login` = '$login';");
if ($look_m['login'] == $login)
    die ("Вы добываете ресурсы. Вы не можете передвигаться сейчас.");
$cure_hp = $db['cure_hp'];
$cure_mp = $db['cure_mp'];
$time_to_cure = $cure_hp - time();
$hhh = $db['hp_all'];
if ($db['battle'] == 0)
{
    if ($time_to_cure > 0)
    {
        $percent_hp = floor ((100 * $time_to_cure) / 1200);
        $percent = 100 - $percent_hp;
        $hp[0] = floor (($hhh * $percent) / 100);
        $q = $adb -> query ("    UPDATE `characters` 
                                SET `hp` = '$hp[0]' 
                                WHERE `login` = '$login';
                            ");
    }
    else
    {
        $hp[0] = $db['hp_all'];
        $q = $adb -> query ("    UPDATE `characters` 
                                SET `hp` = '$hp[0]', 
                                    `cure_hp` = '0' 
                                WHERE `login` = '$login';
                            ");
        $time_to_cure_f = 0;
    }
}
$md1 = $adb -> select ("SELECT `battle_id` FROM `team1` WHERE `player` = '$login';");
$countrows = count ($md1);

for ($i = 0; $i < $countrows; $i++)
{
    $m = $md1[$i]['battle_id'];
    $opponent = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `battle_id` = '$m';");
    $pl1 = str_replace (" ", "%20", $opponent);
    $t = 1;
}
$md2 = $adb -> select ("SELECT `battle_id` FROM `team2` WHERE `player` = '$login';");
$countrows = count ($md2);

for ($i = 0; $i < $countrows; $i++)
{
    $m = $md2[$i]['battle_id'];
    $opponent = $adb -> selectCell ("SELECT `player` FROM `team1` WHERE `battle_id` = '$m';");
    $pl1 = str_replace (" ", "%20", $opponent);
    $t = 2;
}

$dat = $adb -> select ("SELECT * FROM `zayavka`;");
$countrows = count ($dat);

for ($i = 0; $i < $countrows; $i++)
{
    $cr = $dat[$i]['creator'];
    $player = $adb -> selectCell ("SELECT `login` FROM `characters` WHERE `id` = '$cr';");
    $search = $adb -> selectCell ("SELECT `login` FROM `online` WHERE `login` = '$player';");
    $online = ($search) ?1 :0;
    if ($online == 0)
    {
        $del = $adb -> query ("DELETE FROM `zayavka` WHERE `creator` = '$cr';");
        $del1 = $adb -> query ("DELETE FROM `team1` WHERE `battle_id` = '$cr';");
        $del2 = $adb -> query ("DELETE FROM `team2` WHERE `battle_id` = '$cr';");
    }
    if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 1)
        $zayavka_status = "awaiting";
    if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 2 && $t == 1)
        $zayavka_status = "confirm_mine";
    if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 2 && $t == 2)
        $zayavka_status = "confirm_opp";
    if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 3)
        gobattle ($login);
}
if (empty($zayavka_status))
    $zayavka_status = "no";
?>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left" valign="middle" width="50%"><b><font size="2"><?showHPMP ($login);?></font></b></td>
        <td align="right" valign="middle">
            <input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';">
            <input type="button" value="Вернуться" onclick="location.href = 'main.php';">
        </td>
    </tr>
</table>
<table align="center" cellSpacing="1" cellPadding="1" width="100%">
    <tr>
<?
if ($room == "Зал воинов" || $room == "Зал воинов 2" || $room == "Зал воинов 3" || $room == "Будуар" || $room == "Рыцарский Зал" || $room == "Комната Знахаря" || $room == "Торговый Зал" || $room == "Зал закона")
{
    $class = (empty($boy) || $boy == "") ?"m" :"s";
    $msg = (empty($boy) || $boy == "") ?"<br><br><center><b>Выберите раздел</b></center>" :"";
    echo "<td class='m' width='40'>&nbsp;<b>Бои:</b></td>";
    echo "<td class='$class'><a href=\"zayavka.php?boy=phisic\" class='nick'>Физические</a></td>";
    echo "<td class='m'><a href=\"boy_bot.php\" class='nick'>С ботом</a></td>";
    echo "<td class='m'><a href=\"group_zayavka.php\" class='nick'>Групповые</a></td>";
    echo "<td class='m'><a href=\"during.php\" class='nick'>Текущие</a></td>";
    echo "<td class='m'><a href=\"archive.php\" class='nick'>Завершенные</a></td>";
    echo "</tr>";
    echo "</table>$msg";
    if (empty($boy) || $boy == "")
        die ();
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
/*=====status disc=========*/
/*1 - ожидает вызова       */
/*2 - ожидает подтверждения*/
/*3 - принята              */
/*=========================*/
switch ($act)
{
/*подать заявку*/
    case 'podat':
        if ($db['hp_all'] / 3 > $db['hp'])
        {
            echo "Вы слишком ослаблены для поединка! Восстановитесь!<br>";
            echo "<a href=\"history.back(-1);\" class='us2'>назад</a>";
            die ();
        }
        $st1 = $adb -> selectCell ("SELECT `player` FROM `team1` WHERE `player` = '$login';");
        $st2 = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `player` = '$login';");
        if ($st1 || $st2)
        {
            echo "Вы не можете принять эту заявку! Сначала отзовите свою!<br>";
            echo "<a href='zayavka.php?boy=phisic' class='us2'>Назад</a>";
            die ();
        }
        if (empty($ip))
            $ip = ($_SERVER['HTTP_X_FORWARDED_FOR']) ?$_SERVER['HTTP_X_FORWARDED_FOR'] :$_SERVER['REMOTE_ADDR'] ;

        $date = date ("d.m.y H:i");
        $time = date("H:i");
        $mine_id = $db['id'];
        $query = $adb -> query ("    INSERT INTO `zayavka` (status,type,date,timeout,creator) 
                                    VALUES ('1', '$battle_type', '$time', '$timeout', '$mine_id');");
        $query = $adb -> query ("    INSERT INTO `team1` (player,ip,battle_id,hitted,over) 
                                    VALUES ('$login', '$ip', '$mine_id', '0', '0')");
        $query = $adb -> query ("    UPDATE `characters` 
                                    SET `zayavka` = '1' 
                                    WHERE `login` = '$login';
                                ");
        $zayavka_c_m = 0;
        session_register ('zayavka_c_m');
        echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
    break;
/*принять вызов*/
    case 'a':
        if($db['hp_all'] / 3 > $db['hp'])
        {
            echo "Вы слишком ослаблены для поединка! Восстановитесь!<br>";
            echo "<a href=\"history.back(-1);\" class='us2'>Назад</a>";
            die();
        }
        $st1 = $adb -> selectCell ("SELECT `player` FROM `team1` WHERE `player` = '$login';");
        $st2 = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `player` = '$login';");
        if ($st1 || $st2)
        {
            echo "Вы не можете принять этот вызов! Сначала отзовите свою!<br>";
            echo "<a href='zayavka.php?boy=phisic' class='us2'>Вернуться</a>";
            die ();
        }
        $q = $adb -> selectCell ("SELECT `creator` FROM `zayavka` WHERE `creator` = '$id';");
        if(empty($ip))
            $ip = ($_SERVER['HTTP_X_FORWARDED_FOR']) ?$_SERVER['HTTP_X_FORWARDED_FOR'] :$_SERVER['REMOTE_ADDR'] ;
        if($q)
        {
            $zayavka_c_o = 0;
            session_register ('zayavka_c_o');
            $d2 = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `battle_id` = '$id';");
            $d = $adb -> selectCell ("SELECT `player` FROM `team1` WHERE `battle_id` = '$id';");
            if ($d2 == '' || empty($d2))
            {
                $q = $adb -> query ("    INSERT INTO `team2` (player,ip,battle_id,hitted,over) 
                                        VALUES ('$login', '$ip', '$id', '0', '0');");
                $s = $adb -> query ("    UPDATE `zayavka` 
                                        SET `status` = '2' 
                                        WHERE `creator` = '$id';
                                    ");
                if ($q)
                {
                    $s11 = $adb -> query ("    UPDATE `characters` 
                                            SET `zayavka` = '1' 
                                            WHERE `login` = '$d';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
    break;
/*отозвать заявку*/
    case 'recall':
        $s = $adb -> selectCell ("SELECT `battle_id` FROM `team1` WHERE `player` = '$login';");
        if ($s)
        {
            $dd = $adb -> selectCell ("SELECT `status` FROM `zayavka` WHERE `creator` = '$cr';");
            if ($dd != 2)
            {
                $query = $adb -> query ("DELETE FROM `zayavka` WHERE `creator` = '$s';");
                $s2 = $adb -> query ("DELETE FROM `team1` WHERE `battle_id` = '$s';");
                if ($query)
                {
                    $s11 = $adb -> query ("    UPDATE `characters` 
                                            SET `zayavka` = '0' 
                                            WHERE `login` = '$login';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
    break;
/*отозвать свою заявку*/
    case 'recallbattle':
        $q = $adb -> selectCell ("SELECT `battle_id` FROM `team2` WHERE `player` = '$login';");
        if ($q)
        {
            $cr = $q;
            $dd = $adb -> selectCell ("SELECT `status` FROM `zayavka` WHERE `creator` = '$cr';");
            if ($dd != 3)
            {
                $query = $adb -> query ("    UPDATE `zayavka` 
                                            SET `status` = '1' 
                                            WHERE `creator` = '$cr';
                                        ");
                $ssd = $adb -> query ("DELETE FROM `team2` WHERE `battle_id` = '$cr';");
                if ($query)
                {
                    $p = $adb -> selectCell ("SELECT `player` FROM `team1` WHERE `battle_id` = '$cr';");
                    $s11 = $adb -> query ("    UPDATE `characters` 
                                            SET `zayavka` = '0' 
                                            WHERE `login` = '$p';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
    break;
/*подтвердить заявку*/
    case 'confirm':
        if ($denie)
        {
            $s = $adb -> selectCell ("SELECT `battle_id` FROM `team1` WHERE `player` = '$login';");
            if ($S)
            {
                $query = $adb -> query ("    UPDATE `zayavka` 
                                            SET `status` = '1' 
                                            WHERE `creator` = '$s';
                                        ");
                $op = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `battle_id` = '$s';");
                $s2 = $adb -> query ("DELETE FROM `team2` WHERE `battle_id` = '$s';");
                if ($query)
                {
                    $_SESSION['zayavka_c_m'] = 0;
                    $s11 = $adb -> query ("    UPDATE `characters` 
                                            SET `zayavka` = '0' 
                                            WHERE `login` = '$op';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
        if ($accept)
        {
            $data = $adb -> selectrow ("SELECT * FROM `team1` WHERE `player` = '$login';");
            if ($data)
            {
                $tt = $data['type'];
                $cr = $data['battle_id'];
                $zz = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `battle_id` = '$cr';");
                if ($zz)
                {
                    $q = $adb -> query ("    INSERT INTO `battles` (type,status,creator_id) 
                                            VALUES('$tt', 'during', '$cr');");
                    if ($q)
                    {
                        $op = $adb -> selectCell ("SELECT `player` FROM `team2` WHERE `battle_id` = '$cr';");
                        $sql_rm = $adb -> query ("    UPDATE `zayavka` 
                                                    SET `status` = '3' 
                                                    WHERE `creator` = '$cr';
                                                    ");
                        $s1 = $adb -> query ("    UPDATE `characters` 
                                                SET `zayavka` = '2' 
                                                WHERE `login` = '$login';
                                                ");
                        $s11 = $adb -> query ("    UPDATE `characters` 
                                                SET `zayavka` = '2' 
                                                WHERE `login` = '$op';
                                                ");
                        gobattle ($login);
                    }
                }
            }
        }
    break;
}
if ($zayavka_status == "no")
{
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="50%" align="left" valign="top">
            <form name="boy" action="zayavka.php?boy=phisic&act=podat" method="post">
            <table cellSpacing="0" cellPadding=0>
                <tbody>
                <tr>
                    <td>
                        <form name="boy" action="zayavka.php?boy=phisic&act=podat" method="post">
                        <fieldset>
                            <legend><b>Подать заявку на бой</b></legend>
                            Таймаут 
                            <select name="timeout">
                                <option value="3">3 мин.
                                <option value="4">4 мин.
                                <option value="5">5 мин.
                                <option value="7">7 мин.
                                <option value="10" selected>10 мин.
                            </select> 
                            Тип боя 
                            <select name="battle_type">
                                <option value="1" selected>с оружием
                                <option value="2">кулачный
                            </select> 
                            <input type="submit" value="Подать заявку">&nbsp; 
                        </fieldset>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
    </tr>
</table>
<?
}
else if ($zayavka_status == "awaiting")
{
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="50%" align="left" valign="top">
            <form name="otziv" action="zayavka.php?boy=phisic&act=recall" method="post">
                Вы уже подали заявку на бой.
                <input type="hidden" name="otziv" value="1">
                <input type="submit" value="Отозвать заявку">
            </form>
        </td>
        <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
    </tr>
</table>
<?
}
else if ($zayavka_status == "confirm_mine")
{
    $op_level = $adb -> selectCell ("SELECT `level` FROM `characters` WHERE `login` = '$opponent';");
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="100%" align="left" valign="top">
            <table border="0" width="100%">
                <tr>
                    <td>
                        <form name="accept" action="zayavka.php?boy=phisic&act=confirm" method="post">
                            <font color="red"><b>Персонаж </b></font><?echo "<b>$opponent</b> [$op_level]<a href='info.php?log=$pl1' target='_blank'><img src='img/inf.gif' border='0' title='Информация о персонаже $opponent'></a>";?><font color="red"><b> принял ваш вызов!</b></font>
                            <input type="hidden" name="ac" value="1">
                            <input type="submit" name="accept" value="Битва!">
                            <input type="hidden" name="ac" value="2">
                            <input type="submit" name="denie" value="Отказать">
                        </form>
                    </td>
                </tr>
            </table>
        </td>
        <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
    </tr>
</table>
<?
}
else if ($zayavka_status == "confirm_opp")
{
    $op_level = $adb -> selectCell ("SELECT `level` FROM `characters` WHERE `login` = '$opponent';");
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td width="100%" align="left" valign="top">
            <table border="0" width="100%">
                <tr>
                    <td>
                        <form name="accept2" action="zayavka.php?boy=phisic&act=recallbattle" method="post">
                            <font color="red"><b>Ожидается подтверждение боя от персонажа</b></font> <?echo "<b>$opponent</b> [$op_level]<a href='info.php?log=$pl1' target='_blank'><img src='img/inf.gif' border='0' title='Информация о персонаже $opponent'></a>";?>
                            <input type="hidden" name="otkaz" value="1">
                            <input type="submit" value="Отозвать вызов">
                        </form>
                    </td>
                </tr>
            </table>
        </td>
        <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
    </tr>
</table>
<?
}
echo "<form name='prinatie' action='zayavka.php?boy=phisic&act=a' method='POST'><br>";
$data_p = $adb -> select ("SELECT * FROM `zayavka` WHERE `type` = '1' or `type` = '2' ORDER BY `date` DESC;");
$countrows = count ($data_p);
if ($countrows != 0)
    echo "<input type='submit' value='Принять вызов'><br>";
for ($i = 0; $i < $countrows; $i++)
{
    if ($data_p[$i]['status'] != 3)
    {
        $creator = $data_p[$i]['creator'];
        $date = $data_p[$i]['date'];
        $timeout = $data_p[$i]['timeout'];
        $battle_type = $data_p[$i]['type'];
        $id = $data_p[$i]['creator'];

        $t1 = $adb -> select ("SELECT `player` FROM `team1` WHERE `battle_id` = '$creator';");
        for ($h = 0; $h < $countrows; $h++)
        {
            $p1 = $t1[$h]['player'];
            $p1_lev = $adb -> selectCell ("SELECT `level` FROM `characters` WHERE `login` = '$p1';");
            $pl1 = str_replace (" ", "%20", $p1);
        }

        $t2 = $adb -> select ("SELECT `player` FROM `team2` WHERE `battle_id` = '$creator';");
        for ($h = 0; $h < $countrows; $h++)
        {
            $p2 = $td2['player'];
            $p2_lev = $adb -> selectCell ("SELECT `level` FROM `characters` WHERE `login` = '$p2';");
            $pl12 = str_replace (" ", "%20", $p2);
        }

        if ($p2 == '')
            $rad = "<input type='radio' name='id' value='$id'>";
        else
        {
            $rad = "<input type='radio' name='id' value='$id' disabled>";
            $p2 = "против <font color='black'><b>$p2</b> [$p2_lev]<a href='info.php?log=$pl12' target='_blank'><img src='img/inf.gif' border='0'></a>";
        }
        switch ($battle_type)
        {
            case 1:    $battle_type = "<img src='img/icon/fighttype1.gif' width='20' height='20' title='Физический бой'>";
            break;
            case 2:    $battle_type = "<img src='img/icon/fighttype5.gif' width='20' height='20' title='Кулачный бой'>";
            break;
        }
        if ($p1 == $db['login'])
            $rad = "<input type='radio' name='id' value='$id' disabled>";
        $p1 = "<font color='black'><b>$p1</b> [$p1_lev]</font><a href='info.php?log=$pl1' target='_black'><img src='img/inf.gif' border='0'></a>";
        echo "$rad <span class='date'>$date</span> $p1 $p2 ";
        echo "тип боя: $battle_type ";
        echo "(таймаут $timeout мин.)";
        echo "<br>";
    }
}
if ($countrows > 1)
    echo "<input type='submit' value='Принять вызов'><br>";
echo "</form>";
?>