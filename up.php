<?
if(!empty($act)){
if($act=="up" and !empty($stat) and $db["ups"]>0){
if($stat=="str"){
$new=$db["str"]+1;
$up=$db["ups"]-1;
$sql = "UPDATE characters SET str='$new',ups='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
}
if($stat=="dex"){
$new=$db["dex"]+1;
$up=$db["ups"]-1;
$sql = "UPDATE characters SET dex='$new',ups='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}
if($stat=="con"){
$new=$db["con"]+1;
$up=$db["ups"]-1;
$sql = "UPDATE characters SET con='$new',ups='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}
if($stat=="vinoslivost"){
$new=$db["vit"]+1;
$up=$db["ups"]-1;
$hp=$db["vit"];
$hp_now=$db["hp"];
$new_hp=$db["hp_all"]+6;
setHP($login,$hp_now,$new_hp);
$sql = "UPDATE characters SET vit='$new',ups='$up',hp_all='$new_hp' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}
if($stat=="water"){
$new=$db["water"]+1;
$up=$db["skills"]-1;
$sql = "UPDATE characters SET water='$new',skills='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=skills\">";
print "Повышение характеристик...";
die();
}
if($stat=="earth"){
$new=$db["earth"]+1;
$up=$db["skills"]-1;
$sql = "UPDATE characters SET earth='$new',skills='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=skills\">";
print "Повышение характеристик...";
die();
}
if($stat=="fire"){
$new=$db["fire"]+1;
$up=$db["skills"]-1;
$sql = "UPDATE characters SET fire='$new',skills='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=skills\">";
print "Повышение характеристик...";
die();
}
if($stat=="air"){
$new=$db["air"]+1;
$up=$db["skills"]-1;
$sql = "UPDATE characters SET air='$new',skills='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=skills\">";
print "Повышение характеристик...";
die();
}
if($stat=="um"){
$new=$db["um"]+1;
$up=$db["ups"]-1;
$sql = "UPDATE characters SET um='$new',ups='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}
if($stat=="mag"){
$new=$db["vit"]+1;
$up=$db["ups"]-1;
$sql = "UPDATE characters SET mag='$new',ups='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}
if($stat=="int"){
$new=$db["int"]+1;
$up=$db["ups"]-1;
$sql = "UPDATE characters SET int='$new',ups='$up' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}
if($stat=="wis"){
$new=$db["wis"]+1;
$up=$db["ups"]-1;
$mn=$db["wis"];
$new_mn=$db["mp_all"]+3;
$sql = "UPDATE characters SET wis='$new',ups='$up',mp_all='$new_mn' WHERE login='$login'";
$result = mysql_query($sql);
print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=main.php?act=up\">";
print "Повышение характеристик...";
die();
}

}
}
?>