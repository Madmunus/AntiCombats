<?
defined('AntiBK') or die("Доступ запрещен!");

$char->test->Admin();
?>
<script src="scripts/sha1.js" type="text/javascript"></script>
<script type="text/javascript">
$(function (){
  $('#getSHA1').click(function (){
    $('#sha1text').val(SHA1($('#text').val()));
  });
  $('input[name=changetype]').click(function (){
    $('div[name=content]').hide();
    $('div#'+$(this).attr('id')+'c').show();
  });
});
</script>
<style>
.remove {cursor: pointer;}
</style>
<font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
<table width="100%">
  <tr>
    <td align="left">
      <input type="button" class="nav" value="Основное" id="main" name="changetype">
    </td>
    <td align="right">
      <input type="button" class="nav" value="Админ панель" onclick="window.open('admin/index.php', '', 'menubar=no,status=no');">
      <input type="button" class="nav" value="<?echo $lang['refresh'];?>" id="link" link="admin">
      <input type="button" class="nav" value="<?echo $lang['return'];?>" id="link" link="inv">
    </td>
  </tr>
</table>
<div id="mainc" name="content">
<font color='red'>Глобальные переменные:</font>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
<tr style="font-weight: bold;">
<?
foreach ($_SESSION as $key => $value)
  echo "<td>$key</td>";
?>
</tr>
<tr>
<?
foreach ($_SESSION as $key => $value)
  echo "<td>$value</td>";
?>
</tr></table>
<font color='red'>Cookies:</font>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
<tr style="font-weight: bold;">
<?
foreach ($_COOKIE as $key => $value)
  echo "<td>$key</td>";
?>
</tr>
<tr>
<?
foreach ($_COOKIE as $key => $value)
  echo "<td>$value</td>";
?>
</tr></table>
<font color='red'>Lasts:</font>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
<tr style="font-weight: bold;">
<td>next_shape</td>
<td>last_go</td>
<td>last_return</td>
<td>last_time</td>
</tr>
<tr>
<?
echo "<td>".date('d.m.y H:i:s', $char_db['next_shape'])."</td>";
echo "<td>".date('d.m.y H:i:s', $char_db['last_go'])."</td>";
echo "<td>".date('d.m.y H:i:s', $char_db['last_return'])."</td>";
echo "<td>".date('d.m.y H:i:s', $char_db['last_time'])."</td>";
?>
</tr>
</table>
<font color='red'>SHA1:</font>
<input type='text' id='text' style='width: 40%;'><input type='submit' id='getSHA1' value='Зашифровать'><input type='text' id='sha1text' readonly style='width: 40%;'><br>
</div>
<?
$password = null;
$max = 10;
$letters = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
while ($max--)
  $password .= $letters[rand(0, (strlen($letters) - 1))];
echo $password;
?>