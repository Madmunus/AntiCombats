<?
if (!empty($name))
{
	//$w0="INSERT INTO merit(muj,jena,svid_m,svid_j,templer,log) VALUES ($muj,$jena,$svid_m,$svid_j,$templer,$log)";
	$wo = "UPDATE merit set muj = '$muj' jena = '$jena' svid_m = '$svid_m' svid_j = '$svid_j' templer = 'templer' log = 'log' ";
	$res=mysql_query($w0);
	if ($res)
	{
		print "<center>";
		print "complite";
		print "<a href=?act=orden&ord=1&spell=18 class=us2>back</a>";
	}
	else
	{
		print "failed";
		echo mysql_error();
	}
}
else
{
?>
<form action=?act=orden&ord=1&spell=18 name=add method="POST">
<table border=0 width=500>
<tr>
<td>
Имя Жениха:
</td>
<td>
<input type=text name=muj class=new size=30>
</td>
</tr>
<tr>
<td>
Имя Невесты:
</td>
<td>
<input type=text name=jena class=new size=30>
</td>
</tr>
<tr>
<td>
Имя первого свидетеля:
</td>
<td>
<input type=text name=svid_m class=new size=30>
</td>
</tr>
<tr>
<td>
Имя второго свидетеля
</td>
<td>
<input type=text name=svid_j class=new size=30>
</td>
</tr>
<tr>
<td>
Имя темплера проводяшего церемонию:
</td>
<td>
<input type=text name=templer class=new size=30>
</td>
</tr>
<tr>
<td>
Лог заключения:
</td>
<td>
<input type=text name=log class=new size=30>
</td>
</tr>
<tr><td>
<input type=submit value="Создать" class=new>
</td></tr>
</table>
</form>
<?
}
?>