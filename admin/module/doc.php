<?
defined('AntiBK') or die ("Доступ запрещен!");

$rows = $adb->select("SELECT * FROM `admin_menu` ORDER BY `id`;");
?>
<div>
Данная документация ещё не доработана, но всё же хотелось бы рассказать об основных функциях и фишках Админ Центра , что же приступим :).<br>
<br>
1) Основное меню:<br>
Основное меню состоит из двух разделов 1 - Навигация : 2 - Информация.
<br>
<br>
Навигация это , то меню где расположенны основные фишки такие как:<br><br>
<?
foreach ($rows as $menu)
{
    echo "$menu[name]<br>";
    if (in_array ($menu['href'], array('doc', 'coder', 'travm', 'team2')))
        echo "<hr>";
}
?>
<br>
</div>