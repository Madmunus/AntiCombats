<?
session_start();
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
$char_db = $char->getChar('char_db', 'admin_level', 'city');
ArrToVar($char_db);
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <link href="styles/topp.css" rel="stylesheet" type="text/css" />
  <script src="scripts/jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    try {top.checkGame();} catch(e) {location.href = 'index.php';}

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
      $('body').on('click', 'input, a', function (){$(this).blur();})
      .on('click', 'a.menutop', function (){
        if ($(this).attr('id') != '')
          top.linkAction($(this).attr('id'));
      });
      if (mail)
        $('#mail').html("<img src='img/icon/mail"+mail+".gif' title='Получена почта' width='24' height='15'>");
    });
  </script>
</head>
<body>
<div style="background: url(img/city/top_lite_<?echo $city;?>_11.gif) repeat-x bottom;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: url(img/city/top_lite_<?echo $city;?>_03.gif) repeat-x top;">
  <tr>
    <td align="left"><img height="14" src="img/city/top_lite_<?echo $city;?>_01.gif" width="64" /><span id="mail" style="position: absolute;"></span></td>
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
                <td class="exit" onclick="top.exit();">Выход</td>
              </tr>
            </table>
          </td>
          <td width="38"><img height="14" src="img/city/mennu112_04_lite.gif" width="37" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left"><img height="17" src="img/city/top_lite_<?echo $city;?>_07.gif" width="15" /><img height="17" src="img/city/top_lite_<?echo $city;?>_08.gif" width="152" /></td>
    <td align="right">
      <table cellspacing="0" cellpadding="0" width="500" border="0" style="background: url(img/city/top_lite_<?echo $city;?>_15.gif);">
        <tr>
          <td align="left"><img height="17" src="img/city/top_lite_<?echo $city;?>_13.gif" width="20" /></td>
          <td valign="top">
            <table cellspacing="0" cellpadding="0" width="100%" border="0" align="right">
              <tr>
                <td class="menutop" nowrap align="right" width="100%">
                  <span id="menu1" class="bottom_text">
                      <a class="menutop" href="library/index.html" target="_blank">Библиотека</a>
                    | <a class="menutop" href="library/faq/" target="_blank">FAQ</a>
                    | <a class="menutop" href="library/law.html" target="_blank">Законы</a>
                    | <a class="menutop" href="library/TOS_RU_encicl.html" target="_blank">Соглашения</a>
                    | <a class="menutop" href="library/FAQ/afer.html" target="_blank">Правила безопасности</a>
                  </span>
                  <span id="menu2" class="bottom_text">
                      <a class="menutop" href="news" target="_blank">Новости</a>
                    | <a class="menutop" href="forum" target="_blank">Форум</a>
                    | <a class="menutop" href="stat.php" target="_blank">Рейтинг</a>
                  </span>
                  <span id="menu3" class="bottom_text">
                      <a class="menutop" id="security" href="#">Смена пароля</a>
                    | <a class="menutop" id="report" href="#">Отчеты</a>
                    | <a class="menutop" href="library/FAQ/afer.html" target="_blank">Правила</a>
                    | <a class="menutop" id="security" href="#">Настройки</a>
                  </span>
                  <span id="menu4" class="bottom_text">
                      <a class="menutop" id="inv" href="#">Инвентарь</a>
                    | <a class="menutop" id="skills" href="#"><?echo $lang['abilities'];?></a>
                    | <a class="menutop" id="zayavka" href="#"><?echo $lang['fights'];?></a>
                    | <a class="menutop" id="info" href="#"><?echo $lang['form'];?></a>
<?
if ($admin_level > 0)
  echo "| <a class='menutop' id='admin' href='#'>Админка</a>";
?>
                  </span>
                </td>
              </tr>
            </table>
          </td>
          <td align="right"><img height="17" src="img/city/top_lite_<?echo $city;?>_18.gif" width="22" /></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" valign="top" style="background: url(img/city/sand_top_20s.gif) repeat-x;">
  <tr valign="top">
    <td><img src="img/city/sand_lit_20.gif" width="15" height="6" /><img src="img/city/sand_top_20s.gif" width="79" height="6" /></td>
    <td width="100%"><img src="img/city/sand_top_20s.gif" width="31" height="6" /></td>
    <td><img src="img/city/sand_lit_27.gif" width="24" height="6" /></td>
  </tr>
</table>
</body>
</html>