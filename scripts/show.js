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
  if ((pos.x + $(window).scrollLeft()) > $('#'+id).offset().left && (pos.x + $(window).scrollLeft()) < $('#'+id).offset().left + $('#'+id).width() && (pos.y + $(window).scrollTop()) > $('#'+id).offset().top && (pos.y + $(window).scrollTop()) < $('#'+id).offset().top + $('#'+id).height())
    $("#mmoves").html('<small>' + break_str(text, 50, '<br>') + '</small>');
}

$(function (){
	$('body').on('mousemove', 'img,a,td,span', function (e){
		var x, y;
		e.preventDefault();
		if (!($(this).attr('alt')) || $(this).attr('alt') == '')
			return;
    $('body').append('<div id="mmoves"></div>');
		$("#mmoves").html('<small>' + break_str($(this).attr('alt'), 50, '<br>') + '</small>');
		var razX = $(window).width() - (e.pageX - $(window).scrollLeft()) - 25;
		x = (razX < $("#mmoves").width())	?$("#mmoves").width() + 15 :-15;
		var razY = $(window).height() - (e.pageY - $(window).scrollTop()) - 25;
		y = (razY < $("#mmoves").height()) ?$("#mmoves").height() + 15 :-15;
		$("#mmoves").css({'left': e.pageX - x + 'px', 'top': e.pageY - y + 'px', 'visibility': 'visible'});
	}).on('mouseleave', 'img,a,td,span', function (){
    $("#mmoves").remove();
  });
});