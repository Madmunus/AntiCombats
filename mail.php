<?
$mail_to = requestVar ('mail_to', 0);
$mail_id = requestVar ('mail_id', 0);
$send_sum = requestVar ('send_sum', 0);
?>
<script src="scripts/inventory.js" type="text/javascript"></script>
<?
$section = $data['sections'][$section];

$mail_recieve = $adb->selectCell ("SELECT COUNT(*) FROM `city_mail_items` WHERE `to` = ?d", $guid) | 0;
switch ($do)
{
  case 'send_item':
    $char->mail->sendItem ($mail_to, $item_id);
  break;
  case 'get_item':
  case 'return_item':
    $char->mail->ItemMail ($item_id, $do);
  break;
  case 'get_money':
  case 'return_money':
    $char->mail->getMoney ($mail_id, $do);
  break;
  case 'check':
    if (isset($_POST['send_money']))
      $char->mail->sendMoney ($mail_to, $send_sum);
  break;
}
?>
<script src="scripts/move_check.js" type="text/javascript"></script>
<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
  <td valign="top" height="100%">
    <table width="100%" cellspacing="0" cellpadding="4" bgcolor="#d2d2d2">
    <tr>
      <td class="pH3">&nbsp; &nbsp; Почтовое отделение<?echo (isset($lang['mail_'.$do])) ?$lang['mail_'.$do] :"";?></td>
      <td align="right" valign="top"><?echo $char->info->character ();?></td>
    </tr>
    </table>
    <font color='red' id='error'><?$char->error->getFormattedError ($warning, $parameters);?></font>
<?
if ($warning)
  echo "<br>";
switch ($do)
{
  default:
?>
  <br>
  &bull; <b>Передать предмет</b><br>
  Вы можете отправить предмет любому персонажу, даже если он находится в другом городе. Цена и время доставки зависят от расстояния.<br>
  <br>
  &bull; <b>Кредиты и Телеграф</b><br>
  Вы можете отправить короткое сообщение любому персонажу, даже если он находится в offline или другом городе.<br>
  Вы можете отправить некоторую сумму денег персонажу.<br>
  <br>
  &bull; <b>Получить вещи</b><br>
  Вы можете получить вещи, которые были отправлены вам другими игроками.<br>
  Посылка хранится на почте 7 дней, но не более одного дня с момента как вы увидели ее в списке вещей для получения.
  По истечению этого срока, посылка отправляется обратно или удаляется.
  <br>
  <small><br>Администрация почты заявляет, что не несет ответственности за хранимый или пересылаемый товар/кредиты/сообщения и не гарантирует 100% его доставку. В случае форс-мажорных обстоятельств, товар/кредиты/сообщения могут быть утеряны.</small>
<?
  break;
  case 'items':
    if ($login_mail)
    {
      $mail_info = $adb->selectRow ("SELECT `guid`, 
                                            `login`, 
                                            `city` 
                                     FROM `characters` 
                                     WHERE `login` = ?s or `guid` = ?s", $login_mail ,$login_mail) or $char->error->Map (203, $login_mail);
      $login_mail = $mail_info['guid'];
      
      if ($login_mail == $guid)
        $char->error->Map (218);
?>
      К кому передавать: <?echo $char->info->character ('mail', $login_mail);?> &nbsp;<input type="button" value="Сменить" onclick="findlogin ('Почтовые услуги', 'main.php', 'login_mail', '', '', '<input type=hidden value=items name=do>', 0); return false;" class="nav"><br>
<?
      if ($city == $mail_info['city'])
        echo "Находится в этом городе";
      else
        echo "Находится в $mail_info[city]";
      echo "<br>";
      echo "Примерное время доставки: ".getFormatedTime (1800 + time ());
?>
<script type="text/javascript">
$(document).ready(function (){
  if (c = getCookie ('section'))
    section = c;
  else
    section = 1;
  showInventory (section, 'mail_to', '<?echo $login_mail;?>');
});
</script>
      <table border="0" width="100%" bgColor="#d4d2d2" cellpadding="3" cellspacing="0">
        <tr>
          <td width="25%" align="center" id="section_1"><a href="javascript:showInventory (1, 'mail_to', '<?echo $login_mail;?>');" class="nick"><b><?echo $lang['sec_item'];?></b></a></td>
          <td width="25%" align="center" id="section_2"><a href="javascript:showInventory (2, 'mail_to', '<?echo $login_mail;?>');" class="nick"><b><?echo $lang['sec_thing'];?></b></a></td>
          <td width="25%" align="center" id="section_3"><a href="javascript:showInventory (3, 'mail_to', '<?echo $login_mail;?>');" class="nick"><b><?echo $lang['sec_elix'];?></b></a></td>
          <td width="25%" align="center" id="section_4"><a href="javascript:showInventory (4, 'mail_to', '<?echo $login_mail;?>');" class="nick"><b><?echo $lang['sec_other'];?></b></a></td>
        </tr>
      </table>
      <div align="center" style="background: #a5a5a5;"><b><?echo $lang['back_pack'];?> (<?echo lowercase ($lang['mass'])." $mass/$maxmass";?>)</div>
      <div id="inventory"></div>
<?
  }
  else
    echo "<script>findlogin('Почтовые услуги', 'main.php', 'login_mail', '', '', '<input type=\"hidden\" value=\"items\" name=\"do\">', 1)</script>";
  break;
  case 'money':
    if ($login_mail)
    {
      $mail_info = $adb->selectRow ("SELECT `guid`, 
                                            `login`, 
                                            `city` 
                                     FROM `characters` 
                                     WHERE `login` = ?s or `guid` = ?d", $login_mail ,$login_mail) or $char->error->Map (203, $login_mail);
      $login_mail = $mail_info['guid'];
      
      if ($login_mail == $guid)
        $char->error->Map (218);
?>
      К кому передавать: <?echo $char->info->character ('mail', $login_mail);?> &nbsp;<input type="button" value="Сменить" onclick="findlogin ('Почтовые услуги', 'main.php', 'login_mail', '', '', '<input type=hidden value=money name=do>', 0); return false;" class="nav"><br>
<?
      if ($city == $mail_info['city'])
        echo "Находится в этом городе";
      else
        echo "Находится в $mail_info[city]";
?>    <br>
      <form action='?do=check&mail_to=<?echo $login_mail;?>' name='mail' method='post'>
      <fieldset><legend><b>Передать кредиты</b></legend>
        У вас на счету: <font color="#339900"><b><?echo $money;?></b></font> кр.<br>
        Передать кредиты, минимально 1 кр. Комиссия составит 5%<br>
        Укажите передаваемую сумму: <input type="text" name="send_sum" maxlength="8" size="6"><input type="submit" class="nav" value="Передать" name="send_money"><br>
      </fieldset>
      <fieldset><legend><b>Телеграф</b></legend>
        Услуга платная: <B>0.1 кр.</b><br>
        Сообщение: (максимально 100 символов)<br>
        <input type="text" name="telegraph" maxlength="100" size="65"><input type="submit" value="Отправить" name="is_telegraph" class="nav"><br>
      </fieldset>
      <fieldset><legend><b>Письмо</b></legend>
        Услуга платная: <b>1 кр.</b><br>
        Сообщение: (время доставки 30 мин.)<br>
        <textarea id="letter" name="letter" cols="65" rows="10" onkeyup="ch_l ();" onchange="ch_l ();"></textarea><br>(осталось <span id="count1">500</SPAN> симв.)<input type="submit" value="Отправить" name="is_letter" class="nav"><br>
      </fieldset>
      </form>
<script type="text/javascript">
function ch_l ()
{
  document.getElementById('count1').innerHTML = document.getElementById('letter').value.length > 500 ?0 :(500 - document.getElementById('letter').value.length);
}
ch_l();
</script>
<?
    }
    else
      echo "<script>findlogin('Почтовые услуги', 'main.php', 'login_mail', '', '', '<input type=\"hidden\" value=\"money\" name=\"do\">', 1)</script>";
  break;
  case 'report':
  break;
  case 'get_mail':
    $rows1 = $adb->select ("SELECT * 
                            FROM `city_mail_items` AS `m` 
                            LEFT JOIN `character_inventory` AS `c` 
                            ON `m`.`item_id` = `c`.`id` 
                            LEFT JOIN `item_template` AS `i` 
                            ON `c`.`item_template` = `i`.`entry` 
                            WHERE `m`.`to` = ?d 
                              and `m`.`delivery_time` < ?d 
                              and `c`.`mailed` = '1' 
                            ORDER BY `m`.`delivery_time`;", $guid ,time ());
    $rows2 = $adb->select ("SELECT * 
                            FROM `city_mail_items` AS `m` 
                            LEFT JOIN `item_template` AS `i` 
                            ON `m`.`item_id` = `i`.`entry` 
                            WHERE `m`.`to` = ?d 
                              and `m`.`delivery_time` < ?d 
                              and `m`.`item_id` = '1000' 
                            ORDER BY `m`.`delivery_time`;", $guid ,time ());
    if (count ($rows1) == 0 && count ($rows2) == 0 )
    {
      echo "<table width='100%' cellspacing='1' cellpadding='2' bgcolor='#A5A5A5'><tr><td bgcolor='#e2e0e0' align='center'>$lang[empty]</td></tr></table>";
      break;
    }
    
    $i = 1;
    foreach ($rows2 as $money_info)
    {
      echo $char->equip->showItemInventory ($money_info, 'money_in', $i);
      $i = !$i;
    }
    
    $i = 1;
    foreach ($rows1 as $item_info)
    {
      echo $char->equip->showItemInventory ($item_info, 'mail_in', $i);
      $i = !$i;
    }
  break;
}
?>
  </td>
  <td valign="top" width="200">
    <table cellpadding="0" cellspacing="0" width="100%" style="padding-left: 5px;">
      <tr>
        <td align="right">
          <?getUpdateBar ();?>
          <table width="148" border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
            <tr>
              <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
              <td bgcolor="#D3D3D3" nowrap><a href="main.php?action=go&room_go=centplosh" class="passage" alt="<?echo $char->city->getRoomOnline ('centplosh', 'mini');?>">Центральная Площадь</a></td>
            </tr>
            <tr>
              <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
              <td bgcolor="#D3D3D3" nowrap><a href="main.php?action=go&room_go=centplosh" class="passage" alt="<?echo $char->city->getRoomOnline ('Филиал Аукциона', 'mini');?>">Филиал Аукциона</a></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <nobr>
          <?echo "$lang[money] ".getMoney ($money);?> кр.<br>
          Передач: <?echo $char_db['transfers'];?><br><br>
<?
if ($do == 'items') echo "<b>Передать предметы</b><br>";
else
{
?>
          <a href="main.php?do=items<?echo ($login_mail) ?"&login_mail=$login_mail" :""?>" class="nick">Передать предметы</a><br>
<?
}
if ($do == 'money') echo "<b>Кредиты и Телеграф</b><br>";
else
{
?>
          <a href="main.php?do=money<?echo ($login_mail) ?"&login_mail=$login_mail" :""?>" class="nick">Кредиты и Телеграф</a><br>
<?
}
if ($mail_recieve > 0 && $do == 'get_mail') echo "<b>Получить вещи</b><br><br>";
else if ($mail_recieve > 0)                 echo "<a href='main.php?do=get_mail' class='nick'>Получить вещи</a><br><br>";
else
{
?>
          <font color="gray">Получить вещи</font><br>
          <br>
<?
}
if ($do == 'report') echo "<b>Отчеты</b><br>";
else
{
?>
          <a href="main.php?do=report" class="nick">Отчеты</a><br>
<?
}
?>
          </nobr>
        </td>
      </tr>
    </table>
  </td>
</tr></table>

<?
/* if($_POST['act']==send)
{
    $_POST[to] = htmlspecialchars($_POST[to]);
    $_POST[telegram] = htmlspecialchars($_POST[telegram]);
    $_POST[telegram] = str_replace("'",'"',$_POST[telegram]);

    $num = mysql_num_rows(mysql_query("select login from characters where login='$_POST[to]'"));

    if(!$_POST[to])echo"<span style='color:red'>укажите кому вы хотите достовить телеграмму...</span>";
    elseif(!$_POST[telegram])echo"<span style='color:red'>в телеграмме должно присутствовать хотя бы одно слово...</span>";
    elseif($num<1)echo"<span style='color:red'>персонажа «$_POST[to]» не существует, проверьте написание логина персонажа...</span>";
    else
    {
        $_POST[telegram] = explode(" ", $_POST[telegram]);
        $count = count($_POST[telegram]);
        $cost = $count*0.00;
        $_POST[telegram] = implode(" ", $_POST[telegram]);
        if($row[money]<$cost)echo"<span style='color:red'>у вас нехватает ".($cost-$row[money])." золота, что бы отправить телеграмму...</span>";
        else
        {
            $result1 = mysql_query("update characters set money=money-$cost where login='$login'");
            if($result1)
            {
                $array = file("telegraf/telegraf.dat");
                $time = Date("d.m.Y H:i");
                $file = fopen("telegraf/telegraf.dat", "a+");
                flock($file,2);
                fwrite($file,"$time|$login|$_POST[to]|$_POST[telegram]|
                ");
                flock($file,3);
                fclose($file);
                echo"<u>вы успешно отправили телеграмму оплатив $cost золота.</u>";
            }
        }
    }
}
$file = file("telegraf/telegraf.dat");
$num = count($file);
for ($i = 0; $i <= $num; $i++)
{
    $row = explode("|",$file[$i]);
    if ($row[1]==$$login)
    {
        echo "$row[0] для «$row[2]»<br>";
        $found = 1;
    }
}
if ($found != 1)
    echo"<i>Все телеграммы доставлины...</i>"; */
?>