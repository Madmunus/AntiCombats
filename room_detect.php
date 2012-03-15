<?
defined('AntiBK') or die("Доступ запрещен!");

if ($action == 'go' || $action == 'return')
{
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
  
  $room_return = ($action == 'go') ?false :true;
  $room_go = (!$room_return) ?$room_go :$char_db['last_room'];
  
  if ($room_go != $room)
  {
    if ($room_return && (time() - $char_db['last_return']) < $char_db['return_time'])
      $char->error->Map(114);
    
    if ($char_db['dnd'])
      $adb->query("UPDATE `characters` SET `dnd` = '0', `message` = NULL WHERE `guid` = ?d", $guid);
    
    $char->test->Go($room_go, $room_return);
    
    $adb->query("UPDATE `characters` SET `room` = ?s, `last_go` = ?d, `last_room` = ?s WHERE `guid` = ?d", $room_go ,time() ,$room ,$guid);
    if ($room_return)
      $adb->query("UPDATE `characters` SET `last_return` = ?d WHERE `guid` = ?d", time() ,$guid);
    $adb->query("UPDATE `online` SET `room` = ?s WHERE `guid` = ?d", $room_go ,$guid);
    echoScript("top.cleanChat(); parent.user.updateUsers(); parent.msg.updateMessages(1);");
  }
}

$room = $char->getChar('char_db', 'room');

$mtime = $char->city->getRoomGoTime();
echoScript("top.time_to_go = $mtime;");

switch ($room)
{
  case 'Темный Лес':
  case 'Дубовая роща':
  case 'Березовая роща':
  break;
  case 'centsquare':
  case 'fairstreet':           include("globalmap.php");
  break;
  case 'club':
  case 'passage':
  case 'novice':
  case 'hall_1':
  case 'hall_2':
  case 'hall_3':
  case 'boudoir':
  case 'club2':
  case 'km_7':
  case 'km_6':                 include("club.php");
  break;
  case 'Комната Знахаря':      include("km_5.php");
  break;
  case 'Зал закона':           include("km_8.php");
  break;
  case 'stella':               include("stella.php");
  break;
  case 'Храм':                 include("brak.php");
  break;
  case 'comok':                include("comok.php");
  break;
  case 'bank':                 include("bank.php");
  break;
  case 'Подвал':               include("10x5.php");
  break;
  case 'Казино':               include("casino.php");
  break;
  case 'Блек джек холл':       include("casino1.php");
  break;
  case 'Лотерея':              include("lotto.php");
  break;
  case 'Кости':                include("kosti.php");
  break;
  case 'Ремонтная мастерская': include("rep.php");
  break;
  case 'shop':                 include("shop.php");
  break;
  case 'Регистратура кланов':  include("registratura.php");
  break;
  case 'cityhall':             include("cityhall.php");
  break;
  case 'prision':              include("prison.php");
  break;
  case 'работа':               include("zarabotok.php");
  break;
  case 'mail':                 include("mail.php");
  break;
  case 'Завод':                include("kuzna.php");
  break;
  case 'Пруд':                 include("river.php");
  break;
}
/* if($room=="Скупочный магазин"){
include "sell.php";
die();
break;
if($room=="Хибара скотовода"){
include "catle.php";
die();
break;
if($room=="Арена"){
include "arena.php";
die();
break;
if($room=="Лес"){
include "cell.php";
die();
break;
if($room=="Палатка знахаря"){
include "znahar.php";
die();
break;
if($room=="Домик лесоруба"){
include "lesorub.php";
die();
break;
if($room=="city1"){
include "wheretogo.php";
die();
break; */
?>