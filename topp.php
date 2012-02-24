<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$guid = getGuid();

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid();

$lang = $char->getLang();
$mail = $adb->selectCell("SELECT COUNT(*) FROM `city_mail_items` WHERE `to` = ?d", $guid) | 0;
$admin_level = $char->getChar('char_db', 'admin_level');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<link href="styles/topp.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
top.checkGame();

var mail = <?echo $mail;?>;

$(function (){
  var cur_Id = '4';
  $('.main_text').click(function (){
    $('#'+cur_Id).css({backgroundColor: '', color: ''});
    $('#menu'+cur_Id).css({visibility: 'hidden', position: 'absolute'});
    cur_Id = $(this).attr('id');
    $('#'+cur_Id).css({backgroundColor: '#404040', color: '#FFFFFF'});
    $('#menu'+cur_Id).css({visibility: 'visible', position: 'relative'});
  });
  $('.main_text').trigger('click');
  $('input, a').live('click', function (){$(this).blur();});
  if (mail)
    $('#mail').html("<img src='img/icon/mail"+mail+".gif' title='Получена почта' width='24' height='15'>");
});
</script>
</head>
<body>
<div class="dem_bottom_line">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="dem_top_line">
  <tr>
    <td align="left"><img height="14" src="img/city/top_lite_dem_01.gif" width="64" /><span id="mail" style="position: absolute;"></span></td>
    <td align="right">
      <table cellspacing="0" cellpadding="0" border="0" width="500">
        <tr valign="bottom">
          <td width="31" height="14"><img height="14" src="img/city/mennu112_06_lite.gif" width="31" /></td>
          <td align="center">
            <table height="14" cellspacing="0" cellpadding="0" width="100%" background="img/city/mennu112_06.gif" border="0">
              <tr align="middle">
                <td class="main_text" id="1">Знания</td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="2">Общение</td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="3"><?echo $lang['security'];?></td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="4">Персонаж</td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="exit" onclick="top.exit();">Выход&nbsp;</td>
              </tr>
            </table>
          </td>
          <td width="38"><img height="14" src="img/city/mennu112_04_lite.gif" width="37" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left"><img height="17" src="img/city/top_lite_dem_07.gif" width="15" /><img height="17" src="img/city/top_lite_dem_08.gif" width="152" /></td>
    <td align="right">
      <table cellspacing="0" cellpadding="0" width="500" class="dem_menu_back" border="0">
        <tr>
          <td align="left"><img height="17" src="img/city/top_lite_dev_13.gif" width="20" /></td>
          <td valign="top">
            <table cellspacing="0" cellpadding="0" width="100%" border="0" align="right">
              <tr>
                <td class="menutop" nowrap align="right" width="100%">
                  <span id="menu1" class="bottom_text">
                      <a class="menutop" href="encicl/index.html" target="_blank">Библиотека</a>
                    | <a class="menutop" href="encicl/faq/" target="_blank">FAQ</a>
                    | <a class="menutop" href="encicl/law.html" target="_blank">Законы</a>
                    | <a class="menutop" href="encicl/TOS_RU_encicl.html" target="_blank">Соглашения</a>
                    | <a class="menutop" href="encicl/FAQ/afer.html" target="_blank">Правила безопасности</a>
                  </span>
                  <span id="menu2" class="bottom_text">
                      <a class="menutop" href="news.php" target="_blank">Новости</a>
                    | <a class="menutop" href="forum" target="_blank">Форум</a>
                    | <a class="menutop" href="stat.php" target="_blank">Рейтинг</a>
                  </span>
                  <span id="menu3" class="bottom_text">
                      <a class="menutop" onclick="top.linkAction('report');" href="#">Отчеты</a>
                    | <a class="menutop" href="encicl/FAQ/afer.html" target="_blank">Правила</a>
                    | <a class="menutop" onclick="top.linkAction('form&do=passandmail');" href="#">Настройки</a>
                    | <a class="menutop" onclick="top.linkAction('form&do=passandmail');" href="#">Смена пароля</a>
                  </span>
                  <span id="menu4" class="bottom_text">
                      <a class="menutop" onClick="top.linkAction('inv');" href="#">Инвентарь</a>
                    | <a class="menutop" onClick="top.linkAction('skills');" href="#"><?echo $lang['abilities'];?></a>
                    | <a class="menutop" onClick="top.linkAction('zayavka');" href="#">Поединки</a>
                    | <a class="menutop" onclick="top.linkAction('form&do=info');" href="#"><?echo $lang['form'];?></a>
<?
if ($admin_level > 0)
    echo "| <a class='menutop' onclick=\"top.linkAction('admin');\" href='#'>Админка</a>";
?>
                  </span>
                </td>
              </tr>
            </table>
          </td>
          <td align="right"><img height="17" src="img/city/top_lite_dev_18.gif" width="22" /></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" valign="top" class="top_menu">
  <tr valign="top">
    <td><img src="img/city/top_lite_dem_20.gif" width="15" height="6" /><img src="img/city/top_lite_dem_21.gif" width="79" height="6" /></td>
    <td width="100%"><img src="img/city/top_lite_dem_20s.gif" width="31" height="6" /></td>
    <td><img src="img/city/top_lite_dem_27.gif" width="24" height="6" /></td>
  </tr>
</table>
</body>
</html>