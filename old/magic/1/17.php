<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='shut_up' action='main.php?act=orden&ord=1&spell=17' method='post'>
Укажите логин зависшего:<BR><small>(можно щелкнуть по логину в чате)</small><br>
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
else if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["login"]=='ПАЛАЧ'){


$S="select * from characters where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}


         mysql_query("UPDATE characters set battle = '0', battle_pos = '', battle_team = '', battle_opponent = '' where login='$target'");

         mysql_query("delete from team1 where player='$target'");
         mysql_query("delete from team2 where player='$target'");
$SSS = mysql_query("SELECT * FROM characters WHERE login='$target'");
$DDD = mysql_fetch_array($SSS);
$target_id = $DDD["id"];
 mysql_query("UPDATE battles set status = 'finished' where creator_id='$target_id'");
print "Персонаж успешно выкинут из боя.";
}
?>