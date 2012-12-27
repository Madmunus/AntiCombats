<?
$S = mysql_query("SELECT * FROM clan_zayavka");
$i = 0;
if($conf == ''){$conf="2";}
if($conf == 0){
    if(empty($otkaz_msg)){
    print "Вы не ввели причину отказа!<BR>";
    }
    else{
    $S = mysql_query("DELETE FROM clan_zayavka WHERE name_short='$clan_s'");
    $GL = mysql_query("SELECT mail FROM characters WHERE login='$glava'");
    $GL_DAT = mysql_fetch_array($GL);
    $mail = $GL_DAT["mail"];
    $msg = "Здраствуйте, ув. $glava!\n";
    $msg .= "Паладинский отдел регистрации кланов рассмотрел Вашу заявку и отказал Вам по причине:\n\n";
    $msg .= "$otkaz_msg\n\n";
    $msg .= "Если Вы не согласны с решением отдела, обратитесь на форум в соответствующий раздел.\n";
    $msg .= "\nС Уважением Паладинский отдел регистрации кланов.\n";
    $msg .= "\n\n\n\nЭто письмо сгенерированно автоматически, не надо отвечать на него!";
    mail($mail, "Паладинский отдел регистрации кланов. Отказ.", $msg); 
    print "Заявка на создание клана $clan_s отказана.";
    die();
    }
}

if($conf == 1){
    $GL = mysql_query("SELECT mail,money FROM characters WHERE login='$glava'");
    $GL_DAT = mysql_fetch_array($GL);
    $mail = $GL_DAT["mail"];
    $g_money = $GL_DAT["money"];
    if($g_money>10000){
$S2 = mysql_query("SELECT * FROm clan_zayavka Where name_short='$clan_s'");
$DATS = mysql_fetch_array($S2);
$name = $DATS["name"];
$name_short = $DATS["name_short"];
$site = $DATS["site"];
$history = $DATS["history"];
$orden = $DATS["orden"];
$sovet1 = $DATS["sovet1"];
$sovet2 = $DATS["sovet2"];
if($orden == 0){$orden = '';}
$ADD = mysql_query("INSERT INTO clan(name,name_short,glava,site,story,orden) VALUES('$name','$name_short','$glava','$site','$history','$orden')");

$GL_U = mysql_query("UPDATE characters SET clan='$name',clan_short='$name_short',orden='$orden',glava='1',clan_take='1',money=money-10000,chin='глава' WHERE login='$glava'");
$S1_U = mysql_query("UPDATE characters SET clan='$name',clan_short='$name_short',orden='$orden',chin='Советник' WHERE login='$sovet1'");
$S2_U = mysql_query("UPDATE characters SET clan='$name',clan_short='$name_short',orden='$orden',chin='Советник' WHERE login='$sovet2'");




$msg = "Здраствуйте, ув. $glava!";
$msg .= "Паладинский отдел регистрации кланов рассмотрел Вашу заявку и подтвердил ее. Вы и Ваш совет прошли паладинскую проверку и клан зарегистрирован. Изменять информацию о Ваше клане Вы можете в разделе \"Клан\" в подразделе \"Главенство\".Также Вы можете принимать/исключать игроков, прошедших паладинскую проверку.\n";
$msg .= "\nС Уважением Паладинский отдел регистрации кланов.\n";
$msg .= "\n\n\n\nЭто письмо сгенерированно автоматически, не надо отвечать на него!";
$S2 = mysql_query("INSERT INTO protocol(login,templier,type,reason) VALUES('$glava','$login','clan_reg','$name')");
mail($mail, "Паладинский отдел регистрации кланов. Ваш клан зарегистрирован.", $msg); 
print "Заявка на создание клана $clan_s подтверждена.";
$S = mysql_query("DELETE FROM clan_zayavka WHERE name_short='$clan_s'");
die();
    }
    else{
    print "Суммы на счету <B>$glava</B> недостаточно для регистрации клана.";
    die();
    }
}

while($DATA = mysql_fetch_array($S)){
$name = $DATA["name"];
$name_short = $DATA["name_short"];
$site = $DATA["site"];
$znak = $DATA["znak"];
$history = $DATA["history"];
$orden = $DATA["orden"];
$glava = $DATA["glava"];
$glava_fio = $DATA["glava_fio"];
$sovet1 = $DATA["sovet1"];
$sovet1_fio = $DATA["sovet1_fio"];
$sovet2 = $DATA["sovet2"];
$sovet2_fio = $DATA["sovet2_fio"];
$date = $DATA["date"];


print "<table border=0 class=new width=700 bgcolor=#dcdcdc><TR bgcolor=#dcdcdc>";
print "<td bgcolor=#dcdcdc>$i.  <B>$name</B> [$name_short]<BR>";
print "Сайт: <a href='$site' class=us2 target='_blank'>$site</a><BR>";
print "Значок: <img src='$znak'><BR>";
print "История:<BR>$history<BR>";
print "<B>СОВЕТ КЛАНА:</B><BR>";
print "Глава: <B>$glava</B> <a href='info.php?log=$glava' target=$glava><img src='img/inf.gif' border=0></a> <I>[<B>$glava_fio</B>]</I><BR>";
print "Советник: <B>$sovet1</b> <a href='info.php?log=$sovet1' target=$sovet1><img src='img/inf.gif' border=0></a> <I>[<B>$sovet1_fio</B>]</i><BR>";
print "Советник: <B>$sovet2</b> <a href='info.php?log=$sovet2' target=$sovet1><img src='img/inf.gif' border=0></a> <I>[<B>$sovet2_fio</B>]</i><BR>";
print "Дата подачи заявки: $date<BR>";
print "<form action='main.php?act=orden&ord=1&spell=10&conf=0&clan_s=$name_short&glava=$glava' name='otkaz' method=\"POST\">Отказать по причине:<BR>";
print "<textarea class=new name='otkaz_msg' cols=40 rows=5></textarea><BR><input type=submit class=but value=\"Отказать\"></form>";
print "<input type=button class=but value=\"Подтвердить заявку\" onClick=\"javascript:location.href='main.php?act=orden&ord=1&spell=10&conf=1&clan_s=$name_short&glava=$glava'\">";
print "</td>";
print "</tr></table><BR>";

$i++;
}
if($i == 0){
print "Нет заявок на регистрацию клана.";
}
?>