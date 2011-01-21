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
<link rel="StyleSheet" href="styles/talk.css" type="text/css">
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
var chat = new Array ();
chat['filter'] = (<?echo $char_db['chat_filter'];?>) ?false :true;
chat['sys'] = (<?echo $char_db['chat_sys'];?>) ?false :true;
chat['slow'] = (<?echo $char_db['chat_update'];?> != 10) ?false :true;
chat['translit'] = true;
var full_length = 0;

function changeButtonState (button)
{
  var src = (chat[button]) ?'img/talk/b_'+button+'_off.gif' :'img/talk/b_'+button+'_on.gif';
  chat[button] = !chat[button];
  $('#'+button).attr('src', src);
  talk ();
}

function sendMessage ()
{
  var message = $("#phrase").val();
  if (chat['translit'])
    message = translate (message);
  $.post('ajax_talk.php', 'do=sendmessage&h='+message, function (data){
    var result = top.exploder(data);
    top.msg.updateMessages();
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
  var size = Math.ceil($('body').width() - full_length - (2*30)-5);
  
  if (size < 300)
    size = 300;
  
  $("#phrase").css('width', size);
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
    top.cleanChat();
}

function smiles ()
{
  var x = window.innerWidth + 120;
  var y = window.innerHeight + 460;
  window.showModalDialog("smiles.html", "Смайлы", "dialogHeight:700px;dialogWidth:500px;dialogLeft:"+x+"px;dialogTop:"+y+"px;help:no;status:no;unadorned:yes;maximize:no;");
}

function quit ()
{
  if (confirm("Вы уверены что хотите выйти из игры?"))
    top.linkAction('exit');
}

function talk ()
{
  $("#phrase").focus();
}

$(document).ready(function (){
  for (var i in chat)
    changeButtonState (i);
  full_length = $('#T1').width() + $('#T3').width() + $('#T4').width() + $('#T5').width() + $('#T6').width() + $('#T7').width();
  rslength ();
  $('.button').live('click', function (){
    if (id = $(this).attr('id'))
      changeButtonState (id);
  });
  $('#phrase').keydown(function (event){
    if (event.keyCode == '13')
      sendMessage();
  });
});
$(window).resize(function (){rslength ();});
</script>
</head>
<body bgcolor="#E6E6E6" onFocus="talk ();">
<table border="0" cellspacing="0" cellpadding="0" width="100%" height="30">
<tr>
<td id="T1"><img src="img/1x1.gif" width="9" /></td>
<td id="T2">
  <img src="img/talk/b_chat.gif" title="Чат" />
  <input type="text" id="phrase" maxlength="240" size="100" />
  <img class="button" src="img/talk/b_ok.gif" title="Отправить сообщение" onclick="sendMessage();" />
<td id="T3"><img src="img/1x1.gif" width="8" /></td>
<td id="T4">
  <img class="button" src="img/talk/b_clear.gif" title="Очистить строку ввода/Чат" onclick="clean ();" />
  <img class="button" src="img/talk/b_filter_off.gif" id="filter" title="Показывать в чате только сообщения адресованные мне" />
  <img class="button" src="img/talk/b_sys_off.gif" id="sys" title="Показывать в чате системные сообщения" />
  <img class="button" src="img/talk/b_slow_off.gif" id="slow" title="Медленное обновление чата (раз в минуту)" />
  <img class="button" src="img/talk/b_translit_off.gif" id="translit" title="Преобразовывать транслит в русский текст (правила перевода см. в энциклопедии)" />
  <img class="button" src="img/talk/b_sound_off.gif" id="b_sound" title="Не работает" />
  <object><embed width="1" height="1" src="img/talk/Sound2.swf" quality="high" scale="noscale" wmode="transparent" id="sound" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
  <img class="button" src="img/talk/b_smile.gif" title="Смайлики" onclick="smiles ();" />
</td>
<td id="T5"><img src="img/1x1.gif" width="16" /></td>
<td id="T6">
  <img class="button" src="img/talk/a_inv.gif" title="Настройки/Инвентарь" onClick="top.linkAction('inv');" />
  <?if($level >= 4){?><img class="button" src="img/talk/a_trf.gif" title="Передать предметы/кредиты" onClick="top.linkAction('perevod');" /><?}?>
  <?if($orden == 1){?><img class="button" src="img/talk/a_pal.gif" title="Власть" onClick="top.linkAction('orden');" /><?}?>
  <?if($orden == 2){?><img class="button" src="img/talk/a_drk.gif" title="Власть" onClick="top.linkAction('orden');" /><?}?>
  <?if($clan){?><img class="button" src="img/talk/a_kln.gif" title="Клан" onClick="top.linkAction('clan');" /><?}?>
  <img class="button" src="img/talk/a_ext.gif" title="Выход из игры" onClick="quit ();" />
  <object><embed width="70" height="30" src="img/talk/clock.swf?hours=<?echo date('H');?>&minutes=<?echo date('i');?>&sec=<?echo date('s');?>" type="application/x-shockwave-flash" /></object>
</td>
<td id="T7"><img src="img/1x1.gif" width="9" /></td>
</tr>
</table>
</body>
</html>