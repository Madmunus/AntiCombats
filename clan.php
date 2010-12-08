<?
$clan_t = $db["clan"];
$clan_s = $db["clan_short"];
$orden_t = $db["orden"];
$rang = $db["rang"];
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$do) or ereg("[<>\\/-]",$a) or ereg("[<>\\/-]",$log)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$do=htmlspecialchars($do);
$a=htmlspecialchars($a);
$log=htmlspecialchars($log);
$SITE = mysql_query("SELECT site,story FROM clan WHERE name_short='$clan_s'");
$SITED = mysql_fetch_array($SITE);
$clan_site = $SITED["site"];
$history = $SITED["story"];
$history = str_replace("<BR>","\n",$history);
?>
<body bgcolor="#EEEEEE" topmargin="2" leftmargin="2">
<script>
function goSite(){
window.open("<?echo $clan_site?>");
}
</script>

<?
if($clan_t!=''){
if($db["orden"]==1){$orden_dis="Белое братство";}
if($db["orden"]==2){$orden_dis="Армада";}
if($db["orden"]==3){$orden_dis="Нейтральное братство";}
if($db["orden"]==4){$orden_dis="Алхимик";}
if($db["orden"]==5){$orden_dis="Заключенный";}
if(empty($clan_s)){$clan="";}
else {$clan = "<img src='img/clan/$clan_s.gif' alt='$clan_t'>";}
if(empty($orden_t)){$orden="";}
else{
if ($orden_t==2) {$orden="<img src='img/orden/arm/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} 
else{$orden="<img src='img/orden/$orden_d.gif' border=0 alt='$orden_dis'>";}
if ($orden_t==1) {$orden="<img src='img/orden/pal/$rang.gif' width=12 height=15 border=0 alt='$orden_dis'>";} }
print "<table width=100%><td width=50% align=right><b><<=- $orden$clan $clan_t -=>></b></td><td width=35% align=right><input type=button value=\"Вернуться\" class=nav onclick=\"javascript:location.href='main.php?act=none'\"></td></table><center><BR>";
print "<table><td width=200 valign=top><input type=button class=but value='Соклановцы' onClick=\"location.href='main.php?act=clan&do=1'\" style=\"width=150\"><BR><BR>";
if($db["clan_take"]==1){
print "<input type=button class=but value='Принять в клан' onClick=\"location.href='main.php?act=clan&do=3'\" style=\"width=150\"><BR><BR>";
}
		if($db["glava"]==1){
		print "<input type=button class=but value='Сменить статус' onClick=\"location.href='main.php?act=clan&do=2&a=chin'\" style=\"width=150\"><BR><BR>";
		print "<input type=button class=but value='Выгнать из клана' onClick=\"location.href='main.php?act=clan&do=2&a=out'\" style=\"width=150\"><BR><BR>";
		print "<input type=button class=but value='Передать главенство' onClick=\"location.href='main.php?act=clan&do=2&a=give'\" style=\"width=150\"><BR><BR>";
		print "<input type=button class=but value='Заместитель' onClick=\"location.href='main.php?act=clan&do=2&a=zam'\" style=\"width=150\"><BR><BR>";
		print "<input type=button class=but value='Настройки клана' onClick=\"location.href='main.php?act=clan&do=2&a=opt'\" style=\"width=150\"><BR><BR>";
		}
print "<input type=button class=but value='Наш сайт' onClick=\"goSite()\" style=\"width=150\"><BR><BR></td><td>";
		if(empty($a)){$a="";}
			if($a=="chin"){
			include "clan/chin.php";
			}
			if($a=="out"){
			include "clan/out.php";
			}
			if($a=="give"){
			include "clan/give.php";
			}
			if($a=="zam"){
			include "clan/zam.php";
			}
			if($a=="opt"){
			include "clan/opt.php";
			}
if(!empty($do)){
	if($do==1){
	$S = mysql_query("SELECT * FROM characters WHERE clan='$clan_t' ORDER BY login ASC");
	print "Список Ваших соклановцев:<BR>";
		while($DAT = mysql_fetch_array($S)){
		$log = $DAT["login"];
                $log1 = str_replace(" ","%20",$log);
		$lev = $DAT["level"];
		$chin = $DAT["chin"];
		print "$orden$clan <b>$log</b> [$lev]<a href='info.php?log=$log1' target=_new$log><img src='img/inf.gif' border=0></a> - <B>$chin</B><BR>";
}
	}
	if($do == 3){
		if($db["clan_take"] == 1){
		include "clan/take.php";
		}
	}
}

}
?>
</td></table></center>