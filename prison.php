<?
defined('AntiBK') or die("Доступ запрещен!");

$xaos = $adb->selectCell("SELECT COUNT(*) FROM `characters` WHERE `prision` != '0';");
?>
<table>
  <tr>
    <td><img src="img/prison.jpg"><br>Всего в тюрьме: <b><?echo $xaos;?></b></td>
    <td width="100%" valign="top">
    <center>Тюрьма - место покоя тех, кто был глуп и наивен.</center>
<?
if (!$char_db['prision'])
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
  $time = getFormatedTime($char_db['prision']);
  echo "<span class='small'><center><font color='#FF0000'><b>Вам осталось сидеть $time</b><br>";
  if ($char_db['prision_reason'])
  {
    echo "Причина тюремного заключения:<br>";
    echo $char_db['prision_reason'];
  }
  echo "</font></center></span>";
}
?>
</td>
</tr>
</table>