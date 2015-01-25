<?
function lpg_getallheaders ()
{
  $arr = getallheaders();
  $up_arr = array();
  
  foreach ($arr as $key => $value)
    $up_arr[str_replace('_', '-', strtoupper($key))] = $value;
  
  return $up_arr;
}
?>