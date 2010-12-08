<?

if (!mysql_num_rows(mysql_query("SELECT * FROM forums WHERE name='".addslashes($f)."'")))
        $f = "main";

$cats=mysql_query("SELECT * FROM forums ORDER BY id");

echo"<table width=100% cellspacing=0 cellpadding=4 border=0>";

for ($i=0; $i<mysql_num_rows($cats); $i++) {
        $cat=mysql_fetch_array($cats);
        echo"<tr><td width=20 align=center><IMG SRC='i/forum/bull.gif'></td><td><a href='?f=".$cat['name']."' style='COLOR: #CCB268'>".$cat['title']."</a></td></TR>";
}

echo"</table>";

?>