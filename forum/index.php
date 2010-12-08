<?
// Разбиваем на страницы
include "conf.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_query("SET CHARSET cp1251");
    if(!mysql_select_db($db_name,$data)
		){
     print "Ошибка при подключении к БД<BR>";

     echo mysql_error();
     die();
    }
$f = addslashes($f);


$numo = mysql_numrows(mysql_query("SELECT * FROM topics WHERE cat='".$f."'")); // Число топиков в данной категории

$np=10; // Число новостей на странице
$pages_count = @ceil($numo/$np); // Определяем число страниц

if (is_numeric($p)) {
if ($p>$pages_count) $p=1; // Если страница превышает макс. число, то открываем первую
if ($p=="" or $p=="0") { $p="1"; }
elseif ($p!="1") { $min=$np; }} else $p=1;


$l1=$p*$np-$np;
$l2=$np;

$pages = "";

for($i=1; $i<=$pages_count; $i++){
if ($p != $i) $pages .= " <a href=?f=".$f."&p=".$i.">[".$i."]</a>";
else $pages .= " <b>[$i]</b>"; }
//

$conf=mysql_fetch_array(mysql_query("SELECT title FROM forums where name='".$f."'"));
echo"<br><center><B class=title><U>Форум :: \"".$conf['title']."\"</U></B></center><br>";

echo"<script language=JavaScript>
function ins (text) {
document.all.addtext.focus();
document.all.addtext.value+= ''+text+''; }
</script>";

$topic=mysql_query("SELECT * FROM topics where cat='".$f."' ORDER BY fixed DESC, last_update DESC limit ".$l1.",".$l2."");



for ($i=0; $i<mysql_num_rows($topic); $i++) {
        $topics=mysql_fetch_array($topic);

        echo"
        <TABLE width=95% cellspacing=0 cellpadding=0 border=0>
        <TR>
        <TD height=20 background='i/forum/";

        if ($topics['fixed'] == 1)
                echo"fixed_line";
        else
                echo"standart_line";

        echo".gif' valign=center>
        <TABLE cellspacing=0 cellpadding=0 width=100%>
        <TR><TD><IMG src='i/forum/1.gif' WIDTH=22 HEIGHT=1><a href='?topic=".$topics['id']."&f=".$f."' title='Дата создания: ".$topics['date']."'>".$topics['title']."</a> - [ <SCRIPT>show_inf('".$topics['poster']."','".$topics['p_id']."','".$topics['p_level']."','".$topics['p_rank']."','".$topics['p_tribe']."');</SCRIPT> ] - <b>Ответов:</b> ".mysql_numrows(mysql_query("SELECT * FROM posts where top_id='$topics[id]'"))."</TD><TD WIDTH=220 align=right>";


        if (($stat['rank'] >= 11 && $stat['rank'] <= 14) || $stat['rank'] >= 99) {
                echo" <small>[ ";

                if ($topics['fixed'] == 1)
                        echo" <a href='?f=".$f."&unfix=".$topics['id']."&".$now."'><small>Снять прикрепление</small></a>";
                else
                        echo" <a href='?f=".$f."&fix=".$topics['id']."&".$now."'><small>Прикрепить</small></a>";

                echo" | <a href='?f=".$f."&deltop=".$topics['id']."'><small>Удалить</small></a>";

                echo" ]</small>";

        }


        echo"
        </TD>
        </TR>
        </TABLE>

        </TD>
        </TR>
        <TR HEIGHT=4><TD colspan=2><IMG SRC='i/forum/1.gif'></TD></TR>
        <TR>
        <TD colspan=2>";

        $topics['text'] = HtmlSpecialChars($topics['text']);

        $topics[text]=str_replace("&lt;b&gt;","",$topics[text]);
        $topics[text]=str_replace("&lt;/b&gt;","",$topics[text]);

        $topics[text]=str_replace("&lt;i&gt;","",$topics[text]);
        $topics[text]=str_replace("&lt;/i&gt;","",$topics[text]);

        $topics[text]=str_replace("&lt;u&gt;","",$topics[text]);
        $topics[text]=str_replace("&lt;/u&gt;","",$topics[text]);

        $topics[text]=str_replace("\n","",$topics[text]);
        $topics[text]=str_replace("&lt;br&gt;","",$topics[text]);

        for ($j=0; $j<180; $j++) {
                echo $topics['text'][$j];
        }

        if (!empty($topics['text'][$j]))
                echo "...";
        else
                echo"";

        echo"</TD>
        </TR>
        </TABLE>

        <HR COLOR=C1997C WIDTH=80%><BR>";
}



if (!empty($pages)) echo "<center>Страницы: ".$pages."</center><BR>";



echo"

<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 bgcolor=C1997C>

<TR HEIGHT=35>
<TD ALIGN=CENTER style='BORDER-BOTTOM: 0px'>
<font style='FONT-SIZE: 10pt'><b><U>Добавить свой вопрос в форум</U></b></font><br>
</TD>
</TR>

<TR>
<TD ALIGN=CENTER style='BORDER-TOP: 0px'>

<table border=0 cellspacing=0 cellpadding=0>
<form action='' method=post>
<tr>
<td></td><td><input name=addtitle class=input style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif; FONT-SIZE: 9pt; WIDTH: 550px'></td></tr>

<tr><td align=left valign=center WIDTH=45>
<input type=radio name=addicon value=0 checked> <img src='i/forum/0.gif' alt='Иконка для вопроса' width=15 height=15>
<input type=radio name=addicon value=1> <img src='i/forum/1.gif' alt='Иконка для вопроса' width=15 height=15>
<input type=radio name=addicon value=2> <img src='i/forum/2.gif' alt='Иконка для вопроса' width=15 height=15>
<input type=radio name=addicon value=3> <img src='i/forum/3.gif' alt='Иконка для вопроса' width=15 height=15>
<input type=radio name=addicon value=4> <img src='i/forum/4.gif' alt='Иконка для вопроса' width=15 height=15>
<input type=radio name=addicon value=5> <img src='i/forum/5.gif' alt='Иконка для вопроса' width=15 height=15>
</td><td>

<textarea cols=10 rows=10 name=addtext style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif; FONT-SIZE: 9pt; WIDTH: 550px' ></textarea></td><td valign=center align=center WIDTH=45>

<img src='i/forum/bold.gif' onclick=\"ins('<b></b>');\" style='CURSOR: Hand' alt='Жирный'><br><br>
<img src='i/forum/italic.gif' onclick=\"ins('<i></i>');\" style='CURSOR: Hand' alt='Курсив'><br><br>
<img src='i/forum/underline.gif' onclick=\"ins('<u></u>');\" style='CURSOR: Hand' alt='Подчёркнутый'>

</td></tr>

<tr><td></td><td>
<input type=submit name=addtop class=input value=\"Добавить вопрос\" style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; border-style: outset; border-width: 2; WIDTH: 273px'>
<input type=reset class=input value='Очистить' style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; border-style: outset; border-width: 2; WIDTH: 274px'>
</td></tr>
</form>
</table>

</TD>
</TR>
</TABLE>
<BR>
";

?>