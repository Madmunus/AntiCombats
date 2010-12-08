<?php
Error_Reporting(E_ALL & ~E_NOTICE);
$admin_logen="1";
$admin_passward="1";
if ($submit<1){if(($usirname==$admin_logen) and ($passward==$admin_passward)){
setcookie(usirname,$usirname);
setcookie(passward,$passward);
setcookie(submit,www);
}else{
if (ereg("[<>\\/-]",$usirname) or ereg("[<>\\/-]",$passward) or ereg("[<>\\/-]",$sumbit)) {print "?!"; exit();}
print"
<html>
<title>АнтиБК+</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<meta http-equiv=\"Content-Language\" content=\"ru\">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=\"#dedede\">
<form action='ch.php' method=post><table width=\"100%\" height=\"100%\"><tr><td align=center><table class=inv><tr><td>Логин: </td><td><input type=text name=usirname></td></tr>
<tr><td>Пароль: </td><td><input type=password name=passward></td></tr>
<tr><td></td><td><input type=submit name=sumbit value=Войти></td></tr></table></td></tr><td height=30%></td></tr></table></body></html>";
 exit;}
}
?>
<html>
<title>АнтиБК+ - чат.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<!--<META HTTP-EQUIV="Refresh" CONTENT="60"; URL="ch.php">-->
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor="#f2f0f0">
<?
include "conf.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);



$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);


$SEEK = mysql_query("SELECT * FROM chat WHERE id!=0");
$numi = mysql_num_rows($SEEK);

if($numi>150){
$D = mysql_query("DELETE FROM chat");
print "log cleaned.";
}

global $h, $words;
$name=$login;
if ($h) {
        $chas = date("H");
        $minute = date("i");
        $mes = date("m");
        $dat = date("d");
        $year = date("Y");

        $dname=date("d.m.Y.H", mktime($chas-$GSM));

        $h = htmlspecialchars($h);
        $h = str_replace("\n","",$h);
        $h = "<font color=$color>$h</font>";
        $time = time();

        $d=date("H:i", mktime($chas-$GSM, $minute));
        $S = mysql_query("INSERT INTO chat(date,name,room,msg,class,date_stamp,city) VALUES('$d','$logen','Зал воинов','$h','us','$time','Demons City')");
        if($S){print "message added...";}else{echo mysql_error();}

        $to    = "to [FloodeR]";
        $pos = strpos($h, $to);
        if($pos !== false){
        include "shut.php";

        }

}




$q      = mysql_query("SELECT * FROM `characters`");
$all    = mysql_num_rows($q);

$ON_S   = mysql_query("SELECT * FROM `online`");
$online = mysql_num_rows($ON_S);
if($act!=protocol){
if($del==1){mysql_query("DELETE FROM chat");}
print "
<script>
function del(){
if(confirm('Вы уверены, что хотите удалить все логи чата?')){top.location.href='?del=1'};
}
</script><center>Всего: $all чел. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Он-лайн: $online чел.</center>";
?><center><form action='ch.php' method=post><input value=protocol type=hidden name=act><input type=submit value="Логи редактирований" class=new></form><input type=button value="Очистить" class=new onclick="del();"><br><br><input type=button value="Обновить" class=new onclick="javascript:location.href='ch.php'">
<form name="talker" action='ch.php' id="F1" method=post><input name=logen type="text" value="Мироздатель"> <input name=color type="text" value="black"> <input type="normal" name=h maxlength="240" size="80"> <input type=button value="Go" style="cursor: hand" onclick="document.F1.sbm.click()" /><input type="submit" name="sbm" style="display:none" /></form><?
$GET = mysql_query("SELECT * FROM chat");
while($DATA = mysql_fetch_array($GET)){
$msg = $DATA['msg'];
$date = $DATA['date'];
$sender = $DATA['name'];

if(!empty($sender)){ $name = "[<span class=nick>$sender</span>]";}
else {$name = $sender;}

$chat.= "$n<span class=date>$date</span> $name <span class=msg>$msg</span><BR>";

}

?><table width="94%"><td><?echo $chat;?></td></table></body></html>
<?
}
if($act==protocol){
if($del==1){mysql_query("DELETE FROM protocol_adm");}
print "
<script>
function del(){
if(confirm('Вы уверены, что хотите удалить все логи редактирований?')){top.location.href='?act=protocol&del=1'};
}
</script>
<center>Всего: $all чел. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Он-лайн: $online чел.</center>";
?>

<center><br><input type=button value="Логи чата" class=new onclick="javascript:location.href='ch.php'"><br><br><input type=button value="Очистить" class=new onclick="del();"><table width="94%"><td><?
if($num=="")$num=0;
$GET = mysql_query("SELECT * FROM protocol_adm");
$number = mysql_num_rows($GET);


$pages=$number/20;
$pages = explode(".",$pages);
echo"Страницы: ";
for($i=0;$i<=$pages[0];$i++){
$num1=$i*20;

echo"<a href=ch.php?act=protocol&num=$num1 class=nick><b>$i</b></a>&nbsp";

}
$n=0;
$GETs = mysql_query("SELECT * FROM protocol_adm ORDER BY id DESC LIMIT $num, 20");
$nums = mysql_num_rows($GETs);

for($h=$nums-1;$h>=0;$h--){
$DATA = mysql_fetch_array($GETs);
$date_time = $DATA['date_time'];
$login = $DATA['login'];
$target = $DATA['target'];
$msg = $DATA['msg'];
$n++;

$log.= "<table border=1 width=94%><tr><td><span class=date>$date_time</span> <span class=nick>$login</span> отредактировал персонажа <span class=nick>$target</span>.<br><span class=msg>$msg</span></td></tr></table>";
if ($n>=20)break;
}

?>
</td></table><table width="94%"><?echo $log;?></table></body></html>

<?
}