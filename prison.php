<?
defined('AntiBK') or die("Доступ запрещен!");

$prisoners = $adb->selectCell("SELECT COUNT(*) FROM `characters` WHERE `prison` != '0';");
?>
<table>
  <tr>
    <td><img src="img/prison.jpg"><br>Всего в тюрьме: <b><?echo $prisoners;?></b></td>
    <td width="100%" valign="top">
    <center>Тюрьма - место покоя тех, кто был глуп и наивен.</center>
<?
if (!$char_db['prison'])
{
?>
<table width="148" align="right" border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
  <tr>
    <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7"/></td>
    <td bgcolor="#D3D3D3" nowrap><a href="main.php?action=go&room_go=centsquare" class="passage" alt="<?echo $char->city->getRoomOnline('centsquare', 'mini');?>">Центральная Площадь</a></td>
  </tr>
</table>
<?
}
else
{
  $time = getFormatedTime($char_db['prison']);
  echo "<span class='small'><center><font color='#FF0000'><b>Вам осталось сидеть $time</b><br>";
  if ($char_db['prison_reason'])
  {
    echo "Причина тюремного заключения:<br>";
    echo $char_db['prison_reason'];
  }
  echo "</font></center></span>";
}
?>
</td>
</tr>
</table>