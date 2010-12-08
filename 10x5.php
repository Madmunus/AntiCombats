<?
if(empty($login)){
print "<script>top.location.href='index.php';</script>";
}

$city=$db["city_game"];
$walk = $db["walk"];
$orden = $db["orden"];
$level = $db["level"];
$hp = $db["hp"];
$hp_all = $db["hp_all"];
$room = $db["room"];
$podval = $db["podval"];
$login = $db["login"];

if(empty($act)){$act = "";}

?>
<base target="_self">
</head>

<body bgcolor="#EEEEEE" topmargin="0" leftmargin="0">
</td></tr><tr>
<td valign=top>

<table border=1><tr>

<?


while ($a<10) {
$a++;
print "<td><table border=1>";
while ($s<10) {$s++; print"<tr>"; while ($y<$s) {$y++; 
$x = "x";
if ("$podval" == "") {$podval="Подвал $a$x$y";}
$s2=mysql_query("Update characters Set podval ='$podval' where login='$login'");
if ("Подвал $a$x$y" == "$podval") {$color = "0000ff";}
else {$color= "000000";}
$ox=$a;
$oy=$y;

print"<td bgcolor=$bgcolor><a href='if.php?act=move&ox=$ox&x=$x&oy=$oy'><font color=$color><center><b> $ox </b>x<b> $oy </b></td>"; }}

$s=0;$y=0;
print "</tr></table></td>";
}

?>
<td valign=top>
<table border=1 width=100%>
<tr>
<?
$id=1;
while ($id < 11) {
$pd = mysql_query("SELECT * FROM wood WHERE id='$id'");
$pod = mysql_fetch_array($pd);
$img = $pod["img"];
$ima = "<img src=img/$img border=0>";
$name = $pod["name"];
$wood = mysql_query("SELECT * FROM podval WHERE type='$id'");
$wod = mysql_fetch_array($wood);
$names=$wod["type"];
$number=$wod["number"];

$woodaa = mysql_query("SELECT * FROM inv WHERE owner='$login'  AND object_id  = '$id' AND object_type = 'wood' ");
if($woodaa){
while ($woodaaa = mysql_fetch_array($woodaa)) {
$ida = $woodaaa["id"];
$object_ids = $woodaaa["object_id"];
}
if ($object_ids == $id) {$idas = $ida; $add= "true";}
else {$idas = ""; $add = "false";}
}
else {print " ";}
if ($number == 100 ) {$numb = "<font size=0>собрано</font>";}
else if ($add == "true") {$numb = "<a href='if.php?act=add_res&res=$id'> <img src=img/icon/plus.gif border=0></a>"; }
else if ($add == "false") {$numb = "";}
print "<td valign=top nowrap><center>$ima<br><b>$name<br>$number $numb</b></td>";
if ($id == 5) {print "</tr><tr>";}
$id++;
}
?>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan=10>
<table border=1 width=100%>
<tr><td><center><b>Рейтинг</td><td colspan=4><center><b>Персонаж</td><td><center><b>ресурсы</td><td><center><b>деньги</td></tr>
<?
$adders = mysql_query("Select * from characters where add_resourses>0 ORDER BY add_resourses DESC");
while ($add = mysql_fetch_array($adders)){
$i++;
$login_add=$add["login"];
$c=$add["clan_short"];
$o=$add["orden"];
$cs = "<img src=img/clan/$c.gif>";
$or = "<img src=img/orden/$o.gif>";
$s = $add["sex"];
$level = $add["level"];
if ($s == "male" ) {$sx = "<img src=img/infm.gif>";}
else {$sx = "<img src=img/infw.gif>";}


$res_add = $add["add_resourses"];
print "<tr><td><center><b>$i</td><td>$or</td><td>$cs</td><td width=100%><b><font color=blue>$login_add </font>[$level]</td><td>$sx</td><td><center>$res_add</td><td><center>&nbsp;</td></tr>";
}


?>
</table>




</td>
</tr>
</table>
      </td>
    <td  valign=top>

</td>
  </tr>
</table>





