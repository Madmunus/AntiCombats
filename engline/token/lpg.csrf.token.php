<?
function create_token ($token_key)
{
  $_SESSION['token'] = md5(time().$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].$token_key);
}

function lpg_csrf_token ($token_key, $expire_time = 5)
{
  $headers = lpg_getallheaders();

  if (isset($headers['X-CSRF-TOKEN']) && isset($headers['X-REQUESTED-WITH']) && ($headers['X-REQUESTED-WITH'] == 'XMLHttpRequest'))
  {
    $token = trim($headers['X-CSRF-TOKEN']);
    if ($token == '' || $token != $_SESSION['token'])
    {
      error_log("[LPG_CSRF_TOKEN] Warning: CSRF Attempt! Ajax attack from site: ".(isset($_SERVER['HTTP_REFERER']) ?$_SERVER['HTTP_REFERER'] :'This site!'));
      return false;
    }
  }
  else
  {
    error_log("[LPG_CSRF_TOKEN] Warning: CSRF Attempt! Ajax attack from site: ".(isset($_SERVER['HTTP_REFERER']) ?$_SERVER['HTTP_REFERER'] :'This site!'));
    return false;
  }
  return true;
}
?>