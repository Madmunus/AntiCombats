<?php
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

$guid = $adb->selectCell ("SELECT `guid` FROM `characters` WHERE `login` = ?s", $log) or die ("$top Указанный персонаж не найден.$bot");

$char = Char::initialization($guid, $adb);

$char->test->Guid ('game');
$char->test->Prision ();
$char->test->Shut ();
$char->test->Travm ();
$char->test->Regen ();

$char_db = $char->getChar ('char_db', '*');
$char_stats = $char->getChar ('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'spi');
$char_info = $char->getChar ('char_info', 'name', 'icq', 'hide_icq', 'url', 'town', 'deviz', 'hobie', 'state', 'date');

if (!$char_stats)
  die ("$top Информация о характеристиках персонажа не найдена.$bot");
if (!$char_info)
  die ("$top Дополнительная информация о персонаже не найдена.$bot");
ArrToVar ($char_db);
ArrToVar ($char_info);

$lang = $char->getLang ();

$sex = ($sex == 'male') ?"Мужской" :"Женский";
$orden_dis = ($orden == 1) ?"Орден Паладинов - " :(($orden == 2) ?"Армада - " :"");
$date = ($admin_level > 0) ?"До начала времен" :date ('d.m.y H:i', $date);
$state = ($admin_level > 0) ?"Этого никто не знает" :$adb->selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $state);
$room = $char->city->getRoom ($room, $city, 'name');
$city = $adb->selectCell ("SELECT `name` FROM `server_cities` WHERE `city` = ?s", $city);
$online = $adb->selectCell ("SELECT COUNT(*) FROM `online` WHERE `guid` = ?d", $guid);

$char->showStatAddition ('info');
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
<?  echo $char->info->character ('info', $guid)."<div style='height: 9px;'></div>";
    $char->equip->showEquipment ('info');
    echo "<strong>$city</strong><br>";
    echo ($online) ?"<small>Персонаж сейчас находится в клубе.<br>\"<strong>$room</strong>\"</small>" :(($admin_level > 0) ?"<small>Персонаж не в клубе</small>" :"<small>Персонаж не в клубе, но был тут:<br>".date ('d.m.y H:i', $last_time)." <img src='img/clok3_2.png' alt='Время сервера' border='0'><br> (".getFormatedTime ($last_time)." назад)</small>");
?>
    <br>
  </td>
  <td align="left" style="padding-top: 10px;"><br>
<?  foreach ($behaviour as $key => $min_level)
    {
      if ($level < $min_level)
        continue;
      
      $stat_text = (in_array ($key, array ('str', 'dex', 'con', 'int'))) ?"<font style='color: ".getStatSkillColor ($char_stats[$key], $added[$key]).";'>%s</font></b>".getBraces ($char_stats[$key], $added[$key]) :"%s</b>";
      printf ($lang[$key]." <b>".$stat_text."<br>", $char_stats[$key]);
    }
    echo "<hr align='left' width='300' size='1'>"
       . "<small>$lang[level] $level<br>"
       . "$lang[wins] <a href='stat.php' class='nick' style='font-size: 10px;'>$win</a><br>"
       . "$lang[loses] $lose<br>"
       . "$lang[draws] $draw<br>";
    echo ($profession) ?"$lang[prof] <b>".$lang['prof_'.$profession]."</b><br>" :"";
    echo ($clan) ?"Клан: <strong><a href='clan_inf.php?clan=$clan_short' class='nick' target='_blank' style='font-size: 10px;'>$clan</a> - $chin</strong><br>" :"";
    echo ($orden) ?"<strong>$orden_dis$stat_rang</strong><br>" :(($status) ?"Статус: <strong>$status</strong><br>" :"");
    echo ($state) ?"Место рождения: <strong>$state</strong><br>" :"";
    echo ($date) ?"Дата рождения персонажа: $date</small><br>" :"";
    echo "<hr align='left' width='300' size='1'>";
    if ($dealer)
    {
      switch ($dealer)
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
$char->info->showInfDetail ($guid);
?>
  </td>
  <td align="center" valign="top"><br><br>
<?
if ($admin_level < 1)
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
$rows = $adb->select ("SELECT `c`.`id`, 
                                `c`.`gift_author` 
                         FROM `character_inventory` AS `c` 
                         LEFT JOIN `item_template` AS `i` 
                         ON `c`.`item_template` = `i`.`entry` 
                         WHERE `c`.`guid` = ?d 
                           and `i`.`section` = 'thing' 
                           and `i`.`type` = 'medal' 
                           and `c`.`wear` = '0'", $guid);
foreach ($rows as $dat_t)
{
  $item_id = $dat_t['id'];
  $gift_author = $dat_t['gift_author'];
  $obj_data = $adb->selectRow ("SELECT `name`, 
                                         `img`, 
                                         `msg` 
                                  FROM `medal` 
                                  WHERE `id` = ?d", $item_id);
  list ($g_name, $img, $msg) = array_values ($obj_data);
  echo "<img src='$img' alt='$g_name<br>$msg<br>от $gift_author'>&nbsp";
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
      echo "Имя: $name<br>";
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