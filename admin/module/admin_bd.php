<?
defined('AntiBK') or die ("Доступ запрещен!");

$table = (isset($_POST['table'])) ?$_POST['table'] :"";
$showfrom = (isset($_POST['showfrom'])) ?htmlspecialchars ($_POST['showfrom']) :0;
$showto = (isset($_POST['showto'])) ?htmlspecialchars ($_POST['showto']) :150;
$sqlquery = (isset($_POST['sqlquery']) && $_POST['sqlquery'] != "") ?htmlspecialchars ($_POST['sqlquery']) :"SELECT * FROM `$table` LIMIT $showfrom, $showto;";
$str_db = split ("/", $database['adb']);
$database = $str_db[3];

$history = Array();
for ($i = 0; $i < 10; $i++)
{
    if (isset($HTTP_COOKIE_VARS["history_COOKIE$i"]))
        $history[] = $HTTP_COOKIE_VARS["history_COOKIE$i"];
}
for ($i = 0; $i < sizeof ($history); $i++)
    $history[$i] = stripslashes ($history[$i]);

if ($action == "submit")
{
    array_unshift ($history, stripslashes($sqlquery));
    array_splice ($history, 10);
    $worktime = getmicrotime ();
    $qwresult = @mysql_query(stripslashes($sqlquery));
    $worktime = getmicrotime () - $worktime;

    if (mysql_errno())
    {
        $status = "
        <table border=0 cellspacing=0 cellpadding=0 width=100%><tr bgcolor=\"#CCCCCC\"><td>
        <table border=0 cellspacing=1 cellpadding=3 width=100%>
        <tr bgcolor=\"#660000\"><td><b>Ошибка:</b> ".mysql_error()."</td></tr>
        </table>
        </td></tr></table>
        ";
    }
    else
    {
        $isfetch = (@mysql_num_rows($qwresult) > 0) ?1 :0;
        $status = "
        <table border=0 cellspacing=0 cellpadding=0 width=100%><tr bgcolor=\"#CCCCCC\"><td>
        <table border=0 cellspacing=1 cellpadding=3 width=100%>
        <tr bgcolor=\"#223344\"><td>
        <b>Затраченно времени :</b> ".sprintf("%.5f",$worktime)." секунд
        <br><b>Таблиц :</b> ".@mysql_affected_rows()."
        </td></tr>
        </table>
        </td></tr></table>
        ";
    }
}
?>
<style>
body, td, form, input, select {font-family: Arial; font-size: 12px;}
</style>
<script language="JavaScript">
if (document.layers) document.captureEvents(Event.KEYPRESS)
document.onkeypress = kpress;

function kpress (e)
{
    key = (document.layers) ?e.which :window.event.keyCode;
    if (key == 10 && String.fromCharCode(key) == String.fromCharCode(10))
        document.queryform.submit();
}

var lastdblclick = 0;

function selectallfrom (table)
{
    document.queryform.sqlquery.value = 'SELECT * FROM '+table;
}

function showcolumnsfrom(table)
{ document.queryform.sqlquery.value = 'SHOW COLUMNS FROM '+table; }

function selectrowfrom(table,row)
{
    document.queryform.sqlquery.value = 'SELECT '+row+' FROM '+table;
}

function selectrowsfrom(table,inform)
{
  var selectrows = '';
  for (i = 0; i < document.forms[inform].fields.length; i++)
  {
    if (document.forms[inform].fields[i].checked == true)
    {
      selectrows = selectrows+document.forms[inform].fields[i].value+',\n\t';
    }
  }
  if (selectrows == '') {selectrows = "*";}
  else
  {selectrows = selectrows.substring(0, selectrows.length-3);}
  if (!document.forms[inform].fields.length) {selectrows = document.forms[inform].fields.value;}
  document.queryform.sqlquery.value = 'SELECT\t'+selectrows+'\nFROM '+table;
}

function insertinto(table,inform)
{
  var insertrows = '';

  for (i = 0; i < document.forms[inform].fields.length; i++)
  {
    if (document.forms[inform].fields[i].checked == true)
    {
      insertrows = insertrows+document.forms[inform].fields[i].value+'=\'\',\n    ';
    }
  }
  if (insertrows == '')
  {
    for (i = 0; i < document.forms[inform].fields.length; i++)
    {
      insertrows = insertrows+document.forms[inform].fields[i].value+'=\'\',\n    ';
    }
  }

  insertrows = insertrows.substring(0, insertrows.length-6);
  if (!document.forms[inform].fields.length) {insertrows = document.forms[inform].fields.value+'=\'\'';}
  document.queryform.sqlquery.value = 'INSERT INTO '+table+'\nSET\n    '+insertrows;
}

function openWin(html)
{window.open(html,'','resizable=no,menubar=no,status=no,scrollbars=no,width=350,height=200');}

<?
  $result = @mysql_query("SHOW tableS FROM $database");
  $alltables = Array();
  while ($row = @mysql_fetch_row($result))
  {array_push($alltables,$row[0]);}
?>
var x1,y1,x2,y2,cx,cy,mx1,mx2,my1,my2,mw,mh,tout;
var needhide = 0;

function initmenucoord()
{
  var offsetX = 0;
  var offsetY = 0;
  var myobj = GLOBALMENU;
  while (myobj.tagName != "BODY")
  {
    offsetX += myobj.offsetLeft;
    offsetY += myobj.offsetTop;
    myobj = myobj.parentElement;
  }
  mx1 = offsetX
  my1 = offsetY;
  mx2 = offsetX+GLOBALMENU.offsetWidth;
  my2 = offsetY+GLOBALMENU.offsetHeight;
  mw = GLOBALMENU.offsetWidth;
  mh = GLOBALMENU.offsetHeight;
}

function adjust(id)
{
  x1 = document.all[id].style.pixelLeft;
  x2 = x1+(document.all[id].offsetWidth);
  y1 = document.all[id].style.pixelTop;
  y2 = y1+(document.all[id].offsetHeight);
}

function toposition(id)
{
  stophide();
  document.all[id].style.pixelLeft = cx-20;
  document.all[id].style.pixelTop = cy+5;
  adjust(id);
}

function initall()
{ initmenucoord(); }

document.onmousemove = mmove;
onload = initall;

//-->
</script>
<body text="#ffffff" bgcolor="#112255" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<?
$tcount = 0;
reset ($alltables);
foreach ($alltables as $tables)
{
    $tresult = @mysql_query("DESC $tables");

    $desc = "<div id=\"table$tcount\" class=\"submenu\">\n";
    $desc .= "<table border=0 bgcolor=888888 cellspacing=1 cellpadding=1><form name=\"rowsform$tcount\">\n";

    while ($rows = @mysql_fetch_row($tresult))
    {
        if (ereg("^[[:space:]]*$",$rows[0])) {$rows[0] = "&nbsp;";}
        $desc .= "<tr bgcolor=334466><td class=SMALL>&nbsp;&nbsp;<INPUT type=checkbox name=fields value=\"$rows[0]\">&nbsp;<A href=\"javascript: selectrowfrom('$tables','$rows[0]');\">$rows[0]</A></td><td class=SMALL>$rows[1]</td></tr>\n";
    }
    $desc .= "<tr bgcolor=334466><td height=25 colspan=2 NOWRAP>&nbsp;&nbsp;<A href=\"javascript: selectrowsfrom('$tables','rowsform$tcount');\"><b>Показать</b></A> | <A href=\"javascript: insertinto('$tables','rowsform$tcount');\"><b>Добавить</b></A> </td></tr>\n</form></table>\n";
    echo $desc."</div>\n";
    $tcount++;
}
?>
<form action="" method="post" name="queryform" style="display: inline;">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr bgcolor="#CCCCCC">
        <td>
            <table border="0" cellspacing="1" cellpadding="1" width="100%">
                <tr>
                    <td rowspan="2" nowrap bgcolor="#112255" valign="top" width="25%">
                        <div style="background-color: #446688; margin: -1px; padding-left: 5px;"><b>Параметры БД:</b></div><hr>
                        База Данных:
<?
                        echo "<strong>$database</strong><br>";
                        if ($database != "")
                        {
                            echo "Таблица Данных: ";
                            echo "<br><select class='small' style='width: 120px;' name='table'>";
                            $result = $adb->query("SHOW TABLE STATUS FROM `$database`;");
                            for ($i = 0; $i < count ($result); $i++)
                            {
                                if ($result[$i]['Name'] == $table)
                                    $number = $i;
                                $select = ($result[$i]['Name'] == $table) ?" selected" :"";
                                echo "<option value='{$result[$i]['Name']}'$select>{$result[$i]['Name']} ({$result[$i]['Rows']})</option>\n";
                            }
                            echo "</select>";
                            echo "<input type='submit' value='Выбрать'><br>";
                        }
                        if ($table != "")
                        {
                            $result = $adb->query("SHOW TABLE STATUS FROM `$database`;");
                            echo "Информация таблицы:<br>";
                            echo "Имя таблицы: <strong>{$result[$number]['Name']}</strong><br>";
                            echo "Количество строк: <strong>{$result[$number]['Rows']}</strong><br>";
                            echo "Размер файла данных: <strong>".formatfilesize ($result[$number]['Data_length'])."</strong><br>";
                            echo "Последнее обновление: <br><strong>{$result[$number]['Update_time']}</strong><br>";
                        }
?>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td valign="top" width="99%" bgcolor="#336699">
<?
                        if ($table != "")
                        {
?>
                        <table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="1" width="100%">
                                        <tr>
                                            <td nowrap>Нажмите <b>Ctrl+Enter</b> , чтобы послать запрос.<br></td>
                                            <td align='right' nowrap width="300">Показать с: <input type='text' name='showfrom' size='5' maxlength='10' value='<?echo $showfrom;?>'> Кол-во: <input type='text' name='showto' size='5' maxlength='10' value='<?echo $showto;?>'><input type="submit" value=">"></td>
                                        </tr>
                                        <tr>
                                            <td><textarea onClick="needhide = 1; hidesub ();" id="sqlquery" name="sqlquery" nowrap rows="12" cols="59" style="width: 400px; height: 220px; font-family: Verdana; font-size: 11px;"><?echo stripslashes ($sqlquery)?></textarea></td>
                                            <td valign='top'>Краткое пояснение переменных:<br><font color='lime'>* Переменные int</font><br><font color='#cc66ff'>* Переменные float</font><br><font color='#33ccff'>* Переменные varchar</font><br>* Переменные text<br><font color='red'>[NULL] - Пустые поля</font></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Послать запрос">
                                    <input type="button" value="Очистить запрос" onclick="document.getElementById('sqlquery').value = '';">
                                </td>
                            </tr>
                        </table>
<?
                        }
?>
                    <td>
                </tr>
<? if ($isfetch): ?><tr bgcolor="#000000"><td colspan="2" align="center"><b>Результат запроса:</b></td></tr><? endif ?>
            </table>
        </td>
    </tr>
</table>
</form>
<?
if ($table != "")
{
    $fields = array();
    $color = array();
    $select = $adb->query("SHOW COLUMNS FROM `$database`.`$table`;");
    $num_fields = count ($select);
    echo "<table bgcolor='#112255' border='1'>";
    echo "<tr>";
    for ($i = 0; $i < $num_fields; $i++)
    {
        $fields[$i] = $select[$i]['Field'];
        if (ereg ("int", $select[$i]['Type']))
            $color[$i] = "lime";
        else if (ereg ("varchar", $select[$i]['Type']))
            $color[$i] = "#33ccff";
        else if (ereg ("float", $select[$i]['Type']))
            $color[$i] = "#cc66ff";
        else
            $color[$i] = "white";
        echo "<td><a href='#' name='<div style=\"color: black;\">Тип: {$select[$i]['Type']}<br>Default: {$select[$i]['Default']}<br>Null: {$select[$i]['Null']}<br>Key: {$select[$i]['Key']}<br>Extra: {$select[$i]['Extra']}</div>' style='cursor: help; color: $color[$i];'>{$select[$i]['Field']}</a></td>";
    }
    echo "</tr>";
    $select = $adb->select("SELECT * FROM `$table` LIMIT $showfrom, $showto;");
    for ($i = 0; $i < count ($select); $i++)
    {
        echo "<tr>";
        for ($h = 0; $h < $num_fields; $h++)
        {
            $show_cell = ($select[$i][$fields[$h]] == "") ?"<font color='red'>[NULL]</font>" :$select[$i][$fields[$h]];
            echo "<td style='color: $color[$h]'>$show_cell</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
if ($isfetch && $fetchtype == 1)
{
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr bgcolor="#888888">
        <td>
            <table border="0" cellspacing="1" cellpadding="2" width="100%">
                <tr bgcolor="#223344">
                    <td align="center"><b>
<?
    $fields = _mysql_all_fields ($qwresult);
    echo @implode ("</b></td><td align=center><b>", $fields);
?>
                    </b>
                    </td>
                </tr>
<?
    $tmpcolor = $tmpcolor1 = "#334466"; $tmpcolor2 = "#263656";
    while ($rows = @mysql_fetch_row($qwresult))
    {
        for ($i = 0; $i < sizeof($rows); $i++)
        {
            if (is_null($rows[$i])) {$rows[$i] = "<center><b>[NULL]</b></center>";}
            elseif (ereg("^[[:space:]]*$",$rows[$i])) {$rows[$i] = "&nbsp;";}
            else {$rows[$i] = htmlspecialchars($rows[$i]);}
        }
        echo "<tr bgcolor=\"$tmpcolor\"><td>";
        echo @implode("</td><td>",$rows);
        echo "</td></tr>\n";
        $tmpcolor = ($tmpcolor == $tmpcolor1)?$tmpcolor2:$tmpcolor1;
    }
?>
            </table>
        </td>
    </tr>
</table>
<?
}
else if ($isfetch && $fetchtype == 2)
{
    $percent = floor(100/mysql_num_fields($qwresult));
?>
<table border="0" cellspacing="1" cellpadding="2" width="100%"><tr bgcolor="#223344"><td width=<? echo $percent ?>% align="center"><b><?
    $fields = _mysql_all_fields($qwresult);
    echo @implode("</b></td><td width=$percent% align=center><b>",$fields);
?></b></td></tr></table>
<?
    $tmpcolor = $tmpcolor1 = "#334466"; $tmpcolor2 = "#263656";

    while ($rows = @mysql_fetch_row($qwresult))
    {
        for ($i = 0; $i < sizeof($rows); $i++)
        {
            if (is_null($rows[$i])) {$rows[$i] = "<CENTER><b>[NULL]</b></CENTER>";}
            elseif (ereg("^[[:space:]]*$",$rows[$i])) {$rows[$i] = "&nbsp;";}
            else {$rows[$i] = htmlspecialchars($rows[$i]);}
        }
        echo "<table cellspacing=1 cellpadding=3 width=100%><tr bgcolor=\"$tmpcolor\"><td width=$percent%>";
        echo @implode("</td><td width=$percent%>",$rows);
        echo "</td></tr></table>\n";
        $tmpcolor = ($tmpcolor == $tmpcolor1)?$tmpcolor2:$tmpcolor1;
    }
}

function _mysql_all_fields ($result)
{
    $fields = Array();
    for ($i = 0; $i < @mysql_num_fields($result); $i++)
        array_push ($fields, @mysql_field_name ($result, $i));
    return $fields;
}

function getmicrotime()
{
    list ($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}
?>