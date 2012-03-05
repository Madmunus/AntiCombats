<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/data/data.php");
include("engline/functions/functions.php");

$guid = getGuid();

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid();
$char->test->Block();
$char->test->Prision();
$char->test->Battle();
$char->test->Shut();
$char->test->Travm();
$char->test->Up();
$char->test->Items();
$char->test->Regen();
$char->test->Room();
$char->test->WakeUp();
$char->test->Effects();

$char_db = $char->getChar('char_db', '*');
$char_stats = $char->getChar('char_stats', '*');
$lang = $char->getLang();

$action = requestVar('action', 'none');
$do = requestVar('do');
$section = requestVar('section', 1, 7);
$credit = requestVar('credit');
$pass = requestVar('pass');
$item_id = requestVar('item_id', 0);
$item_slot = requestVar('item_slot');
$room_go = requestVar('room_go');
$stat = requestVar('stat');
$error = requestVar('error', 0);
$set_name = requestVar('set_name');
$parameters = requestVar('parameters');
$level_filter = requestVar('level_filter', -1, 7);
$name_filter = requestVar('name_filter', '', 7);
$level_filter = ($level_filter < 0) ?'' :$level_filter;

$login_mail = requestVar('login_mail', '', 5);
if ($action == 'enter')
{
  $login_mail = '';
  setCookie('login_mail', '');
}
else if ($login_mail == $guid || lowercase($login_mail) == lowercase($char_db['login']))
  $char->error->Map(218);
else if ($login_mail)
  setCookie('login_mail', $login_mail,  time() + 3600);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<link rel="StyleSheet" href="styles/style.css" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/jquery.color.js" type="text/javascript"></script>
<script src="scripts/cookies.js" type="text/javascript"></script>
<script src="scripts/main.js" type="text/javascript"></script>
<script src="scripts/show.js" type="text/javascript"></script>
<script src="scripts/dialog.js" type="text/javascript"></script>
<script src="scripts/visual.js" type="text/javascript"></script>
<script type="text/javascript">
try {top.checkGame();} catch(e) {location.href = 'index.php';}
</script>
</head>
<body>
<div id="hint3"></div>
<?
$login = $char_db['login'];
$sex = $char_db['sex'];

$city = $char_db['city'];
$room = $char_db['room'];

$win = $char_db['win'];
$lose = $char_db['lose'];
$draw = $char_db['draw'];

$admin_level = $char_db['admin_level'];
$level = $char_db['level'];
$exp = $char_db['exp'];
$next_up = $char_db['next_up'];

$money = $char_db['money'];
$money_euro = $char_db['money_euro'];
$mass = $char_stats['mass'];
$maxmass = $char_stats['maxmass'];

$chin = $char_db['chin'];
$status = $char_db['status'];
$f_style = $char_db['f_style'];
$stat_rang = $char_db['stat_rang'];
$name_s = $char_db['clan_short'];
$clan  = $char_db['clan'];
$orden = $char_db['orden'];

$date = date ('d.m.y H:i:s', mktime(date ('H') - $GSM));

$mtime = $char->city->getRoomGoTime();
echoScript("var time_to_go = $mtime;");

switch ($action)
{
  case 'go':
    /* $file = file ("telegraf/telegraf.dat");
    $num = count ($file);
    for ($i = 0; $i <= $num - 1; $i++)
    { 
      $row = explode ("|", $file[$i]);
      if (isset($row[2]) && $row[2] == $guid)
      {
        unset ($file[$i]);
        $string = "&nbsp<span style='color: #DC143C; background-color: #FFFACD;'><small>".DATE_TIME."</small></span> <a href=javascript:top.SayTo(\'почтальон\');>(<b>почтальон</b>)</a> <span style='color: #000000;'> &nbsp;<i>персонаж «$row[1]» $row[0] передал вам телеграмму:</i> $row[3] </span><br>";
      }
    }
    $fp1 = fopen ("telegraf/telegraf.dat", "w");
    flock ($fp1, 2);
    fwrite ($fp1, implode ("", $file));
    flock ($fp1, 3);
    fclose ($fp1); */
    
    if ($char_db['dnd'])
      $adb->query("UPDATE `characters` SET `dnd` = '0', `message` = NULL WHERE `guid` = ?d", $guid);
    
    $char->test->Go($room_go);
    
    $adb->query("UPDATE `characters` SET `room` = ?s, `last_go` = ?d, `last_room` = ?s WHERE `guid` = ?d", $room_go ,time() ,$room ,$guid);
    $adb->query("UPDATE `online` SET `room` = ?s WHERE `guid` = ?d", $room_go ,$guid);
    echoScript("top.cleanChat(); parent.user.updateUsers(); parent.msg.updateMessagesGo(); location.href = 'main.php';");
  break;
  case 'return':
    if ((time () - $char_db['last_return']) < $char_db['return_time'])
      $char->error->Map(114);
    
    if ($char_db['dnd'])
      $adb->query("UPDATE `characters` SET `dnd` = '0', `message` = NULL WHERE `guid` = ?d", $guid);
    
    $char->test->Go($char_db['last_room'], true);
    
    $adb->query("UPDATE `characters` SET `room` = ?s, `last_room` = ?s, `last_return` = ?d WHERE `guid` = ?d", $char_db['last_room'] ,$room ,time() ,$guid);
    $adb->query("UPDATE `online` SET `room` = ?s WHERE `guid` = ?d", $char_db['last_room'] ,$guid);
    echoScript("top.cleanChat(); parent.user.updateUsers(); parent.msg.updateMessagesGo();");
    $char->error->Map();
  break;
  case 'admin':
    if ($admin_level > 1)
      include("adminbar.php");
    else
      $char->error->Map();
  break;
  case 'orden':
    include("orden.php");
  break;
  case 'inv':
  case 'wear_item':
  case 'unwear_item':
  case 'unwear_full':
  case 'wear_set':
    include("inventory.php");
  break;
  case 'skills':
    include("skills.php");
  break;
  case 'zayavka':
    include("zayavka.php");
  break;
  case 'unwear_thing':
    unwear_t ($guid, $item_id);
  break;
  case 'wear_thing':
    wear_t ($guid, $item_id);
  break;
  case 'perevod':
    include("give.php");
  break;
  case 'clan':
    include("clan.php");
  break;
  case 'char':
    include("char.php");
  break;
  case 'form':
    include("form.php");
  break;
  case 'report':
    include("report.php");
  break;
  case 'magic':
    include("magic.php");
  break;
  case 'map':
    include("map.php");
  break;
  case 'gift':
    $item_info = $adb->selectCell("SELECT `id` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d and `wear` = '0' and `mailed` = '0';", $guid ,$item_id) or $char->error->Inventory(213);
    $res = $adb->selectRow("SELECT `object_type`, 
                                    `object_id` 
                             FROM `character_inventory` 
                             WHERE `id` = ?d", $item_id);
    $obj_type = $res['object_type'];
    $obj_id = $res['object_id'];
    $name = $adb->selectCell("SELECT `name` FROM `$obj_type` WHERE `id` = ?d", $obj_id);
?>
<script>
    if (confirm ('Вы уверены что хотите подарить "<?echo $name;?>" персонажу <?echo $to;?>?'))
      location.href='main.php?action=gift_conf&item_id=<?echo $item_id;?>&to=<?echo $to;?>';
    else
      location.href='main.php?action=perevod&target=<?echo $to;?>';
</script>
<?
  break;
  case 'gift_conf':
    gift ($guid, $item_id, $to);
  break;
  case 'give':
    $item_info = $adb->selectCell("SELECT `id` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d and `wear` = '0' and `mailed` = '0';", $guid ,$item_id) or $char->error->Inventory(213);
    $res = $adb->selectRow("SELECT `object_type`, 
                                    `object_id` 
                             FROM `character_inventory` 
                             WHERE `id` = ?d", $item_id);
    $obj_type = $res['object_type'];
    $obj_id = $res['object_id'];
    $name = $adb->selectCell("SELECT `name` FROM `$obj_type` WHERE `id` = ?d", $obj_id);
?>
<script>
    if (confirm ('Вы уверены что хотите передать "<?echo $name;?>" персонажу <?echo $to;?>?'))
      location.href = 'main.php?action=give_conf&item_id=<?echo $item_id;?>&to=<?echo $to;?>';}
    else
      location.href = 'main.php?action=perevod&target=<?echo $to;?>';
</script>
<?
  break;
  case 'give_conf':
    give ($guid, $item_id, $to);
  break;
  case 'giveName':
    if (empty($target))    include("giveName.php");
    else
    {
      $adb->query("UPDATE `character_inventory` 
                   SET `book_name` = ?s 
                   WHERE `id` = ?d", $target ,$book);
      echo "Заглавие успешно записано в книгу.";
    }
  break;
  case 'enter':
    if (!isset($_SESSION['last']))
    {
      $id = $adb->selectCell("SELECT `id` FROM `history_auth` WHERE `guid` = ?d ORDER BY `id` DESC", $guid) - 1;
      $auth = $adb->selectRow("SELECT `ip`, `date` FROM `history_auth` WHERE `guid` = ?d and `id` = ?d", $guid ,$id);
      unset($_SESSION['bankСredit']);
      if ($id && $auth && $auth['ip'] != $_SERVER['REMOTE_ADDR'])
        $char->chat->say($guid, date('d.m.y H:i', $auth['date'])." <font color='red'><b>ВНИМАНИЕ!</b></font> В предыдущий раз этим персонажем заходили с другого компьютера.");
    }
    include("room_detect.php");
  break;
  case 'exit':
    $adb->query("DELETE FROM `online` WHERE `guid` = ?d", $guid);
    $adb->query("UPDATE `characters` SET `last_time` = ?d WHERE `guid` = ?d", time() ,$guid);
    toIndex('main');
  break;
  default:
  case 'none':
    include("room_detect.php");
  break;
}
?>
</body>
</html>