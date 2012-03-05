<?
defined('AntiBK') or die("Доступ запрещен!");

$do = requestVar('do');
$boy = requestVar('boy');
$battle_type = requestVar('battle_type');
$timeout = requestVar('timeout');
$log = requestVar('log');
$ac = requestVar('ac');
$accept = requestVar('accept');
$accept2 = requestVar('accept2');
$otkaz = requestVar('otkaz');
$id = requestVar('id');
$denie = requestVar('denie');

/*
$dat = $adb->select("SELECT * FROM `zayavka`;");
$countrows = count ($dat);

for ($i = 0; $i < $countrows; $i++)
{
  $cr = $dat[$i]['creator'];
  $player = $adb->selectCell("SELECT `login` FROM `characters` WHERE `id` = '$cr';");
  $search = $adb->selectCell("SELECT `login` FROM `online` WHERE `login` = '$player';");
  $online = ($search) ?1 :0;
  if ($online == 0)
  {
    $del = $adb->query("DELETE FROM `zayavka` WHERE `creator` = '$cr';");
    $del1 = $adb->query("DELETE FROM `team1` WHERE `battle_id` = '$cr';");
    $del2 = $adb->query("DELETE FROM `team2` WHERE `battle_id` = '$cr';");
  }
  if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 1)
    $zayavka_status = "awaiting";
  if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 2 && $t == 1)
    $zayavka_status = "confirm_mine";
  if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 2 && $t == 2)
    $zayavka_status = "confirm_opp";
  if ($m == $dat[$i]['creator'] && $dat[$i]['status'] == 3)
    goBattle($login);
}
if (empty($zayavka_status))
  $zayavka_status = "no";*/
$fights = $char->city->getRoom($room, $city, 'fights');
$hps = array('fiz', 'dgv', 'group', 'haos');
?>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-top: 10px;">
  <tr>
    <td align="left" valign="middle" width="50%" style="padding-bottom: 2px;">
<?
    if (in_array($boy, $hps))
    {
      echo $char->info->character('clan');
      echo "<span id='HP'></span>";
      echo "<img src='img/icon/heart_03.gif' width='10' height='10' alt='Уровень жизни' style='padding-left: 1px; vertical-align: middle;'>";
      echoScript("showHpmini($char_stats[hp], $char_stats[hp_all], $char_stats[hp_regen]);");
    }
?>
    </td>
    <td align="right" valign="middle">
      <input type="button" class="help" value="<?echo $lang['hint'];?>" id="hint" link="combats">
      <input type="button" class="nav" value="<?echo $lang['return'];?>" id="link" link="none">
    </td>
  </tr>
</table>
<table align="center" cellSpacing="1" cellPadding="1" width="100%">
  <tr>
    <td class="m" width="40">&nbsp;<b>Бои:</b></td>
    <td class="<?echo ($boy == 'fiz') ?"s" :"m"?>"><a href="?action=zayavka&boy=fiz" class="nick">1 на 1</a></td>
    <td class="m"><a href="?action=zayavka&boy=dgv" class="nick">Учебные</a></td>
    <td class="<?echo ($boy == 'group') ?"s" :"m"?>"><a href="?action=zayavka&boy=group" class="nick">Групповые</a></td>
    <td class="<?echo ($boy == 'haos') ?"s" :"m"?>"><a href="?action=zayavka&boy=haos" class="nick">Хаотичные</a></td>
    <td class="<?echo ($boy == 'tklogs') ?"s" :"m"?>"><a href="?action=zayavka&boy=tklogs" class="nick">Текущие</a></td>
    <td class="<?echo ($boy == 'logs') ?"s" :"m"?>"><a href="?action=zayavka&boy=logs" class="nick">Завершенные</a></td>
  </tr>
</table>
<?
switch ($boy)
{
  case 'fiz':
    if (!$fights)
      die("<br><br><center><b>В этой комнате невозможно подавать заявки</b></center>");
    
    echo "После подачи заявки, вам будет подобран случайный противник вашего уровня<br>";
    echo "<input type='submit' value='Подать заявку'>";
  break;
  case 'dgv':
    die("<br><br><center><b>Выберите раздел...</b></center>");
  break;
  case 'group':
    if ($level < 2)
      die("<br><br><center><b>В групповые бои только со второго уровня.</b></center>");
    else if (!$fights)
      die("<br><br><center><b>В этой комнате невозможно подавать заявки</b></center>");
  break;
  case 'haos':
    if ($level < 2)
      die("<br><br><center><b>В хаотичные бои только со второго уровня.</b></center>");
    else if (!$fights)
      die("<br><br><center><b>В этой комнате невозможно подавать заявки</b></center>");
  break;
  case 'tklogs':
  break;
  case 'logs':
  break;
  default:
    die("<br><br><center><b>Выберите раздел</b></center>");
  break;
}
die();
/*=====status disc=========*/
/*1 - ожидает вызова       */
/*2 - ожидает подтверждения*/
/*3 - принята              */
/*=========================*/
switch ($act)
{
/*подать заявку*/
    case 'podat':
        if ($db['hp_all'] / 3 > $db['hp'])
        {
            echo "Вы слишком ослаблены для поединка! Восстановитесь!<br>";
            echo "<a href=\"history.back(-1);\" class='us2'>назад</a>";
            die ();
        }
        $st1 = $adb->selectCell("SELECT `player` FROM `team1` WHERE `player` = '$login';");
        $st2 = $adb->selectCell("SELECT `player` FROM `team2` WHERE `player` = '$login';");
        if ($st1 || $st2)
        {
            echo "Вы не можете принять эту заявку! Сначала отзовите свою!<br>";
            echo "<a href='zayavka.php?boy=phisic' class='us2'>Назад</a>";
            die ();
        }
        if (empty($ip))
            $ip = ($_SERVER['HTTP_X_FORWARDED_FOR']) ?$_SERVER['HTTP_X_FORWARDED_FOR'] :$_SERVER['REMOTE_ADDR'] ;

        $date = date ("d.m.y H:i");
        $time = date("H:i");
        $mine_id = $db['id'];
        $query = $adb->query("    INSERT INTO `zayavka` (status,type,date,timeout,creator) 
                                    VALUES ('1', '$battle_type', '$time', '$timeout', '$mine_id');");
        $query = $adb->query("    INSERT INTO `team1` (player,ip,battle_id,hitted,over) 
                                    VALUES ('$login', '$ip', '$mine_id', '0', '0')");
        $query = $adb->query("    UPDATE `characters` 
                                    SET `zayavka` = '1' 
                                    WHERE `login` = '$login';
                                ");
        $zayavka_c_m = 0;
        session_register ('zayavka_c_m');
        echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
    break;
/*принять вызов*/
    case 'a':
        if($db['hp_all'] / 3 > $db['hp'])
        {
            echo "Вы слишком ослаблены для поединка! Восстановитесь!<br>";
            echo "<a href=\"history.back(-1);\" class='us2'>Назад</a>";
            die();
        }
        $st1 = $adb->selectCell("SELECT `player` FROM `team1` WHERE `player` = '$login';");
        $st2 = $adb->selectCell("SELECT `player` FROM `team2` WHERE `player` = '$login';");
        if ($st1 || $st2)
        {
            echo "Вы не можете принять этот вызов! Сначала отзовите свою!<br>";
            echo "<a href='zayavka.php?boy=phisic' class='us2'>Вернуться</a>";
            die ();
        }
        $q = $adb->selectCell("SELECT `creator` FROM `zayavka` WHERE `creator` = '$id';");
        if(empty($ip))
            $ip = ($_SERVER['HTTP_X_FORWARDED_FOR']) ?$_SERVER['HTTP_X_FORWARDED_FOR'] :$_SERVER['REMOTE_ADDR'] ;
        if($q)
        {
            $zayavka_c_o = 0;
            session_register ('zayavka_c_o');
            $d2 = $adb->selectCell("SELECT `player` FROM `team2` WHERE `battle_id` = '$id';");
            $d = $adb->selectCell("SELECT `player` FROM `team1` WHERE `battle_id` = '$id';");
            if ($d2 == '' || empty($d2))
            {
                $q = $adb->query("    INSERT INTO `team2` (player,ip,battle_id,hitted,over) 
                                        VALUES ('$login', '$ip', '$id', '0', '0');");
                $s = $adb->query("    UPDATE `zayavka` 
                                        SET `status` = '2' 
                                        WHERE `creator` = '$id';
                                    ");
                if ($q)
                {
                    $s11 = $adb->query("    UPDATE `characters` 
                                            SET `zayavka` = '1' 
                                            WHERE `login` = '$d';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
    break;
/*отозвать заявку*/
    case 'recall':
        $s = $adb->selectCell("SELECT `battle_id` FROM `team1` WHERE `player` = '$login';");
        if ($s)
        {
            $dd = $adb->selectCell("SELECT `status` FROM `zayavka` WHERE `creator` = '$cr';");
            if ($dd != 2)
            {
                $query = $adb->query("DELETE FROM `zayavka` WHERE `creator` = '$s';");
                $s2 = $adb->query("DELETE FROM `team1` WHERE `battle_id` = '$s';");
                if ($query)
                {
                    $s11 = $adb->query("    UPDATE `characters` 
                                            SET `zayavka` = '0' 
                                            WHERE `login` = '$login';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
    break;
/*отозвать свою заявку*/
    case 'recallbattle':
        $q = $adb->selectCell("SELECT `battle_id` FROM `team2` WHERE `player` = '$login';");
        if ($q)
        {
            $cr = $q;
            $dd = $adb->selectCell("SELECT `status` FROM `zayavka` WHERE `creator` = '$cr';");
            if ($dd != 3)
            {
                $query = $adb->query("    UPDATE `zayavka` 
                                            SET `status` = '1' 
                                            WHERE `creator` = '$cr';
                                        ");
                $ssd = $adb->query("DELETE FROM `team2` WHERE `battle_id` = '$cr';");
                if ($query)
                {
                    $p = $adb->selectCell("SELECT `player` FROM `team1` WHERE `battle_id` = '$cr';");
                    $s11 = $adb->query("    UPDATE `characters` 
                                            SET `zayavka` = '0' 
                                            WHERE `login` = '$p';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
    break;
/*подтвердить заявку*/
    case 'confirm':
        if ($denie)
        {
            $s = $adb->selectCell("SELECT `battle_id` FROM `team1` WHERE `player` = '$login';");
            if ($S)
            {
                $query = $adb->query("    UPDATE `zayavka` 
                                            SET `status` = '1' 
                                            WHERE `creator` = '$s';
                                        ");
                $op = $adb->selectCell("SELECT `player` FROM `team2` WHERE `battle_id` = '$s';");
                $s2 = $adb->query("DELETE FROM `team2` WHERE `battle_id` = '$s';");
                if ($query)
                {
                    $_SESSION['zayavka_c_m'] = 0;
                    $s11 = $adb->query("    UPDATE `characters` 
                                            SET `zayavka` = '0' 
                                            WHERE `login` = '$op';
                                            ");
                    echo "<script>location.href = 'zayavka.php?boy=phisic';</script>";
                }
            }
        }
        if ($accept)
        {
            $data = $adb->selectRow("SELECT * FROM `team1` WHERE `player` = '$login';");
            if ($data)
            {
                $tt = $data['type'];
                $cr = $data['battle_id'];
                $zz = $adb->selectCell("SELECT `player` FROM `team2` WHERE `battle_id` = '$cr';");
                if ($zz)
                {
                    $q = $adb->query("    INSERT INTO `battles` (type,status,creator_id) 
                                            VALUES('$tt', 'during', '$cr');");
                    if ($q)
                    {
                        $op = $adb->selectCell("SELECT `player` FROM `team2` WHERE `battle_id` = '$cr';");
                        $sql_rm = $adb->query("    UPDATE `zayavka` 
                                                    SET `status` = '3' 
                                                    WHERE `creator` = '$cr';
                                                    ");
                        $s1 = $adb->query("    UPDATE `characters` 
                                                SET `zayavka` = '2' 
                                                WHERE `login` = '$login';
                                                ");
                        $s11 = $adb->query("    UPDATE `characters` 
                                                SET `zayavka` = '2' 
                                                WHERE `login` = '$op';
                                                ");
                        goBattle($login);
                    }
                }
            }
        }
    break;
}
if ($zayavka_status == "no")
{
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" align="left" valign="top">
      <form name="boy" action="zayavka.php?boy=phisic&act=podat" method="post">
      <table cellSpacing="0" cellPadding=0>
        <tbody>
        <tr>
          <td>
            <form name="boy" action="zayavka.php?boy=phisic&act=podat" method="post">
            <fieldset>
              <legend><b>Подать заявку на бой</b></legend>
              Таймаут 
              <select name="timeout">
                <option value="3">3 мин.
                <option value="4">4 мин.
                <option value="5">5 мин.
                <option value="7">7 мин.
                <option value="10" selected>10 мин.
              </select> 
              Тип боя 
              <select name="battle_type">
                <option value="1" selected>с оружием
                <option value="2">кулачный
              </select> 
              <input type="submit" value="Подать заявку">&nbsp; 
            </fieldset>
            </form>
          </td>
        </tr>
        </tbody>
      </table>
    </td>
    <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
  </tr>
</table>
<?
}
else if ($zayavka_status == "awaiting")
{
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" align="left" valign="top">
      <form name="otziv" action="zayavka.php?boy=phisic&act=recall" method="post">
        Вы уже подали заявку на бой.
        <input type="hidden" name="otziv" value="1">
        <input type="submit" value="Отозвать заявку">
      </form>
    </td>
    <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
  </tr>
</table>
<?
}
else if ($zayavka_status == "confirm_mine")
{
  $op_level = $adb->selectCell("SELECT `level` FROM `characters` WHERE `login` = '$opponent';");
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" align="left" valign="top">
      <table border="0" width="100%">
        <tr>
          <td>
            <form name="accept" action="zayavka.php?boy=phisic&act=confirm" method="post">
              <font color="red"><b>Персонаж </b></font><?echo "<b>$opponent</b> [$op_level]<a href='info.php?log=$pl1' target='_blank'><img src='img/inf.gif' border='0' title='Информация о персонаже $opponent'></a>";?><font color="red"><b> принял ваш вызов!</b></font>
              <input type="hidden" name="ac" value="1">
              <input type="submit" name="accept" value="Битва!">
              <input type="hidden" name="ac" value="2">
              <input type="submit" name="denie" value="Отказать">
            </form>
          </td>
        </tr>
      </table>
    </td>
    <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
  </tr>
</table>
<?
}
else if ($zayavka_status == "confirm_opp")
{
  $op_level = $adb->selectCell("SELECT `level` FROM `characters` WHERE `login` = '$opponent';");
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" align="left" valign="top">
      <table border="0" width="100%">
        <tr>
          <td>
            <form name="accept2" action="zayavka.php?boy=phisic&act=recallbattle" method="post">
              <font color="red"><b>Ожидается подтверждение боя от персонажа</b></font> <?echo "<b>$opponent</b> [$op_level]<a href='info.php?log=$pl1' target='_blank'><img src='img/inf.gif' border='0' title='Информация о персонаже $opponent'></a>";?>
              <input type="hidden" name="otkaz" value="1">
              <input type="submit" value="Отозвать вызов">
            </form>
          </td>
        </tr>
      </table>
    </td>
    <td align="right" valign="top"><input type="button" value="Обновить" onclick="location.href = 'zayavka.php?boy=phisic';"></td>
  </tr>
</table>
<?
}
echo "<form name='prinatie' action='zayavka.php?boy=phisic&act=a' method='POST'><br>";
$data_p = $adb->select("SELECT * FROM `zayavka` WHERE `type` = '1' or `type` = '2' ORDER BY `date` DESC;");
$countrows = count ($data_p);
if ($countrows != 0)
  echo "<input type='submit' value='Принять вызов'><br>";
for ($i = 0; $i < $countrows; $i++)
{
  if ($data_p[$i]['status'] != 3)
  {
    $creator = $data_p[$i]['creator'];
    $date = $data_p[$i]['date'];
    $timeout = $data_p[$i]['timeout'];
    $battle_type = $data_p[$i]['type'];
    $id = $data_p[$i]['creator'];

    $t1 = $adb->select("SELECT `player` FROM `team1` WHERE `battle_id` = '$creator';");
    for ($h = 0; $h < $countrows; $h++)
    {
      $p1 = $t1[$h]['player'];
      $p1_lev = $adb->selectCell("SELECT `level` FROM `characters` WHERE `login` = '$p1';");
      $pl1 = str_replace (" ", "%20", $p1);
    }

    $t2 = $adb->select("SELECT `player` FROM `team2` WHERE `battle_id` = '$creator';");
    for ($h = 0; $h < $countrows; $h++)
    {
      $p2 = $td2['player'];
      $p2_lev = $adb->selectCell("SELECT `level` FROM `characters` WHERE `login` = '$p2';");
      $pl12 = str_replace (" ", "%20", $p2);
    }

    if ($p2 == '')
      $rad = "<input type='radio' name='id' value='$id'>";
    else
    {
      $rad = "<input type='radio' name='id' value='$id' disabled>";
      $p2 = "против <font color='black'><b>$p2</b> [$p2_lev]<a href='info.php?log=$pl12' target='_blank'><img src='img/inf.gif' border='0'></a>";
    }
    switch ($battle_type)
    {
      case 1: $battle_type = "<img src='img/icon/fighttype1.gif' width='20' height='20' title='Физический бой'>";
      break;
      case 2: $battle_type = "<img src='img/icon/fighttype5.gif' width='20' height='20' title='Кулачный бой'>";
      break;
    }
    if ($p1 == $db['login'])
      $rad = "<input type='radio' name='id' value='$id' disabled>";
    $p1 = "<font color='black'><b>$p1</b> [$p1_lev]</font><a href='info.php?log=$pl1' target='_black'><img src='img/inf.gif' border='0'></a>";
    echo "$rad <span class='date'>$date</span> $p1 $p2 ";
    echo "тип боя: $battle_type ";
    echo "(таймаут $timeout мин.)";
    echo "<br>";
  }
}
if ($countrows > 1)
  echo "<input type='submit' value='Принять вызов'><br>";
echo "</form>";
?>