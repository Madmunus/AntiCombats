<?
defined('AntiBK') or die("Доступ запрещен!");

$sort = getVar('sort', 'guid', 2);
$sort_c = array(
  'guid'          => 'Логин (ID)',
  'login_display' => 'Отображаемый логин',
  'last_time'     => 'Последняя активность',
  'room'          => 'Комната',
  'city'          => 'Город'
);
$sort = (array_key_exists($sort, $sort_c)) ?$sort :'guid';
?>
<script type="text/javascript">
$(function (){
  $('body').on('change', 'select[name=sort]', function (){
    $('form#sort').submit();
  });
});
</script>
<form id="sort" action="" method="post">
  Сортировать по: 
  <select class="small" name="sort">
<?
  foreach ($sort_c as $key => $val)
  {
    $select = ($sort == $key) ?" selected" :"";
    echo "<option value='$key'$select>$val</option>";
  }
?>
  </select>
</form>
<table width="100%" border="1" cellspacing="0" cellpadding="3" align="center">
  <tr align="center">
<?
  foreach ($sort_c as $key => $val)
    echo "<td><strong>$val</strong></td>";
?>
  </tr>
<?
$online = $adb->select("SELECT `guid`, `login_display`, `last_time`, `city`, `room` FROM `online` ORDER BY ?#", $sort);
foreach ($online as $character)
{
  echo "<tr align='center'>"
     . "<td>".$char->getLogin('clan', $character['guid'])." ($character[guid])</td>"
     . "<td>$character[login_display]</td>"
     . "<td>".date("d-m-y H:i:s", $character['last_time'])."</td>"
     . "<td>".$char->city->getRoom($character['room'], $character['city'], 'name')."</td>"
     . "<td>".$char->city->getCity($character['city'], 'name')."</td>"
     . "</tr>";
}
?>
</table>