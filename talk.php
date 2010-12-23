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

$test = Test::setguid($guid);

$test -> Guid ($guid);

$h = requestVar ('h');
$color = requestVar ('color');
$sys = requestVar ('sys');
$om = requestVar ('om');
$sound = requestVar ('sound');
$phrase = requestVar ('phrase');

$db = $adb -> selectRow ("SELECT `admin_level`, 
                                 `orden`, 
                                 `level`, 
                                 `clan` 
                          FROM `characters` 
                          WHERE `guid` = ?d", $guid);
list ($admin_level, $orden, $level, $clan) = array_values ($db);
?>
<html><head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles/main.css" />
<script src="scripts/jquery-1.4.3.js" type="text/javascript"></script>
<script type="text/javascript">
function subm ()
{
  document.talker.h.value = document.talker.phrase.value;
  if (top.ChatTranslit) translate ();
}

var map_en = new Array('s`h','S`h','S`H','s`Х','sh`','Sh`','SH`',"'o",'yo',"'O",'Yo','YO','zh','w','Zh','ZH','W','ch','Ch','CH','sh','Sh','SH','e`','E`',"'u",'yu',"'U",'Yu',"YU","'a",'ya',"'A",'Ya','YA','a','A','b','B','v','V','g','G','d','D','e','E','z','Z','i','I','j','J','k','K','l','L','m','M','n','N','o','O','p','P','r','R','s','S','t','T','u','U','f','F','h','H','c','C','`','y','Y',"'")
var map_ru = new Array('сх','Сх','СХ','сХ','щ','Щ','Щ','ё','ё','Ё','Ё','Ё','ж','ж','Ж','Ж','Ж','ч','Ч','Ч','ш','Ш','Ш','э','Э','ю','ю','Ю','Ю','Ю','я','я','Я','Я','Я','а','А','б','Б','в','В','г','Г','д','Д','е','Е','з','З','и','И','й','Й','к','К','л','Л','м','М','н','Н','о','О','п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','ъ','ы','Ы','ь')

function convert (str)
{
  for (var i = 0; i < map_en.length; ++i) 
    while(str.indexOf(map_en[i]) >= 0) 
      str = str.replace (map_en[i], map_ru[i]);
  return str;
}

function rslength () // изменяет размер строки ввода текста
{
  var size = document.body.clientWidth - (4*30)-31-59-285-55;
  
  if (size < 100)
    size = 100;
  
  document.talker.phrase.size = size / 5.5;
  $('#T2').attr('width', size - 50);
}

function translate () // translates latin to russian
{
  var strarr = new Array();
  strarr = document.talker.h.value.split(' ');
  for (var k = 0; k < strarr.length; k++)
  {
    if (strarr[k].indexOf("http://") < 0 && strarr[k].indexOf('@') < 0 && strarr[k].indexOf("www.") < 0 && !(strarr[k].charAt(0) == ":" && strarr[k].charAt(strarr[k].length-1) == ":"))
    {
      if ((k < strarr.length - 1) && (strarr[k] == "to" || strarr[k] == "private") && (strarr[k+1].charAt(0) == "["))
      {
        while ( (k < strarr.length - 1) && (strarr[k].charAt(strarr[k].length - 1 ) != "]") ) 
          k++;
      }
      else
        strarr[k] = convert (strarr[k]);
    }
  }
  document.talker.h.value = strarr.join(' ');
}

function sw_clean ()
{
  if (document.talker.phrase.value != '')
  {
    document.talker.phrase.value = '';
    document.talker.phrase.focus();
  }
  else if (confirm('Очистить окно чата?'))
    parent.msg.document.getElementById('mes').innerHTML = '';
}

function sw_smile ()
{
  var x = window.innerWidth + 120;
  var y = window.innerHeight + 460;
  var sFeatures = "dialogHeight:700px;dialogWidth:500px;dialogLeft:"+x+"px;dialogTop:"+y+"px;help:no;status:no;unadorned:yes;maximize:no;";
  window.showModalDialog("smiles.html", "Смайлы", sFeatures);
}

function rel ()
{
  top.location.reload();
}

function url (url)
{
  top.main.location.href = "main.php?action="+url;
}

function quit ()
{
  if(confirm("Вы уверены что хотите выйти из игры?"))
    top.location.href = 'main.php?action=exit';
}

function talk ()
{
  document.talker.phrase.focus();
}

$(document).ready(function (){
  rslength ();
  $('[name=filter]').live('click', function (){
    top.ChatFilter = ! top.ChatFilter;
    if (top.ChatFilter)
      $(this).attr({'title': '(включено) Показывать в чате только сообщения адресованные мне', 'src': 'img/b_filter_on.gif'});
    else
      $(this).attr({'title': '(выключено) Показывать в чате только сообщения адресованные мне', 'src': 'img/b_filter_off.gif'});
    talk ();
  });
  $('[name=slow]').live('click', function (){
    top.ChatSlow = ! top.ChatSlow;
    if (top.ChatSlow)
      $(this).attr({'title': '(включено) Медленное обновление чата (раз в минуту)', 'src': 'img/b_slow_on.gif'});
    else
      $(this).attr({'title': '(выключено) Медленное обновление чата (раз в минуту)', 'src': 'img/b_slow_off.gif'});
    talk ();
  });
  $('[name=sys]').live('click', function (){
    top.ChatSys = ! top.ChatSys;
    if (top.ChatSys)
      $(this).attr({'title': '(включено) Показывать в чате системные сообщения', 'src': 'img/b_sys_on.gif'});
    else
      $(this).attr({'title': '(выключено) Показывать в чате системные сообщения', 'src': 'img/b_sys_off.gif'});
    talk ();
  });
  $('[name=translit]').live('click', function (){
    top.ChatTranslit = ! top.ChatTranslit;
    if (top.ChatTranslit)
      $(this).attr({'title': '(включено) Преобразовывать транслит в русский текст', 'src': 'img/b_translit_on.gif'});
    else
      $(this).attr({'title': '(выключено) Преобразовывать транслит в русский текст', 'src': 'img/b_translit_off.gif'});
    talk ();
  });
}).resize(function (){rslength ();});
</script>
</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" bgcolor="#E6E6E6" onfocus="document.talker.phrase.focus ();">
<form name="talker" action="null.php" target="null" onsubmit="subm ();" id="F1" method="post">
  <input type="hidden" name="color" value="#000000" />
  <input type="hidden" name="sys" value="" />
  <input type="hidden" name="om" value="" />
  <input type="hidden" name="lid" value="" />
  <input type="hidden" name="ChatFilter" value="0">
  <table width="100%" height="30" cellspacing="0" cellpadding="0">
    <tr valign="top" style="background: url(img/beg_chat_03.gif) top repeat-x;">
      <td width="9"><img src="img/bkf_l_r1_02.gif" width="9" height="30"></td>
      <td width="30"><img src="img/b_chat.gif" width="30" height="30" title="Чат" /></td>
      <td valign="middle" height="40" id="T2" valign="top"><input type="normal" name="phrase" maxlength="240" size="130" onKeyDown="document.talker.h.value = document.talker.phrase.value;" style="margin-top: -8px;" /></td>
      <td nowrap height="30">
        <img src="img/b_ok.gif" width="30" height="30" title="Добавить текст в чат" style="cursor: pointer;" onclick="document.talker.sbm.click ();" />
        <img src="img/1x1.gif" width="8" height="1" title="" />
        <img src="img/b_clear.gif" width="30" height="30" title="Очистить строку ввода/Чат" style="cursor: pointer;" onclick="sw_clean ();" />
        <img src="img/b_filter_off.gif" title="(выключено) Показывать в чате только сообщения адресованные мне" name="filter" width="30" height="30" style="cursor: pointer;" />
        <img src="img/b_sys_off.gif" title="(выключено) Показывать в чате системные сообщения" name="sys" width="30" height="30" style="cursor: pointer;" />
        <img src="img/b_slow_off.gif" title="(выключено) Медленное обновление чата (раз в минуту)" name="slow" width="30" height="30" style="cursor: pointer;" />
        <img src="img/b_translit_off.gif" title="(выключено) Преобразовывать транслит в русский текст (правила перевода см. в энциклопедии)" name="translit" width="30" height="30" style="cursor: pointer;" />
        <img src="img/b_sound_off.gif" title="Не работает" name="b_sound" width="30" height="30" id="b_sound" onclick="" />
        <object><embed src="img/Sound2.swf" quality="high" scale="noscale" wmode="transparent" width="1" height="1" name="Sound" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
        <img src="img/b_smile.gif" width="30" height="30" title="Смайлики" style="cursor: pointer;" onclick="sw_smile ();" />
      </td>
      <td width="16" background="img/b_bg2.gif"><img src="img/beg_chat_05.gif" width="16" height="30" /></td>
      <td align="right" nowrap style="background: url(img/b_bg2.gif) repeat-x;" height="30">
        <img src="img/a_inv.gif" width="30" height="30" title="Настройки/Инвентарь" style="cursor: pointer;" onClick="url ('inv&section=1');" />
        <?if($level >= 4 || $orden == 4){?><img src="img/a_trf.gif" width="30" height="30" title="Передать предметы/кредиты" style="cursor: pointer;" onClick="url ('perevod');" /><?}?>
        <?if($orden == 1 || $admin_level > 1){?><img src="img/a_pal.gif" width="30" height="30" title="Власть" style="cursor: pointer;" onClick="url ('orden');" /><?}?>
        <?if($orden == 2){?><img src="img/a_drk.gif" width="30" height="30" title="Власть" style="cursor: pointer;" onClick="url ('orden');" /><?}?>
        <?if($clan){?><img src="img/a_kln.gif" width="30" height="30" title="Клан" style="cursor: pointer;" onClick="url ('clan');" /><?}?>
        <img src="img/a_ext.gif" width="30" height="30" title="Выход из игры" style="cursor: pointer;" onClick="quit ();" />
      </td>
      <td width="70" valign="middle" background="img/b_bg2.gif" height="30"><object><embed src="img/clock.swf?hours=<?echo date('H');?>&minutes=<?echo date('i');?>&sec=<?echo date('s');?>" width="70" type="application/x-shockwave-flash" style="margin-top: -6px; height: 100%;" /></object></td>
      <td width="9" valign="middle" background="img/b_bg2.gif"><img src="img/bkf_l_r1_06.gif" width="9" height="40" /></td>
    </tr>
  </table>
  <input type="hidden" name="h">
  <input type="submit" name="sbm" style="display: none;" />
</form>
</body>
</html>