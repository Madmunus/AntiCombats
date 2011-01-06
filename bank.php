<?
defined('AntiBK') or die ("Доступ запрещен!");

$id = requestVar ('id', 0);
$id2 = requestVar ('id2', 0);
?>
<script src="scripts/move_check.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function (){
  $('input[name=add_kredit]').live('click', function (){
    if (isNaN(parseFloat($('input[name=add_sum]').val())))
    {
      alert('Укажите сумму');
      return false;
    }
    else
      return confirm ('Вы хотите положить на свой счет '+parseFloat($('input[name=add_sum]').val())+' кр. ?');
  });
  $('input[name=get_kredit]').live('click', function (){
    if (isNaN(parseFloat($('input[name=get_sum]').val())))
    {
      alert('Укажите сумму');
      return false;
    }
    else
      return confirm ('Вы хотите снять со своего счета '+parseFloat($('input[name=get_sum]').val())+' кр. ?');
  });
  $('input[name=transfer_kredit]').live('click', function (){
    if (isNaN(parseFloat($('input[name=transfer_sum]').val())) || isNaN(parseInt($('input[name=id2]').val())))
    {
      alert('Укажите сумму и номер счета');
      return false;
    }
    else
      return confirm ('Вы хотите перевести со своего счета '+parseFloat($('input[name=transfer_sum]').val())+' кр. на счет номер #'+parseInt($('input[name=id2]').val())+' ?');
  });
  $('input[name=convert_ekredit]').live('click', function (){
    if (isNaN(parseFloat($('input[name=convert_sum]').val())))
    {
      alert('Укажите обмениваемую сумму');
      return false;
    }
    else
      return confirm ('Вы хотите обменять '+parseFloat($('input[name=convert_sum]').val())+' екр. на кредиты ?');
  });
  $('input[name=close]').live('click', function (){
    if (confirm('Если вы закроете счет, то для открытия нового счета вам придется снова заплатить 3.00 кр.\nЗакрыть счет?'))
      location.href = '?do=delete';
  });
});
</script>
<?
switch ($do)
{
  case 'create':
    $pass1 = requestVar ('pass1');
    $pass2 = requestVar ('pass2');
    if ($money < 3)
      $char->error->Map (323, 3);
    
    if ($pass1 == '')
      $char->error->Map (301);
    
    if ($pass2 == '')
      $char->error->Map (324);
    
    if ($pass1 != $pass2)
      $char->error->Map (300);
    
    $adb->query ("INSERT INTO `character_bank` (`id`, `guid`, `password`) 
                  VALUES (?d, ?d, ?s);", $id ,$guid ,SHA1 ($id.':'.$pass1));
    $char->history->bank ($id, '', '', '', 1);
    
    if (!($char->Money (3)))
      $char->error->Map (107);
    
    $char->error->Map (318, $id);
  break;
  case 'login':
    $char->error->Map ($char->bank->Login ($id, $pass));
  break;
  case 'check':
    if (empty($_SESSION['bankСredit']))
      $char->error->Map (0);
    
    $credit = $adb->selectRow ("SELECT `id`, 
                                       `cash`, 
                                       `euro` 
                                FROM `character_bank` 
                                WHERE `id` = ?d 
                                  and `guid` = ?d", $_SESSION['bankСredit'] ,$guid) or $char->error->Map (322);
    list ($id, $cash, $euro) = array_values($credit);
    if (isset($_POST['add_kredit']))
    {
      $add_sum = requestVar ('add_sum', 0, 11);
      
      if (!($char->Money ($add_sum)))
        $char->error->Map (107);
      
      $char->bank->bMoney (-$add_sum, $id);
      $char->history->bank ($id, '', $add_sum, '', 2);
      $char->error->Map (319, "$add_sum|$id");
    }
    else if (isset($_POST['get_kredit']))
    {
      $get_sum = requestVar ('get_sum', 0, 11);
      $char->bank->bMoney ($get_sum, $id);
      $char->Money (-$get_sum);
      $char->history->bank ($id, '', $get_sum, '', 3);
      $char->error->Map (320, "$get_sum|$id");
    }
    else if (isset($_POST['transfer_kredit']))
    {
      $trf_sum = requestVar ('transfer_sum', 0, 11);
      if ($level < 8)
        $char->error->Map (306);
      
      if ($id == $id2)
        $char->error->Map (307);
      
      if ($trf_sum < 1)
        $char->error->Map (309);
      
      $credit2_guid = $adb->selectCell ("SELECT `guid` FROM `character_bank` WHERE `id` = ?d", $id2) or $char->error->Map (303);
      $char->bank->bMoney ($trf_sum, $id);
      $trfed_sum = round ($trf_sum * 0.97, 2);
      $char->bank->bMoney (-$trfed_sum, $id2, '', $credit2_guid);
      $char->history->bank ($id, $id2, $trfed_sum, '', 4);
      $char->history->bank ($id2, $id, $trfed_sum, '', 5);
      $to_owner = $char->info->character ('name', $credit2_guid);
      $char->error->Map (321, "$trfed_sum|$to_owner|$id2|$id");
    }
    else if (isset($_POST['convert_ekredit']))
    {
      $convert_sum = requestVar ('convert_sum', 0, 11);
      if ($convert_sum == 0 || !is_numeric($convert_sum))
        $char->error->Map (327);
      
      if ($euro < $convert_sum)
        $char->error->Map (310, $convert_sum);
      
      $converted_sum = $convert_sum * 30;
      $char->bank->bMoney ($convert_sum, $id, 'euro');
      $char->bank->bMoney (-$converted_sum, $id);
      $char->history->bank ($id, '', $converted_sum, $convert_sum, 6);
      $char->error->Map (308, "$convert_sum|$id|$converted_sum");
    }
    else if (isset($_POST['change_psw']))
    {
      $new_psw = requestVar ('new_psw');
      $new_psw2 = requestVar ('new_psw2');
      if ($new_psw == "")
        $char->error->Map (315);
      
      if ($new_psw2 == "")
        $char->error->Map (316);
      
      if ($new_psw != $new_psw2)
        $char->error->Map (317);
      
      $to_credit = $adb->query ("UPDATE `character_bank` SET `password` = ?s WHERE `id` = ?d", SHA1 ($id.':'.$new_psw) ,$id) or $char->error->Map (312);
      $char->error->Map (311);
    }
    else if (isset($_POST['save_notepad']))
    {
      $notepad = requestVar ('notepad');
      $notepad = str_replace ("\n", "<br>", $notepad);
      $to_credit = $adb->query ("UPDATE `character_info` SET `bank_note` = ?s WHERE `guid` = ?d", $notepad ,$guid) or $char->error->Map (314);
      $char->error->Map (313);
    }
    $char->error->Map (0);
  break;
  case 'logout':
    $char->bank->unLogin ();
    $char->error->Map (0);
  break;
  case 'delete':
    $del1 = $adb->query ("DELETE FROM `character_bank` WHERE `id` = ?d", $_SESSION['bankСredit']);
    $del2 = $adb->query ("DELETE FROM `history_bank` WHERE `credit` = ?d", $_SESSION['bankСredit']);
    unset ($_SESSION['bankСredit']);
    $char->error->Map (0);
  break;
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="1">
<tr>
  <td valign='top' nowrap width="100%"><h3>Банк</h3></td>
  <td align="right" valign='top' nowrap>
    <?getUpdateBar ();?>
    <table width="148" border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
      <tr>
        <td bgcolor="#D3D3D3"><img src="img/links.gif" width="9" height="7" /></td>
        <td bgcolor="#D3D3D3" nowrap><a href="main.php?action=go&room_go=fairstreet" class="passage" alt="<?echo $char->city->getRoomOnline ('fairstreet', 'mini');?>">Страшилкина улица</a></td>
      </tr>
    </table>
  </td>
</tr>
</table>
<font color='red' id='error'><?$char->error->getFormattedError ($warning, $parameters);?></font>
<?
if (empty($_SESSION['bankСredit']))
{
  $deist = requestVar ('deist');
  if ($deist != "new")
  {
    $rows = $adb->selectCol ("SELECT `id` FROM `character_bank` WHERE `guid` = ?d", $guid);
?>
<br>
Мы предоставляем следующие услуги:
<ol>
<li>Открытие счета
<li>Возможность положить/снять кредиты/еврокредиты со счета
<li>Перевести кредиты/еврокредиты с одного счета на другой
<li>Обменный пункт. Обмен еврокредитов на кредиты
</ol>
Хотите открыть свой счет? Услуга платная: 3.00 кр.  <input class='nav' type="button" value="Открыть счёт" id='link' link='none&deist=new' />
<?
    if ($rows)
    {
?>
<form action="?do=login" name="F2" method="post">
<table>
<td>
<fieldset><legend><b>Управление счетом</b></legend>
<table>
  <tr>
    <td>Номер счета</td>
    <td colspan="2">
      <select name="id" size="0" style="width: 90px;">
<?
        foreach ($rows as $num => $id)
          echo "<option value='$id'>$id</option>";
?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Пароль</td>
    <td><input style='width: 90px;' type="password" name="pass"></td>
  </tr>
  <tr><td colspan="3" align="center"><input class="nav" type="submit" value="Войти" name="enter"></td></tr>
</table>
</fieldset>
</td>
</table>
</form>
<?
    }
  }
  else
  {
    if ($money < 3)
      $char->error->Map (323, 3);
    
    $maxid = ($adb->selectCell ("SELECT MAX(`id`) FROM `character_bank`;")) + 1;
?>
<h4>Открытие счета</h4>
Запишите номер вашего счета: <b><?echo $maxid;?></b><br>
Номер счета и пароль строго привязаны только к вашему персонажу. Только персонаж <b><?echo $login;?></b> может использовать этот счет, никто другой, даже зная ваш номер и пароль, не получит доступа к нему!<br>
<form action='?do=create' name='newcredit' method="post"><br>
<input type="hidden" name="id" value="<?echo $maxid;?>">
<table>
  <tr><td>Придумайте пароль к счету<br><input type='password' name='pass1' size="20"></td></tr>
  <tr><td>Введите пароль повторно<br><input type='password' name='pass2' size="20"></td></tr>
  <tr><td>Вы заплатите: <b>3.00</b> кр.</td></tr>
  <tr><td><input type='submit' value='Открыть счет' class='nav'></td></tr>
</table>
</form>
<?
  }
}
else
{
  $bank_info = $adb->selectRow ("SELECT `id`, 
                                        `cash`, 
                                        `euro` 
                                 FROM `character_bank` 
                                 WHERE `id` = ?d", $_SESSION['bankСredit']);
  list ($id, $cash, $euro) = array_values ($bank_info);
  $note = $adb->selectCell ("SELECT `bank_note` FROM `character_info` WHERE `guid` = ?d", $guid);
  $note = str_replace (array("<br>", '\&quot;', "\'"), array("\n", '"', "'"), $note);
  $m_dis = ($money == 0) ?" disabled" :"";
  $g_dis = ($cash == 0) ?" disabled" :"";
  $e_dis = ($euro == 0) ?" disabled" :"";
?>
<table width="100%">
<tr>
  <td valign="top" width="30%"><h4>Управление счетом</h4> &nbsp;<b>Счёт №:</b> <?echo $id;?> <a href="?do=logout" title="Окончить работу c текущим счетом" class="nick">[x]</a></td>
  <td valign="top" align="center" width="17%">
    <fieldset>
    <legend><b>У вас на счету</b></legend>
    <table>
      <tr><td>Кредитов:</td><td><b><?echo $cash;?> кр.</b></td></tr>
      <tr><td>Еврокредитов:</td><td><b><?echo $euro;?> екр.</b></td></tr>
      <tr><td colspan="2"><hr></td></tr>
      <tr><td>При себе наличных:</td><td><b><?echo getMoney ($money);?> кр.</b></td></tr>
    </table>
    </fieldset>
  </td>
  <td valign="top" align="right" width="30%"><Font color="red">Внимание!</font> Некоторые услуги банка платные, о размере взымаемой комиссии написано в соответствующем разделе.</td>
</tr>
</table>
<form action='?do=check' name='credit' method='post'>
<table cellspacing="5" width="100%">
<tr>
  <td valign="top" width="53%">
    <fieldset>
      <legend><b>Пополнить счет</b></legend>
      Сумма <input type="text" name="add_sum" size="6" maxlength="10"<?echo $m_dis;?>> кр. <input type="submit" class="nav" name="add_kredit" value="Положить кредиты на счет"<?echo $m_dis;?>><br>
    </fieldset>
  </td>
  <td valign="top" width="47%">
    <fieldset>
      <legend><b>Снять со счета</b></legend>
      Сумма <input type="text" name="get_sum" size="6" maxlength="10"<?echo $g_dis;?>> кр. <input type="submit" class="nav" name="get_kredit" value="Снять кредиты со счета"<?echo $g_dis;?>><br>
    </fieldset>
  </td>
</tr>
<tr>
  <td valign="top">
    <fieldset>
      <legend><b>Перевести кредиты на другой счет</b></legend>
      Сумма <input type="text" name="transfer_sum" size="6" maxlength="10"<?echo $g_dis;?>> кр.<br>
      Номер счета куда перевести кредиты <input type="text" name="id2" size="12" maxlength="15"<?echo $g_dis;?>><br>
      <input type="submit" class="nav" name="transfer_kredit" value="Перевести кредиты на другой счет"<?echo $g_dis;?>><br>
      Комиссия составляет <b>3.00 %</b> от суммы, но не менее <b>1.00 кр</b>.
    </fieldset>
  </td>
  <td valign="top">
    <fieldset>
      <legend><b>Курс еврокредита к мировой валюте</b></legend>
      Данные на <?echo DATE_NO_SEC;?><br>
      1 екр. = <b>1.2552</b> долларов США<br>
      1 екр. = <b>1.0000</b> ЕВРО<br>
      1 екр. = <b>9.9431</b> укр. гривен<br>
      1 екр. = <b>0.8616</b> англ. фунтов стерлингов<br>
      1 екр. = <b>37.7282</b> российских рублей<br>
    </fieldset>
  </td>
</tr>
<tr>
  <td valign="top">
    <fieldset>
      <legend><b>Обменный пункт</b></legend>
      Обменять еврокредиты на кредиты.<br>
      Курс <b>1 екр.</b> = <b>30.00 кр.</b><br>
      Сумма <input type="text" name="convert_sum" size="6" maxlength="10"<?echo $e_dis;?>> екр.
      <input type="submit" class="nav" name="convert_ekredit" value="Обменять"<?echo $e_dis;?>>
    </fieldset>
  </td>
  <td></td>
</tr>
<tr>
  <td valign="top">
    <fieldset>
      <legend><b>Настройки</b></legend>
      <b>Сменить пароль</b><br>
      <table>
        <tr>
          <td>Новый пароль</td>
          <td><input type="password" name="new_psw"></td>
        </tr>
        <tr>
          <td>Введите новый пароль повторно</td>
          <td><input type="password" name="new_psw2"></td>
        </tr>
      </table>
      <input type="submit" class="nav" name="change_psw" value="Сменить пароль"><br>
<?if ($cash == 0){?>
      <hr>
      Т.к. ваш счет с нулевым балансом, вы можете его в любой момент закрыть <input class="nav" type="button" name="close" value="Закрыть счет"><br>
<?}?>
    </fieldset>
  </td>
  <td valign="top">
    <fieldset>
      <legend><b>Последние операции</b></legend>
        <table cellpadding="2" cellspacing="0" border="0">
<?        $rows = $adb->select ("SELECT `credit2`, 
                                        `cash`, 
                                        `euro`, 
                                        `operation`, 
                                        `date` 
                                 FROM `history_bank` 
                                 WHERE `credit` = ?d 
                                 ORDER BY `id` DESC 
                                 LIMIT 0, 10;", $_SESSION['bankСredit']);
          foreach ($rows as $hist)
          {
            vprintf ("<tr><td><font class='date'>".date ('d.m.y H:i', $hist['date'])."</font> ".$lang['bank_'.$hist['operation']]."</td></tr>", $hist);
          }
?>
        </table>
    </fieldset>
  </td>
</tr>
<tr>
  <td colspan="2" valign="top">
    <fieldset>
      <legend><b>Записная книжка</b></legend>
      Здесь вы можете записывать любую информацию для себя. Номера счетов друзей, кто кому чего должен и прочее. Записная книжка общая для всех счетов.<br>
      <textarea name="notepad" rows="10" cols="67" style="width: 100%;"><?echo $note;?></textarea><br>
      <input type="submit" class="nav" name="save_notepad" value="Сохранить изменения">
    </fieldset>
  </td>
</tr>
</table>
</form>
<?
}
?>