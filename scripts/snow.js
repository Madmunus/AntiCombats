var snow_count = 20;
var snow_intensive = 2;
var snow_speed1 = 300;
var snow_speed2 = 200;
var snow_src = new Array ('img/snow1.gif', 'img/snow2.gif');
var snow_id = 1;

$(document).ready(snow_start);

function snow_start ()
{
	for (var i = 0 ; i < snow_count / snow_intensive ; i++)
	{
		for (var n = 0 ; n < snow_intensive ; n++)
		{
			setTimeout ('snow_create()', i * 1500);
		}
	}
}

function snow_create ()
{
	snow_x = getRandomInt (0, $("#ione").width());
	snow_img = snow_src[Math.floor(Math.random()*snow_src.length)];
	snow_elem = '<img id="snow'+snow_id+'" style="position: absolute; left: '+snow_x+'px; top: 0px; z-index: 200" src="'+snow_img+'" />';
	$("#ione").append(snow_elem);
	snow_move(snow_id, snow_img);
	snow_id++;
}

function snow_move (id, type)
{
	var remove = false;
	var change_x = (type == 'img/snow2.gif') ?getRandomInt (-2, 2) :getRandomInt (-1, 1);
	var change_y = (type == 'img/snow2.gif') ?getRandomInt (15, 20) :getRandomInt (20, 25);
	var speed = (type == 'img/snow2.gif') ?snow_speed1 :snow_speed2;
	if ((parseInt($('#snow'+id).css('top')) + change_y) > ($("#ione").height() - 40))
	{
		change_y = $("#ione").height() - 40 - parseInt($('#snow'+id).css('top'));
		remove = true;
	}
	if ((parseInt($('#snow'+id).css('left')) + change_x) > $("#ione").width())
	{
		change_x = $("#ione").width() - parseInt($('#snow'+id).css('left'));
		remove = true;
	}
	if ((parseInt($('#snow'+id).css('left')) + change_x) < 0)
	{
		change_x = -parseInt($('#snow'+id).css('left'));
		remove = true;
	}
	$('#snow'+id).animate({top: '+='+change_y, left: "+="+change_x}, speed, function()
	{
		if (remove)
		{
			$(this).remove();
			snow_create ();
		}
		else
			snow_move (id, type);
	});
}