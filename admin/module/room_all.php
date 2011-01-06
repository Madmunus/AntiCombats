<?
defined('AntiBK') or die ("Доступ запрещен!");

$room = (isset($_POST['room'])) ?$_POST['room'] :"";
?>
<form method="post" action="">
<strong>Название комнаты </strong><br>
<select name="room">
<option value="Зал воинов">Зал воинов</option>
<option value="Зал воинов 2">Зал воинов 2</option>
<option value="Зал воинов 3">Зал воинов 3</option>
<option value="Будуар">Будуар</option>
<option value="Этаж 2">Этаж 2</option>
<option value="Комната Знахаря">Комната Знахаря</option>
<option value="Рыцарский Зал">Рыцарский Зал</option>
<option value="Торговый Зал">Торговый Зал</option>
<option value="Зал закона">Зал закона</option>
<option value="Центральная Площадь">Центральная Площадь</option>
<option value="Тюрма">Тюрма</option>
<option value="Комиссионый магазин">Комиссионый магазин</option>
<option value="Церковь">Церковь</option>
<option value="Банк">Банк</option>
<option value="Стелла Правосудия">Стелла Правосудия</option>
<option value="Магазин">Магазин</option>
<option value="Регистратура кланов">Регистратура кланов</option>
<option value="Ремонтная мастерская">Ремонтная мастерская</option>
<option value="Академия">Академия</option>
<option value="работа">работа</option>
<option value="Завод">Завод</option>
<option value="Пруд">Пруд</option>
<option value="Казино">Казино</option>
<option value="Лотерея">Лотерея</option>
<option value="Кости">Кости</option>
<option value="Блек джек холл">Блек джек холл</option>
<option value="Подвал">Подвал</option>
<option value="Телеграф">Телеграф</option>
</select>
<input type="submit" name="submit" value="Сменить"></form>
<?
if (isset($_POST['room']))
{
    $sql = $adb->query ("UPDATE `characters` SET `room` = '$room';");
    echo "Все сменено";
}
?>