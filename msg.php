<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<link rel="stylesheet" type="text/css" href="styles/msg.css">
<script src="scripts/jquery-1.4.4.js" type="text/javascript"></script>
<script src="scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
var id = 'oMenu';

function cMenu ()
{
  $('#'+id).css('visibility', "hidden");
  $('#phrase', top.talk.document).focus();
}

$(document).ready(function (){
  $('span').live("contextmenu",function (e){
    var x, y, login, login2, i1, i2;
    e.preventDefault();
    x = e.pageX - 3;
    y = e.pageY;

    if (e.pageY + 50 > document.body.clientHeight)
      y -= 50;
    else 
      y -= 2;
    login = $(this).text();
    if ((i1 = login.indexOf('[')) >= 0 && (i2 = login.indexOf(']')) > 0)
      login = login.substring(i1+1, i2);

    $('#'+id).html('<a class="menuItem" href="javascript:top.AddTo(\''+login+'\');">TO</a>'+
    '<a class="menuItem" href="javascript:top.AddToPrivate(\''+login+'\');">PRIVATE</a>'+
    '<a class="menuItem" href="info.php?log='+ login.replace(' ', '%20') +'" target="_blank" return true;">INFO</a>');
    $('#'+id).css({'left': x + "px", 'top': y + "px", 'visibility': "visible"});
  });
  $('.menuItem').live("contextmenu",function (e){e.preventDefault();}).live("click", function (){cMenu ();});
  $('#oMenu').live("mouseleave",function (){cMenu ();});
  $('img').live("click",function (){
    var image = $(this).attr('src');
    image = image.split("/");
    image = image[image.length - 1].replace('.gif', '');
    $('#phrase', top.talk.document).val($('#phrase', top.talk.document).val() +' :'+image+': ').focus();
  });
});
</script>
</head>
<body topmargin="0" leftmargin="0" bgcolor="#f2f0f0">
<div id="mes"></div>
<div id="oMenu" class="menu"></div>
</body>
</html>