<?
defined('AntiBK') or die ("Доступ запрещен!");
?>
<style>
body {background-color: #e2e0e0;}
</style>
<?
switch ($action)
{
  case 'shape':
    echoScript("$(function (){showShapes(1);});");
    
    if ($char_db['next_shape'] && $char_db['next_shape'] > time())
      $char->error->Inventory(111, getFormatedTime($char_db['next_shape']));
    
    echo "<table width='100%' cellspacing='0' cellpadding='0' border='0' style='margin-bottom: -10px;'><tr>";
    echo "<td valign='top' nowrap><input type='submit' id='shape_a' value='Доступные' class='nav' style='background-color: #A9AFC0;' onclick='showShapes(1);'>&nbsp;<input type='submit' id='shape_na' value='Все образы' class='nav' onclick='showShapes(0);'></td>";
    echo "<td width='100%' align='right'><h3>Выбрать образ персонажа \"$login\"</h3></td>";
    echo "<td valign='top' nowrap><input type='button' class='help' value='$lang[hint]' id='hint' link='image'>&nbsp;<input type='button' value='$lang[return]' id='link' link='inv' class='nav'></td>";
    echo "</tr></table>";
    echo "<font color='red' id='error'></font>";
    echo "<div id='shapes' style='width: 100%;'></div>";
  break;
  case 'security':
    $pass = getVar('pass');
    
    if (isset($_POST['changeMail']))
    {
      $old_mail = getVar('old_mail');
      $new_mail = getVar('new_mail');
      
      if ($char_db['next_change'] != 0 && time() < $char_db['next_change'])
        $char->error->Form(515, $do);
      
      if (!$pass)
        $char->error->Form(507, $do);
      
      if (!$old_mail)
        $char->error->Form(508, $do);
      
      if (!$new_mail)
        $char->error->Form(509, $do);
      
      if (SHA1($guid.':'.$pass) != $char_db['password'])
        $char->error->Form(501, $do);
      
      if ($old_mail != $char_db['mail'])
        $char->error->Form(510, $do);
      
      if (!eregi ("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $new_mail))
        $char->error->Form(511, $do);
      
      $q = $char->setChar('char_db', array('mail' => $new_mail, 'next_change' => (time() + 259200)));
      $msg = "Здравствуйте!\n";
      $msg .= DATE_NO_SEC." был сменен e-mail, указанный при регистрации персонажа $login он-лайн игры Анти Бойцовский Клуб.\n";
      $msg .= "Новый e-mail: $new_mail\n\n\n\n";
      $msg .= "С уважением, администрация Анти Бойцовского Клуба!";
      mail($char_db['mail'], "Смена e-mail у персонажа $login", $msg, 'From: Администрация АБК <admin@abk.ru>', 'admin@abk.ru');
      
      if ($q)
        $char->error->Form(512, $do);
    }
    else if (isset($_POST['changePsw']))
    {
      $new_pass = getVar('new_pass');
      $new_pass2 = getVar('new_pass2');
      
      if ($char_db['next_change'] != 0 && time() < $char_db['next_change'])
        $char->error->Form(515, $do);
      
      if (!$pass || ($pass && !$new_pass))
        $char->error->Form(0, $do);
      
      if ($pass && $new_pass && !$new_pass2)
        $char->error->Form(500, $do);
      
      if (SHA1($guid.':'.$pass) != $char_db['password'])
        $char->error->Form(501, $do);
      
      if ($new_pass != $new_pass2)
        $char->error->Form(502, $do);
      
      if (utf8_strlen($new_pass) < 6 || utf8_strlen($new_pass) > 30)
        $char->error->Form(503, $do);
      
      if (!ereg ("[a-zA-Zа-яА-Я0-9]$", $new_pass))
        $char->error->Form(506, $do);
      
      $q = $char->setChar('char_db', array('password' => SHA1($guid.':'.$new_pass), 'next_change' => (time() + 259200)));
      $msg = "Здраствуйте!\n";
      $msg .= DATE_NO_SEC." был сменен пароль к персонажу $login он-лайн игры Анти Бойцовский Клуб.\n";
      $msg .= "Новый пароль: $new_pass\n\n\n\n";
      $msg .= "С уважением, администрация Анти Бойцовского Клуба!";
      mail($char_db['mail'], "Смена пароля у персонажа $login", $msg, 'From: Администрация АБК <admin@abk.ru>', 'admin@abk.ru');
      
      if ($q)
        $char->error->Form(504, $do);
    }
    else if (isset($_POST['changeSqa']))
    {
      $secretquestion = getVar('secretquestion');
      $secretanswer = getVar('secretanswer');
      
      if ($char_db['next_change'] != 0 && time() < $char_db['next_change'])
        $char->error->Form(515, $do);
      
      if (!$pass)
        $char->error->Form(507, $do);
      
      if (!$secretquestion)
        $char->error->Form(513, $do);
            
      if (SHA1($guid.':'.$pass) != $char_db['password'])
        $char->error->Form(501, $do);
            
      $q1 = $char->setChar('char_info', array('secretquestion' => $secretquestion, 'secretanswer' => $secretanswer));
      $q2 = $char->setChar('char_db', array('next_change' => (time() + 259200)));
      $msg = "Здравствуйте!\n";
      $msg .= DATE_NO_SEC." был сменен секретный вопрос/ответ, указанный при регистрации персонажа $login он-лайн игры Анти Бойцовский Клуб.\n";
      $msg .= "Новый вопрос: $secretquestion\n";
      $msg .= "Новый ответ: $secretanswer\n\n\n\n";
      $msg .= "С уважением, администрация Анти Бойцовского Клуба!";
      mail($char_db['mail'], "Смена секретного вопроса/ответа у персонажа $login", $msg, 'From: Администрация АБК <admin@abk.ru>', 'admin@abk.ru');
      
      if ($q1 && $q2)
        $char->error->Form(514, $do);
    }
    $secretqa = $char->getChar('char_info', 'secretquestion');
?>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: -15px;">
<tr>
  <td width="100%" align="right"><h3>Сменить пароль/email для персонажа "<?echo $login;?>"</h3></td>
  <td valign="top" nowrap><input type="button" class="help" value="<?echo $lang['hint'];?>" id="hint" link="psw">&nbsp;<input type="button" name="edit" value="<?echo $lang['return'];?>" id="link" link="inv" class="nav"></td>
</tr>
</table>
<font color='red' id='error'><?$char->error->getFormattedError($error, $parameters);?></font>
<br>
Чем выше уровень вашего персонажа, тем больше к нему внимание со стороны хакеров, взломщиков и аферистов. Чтобы однажды не оказаться в ситуации, когда вы уже не сможете зайти под своим персонажем, которого развивали (которым жили!) месяцами, потому что пароль сменили, email сменили, все предметы/вещи/кредиты... все что нажито непосильным трудом... ушли в неизвестном направлении, необходимо соблюдать элементарные меры предосторожности. А именно:<br>
1. Никогда, ни под каким предлогом, никому не говорите свой пароль. Ни паладинам, ни администрации не нужно знать ваш пароль.<br>
2. Вводите логин и пароль только на титульной странице <a href="../" target="_blank" class="nick">www.combats.com</a> Ни на каких других сайтах, которые будут как две капли похожие на наш, и куда вас зазывают обещая на халяву предметы и кредиты, не вводите свой пароль! Иначе вы рискуете потерять своего персонажа.<br>
Настоятельно рекомендуем прочесть заметку <a href="encicl/FAQ/afer.html" target="_blank" class="nick">Виды обмана в Бойцовском Клубе</a>.<br><br>
Если вы играете из интернет кафе или компьютерного клуба, где шанс быть взломанным очень высокий, рекомендуем включить второй и третий уровень защиты (см. ниже)<br><br>
<form action="main.php?action=security" name="pass_form" method="post">
<fieldset><legend><b>&nbsp;Сменить пароль</b></legend>
<table>
<tr><td align="right">Старый пароль:</td><td><input type="password" name="pass" size="15" maxlength="31"></td></tr>
<tr><td align="right">Новый пароль:</td><td><input type="password" name="new_pass" size="15" maxlength="31"></td></tr>
<tr><td align="right">Новый пароль (еще раз):</td><td><input type="password" name="new_pass2" size="15" maxlength="31"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Сменить пароль" name="changePsw"></td></tr>
</table>
</fieldset>
</form>
<form action="main.php?action=security" name="mail_form" method="post">
<fieldset><legend><b>&nbsp;Сменить email</b></legend>
<table>
<tr><td align="right">Ваш пароль:</td><td><input type="password" name="pass" size="15" maxlength="31"></td></tr>
<tr><td align="right">Прежний email:</td><td><input type="text" name="old_mail" size="20" maxlength="50"></td></tr>
<tr><td align="right">Новый email:</td><td><input type="text" name="new_mail" size="20" maxlength="50"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Сменить email" name="changeMail"></td></tr>
</table>
</fieldset>
</form>
<form action="main.php?action=security" name="secret_form" method="post">
<fieldset><legend><b>&nbsp;Сменить секретный вопрос/ответ</b></legend>
<table>
<tr><td align="right">Ваш пароль:</td><td><input type="password" name="pass" size="15" maxlength="31"></td></tr>
<tr><td align="right">Старый вопрос:</td><td><b><?echo $secretqa;?></b></td></tr>
<tr><td align="right">Новый вопрос:</td><td><input type="text" name="secretquestion" size="40" maxlength="50"></td></tr>
<tr><td align="right">Новый ответ:</td><td><input type="text" name="secretanswer" size="40" maxlength="50"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Сменить" name="changeSqa"></td></tr>
</table>
</fieldset>
</form>
<u>Учтите</u>, вы не можете одновременно поменять email, пароль или секретные вопрос/ответ. Период должен составлять не менее трех суток.<br>
<?
  break;
  case 'info':
    if (isset($_POST['changeInfo']))
    {
      $name = getVar('name');
      $birth_day = getVar('birth_day');
      $birth_month = getVar('birth_month');
      $birth_year = getVar('birth_year');
      $birthday = $birth_day.'.'.$birth_month.'.'.$birth_year;
      $town = (isset($_POST['town_n']) && $_POST['town_n'] != '') ?htmlspecialchars($_POST['town_n']) :((isset($_POST['town'])) ?htmlspecialchars($_POST['town']) :"");
      $icq = getVar('icq');
      $hide_icq = getVar('hide_icq', 0);
      $url = getVar('url');
      $color = getVar('color');
      $motto = getVar('motto');
      $hobie = getVar('hobie');
      $hobie = str_replace("\n", "<br>", $hobie);
      
      $count_words = count(split(' ', $hobie));
      if ($count_words > 60)
        $error = "Слишком большой размер поля \"Хобби, увлечения\". Максимальное количество: 60 слов.";
      else if (strlen($hobie) > 2500)
        $error = "Слишком большой размер поля \"Хобби, увлечения\". Максимальный размер: 2500 символов.";
      else
      {
        $q = $char->setChar('char_info', array('name' => $name, 'birthday' => $birthday, 'icq' => $icq, 'hide_icq' => $hide_icq, 'url' => $url, 'town' => $town, 'color' => $color, 'motto' => $motto, 'hobie' => $hobie));
        if ($q)
          $error = "Сохранено удачно.";
      }
    }
    
    $char_info = $char->getChar('char_info', 'name', 'icq', 'hide_icq', 'url', 'town', 'birthday', 'color', 'motto', 'hobie');
    ArrToVar($char_info, 's_');
    $s_hobie = str_replace(array("<br>", '\&quot;', "\'"), array("\n", '"', "'"), $s_hobie);
    $s_hide_icq = ($s_hide_icq) ?" checked" :"";
    $s_birthday = split('\.', $s_birthday);
    
    if (!empty($error))
      echo "<font color='red'><b>$error</b></font>";
?>
<table width="99%" cellspacing="0" cellpadding="0" align="center"><tr>
  <td width="100%" style="padding-top: 15px;"><h3>Анкета персонажа "<?echo $login;?>"</h3></TD>
  <td valign="top"><input type="button" value="<?echo $lang['return'];?>" id="link" link="inv" class="nav"></td>
</tr></table>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B2B2B2">
<form name="info_form" action="main.php?action=info" method="post">
<tr class="anketabg"><td width="170">Ваше реальное имя: </td><td><input name="name" value="<?echo $s_name;?>" size="45" maxlength="90" /></td></tr>
<tr class="anketabg">
  <td>День рождения: </td>
  <td>День: <select name="birth_day" class="inup">
<?    for ($i = 1; $i <= 31; $i++)
      {
        $i = ($i < 10) ?"0".$i :$i;
        $selected = ($s_birthday[0] == $i) ?" selected" :"";
        echo "<option value='$i'$selected>$i</option>";
      }
?>  </select>
    Месяц: <select name="birth_month" class="inup">
<?    foreach ($data['month'] as $value => $name)
      {
        $selected = ($s_birthday[1] == $value) ?" selected" :"";
        echo "<option value='$value'$selected>$name</option>";
      }
?>  </select>
    Год: <select name="birth_year" class="inup">
<?    for ($i = date('Y') - 72; $i <= (date('Y') - 10); $i++)
      {
        $selected = ($s_birthday[2] == $i) ?" selected" :"";
        echo "<option value='$i'$selected>$i</option>";
      }
?>  </select>
    <small><br><span class="style5">Внимание! </span><span class="style7">Дата рождения должна быть правильной, она используется в игровом процессе. Анкеты с неправильной датой будут удаляться без предупреждения.</span></small>
  </td>
</tr>
<tr class="anketabg">
  <td>Город: </td>
  <td><select size="1" name="town_n">
    <option selected></option>
<?    foreach ($data['towns'] as $name)
      {
        if ($s_town == $name)
        {
          $selected = " selected";
          $s_town = "";
        }
        else
          $selected = "";
        echo "<option$selected value='$name'>$name</option>";
      }
?>  </select>
    &nbsp; &nbsp;другой&nbsp; &nbsp;<input type="text" value="<?echo $s_town;?>" name="town" size="20" maxlength="40" />
  </td>
</tr>
<tr class="anketabg"><td>ICQ:</td><td><input value="<?echo $s_icq;?>" name="icq" size="10" maxlength="20" /> <input type="checkbox" name="hide_icq" value="1"<?echo $s_hide_icq;?> /> не отображать в инф. о персонаже.</td></tr>
<tr class="anketabg"><td>Домашняя страница:</td><td><input value="<?echo $s_url;?>" name="url" size="35" maxlength="60" /></td></tr>
<tr class="anketabg"><td>Девиз:</td><td><input value="<?echo $s_motto;?>" name="motto" size="60" maxlength="160" /></td></tr>
<tr class="anketabg"><td colspan="2" align="left">Увлечения / хобби <small>(не более 60 слов)</small><br><textarea name="hobie" cols="60" rows="7" style="width: 100%;"><? echo $s_hobie;?></textarea></td></tr>
<tr class="anketabg">
  <td>Цвет сообщений в чате:</td>
  <td><select size="1" name="color" class="anketa">
<?  foreach ($data['colors'] as $color => $name)
    {
      $selected = ($s_color == $color) ?" selected" :"";
      echo "<option style='color: $color;'$selected value='$color'>$name</option>";
    }
?>    </select>
  </td>
</tr>
<tr class="anketabg" height="50"><td colspan="2" align="center"><input name="changeInfo" type="submit" value="Сохранить изменения" class="nav" /></td></tr>
</form>
</table>
<?
  break;
}
?>