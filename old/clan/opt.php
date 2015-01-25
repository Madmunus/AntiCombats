<?
if(empty($site_n)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<form name='chin' action='main.php?act=clan&do=2&a=opt' method='post'>
Сайт:<BR>
<input type=text name='site_n' value='<?echo $clan_site?>' class=new size=30><BR>
История:<BR>
<textarea cols=40 rows=10 class=new name='history_n'>
<?
echo $history;
?>
</textarea>

<BR><BR>
<input type=submit value=" вперед " class=new>
</form>
</td></tr>
</table>
<?
}
else if($db["glava"]==1){

    $history = str_replace("\n","<BR>",$history_n);

    $sql = "UPDATE clan SET site='$site_n',story='$history' WHERE name_short='$clan_s'";
    $result = mysql_query($sql);

    if($result){
    print "Настройки клана изменены.";
    }
    else{
    echo mysql_error();
    }

}