<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=orden&ord=1&spell=21' method='post'>
<?
$n=0;
$QUER=mysql_query("SELECT * FROM clan");
$nums = mysql_num_rows($QUER);
for($h=$nums-1;$h>=0;$h--){
$search=mysql_fetch_array($QUER);
$nm = $search['name_short'];
$name = $search['name'];

$log.= "<nobr><input type=radio name=target value='$nm'> <a href='clan_inf.php?clan=$nm' target='_blank'><img border=0 src=img/clan/$nm.gif alt='Информация о клане $name'></a>$name<BR>";
}
?>
<center><b>Кланы</b></center>
<?
echo $log;
?>
<BR>
<input type=submit value=" Редактировать " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["login"]=='ПАЛАЧ'){

if($act1=="save"){
if($do){
mysql_query("delete from clan where id='$do'");
print "<font color=red>Клан удален!</font>";
die();
}
$SQL="update clan set name='$name',name_short='$ns',glava='$glav',site='$site',story='$story' where id='$id'";
$q=mysql_query($SQL);
if($q){
print "Клан удачно сохранен!";
die();
}
else {
print "Ошибка сохранения!"; die();
}
}


$S="select * from clan where name_short='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Клан <B>$target</B> не найден в базе данных.";
die();
}
$id = $res["id"];
$ns = $res["name_short"];
$name = $res["name"];
$glav = $res["glava"];
$site = $res["site"];
$story = $res["story"];
?><center>
<form name='chin' action='main.php?act=orden&ord=1&spell=21&target=$ns&act1=save' method='post'>
<table border=0>
<?
echo"
<script>
function del(){
if(confirm('Вы уверены, что хотите удалить этот клан?')){location.href='main.php?act=orden&ord=1&spell=21&target=$ns&act1=save&do=$id'};
}
</script>
<tr><td>id клана:</td><td>$id <a href='clan_inf.php?clan=$ns' class=nick target=_blank><small><u>смотреть информацию</u></small></a></td></tr>
<tr><td>название клана:</td><td><input type=text size=30 maxlength=15 name=name value='$name'></td></tr>
<tr><td>латинское название:</td><td><input type=text size=30 maxlength=15 name=ns value='$ns'></td></tr>
<tr><td>глава:</td><td><input type=text size=30 name=glav value='$glav'></td></tr>
<tr><td>сайт:</td><td><input type=text size=30 name=site value='$site'></td></tr>
<tr><td>история:</td><td><textarea cols=60 rows=15 name=story>$story</textarea></td></tr>
<input type=hidden name=id value='$id'>
<tr><td><input type=submit value='Сохранить данные'></td><td></form>";?><input type=button onclick="del();" value='  Удалить клан  '></td></tr></table>

<?
}
?>