<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<LINK REL=StyleSheet HREF="styles/main.css" TYPE='text/css'>
<body topmargin="5" leftmargin="5" bgcolor="#eeeeee" style="font-family: Verdana; font-size: 10pt">
<?

include "conf.php";
include "functions.php";
$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET NAMES cp1251");

$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);
if ($_GET['login']) {
$who=$_GET['login'];
if ($db['login'] == $who){
print("<html><head><meta http-equiv=\"refresh\" content=\"1800;url=river2.php?login=");
print($who);
print("\"></head><body><br><br><center><img src=/img/prud.gif border=0><br><br>");
$query=mysql_query("SELECT * FROM characters WHERE login='$who'");
$db=mysql_fetch_array($query);

$LOOK = mysql_query("SELECT * FROM river WHERE login = '$who'");
    while($data = mysql_fetch_array($LOOK)){
        if($data["login"] == $who){
 $chance = rand(1,100);
 if ($chance<80) {
  print("Ни одна рыба не клюнула на крючок. Продолжаем рыбачить...<br><a href=\"main.php?act=go&room_go=zarabotok\">Закончить</a>");
 }
 else {
  $q   = mysql_query("SELECT * FROM `riba`");
  $all_res = mysql_num_rows($q);
  $chanced = rand(1, $all_res);
  $qq = mysql_query("SELECT * FROM riba WHERE id='$chanced'");
  $got_res = mysql_fetch_array($qq);
  $res_name = $got_res["name"];
  print("Поздравляем! Вы поймали рыбу \"");
  print($res_name);
  print("\". Продолжаем рыбачить...<br>
<a href=\"main.php?act=go&room_go=zarabotok\">Остановить поиск</a>");
  $qqq = mysql_query("INSERT INTO inv(owner,object_id,object_type,object_razdel) VALUES('$who','$chanced','riba','other')");
  say($who,"Вы поймали рыбу &laquo;$res_name&raquo;!",$who);
  }
 }
 }
print("</center></body></html>");
}
else {
print ("И не лень тебе за других работать?!");
die();
}
}
else {
print("Не работаешь, казел!!");
die();
}
?>