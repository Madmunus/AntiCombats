<?
session_start();
include "conf.php";
include "functions.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
    if(!mysql_select_db($db_name,$data)){
     print "Ошибка при подключении к БД<BR>";
     echo mysql_error();
     die();
    }
$S = mysql_query("SELECT * FROM `characters` WHERE login='$login'");
$db = mysql_fetch_array($S);
if(empty($_SESSION["bankLogin"]) || empty($_SESSION["bankCheck"]) || empty($_SESSION["login"])){
 echo "Вы не в банке чтоб-бы делать выписки";
 die();
}
if(empty($datei)){$datei = date("d.m.Y");$date_t=$datei;}
else{$date_t = $datei;}
?>
<body topmargin="5" leftmargin="5" bgcolor="#EEEEEE" style="font-family: Verdana; font-size: 10pt">

<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<form action='?act=view' method="POST">
Национальный Банк Капитолия.<BR>
Выписка переводов по счету #<?echo $_SESSION["bankCheck"]?><BR>
Выдать выпискку за число:<BR>
<table border=0><TR>
<td>
дата(дд.мм.гггг):<BR>
<input type=text class=new style="width=150" name=datei value="<?echo $date_t?>">
</td>
</tr><tr><td>
<input type=submit class=but value="просмотреть" style="width=150">
</td></tr></table>
</form>

<?
  if($act == 'view'){
   $SQL = mysql_query("SELECT * FROM history_bank WHERE `check` = '".$_SESSION["bankCheck"]."' OR `check2` = '".$_SESSION["bankCheck"]."' ORDER BY `date` ASC");
   $in_data = explode(".",$datei);
   echo "Выписка переводов по счету #".$_SESSION["bankCheck"]." за $datei:<BR>";
     while( $CHECK = mysql_fetch_array($SQL) ){
      $year  = substr($CHECK["date"], 0, 4);

      $month = substr($CHECK["date"], 5, 2);

      $day   = substr($CHECK["date"], 8, 2);

      $hour  = substr($CHECK["date"], 11, 2);

      $min   = substr($CHECK["date"], 14, 2);

      $sec   = substr($CHECK["date"], 17, 2);

       if($in_data[0] == $day && $in_data[1] == $month && $in_data[2] == $year){
         if($CHECK["operation"]=='in'){$op = 'положил на счет';}
         if($CHECK["operation"]=='out'){$op = 'снял со счета';}
         if($CHECK["operation"]=='check_in' && $CHECK["check"]==$_SESSION["bankCheck"]){$op = 'перевел на счет #'.$CHECK["check2"];}
         if($CHECK["operation"]=='check_in' && $CHECK["check2"]==$_SESSION["bankCheck"]){$op = 'перевел со счета #'.$CHECK["check"];}
         echo "<span class=date>$hour:$min:$sec</span> ".printShortInf( $CHECK["login"] )." $op <B>".$CHECK["summ"]."</B> зл.<BR>";
       }
     }
  }
?>