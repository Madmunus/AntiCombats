<link REV="made" href="mailto:smallrat@ukr.net">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=#e4e4e4 topmargin=2>
<?
if ($buy!=""){$type=$bue;}
if($type==""){$type="flower";}
$city=$db["city_game"];




if(!empty($buy)){
if($target==""){$target=$login;}
$num = intval($num);
  if($buy == 'flower'){
   $SQL  = mysql_query("SELECT * FROM `flower` WHERE id = '$item'");
   $DATA = mysql_fetch_array($SQL);

   $price_gos = $DATA["price"];
   $price1    = $price_gos - $db["trade"]/50;
   $price     = sprintf ("%01.2f", $price1);
   $msg       = htmlspecialchars($msg);
   $msg       = str_replace("\n","<BR>",$msg);
   $term      = time() + $DATA["term"]*86400;

   if($db["money"]>=$price && $num<=$r["mountown"]){
$res=mysql_query("INSERT INTO inv(owner,object_id,object_type,object_razdel,term,msg,gift,gift_author) VALUES ('$target','$item','$buy','other','$term','$msg','1','$login')");
if(!$res){echo mysql_error();}

$s2=mysql_query("UPDATE `characters` SET money=money-$price WHERE login='$login'");
if($db["trade"]<90){
$trade=mysql_query("UPDATE `characters` SET tarde=trade+0.01 WHERE login='$login'");
}
$name=$DATA["name"];
say($login,"Вы удачно купили &laquo;$name&raquo; за $price злотых.",$login);
say($target,"$login подарил вам &laquo;$name&raquo; наверное это что-то значит... :)",$login);
if(empty($ip))
{
               if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                }
                       else
                {
                        $ip=getenv('REMOTE_ADDR');
                }
}
$name2="$name ($price зл)";
history($login,'купил',$name2,$ip,'кузня');
$SQL_NUM="UPDATE $buy SET mountown=mountown-1 WHERE id=$item";
$Q=mysql_query($SQL_NUM);

}

  }
elseif($buy == 'gift'){
   $SQL  = mysql_query("SELECT * FROM `gift` WHERE id = '$item'");
   $DATA = mysql_fetch_array($SQL);
   $price_gos = $DATA["price"];
   $price1    = $price_gos - $db["trade"]/50;
   $price     = sprintf ("%01.2f", $price1);
   $msg       = htmlspecialchars($msg);
   $msg       = str_replace("\n","<BR>",$msg);

   if($db["money"]>=$price && $num<=$r["mountown"]){
$res=mysql_query("INSERT INTO inv(owner,object_id,object_type,object_razdel,msg,gift,gift_author) VALUES ('$target','$item','$buy','other','$msg','1','$login')");
if(!$res){echo mysql_error();}

$s2=mysql_query("UPDATE `characters` SET money=money-$price WHERE login='$login'");
if($db["trade"]<90){
$trade=mysql_query("UPDATE `characters` SET tarde=trade+0.01 WHERE login='$login'");
}
$name=$DATA["name"];
say($login,"Вы удачно купили &laquo;$name&raquo; за $price злотых.",$login);
say($target,"$login подарил вам &laquo;$name&raquo; наверное это что-то значит... :)",$login);
if(empty($ip))
{
               if (getenv('HTTP_X_FORWARDED_FOR'))
                {
                        $ip=getenv('HTTP_X_FORWARDED_FOR');
                }
                       else
                {
                        $ip=getenv('REMOTE_ADDR');
                }
}
$name2="$name ($price зл)";
history($login,'купил',$name2,$ip,'кузня');
$SQL_NUM="UPDATE $buy SET mountown=mountown-1 WHERE id=$item";
$Q=mysql_query($SQL_NUM);

}

  }
}

?>
<table cellpadding="0" cellspacing="0" width="100%" height=100%>
<tr>
    <td width=210 align=center bgcolor=DDDDDD class=us2 valign="top" style="border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999; border-left: 1px solid #999999;">
<?

$money1=$db["money"];
$money = sprintf ("%01.2f", $money1);
?><br /><br /><br /><br />
<img src="img/city/smith.gif" alt="Кузница" />


 <form name="move" action="main.php?act=go" method="POST">

        <input name="level" type="hidden" value="municip" />
        <input type=submit class=but value=" Выйти из Лавки " style="height=18;font-size:11 px">
        </form>
<b>У вас с собой</b>:<br /> <B><?echo $money;?></B> зл.<br />
  </td>
  <td align="center" valign="top" >

<br />

<style>
.name{
  color: #660000;
  font-size: 10pt;
  font-weight: bold
}
</style>


<br /><table width="95%" cellspacing="0" border="0" cellpadding="2" height=20>
<td align=center width=100% bgcolor=cccccc class=us2 valign=middle style="border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999; border-left: 1px solid #999999;">
<font class=name>Цветы и подарки</font></td></table><br />

<center>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=gift'>подарки</a>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?type=flower'>Цветы</a>

<table width="95%" cellspacing="0" border="0" cellpadding="0" >
<?


if($buy!=""){$type=$buy;}
if(empty($act)){$act="";}






$seek=mysql_query("SELECT * FROM $type");


if($type == 'flower'){
$g=0;
 while($DATA  = mysql_fetch_array($seek)){
  $g++;
  $id         = $DATA["id"];
  $img        = $DATA["img"];
  $name       = $DATA["name"];
  $price1     = $DATA["price"]-$db["trade"]/50;
  $price      = sprintf ("%01.2f", $price1);
  $price_gos1 = $DATA["price"];
  $price_gos  = sprintf ("%01.2f", $price_gos1);
  $mass       = $DATA["mass"];
  $term       = $DATA["term"];
  $nums       = $DATA["mountown"];

if($nums>0){
?>

<script language="JavaScript">
function check<?echo $g?>(){
 if(document.flower<?echo $g?>.target.value == ''){
   if(confirm('Вы не сказали кому отправить букет! Вы уверены что хотите купить букет самому себе ?')){
    document.flower<?echo $g?>.submit();
   }
 }else{
  document.flower<?echo $g?>.submit();
 }
}
</SCRIPT>
<?
print "<table border=0 width=95% cellpadding=0 cellspacing=0><tr><td><table border=0 bgcolor=#888888 width=100% cellpadding=0 cellspacing=0><tr><td>";
print "<table border=0 width=100% cellpadding=2 cellspacing=0><tr>";
print "<td valign=top bgcolor=#cccccc><span class=usuallyb>";
print "<FORM NAME='flower$g' onSubmit='check$g();' ACTION='?buy=flower&item=$id' METHOD=\"POST\">";
print "<B>$name</B>";
print "</tr></td></table>";
print "<table border=0 width=100% bgcolor=#cccccc cellpadding=1 cellspacing=1><TR><TD valign=top bgcolor=#cccccc width=90>";
print "<center><img src='img/$img' alt='$name'><BR><center>";
if($price<=$db["money"]){
print "<center><a href='#' onClick='check$g();' class=us2>Подарить</a>";
}
else{
print "<small><B>нельзя купить</B></small>";
}
print "</td><td valign=top bgcolor=#cccccc>";
print "Цена: $price_gos (<B>$price</B>) зл.<BR>";
print "Масса: $mass<BR>";
print "Срок жизни: $term дн.<BR>";
print "Подпись:<BR><TEXTAREA CLASS='field' COLS=25 ROWS=3 NAME='msg'></TEXTAREA><BR>";
print "Кому дарить:<BR><input type=text class='field' size=25 name=target><BR>";
print "<B>Осталось: $nums шт.</B>";print "</FORM>";
print "</td></tr></table></td></tr></table></td></tr></table>";
?>
<BR>
<?
}
 }
}
if($type == 'gift'){
$g=0;
 while($DATA  = mysql_fetch_array($seek)){
 $g++;
  $id         = $DATA["id"];
  $img        = $DATA["img"];
  $name       = $DATA["name"];
  $price1     = $DATA["price"]-$db["trade"]/50;
  $price      = sprintf ("%01.2f", $price1);
  $price_gos1 = $DATA["price"];
  $price_gos  = sprintf ("%01.2f", $price_gos1);
  $mass       = $DATA["mass"];
  $wish       = $DATA["wish"];
  $nums       = $DATA["mountown"];

if($nums>0){
?>

<script language="JavaScript">
function checkgift<?echo $g?>(){
 if( document.gift<? echo $g;?>.target.value == ''){
   if(confirm('Вы не указали кому будет подарен подарок, вы хотите подарить его самому себе ?')){
   document.gift<? echo $g;?>.submit();
   }
 }
 else{
  document.gift<? echo $g;?>.submit();
 }
}
</SCRIPT>
<?
print "<table border=0 width=95% cellpadding=2 cellspacing=0><tr>";
print "<td valign=top bgcolor=#cccccc><span class=usuallyb>";
print "<FORM NAME='gift$g' onSubmit='checkgift$g();' ACTION='?buy=gift&item=$id' METHOD=\"POST\">";
print "<B>$name</B>";
print "</tr></td></table>";
print "<table border=0 width=95% bgcolor=#cccccc cellpadding=1 cellspacing=1><TR><TD valign=top bgcolor=#cccccc width=90>";
print "<center><img src='img/$img' alt='$name'><BR><center>";
if($price<=$db["money"]){
print "<center><a href='#' onClick='checkgift$g();' class=us2>Подарить</a>";
}
else{
print "<small><B>нельзя купить</B></small>";
}
print "</td><td valign=top bgcolor=#cccccc>";
print "Цена: $price_gos (<B>$price</B>) зл.<BR>";
print "Масса: $mass<BR>";
print "Описание $wish <BR>";
print "Подпись:<BR><TEXTAREA CLASS='field' COLS=25 ROWS=3 NAME='msg'></TEXTAREA><BR>";
print "Кому дарить:<BR><input type=text class='field' size=25 name=target><BR>";
print "<B>Осталось: $nums шт.</B>";print "</FORM>";
print "</td></tr></table><br />";

}
 }
}
?>
<tr><td colspan=5 style="border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999; border-left: 1px solid #999999;" bgcolor="<?echo $bgcolor;?>"><p align="center">&nbsp;</p></td></tr>
</tr></table>


<br />



<br />

  </td>

  </tr>
</table>












<tr><td colspan=3 style="border-top: 1px solid #999999; border-right: 1px solid #999999; border-bottom: 1px solid #999999; border-left: 1px solid #999999;" bgcolor="<?echo $bgcolor;?>"><p align="center">&nbsp;</p></td></tr>
</tr></table>





</td>
</tr>
<table>




