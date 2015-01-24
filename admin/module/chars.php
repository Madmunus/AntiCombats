<?
defined('AntiBK') or die("Доступ запрещен!");

$sort = getVar('sort', 'guid', 2);
$sort_c = array(
  'guid'          => 'ID',
  'login'         => 'Логин',
  'admin_level'   => 'Админ',
  'level'         => 'Уровень',
  'exp'           => 'Опыт',
  'money'         => 'Деньги',
  'room'          => 'Комната',
  'city'          => 'Город'
);
$sort = (array_key_exists($sort, $sort_c)) ?$sort :'guid';
?>
<style>
  .remove {cursor: pointer;}
</style>
<script type="text/javascript">
function deleteChar (d_guid)
{
  $.post('ajax.php', {'do': 'delete_char', 'd_guid': d_guid}, function (data){
    if (data == 'complete')
      $('tr#'+d_guid).hide();
	});
}

$(function (){
  $('body').on('change', 'select[name=sort]', function (){
    $('form#sort').submit();
  }).on('click', 'img.remove', function (){
    deleteChar($(this).attr('id'));
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
    <td> </td>
  </tr>
<?
$characters = $adb->select("SELECT `guid`, `login`, `level`, `exp`, `admin_level`, `money`, `city`, `room` FROM `characters` ORDER BY ?#", $sort);
foreach ($characters as $character)
{
  $bg = ($adb->selectCell("SELECT `guid` FROM `online` WHERE `guid` = ?d", $character['guid'])) ?"#00FFAA"  :"#FFAAAA";
  $admin = ($character['admin_level']) ?"unlock.gif" :"del.gif";
  echo "<tr id='$character[guid]' style='background: $bg; text-align: center;'>"
     . "<td>$character[guid]</td>"
     . "<td>$character[login]</td>"
     . "<td><img src='../img/icon/$admin' width='14' height='14' border='0' alt='$character[admin_level] Уровень'></td>"
     . "<td>$character[level]</td>"
     . "<td>$character[exp]</td>"
     . "<td>".getMoney($character['money'])." кр.</td>"
     . "<td>".$char->city->getRoom($character['room'], $character['city'], 'name')."</td>"
     . "<td>".$char->city->getCity($character['city'], 'name')."</td>"
     . "<td width='14'><img src='../img/icon/clear.gif' width='14' height='14' border='0' alt='Удалить персонажа' id='$character[guid]' class='remove'></td>"
     . "</tr>";
}
?>
</table>