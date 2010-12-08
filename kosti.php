<?
$login = $_SESSION['login'];
include "conf.php";
$conn = @mysql_connect("$base_name","$base_user","$base_pass");
!@mysql_select_db("$db_name",$conn);
mysql_query("SET NAMES cp1251");
$sql = mysql_query("SELECT * FROM characters WHERE login='$login'");
while ($res = mysql_fetch_array($sql)){
$money = $res['money'];
}
  ?>
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td>
<table cellSpacing=0 cellPadding=3 width="90%" border=0 align=center>
<tr>

<td width=30%>
<img src='i/bone/bone.jpg' alt='Кости'>
</td>
<td width=70% valign=top>
<FIELDSET><LEGEND>Правила игры</LEGEND>
Правила игры предельно просты, от Вас требуется только сделать ставку и кинуть кубики.
<br>
Сумма, выпавшая на верхних гранях Ваших кубиков, сравнивается с суммой противника. Победителем считается тот, у кого она больше.
<br>
Выигрыш складывается из Ваших ставок.
</FIELDSET>
<?
function new_game () {
        ?>
        <form action='?casino=kosti&set=game' method=post>
        <P>
        <FIELDSET><LEGEND>Новая игра</LEGEND>
        <center>
        Ставка: <SELECT class=standbut name=type><OPTION value='1' selected>10 кр.<OPTION value='2'>25 кр.<OPTION value='3'>50 кр.<OPTION value='4'>100 кр.<OPTION value='5'>200 кр.</OPTION></SELECT><p><input type=submit value='Начать игру' class=standbut>
        </center>
        </FIELDSET>
        </form>
        </td>
        </tr>
        </table>
        <?
        }
if (!$_GET[set])
{
new_game();
}
if ($_GET[set]==game) {
        if ($_POST[type]==1 or $_POST[type]==2 or $_POST[type]==3 or $_POST[type]==4 or $_POST[type]==5) {
                if ($_POST[type]==1) $st=10;
                if ($_POST[type]==2) $st=25;
                if ($_POST[type]==3) $st=50;
                if ($_POST[type]==4) $st=100;
                if ($_POST[type]==5) $st=200;
                if ($stat[money]>=$st) {
                        if ($_POST[play]==1) {
                                $player_1 = rand(1,6);
                                $player_2 = rand(1,6);
                                $comp_1 = rand(2,6);
                                $comp_2 = rand(2,6);
                           }
?>
<table width=100%>
<tr>
<td width=50%>
<FIELDSET><LEGEND>Игрок №1</LEGEND>
<center>
<script language=JavaScript>show_inf('<?=$stat[user]?>','<?=$stat[id]?>','<?=$stat[level]?>','<?=$stat[rank]?>','<?=$stat[tribe]?>');</script>
</center>
<br>
Деньги: <b><?=$stat[money]?> кр.</b>
<br>
Ставка: <b><?=$st?> кр.</b>
<?
if ($_POST[play]==1) {
?>
<br>
Выпало:
<center>
<img src='i/bone/<?=$player_1?>.gif' alt='<?=$player_1?>'><p><img src='i/bone/<?=$player_2?>.gif' alt='<?=$player_2?>'>
</center>
<?
  }
?>
</FIELDSET>
</td>
<td width=50%>
<FIELDSET><LEGEND>Игрок №2</LEGEND>
<center>
<script language=JavaScript>show_inf('<i>Тень</i>','100','100','100','');</script>
</center>
<br>
Деньги: <b>??? зм.</b>
<br>
Ставка: <b><?=$st?> зм.</b>
<?
if ($_POST['play']==1) {
?>
<br>
Выпало:
<center>
<img src='i/bone/<?=$comp_1?>.gif' alt='<?=$comp_1?>'><p><img src='i/bone/<?=$comp_2?>.gif' alt='<?=$comp_2?>'>
</center>
<?
  }
?>
</FIELDSET>
</td>
</tr>
</table>
<form action='?gameroom=1&set=game' method=post>
<input type="hidden" name="type" value="<?=$_POST[type]?>">
<input type="hidden" name="play" value="1">
<FIELDSET><LEGEND>Действия</LEGEND>
<center>
<? if ($_POST[play]==1) {
        $summa_player = $player_1+$player_2;
        $summa_comp = $comp_1+$comp_2;
        if ($summa_player>$summa_comp) {
                mysql_query("UPDATE characters SET money=money+".$st." WHERE login='$login'");

                                $db["money"]=$db["money"]+$st;
                echo "<p><center><font class=sysmessage>Поздравляем! Вы победили и получаете <b>$st зм.</b>!</font></center><p>";
        }
        if ($summa_player<$summa_comp) {
                                mysql_query("UPDATE characters SET money=money-".$st." WHERE login='$login'");

                                $db["money"]=$db["money"]+$st;
                echo "<p><center><font class=sysmessage>Вы проиграли! У Вас снимается  <b>$st зм.</b>!</font></center><p>";
        }
        if ($summa_player==$summa_comp) {
                echo "<p><center><font class=sysmessage>Ничья! Бросьте кости еще раз!</font></center><p>";
        }
        echo "<input type=submit value='Сыграть еще раз' class=standbut>";
        }
        else {
                echo "<input type=submit value='Кинуть кости' class=standbut>";
        }
?> <input type=button value='Новая игра' class=standbut onclick='window.location.href="kosti.php&tmp="+Math.random();""'>
</center>
</FIELDSET>
</form>
</td>
</tr>
</table>
<?
                 }
                 else {
                         echo "<p><center><font class=blocked>У Вас недостаточно денег!</font></center><p>";
                         new_game();
                 }
        }
        else {
                echo "<p><center><font class=blocked>Не сделана ставка!</font></center><p>";
                new_game();
        }
}
?>