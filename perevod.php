<?
session_start();
if(empty($login)){
print "<script>top.location.href='index.php';</script>";
}
?>
<title>АнтиБК+ - отчеты о переводах.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<?
include "conf.php";
if (ereg("[<>\\/-]",$per) or ereg("[<>\\/-]",$tar) or ereg("[<>\\/-]",$n_date)) {print "?!"; exit();}
$per=htmlspecialchars($per);
$tar=htmlspecialchars($tar);
$n_date=htmlspecialchars($n_date);
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET CHARSET cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
if($db["orden"]=1 and $db["admin_level"]>3 or $db["login"]=='Мироздатель' or $db["login"]=='Смотритель' or $db["orden"]=2 and $db["admin_level"]>3){



if(empty($tar)){$tar="";}

if(empty($tar)){
$chas = date("H");
$d=date("d.m.Y", mktime($chas-$GSM));	
?>
<body  background="images/bg-inv.gif">
<form name='per' action='perevod.php' method='post'>
Введите логин персонажа и дату(дд.мм.гггг):<BR>
<small>Оставьте поле дата пустым, чтобы просмотреть ВСЕ переводы персонажа</small><BR>
<input type=text class=new name=tar>&nbsp
<input typy=text class=new name=n_date value=<?echo $d;?>>
<input type=submit value="  OK  " class=new>
</form>
<?
}

else{
$s="select * from characters where login='$tar'";
$q=mysql_query($s);
$res=mysql_fetch_array($q);
if(!$res){
print "Песонаж <B>$tar</B> не найден в БД!!!<BR>";
print "<a href='perevod.php' class=us2>вернуться</a>";
die();
}

if(empty($n_date)){
print "Отчет о переводах персонажа <B>$tar</B>.<BR>";
$all=0;

$SSS = mysql_query("SELECT * FROM perevod WHERE login='$tar'");
print "<table border=0 class=new width=750 bgcolor=#dcdcdc><TR bgcolor=#dcdcdc>";
print "<td width=10>#</td><td>дата</td><td>время</td><td>логин</td><td>действие</td><td>предмет</td><td>ip-адресс</td><td>направление</td></tr>";
while($DATA = mysql_fetch_array($SSS)){
$log = $DATA["login"];
$login2 = $DATA["login2"];
$action = $DATA["action"];
$item = $DATA["item"];
$ip = $DATA["ip"];
$time = $DATA["time"];
$date = $DATA["date"];
$log = "<font color=#000099>$log</font>";


print "<tr bgcolor=#e4e4e4><td>$all</td><Td>$date</td><Td>$time</td><td>$log</td><td>$action</td><td>$item</td><td>$ip</td><td>$login2</td></tr>";
$all++;
}
print "</table>";
if($all==0){
print "У персонажа <B>$tar</B> небыло переводов.";
}

}

if(!empty($n_date)){
print "Отчет о переводах персонажа <B>$tar</B> за <B>$n_date</b>.<BR>";
$all=0;

$SSS = mysql_query("SELECT * FROM perevod WHERE date='$n_date' AND login='$tar'");
print "<table border=0 class=new width=700 bgcolor=#dcdcdc><TR bgcolor=#dcdcdc>";
print "<td width=10>#</td><td>время</td><td>логин</td><td>действие</td><td>предмет</td><td>ip-адресс</td><td>направление</td></tr>";
while($DATA = mysql_fetch_array($SSS)){
$log = $DATA["login"];
$login2 = $DATA["login2"];
$action = $DATA["action"];
$item = $DATA["item"];
$ip = $DATA["ip"];
$time = $DATA["time"];
$log = "<font color=#000099>$log</font>";


print "<tr bgcolor=#e4e4e4><td>$all</td><Td>$time</td><td>$log</td><td>$action</td><td>$item</td><td>$ip</td><td>$login2</td></tr>";
$all++;
}
print "</table>";
if($all==0){
print "На данное число у персонажа <B>$tar</B> небыло переводов.";
}
}

}
}
else {
print "Вам сюда нельзя:)";}
?></body>