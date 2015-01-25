<?
session_start();
define('AntiBK', true);

include("engline/config.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$step = getVar('step');
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <title>Анти Бойцовский Клуб</title>
  <link rel="SHORTCUT ICON" href="img/favicon.ico" />
  <style type="text/css">
    body      {margin: 0px; background-color: #000000;}
    a:link    {font-weight: normal; color: #f9f7ea; text-decoration: none;}
    a:visited {font-weight: normal; color: #f9f7ea; text-decoration: none;}
    a:active  {font-weight: normal; color: #77684d; text-decoration: none;}
    a:hover   {color: #7e7765; text-decoration: underline;}
    .inup     {border: #817a63 1px double; font-size: 8pt; color: #dfddd3; font-family: verdana, arial, helvetica, sans-serif; background-color: #151616;}
    .btn      {cursor: pointer;}
    .menu     {font-size: 10pt; color: white; font-family: verdana;}
  </style>
  <script src="scripts/jquery.js" type="text/javascript"></script>
  <script src="scripts/reminder.js" type="text/javascript"></script>
</head>
<body class="menu">
<table class="menu" height="100%" width="100%" cellSpacing="0" cellPadding="0" border="0">
  <tfoot><tr><td valign="top">&nbsp;&nbsp;&nbsp;<img src="img/site/18adult0.gif"></td></tr></tfoot>
  <thead>
    <tr><td colspan="3" height="15%"><br><br></td></tr>
    <tr height="205"><td colspan="3" width="100%" valign="top" align="center" background="img/site/start6_02.jpg" style="background-repeat: repeat-x;"><img src="img/site/start2_ru_04.jpg"></td></tr>
  </thead>
  <tbody><tr><td width="100%" valign="top" align="center">
<?
if (!($adb->selectCell("SELECT `reminder` FROM `server_info`;")))
  $step = 'stop';
  
    switch ($step)
    {
      case 'stop':
?>      <div>Восстановление пароля закрыто!<br><br><a href="../">Вернуться на главную</a></div>
<?    break;
      default :
      case '':
        $rem_login = (checks('rem_login')) ?$_SESSION['rem_login'] :'';
?>        <table border="0">
            <tr><td colspan="2" class="menu"><b>Забыли пароль?<br><font color="red" id="error"></font></b><br></td></tr>
            <tr><td class="menu">Укажите логин персонажа</td><td><input type="text" class="inup" size="20" name="login" value="<?echo $rem_login;?>"></td></tr>
            <tr><td colspan="2"><input type="button" class="inup btn" value="Перейти к следующему шагу" onclick="checkRem1();" id="next"></td></tr>
            <tr><td colspan="2"><input type="button" class="inup btn" value="Вернуться" onclick="location.href='../';"></td></tr>
          </table>
<?    break;
      case 2:
        if (!checks('rem_login')) die('Пройдите предыдущий шаг!<br><br><a href="?step='.($step-1).'">Назад</a>');
        $rem_answer = (checks('rem_answer')) ?$_SESSION['rem_answer'] :'';
        $rem_birthday = (checks('rem_birthday')) ?$_SESSION['rem_birthday'] :'';
        $guid = $adb->selectCell("SELECT `guid` FROM `characters` WHERE `login` = ?s", $_SESSION['rem_login']);
        $question = $adb->selectCell("SELECT `secretquestion` FROM `character_info` WHERE `guid` = ?d", $guid);
?>        <table border="0">
            <tr><td colspan="2" class="menu"><b>Забыли пароль?<br><font color="red" id="error"></font></b><br></td></tr>
            <tr><td class="menu">Укажите логин персонажа</td><td><input type="text" class="inup" size="20" name="login" value="<?echo $_SESSION['rem_login'];?>"></td></tr>
<?          echo ($question) ?"<tr><td class='menu'>Ваш вопрос</td><td class='menu'><b>$question</b></td></tr>" :"";
            echo ($question) ?"<tr><td class='menu'>Ваш ответ:</td><td class='menu'><input type='text' class='inup' size='30' name='answer' value='$rem_answer'></td></tr>" :"";
?>          <tr><td class="menu">Ваш день рождения:</td><td><input type="text" class="inup" size="9" name="birthday" value="<?echo $rem_birthday;?>"></td></tr>
            <tr><td colspan="2" class="menu"><small>(день рождения вы указывали при регистрации<br> персонажа в формате dd.mm.yyyy)</small></td></tr>
            <tr><td class="menu">Код:<br><img src="engline/secpic.php" style="border: 1px solid grey; cursor: pointer;" onclick="location.reload();"></td><td><input type="text" class="inup" size="10" name="code"></td></tr>
            <tr><td colspan="2"><input type="button" class="inup btn" value="Выслать пароль на email" onclick="checkRem2();" id="next"></td></tr>
            <tr><td colspan="2"><input type="button" class="inup btn" value="Вернуться" onclick="location.href='?step=1';"></td></tr>
          </table>
<?    break;
      case 3:
?>      <div>Сообщение:<br>Пароль выслан на email, указанный вами при регистрации.<br><a href="../">Вернуться на главную</a></div>
<?    break;
    }
?></td></tr></tbody>
</table>
</body>
</html>