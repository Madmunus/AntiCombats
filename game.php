<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico" />
<title>Анти Бойцовский Клуб</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<script src="scripts/jquery.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function (){
  $('[name=menu]').attr('src', 'topp.php');
  $('[name=main]').attr('src', 'main.php?action=enter');
  $('[name=msg]').attr('src', 'msg.php');
  $('[name=user]').attr('src', 'users.php');
  $('[name=talk]').attr('src', 'talk.php');
  $('[name=ref]').attr('src', 'refresh.php');
});
</script>
</head>
  <frameset rows="35, *, 30, 5" frameborder="0" border="0" framespacing="0">
    <frame name="menu" src="" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
    <frameset cols="9, *, 9" frameborder="0" border="0" framespacing="0">
      <frame src="left.html" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
      <frameset rows="52%, *" frameborder="1" border="3">
        <frame name="main" src="" />
        <frameset cols="*, 220">
          <frame name="msg" src="" target="_top" scrolling="auto" frameborder="1" border="0" framespacing="0" marginwidth="3" marginheight="3" />
          <frame name="user" src="" target="_blank" scrolling="auto" frameborder="0" border="0" framespacing="0" marginwidth="3" marginheight="0" />
        </frameset>
      </frameset>
      <frame src="right.html" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
    </frameset>
    <frame name="talk" src="" scrolling="no" noresize />
    <frame src="bottom.html" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
  </frameset>
</html>