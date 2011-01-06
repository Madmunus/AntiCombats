function break_str (str, width, brk, cut)
{
  if (str.length <= width || str.indexOf('<br>') > 0) return str;
  brk = brk || '\n';
  width = width || 75;
  cut = cut || false;  
  var regex = '.{1,'+width+'}(\\s|$)' + (cut ?'|.{'+width+'}|.+' :'|\\S+?(\\s|$)');
  return str.match(RegExp(regex, 'g')).join(brk);
}

$(document).ready(function (){
	$('img,a,td,span').live('mousemove', function (e){ 
		var x, y;
		e.preventDefault();
		if (!$(this).attr('alt') || $(this).attr('alt') == '')
			return;
		$(".mmoves").html('<small>' + break_str ($(this).attr('alt'), 50, '<br>') + '</small>');
		var razX = window.innerWidth - e.pageX - 35;
		x = (razX < $(".mmoves").attr('clientWidth'))	?$(".mmoves").attr('clientWidth') + 15 :-15;
		var razY = window.innerHeigth - e.pageY - 35;
		y = (razY < $(".mmoves").attr('clientHeigth')) ?$(".mmoves").attr('clientHeigth') + 20 :-20;
		$(".mmoves").css({'left': e.pageX - x + 'px', 'top': e.pageY - y + 'px', 'visibility': 'visible'});
	});
	$('img,a,td,span').live('mouseleave', function (){$(".mmoves").css('visibility', 'hidden').html('');});
});