<?
if(empty($login)){
print "<script>top.location.href='index.php';</script>";
}
include("engline/functions/functions.php");

$test = new test;
?>


<link REV="made" href="mailto:smallrat@ukr.net">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<?

$city=$db["city_game"];
$walk = $db["walk"];

if(empty($act)){$act = "";}

$test -> Move ($login, $db);
$test -> Battle($db);


?>
<body bgcolor="#EEEEEE" topmargin="2" leftmargin="2">

<table border="0" width="780" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" colspan="3"><img border="0" src="buttons/1_1.gif" width="5" height="5"></td>
  </tr>
  <tr>
    <td width="50%">

      <img border="2" src="city/forest.jpg" width="500" height="350">
      </td>
    <td width="5" valign="top" align="left"><img border="0" src="buttons/1_1.gif" width="5" height="5"></td>
    <td width="275" valign="top" align="left"><b><font face="Tahoma" size="2" color="#CC0000">Месторасположение:<br>
      </font></b><font face="Tahoma" size="2"><b>Грейхолм<br>
      <?echo $room;?><br>
      </b></font>
       <p><b><font face="Tahoma" size="2" color="#CC0000">Передвижение:<br>
      </font></b>
      <form name="move" action="main.php?act=go" method="POST">
      <select style="BACKGROUND-COLOR: #eeeeee; BORDER-BOTTOM: #333333 1px solid;BORDER-LEFT: #333333 1px solid; BORDER-RIGHT: #333333 1px solid; BORDER-TOP: #333333 1px solid; COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 10px;" size="1" name="level">

        <? if($room == "Перекрёсток дорог"){ ?>
        <option value="go_city" style="background-color:#CCCCCC">Идти в город</option>
        <option value="go_for" style="background-color:#CCCCCC">Идти в Темный Лес</option>
        <option value="forlag" style="background-color:#CCCCCC">Идти в Лагерь лесорубов</option>
        <?
          }elseif($room == "Лагерь лесорубов"){
        ?>
        <option value="catle">Хибара скотовода</option>
        <option value="znahar">Палатка знахаря</option>
        <option value="lesorub">Домик лесоруба</option>
        <option value="forest" style="background-color:#CCCCCC">Перекрёсток дорог</option>

        <?
          }else if($room == "Темный Лес"){
           $SQL = mysql_query("SELECT id FROM online WHERE room='Дубовая роща'");
           $dub_worker = mysql_num_rows($SQL);

           $SQL = mysql_query("SELECT id FROM online WHERE room='Березовая роща'");
           $bereza_worker = mysql_num_rows($SQL);
        ?>
        <option value="dub">Дубовая роща(<?echo $dub_worker;?> чел)</option>
        <option value="bereza">Березовая роща(<?echo $bereza_worker;?> чел)</option>
        <option value="municip" style="background-color:#CCCCCC">В город</option>
        <?
          }else if($room == "Дубовая роща" || $room == "Березовая роща"){
        ?>
        <option value="go_for" style="background-color:#CCCCCC">Идти в Темный Лес</option>
        <?
          }
        ?>
        &nbsp; </select>
        <input type=submit class=but value="Идти >>">
        </p>
        </form>

        <?
        testMine($login);
        if($room == "Дубовая роща"){
           if(empty($res_count)){
            work($login,"dub",0);
           }
           else{
            work($login,"dub",$res_count);
           }
        }
        if($room == "Березовая роща"){
           if(empty($res_count)){
            work($login,"bereza",0);
           }
           else{
            work($login,"bereza",$res_count);
           }
        }

        ?>

        <table border=0 width=100%><tr>
<td align=left valign=top width=88>



</td>
</tr></table>


      </td>
  </tr>
</table>

</body>
<?


?>