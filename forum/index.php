<?
session_start();
define('AntiBK', true);

include("../engline/config.php");
include("../engline/dbsimple/Generic.php");
include("../engline/functions/functions.php");

$adb = DbSimple_Generic::connect($database['adb']);
$adb->query("SET NAMES ? ",$database['db_encoding']);
$adb->setErrorHandler("databaseErrorHandler");

$lang = getVar('lang', 'ru', 5);
$lang = ($lang == 'ru' || $lang == 'en') ?$lang :'ru';
$cat = getVar('cat', 1, 5);
$cat = ($adb->selectRow("SELECT `id`, `main`, `name`, `text` FROM ?# WHERE `id` = ?d", "forum_menu_$lang", $cat)) ?$cat :1;
$cat = ($cat == 2 && $lang == 'ru') ?28 :$cat;
setCookie('lang', $lang,  time() + 3600);
setCookie('cat', $cat,  time() + 3600);
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="<?echo $lang;?>" />
  <title>Анти Бойцовский Клуб</title>
  <link rel="SHORTCUT ICON" href="../img/favicon.ico" />
  <link href="../styles/main.css" rel="stylesheet" type="text/css" />
  <link href="../styles/forum.css" rel="stylesheet" type="text/css" />
  <script src="../scripts/jquery.js" type="text/javascript"></script>
  <script src="../scripts/forum.js" type="text/javascript"></script>
</head>
<body bgcolor="#3D3D3B" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<?
$forum_menu = "forum_menu_$lang";
$forum_topics = "forum_topics_$lang";
$language = ($lang == "en") ?"<a href='?lang=ru&cat=1'>RU</a> | EN" :"RU | <a href='?lang=en&cat=1'>EN</a>";

$lang = $adb->selectCol("SELECT `key` AS ARRAY_KEY, ?# FROM `forum_language`;", $lang);
$cat = $adb->selectRow("SELECT `id`, `main`, `prev`, `name`, `text` FROM ?# WHERE `id` = ?d", $forum_menu, $cat);

if (isset($_SESSION['guid']))
  $char = Char::initialization($_SESSION['guid'], $adb);
?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <thead><tr><td background="../img/forum/sitebk_02.jpg" align="center"><img src="../img/forum/sitebk_03ru.gif" width="194" height="135"></td></tr></thead>
  <tfoot>
    <tr><td width="100%" height="13" background="../img/forum/sitebk_07.jpg"></td></tr>
    <tr><td width="100%" bgColor="#000" height="20" align="center" class="copyright"><?echo $config['copyright'];?></td></tr>
  </tfoot>
  <tbody>
  <tr>
    <td align="center" height="90%" valign="top">
      <table width="96%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f2e5b1">
        <tr valign="top">
          <td width="29" align="right" valign="top" style="background: url(../img/forum/n21_08_1.jpg) repeat-y;"><img src="../img/forum/fr_08.jpg"></td>
<?        if (!getVar('smile', 0, 1)) {?>
          <td width="200">
            <img src="../img/forum/fr_04.jpg"><br>
            <?echo (isset($char)) ?$char->getLogin() :$lang['nologin'];?><br>
            <?echo "$lang[lang]:&nbsp; ".$language;?><br><br>            
            <b><span style="color: #8f0000; font-family: arial; font-size: 10pt;"><?echo $lang['conf'];?></span></b><br>
            <div style="background: url(../img/forum/ram12_34.gif); height: 11px; width: 100%;">
            <div style="background: url(../img/forum/ram12_33.gif) no-repeat left top;" width="12" height="11">
            <div align="right"><img src="../img/forum/ram12_35.gif" width="13" height="11"></div></div></div>
<?          $cats = $adb->select("SELECT `id`, `name` FROM ?# WHERE `main` = '0';", $forum_menu);
            foreach ($cats as $category)
            {
              echo "<b>&nbsp;&nbsp; <img src='../img/forum/ic_acc1.gif' width='10' height='10' title='$lang[onlyread]'>&nbsp; <a href='?cat=$category[id]'>$category[name]</a><br></b>";
              if ($cat['id'] == $category['id'] || $cat['main'] == $category['id'])
              {
                $scats = $adb->select("SELECT `id`, `name` FROM ?# WHERE `prev` = ?d", $forum_menu, $category['id']);
                foreach ($scats as $scat)
                {
                  echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src='../img/forum/ic_acc1.gif' width='10' height='10' title='$lang[onlyread]'>&nbsp; <a href='?cat=$scat[id]'>$scat[name]</a><br></b>";
                  if ($cat['id'] == $scat['id'] || $cat['main'] == $scat['id'] || $cat['prev'] == $scat['id'])
                  {
                    $sscats = $adb->select("SELECT `id`, `name` FROM ?# WHERE `prev` = ?d", $forum_menu, $scat['id']);
                    foreach ($sscats as $sscat)
                      echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src='../img/forum/ic_acc1.gif' width='10' height='10' title='$lang[onlyread]'>&nbsp; <a href='?cat=$sscat[id]'>$sscat[name]</a><br></b>";
                  }
                }
              }
            }
?>        <br>
          <div style="background: url(../img/forum/ram12_34.gif); height: 11px; width: 100%;">
          <div style="background: url(../img/forum/ram12_33.gif) no-repeat left top;" width="12" height="11">
          <div align="right"><img src="../img/forum/ram12_35.gif" width="13" height="11"></div></div></div><br>
          <center><a href="?smile=1"><img src="../img/forum/smiles/icon7.gif" title="<?echo $lang['smiles'];?>" width="15" height="15"></a></center><br>
          </td>
          <td width="70%">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr><td><br><a href="../forum"><img src="../img/forum/formz_10.gif"></a><br><br><br></td></tr>
                    <tr><td>
<?                    echo "<h3>$lang[conf] \"$cat[name]\"</h3>"
                         . "<p>$cat[text]</p>"
                         . "<br>$lang[rss] <img src='../img/forum/rss.png' align='absmiddle'>";
?>                  </td></tr>
                  </table>
                </td>
              </tr>
            </table>
<?        } else {?>
          <td><img src="../img/forum/fr_04.jpg"><br></td>
          <td width="75%" align="center">
            <br><br><br>
            <table width="100%">
              <tr>
                <td align="left"><h2><?echo $lang['legal'];?></h2></td>
                <td align="left"><p><a href="../forum"><?echo $lang['home'];?></a><p></td>
              </tr>
              <tr><td colspan="2"><p><h4><?echo $lang['smilelimit'];?></h4></p>	</td></tr>
            </table><br>
            <table cellpadding="5" cellspacing="0" class="smile_css">
              <tr>
<?              for ($i = 0; $i < 3; $i++)
                {
                  echo "<td class='smile_css'> $lang[image] </td>"
                     . "<td class='smile_css'> $lang[text] </td>"
                     . "<td class='smile_css'> $lang[atext] </td>";
                }
?>            </tr>
              <tr>
<?              $smiles = $adb->select("SELECT `text`, `atext`, `img` FROM `forum_smiles`;");
                $i = 0;
                foreach ($smiles as $smile)
                {
                  $i++;
                  echo "<td class='smile_css'><img src='../img/forum/smiles/$smile[img]' /></td>"
                     . "<td class='smile_css'>$smile[text]</td>"
                     . "<td class='smile_css'>$smile[atext]</td>";
                  if ($i == 3)
                  {
                    $i = 0;
                    echo "</tr><tr>";
                  }
                }
?>            </tr></table>
              <br>
            <div style="background: url(../img/forum/ram12_34.gif); height: 11px; width: 100%;">
            <div style="background: url(../img/forum/ram12_33.gif) no-repeat left top;" width="12" height="11">
            <div align="right"><img src="../img/forum/ram12_35.gif" width="13" height="11"></div></div></div><br>
<?        }?>
          </td>
          <td style="background: url(../img/forum/fr_15.jpg) no-repeat bottom;"><img src="../img/forum/forumru_03.jpg" border="0" valign="top"></td>
          <td width="23" valign="top" background="../img/forum/nnn21_03_1.jpg"></td>
        </tr>
      </table>
    </td>
  </tr>
  </tbody>
</table>
</body>
</html>