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
include ("engline/data/data.php");
include ("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$test = Test::setguid($guid);
$equip = Equip::setguid($guid);
$mail = Mail::setguid($guid);
$history = History::setguid($guid);
$error = new Error;
$chat = new Chat;
$info = new Info;

$test -> Guid ($guid);
$test -> Block ($db['block']);
$test -> Prision ($db['prision']);
$test -> Battle ($db['battle']);
$test -> Shut ($db['shut']);
$test -> Travm ();
$test -> Up ();
$test -> Items ();
$test -> Regen ();
$test -> Room ();
$test -> WakeUp ();

$action = requestVar ('action', 'none');
$do = requestVar ('do');
$section = requestVar ('section', 1, 7);
$login_mail = (isset($_GET['login_mail'])) ?htmlspecialchars ($_GET['login_mail']) :((isset($_COOKIE['login_mail']) && $_COOKIE['login_mail'] != $guid && $_COOKIE['login_mail'] != $db['login']) ?$_COOKIE['login_mail'] :"");
$credit = requestVar ('credit');
$pass = requestVar ('pass');
$item_id = requestVar ('item_id', 0);
$room_go = requestVar ('room_go');
$stat = requestVar ('stat');
$warning = requestVar ('warning', 0);
$set_name = requestVar ('set_name');
$parameters = requestVar ('parameters');
$level_filter = requestVar ('level_filter', -1, 7);
$name_filter = requestVar ('name_filter', '', 7);
$level_filter = ($level_filter < 0) ?'' :$level_filter;

setCookie ('login_mail', $login_mail,  time () + 3600);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<link rel="StyleSheet" href="styles/style.css" type="text/css">
<script src="scripts/jquery-1.4.3.js" type="text/javascript"></script>
<script src="scripts/jquery.color.js" type="text/javascript"></script>
<script src="scripts/cookies.js" type="text/javascript"></script>
<script src="scripts/main.js" type="text/javascript"></script>
<script src="scripts/show.js" type="text/javascript"></script>
<script src="scripts/dialog.js" type="text/javascript"></script>
<script type="text/javascript">
var link = top.location.href.split("/");
if (link[link.length - 1] != 'game.php')
  top.location.href = "index.php";
</script>
</head>
<body bgcolor="#dedede" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div class="mmoves"></div>
<div id="help"></div>
<div id="hint3" class="ahint"></div>
<div id="hint4" class="ahint"></div>
<input type="hidden" id="x" value="0" style="position: fixed; left: 0px; top: 0px; z-index: 110;" /><input type="hidden" id="y" value="0" style="position: fixed; left: 110px; top: 0px; z-index: 110;" />
<?
$db = $adb -> selectRow ("SELECT * FROM `characters` WHERE `guid` = ?d", $guid);
$stats = $adb -> selectRow ("SELECT * FROM `character_stats` WHERE `guid` = ?d", $guid);
$lang = $adb -> selectCol ("SELECT `key` AS ARRAY_KEY, `text` FROM `server_language`;");

$login = $db['login'];
$sex = $db['sex'];

$city = $db['city'];
$room = $db['room'];

$win = $db['win'];
$lose = $db['lose'];
$draw = $db['draw'];

$admin_level = $db['admin_level'];
$level = $db['level'];
$exp = $db['exp'];
$next_up = $db['next_up'];

$money = $db['money'];
$money_euro = $db['money_euro'];
$mass = $db['mass'];
$maxmass = $db['maxmass'];

$chin = $db['chin'];
$status = $db['status'];
$prof = $db['profession'];
$stat_rang = $db['stat_rang'];
$name_s = $db['clan_short'];
$clan  = $db['clan'];
$orden = $db['orden'];

$shut = $db['shut'];
$date = date ('d.m.y H:i:s', mktime(date ('H') - $GSM));

$equip -> getRoomGoTime ($mtime);
echo "<input type='hidden' id='time_to_go' value='$mtime' />";

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
    
    if ($db['dnd'])
      $adb -> query ("UPDATE `characters` SET `dnd` = '0', `message` = '' WHERE `guid` = ?d", $guid);
    
    $test -> Go ($room_go);
    
    $adb -> query ("UPDATE `characters` SET `room` = ?s, `last_go` = ?d, `last_room` = ?s WHERE `guid` = ?d", $room_go ,time () ,$room ,$guid);
    die ("<script>$('#mes', parent.msg.document).html(''); parent.ref.location = 'refresh.php?go'; location.href = 'main.php';</script>");
  break;
  case 'return':
    if ((time () - $db['last_return']) < $db['return_time'])
      $error -> Map (114);
    
    if ($db['dnd'])
      $adb -> query ("UPDATE `characters` SET `dnd` = '0', `message` = '' WHERE `guid` = ?d", $guid);
    
    $adb -> query ("UPDATE `characters` SET `room` = ?s, `last_room` = ?s, `last_return` = ?d WHERE `guid` = ?d", $db['last_room'] ,$room ,time () ,$guid);
    die ("<script>$('#mes', parent.msg.document).html(''); parent.ref.location = 'refresh.php?go'; location.href = 'main.php';</script>");
  break;
  case 'admin':
    if ($adb -> selectCell ("SELECT `admin_level` FROM `characters` WHERE `guid` = ?d", $guid) > 1)
      include ("adminbar.php");
    else
      die ("<script>location.href = 'main.php';</script>");
  break;
  case 'orden':
    include ("orden.php");
  break;
  case 'inv':
    include ("inv.php");
  break;
  case 'skills':
    include ("skills.php");
  break;
  case 'wear_item':
    $equip -> equipItem ($item_id);
    $error -> Inventory (0);
  break;
  case 'unwear_item':
    $equip -> equipItem ($item_id, -1);
    $error -> Inventory (0);
  break;
  case 'unwear_full':
    $equip -> unWearAllItems ();
    $error -> Inventory (0);
  break;
  case 'wear_set':
    $equip -> equipSet ($set_name);
  break;
  case 'unwear_thing':
    unwear_t ($guid, $item_id);
  break;
  case 'wear_thing':
    wear_t ($guid, $item_id);
  break;
  case 'perevod':
    include ("give.php");
  break;
  case 'clan':
    include ("clan.php");
  break;
  case 'char':
    include ("char.php");
  break;
  case 'form':
    include ("form.php");
  break;
  case 'report':
    include ("report.php");
  break;
  case 'magic':
    include ("magic.php");
  break;
  case 'map':
    include ("map.php");
  break;
  case 'gift':
    $item_info = $adb -> selectCell ("SELECT `id` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d and `wear` = '0' and `mailed` = '0';", $guid ,$item_id) or $error -> Inventory (213);
    $res = $adb -> selectRow ("SELECT `object_type`, 
                                      `object_id` 
                               FROM `character_inventory` 
                               WHERE `id` = ?d", $item_id);
    $obj_type = $res['object_type'];
    $obj_id = $res['object_id'];
    $name = $adb -> selectCell ("SELECT `name` FROM `$obj_type` WHERE `id` = ?d", $obj_id);
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
    $item_info = $adb -> selectCell ("SELECT `id` FROM `character_inventory` WHERE `guid` = ?d and `id` = ?d and `wear` = '0' and `mailed` = '0';", $guid ,$item_id) or $error -> Inventory (213);
    $res = $adb -> selectRow ("SELECT `object_type`, 
                                      `object_id` 
                               FROM `character_inventory` 
                               WHERE `id` = ?d", $item_id);
    $obj_type = $res['object_type'];
    $obj_id = $res['object_id'];
    $name = $adb -> selectCell ("SELECT `name` FROM `$obj_type` WHERE `id` = ?d", $obj_id);
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
    if (empty($target))    include ("giveName.php");
    else
    {
      $adb -> query ("UPDATE `character_inventory` 
                      SET `book_name` = ?s 
                      WHERE `id` = ?d", $target ,$book);
      echo "Заглавие успешно записано в книгу.";
    }
  break;
  case 'enter':
    if (!isset($_SESSION['ENTERED']))
    {
      $id = $adb -> selectCell ("SELECT `id` FROM `history_auth` WHERE `guid` = ?d ORDER BY `id` DESC", $guid) - 1;
      $auth = $adb -> selectRow ("SELECT `ip`, `date` FROM `history_auth` WHERE `guid` = ?d and `id` = ?d", $guid ,$id);
      $_SESSION['ENTERED'] = 1;
      unset ($_SESSION['bankСredit']);
      if ($id && $auth && $auth['ip'] != $_SERVER['REMOTE_ADDR'])
        $chat -> say ($guid, date ('d.m.y H:i', $auth['date'])." <font color='red'><b>ВНИМАНИЕ!</b></font> В предыдущий раз этим персонажем заходили с другого компьютера.");
    }
    include ("room_detect.php");
  break;
  case 'exit':
    $adb -> query ("DELETE FROM `online` WHERE `guid` = ?d", $guid);
    $adb -> query ("UPDATE `characters` SET `last_time` = ?d WHERE `guid` = ?d", time () ,$guid);
    unset ($_SESSION['guid'], $_SESSION['bankСredit'], $_SESSION['ENTERED']);
    die ("<script>top.location.href = 'index.php';</script>");
  break;
  default:
  case 'none':
    include ("room_detect.php");
  break;
}
?>
</body>
</html>