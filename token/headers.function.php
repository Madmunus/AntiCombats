<?
function getallheaders ()
{
  $headers = array();
  foreach ($_SERVER as $h => $v)
  {
    if (preg_match_all('/HTTP_(.+)/', $h, $hp))
      $headers[$hp[1][0]] = $v;
  }
  return $headers;
}
?>