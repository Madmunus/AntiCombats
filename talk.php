<?
session_start ();
ini_set ('display_errors', true);
ini_set ('html_errors', false);
ini_set ('error_reporting', E_ALL);

define ('AntiBK', true);

include ("engline/config.php");
include ("engline/dbsimple/Generic.php");
include ("engline/functions/functions.php");

$guid = getGuid ();

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid ();

$char_db = $char->getChar ('char_db', 'admin_level', 'orden', 'level', 'clan', 'chat_filter', 'chat_sys', 'chat_update');
ArrToVar ($char_db);
?>
<html><head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="styles/main.css" />
<script src="scripts/jquery-1.4.4.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
var chat = new Array ();
chat['filter'] = (<?echo $char_db['chat_filter'];?>) ?false :true;
chat['sys'] = (<?echo $char_db['chat_sys'];?>) ?false :true;
chat['slow'] = (<?echo $char_db['chat_update'];?> != 10) ?false :true;
chat['translit'] = true;

function changeButtonState (button)
{
  var title = '';
  var src = '';
  switch (button)
  {
    case 'filter':
      src = (chat[button]) ?'img/b_filter_off.gif' :'img/b_filter_on.gif';
    break;
    case 'sys':
      src = (chat[button]) ?'img/b_sys_off.gif' :'img/b_sys_on.gif';
    break;
    case 'slow':
      src = (chat[button]) ?'img/b_slow_off.gif' :'img/b_slow_on.gif';
    break;
    case 'translit':
      src = (chat[button]) ?'img/b_translit_off.gif' :'img/b_translit_on.gif';
    break;
  }
  chat[button] = !chat[button];
  $('#'+button).attr('src', src);
  talk ();
}

function subm ()
{
  var message = $("#phrase").val();
  if (chat['translit'])
    message = translate (message);
  $.post('ajax_talk.php', 'do=sendmessage&h='+message, function (data){
	  if (data == 'complete')
    {
      top.ref.document.location.reload();
      $("#phrase").val('').focus();
    }
    else if (data == 'ajax_error')
      top.location.href = 'index.php';
    else
      $("#phrase").val('').focus();
	});
}

var map_en = new Array ('s`h','S`h','S`H','s`Х','sh`','Sh`','SH`',"'o",'yo',"'O",'Yo','YO','zh','w','Zh','ZH','W','ch','Ch','CH','sh','Sh','SH','e`','E`',"'u",'yu',"'U",'Yu',"YU","'a",'ya',"'A",'Ya','YA','a','A','b','B','v','V','g','G','d','D','e','E','z','Z','i','I','j','J','k','K','l','L','m','M','n','N','o','O','p','P','r','R','s','S','t','T','u','U','f','F','h','H','c','C','`','y','Y',"'")
var map_ru = new Array ('сх','Сх','СХ','сХ','щ','Щ','Щ','ё','ё','Ё','Ё','Ё','ж','ж','Ж','Ж','Ж','ч','Ч','Ч','ш','Ш','Ш','э','Э','ю','ю','Ю','Ю','Ю','я','я','Я','Я','Я','а','А','б','Б','в','В','г','Г','д','Д','е','Е','з','З','и','И','й','Й','к','К','л','Л','м','М','н','Н','о','О','п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','ъ','ы','Ы','ь')

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
  
  $("#phrase").attr('size', size / 5.5);
  $('#T2').attr('width', size - 50);
}

function translate (str) // translates latin to russian
{
  var strarr = new Array ();
  strarr = str.split(' ');
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
  return strarr.join(' ');
}

function clean ()
{
  if ($("#phrase").val() != '')
    $("#phrase").val('').focus();
  else if (confirm('Очистить окно чата?'))
    parent.msg.document.getElementById('mes').innerHTML = '';
}

function smiles ()
{
  var x = window.innerWidth + 120;
  var y = window.innerHeight + 460;
  var sFeatures = "dialogHeight:700px;dialogWidth:500px;dialogLeft:"+x+"px;dialogTop:"+y+"px;help:no;status:no;unadorned:yes;maximize:no;";
  window.showModalDialog("smiles.html", "Смайлы", sFeatures);
}

function url (url)
{
  top.main.location.href = "main.php?action="+url;
}

function quit ()
{
  if (confirm("Вы уверены что хотите выйти из игры?"))
    url ('exit');
}

function talk ()
{
  $("#phrase").focus();
}

$(document).ready(function (){
  for (var i in chat)
    changeButtonState (i);
  rslength ();
  $('#filter').live('click', function (){
    changeButtonState ('filter');
  });
  $('#slow').live('click', function (){
    changeButtonState ('slow');
  });
  $('#sys').live('click', function (){
    changeButtonState ('sys');
  });
  $('#translit').live('click', function (){
    changeButtonState ('translit');
  });
  $('#phrase').keydown(function (event){
    if (event.keyCode == '13')
      subm ();
  });
}).resize(function (){rslength ();});
</script>
</head>
<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" bgcolor="#E6E6E6" onFocus="talk ();">
<table width="100%" height="30" cellspacing="0" cellpadding="0">
  <tr valign="top" style="background: url(img/beg_chat_03.gif) top repeat-x;">
    <td width="9"><img src="img/bkf_l_r1_02.gif" width="9" height="30"></td>
    <td width="30"><img src="img/b_chat.gif" width="30" height="30" title="Чат" /></td>
    <td valign="middle" height="40" id="T2" valign="top"><input type="normal" id="phrase" maxlength="240" size="130" style="margin-top: -8px;" /></td>
    <td nowrap height="30">
      <img src="img/b_ok.gif" width="30" height="30" title="Отправить сообщение" style="cursor: pointer;" onclick="subm ();" />
      <img src="img/1x1.gif" width="8" height="1" />
      <img width="30" height="30" style="cursor: pointer;" src="img/b_clear.gif" title="Очистить строку ввода/Чат" onclick="clean ();" />
      <img width="30" height="30" style="cursor: pointer;" src="img/b_filter_off.gif" id="filter" title="Показывать в чате только сообщения адресованные мне" />
      <img width="30" height="30" style="cursor: pointer;" src="img/b_sys_off.gif" id="sys" title="Показывать в чате системные сообщения" />
      <img width="30" height="30" style="cursor: pointer;" src="img/b_slow_off.gif" id="slow" title="Медленное обновление чата (раз в минуту)" />
      <img width="30" height="30" style="cursor: pointer;" src="img/b_translit_off.gif" id="translit" title="Преобразовывать транслит в русский текст (правила перевода см. в энциклопедии)" />
      <img width="30" height="30" src="img/b_sound_off.gif" id="b_sound" title="Не работает" />
      <object><embed src="img/Sound2.swf" quality="high" scale="noscale" wmode="transparent" width="1" height="1" id="Sound" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
      <img width="30" height="30" style="cursor: pointer;" src="img/b_smile.gif" title="Смайлики" onclick="smiles ();" />
    </td>
    <td width="16" background="img/b_bg2.gif"><img src="img/beg_chat_05.gif" width="16" height="30" /></td>
    <td align="right" nowrap style="background: url(img/b_bg2.gif) repeat-x;" height="30">
      <img src="img/a_inv.gif" width="30" height="30" title="Настройки/Инвентарь" style="cursor: pointer;" onClick="url ('inv&section=1');" />
      <?if($level >= 4){?><img src="img/a_trf.gif" width="30" height="30" title="Передать предметы/кредиты" style="cursor: pointer;" onClick="url ('perevod');" /><?}?>
      <?if($orden == 1){?><img src="img/a_pal.gif" width="30" height="30" title="Власть" style="cursor: pointer;" onClick="url ('orden');" /><?}?>
      <?if($orden == 2){?><img src="img/a_drk.gif" width="30" height="30" title="Власть" style="cursor: pointer;" onClick="url ('orden');" /><?}?>
      <?if($clan){?><img src="img/a_kln.gif" width="30" height="30" title="Клан" style="cursor: pointer;" onClick="url ('clan');" /><?}?>
      <img src="img/a_ext.gif" width="30" height="30" title="Выход из игры" style="cursor: pointer;" onClick="quit ();" />
    </td>
    <td width="70" valign="middle" background="img/b_bg2.gif" height="30"><object><embed src="img/clock.swf?hours=<?echo date('H');?>&minutes=<?echo date('i');?>&sec=<?echo date('s');?>" width="70" type="application/x-shockwave-flash" style="margin-top: -6px; height: 100%;" /></object></td>
    <td width="9" valign="middle" background="img/b_bg2.gif"><img src="img/bkf_l_r1_06.gif" width="9" height="40" /></td>
  </tr>
</table>
</body>
</html>