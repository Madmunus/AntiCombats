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

$char_db = $char->getChar('char_db', 'orden', 'level', 'clan', 'chat_filter', 'chat_sys', 'chat_update', 'chat_translit');
ArrToVar($char_db);
?>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <link rel="StyleSheet" href="styles/chat.css" type="text/css" />
  <script src="scripts/jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
    try {top.checkGame();} catch(e) {location.href = 'index.php';}

    var chat = new Array();
    chat['filter'] = <?echo $chat_filter;?>;
    chat['sys'] = <?echo $chat_sys;?>;
    chat['slow'] = (<?echo $chat_update;?> == 10) ?false :true;
    chat['translit'] = <?echo $chat_translit;?>;

    function changeButtonState (button)
    {
      var src = (chat[button]) ?'img/talk/b_'+button+'_off.gif' :'img/talk/b_'+button+'_on.gif';
      chat[button] = !chat[button];
      $.post('ajax_chat.php', {'do': 'change_button', 'but': button, 'val': chat[button]}, function (data){
        var result = top.exploder(data);
        $('#'+button).attr('src', src);
      });
    }

    function sendMessage ()
    {
      var message = $("#text").val();
      $("#text").val('');
      if (chat['translit'])
        message = translate(message);
      $.post('ajax_chat.php', {'do': 'sendmessage', 'h': message}, function (data){
        var result = top.exploder(data);
        top.msg.updateMessages();
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
      rslength();
      $('body').on('click', '.button', function (){
        if (id = $(this).attr('id'))
          changeButtonState(id);
      }).on('keydown', '#text', function (e){
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
    <span id="buttons1">
    <img class="button" src="img/talk/b_clear.gif" title="Очистить строку ввода/Чат" onclick="clean();" />
    <img class="button" src="img/talk/b_filter_<?echo ($chat_filter) ?'on' :'off';?>.gif" id="filter" title="Показывать в чате только сообщения адресованные мне" />
    <img class="button" src="img/talk/b_sys_<?echo ($chat_sys) ?'on' :'off';?>.gif" id="sys" title="Показывать в чате системные сообщения" />
    <img class="button" src="img/talk/b_slow_<?echo ($chat_update == 60) ?'on' :'off';?>.gif" id="slow" title="Медленное обновление чата (раз в минуту)" />
    <img class="button" src="img/talk/b_translit_<?echo ($chat_translit) ?'on' :'off';?>.gif" id="translit" title="Преобразовывать транслит в русский текст (правила перевода см. в энциклопедии)" />
    <!--TODO: <img class="button" src="img/talk/b_sound_off.gif" id="b_sound" title="Не работает" />-->
    <object><embed width="1" height="1" src="img/talk/Sound2.swf" quality="high" scale="noscale" wmode="transparent" id="sound" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" /></object>
    <img class="button" src="img/talk/b_smile.gif" title="Смайлики" onclick="smiles();" />
    </span>
  </td>
  <td id="T5"><img src="img/1x1.gif" width="15" /></td>
  <td id="T6">
    <span id="buttons2">
    <img class="button" src="img/talk/a_inv.gif" title="Настройки/Инвентарь" onClick=\'top.linkAction("inv");\' />
<?
    echo ($level >= 4) ?'<img class="button" src="img/talk/a_trf.gif" title="Передать предметы/кредиты" onClick=\'top.linkAction("perevod");\' />' :'';
    echo ($orden == 1) ?'<img class="button" src="img/talk/a_pal.gif" title="Власть" onClick=\'top.linkAction("orden");\' />' :'';
    echo ($orden == 2) ?'<img class="button" src="img/talk/a_drk.gif" title="Власть" onClick=\'top.linkAction("orden");\' />' :'';
    echo ($clan) ?'<img class="button" src="img/talk/a_kln.gif" title="Клан" onClick=\'top.linkAction("clan");\' />' :'';
?>
    <img class="button" src="img/talk/a_ext.gif" title="Выход из игры" onClick="top.exit();" />
    <object><embed width="70" height="26" src="img/talk/clock.swf?hours=<?echo date('H');?>&minutes=<?echo date('i');?>&sec=<?echo date('s');?>" type="application/x-shockwave-flash" /></object>
    </span>
  </td>
  <td id="T7"><img src="img/1x1.gif" width="9" /></td>
</tr>
</table>
</body>
</html>