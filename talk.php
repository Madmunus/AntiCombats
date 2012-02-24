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

$char_db = $char->getChar('char_db', 'orden', 'level', 'clan', 'chat_filter', 'chat_sys', 'chat_update', 'chat_translit');
ArrToVar($char_db);
?>
<html><head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<link rel="StyleSheet" href="styles/chat.css" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
top.checkGame();

var chat = new Array ();
chat['filter'] = (<?echo $chat_filter;?>) ?false :true;
chat['sys'] = (<?echo $chat_sys;?>) ?false :true;
chat['slow'] = (<?echo $chat_update;?> == 10) ?true :false;
chat['translit'] = (<?echo $chat_translit;?>) ?false :true;

function changeButtonState (button)
{
  var src = (chat[button]) ?'img/talk/b_'+button+'_off.gif' :'img/talk/b_'+button+'_on.gif';
  chat[button] = !chat[button];
  $('#'+button).attr('src', src);
}

function sendMessage ()
{
  var message = $("#text").val();
  if (chat['translit'])
    message = translate (message);
  $.post('ajax_chat.php', 'do=sendmessage&h='+message, function (data){
    var result = top.exploder(data);
    top.msg.updateMessages();
    $("#text").val('');
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
  var size = Math.ceil($('body').width() - ($('#buttons1').width() + $('#buttons2').width() + 42) - 75);
  
  if (size < 300)
    size = 300;
  
  $("#text").css('width', size);
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
  if ($("#text").val() != '')
    $("#text").val('');
  else if (confirm('Очистить окно чата?'))
    top.cleanChat();
}

function smiles ()
{
  var x = window.innerWidth + 120;
  var y = window.innerHeight + 460;
  window.showModalDialog("smiles.html", "Смайлы", "dialogHeight:700px;dialogWidth:500px;dialogLeft:"+x+"px;dialogTop:"+y+"px;help:no;status:no;unadorned:yes;maximize:no;");
}

$(function (){
  for (var key in chat)
    changeButtonState(key);
  rslength();
  $('.button').live('click', function (){
    if (id = $(this).attr('id'))
      changeButtonState(id);
  });
  $('#text').keydown(function (e){
    if (e.which == 13)
      sendMessage();
  });
});
$(window).resize(function (){rslength();});
</script>
</head>
<body class="talk">
<table border="0" cellspacing="0" cellpadding="0" width="100%" height="30">
<tr>
<td id="T1"><img src="img/1x1.gif" width="9" /></td>
<td id="T2">
  <img src="img/talk/b_chat.gif" title="Чат" />
  <input type="text" id="text" maxlength="240" />
  <img class="button" src="img/talk/b_ok.gif" title="Отправить сообщение" onclick="sendMessage();" />
<td id="T3"><img src="img/1x1.gif" width="8" /></td>
<td id="T4">
<?
  echo '<span id="buttons1">';
  echo '<img class="button" src="img/talk/b_clear.gif" title="Очистить строку ввода/Чат" onclick="clean();" />';
  echo '<img class="button" src="img/talk/b_filter_off.gif" id="filter" title="Показывать в чате только сообщения адресованные мне" />';
  echo '<img class="button" src="img/talk/b_sys_off.gif" id="sys" title="Показывать в чате системные сообщения" />';
  echo '<img class="button" src="img/talk/b_slow_off.gif" id="slow" title="Медленное обновление чата (раз в минуту)" />';
  echo '<img class="button" src="img/talk/b_translit_off.gif" id="translit" title="Преобразовывать транслит в русский текст (правила перевода см. в энциклопедии)" />';
  //echo '<img class="button" src="img/talk/b_sound_off.gif" id="b_sound" title="Не работает" />';
  echo '<object><embed width="1" height="1" src="img/talk/Sound2.swf" quality="high" scale="noscale" wmode="transparent" id="sound" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>';
  echo '<img class="button" src="img/talk/b_smile.gif" title="Смайлики" onclick="smiles();" />';
  echo '</span>';
?>
</td>
<td id="T5"><img src="img/1x1.gif" width="16" /></td>
<td id="T6">
<?
  echo '<span id="buttons2">';
  echo '<img class="button" src="img/talk/a_inv.gif" title="Настройки/Инвентарь" onClick=\'top.linkAction("inv");\' />';
  echo ($level >= 4) ?'<img class="button" src="img/talk/a_trf.gif" title="Передать предметы/кредиты" onClick=\'top.linkAction("perevod");\' />' :'';
  echo ($orden == 1) ?'<img class="button" src="img/talk/a_pal.gif" title="Власть" onClick=\'top.linkAction("orden");\' />' :'';
  echo ($orden == 2) ?'<img class="button" src="img/talk/a_drk.gif" title="Власть" onClick=\'top.linkAction("orden");\' />' :'';
  echo ($clan) ?'<img class="button" src="img/talk/a_kln.gif" title="Клан" onClick=\'top.linkAction("clan");\' />' :'';
  echo '<img class="button" src="img/talk/a_ext.gif" title="Выход из игры" onClick="top.exit();" />';
  echo '<object><embed width="70" height="26" src="img/talk/clock.swf?hours='.date('H').'&minutes='.date('i').'&sec='.date('s').'" type="application/x-shockwave-flash" /></object>';
  echo '</span>';
?>
</td>
<td id="T7"><img src="img/1x1.gif" width="9" /></td>
</tr>
</table>
</body>
</html>