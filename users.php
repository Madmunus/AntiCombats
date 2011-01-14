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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<link rel="StyleSheet" href="styles/main.css" type="text/css">
<script src="scripts/jquery-1.4.4.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
var TimerOnline = -1;
var autorefresh = false;

function updateUsers ()
{
  $.post('ajax_users.php', 'do=refreshusers', function (data){
    if (TimerOnline)
      clearTimeout(TimerOnline);
    
    if (data)
    {
      $('#user_list').html(data);
      if (autorefresh)
        TimerOnline = setTimeout ('updateUsers()', 10000);
    }
	});
}

function changeAutoRefresh ()
{
  autorefresh = !autorefresh;
  if (autorefresh)
    updateUsers ();
  else
    clearTimeout(TimerOnline);
}

$(document).ready(function (){
  updateUsers ();
});
</script>
</head>
<body bgColor="#faf2f2">
<br><center><input type='button' class='nav' value='Обновить' onclick='updateUsers();this.blur();'></center>
<div align="left" id="user_list"></div>
<input type="checkbox" name="auto_refresh" onclick="changeAutoRefresh();"> Обновлять автомат.
</body>
</html>