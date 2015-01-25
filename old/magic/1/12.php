<?

if(empty($tema) or empty($msg)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=14' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=14' method='post'>";}?>
<table border=0 width=500>
<tr>
<td>
Тема:
</td>
<td>
<input type=text name=tema size=60 class=new maxlength=60>
</td>
</tr>
<tr>
<td>
Текст новости:
</td>
<td>
<textarea cols=80 rows=6 name=msg class=new></textarea><Br>
<small>Внимание! Пишите новость корректно, потом вы не сможете ее редактировать!</small>
</td>
</tr>
</table>
<table><td><br>
<input type=submit class=new value="Создать новость">
</form>
</td></table>
</td></table>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=8 or $db["login"]==Мироздатель or $db["orden"]==2 && $db["admin_level"]>=8 or $db["login"]==Смотритель){
$w0="INSERT INTO news(login,tema,msg) VALUES ('$login','$tema','$msg')";
$res=mysql_query($w0);
if (!$res){
print "Ошибка!!! Новость не добавлена!";}
else {
print "Новость добавлена!";}
}

?>