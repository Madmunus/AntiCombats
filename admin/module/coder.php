<?
defined('AntiBK') or die ("Доступ запрещен!");

$tac = requestVar('tac');
$tot = requestVar('tot');
?>
<table>
  <form method="post">
  <tr>
    <td>
      <input type="radio" name="tac" checked value="2">B64 Encode 
      <input type="radio" name="tac" value="1">B64 Decode<br>
      <input type="radio" name="tac" value="3">md5 Hash<br>
      <input type="radio" name="tac" value="4">sha1 Hash
    </td>
  </tr>
  <tr>
    <td>
      <textarea name="tot" rows="5" cols="42"><?echo $tot;?></textarea><br>
      <input type="submit" value="Выполнить">
    </td>
  </tr>
</table>
<?
if (!$tot)
  die ("Вы не ввели что закодировать.");

switch($tac)
{
  case 1: echo "Раскодированный текст: <b>".base64_decode ($tot)."</b>"; break;
  case 2: echo "Кодированный текст: <b>".base64_encode ($tot)."</b>";    break;
  case 3: echo "Кодированный текст: <b>".md5 ($tot)."</b>";              break;
  case 4: echo "Кодированный текст: <b>".sha1 ($tot)."</b>";             break;
}
?>