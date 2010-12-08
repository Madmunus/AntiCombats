<?
if(empty($login)){
print "<script>top.location.href='index.php';</script>";
}
include ("engline/functions/functions.php");
$test = new test;
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<?

$city=$db["city_game"];
$walk = $db["walk"];


if(empty($act)){$act = "";}

$test -> Move ($login, $db);
$test -> Battle ($db);

?>
<base target="_self">
<style type="text/css">
<!--
a:link {
	color: #0000FF;
}
a:visited {
	color: #0000FF;
}
a:hover {
	color: #0099FF;
}
a:active {
	color: #0000FF;
}
.style1 {
	color: #FF3300;
	font-weight: bold;
}
-->
</style></head>
<body bgcolor="#EEEEEE" topmargin="2" leftmargin="2">

<div align="center">
  <p class="style1">Внимание! При вырубке леса на вам может напасть волк! <br>Внимание! При вырубке леса на вам может напасть разбойник!<br> Будте аккуратней</p>
  <p><strong>Здесь вы можете заработать деньги. </strong></p>
  <p><strong>Добыть дерево:</strong> <a href="main.php?act=go&room_go=dub">Дуб</a> и <a href="main.php?act=go&room_go=bereza">Береза</a></p>
  <p>&nbsp;</p>
  <a href="main.php?act=go&room_go=klen">Клён</a> - пока не работает
  <p>&nbsp;</p>
  
    <input name="button222" type=button class=new onClick="location.href='main.php?act=go&room_go=municip';" value="Главная площадь">
  </a></strong></p>
</div>
