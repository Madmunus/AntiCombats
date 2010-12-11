<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>


<?php


$zzz = $_SESSION["login"];
$g = mysql_query("SELECT * FROM sapojn WHERE login='$zzz'");
$w = mysql_query("SELECT * FROM sapojn WHERE login='$zzz'");
$num = mysql_num_rows($w);
$dat = mysql_fetch_array($g);
if($dat["num"]<1000){
$zarplata = '0.1';
}
elseif($dat["num"]>999){
$zarplata = '0.15';
}
if($num == "1"){

?>

<table border=1 bordercolor=black width=100% bgcolor=#fffbbb><tr><td>
<table border=0 width=100% cellpadding=0 cellspacing=0 height=20>
<tr>

<td bgcolor=#fffbbb><B>Фабрика "Бронь"</B>
</td>

</tr>
</table>

</td></tr>
</table>

<br>

<table border=1 width=100% bordercolor=black bgcolor=#fffbbb>
<tr>
<td width=20% valign=top>
&nbsp&nbsp&nbsp&nbsp<a href='?act=kuznaclose' class=us2>Уволится</a><br>
&nbsp&nbsp&nbsp&nbsp<a href='main.php?act=go&room_go=centplosh' class=us2>Выход</a><br>
</td>
<td valign=top>

<?


print "<table border=0 bordercolor=black width=100% cellpadding=0 cellspacing=0><tr><td><table border=0 bgcolor=#fffbbb width=100% cellpadding=0 cellspacing=0><tr><td>";
print "<table border=0 width=100% cellpadding=2 cellspacing=0><tr>";
print "<td valign=top bgcolor=#fffbbb><span class=usuallyb>";

?>



<table cellspacing=0 cellpadding=0 width="400" border=0>
                 <TR>

                <TD>Работник:</TD>
                <TD><b><? echo $dat["login"]; ?></b></TD>
              </TR>

                 <TR>

                <TD>Стаж:</TD>
                <TD><b><? echo $dat["num"]; ?></b>  (кол. вещей)</TD>
              </TR>

                 <TR>

                <TD>Зарплата:</TD>
                <TD><b><? echo $zarplata; ?></b> Ст.</TD>
              </TR>

                 <TR>

                <TD>
<form><input type=hidden name=act value=kuznawork>
        <select name="obj_type" class="field" style="width=203;">
        <option value="armor">Броня</option>
        <option value="helmet">Шлемы</option>
        <option value="shield">Шиты</option>
        <option value="pants">Штаны</option>
        <option value="boots">Обувь</option>
        <option value="perchi">Перчатки</option>
        <option value="poyas">Пояса</option>
        </select>
<input type=submit value='Работать'></form>
</td>
              </TR>

</table>





</td></tr></table>
<?


          }
          elseif($num == "0"){
include 'conf.cfg';
$data = mysql_connect($base_name, $base_user, $base_pass);
    if(!mysql_select_db($db_name,$data)){
mysql_query("SET NAMES cp1251");
     print "Ошибка при подключении к БД<BR>";
     echo mysql_error();
     die();
    }

          ?>
<table border=1 bordercolor=black width=100% bgcolor=#fffbbb><tr><td>
<table border=0 width=100% cellpadding=0 cellspacing=0 height=20>
<tr>

<td bgcolor=#fffbbb><B>Фабрика "Бронь"</B>
</td>

</tr>
</table>

</td></tr>
</table>



<?



print "<table border=0 bordercolor=black width=100% cellpadding=0 cellspacing=0><tr><td><table border=0 bgcolor=#fffbbb width=100% cellpadding=0 cellspacing=0><tr><td>";
print "<table border=0 width=100% cellpadding=2 cellspacing=0><tr>";
print "<td valign=top bgcolor=#fffbbb><span class=usuallyb>";

?>

<b>Фабрика "Бронь"<br><br></b>
Условия труда:
<ol>
<li>Минимальный уровень - 2.</li>
<li>Ващ труд оплачивается поминутно.</li>
<li>1 минута работы - <b>0.10</b> Ст. </li>
<li>При стаже более 1000 штук 1 минута - <b>0.15</b> Ст.</li>
<li>Если вы сделали брак: штраф - ваша минутная зарплата <br>+ стаж уменьшается на одну единицу.</li>
<li>Вы сами выбераете класс вещи. <br>Но вы не можете выбирать саму вещь.</li>
</ol>
&nbsp&nbsp&nbsp&nbsp<a class=us2 href='?act=kuznaopen'>Устроится на работу</a><br>
&nbsp&nbsp&nbsp&nbsp<a href='main.php?act=go&room_go=centplosh' class=us2>Выход</a><br>
</td>
<td valign=top>
<?
print "</td></tr></table></td></tr></table></td></tr></table></td></tr></table>";

}
?>