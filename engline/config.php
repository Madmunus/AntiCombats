<?
defined('AntiBK') or die("Доступ запрещен!");

$database = array(
  'adb'         => 'mysql://root:password@localhost:3306/abk', // Настройки подключения к abk
  'db_encoding' => 'utf8'                                      // Кодировка баз данных
);

$config = array(
  'start' => array(                             //Создание персонажа
               'stats'    => array(
                               'str' => 3,
                               'dex' => 3,
                               'con' => 3,
                               'vit' => 3
                             ),
               'ups'      => 3,
               'skills'   => 1,
               'maxmass'  => 40,
               'hp_regen' => 500,
               'mp_regen' => 100,
               'mp_cons'  => 100,
               'hitmin'   => 1,
               'hitmax'   => 3,
               'items'    => array(920, 1031)
             )
);
$GSM = 0;
?>