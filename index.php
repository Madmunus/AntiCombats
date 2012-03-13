<?
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include_once("engline/config.php");
include_once("engline/dbsimple/Generic.php");
include_once("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$server = $adb->selectRow("SELECT * FROM `server_info`;");

if (date('d.m.y', $server['last_transfer']) != date('d.m.y'))
{
  $adb->query("UPDATE `characters` SET `transfers` = '200';");
  $adb->query("UPDATE `server_info` SET `last_transfer` = ?d", time());
}
?>
<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico">
<title>Анти Бойцовский Клуб</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="StyleSheet" href="styles/index.css" type="text/css">
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
var chRus = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';
var chEng = 'abcdefghijklmnopqrstuvwxyz';
var chDec = '0123456789';
var spSim = '!@#$%^&*()_+|=-`~[]{}.,?><;:/';

function KeyShow (shiftFl, tmp)
{
  var trshap = '';
  for (var j = 0; j < tmp.length; j++)
  {
    ich = tmp.charAt(j);
    trshap += "<td>";
    if (shiftFl) ich = ich.toUpperCase();
    trshap += "<input type='button' class='btkey' value='"+ich+"'></td>";
  }
  return trshap;
}

function KeyCreate (tmp)
{
  var out = '';
  var cnt = tmp.length;
  for (var j = 0; j < cnt; j++)
  {
    tt = Math.floor((tmp.length-1) * Math.random());
    out += tmp.charAt(tt);
    tmp = tmp.substring(0,tt).concat(tmp.substring(tt+1));
  }
  return out;
}

var keytable = '';
function shKeypad (fl)
{
  chRus1 = chRus;
  chEng1 = chEng;
  chDec1 = chDec;
  spSim1 = spSim;
  if (fl)
  {
    chRus1 = KeyCreate(chRus1);
    chEng1 = KeyCreate(chEng1);
    chDec1 = KeyCreate(chDec1);
    spSim1 = KeyCreate(spSim1);
  }
  keytable = '<table align="center" border="0">';
  keytable += '<tr>' + KeyShow(0, chEng1) + "<td colspan='7' align='right'><input id='erase' style='width: 164px;' type='button' class='btn' value='&larr;'></td></tr>";
  keytable += '<tr>' + KeyShow(1, chEng1) + "<td colspan='7' align='right'><input id='clean' style='width: 164px;' type='button' class='btn' value='Очистить все'></td></tr>";
  keytable += '<tr>' + KeyShow(0, chDec1) + "<td colspan='16' align='right'><input id='alphabet' style='width: 164px;' type='button' class='btn' value='По алфавиту'></td><td colspan='7' align='right'><input id='shuffle' style='width: 164px;' type='button' class='btn' value='Перемешать'></td></tr>";
  keytable += '<tr><td style="height: 8px;"></td></tr>';
  keytable += '<tr>' + KeyShow(0, chRus1)+'</tr>';
  keytable += '<tr>' + KeyShow(1, chRus1)+'</tr>';
  keytable += '<tr><td style="height: 8px;"></td></tr>';
  keytable += '<tr>' + KeyShow(0, spSim1) +"</tr>";
  keytable += '</table>';
  $("#keypad").html(keytable);
}

$(function (){
  shKeypad (1);
  $('input[name=login]').focus(function (){
    if ($(this).val() == 'Логин')
      $(this).val('');
  }).blur(function (){
    if ($(this).val() == '')
      $(this).val('Логин');
  });
  $('#keypadshow').live('click', function (){
    if ($("#keypad").is(":hidden"))
    {
      $('input[name=password]').css('backgroundColor', 'gray');
      $("#keypad").parent().height($("#keypad").height() + 20);
      $("#keypad").fadeIn(1000);
    }
    else
    {
      $('input[name=password]').css('backgroundColor', '#151616');
      $("#keypad").fadeOut(1000, function (){$("#keypad").parent().height(0);});
    }
  });
  $('input.btkey').live('click', function (){
    $('input[name=password]').val($('input[name=password]').val() + $(this).val());
  });
  $('input#erase').live('click', function (){
    tt = $('input[name=password]').val();
    $('input[name=password]').val(tt.substring(0, tt.length-1));
  });
  $('input#clean').live('click', function (){
    $('input[name=password]').val('');
  });
  $('input#alphabet').live('click', function (){
    shKeypad();
  });
  $('input#shuffle').live('click', function (){
    shKeypad(1);
  });
  $('input[type=button], input[type=radio], input[type=submit], a').live('click', function (){
    $(this).blur();
  });
});
</script>
</head>
<?
$winer = "runet_30.jpg";
$best = "runet_10.jpg";
switch (date('m'))
{
  case '01':
  case '02':
    $back = "start_2011_win_03.jpg";
    $icon = "start_2011_winng_05.jpg";
    $winer = "runet_4.jpg";
    $best = "runet_5.jpg";
  break;
  case '03':
    $back = "start_12spr_03.jpg";
    $icon = "start_12spr_05.jpg";
  break;
  case '04':
  case '05':
    $back = "start_10spr1_03.jpg";
    $icon = "start_10spr1_05.jpg";
  break;
  case '06':
  case '07':
    $back = "start_10sum1_03.jpg";
    $icon = "start_10sum1_05.jpg";
  break;
  case '08':
    $random = rand(1, 2);
    $back = ($random == 1) ?"start_09sum1_03.jpg" :"start_09sum2_03.jpg";
    $icon = ($random == 1) ?"start_09sum1_05.jpg" :"start_09sum2_051.jpg";
  break;
  case '09':
  case '10':
  case '11':
    $back = "start_10aut1_03.jpg";
    $icon = "start_10aut1_05.jpg";
  break;
  case '12':
    $back = "start_2011_win_03.jpg";
    $icon = "start_2011_win_05.jpg";
    $winer = "runet_4.jpg";
    $best = "runet_5.jpg";
  break;
}
$login = ($server['login']) ?"return true;" :"alert ('Сервер оффлайн'); return false;";
$registration = ($server['registration']) ?"location.href = 'register.php';" :"alert('Регистрация закрыта');";
$rpassword = ($server['password']) ?"pass.php" :"index.php";
?>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr height="30%"><td></td></tr>
  <tr height="205">
    <td colspan="3" width="100%" align="center" scope="col" background="img/site/<?echo $back;?>" style="background-repeat: repeat-x;">
      <div align="center">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0" style="background-repeat: repeat-x;">
        <tr height="205" valign="top">
          <td width="195" align="right" valign="bottom" style="padding-bottom: 42px;"><img src="img/site/<?echo $winer;?>"></td>
          <td align="center"><p><img src="img/site/<?echo $icon;?>"></p></td>
          <td width="195" valign="bottom" style="padding-bottom: 42px; padding-right: 5px;" align="right"><img src="img/site/<?echo $best;?>"></td>
        </tr>
      </table>
      </div>
    </td>
  </tr>
  <tr>
    <td height="122" width="25%" align="left" valign="bottom" noWrap style="padding-left: 10px;"><img src="img/site/18adult0.gif"></td>
    <td align="center" width="50%" style="padding-left: 10px;">
      <table width="100%" border="0">
        <form action="enter.php" method="post">
        <tr><td align="center"><input type="text" class="inup" align="middle" style="width: 144" value="Логин" name="login"></td></tr>
        <tr>
          <td align="center">
            <table cellspacing="0" cellpadding="0">
              <tr valign="bottom">
                <td><input style="width: 114px;" class="inup" type="password" size="25" value="" name="password"></td>
                <td style="padding-left: 5px;" valign="bottom"><img id="keypadshow" border="0" src="img/site/klav_tra.gif" style="cursor: pointer;" width="26" height="17"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr><td height="19" align="center"><input type="submit" class="btn" value=" Войти " onclick="<?echo $login;?>"></td></tr>
        <tr><td align="center"><input type='button' class='btn' style='width: 120px;' value=' Регистрация ' onclick="<?echo $registration;?>"></td></tr>
        </form>
      </table>
    </td>
    <td width="25%" align="right" valign="bottom" noWrap style="padding-right: 10px;"><img src="img/site/change_w.gif"></td>
  </tr>
  <tr><td colspan="3" align="center" valign="top"><div id="keypad" align="center" style="display: none;"></div></td></tr>
  <tr>
    <td colspan="3" align="center" noWrap valign="top">
      <a href="encicl/" target="_blank">Библиотека</a> &nbsp;
      <a href="encicl/faq/" target="_blank">FAQ</a> &nbsp;
      <a href="encicl/law.html" target="_blank">Законы</a> &nbsp;
      <a href="encicl/TOS_RU_encicl.html" target="_blank">Соглашения</a> &nbsp;
      <a href="news.php" target="_blank">События</a> &nbsp;
      <a href="forum" target="_blank">Форум</a> &nbsp;
      <a href="#">Скроллы</a> &nbsp;    
      <a href="stat.php" target="_blank">Рейтинг</a> &nbsp;
      <a href="<?print $rpassword;?>">Забыли пароль?</a> &nbsp;
      <a href="#">Подтверждения</a>
    </td>
  </tr>
</table>
</body>
</html>