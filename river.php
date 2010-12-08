<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<?

$city=$db["city_game"];
$walk = $db["walk"];

if(empty($act)){$act = "";}

testMove($login);
testBattle($login);



?>

<body bgcolor="#EEEEEE" topmargin="2" leftmargin="2">

<table border="0" width="780" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" colspan="3"><img border="0" src="buttons/1_1.gif" width="5" height="5"></td>
  </tr>
  <tr>
    <td width="50%">

        <img border="2" src="city/prud.gif" width="500" height="350">

      </td>
    <td width="5" valign="top" align="left"><img border="0" src="buttons/1_1.gif" width="5" height="5"></td>
    <td width="400" valign="top" face="time new romanina" align="left"><b><font  color="#CC0000">Правила:<br>
      </font></b><br>1)не кто не наподает на рыбаков</br>
	  <br>2)рыба продаёться в магазин - обмену не пренодлежит</br>
	  <br>3)пруд обнавляеться (сам) каждые 30 минут</br>
      </b></font>
       <p><b><font face="Tahoma" size="2" color="#CC0000">Передвижение:<br>
      </font></b>
      <form name="move" action="main.php?act=go" method="POST">
      <select style="BACKGROUND-COLOR: #eeeeee; BORDER-BOTTOM: #333333 1px solid;BORDER-LEFT: #333333 1px solid; BORDER-RIGHT: #333333 1px solid; BORDER-TOP: #333333 1px solid; COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 10px;" size="1" name="level">

        <option value="zarabotok" style="background-color:#CCCCCC">Вернуться</option>

        &nbsp; </select>
        <input type=submit class=but value="идём">
        </p>
        </form>

        <?
        testRiver($login);

           if(empty($res_count)){
            river($login,"riba",0);
           }
           else{
            river($login,"riba",$res_count);
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