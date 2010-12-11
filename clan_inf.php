<?
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$info = new info;

$db = $adb -> selectRow ("    SELECT     `name`, 
                                    `glava`, 
                                    `name_short` 
                            FROM `clan` 
                            WHERE `name_short` = ?s", $clan);
$top = "Произошла ошибка:<br><br><span class='err'>";
$bot = "</span><br><br><a href='javascript: window.history.go(-1);' class='us2'>Назад</a><hr>";
$name_s = $db['name_short'];
$name = $db['name'];
$glava = $db['glava'];
if (empty($clan))     die("$top Неверный запрос.$bot");
else if (!$name_s)    die("$top Нет информации о клане $name_s.$bot");

$orden = $info -> character ($glava, 'turn');
?>
<html>
<head>
<title>Анти Бойцовский Клуб - Информация о клане <?echo $name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
</head>
<body topMargin="5" rightMargin="0" bottomMargin="0" bgcolor="#dedede">
<table width="100%" cellspacing="0" cellpadding="0">
    <tr> 
        <td width="100%" align="center" valign="top" colspan="2">
<?
            echo "Информация о клане:  <b>\"$name\"</b>";
            echo "<table width='100%' cellspacing='0' cellpadding='0'><tr>";
            echo "<td width='50%'>Уровень: <b>0</b></td>";
            echo "<td>Знак клана:  <img src='img/clan/$name_s.gif' border='0' title='$name_s'> ";
            echo (!empty($orden)) ?"Склонность: $orden" :"";
            echo "</td></tr>";
            echo "<tr>";
            echo "<td width='50%'>Рейтинг: <b>0</b></td>";
            echo "<td>Тип правления: <b><font color='green'>Демократия</font></b></td>";
            echo "</tr></table><hr>";
?>
        </td>
    </tr>
    <tr>
        <td width="50%" valign="top">
<?
            echo "Глава клана: {$info -> character ($glava)}";
?>
        </td>
        <td width="50%" valign="top">
            Бойцы клана:<br>
<?
    $rows = $adb -> selectCol ("SELECT `login` 
                                FROM `characters` 
                                WHERE `clan_short` = ?s 
                                ORDER BY `exp` DESC", $name_s); 
    foreach ($rows as $num => $clan_player)
        echo $info -> character ($clan_player)."<br>";
    echo "Всего: <b>".count ($rows)."</b>";
?>
        </td>
    </tr>
</table>
</body>
</html>