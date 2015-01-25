<?
session_start();
if(empty($login)){
print "<script>top.location.href='index.php';</script>";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=#dedede topmargin=2>
<?
include "conf.php";
/* include "functions.php"; */
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);

mysql_query("SET CHARSET cp1251");
if (ereg("[<>]",$act) or ereg("[<>]",$level) or ereg("[<>]",$reg_clan) or ereg("[<>]",$clan_name) or ereg("[<>]",$clan_name_short) or ereg("[<>]",$clan_site)
 or ereg("[<>]",$userfile) or ereg("[<>]",$clan_history) or ereg("[<>]",$clan_orden) or ereg("[<>]",$clan_glava_fio) or ereg("[<>]",$c_1)
 or ereg("[<>]",$c_2) or ereg("[<>]",$clan_sovet1_fio) or ereg("[<>]",$clan_sovet2_fio) or ereg("[<>]",$clan)) {print "Недопустимые символы!!!"; exit();}
$act=htmlspecialchars($act);
$level=htmlspecialchars($level);
$reg_clan=htmlspecialchars($reg_clan);
$clan_name=htmlspecialchars($clan_name);
$clan_name_short=htmlspecialchars($clan_name_short);
$clan_site=htmlspecialchars($clan_site);
$userfile=htmlspecialchars($userfile);
$clan_history=htmlspecialchars($clan_history);
$clan_orden=htmlspecialchars($clan_orden);
$clan_glava_fio=htmlspecialchars($clan_glava_fio);
$c_1=htmlspecialchars($c_1);
$c_2=htmlspecialchars($c_2);
$clan_sovet1_fio=htmlspecialchars($clan_sovet1_fio);
$clan_sovet2_fio=htmlspecialchars($clan_sovet2_fio);
$clan=htmlspecialchars($clan);
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
$city=$db["city"];

 /*    if($city != "Dream Town"){
     print "<script>location.href='index.php'</script>";
    }
*/
if(empty($act)){$act = "clan";}
if($act == "none"){$act = "clan";}


?>

<table border=0 width=100% cellpadding=0 cellspacing=0 height=20>
<tr>
<td width=10>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<Td><img src='img/cor_l_t.gif'></td></tr>
<tr><Td><img src='img/cor_l_b.gif'></td></tr>
</table>
</td>
<td bgcolor=#cccccc><B>Регистратура кланов</B>
</td>
<tD align=right bgcolor=#cccccc>
<?
$s="select money from characters where login='$login'";
$q=mysql_query($s);
$r=mysql_fetch_array($q);
$money1=$r["money"];
$money = sprintf ("%01.2f", $money1);
?>
<B>У вас в наличии: <FONT COLOR=339900><?echo $money;?></font> кр.</B>
</td>
<td width=10>
<table border=0 width=100% cellpadding=0 cellspacing=0>
<tr>
<Td><img src='img/cor_r_t.gif'></td></tr>
<tr><Td><img src='img/cor_r_b.gif'></td></tr>
</table>
</td>
</tr>
</table>
<BR>
<table width=100% cellpadding=0 cellspacing=0>
<td width=20><img src='img/cor2_l_t.gif'></td>
<td bgcolor=#cccccc>&nbsp</td>
<td width=20><img src='img/cor2_r_t.gif'></td>
</tr>
</table>
<table border=0 cellpadding=0 width=100% bgcolor=#cccccc><TR><TD>
<center>
<?
if($act=="clan" or $act=="reg_clan" or $act=="archive"){
?>
<input type=button class=b value=" Правила регистрации " onClick="location.href='registratura.php?act=clan';">
&nbsp&nbsp&nbsp&nbsp&nbsp
<input type=button class=b value=" Подать заявку " onClick="location.href='registratura.php?act=reg_clan';">
&nbsp&nbsp&nbsp&nbsp&nbsp
<input type=button class=b value=" Архив кланов " onClick="location.href='registratura.php?act=archive';">
&nbsp&nbsp&nbsp&nbsp&nbsp
<input type=button class=b value=" Выход " onClick="location.href='main.php?act=go&room_go=centsquare';">
<?
}
?>
</center>
</td>
</tr></table>
<table width=100% cellpadding=0 cellspacing=0>
<td width=20><img src='img/cor2_l_b.gif'></td>
<td bgcolor=#cccccc><img src='img/20_20.gif'></td>
<td width=20><img src='img/cor2_r_b.gif'></td>
</tr>
</table>
<BR>
<?
if($act == "clan"){
?>
<table width=100% cellpadding=0 cellspacing=0>
<td width=20><img src='img/cor2_l_t.gif'></td>
<td bgcolor=#cccccc><center><B>Регистратура кланов</B></center></td>
<td width=20><img src='img/cor2_r_t.gif'></td>
</tr>
</table>
<table border=0 cellpadding=0 width=100% bgcolor=#cccccc>
<TR>
<TD>
&nbsp&nbsp&nbspДобро пожаловать в отдел регистрации кланов Demons City! Для создания клана ознакомтесь с правилами регистрации клана.<BR><BR>
<center><B>ПРАВИЛА РЕГИСТРАЦИИ КЛАНА:</B></center><bR>
1. Для регистрации клана необходимо уплатить пошлину в казну города в размере <B>10000</B> кр.<BR>
2. Для регистрации клана необходимо набрать группу из <B>3</B> человек(далее совет клана)*.<BR>
3. Перед регистрацией клана, совет клана должен пройти проверку у паладинов.<BR>
4. При регистрации клана совет клана должен выбрать склонность, которой будет пренадлежать клан, либо же остаться независимыми.<BR>
5. Совет клана должен предоставить: готовые значок клана(20х15 пикселов, неанимированный, прозрачный gif),официальный сайт(размещенный на платном/бесплатном хостинге,содержащий историю клана,устав клана,состав клана)**, историю клана для информационного отдела, ФИО всех членов совета клана.<BR>
<small>* - каждый член совета должен достигнуть <b>7-го уровня</b> в игре. Глава клана выбирается из совета клана.<BR>
** - дизайн и оформление официального сайта будет проверяться паладинами, так что сайт должен быть сделан на высоком уровне.</small>
<BR><BR>
<center><B>ПОРЯДОК РЕГИСТРАЦИИ КЛАНА:</B></center><BR>
1. Игроки, имеющие общие стремления, увлеченые одними интересами, либо просто группа игроков собирается в игре.<BR>
2. Выбираются 3 лидеров(совет клана), которые в последствии будут управлять кланом.<BR>
3. Совет клана занимается разработкой официального сайта, значка и истории клана.<BR>
4. ПОСЛЕ создания сайта, значка и истории, главой клана подается заявка на регистрацию клана.<BR>
5. Заявка рассматривается паладинским отделом регистрации кланов.<BR>
6. При положительном результате рассмотрения заявки, совет клана проходит проверку у паладинов.<BR>
7. Глава клана оплачивает пошлину за регистрацию клана в казну города.<BR>
8. При успешном прохождении проверки, отделом регистрации кланов открывается клан, создается учетная запись в государственном реестре кланов города.<BR><BR>
<center><a href='registratura.php?act=reg_clan' class=us2>подать заявку на регистрацию клана.</a></center>
</td>
</tr></table>
<table width=100% cellpadding=0 cellspacing=0>
<td width=20><img src='img/cor2_l_b.gif'></td>
<td bgcolor=#cccccc><img src='img/20_20.gif'></td>
<td width=20><img src='img/cor2_r_b.gif'></td>
</tr>
</table>
<?
}
if($act == "reg_clan"){
if(empty($clan_name)){
?>
<table width=100% cellpadding=0 cellspacing=0>
<td width=20><img src='img/cor2_l_t.gif'></td>
<td bgcolor=#cccccc><center><B>Регистратура кланов. Заявка на регистрацию.</B></center></td>
<td width=20><img src='img/cor2_r_t.gif'></td>
</tr>
</table>
<table border=0 cellpadding=0 width=100% bgcolor=#cccccc>
<TR>
<TD>
<form action='registratura.php?act=reg_clan' name='reg_clan' method="POST" ENCTYPE="multipart/form-data">
Название клана(<small>Русские-английские буквы, цифры 0-9, макс. 30 симв.</small>):<BR>
<input type="text" class=new name="clan_name" maxsize=30 size=45><BR>
Короткое название клана(<small>Английские буквы, цифры 0-9, макс. 5 симв.</small>):<BR>
<input type="text" class=new name="clan_name_short" maxsize=5 size=45><BR>
Официальный сайт клана(<small>полный адрес с http://, макс. 50 симв</small>):<BR>
<input type="text" class=new name="clan_site" maxsize=50 size=45 value="http://"><BR>
Значок клана(<small>20х15 пикселов, неанимированый, прозарчный gif.</small>):<BR>
<input type="file" class=new name="userfile" size=34><BR>
История клана(<small>Русские, цифры 0-9, макс. 2048 симв.(2 КБ)</small>):<BR>
<textarea class=new name="clan_history" maxsize=2048 cols=45 rows=8></textarea><BR>
Склонность клана:&nbsp
<select size=1 style="BACKGROUND-COLOR: #FFFFFF; BORDER-BOTTOM: #000000 1px solid;
BORDER-LEFT: #000000 1px solid; BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 11px;" name="clan_orden">
<option value="0">без склонности</option>
<option value="3">Нейтральная</option>
</select><BR><BR>
<B>Совет клана:</B>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td>
Глава клана(<small>логин игрока в игре</small>):<BR>
<?
print "<B>$login</B>";
?>
</td>
<td width=5>&nbsp</td>
<td>
ФИО(<small>фамилия, имя, отчество главы клана</small>):<BR>
<input type="text" class=new name="clan_glava_fio" size=35><BR>
</td>
</tr>

<tr>
<td>
Советник(<small>логин игрока в игре</small>):<BR>
<input type="text" class=new name="c_1" size=35><BR>
</td>
<td width=5>&nbsp</td>
<td>
ФИО(<small>фамилия, имя, отчество советника</small>):<BR>
<input type="text" class=new name="clan_sovet1_fio" size=35><BR>
</td>
</tr>

<tr>
<td>
Советник(<small>логин игрока в игре</small>):<BR>
<input type="text" class=new name="c_2" size=35><BR>
</td>
<td width=5>&nbsp</td>
<td>
ФИО(<small>фамилия, имя, отчество советника</small>):<BR>
<input type="text" class=new name="clan_sovet2_fio" size=35><BR>
</td>
</tr>


</table>
<BR>
<small>* - если на момент подачи заявки на счету главы клана небудет необходимой суммы(10000 кр.), заявка не принимается.</small>
<BR><BR>
<center>
<input type=submit class=b value=" Подать заявку ">
</form>
</td>
</tr></table>
<table width=100% cellpadding=0 cellspacing=0>
<td width=20><img src='img/cor2_l_b.gif'></td>
<td bgcolor=#cccccc><img src='img/20_20.gif'></td>
<td width=20><img src='img/cor2_r_b.gif'></td>
</tr>
</table>
<?
}
else{


    if(empty($clan_name_short) OR empty($clan_site) OR empty($userfile) OR empty($clan_history) OR empty($clan_glava_fio)){
    print "Не все поля заявки заполнены!<BR>";
    print "<a href='registratura.php?act=reg_clan' class=us2>вернуться</a>";
    die();
    }
    if($db["money"]<250){
    print "Суммы на Вашем счету недостаточно для регистрации клана!<BR>";
    print "<a href='registratura.php?act=reg_clan' class=us2>вернуться</a>";
    die();
    }
    if($db["level"]<0){
    print "Уровень главы клана меньше необходимого(7).<BR>";
    print "<a href='registratura.php?act=reg_clan' class=us2>вернуться</a>";
    die();
    }


    

    $SEEK_NAME = mysql_query("SELECT * FROM clan");
    while($NAME_D = mysql_fetch_array($SEEK_NAME)){
        if($clan_name == $NAME_D["name"]){
        print "Название клана <B>$clan_name</B> уже занято! Выберите другое название.";
        die();
        }
        if(!ereg("[a-zA-Z0-9]$",$clan_name_short)){
        print "Короткое название должно состоять только из английских букв и цифр! Придумайте другую аббревиатуру.";
        die();
        }
        if($clan_name_short == $NAME_D["name_short"]){
        print "Короткое название <B>$clan_name_short</B> уже занято! Придумайте другую аббревиатуру.";
        die();
        }
    }

    if(!empty($userfile)){
    if($userfile_size>5120){
    print "<B>Внимание!!! Размер загружаемого Вами файла \"<span class=crit>$userfile_name</span>\" превышает максимально допустимый размер 5 Кб!</B><BR>";
    print "<a href='registratura.php?act=reg_clan' class=us2>вернуться</a><BR>";
    }
    if($userfile_type != "image/gif"){
print "<B>Внимание!!! Загружаемый Вами файл \"<span class=crit>$userfile_name</span>\" не являеться gif-рисунком!</B><BR>";
    print "<a href='registratura.php?act=reg_clan' class=us2>вернуться</a><BR>";
    }
    else{
        if(!empty($userfile)){
        $newname="img/clan/$clan_name_short.gif";
        copy($userfile,$newname);
        print "Заявка подана. В ближайшее время она будет рассмотрена паладинским отделом регистрации кланов и Вы и совет клана будете направлены на паладинскую проверку. После прохождения проверки с Вашего счета снимется 10000 кр. и клан откроется. К моменту прохождения проверки на Вашем счету должны быть 10000 кр, иначе Ваша заявка будет отклонена.";
        $clan_history = htmlspecialchars($clan_history);
        $clan_history = str_replace("\n","<BR>",$clan_history);
        $chas = date("H");
        $date=date("d.m.Y-H:i:s", mktime($chas-$GSM));

        $S = mysql_query("INSERT INTO clan_zayavka(name,name_short,site,znak,history,orden,glava,glava_fio,sovet1,sovet1_fio,sovet2,sovet2_fio,date,confirm) VALUES('$clan_name','$clan_name_short','$clan_site','$newname','$clan_history','$clan_orden','$login','$clan_glava_fio','$c_1','$clan_sovet1_fio','$c_2','$clan_sovet2_fio','$date','0')");
        }
    }
    }

}
}
if($act == "archive"){
print "Добро пожаловать в Государственный Архив кланов. Здесь Вы сможете просмотреть все записи о кланах, а также подробную информацию о них.<BR>";
$i = 1;
$S = mysql_query("SELECT * FROM clan ORDER BY name ASC");
    while($DATA = mysql_fetch_array($S)){
    $name = $DATA["name"];
    $name_s = $DATA["name_short"];
    $glava = $DATA["glava"];
    $orden = $DATA["orden"];
    if($orden == ""){$orden_i = "";}
    else if($orden == 1){$orden_i = "<img src='img/orden/1.gif' alt='Белое братство'>";}
    else if($orden == 2){$orden_i = "<img src='img/orden/2.gif' alt='Темное братство'>";}
    else if($orden == 3){$orden_i = "<img src='img/orden/3.gif' alt='Нейтральное братство'>";}
    else if($orden == 4){$orden_i = "<img src='img/orden/4.gif' alt='Алхимик'>";}
    $clan_i = "<img src='img/clan/$name_s.gif' alt='$name' border=0>";
    print "$i.$orden_i$clan_i<B>$name</B> <a href='clan_inf.php?clan=$name_s' class=us2 target=$name_s><small><B>>>></B></small></a><BR>";
    $i++;
    }
}
?>

