<?php
defined('AntiBK') or die("Доступ запрещен!");

$tac = getVar('tac', 1);
$tot = getVar('tot');
?>
<script type="text/javascript">
$(function (){
  $('body').on('change', 'input[name=tac]', function (){
    $('form#code').submit();
  });
});
</script>
<table>
  <form method="post" id="code">
  <tr>
    <td>
      <input type="radio" name="tac" value="1"<?phpecho ($tac == 1) ?'checked' :''?>>B64 Encode 
      <input type="radio" name="tac" value="2"<?phpecho ($tac == 2) ?'checked' :''?>>B64 Decode 
      <input type="radio" name="tac" value="3"<?phpecho ($tac == 3) ?'checked' :''?>>MD5 
      <input type="radio" name="tac" value="4"<?phpecho ($tac == 4) ?'checked' :''?>>SHA1
    </td>
  </tr>
  <tr>
    <td>
      Текст: <input type="text" name="tot" size="100" value="<?phpecho $tot;?>"><br>
    </td>
  </tr>
  </form>
</table>
<?php
if (!$tot) die();
switch ($tac)
{
  case 1: echo "B64 Encode: <b>".base64_encode($tot)."</b>";  break;
  case 2: echo "B64 Decode: <b>".base64_decode($tot)."</b>";  break;
  case 3: echo "MD5: <b>".md5($tot)."</b>";                   break;
  case 4: echo "SHA1: <b>".sha1($tot)."</b>";                 break;
}
?>