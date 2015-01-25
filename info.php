<?
define('AntiBK', true);

include_once("engline/config.php");
include_once("engline/data.php");
include_once("engline/dbsimple/Generic.php");
include_once("engline/functions/functions_info.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$log = getVar('log', '', 1);
$log = (!preg_match('//u', $log)) ?iconv("CP1251", "UTF-8", rawurldecode($log)) :$log;
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <title></title>
  <link rel="SHORTCUT ICON" href="img/favicon.ico" />
  <link rel="StyleSheet" href="styles/style.css" type="text/css" />
  <link rel="StyleSheet" href="styles/info.css" type="text/css" />
  <script src="scripts/jquery.js" type="text/javascript"></script>
  <script src="scripts/scripts.js" type="text/javascript"></script>
  <script src="scripts/info.js" type="text/javascript"></script>
  <script src="scripts/show.js" type="text/javascript"></script>
</head>
<body>
<?
if (empty($log))
  error('Указанный персонаж не найден...');

$guid = $adb->selectCell("SELECT `guid` FROM `characters` WHERE `login` = ?s", $log) or error('Указанный персонаж не найден...');

echoScript("$('title').html('Информация о $log');");

$info = Info::initialization($guid, $adb);

$info->Guid();
$info->Prison();
$info->Shut();
$info->Regen();
$info->Online();

$char_db = $info->getChar('char_db', '*');
$char_stats = $info->getChar('char_stats', 'str', 'dex', 'con', 'vit', 'int', 'wis', 'spi');
$char_info = $info->getChar('char_info', 'name', 'icq', 'hide_icq', 'url', 'town', 'motto', 'hobie', 'state', 'date');
ArrToVar($char_db);
ArrToVar($char_info);

$lang = $info->getLang();

$sex = ($sex) ?"Женский" :"Мужской";
$date = ($admin_level > 0) ?"До начала времен" :date('d.m.y H:i', $date);
$state = ($admin_level > 0) ?"Этого никто не знает" :$info->getCity($state, 'name');
$room = $info->getRoom($room, $city, 'name');
$city = $info->getCity($city, 'name');
$online = $adb->selectCell("SELECT COUNT(*) FROM `online` WHERE `guid` = ?d", $guid);

$info->showStatAddition();
?>
<div class="alignlogo"><img src="img/info/logo.png"><br><br></div>
<table class="align0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="topleftcorner"><img src="img/info/x.gif"></td>
    <td class="topcenterline" valign="bottom"><img src="img/info/x.gif"></td>
    <td class="toprightcorner"><img src="img/info/x.gif"></td>
  </tr>
  <tr>
    <td class="middleleftline"><img src="img/info/x.gif"></td>
    <td class="middlecenterarea">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="24" align="left" background="img/info/menu_fon1.png">
          <table width="417" border="0" cellspacing="0" cellpadding="0" id="tab">
            <tr>
              <td width="2"><img width="2" height="24" src="img/info/menu_rozr1.png"></td>
              <td width="180" align="center" class="tab_title_active bgalign0">Общие сведения</td>
              <td width="2"><img width="2" height="24" src="img/info/menu_rozr1.png"></td>
              <td width="104" align="center" class="tab_title"><a class="menu" href="">Подарки</a></td>
              <td width="2"><img width="2" height="24" src="img/info/menu_rozr1.png"></td>
              <td width="106" align="center" class="tab_title"><a class="menu" href="">Подвиги</a></td>
              <td width="2"><img width="2" height="24" src="img/info/menu_rozr1.png"></td>
            </tr>
          </table>
        </td></tr>
      </table>
      <table width="100%" border="0" cellpadding="1" cellspacing="2">
      <tr valign="top">
        <td align="center" width="227" style="padding-right: 10px;">
<?        $info->showCharacter();
          echo "<strong>$city</strong><br>";
          echo ($online) ?"<small>Персонаж сейчас находится в клубе.<br>\"<strong>$room</strong>\"</small>" :"<small>Персонаж не в клубе, но был тут:<br>".date('d.m.y H:i', $last_time)." <img src='img/clok3_2.png' alt='Время сервера' border='0'><br> (".getFormatedTime($last_time)." назад)</small>";
          echo "</td>";
          echo "<td align='left' style='padding-top: 7px;'><br>";
          foreach ($behaviour as $key => $min_level)
          {
            if ($level < $min_level)
              continue;
            
            $stat_text = (in_array($key, array('str', 'dex', 'con', 'int'))) ?"<font style='color: ".getColor($char_stats[$key], $added[$key]).";'>%s</font></b>".getBraces($char_stats[$key], $added[$key]) :"%s</b>";
            printf($lang[$key]." <b>".$stat_text."<br>", $char_stats[$key]);
          }
          echo "<hr align='left' width='300' size='1'>";
          echo "<small>$lang[level] $level<br>";
          echo ($level > 3) ?"$lang[wins] <a href='stat.php' class='nick' style='font-size: 10px;'>$win</a><br>" :"$lang[wins] $win<br>";
          echo "$lang[loses] $lose<br>";
          echo "$lang[draws] $draw<br>";
          echo ($clan) ?"Клан: <strong><a href='clan_inf.php?clan=$clan_short' class='nick' target='_blank' style='font-size: 10px;'>$clan</a> - $chin</strong><br>" :"";
          echo "Место рождения: <strong>$state</strong><br>";
          echo "День рождения персонажа: $date</small><br>";
          echo "<hr align='left' width='300' size='1'>";
          $info->showInfDetail();
?>      </td>
      </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top">
<?
/* TODO: Gift system
$rows = $adb->select("SELECT `c`.`id`, 
                             `c`.`gift_author` 
                      FROM `character_inventory` AS `c` 
                      LEFT JOIN `item_template` AS `i` 
                      ON `c`.`item_entry` = `i`.`entry` 
                      WHERE `c`.`guid` = ?d 
                        and `i`.`section` = 'thing' 
                        and `i`.`type` = 'medal' 
                        and `c`.`wear` = '0'", $guid);
foreach ($rows as $dat_t)
{
  $item_id = $dat_t['id'];
  $gift_author = $dat_t['gift_author'];
  $obj_data = $adb->selectRow("SELECT `name`, 
                                      `img`, 
                                      `msg` 
                               FROM `medal` 
                               WHERE `id` = ?d", $item_id);
  list($g_name, $img, $msg) = array_values($obj_data);
  echo "<img src='$img' alt='$g_name<br>$msg<br>от $gift_author'>&nbsp";
}*/
?>          <hr align="left" size="1">
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" style="padding-left: 4px;">
            <h3>Анкетные данные</h3>
<?          echo "Имя: $name<br>";
            echo "Пол: $sex";
            echo ($town) ?"<br>Город: $town" :"";
            echo ($icq && !$hide_icq) ?"<br>ICQ: $icq" :"";
            echo ($url) ?"<br>Домашняя страница: <a href='$url' target='_blank' class='nick'>$url</a>" :"";
            echo ($motto) ?"<br>Девиз: <code>$motto</code>" :"";
            echo ($hobie) ?"<br>Увлечения / хобби:<br><code>".str_replace(array("\'", '\&quot;'), array("'", '"'), $hobie)."</code>" :"";
?>        </td>
        </tr>
      </table>
    </td>
    <td class="middlerightline"><img src="img/info/x.gif"></td>
  </tr>
  <tr>
    <td class="bottomleftcorner"><img src="img/info/x.gif"></td>
    <td class="bottomcenterline"><div><?echo $config['copyright'];?></div></td>
    <td class="bottomrightcorner"><img src="img/info/x.gif"></td>
  </tr>
</table>
</body>
</html>