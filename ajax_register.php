<?
session_start();
define('AntiBK', true);

include("engline/config.php");
include("engline/data.php");
include("engline/dbsimple/Generic.php");
include("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$register = $adb->selectCell("SELECT `registration` FROM `server_info`;");
$register_error = 'Регистрация закрыта!<br><a href="index.php" class="us2">Вернуться на главную</a>';
$reminder = $adb->selectCell("SELECT `reminder` FROM `server_info`;");
$reminder_error = 'Восстановление пароля закрыто!<br><a href="../">Вернуться на главную</a>';

$do = getVar('do', '', 2);
switch ($do)
{
  case 'checkrem1':
    if (!$reminder)
      returnAjax('error', $reminder_error);
    
    unset($_SESSION['rem_login']);
    $login = getVar('login');
    
    if (utf8_strlen($login) < 2 || utf8_strlen($login) > 15 || preg_match("/[^a-zA-Zа-яА-Я\- ]/ui", $login))
      returnAjax('error', 'Логин не найден в базе.');
    else if (!($adb->selectCell("SELECT `guid` FROM `characters` WHERE `login` = ?s", $login)))
      returnAjax('error', "Логин \"$login\" не найден в базе.");

    $_SESSION['rem_login'] = $login;
    returnAjax('complete');
  break;
  case 'checkrem2':
    if (!$reminder)
      returnAjax('error', $reminder_error);
    
    if (!checks('rem_login'))
      returnAjax('error', 'Пройдите предыдущий шаг!');
    
    $login = $_SESSION['rem_login'];
    $answer = getVar('answer');
    $birthday = getVar('birthday');
    $code = getVar('code');
    
    $char_db = $adb->selectRow("SELECT `guid`, `mail` FROM `characters` WHERE `login` = ?s", $login);
    $char_info = $adb->selectRow("SELECT `secretquestion`, `secretanswer`, `birthday` FROM `character_info` WHERE `guid` = ?d", $char_db['guid']);
    
    if ($char_info['secretquestion'] != '' && ($answer != $char_info['secretanswer']))
      returnAjax('error', 'Неверный ответ на секретный вопрос.');
    else if ($birthday != $char_info['birthday'])
      returnAjax('error', 'Неверно указан день рождения.');
    else if ($code != $_SESSION['secpic'])
      returnAjax('error', 'Ошибка введения кода.');
    
    unset($_SESSION['rem_login'], $_SESSION['secpic']);
    /*Создание нового пароля*/
    $letters = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
    $max = 10;
    $password = null;
    while ($max--)
      $password .= $letters[rand(0, (strlen($letters) - 1))];
    /*Текст письма*/
    $msg = date('d.m.y H:i', time())."\n";
    $msg .= "Кто-то с IP: ".$_SERVER['REMOTE_ADDR']." попросил выслать пароль к персонажу \"$login\".\n";
    $msg .= "Т.к. в анкете у этого персонажа указан email: $char_db[mail], то вы и получили это письмо.\n";
    $msg .= "Login: $login\n";
    $msg .= "New password: $password\n\n--\n";
    $msg .= "Анти Бойцовский Клуб http://www.anticombats.com\n";
    $msg .= "P.S. Данное письмо сгенерировано автоматически, отвечать на него не нужно.\n";
    $msg .= "В целях безопасности, вашему аккаунту запрещены все передачи и выбрасывание предметов в течение суток с момента отправки письма.\n";
    
    if (!(mail($char_db['mail'], "По вашей просьбе высылаем пароль к персонажу \"$login\"", $msg, 'From: reminder@anticombats.com', 'reminder@anticombats.com')))
      returnAjax('error', 'Не удалось отправить пароль на e-mail, указанный в анкете!');
    
    $char = Char::initialization($char_db['guid'], $adb);
    
    if ($char->setChar('char_db', array('password' => SHA1($char_db['guid'].':'.$password), 'next_change' => (time() + 259200))))
      returnAjax('complete');
  break;
  case 'checkstep1':
    if (!$register)
      returnAjax('error', $register_error);
    
    if ($adb->selectCell("SELECT COUNT(*) FROM `history_auth` WHERE `action` = 2 and `ip` = ?s and `date` > ?s", $_SERVER['REMOTE_ADDR'], (time() - 3600)))
      returnAjax('error', "Недавно с вашего IP уже регистрировался персонаж. С одного IP адреса разрешена регистрация персонажей не чаще, чем раз в час. Попробуйте позже.");
    
    unset($_SESSION['reg_login']);
    $login = getVar('login');
    $match = false;
    $file = file("regfail.dat");
    $mat = explode(',', $file[0]);
    $zapret = explode(',', $file[1]);
    foreach ($zapret as $value)
    {
      $check = '';
      for ($i = 0; $i < utf8_strlen($value); $i++)
      {
        $s = utf8_substr($value, $i, 1);
        $check .= "[".lowercase($s)."|".uppercase($s)."]+";
      }
      if (preg_match("/$check/ui", $login))
        returnAjax('error', "Все вариации логина $value запрещены.");
    }
    foreach ($mat as $value)
    {
      $check = '';
      for ($i = 0; $i < utf8_strlen($value); $i++)
      {
        $s = utf8_substr($value, $i, 1);
        $check .= "[".lowercase($s)."|".uppercase($s)."]+";
      }
      if (preg_match("/$check/ui", $login))
        returnAjax('error', 'Выберите, пожалуйста, другой логин.');
    }
    $check = 0;
    for ($i = 0; $i < utf8_strlen($login); $i++)
    {
      $s = utf8_substr($login, $i, 1);
      $check += ($s == ' ' || $s == '-') ?1 :0;
      
      if ($i >= 2 && lowercase($s) == lowercase(utf8_substr($login, ($i-1), 1)) && lowercase($s) == lowercase(utf8_substr($login, ($i-2), 1)))
        returnAjax('error', 'Запрещено использование трех и более одинаковых символов подряд.');
      else if (($i == 0 || $i == (utf8_strlen($login) - 1)) && ($s == '-' || $s == ' '))
        returnAjax('error', 'Логин не может начинаться или заканчиваться пробелом или тире.');
      else if ($i >= 1 && in_array($s, mb_str_split(UPCASE)) && in_array(utf8_substr($login, ($i-1), 1), mb_str_split(LOCASE)))
        returnAjax('error', 'Логин не может содержать заглавную букву после обычной.');
      else if ($check > 2)
        returnAjax('error', 'Не более двух пробелов или тире.');
    }
    
    if (utf8_strlen($login) < 2 || utf8_strlen($login) > 15 || preg_match("/[^a-zA-Zа-яА-Я\- ]/ui", $login))
      returnAjax('error', 'Логин не может быть короче 2-х символов и длинее 15-ти символов, и должен состоять только из букв русского и английского алфавита, а также из тире или пробела.');
    else if (preg_match("/[\-]+[\-]/ui", $login) || preg_match("/[\_]+[\_]/ui", $login) || preg_match("/[\ ]+[\ ]/ui", $login))
      returnAjax('error', 'Запрещено использовать два разделительных символа подряд.');
    else if (preg_match("/[a-zA-Z]/ui", $login) && preg_match("/[а-яА-Я]/ui", $login))
      returnAjax('error', 'В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.');
    else if ($adb->selectCell("SELECT `guid` FROM `characters` WHERE `login` = ?s", $login))
      returnAjax('error', "Логин $login уже занят, выберите другой.");

    $_SESSION['reg_login'] = $login;
    returnAjax('complete');
  break;
  case 'checkstep2':
    if (!$register)
      returnAjax('error', $register_error);
    
    unset($_SESSION['reg_password']);
    $error = '';
    $password = getVar('password');
    $password_confirm = getVar('password_confirm');
    
    if (!checks('reg_login'))
      $error .= '<br>Пройдите предыдущий шаг!';
    if (utf8_strlen($password) < 6 || utf8_strlen($password) > 30)
      $error .= '<br>Длина пароля не может быть меньше 6 символов или более 30 символов.';
    if ($password_confirm == '' || $password != $password_confirm)
      $error .= '<br>В анкете пароль нужно ввести дважды, для проверки. Во второй раз вы его ввели неверно, будьте внимательнее...';
    if ((preg_match("/[a-zA-Z]/ui", $password) && !preg_match("/[а-яА-Я0-9_]/ui", $password)) || (preg_match("/[а-яА-Я]/ui", $password) && !preg_match("/[a-zA-Z0-9_]/ui", $password)) || (preg_match("/[0-9_]/ui", $password) && !preg_match("/[a-zA-Zа-яА-Я]/ui", $password)))
      $error .= '<br>Пароль не должен содержать только буквы одной раскладки и одного регистра.';
    if (preg_match("/$_SESSION[reg_login]/ui", $password))
      $error .= '<br>Пароль не должен содержать части логина.';
    if ($error != '')
      returnAjax('error', $error);
    
    $_SESSION['reg_password'] = $password;
    returnAjax('complete');
  break;
  case 'checkstep3':
    if (!$register)
      returnAjax('error', $register_error);
    
    unset($_SESSION['reg_email'], $_SESSION['reg_secretquestion'], $_SESSION['reg_secretanswer']);
    $error = '';
    $email = getVar('email');
    $secretquestion = getVar('secretquestion');
    $secretanswer = getVar('secretanswer');
    
    if (!checks('reg_login', 'reg_password'))
      $error .= '<br>Пройдите предыдущий шаг!';
    if (!preg_match("/^\w+[-_\.]*\w+@\w+-?\w+\.[a-z]{2,4}$/ui", $email))
      $error .= "<br>Вы указали явно ошибочный email ($email).";
    if (utf8_strlen($email) < 6 || utf8_strlen($email) > 50)
      $error .= '<br>Email не может быть короче 6-ти символов и длинее 50-ти символов.';
    if ($error != '')
      returnAjax('error', $error);
    
    $_SESSION['reg_email'] = $email;
    $_SESSION['reg_secretquestion'] = $secretquestion;
    $_SESSION['reg_secretanswer'] = $secretanswer;
    returnAjax('complete');
  break;
  case 'checkstep4':
    if (!$register)
      returnAjax('error', $register_error);
    
    unset($_SESSION['reg_name'], $_SESSION['reg_birth_day'], $_SESSION['reg_birth_month'], $_SESSION['reg_birth_year'], $_SESSION['reg_sex'], $_SESSION['reg_city'], $_SESSION['reg_icq'], $_SESSION['reg_hide_icq'], $_SESSION['reg_motto'], $_SESSION['reg_color']);
    $error = '';
    $name = getVar('name');
    $birth_day = getVar('birth_day');
    $birth_month = getVar('birth_month');
    $birth_year = getVar('birth_year');
    $sex = getVar('sex');
    $city_n = getVar('city_n');
    $city = getVar('city');
    $icq = getVar('icq');
    $hide_icq = getVar('hide_icq');
    $motto = getVar('motto');
    $color = getVar('color');
    
    if (!checks('reg_login', 'reg_password', 'reg_email', 'reg_secretquestion', 'reg_secretanswer'))
      $error .= '<br>Пройдите предыдущий шаг!';
    if ($name == '' || preg_match("/[^a-zA-Zа-яА-Я0-9]/ui", $name))
      $error .= '<br>Вы не заполнили или не правильно заполнили обязательное поле "Ваше имя".';
    if ($birth_day == '' || $birth_month == '' || $birth_year == '')
      $error .= '<br>Ошибка в написании дня рождения.';
    if (preg_match("/[^a-zA-Zа-яА-Я0-9]/ui", $city))
      $error .= '<br>Город должен состоять только из букв русского и английского алфавита, а также из цифр.';
    if (preg_match("/[^0-9]/ui", $icq))
      $error .= '<br>Ошибка в номере ICQ.';
    if ($error != '')
      returnAjax('error', $error);
    
    $_SESSION['reg_name'] = $name;
    $_SESSION['reg_birth_day'] = $birth_day;
    $_SESSION['reg_birth_month'] = $birth_month;
    $_SESSION['reg_birth_year'] = $birth_year;
    $_SESSION['reg_sex'] = $sex;
    $_SESSION['reg_city'] = ($city_n) ?$city_n :$city;
    $_SESSION['reg_icq'] = $icq;
    $_SESSION['reg_hide_icq'] = ($hide_icq == 'true') ?1 :0;
    $_SESSION['reg_motto'] = $motto;
    $_SESSION['reg_color'] = $color;
    returnAjax('complete');
  break;
  case 'checkstep5':
    if (!$register)
      returnAjax('error', $register_error);
    
    $error = '';
    $rules1 = getVar('rules1');
    $rules2 = getVar('rules2');
    $code = getVar('code');
    
    if (!checks('reg_login', 'reg_password', 'reg_email', 'reg_secretquestion', 'reg_secretanswer', 'reg_name', 'reg_birth_day', 'reg_birth_month', 'reg_birth_year', 'reg_sex', 'reg_city', 'reg_icq', 'reg_hide_icq', 'reg_motto', 'reg_color'))
      $error .= '<br>Пройдите предыдущий шаг!';
    if ($rules1 == 'false')
      $error .= '<br>Извините, без принятия правил нашего клуба, вы не можете зарегистрировать своего персонажа.';
    if ($rules2 == 'false')
      $error .= '<br>Извините, без принятия <u>Соглашения о предоставлении сервиса игры Бойцовский Клуб</u>, вы не можете зарегистрировать персонаж.';
    if ($code != $_SESSION['secpic'])
      $error .= '<br>Ошибка введения кода.';
    if ($error != '')
      returnAjax('error', $error);
    
    $login = $_SESSION['reg_login'];
    $password = $_SESSION['reg_password'];
    $email = $_SESSION['reg_email'];
    $secretquestion = $_SESSION['reg_secretquestion'];
    $secretanswer = $_SESSION['reg_secretanswer'];
    $name = $_SESSION['reg_name'];
    $birthday = $_SESSION['reg_birth_day'].".".$_SESSION['reg_birth_month'].".".$_SESSION['reg_birth_year'];
    $sex = $_SESSION['reg_sex'];
    $town = $_SESSION['reg_city'];
    $icq = $_SESSION['reg_icq'];
    $hide_icq = $_SESSION['reg_hide_icq'];
    $motto = $_SESSION['reg_motto'];
    $color = $_SESSION['reg_color'];
    $city = (rand(1,2) == 1) ?'drm' :'low';
    unset($_SESSION['reg_login'], $_SESSION['reg_password'], $_SESSION['reg_email'], $_SESSION['reg_secretquestion'], $_SESSION['reg_secretanswer'], $_SESSION['reg_name'], $_SESSION['reg_birth_day'], $_SESSION['reg_birth_month'], $_SESSION['reg_birth_year'], $_SESSION['reg_sex'], $_SESSION['reg_city'], $_SESSION['reg_icq'], $_SESSION['reg_hide_icq'], $_SESSION['reg_motto'], $_SESSION['reg_color'], $_SESSION['secpic']);
    
    if (($adb->selectCell("SELECT COUNT(*) FROM `characters` WHERE `login` = ?s", $login)) != 0)
      returnAjax('error', 'Персонаж уже создан.');
    
    $guid = ($adb->selectCell("SELECT MAX(`guid`) FROM `characters`;")) + 1;
    $reg_password = SHA1($guid.':'.$password);
    // Основная база
    $adb->query("INSERT INTO `characters` (`guid`, `login`, `login_sec`, `password`, `mail`, `sex`, `city`, `shape`, `reg_ip`, `last_time`) 
                 VALUES (?d, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?d);", $guid, $login, $login, $reg_password, $email, $sex, $city, "$sex/0.gif", $_SERVER['REMOTE_ADDR'], time());
    // Дополнительная информация
    $adb->query("INSERT INTO `character_info` (`guid`, `name`, `icq`, `secretquestion`, `secretanswer`, `hide_icq`, `town`, `birthday`, `color`, `motto`, `state`, `date`) 
                 VALUES (?d, ?s, ?s, ?s, ?s, ?d, ?s, ?s, ?s, ?s, ?s, ?d);", $guid, $name, $icq, $secretquestion, $secretanswer, $hide_icq, $town, $birthday, $color, $motto, $city, time());
    // Характеристики
    $adb->query("INSERT INTO `character_stats` (`guid`) 
                 VALUES (?d);", $guid);
    $stats = $config['start']['stats'];
    $items = $config['start']['items'];
    unset($config['start']['stats'], $config['start']['items']);
    $char = Char::initialization($guid, $adb);
    $char->setChar('char_stats', $config['start']);
    $char->changeStats($stats);
    // Создание инвентаря
    $adb->query("INSERT INTO `character_equip` (`guid`) 
                 VALUES (?d);", $guid);
    // Создание баров
    $adb->query("INSERT INTO `character_bars` (`guid`) 
                 VALUES (?d);", $guid);
    // Эффекты
    $char->workEffect(1);
    // Предметы
    foreach ($items as $item)
      $char->equip->addItem($item, 'get');
    // История
    $char->history->Auth(2, $city);
    
    if (checks('guid'))
      deleteSession();
    
    $adb->query("DELETE FROM `online` WHERE `guid` = ?d", $guid);
    $adb->query("INSERT INTO `online` (`guid`, `login_display`, `sid`, `city`, `room`, `last_time`) 
                 VALUES (?d, ?s, ?s, ?s, ?s, ?d);", $guid, $login, session_id(), $city, 'novice', time());
    $char->setChar('char_db', array('last_go' => time()));
    $_SESSION['guid'] = $guid;
    $_SESSION['zayavka_c_m'] = 1;
    $_SESSION['zayavka_c_o'] = 1;
    $_SESSION['battle_ref']  = 0;
    $char->history->Auth(1, $city);
    returnAjax('complete');
  break;
}
?>