<?
session_start();
define('AntiBK', true);

include("engline/config.php");
include("engline/data.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");
include("engline/token/bootstrap.php");

$guid = getGuid();

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$char = Char::initialization($guid, $adb);

$char->test->Guid();
$char->test->Block();
$char->test->Prison();
$char->test->Shut();
$char->test->Travm();
$char->test->Battle();
$char->test->Up();
$char->test->Items();
$char->test->Regen();
$char->test->Room();
$char->test->WakeUp();
$char->test->Effects();

create_token($guid);

$char_db = $char->getChar('char_db', '*');
$char_stats = $char->getChar('char_stats', '*');
$lang = $char->getLang();

$action = getVar('action', 'none');
$do = getVar('do');
$section = getVar('section', 1, 7);
$credit = getVar('credit');
$pass = getVar('pass');
$item_id = getVar('item_id', 0);
$item_slot = getVar('item_slot');
$room_go = getVar('room_go');
$stat = getVar('stat');
$error = getVar('error', 0);
$set_name = getVar('set_name');
$parameters = getVar('parameters');
$level_filter = getVar('level_filter', -1, 7);
$name_filter = getVar('name_filter', '', 7);
$level_filter = ($level_filter < 0) ?'' :$level_filter;

$login_mail = getVar('login_mail', '', 5);
if ($action == 'enter')
{
  $login_mail = '';
  setCookie('login_mail', '');
}
else if ($action == 'exit')
  setCookie('PHPSESSID', '');
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
  <script src="scripts/visual.js" type="text/javascript"></script>
  <script src="scripts/main.js" type="text/javascript"></script>
  <script src="scripts/show.js" type="text/javascript"></script>
  <script src="scripts/dialog.js" type="text/javascript"></script>
  <script type="text/javascript">
    try{top.checkGame();} catch(e) {location.href = 'index.php';}
    $.ajaxSetup({headers: {'X-Csrf-Token': '<?echo $_SESSION['token'];?>'}});
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
$mass = $char_stats['mass'];
$maxmass = $char_stats['maxmass'];

$chin = $char_db['chin'];
$name_s = $char_db['clan_short'];
$clan  = $char_db['clan'];
$orden = $char_db['orden'];

switch ($action)
{
  case 'admin':
    if ($admin_level > 1)
      include("module/adminbar.php");
    else
      $char->error->Map();
  break;
  case 'orden':
    include("module/orden.php");
  break;
  case 'inv':
  case 'wear_item':
  case 'wear_set':
  case 'unwear_item':
  case 'unwear_full':
    include("module/inventory.php");
  break;
  case 'skills':
    include("module/skills.php");
  break;
  case 'zayavka':
    include("module/zayavka.php");
  break;
  case 'unwear_thing':
    unwear_t($guid, $item_id);
  break;
  case 'wear_thing':
    wear_t($guid, $item_id);
  break;
  case 'perevod':
    include("module/give.php");
  break;
  case 'clan':
    include("module/clan.php");
  break;
  case 'char':
    include("module/char.php");
  break;
  case 'shape':
  case 'security':
  case 'info':
    include("module/form.php");
  break;
  case 'report':
    include("module/report.php");
  break;
  case 'magic':
    include("module/magic.php");
  break;
  case 'map':
    include("module/map.php");
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
    gift($guid, $item_id, $to);
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
    if (empty($target))    include("module/giveName.php");
    else
    {
      $adb->query("UPDATE `character_inventory` 
                   SET `book_name` = ?s 
                   WHERE `id` = ?d", $target ,$book);
      echo "Заглавие успешно записано в книгу.";
    }
  break;
  case 'enter':
    if (!checks('last_t'))
    {
      $id = $adb->selectCell("SELECT `id` FROM `history_auth` WHERE `guid` = ?d ORDER BY `id` DESC", $guid) - 1;
      $auth = $adb->selectRow("SELECT `ip`, `date` FROM `history_auth` WHERE `guid` = ?d and `id` = ?d", $guid, $id);
      if ($id && $auth && $auth['ip'] != $_SERVER['REMOTE_ADDR'])
        $char->chat->say($guid, date('d.m.y H:i', $auth['date'])." <font color='red'><b>ВНИМАНИЕ!</b></font> В предыдущий раз этим персонажем заходили с другого компьютера.");
    }
    include("module/room_detect.php");
  break;
  case 'exit':
    $adb->query("DELETE FROM `online` WHERE `guid` = ?d", $guid);
    $char->setChar('char_db', array('last_time' => time()));
    toIndex('main');
  break;
  default:
  case 'none':
  case 'go':
  case 'return':
    include("module/room_detect.php");
  break;
}
?>
</body>
</html>