<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>


<?
//детект логина из мэйна и данных юзера
$login=$_SESSION["login"];
if(empty($login) or $login!=$db["login"]){
print "<script>top.location.href='index.php';</script>";
}
//настройки для ставок
$pr_1=2;
$pr_2=5;
$pr_3=10;
?>
<center>
<form name="game" action="main.php">
<table border='0' bgcolor='#FF5A00' cellspacing='1' cellpadding='3'>
<tr>
  <td bgcolor='#FF5A00' colspan='2'>
    <center><font size='+2' color='#ffffff'><b>BlackJack</b></font></center>
  </td>
</tr>
<tr>
  <td bgcolor='#ffffff'><b>Совпадение</b></td>
  <td bgcolor='#ffffff'><b>Выигрыш монет</b></td>
</tr>
<tr>
  <td bgcolor='#ffffff'>XXY, YXX</td>
  <td bgcolor='#ffffff'>*<?=$pr_1?></td>
</tr>
<tr>
  <td bgcolor='#ffffff'>XYX</td>
  <td bgcolor='#ffffff'>*<?=$pr_2?></td>
</tr>
<tr>
  <td bgcolor='#ffffff'>XXX</td>
  <td bgcolor='#ffffff'>*<?=$pr_3?></td>
</tr>
<tr>
  <td bgcolor='#ffffff' colspan='2' align="center">
  <?
  $gr_1=rand(0,9);
$gr_2=rand(0,9);
$gr_3=rand(0,9);
print "
<table width=100 border=1>
<td align=\"center\"><b>$gr_1</b></td>
<td align=\"center\"><b>$gr_2</b></td>
<td align=\"center\"><b>$gr_3</b></td>
</table>
";

if($game=="1" and $_SESSION["sc"]==$ses and $gm>0 and $gm<=$db["money"]){


if ($gr_1==$gr_2 and $gr_2==$gr_3){
$prize=$gm*$pr_3;
$prize=$prize-$gm;
$q=mysql_query("UPDATE characters SET money=money+'$prize' WHERE login='$login'");
$db["money"]=$db["money"]+$prize;
print"вы выиграли $prize кр.";
history($login,'выиграл',$prize,$ip,'казино');
}
elseif ($gr_1==$gr_3){
$prize=$gm*$pr_2;
$prize=$prize-$gm;
$q=mysql_query("UPDATE characters SET money=money+'$prize' WHERE login='$login'");
$db["money"]=$db["money"]+$prize;
history($login,'выиграл',$prize,$ip,'казино');
print"вы выиграли $prize кр.";
}
elseif ($gr_1==$gr_2 or $gr_2==$gr_3) {
$prize=$gm*$pr_1;
$prize=$prize-$gm;
$q=mysql_query("UPDATE characters SET money=money+'$prize' WHERE login='$login'");
$db["money"]=$db["money"]+$prize;
history($login,'выиграл',$prize,$ip,'казино');
print"вы выиграли $prize кр.";
}else{
$win=0;
$q=mysql_query("UPDATE characters SET money=money-'$gm' WHERE login='$login'");
$db["money"]=$db["money"]-$gm;
history($login,'проиграл',$gm,$ip,'казино');
print"вы проиграли $gm кр.";
}
}elseif($gm<=0 and $game=="1" and $_SESSION["sc"]==$ses){print "поставьте хоть 1 кр.";}
elseif($gm>$db["money"] and $_SESSION["sc"]==$ses){print "у вас нет столько кредитов";}else{?>&nbsp;<?}
$b = rand(0,9);
$c = rand(0,9);
$d = rand(0,9);
$e = rand(0,9);
$f = rand(0,9);
$g = rand(0,9);
$sescode="$b$c$d$e$f$g";
$_SESSION["sc"]=$sescode;
  ?>
  </td>
</tr>

<tr>
  <td bgcolor='#ffffff'>Ваши деньги</td>
  <td bgcolor='#ffffff'> <?=$db["money"]?> кр.</td>
</tr>
<tr>
  <td bgcolor='#ffffff'>Ставка</td>
  <td bgcolor='#ffffff'><input name="gm" value="1" /> кр.</td>
</tr>
<tr>
<td colspan="2" align="center">
<input type=button class=but value=" Выйти " style="height=18;font-size:11 px" onclick="location.href='main.php?act=go&room_go=casino'">
<input type="hidden" name="game" value="1">
<input type="hidden" name="ses" value="<?=$sescode?>">
<input type="submit" class=but name="" value="Сыграть" style="height=18;font-size:11 px"/>
</td></tr></table></form>
