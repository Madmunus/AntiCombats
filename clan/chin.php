<?
if(empty($target)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='chin' action='main.php?act=clan&do=2&a=chin' method='post'>
Укажите логин персонажа:<BR>
<input type=text name='target' class=new size=15>

<BR><BR>
<input type=submit value=" вперед " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["glava"]==1){
$S="select * from characters where login='$target'";
$q=mysql_query($S);
$res=mysql_fetch_array($q);
if(!$res){
print "Персонаж <B>$target</B> не найден в базе данных.";
die();
}
if(empty($new_c)){

?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='chin' action='main.php?act=clan&do=2&a=chin&target=<?echo $target?>' method='post'>
статус:<BR>
<input type=text name='new_c' class=new size=15>

<BR><BR>
<input type=submit value=" сменить статус " class=new>
</form>
</td></tr>
</table>
<?

}
else{

    $sql = "UPDATE characters SET chin='$new_c' WHERE login='$target'";
    $result = mysql_query($sql);

    if($result){
    print "Статус сменен для персонажа $target";
    }
    else{
    echo mysql_error();
    }
}
}