<?
defined('AntiBK') or die("Доступ запрещен!");

$path = getVar('path');
?>
<table>
  <form enctype="multipart/form-data" method="post">
  <tr>
    <td>Файл:</td>
    <td><input size="48" name="file" type="file"></td>
  </tr>
  <tr>
    <td>Папка:</td>
    <td>
      <input size="48" value="<?echo ($path) ?$path :$_SERVER['DOCUMENT_ROOT'].'/';?>" name="path" type="text">
      <input type="submit" value="Загрузить">
    </td>
  </tr>
  </form>
</table>
<?
if ($path)
{
  $uploadfile = $path.$_FILES['file']['name'];
  if (!$path)
    $uploadfile = $_FILES['file']['name'];
  if (copy($_FILES['file']['tmp_name'], $uploadfile))
  {
    echo "Файл успешно загружен в папку $uploadfile<br>";
    echo "Имя: ".$_FILES['file']['name']."<br>";
    echo "Тип: ".$_FILES['file']['type']."<br>";
    echo "Размер: ".formatfilesize($_FILES['file']['size'])."<br>";
  }
  else
  {
    echo "Не удаётся загрузить файл.<br>Инфо: ";
    switch ($_FILES['file']['error'])
    {
      case 1: echo "Размер загружаемого файла превысил максимально допустимый размер, который задан директивой <code>upload_max_filesize</code> конфигурационного файла php.ini."; break;
      case 2: echo "Размер загружаемого файла превысил значение <code>MAX_FILE_SIZE</code>, указанное в HTML-форме.";                                                              break;
      case 3: echo "Загружаемый файл был получен только частично.";                                                                                                                break;
      case 4: echo "Файл не был загружен. ";                                                                                                                                       break;
    }
  }
}
?>