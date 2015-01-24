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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<link rel="stylesheet" type="text/css" href="styles/chat.css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
try {top.checkGame();} catch(e) {location.href = 'index.php';}

var TimerMessage = -1;

function cMenu ()
{
  $('#oMenu').css('visibility', 'hidden');
}

function updateMessages (go)
{
  var add_go = (go) ?1 :0;
  $.post('ajax_chat.php', {'do': 'refreshmessage', 'go': add_go}, function (data){
    var messages = top.exploder(data);
    
    if (TimerMessage)
      clearTimeout(TimerMessage);
    
    $('#mes').append(messages[0]);
    $(window).scrollTop($('#mes').height());
    TimerMessage = setTimeout('updateMessages()', messages[1]*1000);
	});
}

$(function (){
  $('body').on('contextmenu', 'span', function (e){
    var x, y, login, login2, i1, i2;
    e.preventDefault();
    x = e.pageX - 3;
    y = e.pageY;
    y -= (e.pageY + 50 > document.body.clientHeight) ?50 :2;
    login = $(this).text();
    if ((i1 = login.indexOf('[')) >= 0 && (i2 = login.indexOf(']')) > 0)
      login = login.substring(i1+1, i2);

    $('#oMenu').html('<a class="menuItem" href="javascript:top.AddTo(\''+login+'\');">TO</a>'+
                     '<a class="menuItem" href="javascript:top.AddToPrivate(\''+login+'\');">PRIVATE</a>'+
                     '<a class="menuItem" href="info.php?log='+ login.replace(' ', '%20') +'" target="_blank" return true;">INFO</a>');
    $('#oMenu').css({'left': x + "px", 'top': y + "px", 'visibility': "visible"});
  }).on('contextmenu', '.menuItem', function (e){
    e.preventDefault();
  }).on('click', '.menuItem', function (){
    cMenu();
  }).on('mouseleave', '#oMenu', function (){
    cMenu();
  }).on('click', 'img', function (){
    var image = $(this).attr('src');
    image = image.split("/");
    image = image[image.length - 1].replace('.gif', '');
    $('#text', top.talk.document).val($('#text', top.talk.document).val() +' :'+image+': ');
  });
  updateMessages();
});
</script>
</head>
<body topmargin="0" leftmargin="0" bgcolor="#f2f0f0">
<div id="mes"></div>
<div id="oMenu" class="menu"></div>
</body>
</html>