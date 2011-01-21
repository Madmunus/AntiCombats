var clevel = '';
var all_stats = new Array ('str', 'dex', 'con', 'vit', 'int', 'wis', 'spi');
var all_skills = new Array ('sword', 'fail', 'staff', 'knife', 'axe', 'fire', 'water', 'air', 'earth', 'light', 'gray', 'dark');

function increaseStat (stat)
{
  $("#loadbar").show();
	$.post('ajax.php', 'do=increasestat&stat='+stat, function (data){
    var stats = top.exploder(data);
	  if (stats[0] == 'complete')
    {
      var base = parseInt($("#base_"+stat).html()) + 1;
      $("#base_"+stat).fadeOut('10000', function (){$(this).html(base).fadeIn('10000');});
      if ($("#inst_"+stat).html())
      {
        var inst = parseInt($("#inst_"+stat).html()) + 1;
        $("#inst_"+stat).fadeOut('10000', function (){$(this).html(inst).fadeIn('10000');});
      }
      var ups = parseInt($("#ups").html()) - 1;
      $("#ups").fadeOut('10000', function (){$(this).html(ups).fadeIn('10000');});
      if (ups == 0)
      {
        $("#all_ups").fadeOut('10000', function (){$(this).remove();});
        for (var i in all_stats)
        {
          if ($("#plus_"+all_stats[i]).attr('id'))
            $("#plus_"+all_stats[i]).fadeOut('10000', function (){$(this).remove();});
        }
      }
      showError (stats[1], stats[2]);
    }
    else if (stats[0] == 'error')
      showError (stats[1], stats[2]);
    $("#loadbar").hide();
	});
}

function increaseSkill (stat, max)
{
  $("#loadbar").show();
	$.post('ajax.php', 'do=increaseskill&stat='+stat, function (data){
    var stats = top.exploder(data);
	  if (stats[0] == 'complete')
    {
      var base = parseInt($("#base_"+stat).html()) + 1;
      $("#base_"+stat).fadeOut('10000', function (){$(this).html(base).fadeIn('10000');});
      if ($("#inst_"+stat).html())
      {
        var inst = parseInt($("#inst_"+stat).html()) + 1;
        $("#inst_"+stat).fadeOut('10000', function (){$(this).html(inst).fadeIn('10000');});
      }
      var skills = parseInt($("#skills").html()) - 1;
      $("#skills").fadeOut('10000', function (){$(this).html(skills).fadeIn('10000');});
      if (inst && inst == max || !inst && base == max)
      {
        $("#plus_"+stat).fadeOut('10000', function (){$(this).remove();});
      }
      if (skills == 0)
      {
        $("#all_skills").fadeOut('10000', function (){$(this).remove();});
        for (var i in all_skills)
        {
          if ($("#plus_"+all_skills[i]).attr('id'))
            $("#plus_"+all_skills[i]).fadeOut('10000', function (){$(this).remove();});
        }
      }
      showError (stats[1], stats[2]);
    }
    else if (stats[0] == 'error')
      showError (stats[1], stats[2]);
    $("#loadbar").hide();
	});
}

function setlevel (nm)
{
  if (clevel != '' && clevel != nm)
  {
    $('#'+clevel).removeClass('tzSet tzOver');
    $('#d'+clevel).css('display', 'none');
  }
  clevel = nm || 'L1';
  setCookie ('clevel', clevel, getTimePlusHour ());
  $('#'+clevel).addClass('tzSet');
  $('#d'+clevel).css('display', 'block');
}

$(document).ready(function (){
  if (c = getCookie ('clevel'))
    clevel = c;
  else
    clevel = 'L5';
  setlevel (clevel);
  $('.tz').hover(
    function ()
    {
      if (clevel != $(this).attr('id'))
        $(this).addClass('tzOver');
    },
    function ()
    {
      if (clevel != $(this).attr('id'))
        $(this).removeClass('tzOver');
    }
  ).click(function (){
    setlevel ($(this).attr('id'));
  });
});