<?
defined('AntiBK') or die ("Доступ запрещен!");

switch ($room)
{
  case 'Темный Лес':
  case 'Дубовая роща':
  case 'Березовая роща':
  break;
  case 'centplosh':
  case 'fairstreet':           include ("globalmap.php");
  break;
  case 'castle':
  case 'km_1':
  case 'km_2':
  case 'km_3':
  case 'km_4':
  case 'castle2':
  case 'km_7':
  case 'km_6':                 include ("castle.php");
  break;
  case 'Комната Знахаря':      include ("km_5.php");
  break;
  case 'Зал закона':           include ("km_8.php");
  break;
  case 'stella':               include ("stella.php");
  break;
  case 'Храм':                 include ("brak.php");
  break;
  case 'comok':                include ("comok.php");
  break;
  case 'bank':                 include ("bank.php");
  break;
  case 'Подвал':               include ("10x5.php");
  break;
  case 'Казино':               include ("casino.php");
  break;
  case 'Блек джек холл':       include ("casino1.php");
  break;
  case 'Лотерея':              include ("lotto.php");
  break;
  case 'Кости':                include ("kosti.php");
  break;
  case 'Ремонтная мастерская': include ("rep.php");
  break;
  case 'shop':                 include ("shop.php");
  break;
  case 'Регистратура кланов':  include ("registratura.php");
  break;
  case 'cityhall':             include ("cityhall.php");
  break;
  case 'prision':              include ("prison.php");
  break;
  case 'работа':               include ("zarabotok.php");
  break;
  case 'mail':                 include ("mail.php");
  break;
  case 'Завод':                include ("kuzna.php");
  break;
  case 'Пруд':                 include ("river.php");
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