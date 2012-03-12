<?
session_start();
ini_set('display_errors', true);
ini_set('html_errors', false);
ini_set('error_reporting', E_ALL);

define('AntiBK', true);

include_once("engline/config.php");
include_once("engline/dbsimple/Generic.php");
include_once("engline/data/data.php");
include_once("engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$error_text = "Пройдите предыдущий шаг!<br><br><a href='javascript: window.history.go(-1);' class='us2'>Назад</a>";
$step = requestVar('step');
?>
<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico">
<title>Анти Бойцовский Клуб</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
var n, error = '';
var regfail = new Array();

function regcheck (login)
{
  var testwords = new Array();
  for (var i in regfail)
  {
    if (regfail[i] != '')
    {
      testwords[i] = '/';
      for (var n in regfail[i])
      {
        testwords[i] += '['+regfail[i][n].toLowerCase()+'|'+regfail[i][n].toUpperCase()+']';
        if (n != regfail[i].length-1)
          testwords[i] += '+';
      }
      testwords[i] += '/';
    }
  }
  for (var y in testwords)
  {
    var testword = eval('{' + testwords[y] + '}');
    if (testword.test(login))
      return true;
  }
  return false;
}

$(function (){
  $('input[name=reg_login]').keyup(function (){
    $(this).val($(this).val().replace(/[^a-zA-Zа-яА-Я\-_]/g, ''));
  });
  $('form[name=regstep1]').live('submit', function (){
    error = '';
    $("#error").hide().html('');
    var eng_log = false, rus_log = false, match = 1;
    var login = $('input[name=reg_login]').val();
    for (i = 1; i <= login.length; i++)
      if (login[i-1] == login[i])
        match++;
    if ((/[a-zA-Z]/.test(login)))
      eng_log = true;
    if ((/[а-яА-Я]/.test(login)))
      rus_log = true;
    if (login.length < 2 || login.length > 15 || (/[^a-zA-Zа-яА-Я\-_]/.test(login)))
      error = 'Логин не может быть короче 2-х символов и длинее 15-ти символов, и должен состоять только из букв русского и английского алфавита, а также из тире и символа_.';
    else if ((/[м|М]+[и|И]+[р|Р]+[о|О]+[з|З]+[д|Д]+[а|А]+[т|Т]+[е|Е]+[л|Л]+[ь|Ь]/.test(login)) || (/[с|С]+[м|М]+[о|О]+[т|Т]+[р|Р]+[и|И]+[т|Т]+[е|Е]+[л|Л]+[ь|Ь]/.test(login)) || (/[к|К]+[о|О]+[м|М]+[м|М]+[е|Е]+[н|Н]+[т|Т]+[а|А]+[т|Т]+[о|О]+[р|Р]/.test(login)) || (/[н|Н]+[е|Е]+[в|В]+[и|И]+[д|Д]+[и|И]+[м|М]+[к|К]+[а|А]/.test(login)))
      error = 'Все вариации логина '+login+' запрещены.';
    else if ((/[\-]+[\-]/.test(login)))
      error = 'Запрещено использовать два разделительных символа подряд';
    else if (regcheck(login))
      error = 'Выберите, пожалуйста, другой ник.';
    else if (eng_log && rus_log)
      error = 'В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.';
    else if (match > 2)
      error = 'Запрещено использование трех и более одинаковых символов подряд';
    else
    {
      $.post('ajax_reg.php', 'do=checklogin&login='+login, function (data){
        if (data == 'free')
          $('form[name=regstep1]').die().submit();
        else if (data == 'occupy')
          $("#error").show().html('Логин '+login+' уже занят, выберите другой.');
      });
    }
    if (error)
      $("#error").show().html(error);
    return false;
  });
  $('form[name=regstep2]').live('submit', function (){
    $("#error").hide().html('');
    var password = $('input[name=password]').val();
    var password_confirm = $('input[name=password_confirm]').val();
    if (password.length < 6 || password.length > 30)
      error = 'Длина пароля не может быть меньше 6 символов или более 30 символов.';
    else if (password != password_confirm || password_confirm == "")
      error = 'В анкете пароль нужно ввести дважды, для проверки. Во второй раз вы его ввели неверно, будьте внимательнее...';
    else if ((/[^a-zA-Zа-яА-Я0-9_]/.test(password)) || (/[^a-zA-Zа-яА-Я0-9]/.test(password_confirm)))
      error = 'Пароль должен состоять только из букв русского и английского алфавита, а также из цифр.';
    else
      $('form[name=regstep2]').die().submit();
    $("#error").show().html(error);
    return false;
  });
  $('form[name=regstep3]').live('submit', function (){
    $("#error").hide().html('');
    var email = $('input[name=email]').val();
    if (email.length < 6 || email.length > 50)
      error = 'Email не может быть короче 6-х символов и длинее 50-ти символов.';
    else if (!(/^\w+[-_\.]*\w+@\w+-?\w+\.[a-z]{2,4}$/.test(email)))
      error = 'Вы указали явно ошибочный email('+email+')';
    else
      $('form[name=regstep3]').die().submit();
    $("#error").show().html(error);
    return false;
  });
  $('form[name=regstep4]').live('submit', function (){
    $("#error").hide().html('');
    var name = $('input[name=name]').val();
    var birth_day = $('select[name=birth_day]').val();
    var birth_month = $('select[name=birth_month]').val();
    var birth_year = $('select[name=birth_year]').val();
    var city = $('input[name=city]').val();
    var icq = $('input[name=icq]').val();
    var deviz = $('input[name=deviz]').val();
    if (name == "" || (/[^a-zA-Zа-яА-Я0-9]/.test(name)))
      error = 'Вы не заполнили или не правильно заполнили обязательное поле \"Ваше имя\".';
    else if (birth_day == "")
      error = 'Вы не указали день своего рождения.';
    else if (birth_month == "")
      error = 'Вы не указали месяц своего рождения.';
    else if (birth_year == "")
      error = 'Вы не указали год своего рождения.';
    else if ((/[^a-zA-Zа-яА-Я0-9]/.test(city)))
      error = 'Город должен состоять только из букв русского и английского алфавита, а также из цифр.';
    else if ((/[^0-9]/.test(icq)))
      error = 'ICQ должна состоять только из цифр.';
    else if ((/[<>'"]/.test(deviz)))
      error = 'В девизе не должны употребляться запрещенные символы.';
    else if (!($('input[name=rules]').is(':checked')))
      error = 'Вы должны принять правила Анти Бойцовского Клуба.';
    else
      $('form[name=regstep4]').die().submit();
    $("#error").show().html(error);
    return false;
  });
});
</script>
<?
$file = file("regfail.dat");
$file = split(',', $file[0]);
$num = count($file);
$regfail = '';
for ($i = 0; $i <= $num - 1; $i++)
{    
  if (isset($file[$i]))
    $regfail .= "regfail[$i] = '".$file[$i]."';";
}
echo "<script type='text/javascript'>$regfail</script>";
?>
</head>
<body bgColor="#3D3D3B" leftMargin="0" topMargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <thead><tr><td background="img/site/sitebk_02.jpg" align="center"><img src="img/site/sitebk_03.gif" width="194" height="135"></td></tr></thead>
  <tfoot>
    <tr><td width="100%" height="13" background="img/site/sitebk_07.jpg"></td></tr>
    <tr><td width="100%" bgColor="#000" height="20" align="center" class="copyright">Copyright © 2002—2010 Dragon Server</td></tr>
  </tfoot>
  <tbody>
  <tr>
    <td align="center" height="90%" valign="top">
      <table width="75%" height=100% border="0" cellpadding="0" cellspacing="0" bgcolor="#f2e5b1">
        <tfoot>
        <tr>
          <td style="background: url(img/site/n21_08_1.jpg) repeat-y;"></td>
          <td colspan="3" align="right"><img src="img/site/nm314_13.jpg" border="0"></td>
          <td valign="top" background="img/site/nnn21_03_1.jpg"></td>
        </tr>
        </tfoot>
        <tbody>
        <tr valign="top">
          <td width="29" align="right" valign="top" style="background: url(img/site/n21_08_1.jpg) repeat-y;"><img src="img/site/nm31_08.jpg"></td>
          <td><img src="img/site/nm31_04.jpg"></td>
          <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><br><br><img src="img/site/regen_10.gif"><p><span class="style5"><b>Внимание!</b></span> Данная игра работает <u>только</u> под браузером Mozilla Firefox!<br>
                <div id="error" readonly cols="100" rows="1" style="color: red; font-weight: bold; background-color: #f2e5b1; border: 0; display: none;"></div></p></td>
              </tr>
              <tr><td>
<?  switch ($step)
    {
      default :
      case '':
?>
                <form name="regstep1" action="?step=2" class="norm" method="post">
                <table class="g" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr class="bg6">
                    <td><span class="style5">* </span>&nbsp;Имя вашего<br> &nbsp; &nbsp; персонажа (login):</td>
                    <td><input type="text" name="reg_login" class="inup" size="25" maxlength="15" value="<?echo (isset($_SESSION['reg_login'])) ?$_SESSION['reg_login'] :'';?>"> &nbsp;<input type="submit" class="btn" value="Продолжить"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 5px 0 0 20px;">
<p><small><span class="style7">Ограничения:</span>
<br>1. Имя не может быть короче 2-х символов и длиннее 15-ти. Имя не может состоять более чем из трех слов.<br>Правильно: <b>Грозный Вася</b>, <b>Чудовище</b>, <b>Ли</b><br>Неправильно: <b>Ы</b>, <b>Суперубивающий Монстр</b>
<br><br>2. Имя может содержать только буквы или русского или английского алфавита. В качестве разделительных символов можно использовать символ &quot;_&quot; или тире &quot;-&quot;<br>Правильно: <b>Вася-Зверь</b>, <b>Идуший по полю</b><br>Неправильно: <b>Вася 17</b>, <b>*Вася*</b>
<br><br>3. Допускается использовать или только английские буквы, или только русские, но нельзя одновременно использовать буквы обоих алфавитов.<br>Правильно: <b>Громобоец</b>, <b>Dead Moroz</b><br>Неправильно: <b>Super Вася</b>, <b>Игорь the best</b>
<br><br>4. Имя не может содержать заглавную букву после обычной.<br>Правильно: <b>Vasya</b>, <b>Иван Петрович</b><br>Неправильно: <b>vAsya</b>, <b>ИванПетрович</b>
<br><br>5. Имя не может начинаться или заканчиваться пробелом, подчеркиванием или тире<br>Правильно: <b>Vasya</b>, <b>Иван Петрович</b><br>Неправильно: <b>Vasya-</b>, <b>-Иван Петрович-</b>
<br><br>6. Запрещено использовать два разделительных символа подряд<br>Правильно: <b>Вася c топором</b>, <b>Иван Петрович</b><br>Неправильно: <b>Вася--и--топор</b>, <b>Иван- Петрович</b>
<br><br>7. Запрещено использование трех и более одинаковых символов подряд<br>Правильно: <b>Вася с топором</b>, <b>Иван Петрович</b><br>Неправильно: <b>Вааася</b>, <b>Петрррович</b>
<br><br>8. Имя должно быть читаемым. Запрещены некоторые сочетания букв (ЪЪ, например) и четыре и более согласных подряд.<br>Правильно: <b>Вася c топором</b>, <b>Иван Петрович</b><br>Неправильно: <b>FTRNZJ</b>, <b>Ъъефф</b>
<br><br>9. Имя не может содержать нецензурную лексику и оскорбления.<br>Правильно: <b>Вася</b>, <b>Иван Петрович</b><br>Неправильно: <b><font color="red">&lt;вырезано цензурой&gt;</font></b>, <b><font color="red">&lt;вырезано шокированой цензурой&gt;</font></b><br>
<br><br>
</small></p>
                    </td>
                  </tr>
                </table>
                </form>
<?      break;
        case 2:
          if (!isset($_SESSION['reg_login'])) die($error_text);
?>
                <form name="regstep2" action="?step=3" class="norm" method="post">
                <table class="g" align="center" border="0" cellpadding="0" cellspacing="0">
                  <tr class="bg6">
                    <td width="500"><span class="style5">*</span><font style="margin-left: 20px;">Имя вашего персонажа:</font></td>
                    <td width="300"><p><?echo $_SESSION['reg_login'];?></p></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 20px;">Пароль:</font></td>
                    <td><input type="password" name="password" class="inup" size="20" maxlength="21" value="<?echo (isset($_SESSION['reg_password'])) ?$_SESSION['reg_password'] :''?>"></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 20px;">Пароль повторно:</font></td>
                    <td><input type="password" name="password_confirm" class="inup" size="20" maxlength="21" value="<?echo (isset($_SESSION['reg_password'])) ?$_SESSION['reg_password'] :''?>"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 5px 0 0 29px;">
<p><small><span class="style7">Хороший вариант пароля: четыре разные буквы и две цифры. Например hero63
<br><br>Перед выбором пароля, прочтите</span> <a href="encicl/FAQ/afer.html" target="_blank"><b>эту заметку</b></a>
<br>1. Пароль не может быть короче 6 символов.<br>Неправильно: <b>mks23</b>, <b>zm2</b><br>Правильно: <b>telez371</b>
<br><br>2. Запрещены пароли содержащие только буквы одной раскладки и одного регистра.<br>Неправильно: <b>sharksn</b>, <b>letotron</b><br>Правильно: <b>sharksn25</b>, <b>leto_tron</b>
<br><br>3. Запрещены простые, распространенные пароли.<br>Неправильно: <b>qwerty123456</b>, <b>qazwsx098</b><br>Правильно: <b>telez371</b>, <b>nord-23k</b>
<br><br>4. Пароль не должен содержать части логина. Неправильно: <b>vasya2004</b> при логине <b>Vasya</b><br>Правильно: <b>telez371</b>, <b>nord-23k</b> при логине <b>Vasya</b>.
<br><br>5. Категорически не рекомендуется выбирать пароль совпадающий с паролем на email.<br><br>
</small></p>
                    </td>
                  </tr>
                  <tr>
                    <td><input onclick="location.href='?step=1';" type="button" class="btn" value="Вернуться"></td>
                    <td><input type="submit" class="btn" value="Продолжить"></td>
                  </tr>
                </table>
                </form>
<?      break;
        case 3:
          if (!isset($_POST['password']) || !isset($_POST['password_confirm'])) die($error_text);
          $_SESSION['reg_password'] = $_POST['password'];
?>
                <form name="regstep3" action="?step=4" class="norm" method="post">
                <table class="g" align="center" border="0" cellpadding="1" cellspacing="0">
                  <tr class="bg6">
                    <td width="500"><span class="style5">*</span><font style="margin-left: 15px;">Имя вашего персонажа:</font></td>
                    <td width="300"><p><?echo $_SESSION['reg_login'];?></p></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 15px;">Ваш e-mail:</font></td>
                    <td><input type="text" name="email" class="inup" size="30" maxlength="50" value="<?echo (isset($_SESSION['reg_email'])) ?$_SESSION['reg_email'] :''?>"></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="padding: 5px 0 10px 27px;"><p>(используется <u>только</u> для напоминания пароля, нигде не отображается и не 
                    <br>используется для рассылки &quot;уведомлений/обновлений/...&quot; и прочего спама.
                    <br>В целях безопасности запрещена регистрация с @hotmail.com)</p></td>
                  </tr>
                  <tr>
                    <td width="146" style="padding: 5px 0 10px 27px;">Ваш секретный вопрос:</td>
                    <td><input type="text" name="secretquestion" class="inup" value="" size="30" maxlength="50"></td>
                  </tr>
                  <tr>
                    <td style="padding: 5px 0 10px 27px;">Ответ на секретный вопрос: </td>
                    <td><input type="text" name="secretanswer" value="" class="inup" size="30" maxlength="50"></td>
                  </tr>
                  <tr><td colspan="2" style="padding: 5px 0 10px 27px;"><span class="style7"><small>(Если указаны вопрос и ответ, то высылка пароля на email будет производится лишь при правильном ответе)</small></span></td></tr>
                  <tr>
                    <td><input onclick="location.href='?step=2';" type="button" class="btn" value="Вернуться"></td>
                    <td><input type="submit" class="btn" value="Продолжить"></td>
                  </tr>
                </table>
                </form>
<?      break;
        case 4:
          if (!isset($_POST['email'])) die($error_text);
          $email = $_POST['email'];
          $secretquestion = $_POST['secretquestion'];
          $secretanswer = $_POST['secretanswer'];
          //$code = rand(1000, 9999);
          $_SESSION['reg_email'] = $email;
          $_SESSION['secretquestion'] = $secretquestion;
          $_SESSION['secretanswer'] = $secretanswer;
?>
                <form name="regstep4" action="?step=5" class="norm" method="post">
                <table class="g" align="center" border="0" cellpadding="1" cellspacing="0" width="100%">
                  <tr class="bg6">
                    <td><span class="style5">*</span><font style="margin-left: 8px;">Имя вашего</font> <div style="margin-left: 17px;">персонажа:</div></td>
                    <td><?echo $_SESSION['reg_login'];?></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 8px;">Ваше реальное имя: </font> </td>
                    <td><input type="text" name="name" class="inup" size="45" maxlength="90"></td>
                  </tr>
                  <tr>
                    <td><span class="style5">*</span><font style="margin-left: 8px;">День рождения:</font></td>
                    <td>День: <select name="birth_day" class="inup">
                      <option selected></option>
<?                      for ($i = 1; $i <= 31; $i++)
                        {
                          $i = ($i < 10) ?"0".$i :$i;
                          echo "<option value='$i'>$i</option>";
                        }
?>                    </select>
                      Месяц: <select name="birth_month" class="inup">
                      <option selected></option>
<?                      foreach ($data['month'] as $value => $name)
                          echo "<option value='$value'>$name</option>";
?>                    </select>
                      Год: <select name="birth_year" class="inup">
                      <option selected></option>
<?                      for ($i = date('Y') - 72; $i <= (date('Y') - 10); $i++)
                          echo "<option value='$i'>$i</option>";
?>                    </select>
                    </td>
                  </tr>
                  <tr><td colspan="2"><div style="margin-left: 16px;"><small><span class="style5">Внимание! </span><span class="style7">Дата рождения должна быть правильной, она используется в игровом процессе. Анкеты с неправильной датой будут удаляться без предупреждения.</span></small></div></td></tr>
                  <tr><td colspan="2"><span class="style5">*</span><font style="margin-left: 8px;">Пол персонажа:</font></td></tr>
                  <tr>
                    <td style="padding-left: 16px;">
                      <input type="radio" name="sex" class="inup" checked value="male">Мужской<br>
                      <input type="radio" name="sex" class="inup" value="female">Женский
                    </td>
                  </tr>
                  <tr><td colspan="2" style="padding-left: 16px;"><small><span class="style5">Внимание! </span><span class="style7">Пол персонажа должен соответствовать реальному полу игрока.</span></small></td></tr>
                  <tr>
                    <td style="padding-left: 16px;">Город:</td>
                    <td><select size="1" name="city_n">
                      <option selected></option>
<?                      foreach ($data['towns'] as $name)
                          echo "<option value='$name'>$name</option>";
?>                    </select>
                    </td>
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
                    <td><input type="text" name="deviz" class="inup" size="60" maxlength="160"></td>
                  </tr>
                  <tr>
                    <td style="padding-left: 16px;">Цвет сообщений в<br> чате:</td>
                    <td><select name="color" class="inup">
<?                    foreach ($data['colors'] as $color => $name)
                        echo "<option style='color: $color;' value='$color'>$name</option>";
?>
                      </select>
                    </td>
                  </tr>
                  <tr><td colspan="2"><br><span class="style5">*</span><input type="checkbox" name="rules">Я обязуюсь соблюдать <a href="encicl/law.html" target="_blank"><b>Законы Анти Бойцовского Клуба</b></a><br><br></td></tr>
<!---  <tr>
<td width="166" align="right"><span class="style6"><span class="style7">*</span>Код подтверждения:</span></td>
<td width="564"><img src=regcode.php>
<input type="text" name="secret_code" class="field" size="30" maxlength="4" style="filter:alpha(Opacity=80);">
</td>
</tr>  --->
                  <tr>
                    <td><input onclick="location.href='?step=3';" type="button" class="btn" value="Вернуться"></td>
                    <td><input type="submit" class="btn" value="Продолжить"></td>
                  </tr>
                </table>
                </form>
<?      break;
        case 5:
          if (!isset($_POST['rules']) || !isset($_POST['name']) || !isset($_POST['sex']) || !isset($_POST['birth_day']) || !isset($_POST['birth_month']) || !isset($_POST['birth_year'])) die($error_text);
          $reg_login = $_SESSION['reg_login'];
          $password = $_SESSION['reg_password'];
          $email = $_SESSION['reg_email'];
          $secretquestion = htmlspecialchars($_SESSION['secretquestion']);
          $secretanswer = htmlspecialchars($_SESSION['secretanswer']);
          // $code = $_POST['secret_code'];
          // $code_loaded = $_POST['code_loaded'];
          $name = requestVar('name');
          $sex = requestVar('sex');
          $icq = requestVar('icq');
          $hide_icq = requestVar('hide_icq', 0);
          $town = (isset($_POST['city_n']) && $_POST['city_n'] != '') ?htmlspecialchars($_POST['city_n']) :((isset($_POST['city'])) ?htmlspecialchars($_POST['city']) :"");
          $city = "dem";
          $deviz = requestVar('deviz');
          $color = requestVar('color');
          //elseif($code != $code_loaded){echo 'Ошибка при введении кода! <a href="?step=4">Назад</a><br>'; die();}
          $birthday = requestVar('birth_day').".".requestVar('birth_month').".".requestVar('birth_year');
          $shape = ($sex == "male") ?"m/0.gif" :"f/0.gif";
          unset($_SESSION['reg_login'], $_SESSION['reg_password'], $_SESSION['reg_email'], $_SESSION['secretquestion'], $_SESSION['secretanswer']);
          if ($adb->selectCell("SELECT COUNT(*) FROM `characters` WHERE `login` = ?s", $reg_login) == 0)
          {
            $guid = ($adb->selectCell("SELECT MAX(`guid`) FROM `characters`;")) + 1;
            $reg_password = SHA1($guid.':'.$password);
            $char = Char::initialization($guid, $adb);
            // Основная база
            $adb->query("INSERT INTO `characters` (`guid`, `login`, `login_sec`, `password`, `mail`, `sex`, `city`, `shape`, `reg_ip`, `last_time`) 
                         VALUES (?d, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?s, ?d);", $guid ,$reg_login ,$reg_login ,$reg_password ,$email ,$sex ,$city ,$shape ,$_SERVER['REMOTE_ADDR'] ,time());
            // Характеристики
            $adb->query("INSERT INTO `character_stats` (`guid`) 
                         VALUES (?d);", $guid);
            // Дополнительная информация
            $adb->query("INSERT INTO `character_info` (`guid`, `name`, `icq`, `secretquestion`, `secretanswer`, `hide_icq`, `town`, `birthday`, `color`, `deviz`, `state`, `date`) 
                         VALUES (?d, ?s, ?s, ?s, ?s, ?d, ?s, ?s, ?s, ?s, ?s, ?d);", $guid ,$name ,$icq ,$secretquestion ,$secretanswer ,$hide_icq ,$town ,$birthday ,$color ,$deviz ,$city ,time());
            // Создание инвентаря
            $adb->query("INSERT INTO `character_equip` (`guid`) 
                         VALUES (?d);", $guid);
            // Создание баров
            $adb->query("INSERT INTO `character_bars` (`guid`) 
                         VALUES (?d);", $guid);
            // Эффекты
            $adb->query("INSERT INTO `character_effects` (`guid`, `effect_entry`, `end_time`) 
                         VALUES (?d, '1', '0');", $guid);
            $id = ($adb->selectCell("SELECT MAX(`id`) FROM `character_inventory`;")) + 1;
            // Предметы
            $adb->query("INSERT INTO `character_inventory` (`id`, `guid`, `item_entry`, `wear`, `tear_max`, `made_in`, `last_update`) 
                         VALUES (?d, ?d, '920', '1', '20', ?s, ?d),
                                (?d, ?d, '1031', '1', '10', ?s, ?d);", $id ,$guid ,$city ,time() ,($id+1) ,$guid ,$city ,time());
            $adb->query("UPDATE `character_equip` SET `pants` = ?d, `shirt` = ?d WHERE `guid` = ?d", $id ,($id+1) ,$guid);
            $char->history->authorization(2, $city);
            echoScript("location.href = 'enter.php?login=$reg_login&password=$password';", true);
          }
        break;
    }
?>
                </td>
              </tr>
            </table>
          </td>
          <td><img src="img/site/ico_n13profile_03ru.jpg" border="0" valign="top"></td>
          <td width="23" valign="top" background="img/site/nnn21_03_1.jpg"></td>
        </tr>
        </tbody>
      </table>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>