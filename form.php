<?
defined('AntiBK') or die ("Доступ запрещен!");
?>
<style>
body {background-color: #e2e0e0;}
</style>
<?
switch ($do)
{
	case 'shape':
		echo "<script>$(document).ready(function (){showShapes (1);});</script>";
		if ($db['next_shape'] && $db['next_shape'] > time ())
			$error -> Inventory (111, getFormatedTime ($db['next_shape']));
		
		echo "<table width='100%' cellspacing='0' cellpadding='0' border='0' style='margin-bottom: -10px;'><tr>";
		echo "<td valign='top' nowrap><input type='submit' id='shape_a' value='Доступные' class='nav' style='background-color: #A9AFC0;' onclick='showShapes (1);'>&nbsp;<input type='submit' id='shape_na' value='Все образы' class='nav' onclick='showShapes (0);'></td>";
		echo "<td width='100%' align='right'><h3>Выбрать образ персонажа \"$login\"</h3></td>";
		echo "<td valign='top' nowrap><input type='button' class='help' value='Подсказка' id='hint' link='image'>&nbsp;<input type='button' value='Вернуться' id='revert' link='inv' class='nav'></td>";
		echo "</tr></table>";
		echo "<font color='red' id='error'></font>";
		echo "<div id='shapes' style='width: 100%;'></div>";
	break;
	case 'passandmail':
		if (isset($_POST['changeMail']))
		{
			$old_mail = requestVar ('old_mail');
			$new_mail = requestVar ('new_mail');
			
			if (!$pass)
				$error -> Form (507, $do);
			
			if (!$old_mail)
				$error -> Form (508, $do);
			
			if (!$new_mail)
				$error -> Form (509, $do);
			
			if (SHA1 ($guid.':'.$pass) != $db['password'])
				$error -> Form (501, $do);
			
			if ($old_mail != $db['mail'])
				$error -> Form (510, $do);
			
			if (!eregi ("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $new_mail))
				$error -> Form (511, $do);
			
			$q = $adb -> query ("	UPDATE `characters` 
									SET `mail` = ?s 
									WHERE `guid` = ?d", $new_mail ,$guid);
			$msg = "Здравствуйте!\n";
			$msg .= DATE_NO_SEC." был сменен e-mail, указанный при регистрации персонажа $login он-лайн игры Анти Бойцовский Клуб.\n";
			$msg .= "Новый e-mail: $new_mail\n\n\n\n";
			$msg .= "С уважением, администрация Анти Бойцовского Клуба!";
			mail ($db['mail'], "Смена e-mail у персонажа $login", $msg, 'From: Администрация АБК <admin@abk.ru>', 'admin@abk.ru');
			if ($q)
				$error -> Form (512, $do);
		}
		else if (isset($_POST['changePass']))
		{
			$new_pass = requestVar ('new_pass');
			$new_pass2 = requestVar ('new_pass2');
			
			if (!$pass || ($pass && !$new_pass))
				$error -> Form (0, $do);
			
			if ($pass && $new_pass && !$new_pass2)
				$error -> Form (500, $do);
			
			if (SHA1 ($guid.':'.$pass) != $db['password'])
				$error -> Form (501, $do);
			
			if ($new_pass != $new_pass2)
				$error -> Form (502, $do);
			
			if (utf8_strlen ($new_pass) < 6 || utf8_strlen ($new_pass) > 30)
				$error -> Form (503, $do);
			
			if (!ereg ("[a-zA-Zа-яА-Я0-9]$", $new_pass))
				$error -> Form (506, $do);
			
			$q = $adb -> query ("	UPDATE `characters` 
									SET `password` = ?s 
									WHERE `guid` = ?d", SHA1 ($guid.':'.$new_pass) ,$guid);
			$msg = "Здраствуйте!\n";
			$msg .= DATE_NO_SEC." был сменен пароль к персонажу $login он-лайн игры Анти Бойцовский Клуб.\n";
			$msg .= "Новый пароль: $new_pass\n\n\n\n";
			$msg .= "С уважением, администрация Анти Бойцовского Клуба!";
			mail ($db['mail'], "Смена пароля у персонажа $login", $msg, 'From: Администрация АБК <admin@abk.ru>', 'admin@abk.ru');
			if ($q)
				$error -> Form (504, $do);
		}
?>
<table width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: -15px;">
	<tr>
		<td width="100%" align="right"><h3>Сменить пароль/email для персонажа "<?echo $login;?>"</h3></td>
		<td valign="top" nowrap><input type="button" class="help" value="Подсказка" id="hint" link="psw">&nbsp;<input type="button" name="edit" value="Вернуться" id="revert" link="inv" class="nav"></td>
	</tr>
</table>
<font color='red' id='error'><?$error -> getFormattedError ($warning, $parameters);?></font>
<br>
Чем выше уровень вашего персонажа, тем больше к нему внимание со стороны хакеров, взломщиков и аферистов. Чтобы однажды не оказаться в ситуации, когда вы уже не сможете зайти под своим персонажем, которого развивали (которым жили!) месяцами, потому что пароль сменили, email сменили, все предметы/вещи/кредиты... все что нажито непосильным трудом... ушли в неизвестном направлении, необходимо соблюдать элементарные меры предосторожности. А именно:<br>
1. Никогда, ни под каким предлогом, никому не говорите свой пароль. Ни паладинам, ни администрации не нужно знать ваш пароль.<br>
2. Вводите логин и пароль только на титульной странице <a href="../" target="_blank" class="nick">www.combats.com</a> Ни на каких других сайтах, которые будут как две капли похожие на наш, и куда вас зазывают обещая на халяву предметы и кредиты, не вводите свой пароль! Иначе вы рискуете потерять своего персонажа.<br>
Настоятельно рекомендуем прочесть заметку <a href="encicl/FAQ/afer.html" target="_blank" class="nick">Виды обмана в Бойцовском Клубе</a>.<br><br>
Если вы играете из интернет кафе или компьютерного клуба, где шанс быть взломанным очень высокий, рекомендуем включить второй и третий уровень защиты (см. ниже)<br><br>
<form action="main.php?action=form&do=passandmail" name="pass_form" method="post">
<fieldset><legend><b>&nbsp;Сменить пароль</b></legend>
<table>
	<tr><td align="right">Старый пароль:</td><td><input type="password" name="pass" size="15" maxlength="30"></td></tr>
	<tr><td align="right">Новый пароль:</td><td><input type="password" name="new_pass" size="15" maxlength="30"></td></tr>
	<tr><td align="right">Новый пароль (еще раз):</td><td><input type="password" name="new_pass2" size="15" maxlength="30"></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" value="Сменить пароль" name="changePass"></td></tr>
</table>
</fieldset>
</form>
<form action="main.php?action=form&do=passandmail" name="mail_form" method="post">
<fieldset><legend><b>&nbsp;Сменить email</b></legend>
<table>
	<tr><td align="right">Ваш пароль:</td><td><input type="password" name="pass" size="15" maxlength="30"></td></tr>
	<tr><td align="right">Прежний email:</td><td><input type="text" name="old_mail" size="20" maxlength="50"></td></tr>
	<tr><td align="right">Новый email:</td><td><input type="text" name="new_mail" size="20" maxlength="50"></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" value="Сменить email" name="changeMail"></td></tr>
</table>
</fieldset>
</form>
<?
	break;
	case 'info':
		if (isset($_POST['changeInfo']))
		{
			$name = requestVar ('name');
			$town = (isset($_POST['town_n']) && $_POST['town_n'] != '') ?htmlspecialchars ($_POST['town_n']) :((isset($_POST['town'])) ?htmlspecialchars ($_POST['town']) :"");
			$icq = requestVar ('icq');
			$hide_icq = requestVar ('hide_icq', 0);
			$url = requestVar ('url');
			$color = requestVar ('color');
			$deviz = requestVar ('deviz');
			$hobie = requestVar ('hobie');
			$hobie = str_replace ("\n", "<br>", $hobie);
			
			if ($url == "http://")
				$url = "";
						
			$count_words = count (split (' ', $hobie));
			if ($count_words > 60)
				$warning = "Слишком большой размер поля \"Хобби, увлечения\". Максимальный размер: 60 слов.";
			else if (strlen ($hobie) > 2500)
				$warning = "Слишком большой размер поля \"Хобби, увлечения\". Максимальный размер: 2500 символов.";
			else
			{
				$q = $adb -> query ("	UPDATE `character_info` 
										SET `name` = ?s, 
											`icq` = ?s, 
											`hide_icq` = ?d, 
											`url` = ?s, 
											`town` = ?s, 
											`color` = ?s, 
											`deviz` = ?s, 
											`hobie` = ?s 
										WHERE `guid` = ?d", $name ,$icq ,$hide_icq ,$url ,$town ,$color ,$deviz ,$hobie ,$guid);
				if ($q)
					$warning = "Сохранено удачно.";
			}
		}
		$form = $adb -> selectRow ("	SELECT 	`name`, 
												`icq`, 
												`hide_icq`, 
												`town`, 
												`color`, 
												`deviz`, 
												`hobie`, 
												`url` 
										FROM `character_info` 
										WHERE `guid` = ?d", $guid);
		list ($s_name, $s_icq, $s_hide_icq, $s_town, $s_color, $s_deviz, $s_hob, $s_url) = array_values ($form);
		$s_hob = str_replace (array("<br>", '\&quot;', "\'"), array("\n", '"', "'"), $s_hob);
		$s_url = (!empty($s_url)) ?$s_url :"http://";
		$s_hide_icq = ($s_hide_icq) ?" checked" :"";
		
		if (!empty($warning))
			echo "<font color='red'><b>$warning</b></font>";
?>
<table width="100%" cellspacing="0" cellpadding="0" align="center" style="margin-bottom: -15px;">
	<tr>
		<td width="100%"><h3>Анкета персонажа "<?echo $login;?>"</h3></td>
		<td valign="top"><input type="button" value="Вернуться" id="revert" link="inv" class="nav"></td>
	</tr>
</table>
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B2B2B2">
<form name="info_form" action="main.php?action=form&do=info" method="post">
	<tr class="anketabg"><td>Ваше реальное имя: </td><td><input name="name" value="<?echo $s_name;?>" size="45" maxlength="90" /></td></tr>
	<tr class="anketabg">
		<td>Город: </td>
		<td><select size="1" name="town_n">
			<option selected></option>
<?			foreach ($data['towns'] as $name)
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
?>			</select>
			&nbsp; &nbsp;другой&nbsp; &nbsp;<input type="text" value="<?echo $s_town;?>" name="town" size="20" maxlength="40" />
		</td>
	</tr>
	<tr class="anketabg">
		<td>ICQ:</td>
		<td><input value="<?echo $s_icq;?>" name="icq" size="10" maxlength="20" /> <input type="checkbox" name="hide_icq" value="1"<?echo $s_hide_icq;?> /> не отображать в инф. о персонаже.</td>
	</tr>
	<tr class="anketabg"><td>Домашняя страница:</td><td><input value="<?echo $s_url;?>" name="url" size="35" maxlength="60" /></td></tr>
	<tr class="anketabg"><td>Девиз:</td><td><input value="<?echo $s_deviz;?>" name="deviz" size="60" maxlength="160" /></td></tr>
	<tr class="anketabg"><td colspan="2" align="left">Увлечения / хобби <small>(не более 60 слов)</small><br><textarea name="hobie" cols="60" rows="7" style="width: 100%;"><? echo $s_hob;?></textarea></td></tr>
	<tr class="anketabg">
		<td>Цвет сообщений в чате:</td>
		<td><select size="1" name="color" class="anketa">
<?			foreach ($data['colors'] as $color => $name)
			{
				$selected = ($s_color == $color) ?" selected" :"";
				echo "<option style='color: $color;'$selected value='$color'>$name</option>";
			}
?>			</select>
		</td>
	</tr>
	<tr class="anketabg"><td colspan="2" align="center"><input name="changeInfo" type="submit" value="Сохранить изменения" class="nav" /></td></tr>
</form>
</table>
<?
	break;
}
?>