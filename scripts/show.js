function break_str (s, length)
{
	if (s.length <= length || s.indexOf('<br>') > 0) return s;
	var len_s = Math.ceil(s.length / length);
	var return_s = '';
	for (var i = 0; i <= len_s; i++)
	{
		return_s += s.substr (0, length);
		if (i != len_s)
			return_s += "<br>";
		s = s.replace (s.substr (0, length), '');
	}
	return return_s;
}

$(document).ready(function (){
	$('img,a,td').live('mousemove', function (e){ 
		var x, y;
		e.preventDefault();
		if (!$(this).attr('alt') || $(this).attr('alt') == '')
			return;
		$(".mmoves").html('<small>' + break_str ($(this).attr('alt'), 40) + '</small>');
		var razX = window.innerWidth - e.pageX - 35;
		if (razX < $(".mmoves").attr('clientWidth'))	x = $(".mmoves").attr('clientWidth') + 15;
		else											x = -15;
		var razY = window.innerHeigth - e.pageY - 35;
		if (razY < $(".mmoves").attr('clientHeigth'))	y = $(".mmoves").attr('clientHeigth') + 20;
		else											y = -20;
		$(".mmoves").css({'left': e.pageX - x + 'px', 'top': e.pageY - y + 'px', 'visibility': 'visible'});
	});
	$('img,a,td').live('mouseleave', function (){$(".mmoves").css('visibility', 'hidden').html('');});
});