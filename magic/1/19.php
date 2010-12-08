<?
if(empty($ip)){
?>
<div align=right>
<table border=0 class=inv width=300 height=120>
<tr><td align=left valign=top>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=19' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=19' method='post'>";}?>
Укажите ip который вы хотите заблокировать или разблокировать:<BR><br>
<input type=hidden name=do value=block>
ip: <input type=text name=ip class=new maxlength=20> <input type=submit value='Заблокировать'>
</form>
<?if($db["orden"]==2){
print "<form name='shut_up' action='main.php?act=orden&ord=2&spell=19' method='post'>";}
else {print "<form name='shut_up' action='main.php?act=orden&ord=1&spell=19' method='post'>";}?>
<input type=hidden name=do value=free>
ip: <input type=text name=ip class=new maxlength=20> <input type=submit value='Разблокировать'>
</form>
</td></tr>
</table>
<?
}
else if($db["orden"]==1 && $db["admin_level"]>=7 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["orden"]==2 && $db["admin_level"]>=7){

if(!ereg("[0-9.]$",$ip)){
print "в ip адресе могут присутствовать только цифры и знак \".\"!";
die();
}
if(strlen($ip)>20){
print "ip адрес может содержать не более чем 20 символов.";
die();
}

if($do=="block")
{
    $file = fopen("magic/1/ip.dat", "a+");
    flock($file,2);
    fwrite($file,"$ip|
");
    flock($file,3);
    fclose($file);
    echo"ip-адрес \"".$ip."\" удачно заблокирован!";
}

if($do=="free")
{
 $file = file("magic/1/ip.dat");
 $num = count($file);

 for($i=0;$i<=$num-1;$i++)
 { 
   $arr = explode("|",$file[$i]);
   if($arr[0]==$ip)
   {
    unset($file[$i]);
    $fp1=fopen("magic/1/ip.dat","w"); 
    fwrite($fp1,implode("",$file)); 
    fclose($fp1);
    $find=1;
   }
}
if($find==1)echo"ip-адрес \"".$ip."\" удачно разблокирован!";
}


}
?>