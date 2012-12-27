<?
defined('AntiBK') or die("Доступ запрещен!");

function formatfilesize ($data) 
{
  // bytes
  if ($data < 1024)         return $data." bytes";
  // kilobytes
  else if ($data < 1024000) return round(($data / 1024), 1)." kb";
  // megabytes
  else                      return round(($data / 1024000), 1)." mb";
}
?>