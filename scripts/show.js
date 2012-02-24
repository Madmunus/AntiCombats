function break_str (str, width, brk, cut)
{
  if (str.length <= width || str.indexOf('<br>') > 0) return str;
  brk = brk || '\n';
  width = width || 75;
  cut = cut || false;  
  var regex = '.{1,'+width+'}(\\s|$)' + (cut ?'|.{'+width+'}|.+' :'|\\S+?(\\s|$)');
  return str.match(RegExp(regex, 'g')).join(brk);
}

function updateMmoves (id, text)
{
  if (pos.x > $('#'+id).offset().left && pos.x < $('#'+id).offset().left + $('#'+id).width() && pos.y > $('#'+id).offset().top && pos.y < $('#'+id).offset().top + $('#'+id).height())
    $("#mmoves").html('<small>' + break_str (text, 50, '<br>') + '</small>');
}

$(function (){
	$('img,a,td,span').live('mousemove', function (e){
		var x, y;
		e.preventDefault();
		if (!($(this).attr('alt')) || $(this).attr('alt') == '')
			return;
    $('body').append('<div id="mmoves"></div>');
		$("#mmoves").html('<small>' + break_str ($(this).attr('alt'), 50, '<br>') + '</small>');
		var razX = $(window).width() - (e.pageX - $(window).scrollLeft()) - 20;
		x = (razX < $("#mmoves").width())	?$("#mmoves").width() + 15 :-15;
		var razY = $(window).height() - (e.pageY - $(window).scrollTop()) - 20;
		y = (razY < $("#mmoves").height()) ?$("#mmoves").height() + 15 :-15;
		$("#mmoves").css({'left': e.pageX - x + 'px', 'top': e.pageY - y + 'px', 'visibility': 'visible'});
	});
	$('img,a,td,span').live('mouseleave', function (){$("#mmoves").remove();});
});