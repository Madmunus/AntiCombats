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

$chat_list = $char->getChar('char_db', 'chat_list');
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<link rel="StyleSheet" href="styles/chat.css" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
try {top.checkGame();} catch(e) {location.href = 'index.php';}

var TimerOnline = -1;
var autorefresh = <?echo $chat_list;?>;

function updateUsers ()
{
  $.post('ajax_chat.php', {'do': 'refreshusers'}, function (data){
    var list = top.exploder(data);
    
    if (TimerOnline)
      clearTimeout(TimerOnline);
    
    $('#user_list').html(list[0]);
    if (autorefresh)
      TimerOnline = setTimeout (updateUsers, 10000);
	});
}

function changeAutoRefresh ()
{
  autorefresh = !autorefresh;
  $.post('ajax_chat.php', {'do': 'change_button', 'but': 'list', 'val': autorefresh}, function (data){
    var result = top.exploder(data);
    
    if (autorefresh)
      updateUsers();
    else
      clearTimeout(TimerOnline);
	});
}

$(function (){
  updateUsers();
  if (autorefresh)
    $('[name=auto_refresh]').attr('checked', 'checked');
});
</script>
</head>
<body class='users'>
<br><center><input class='nav' type='button' value='Обновить' onclick='updateUsers();this.blur();'></center>
<div align="left" id="user_list"></div>
<input type="checkbox" name="auto_refresh" onclick="changeAutoRefresh();"> Обновлять автомат.
</body>
</html>