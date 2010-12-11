<?
  include "conf.php";
  $data = mysql_connect($base_name, $base_user, $base_pass);
  mysql_select_db($db_name,$data);
  mysql_query("SET CHARSET cp1251");
  include "functions.php";

  $UNWEAR_S = mysql_query("SELECT * FROM characters");
    if(!$UNWEAR_S){
    print "wrong connect!";
    }
    else{
    print "conected...<BR>";
    }

    while($DATA = mysql_fetch_array($UNWEAR_S)){
     $login = $DATA["login"];
    if(!empty($login) && $login!="."){
     unwear_full($login);
     print "$login done<BR>";
    }
    }
  echo mysql_error();
  die("done");
?>