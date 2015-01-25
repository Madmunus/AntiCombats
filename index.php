<?
define('AntiBK', true);

include_once("engline/config.php");
include_once("engline/dbsimple/Generic.php");
include_once("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$images = $adb->selectRow("SELECT * FROM `server_index` WHERE `month` = ?s", date('m'));
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <title>Анти Бойцовский Клуб</title>
  <link rel="SHORTCUT ICON" href="img/favicon.ico" />
  <link rel="StyleSheet" href="styles/index.css" type="text/css" />
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
      keytable += '<tr>' + KeyShow(0, chEng1) + "<td colspan='7' align='right'><input id='erase' type='button' class='btn' value='&larr;'></td></tr>";
      keytable += '<tr>' + KeyShow(1, chEng1) + "<td colspan='7' align='right'><input id='clean' type='button' class='btn' value='Очистить все'></td></tr>";
      keytable += '<tr>' + KeyShow(0, chDec1) + "<td colspan='16' align='right'><input id='alphabet' type='button' class='btn' value='По алфавиту'></td><td colspan='7' align='right'><input id='shuffle' type='button' class='btn' value='Перемешать'></td></tr>";
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
      $('body').on('click', '#keypadshow', function (){
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
      }).on('click', 'input.btkey', function (){
        $('input[name=password]').val($('input[name=password]').val() + $(this).val());
      }).on('click', 'input#erase', function (){
        tt = $('input[name=password]').val();
        $('input[name=password]').val(tt.substring(0, tt.length-1));
      }).on('click', 'input#clean', function (){
        $('input[name=password]').val('');
      }).on('click', 'input#alphabet', function (){
        shKeypad();
      }).on('click', 'input#shuffle', function (){
        shKeypad(1);
      }).on('click', 'input[type=button], input[type=radio], input[type=submit], a', function (){
        $(this).blur();
      });
    });
  </script>
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr height="30%"><td colspan="3" width="100%" align="center"><img src="img/site/<?echo $images['top'];?>"></td></tr>
  <tr height="205">
    <td colspan="3" width="100%" align="center" scope="col" background="img/site/<?echo $images['back'];?>" style="background-repeat: repeat-x;">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0" style="background-repeat: repeat-x;">
        <tr height="205" valign="top">
          <td width="195" align="right" valign="bottom" style="padding-bottom: 42px;"><img src="img/site/<?echo $images['winer'];?>"></td>
          <td align="center"><p><img src="img/site/<?echo $images['icon'];?>"></p></td>
          <td width="195" valign="bottom" style="padding-bottom: 42px; padding-right: 5px;" align="right"><img src="img/site/<?echo $images['best'];?>"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td height="122" width="25%" align="left" valign="bottom" noWrap style="padding-left: 10px;"><img src="img/site/18adult0.gif"></td>
    <td align="center" width="50%" style="padding-left: 10px;">
      <table width="100%" border="0">
        <form action="enter.php" method="post">
        <tr><td align="center"><input type="text" class="inup" align="middle" style="width: 144" name="login" placeholder="Логин"></td></tr>
        <tr>
          <td align="center">
            <table cellspacing="0" cellpadding="0">
              <tr valign="bottom">
                <td><input style="width: 114px;" class="inup" type="password" size="25" value="" name="password"></td>
                <td valign="bottom"><img id="keypadshow" border="0" src="img/site/klav_tra.gif" style="cursor: pointer;" width="26" height="17"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr><td height="19" align="center"><input type="submit" class="btn" value=" Войти "></td></tr>
        <tr><td align="center"><input type="button" class="btn" value="Регистрация" onclick="location.href = 'register.php';"></td></tr>
        </form>
      </table>
    </td>
    <td width="25%" align="right" valign="bottom" noWrap style="padding-right: 10px;"><img src="img/site/change_w.gif"></td>
  </tr>
  <tr><td colspan="3" align="center" valign="top"><div id="keypad" align="center" style="display: none;"></div></td></tr>
  <tr>
    <td colspan="3" align="center" nowrap valign="top">
      <a href="library" target="_blank">Библиотека</a> &nbsp;
      <a href="library/law.html" target="_blank">Законы</a> &nbsp;
      <a href="library/TOS_RU.html" target="_blank">Соглашения</a> &nbsp;
      <a href="news" target="_blank">Новости</a> &nbsp;
      <a href="forum" target="_blank">Форум</a> &nbsp;
      <a href="#">Скроллы</a> &nbsp;    
      <a href="stat.php" target="_blank">Рейтинг</a> &nbsp;
      <a href="reminder.php">Забыли пароль?</a> &nbsp;
      <!--TODO: <a href="#">Подтверждения</a>-->
    </td>
  </tr>
</table>
</body>
</html>