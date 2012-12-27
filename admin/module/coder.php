<?
defined('AntiBK') or die("Доступ запрещен!");

$tac = getVar('tac', 0);
$tot = getVar('tot');
?>
<table>
  <form method="post" name="code">
  <tr>
    <td>
      <input type="radio" name="tac" value="2"<?echo ($tac == 2) ?'checked' :''?>>B64 Encode 
      <input type="radio" name="tac" value="1"<?echo ($tac == 1) ?'checked' :''?>>B64 Decode<br>
      <input type="radio" name="tac" value="3"<?echo ($tac == 3) ?'checked' :''?>>md5 Hash<br>
      <input type="radio" name="tac" value="4"<?echo ($tac == 4) ?'checked' :''?>>sha1 Hash
    </td>
  </tr>
  <tr>
    <td>
      <textarea name="tot" rows="5" cols="42"><?echo $tot;?></textarea><br>
      <input type="submit" value="Выполнить">
    </td>
  </tr>
  </form>
</table>
<?
switch ($tac)
{
  case 1: echo "Раскодированный текст: <b>".base64_decode($tot)."</b>"; break;
  case 2: echo "Кодированный текст: <b>".base64_encode($tot)."</b>";    break;
  case 3: echo "Кодированный текст: <b>".md5($tot)."</b>";              break;
  case 4: echo "Кодированный текст: <b>".sha1($tot)."</b>";             break;
}
?>