<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=orden&ord=1&spell=11' method='post'>
Укажите логин персонажа,которому необходимо поставить метку:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=15>

<BR><BR>
<input type=submit value=" Вперед " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==1 && $db["otdel"]=="proverka" or $db["login"]=='Мироздатель' or $db["login"]=='ПАЛАЧ' or $db["login"]=='Смотритель'){
$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}

include "conf.php";
$chas = date("H");
$date=date("d.m.Y H:i:s", mktime($chas-$GSM));

$UP = mysql_query("UPDATE users SET metka='$date' WHERE login='$target'");
if($UP){
	print "Метка поставлена персонажу \"$target\".";
}
}
?>