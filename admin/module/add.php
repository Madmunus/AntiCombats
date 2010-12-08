<?
defined('AntiBK') or die ("Доступ запрещен!");

// Переменные
$type_s = array (
	1	=>	'amulet',
	2	=>	'sword',
	3	=>	'axe',
	4	=>	'fail',
	5	=>	'knife',
	6	=>	'staff',
	7	=>	'armor',
	8	=>	'belt',
	9	=>	'helmet',
	10	=>	'gloves',
	11	=>	'shield',
	12	=>	'boots',
	13	=>	'ring'
);
$type = (isset($_POST['type'])) ?$_POST['type'] :"";
$name = (isset($_POST['name'])) ?$_POST['name'] :"";
$img = (isset($_POST['img'])) ?$_POST['img'] :"";
$mass = (isset($_POST['mass'])) ?$_POST['mass'] :"";
$price = (isset($_POST['price'])) ?$_POST['price'] :"";
$min_str = (isset($_POST['min_str'])) ?$_POST['min_str'] :"";
$min_dex = (isset($_POST['min_dex'])) ?$_POST['min_dex'] :"";
$min_con = (isset($_POST['min_con'])) ?$_POST['min_con'] :"";
$min_vit = (isset($_POST['min_vit'])) ?$_POST['min_vit'] :"";
$min_int = (isset($_POST['min_int'])) ?$_POST['min_int'] :"";
$min_wis = (isset($_POST['min_wis'])) ?$_POST['min_wis'] :"";
$min_level = (isset($_POST['min_level'])) ?$_POST['min_level'] :"";
$iznos_max = (isset($_POST['iznos_max'])) ?$_POST['iznos_max'] :"";
$add_str = (isset($_POST['add_str'])) ?$_POST['add_str'] :"";
$add_dex = (isset($_POST['add_dex'])) ?$_POST['add_dex'] :"";
$add_con = (isset($_POST['add_con'])) ?$_POST['add_con'] :"";
$add_int = (isset($_POST['add_int'])) ?$_POST['add_int'] :"";
$add_hp = (isset($_POST['add_hp'])) ?$_POST['add_hp'] :"";
$add_mana = (isset($_POST['add_mana'])) ?$_POST['add_mana'] :"";
?>
<form action="" name="add" method="post">
Класс предмета:
<select name="type">
<?
for ($i = 1; $i <= 13; $i++)
{
	$select = ($type_s[$i] == $type) ?" selected" :"";
	echo "<option value='$type_s[$i]'$select>$type_s[$i]";
}
?>
</select>
<input type="submit" value="Выбрать">
<?
//$w0 = "INSERT INTO $type_tb(name,img,bimg,mass,price,min_str,min_dex,min_con,min_vit,min_int,min_wis,min_level,add_str,add_dex,add_con,add_hp,add_int,add_mana,protect_head,protect_corp,protect_poyas,protect_legs,krit,uvorot,iznos_min,iznos_max,min_attack,max_attack,type,akrit,auvorot,sword_vl,axe_vl,fail_vl,knife_vl,spear_vl,mountown,orden) VALUES ('$name','$img','$bimg','$mass','$price','$min_str','$min_dex','$min_con','$min_vit','$min_int','$min_wis','$min_level','$add_str','$add_dex','$add_con','$add_hp','$add_int','$add_mana','$protect_head','$protect_corp','$protect_poyas','$protect_legs','$mf_krit','$mf_uvorot','0','$iznos_max','$min_attack','$max_attack','$type','$mf_antikrit','$mf_antiuvorot','$sword_vl','$axe_vl','$fail_vl','$knife_vl','$spear_vl','$count_mag','$need_orden')";
if (isset($_POST['type']))
{
?>
<table border="0" width="100%">
	<tr>
		<td>Название:</td>
		<td><input type="text" name="name" size="30"></td>
		<td>Путь к рисунку:</td>
		<td><input type="text" name="img" size="30"></td>
	</tr>
	<tr>
		<td>Масса:</td>
		<td><input type="text" name="mass" size="30"></td>
		<td>Цена:</td>
		<td><input type="text" name="price" size="30"></td>
	</tr>
	<tr>
		<td>Мин. сила:</td>
		<td><input type="text" name="min_str" size="30"></td>
		<td>Мин. ловкость:</td>
		<td><input type="text" name="min_dex" size="30"></td>
	</tr>
	<tr>
		<td>Мин. интуиция:</td>
		<td><input type="text" name="min_con" size="30"></td>
		<td>Мин. выносливость:</td>
		<td><input type="text" name="min_vit" size="30"></td>
	</tr>
	<tr>
		<td>Мин. интеллект:</td>
		<td><input type="text" name="min_int" size="30"></td>
		<td>Мин. мудрость:</td>
		<td><input type="text" name="min_wis" size="30"></td>
	</tr>
	<tr>
		<td>Мин. уровень:</td>
		<td><input type="text" name="min_level" size="30"></td>
		<td>Макс. износ:</td>
		<td><input type="text" name="iznos_max" size="30"></td>
	</tr>
	<tr>
		<td>+ сила:</td>
		<td><input type="text" name="add_str" size="30"></td>
		<td>+ ловкость:</td>
		<td><input type="text" name="add_dex" size="30"></td>
	</tr>
	<tr>
		<td>+ интуиция:</td>
		<td><input type="text" name="add_con" size="30"></td>
		<td>+ интеллект:</td>
		<td><input type="text" name="add_int" size="30"></td>
	</tr>
	<tr>
		<td>+ уровень здоровья (HP):</td>
		<td><input type="text" name="add_hp" size="30"></td>
		<td>+ уровень маны:</td>
		<td><input type="text" name="add_mana" size="30"></td>
	</tr>
	<tr>
		<td>+ владение мечами:</td>
		<td><input type="text" name="sword_vl" size="30"></td>
		<td>+ владение топорами:</td>
		<td><input type="text" name="axe_vl" size="30"></td>
	</tr>
	<tr>
		<td>+ владение булавами:</td>
		<td><input type="text" name="fail_vl" size="30"></td>
		<td>+ владение ножами:</td>
		<td><input type="text" name="knife_vl" size="30"></td>
	</tr>
	<tr>
		<td>+ владение копьями:</td>
		<td><input type="text" name="spear_vl" size="30"></td>
	</tr>
<?
if (in_array($type, array('amulet', 'sergi', 'helmet', 'naruchi', 'ring', 'shield')))
{
?>
	<tr>
		<td>Броня головы:</td>
		<td><input type="text" name="protect_head" size="30"></td>
	</tr>
<?
}
if (in_array($type, array('amulet', 'sergi', 'armour', 'naruchi', 'ring', 'shield')))
{
?>
	<tr>
		<td>Броня корпуса:</td>
		<td><input type="text" name="protect_corp" size="30"></td>
	</tr>
<?
}
if (in_array($type, array('amulet', 'sergi', 'pants', 'poyas', 'naruchi', 'ring', 'shield')))
{
?>
	<tr>
		<td>Броня пояса:</td>
		<td><input type="text" name="protect_poyas" size="30"></td>
	</tr>
<?
}
if (in_array($type, array('amulet', 'sergi', 'pants', 'boots', 'naruchi', 'ring', 'shield')))
{
?>
	<tr>
		<td>Броня ног:</td>
		<td><input type="text" name="protect_legs" size="30"></td>
	</tr>
<?
}
?>
<?
if (in_array($type, array('axe', 'fail', 'sword', 'knife', 'spear')))
{
?>
	<tr>
		<td>Мин. атака:</td>
		<td><input type="text" name="min_attack" size="30"></td>
	</tr>
	<tr>
		<td>Макс. атака:</td>
		<td><input type="text" name="max_attack" size="30"></td>
	</tr>
<?
}
?>
	<tr>
		<td>Мф. крит. удара:</td>
		<td><input type="text" name="mf_krit" size="30"></td>
		<td>Мф. против крит. удара:</td>
		<td><input type="text" name="mf_antikrit" size="30"></td>
	</tr>
	<tr>
		<td>Мф. увертывания:</td>
		<td><input type="text" name="mf_uvorot" size="30"></td>
		<td>Мф. против увертывания:</td>
		<td><input type="text" name="mf_antiuvorot" size="30"></td>
	</tr>
	<tr>
		<td>Артефакт:</td>
		<td><input type="checkbox" name="is_artefakt"></td>
	</tr>
	<tr>
		<td>Именной:</td>
		<td><input type="checkbox" name="is_personal"></td>
	</tr>
	<tr>
		<td>Владелец:</td>
		<td><input type="text" name="personal_owner" size="30"></td>
	</tr>
	<tr>
		<td>Кол-во в маге:</td>
		<td><input type="text" name="count_mag" size="30"></td>
	</tr>
	<tr>
		<td>Склонность:</td>
		<td>
			<select name="need_orden">
			<option value="0">Нет
			<option value="1">Белое братство
			<option value="2">Темное братство
			<option value="3">Нейтральное братство
			<option value="4">Алхимик
			<option value="5">Хаос
			</select>
		</td>
	</tr>
	<tr><td><input type="submit" value="Создать"></td></tr>
</table>
<?
}
?>
</form>