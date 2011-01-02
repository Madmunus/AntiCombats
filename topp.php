<?
session_start ();
error_reporting (E_ALL);
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

$guid = (empty($_SESSION['guid'])) ?0 :$_SESSION['guid'];

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid ();

$lang = $adb->selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");
$mail = $adb->selectCell ("SELECT COUNT(*) FROM `city_mail_items` WHERE `to` = ?d", $guid) | 0;
$admin_level = $char->getChar ('char_db', 'admin_level');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="styles/topp.css" rel="stylesheet" type="text/css">
<script src="scripts/jquery-1.4.3.js" type="text/javascript"></script>
<script type="text/javascript">
var mail = <?echo $mail;?>;

function url (url)
{
  top.main.location.href = url;
}

$(document).ready(function (){
  $('#4').css({'background-color': '#404040', 'color': '#FFFFFF'});
  $('#menu4').css({'visibility': 'visible', 'position': 'relative'});
  var cur_Id = '4';
  $(".main_text").click(function (){
    if ($(this).attr('id') == 5)
    {
      if (confirm("Вы уверены что хотите выйти из игры?"))
          url ('main.php?action=exit');
    }
    else
    {
      $('#'+cur_Id).css({'background-color': '', 'color': ''});
      $('#menu'+cur_Id).css({'visibility': 'hidden', 'position': 'absolute'});
      cur_Id = $(this).attr('id');
      $('#'+cur_Id).css({'background-color': '#404040', 'color': '#FFFFFF'});
      $('#menu'+cur_Id).css({'visibility': 'visible', 'position': 'relative'});
    }
  });
  $('input[type=button], input[type=radio], input[type=submit], a').live('click', function (){
    $(this).blur();
  });
  if (mail)
    $('#mailspan').html("<img src='img/icon/mail"+mail+".gif' title='Получена почта' width='24' height='15'>");
});
</script>
</head>
<body>
<div class="demon_bottom_line">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="demon_top_line">
  <tr>
    <td align="left"><img height="14" src="img/site/top_lite_demon_01.gif" width="64" /><span id="mailspan" style="position: absolute;"></span></td>
    <td align="right">
      <table cellspacing="0" cellpadding="0" border="0" width="500">
        <tr valign="bottom">
          <td width="31" height="14"><img height="14" src="img/site/mennu112_06_lite.gif" width="31" /></td>
          <td align="center">
            <table height="14" cellspacing="0" cellpadding="0" width="100%" background="img/site/mennu112_06.gif" border="0">
              <tr align="middle">
                <td class="main_text" id="1">Знания</td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="2">Общение</td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="3"><?echo $lang['security'];?></td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="4">Персонаж</td>
                <td><img height="11" src="img/mennu112_09.gif" width="1" /></td>
                <td class="main_text" id="5">Выход&nbsp;</td>
              </tr>
            </table>
          </td>
          <td width="38"><img height="14" src="img/site/mennu112_04_lite.gif" width="37" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left"><img height="17" src="img/site/top_lite_demon_07.gif" width="15" /><img height="17" src="img/site/top_lite_demon_08.gif" width="152" /></td>
    <td align="right">
      <table cellspacing="0" cellpadding="0" width="500" class="demon_menu_back" border="0">
        <tr>
          <td align="left"><img height="17" src="img/site/top_lite_devils_13.gif" width="20" /></td>
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
                    <a class="menutop" onclick="url ('main.php?action=report');" href="#">Отчеты</a>
                    | <a class="menutop" href="encicl/FAQ/afer.html" target="_blank">Правила</a>
                    | <a class="menutop" onclick="url ('main.php?action=form&do=passandmail');" href="#">Настройки</a>
                    | <a class="menutop" onclick="url ('main.php?action=form&do=passandmail');" href="#">Смена пароля</a>
                  </span>
                  <span id="menu4" class="bottom_text">
                    <a class="menutop" onClick="url ('main.php?action=inv');" href="#">Инвентарь</a>
                    | <a class="menutop" onClick="url ('main.php?action=skills');" href="#"><?echo $lang['abilities'];?></a>
                    | <a class="menutop" onClick="url ('zayavka.php');" href="#">Поединки</a>
                    | <a class="menutop" onclick="url ('main.php?action=form&do=info');" href="#"><?echo $lang['form'];?></a>
<?
if ($admin_level > 1)
    echo "| <a class='menutop' onclick=\"url ('main.php?action=admin');\" href='#'>Админка</a>";
?>
                  </span>
                </td>
              </tr>
            </table>
          </td>
          <td align="right"><img height="17" src="img/site/top_lite_devils_18.gif" width="22" /></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" valign="top" class="top_menu">
  <tr valign="top">
    <td><img src="img/site/sand_lit_20.gif" width="15" height="6" /><img src="img/site/dem_lit_21.gif" width="79" height="6" /></td>
    <td width="100%"><img src="img/site/sand_top_20s.gif" width="31" height="6" /></td>
    <td><img src="img/site/sand_lit_27.gif" width="24" height="6" /></td>
  </tr>
</table>
</body>
</html>