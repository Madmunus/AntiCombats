<?

$f = addslashes($f);
$topic = addslashes($topic);

$conf=mysql_fetch_array(mysql_query("SELECT title FROM forums where name='".$f."'"));
echo"<br><center><B class=title><U>Форум :: \"".$conf['title']."\"</U></B></center><br>";

echo"<script language=JavaScript>
function ins (text) {
document.all.addtext.focus();
document.all.addtext.value+= ''+text+''; }
</script>";



$topics=mysql_fetch_array(mysql_query("SELECT * FROM topics where id='$topic'"));
if (empty($topics['id'])) { $err="Указанная Вами тема не найдена!"; } else {


        // Разбиваем на страницы
        $numo = mysql_numrows(mysql_query("SELECT * FROM posts where top_id='$topic'")); // Число топиков в данной категории

        if ($p=="" or $p=="0" or !isset($p)) { $p="1"; }

        $np=15; // Число новостей на странице

        $pages_count = @ceil($numo/$np); // Определяем число страниц

        if (is_numeric($p)) {
        if ($p>$pages_count or $p<0) $p=1; // Если страница превышает макс. число, то открываем первую

        elseif ($p!="1") { $min=$np; }} else $p=1;

        $l1=$p*$np-$np;
        $l2=$np;

        $pages = "";

        for($i=1; $i<=$pages_count; $i++){
        if ($p != $i) $pages .= " <a href=?topic=$topic&f=$f&p=$i>[<b>$i</b>]</a>";
        else $pages .= " <b>[$i]</b>"; }
        //

        $icon="<img src='".$img_server."/i/forum/".$topics['icon'].".gif'>"; // Иконка топа
        echo"<h4 title='Дата создания: ".$topics['date']."'>".$icon." ".$topics['title']."</h4>";

        if ($p==0 || $p==1 || !isset($p)) {

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
                <TR><TD><IMG src='i/forum/1.gif' WIDTH=22 HEIGHT=1><SCRIPT>show_inf('".$topics['poster']."','".$topics['p_id']."','".$topics['p_level']."','".$topics['p_rank']."','".$topics['p_tribe']."');</SCRIPT></TD><TD WIDTH=220 align=right>";

                echo"
                </TD>
                </TR>
                </TABLE>

                </TD>
                </TR>
                <TR HEIGHT=4><TD colspan=2><IMG SRC='i/forum/1.gif'></TD></TR>
                <TR>
                <TD colspan=2>";

                $topics['text'] = stripslashes($topics['text']);

                echo $topics['text'];

                echo"</TD>
                </TR>
                </TABLE>

                <HR COLOR=C1997C WIDTH=80%><BR>";

        }





        // Посты юзеров
        $post=mysql_query("SELECT * FROM posts where top_id='".$topic."' ORDER BY id LIMIT ".$l1.", ".$l2."");

        for ($i=0; $i<mysql_num_rows($post); $i++) {
                $posts=mysql_fetch_array($post);

                echo"
                <TABLE width=95% cellspacing=0 cellpadding=0 border=0>
                <TR>
                <TD height=20 background='i/forum/standart_line.gif' valign=center>
                <TABLE cellspacing=0 cellpadding=0 width=100%>
                <TR><TD><IMG src='i/forum/1.gif' WIDTH=22 HEIGHT=1><SCRIPT>show_inf('".$posts['poster']."','".$posts['p_id']."','".$posts['p_level']."','".$posts['p_rank']."','".$posts['p_tribe']."');</SCRIPT></TD><TD WIDTH=220 align=right>";


                if (($stat['rank'] >= 11 && $stat['rank'] <= 14) || $stat['rank'] >= 99) {
                        echo" <small>[ <a href='?topic=".$topic."&f=".$f."&delpost=".$posts['id']."&p=".$p."'> Удалить</a> ]</small>";

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

                $posts['text'] = stripslashes($posts['text']);

                echo $posts['text'];

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
        <font style='FONT-SIZE: 10pt'><b><U>Добавить ответ</U></b></font><br>
        </TD>
        </TR>

        <TR>
        <TD ALIGN=CENTER style='BORDER-TOP: 0px'>

        <table border=0 cellspacing=0 cellpadding=0>
        <form action='' method=post>

        <tr><td>

        <textarea cols=10 rows=10 name=addtext style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif; FONT-SIZE: 9pt; WIDTH: 550px'></textarea></td><td valign=center align=center WIDTH=45>

        <img src='i/forum/bold.gif' onclick=\"ins('<b></b>');\" style='CURSOR: Hand' alt='Жирный'><br><br>
        <img src='i/forum/italic.gif' onclick=\"ins('<i></i>');\" style='CURSOR: Hand' alt='Курсив'><br><br>
        <img src='i/forum/underline.gif' onclick=\"ins('<u></u>');\" style='CURSOR: Hand' alt='Подчёркнутый'>

        </td></tr>

        <tr><td>
        <input type=submit name=add class=input value=\"Добавить ответ\" style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; border-style: outset; border-width: 2; WIDTH: 273px'>
        <input type=reset class=input value='Очистить' style='Background-COLOR: DAB69D; Color: 8A6246; FONT-WEIGHT: Bold; border-style: outset; border-width: 2; WIDTH: 274px'>
        </td></tr>
        </form>
        </table>

        </TD>
        </TR>
        </TABLE>
        <BR>
        ";

}
?>