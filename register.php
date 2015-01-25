<?
session_start();
define('AntiBK', true);

include_once("engline/config.php");
include_once("engline/data.php");
include_once("engline/dbsimple/Generic.php");
include_once("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$step = getVar('step');
$error_text = 'Пройдите предыдущий шаг!<br><br><a href="?step='.($step-1).'" class="us2">Назад</a>';
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru" />
  <title>Анти Бойцовский Клуб</title>
  <link rel="SHORTCUT ICON" href="img/favicon.ico" />
  <link href="styles/main.css" rel="stylesheet" type="text/css" />
  <script src="scripts/jquery.js" type="text/javascript"></script>
  <script src="scripts/register.js" type="text/javascript"></script>
</head>
<body bgcolor="#3D3D3B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <thead><tr><td background="img/site/sitebk_02.jpg" align="center"><img src="img/site/sitebk_03ru.gif" width="194" height="135"></td></tr></thead>
  <tfoot>
    <tr><td width="100%" height="13" background="img/site/sitebk_07.jpg"></td></tr>
    <tr><td width="100%" bgColor="#000" height="20" align="center" class="copyright"><?echo $config['copyright'];?></td></tr>
  </tfoot>
  <tbody>
  <tr>
    <td align="center" height="90%" valign="top">
      <table width="75%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f2e5b1">
        <tr valign="top">
          <td width="29" align="right" valign="top" style="background: url(img/site/n21_08_1.jpg) repeat-y;"><img src="img/site/nm31_08.jpg"></td>
          <td><img src="img/site/nm31_04.jpg"></td>
          <td width="69%">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr><td><br><br><img src="img/site/regen_10.gif"><br><br><div id="error" readonly cols="100" rows="1" style="color: red; font-weight: bold; background-color: #f2e5b1; border: 0; display: none; margin-bottom: 5px;"></div></td></tr>
              <tr><td>
<?
if (!($adb->selectCell("SELECT `registration` FROM `server_info`;")))
  $step = 'stop';

    switch ($step)
    {
      case 'stop':
?>              <div style="padding: 0 0 0 20px;">Регистрация закрыта!<br><a href="../" class="us2">Вернуться на главную</a></div>
<?    break;
      default :
      case '':
        $reg_login = (checks('reg_login')) ?$_SESSION['reg_login'] :'';
?>              <table class="g" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr class="bg6">
                    <td><span class="style5">* </span>&nbsp;Имя вашего персонажа (login): <input type="text" name="reg_login" class="inup" size="25" maxlength="15" value="<?echo $reg_login;?>"> &nbsp;<input type="button" class="btn" value="Продолжить" onclick="checkStep1();" id="next"></td>
                  </tr>
                  <tr>
                    <td style="padding: 5px 0 0 20px;">
                      <p><small><span class="style7">Ограничения:</span>
                      <br>1. Имя не может быть короче 2-х символов и длиннее 15-ти. Имя не может состоять более чем из трех слов.
                      <br>Правильно: <b>Грозный Вася</b>, <b>Чудовище</b>, <b>Ли</b>
                      <br>Неправильно: <b>Ы</b>, <b>Суперубивающий Монстр</b>
                      <br><br>2. Имя может содержать только буквы или русского или английского алфавита. В качестве разделительных символов можно использовать пробел или тире &quot;-&quot;
                      <br>Правильно: <b>Вася-Зверь</b>, <b>Идуший по полю</b>
                      <br>Неправильно: <b>Вася 17</b>, <b>*Вася*</b>
                      <br><br>3. Допускается использовать или только английские буквы, или только русские, но нельзя одновременно использовать буквы обоих алфавитов.
                      <br>Правильно: <b>Громобоец</b>, <b>Dead Moroz</b>
                      <br>Неправильно: <b>Super Вася</b>, <b>Игорь the best</b>
                      <br><br>4. Имя не может содержать заглавную букву после обычной.
                      <br>Правильно: <b>Vasya</b>, <b>Иван Петрович</b>
                      <br>Неправильно: <b>vAsya</b>, <b>ИванПетрович</b>
                      <br><br>5. Имя не может начинаться или заканчиваться пробелом, подчеркиванием или тире
                      <br>Правильно: <b>Vasya</b>, <b>Иван Петрович</b>
                      <br>Неправильно: <b>Vasya-</b>, <b>-Иван Петрович-</b>
                      <br><br>6. Запрещено использовать два разделительных символа подряд
                      <br>Правильно: <b>Вася c топором</b>, <b>Иван Петрович</b>
                      <br>Неправильно: <b>Вася--и--топор</b>, <b>Иван- Петрович</b>
                      <br><br>7. Запрещено использование трех и более одинаковых символов подряд
                      <br>Правильно: <b>Вася с топором</b>, <b>Иван Петрович</b>
                      <br>Неправильно: <b>Вааася</b>, <b>Петрррович</b>
                      <br><br>8. Имя должно быть читаемым. Запрещены некоторые сочетания букв (ЪЪ, например) и четыре и более согласных подряд.
                      <br>Правильно: <b>Вася c топором</b>, <b>Иван Петрович</b>
                      <br>Неправильно: <b>FTRNZJ</b>, <b>Ъъефф</b>
                      <br><br>9. Имя не может содержать нецензурную лексику и оскорбления.
                      <br>Правильно: <b>Вася</b>, <b>Иван Петрович</b>
                      <br>Неправильно: <b><font color="red">&lt;вырезано цензурой&gt;</font></b>, <b><font color="red">&lt;вырезано шокированой цензурой&gt;</font></b>
                      </small></p>
                    </td>
                  </tr>
                </table>
<?    break;
      case 2:
        if (!checks('reg_login')) die($error_text);
        $reg_password = (checks('reg_password')) ?$_SESSION['reg_password'] :'';
?>              <table class="g" align="center" border="0" cellpadding="0" cellspacing="0">
                  <tr class="bg6">
                    <td width="500"><span class="style5">*</span><font style="margin-left: 20px;">Имя вашего персонажа:</font></td>
                    <td width="300"><p><?echo $_SESSION['reg_login'];?></p></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 20px;">Пароль:</font></td>
                    <td><input type="password" name="password" class="inup" size="20" maxlength="21" value="<?echo $reg_password;?>"></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 20px;">Пароль повторно:</font></td>
                    <td><input type="password" name="password_confirm" class="inup" size="20" maxlength="21" value="<?echo $reg_password;?>"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 5px 0 0 29px;">
                      <p><small><span class="style7">Хороший вариант пароля: четыре разные буквы и две цифры. Например hero63
                      <br><br>Перед выбором пароля, прочтите</span> <a href="encicl/FAQ/afer.html" target="_blank"><b>эту заметку</b></a>
                      <br>1. Пароль не может быть короче 6 символов.
                      <br>Неправильно: <b>mks23</b>, <b>zm2</b>
                      <br>Правильно: <b>telez371</b>
                      <br><br>2. Запрещены пароли содержащие только буквы одной раскладки и одного регистра.
                      <br>Неправильно: <b>sharksn</b>, <b>letotron</b>
                      <br>Правильно: <b>sharksn25</b>, <b>leto_tron</b>
                      <br><br>3. Запрещены простые, распространенные пароли.
                      <br>Неправильно: <b>qwerty123456</b>, <b>qazwsx098</b>
                      <br>Правильно: <b>telez371</b>, <b>nord-23k</b>
                      <br><br>4. Пароль не должен содержать части логина.
                      <br>Неправильно: <b>vasya2004</b> при логине <b>Vasya</b>
                      <br>Правильно: <b>telez371</b>, <b>nord-23k</b> при логине <b>Vasya</b>.
                      <br><br>5. Категорически не рекомендуется выбирать пароль совпадающий с паролем на email.<br><br>
                      </small></p>
                    </td>
                  </tr>
                  <tr>
                    <td><input onclick="location.href='?step=1';" type="button" class="btn" value="Вернуться"></td>
                    <td><input type="button" class="btn" value="Продолжить" onclick="checkStep2();" id="next"></td>
                  </tr>
                </table>
<?    break;
      case 3:
        if (!checks('reg_login', 'reg_password')) die($error_text);
        $reg_email = (checks('reg_email')) ?$_SESSION['reg_email'] :'';
        $reg_secretquestion = (checks('reg_secretquestion')) ?$_SESSION['reg_secretquestion'] :'';
        $reg_secretanswer = (checks('reg_secretanswer')) ?$_SESSION['reg_secretanswer'] :'';
?>              <table class="g" align="center" border="0" cellpadding="1" cellspacing="0">
                  <tr class="bg6">
                    <td width="500"><span class="style5">*</span><font style="margin-left: 15px;">Имя вашего персонажа:</font></td>
                    <td width="300"><p><?echo $_SESSION['reg_login'];?></p></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 15px;">Ваш e-mail:</font></td>
                    <td><input type="text" name="email" class="inup" size="30" maxlength="50" value="<?echo $reg_email;?>"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 5px 0 10px 27px;"><p>(используется <u>только</u> для напоминания пароля, нигде не отображается и не 
                    <br>используется для рассылки &quot;уведомлений/обновлений/...&quot; и прочего спама.
                    <br>В целях безопасности запрещена регистрация с @hotmail.com)</p></td>
                  </tr>
                  <tr>
                    <td width="146" style="padding: 5px 0 10px 27px;">Ваш секретный вопрос:</td>
                    <td><input type="text" name="secretquestion" class="inup" value="<?echo $reg_secretquestion;?>" size="30" maxlength="50"></td>
                  </tr>
                  <tr>
                    <td style="padding: 5px 0 10px 27px;">Ответ на секретный вопрос: </td>
                    <td><input type="text" name="secretanswer" class="inup" value="<?echo $reg_secretanswer;?>" size="30" maxlength="50"></td>
                  </tr>
                  <tr><td colspan="2" style="padding: 5px 0 10px 27px;"><span class="style7"><small>(Если указаны вопрос и ответ, то высылка пароля на email будет производится лишь при правильном ответе)</small></span></td></tr>
                  <tr>
                    <td><input onclick="location.href='?step=2';" type="button" class="btn" value="Вернуться"></td>
                    <td><input type="button" class="btn" value="Продолжить" onclick="checkStep3();" id="next"></td>
                  </tr>
                </table>
<?    break;
      case 4:
        if (!checks('reg_login', 'reg_password', 'reg_email', 'reg_secretquestion', 'reg_secretanswer')) die($error_text);
        $reg_name = (checks('reg_name')) ?$_SESSION['reg_name'] :'';
        $reg_birth_day = (checks('reg_birth_day')) ?$_SESSION['reg_birth_day'] :'';
        $reg_birth_month = (checks('reg_birth_month')) ?$_SESSION['reg_birth_month'] :'';
        $reg_birth_year = (checks('reg_birth_year')) ?$_SESSION['reg_birth_year'] :'';
?>              <table class="g" align="center" border="0" cellpadding="1" cellspacing="0" width="100%">
                  <tr class="bg6">
                    <td><span class="style5">*</span><font style="margin-left: 8px;">Имя вашего персонажа:</font></td>
                    <td><?echo $_SESSION['reg_login'];?></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 8px;">Ваше реальное имя: </font> </td>
                    <td><input type="text" name="name" class="inup" value="<?echo $reg_name;?>" size="45" maxlength="90"></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 8px;">День рождения:</font></td>
                    <td>
                      День: <select name="birth_day" class="inup">
                        <option selected></option>
<?                      for ($i = 1; $i <= 31; $i++)
                        {
                          $i = ($i < 10) ?"0".$i :$i;
                          $s = ($i == $reg_birth_day) ?" selected" :"";
                          echo "<option value='$i'$s>$i</option>";
                        }
?>                    </select>
                      Месяц: <select name="birth_month" class="inup">
                        <option selected></option>
<?                      foreach ($data['month'] as $value => $name)
                        {
                          $s = ($value == $reg_birth_month) ?" selected" :"";
                          echo "<option value='$value'$s>$name</option>";
                        }
?>                    </select>
                      Год: <select name="birth_year" class="inup">
                        <option selected></option>
<?                      for ($i = date('Y') - 10; $i >= (date('Y') - 72); $i--)
                        {
                          $s = ($i == $reg_birth_year) ?" selected" :"";
                          echo "<option value='$i'$s>$i</option>";
                        }
?>                    </select>
                    </td>
                  </tr>
                  <tr><td colspan="2"><div style="margin-left: 16px;"><small><span class="style5">Внимание! </span><span class="style7">Дата рождения должна быть правильной, она используется в игровом процессе. Анкеты с неправильной датой будут удаляться без предупреждения.</span></small></div></td></tr>
                  <tr><td colspan="2"><span class="style5">*</span><font style="margin-left: 8px;">Пол персонажа:</font></td></tr>
                  <tr>
                    <td style="padding-left: 16px;">
                      <input type="radio" name="sex" class="inup" checked value="0">Мужской<br>
                      <input type="radio" name="sex" class="inup" value="1">Женский
                    </td>
                  </tr>
                  <tr><td colspan="2" style="padding-left: 16px;"><small><span class="style5">Внимание! </span><span class="style7">Пол персонажа должен соответствовать реальному полу игрока.</span></small></td></tr>
                  <tr>
                    <td style="padding-left: 16px;">Город:</td>
                    <td><select name="city_n" class="inup">
                      <option selected></option>
<?                      foreach ($data['towns'] as $name)
                          echo "<option value='$name'>$name</option>";
?>                  </select></td>
                  </tr>
                  <tr>
                    <td style="padding-left: 16px;">другой</td>
                    <td><input type="text" name="city" class="inup" size="30" maxlength="50"></td>
                  </tr>
                  <tr>
                    <td style="padding-left: 16px;">ICQ:</td>
                    <td><input type="text" name="icq" class="inup" size="9" maxlength="20"> <input type="checkbox" name="hide_icq" value="1" /> не отображать</td>
                  </tr>
                  <tr>
                    <td style="padding-left: 16px;">Девиз:</td>
                    <td><input type="text" name="motto" class="inup" size="60" maxlength="160"></td>
                  </tr>
                  <tr style="padding-bottom: 27px;">
                    <td style="padding-left: 16px; padding-bottom: 20px;">Цвет сообщений в<br> чате:</td>
                    <td style="padding-bottom: 20px;"><select name="color" class="inup">
<?                    foreach ($data['colors'] as $color => $name)
                        echo "<option style='color: $color;' value='$color'>$name</option>";
?>                  </select></td>
                  </tr>
                  <tr>
                    <td><input onclick="location.href='?step=3';" type="button" class="btn" value="Вернуться"></td>
                    <td><input type="button" class="btn" value="Продолжить" onclick="checkStep4();" id="next"></td>
                  </tr>
                </table>
<?    break;
      case 5:
        if (!checks('reg_login', 'reg_password', 'reg_email', 'reg_secretquestion', 'reg_secretanswer', 'reg_name', 'reg_birth_day', 'reg_birth_month', 'reg_birth_year', 'reg_sex', 'reg_city', 'reg_icq', 'reg_hide_icq', 'reg_motto', 'reg_color')) die($error_text);
?>              <table align="center" border="0" cellpadding="1" cellspacing="0" width="100%">
                  <tr class="bg6">
                    <td><span class="style5">*</span><font style="margin-left: 8px;">Имя вашего персонажа:</font></td>
                    <td><?echo $_SESSION['reg_login'];?></td>
                  </tr>
                  <tr height="30"><td colspan="2"><span class="style5">*</span> <input type="checkbox" name="rules1" value="1" />Я обязуюсь соблюдать <a href="encicl/law.html" target="_blank"><b>Законы Анти Бойцовского Клуба</b></a></td></tr>
                  <tr height="30"><td colspan="2"><span class="style5">*</span> <input type="checkbox" name="rules2" value="1" />Я ознакомился с <a href="encicl/TOS.html" target="_blank"><b>Соглашением о предоставлении сервиса игры "Анти Бойцовский Клуб"</b></a> и согласен по всем пунктам.</b></a></td></tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 8px;">Введите изображенный на рисунке код</font><br><font style="margin-left: 18px;"><input type="text" name="code" maxlength="7" size="7"></font></td>
                    <td><img src="engline/secpic.php" style="border: 1px solid grey; cursor: pointer;" onclick="location.reload();"></td>
                  </tr>
                  <tr>
                    <td><br><input onclick="location.href='?step=4';" type="button" class="btn" value="Вернуться"></td>
                    <td><br><input type="button" class="btn" value="Начать" onclick="checkStep5();" id="next"></td>
                  </tr>
                </table>
<?    break;
    }
?>              <br><br><br>
                </td>
              </tr>
            </table>
          </td>
          <td style="background: url(img/site/nm314_13.jpg) no-repeat bottom;"><img src="img/site/ico_n13profile_03ru.jpg" border="0" valign="top"></td>
          <td width="23" valign="top" background="img/site/nnn21_03_1.jpg"></td>
        </tr>
      </table>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>