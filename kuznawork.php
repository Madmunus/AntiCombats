<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<?
include "conf.php";
session_start();



$data = mysql_connect($base_name, $base_user, $base_pass);
mysql_select_db($db_name,$data);
mysql_query("SET NAMES cp1251");
$sql = "SELECT * FROM characters WHERE login='$login'";
$result = mysql_query($sql);
$db = mysql_fetch_array($result);

$who=$_SESSION["login"];

if($action == 'wait'){
?>
<LINK REL=StyleSheet HREF='styles/style.css' TYPE='text/css'>
<body bgcolor=#e0eee0>
<table border=1 bordercolor=black width=100% bgcolor=#fffbbb><tr><td>
<table border=0 width=100% cellpadding=0 cellspacing=0 height=20 bgcolor=#fffbbb>
<tr>

<td bgcolor=#fffbbb><B>Фабрика "Бронь"</B>
</td>

</tr>
</table>

</td></tr>
</table>

</td></tr></table>

<br>

              <table width="148" align=right border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE"><tr>
                <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
                <td bgcolor="#D3D3D3" nowrap><a href="main.php?act=go&room_go=centplosh" onclick="" class="menutop" title="Переход на центральную площадь">Центральная Площадь</a></td>
              </tr></table>
<td valign=top>

<?




print "<table border=0 bordercolor=black width=100% cellpadding=0 cellspacing=0 bgcolor=#fffbbb><tr><td><table border=0 bgcolor=#fffbbb width=100% cellpadding=0 cellspacing=0><tr><td>";
print "<table border=0 width=100% cellpadding=2 cellspacing=0 bgcolor=#fffbbb><tr>";
print "<td valign=top bgcolor=#fffbbb><span class=usuallyb>";

?>

<b>Работаем...<br></b>

<html><head>

<html><head><meta http-equiv="refresh" content="1;url=/kuznawork.php?&login=<? echo $login; ?>&obj_type=<? print $obj_type; ?>">	<script language="javascript">
	var TIMELEFT = 7200;
	var DURATION = 1000;

	function commaFormat(x) {
	var len;
	var newStr = "";
	var i,j;
	
		x = x + ""; 
		len = x.length-1; 
		j = 0;
		for(i=len;i>=0;i--) {
			j = j + 1
			if (j > 3) {
				newStr = "," + newStr;
				j = 1;
			}
			newStr = x.charAt(i) + newStr;
		}
		return newStr;
	}
	
	function heartBeat() {
		if(TIMELEFT > 0) TIMELEFT--;
		
			if(document.all) Counter.innerHTML = commaFormat(TIMELEFT);
			else { 
				var cElement = document.getElementById('Counter');
				cElement.innerHTML = commaFormat(TIMELEFT);
			}
		
		if(TIMELEFT > 0) window.setTimeout("heartBeat()",DURATION);
		else {
		
		}
	}
	</script></head><body onLoad="window.setTimeout('heartBeat()',50);">
<table cellspacing=0 cellpadding=0 width="50%" border=0>
                 <TR>
                <TD>Откиньтесь на спинку кресла пока машина зделает работу... это займёт 2 чиса</TD>
                <TD><b><div id="Counter"></div></b></TD>
              </TR>

              <TR>
</table>

<?
print("</head><body><br>");
}
else {
?>


<?
$query=mysql_query("SELECT * FROM `characters` WHERE login='$who'");
$db=mysql_fetch_array($query);
	{

		$chanced = rand(1, $all_res);

		$q2   = mysql_query("SELECT * FROM `$obj_type` WHERE id = '$chanced'");
$res = mysql_fetch_array($q2);
if(!$q2){print '11';}
		$res_name = $res["name"];
if($data["num"]<1000){
$zarplata = '0.1';
}
elseif($data["num"]>999){
$zarplata = '0.15';
}
?>
<html><head><meta http-equiv="refresh" content="1;url=/kuznawork.php?action=wait&login=<? echo $login; ?>&obj_type=<? print $obj_type; ?>">



		Вещь <b><? print $res_name; ?></b> готова! Вам зачислены <b><? print $zarplata; ?></b> Ст.


<script language="javascript">
	var TIMELEFT = 7200;
	var DURATION = 1000;

	function commaFormat(x) {
	var len;
	var newStr = "";
	var i,j;
	
		x = x + ""; 
		len = x.length-1; 
		j = 0;
		for(i=len;i>=0;i--) {
			j = j + 1
			if (j > 3) {
				newStr = "," + newStr;
				j = 1;
			}
			newStr = x.charAt(i) + newStr;
		}
		return newStr;
	}
	
	function heartBeat() {
		if(TIMELEFT > 0) TIMELEFT--;
		
			if(document.all) Counter.innerHTML = commaFormat(TIMELEFT);
			else { 
				var cElement = document.getElementById('Counter');
				cElement.innerHTML = commaFormat(TIMELEFT);
			}
		
		if(TIMELEFT > 0) window.setTimeout("heartBeat()",DURATION);
		else {

			
		}
	}
	</script><body onLoad="window.setTimeout('heartBeat()',50);">
<table cellspacing=0 cellpadding=0 width="50%" border=0>
                 <TR>
                <TD>Подготавливаем новый материал...</TD>
                <TD><b><div id="Counter"></div></b></TD>
              </TR>

              <TR>
</table>
<a class=us2 href="main.php?act=go&room_go=centplosh">Главный Хол</a>
<?

		$qqq = mysql_query("UPDATE `$obj_type` SET mountown=mountown+1 WHERE name='$res_name'");
		$qqqq = mysql_query("UPDATE `characters` SET money=money+'$zarplata' WHERE login='$who'");
		$qqqqq = mysql_query("UPDATE `sapojn` SET num=num+'1' WHERE login='$who'");
		}
	}
	


print "</td></tr></table></td></tr></table></td></tr></table>";

?>
