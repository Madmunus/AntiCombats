<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=22' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=22' method='post'>";}?>
Укажите логин персонажа, чье личное дело вы хотите дополнить:<BR><small>(можно щелкнуть по логину в чате)</small><br>
<input type=text name='target' class=new size=15>
<BR>
<BR>
<input type=submit value=" Использовать магию " class=new>
</form>
</td></tr>
</table>
<script>Hint3Name = 'target';</script>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=10 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["orden"]==2 && $db["admin_level"]>=10){


$S="select * from users where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
if ($db["login"]!=Смотритель){
if ($db["login"]!=Мироздатель){
if($res["login"]==Мироздатель or $res["login"]==Смотритель){
print "Вы не можете редактировать личное дело этого персонажа.";
die();
}}}

if($save!='1'){
$delo = $res["delo"];
$delo=str_replace("<BR>","\n",$delo);
if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=22&target=$target&save=1' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=22&target=$target&save=1' method='post'>";}
?><center>
<table><td>Пожалуйста соблюдайте следующие правила ввода текста:<br> <font color=red>- </font>не редактируйте чужие строки<br> <font color=red>- </font>пропускание строки разрешено только для отделения своих строк, от чужих<br> <font color=red>- </font>не используйте многократное повторение символов <BR></td></table>
<textarea rows="10" name="delo" cols="52" class="new"><? echo $delo; ?></textarea>
<br>
<input type=submit value=" Отредактировать " class=new></center></form>
<?
}
else{
$delo=str_replace("<","",$delo);
$delo=str_replace(">","",$delo);
$delo=str_replace("\n","<BR>",$delo);
$sql = mysql_query("UPDATE users SET delo='$delo' WHERE login='$target'");
print "Отредактировано личное дело персонажа \"$target\".";
}


}
?>