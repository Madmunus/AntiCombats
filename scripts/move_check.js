var solo_store, progressTimer;
var progressEnd = 32;							              // set to number of progress <span>'s.
var progressColor = '#00CC00';					        // set to progress bar color
var mtime = parseInt (time_to_go);	// set time to next step (seconds)
if (!mtime || mtime <= 0)
	mtime = 0;
var progressInterval = Math.round (mtime * 1000 / progressEnd);
var is_accessible = true;
var progressAt = progressEnd;

function solo (n)
{
	if (check_access ())
		window.location.href = 'main.php?action=go&room_go=' + n;
	else if (n)
	{
		solo_store = n;
		$.post('ajax.php', 'do=getroomname&room='+n, function (data){
      var room = top.exploder(data);
      $("#add_text").fadeOut('10000', function (){$("#add_text").html(room[0]).fadeIn('10000');});
		});
		ch_counter_color ('red');
	}
	return false;
}

function clear_solo ()
{
	$("#add_text").fadeOut('10000', function (){$('#add_text').html('')});
	solo_store = false;
	ch_counter_color ('#00CC00');
	return false;
}

function progress_clear ()
{
	for (var i = 1; i <= progressEnd; i++)
		$('#progress'+i).css('backgroundColor', 'transparent');
	$('a.passage').addClass('dis_passage');
	progressAt = 0;
	is_accessible = false;
}

function check_access ()
{
	return is_accessible;
}

function progress_update ()
{
	progressAt++;
	if (progressAt > progressEnd)
	{
		is_accessible = true;
		$('a.dis_passage').removeClass('dis_passage');
		if (solo_store)
			solo (solo_store);				// go to stored
	}
	else
	{
		$('#progress'+progressAt).css('backgroundColor', progressColor);
		progressTimer = setTimeout ('progress_update()', progressInterval);
	}
}

function ch_counter_color (color)
{
	progressColor = color;
	for (var i = 1; i <= progressAt; i++)
		$('#progress'+i).css('backgroundColor', progressColor);
}

$(function (){
	if ($('#ione'))
		$('.buttons').appendTo('#ione');
	
	$('img.passage').hover(
		function ()
		{
			var image = $(this).parent('div').attr('class');
			image = image.replace('right1', 'right');
			image = image.replace('right2', 'right');
			$(this).attr('src', "img/room/glow/"+image+".png");
		},
		function ()
		{
			var image = $(this).parent('div').attr('class');
			image = image.replace('right1', 'right');
			image = image.replace('right2', 'right');
			$(this).attr('src', "img/room/"+image+".png");
		}
	);
	$('.buttons_on_image').hover(
		function ()
		{
			$(this).css('color', 'white');
		},
		function ()
		{
			$(this).css('color', '#D8D8D8');
		}
	);
	$('a.passage').live('click', function (){
		return check_access ();
	}).hover(
		function ()
		{
			if (!($(this).attr('id')))
				return;
			
			var image = $('.'+$(this).attr('id')).find('img');
			image.attr('src', "img/room/glow/"+$(this).attr('id')+".png");
		},
		function ()
		{
			if (!($(this).attr('id')))
				return;
			
			var image = $('.'+$(this).attr('id')).find('img');
			image.attr('src', "img/room/"+$(this).attr('id')+".png");
		}
	);
	if (mtime > 0)
	{
		progress_clear ();
		progress_update ();
	}
	else
	{
		for (var i = 1; i <= progressEnd; i++)
			$('#progress'+i).css('backgroundColor', progressColor);
	}
});