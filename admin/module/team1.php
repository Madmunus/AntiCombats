<?php
// Конвертировано для PHP 8.3 - используется DbSimple Generic вместо mysql_*
defined('AntiBK') or define('AntiBK', true);

// Подключаем необходимые файлы из основной структуры проекта
require_once dirname(__DIR__) . '/../engline/config.php';
require_once dirname(__DIR__) . '/../engline/dbsimple/Generic.php';

// Получаем подключение к базе данных через DbSimple
$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ", $database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

// Получаем список персонажей (заменено с mysql_fetch_array на select)
$characters = $adb->select("SELECT id, login FROM characters");
$login_use = !empty($characters) ? end($characters)['login'] : '';

// Обработка сортировки
if ($sort == "ip") { $s = " order by id"; }
if ($sort == "u") { $s = " order by username"; }

// Получаем данные из таблицы team1 (заменено с mysql_query на select)
$rows = $adb->select("SELECT * FROM team1" . $s);

$i = 0;
foreach ($rows as $row) {
    $i++;
    $t_end = $i % 30;
    
    if ($i == 1 or $t_end == 1) {
        echo "<table width='270' border='1' cellspacing='0' cellpadding='3' align='centr'>
          <tr align='center'>
            <td width='20'><strong>#</strong></td>
            <td width='120' align='center'><strong>ID боя</strong></td>
            <td width='130' align='center'><strong>Логин</strong></td>
            <td width='150' align='center'>Дата подачи</strong></td>
            <td width='170' align='center'><strong>Незнаю</strong></td>
            <td width='180' align='center'><strong>Незнаю</strong></td>
            <td width='190' align='center'><strong>IP подачи</strong></td>
          </tr>";
    }
    
    $id    = $row['battle_id '] ?? '';
    $login = $row['player'] ?? '';
    $login_display = $row['date'] ?? '';
    $last_time = $row['hitted'] ?? '';
    $room = $row['over'] ?? '';
    $room = $row['ip'] ?? '';

    echo " <tr>
        <td align='right'>$i</td>
        <td>$id</td>
        <td><a href='info.php?log=$login' target='_blank'><font color='darkgreen'>$login</font></a></td>
        <td>$login</td>
        <td>$last_time</td>
        <td>$room</td>
        <td>$city</td>
      </tr>";

    if ($t_end == 0) { echo "</table>"; }
}
?>
