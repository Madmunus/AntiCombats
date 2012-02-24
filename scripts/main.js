function getCenter (width, height)
{
  var center = {};
  center.x = ($(window).width() - width)/2 + $(window).scrollLeft();
  center.y = ($(window).height() - height)/2 + $(window).scrollTop();
  return center;
}

function getCloseButton (vert, horiz, func)
{
  return "<div style='position: absolute; "+vert+": -15px; "+horiz+": -15px; cursor: pointer; z-index: 113;'><img src='i/clear.gif' width='13' height='13' onclick="+func+"></div>"
}

function hideShow (selector, func, v)
{
  $(selector).fadeOut('10000', function (){func(v); $(this).fadeIn('10000'); checkWindow();});
}

function drop (id, img, txt)
{
	var table = '<table width="100%"><td><img src="img/items/'+img+'"></td><td>Предмет <nobr><b>\''+txt+'\'</b></nobr> будет утерян, вы уверены ?</table>'+
              '<input type="checkbox" name="dropall"><small> Все предметы этого вида</small>';
	dialogconfirm('Выбросить предмет?', 'deleteItem(\''+id+'\');', table);
}

function drophlam ()
{
	var table = '<TABLE width=100%><TR><TD width="10%"><IMG src="http://img.combats.com/i/items/just_junk.gif">'+
              '</TD><TD>Выбросить разный хлам типа выписок, квитанций и увядших букетов?</TD></TR>'+
              '<TR><TD colspan="2"><small><B style="color:red">Внимание!</B> Имеющие срок годности предметы, купленные за зубы (эликсиры, корм для животных и т.д.), будут уничтожены.</small></TD></TR></TABLE>'+
              '<INPUT type=hidden name=drophlam value="1"><INPUT type=hidden name=sd4 value="' + sd4+'">';
	dialogconfirm('Выбросить хлам?', 'main.pl', table);
}

function unstack (name, n, txt){
	var table = '<TABLE width=100%><TD><IMG src="http://img.combats.com/i/items/'+name+
			'.gif"></TD><TD>Разделить предмет <NOBR><B>\''+txt+'\'</B></NOBR></TABLE>'+
	'<INPUT type=hidden name=unstack value="'+name+'"><INPUT type=hidden name=n value="'+n+'"><INPUT type=hidden name=sd4 value="' + sd4+'">'+
	'Кол-во: <INPUT type=text name=quant value="1">';
// window.clipboardData.setData('Text', table);
	dialogconfirm('Разделить предмет?', (specialscript?specialscript:'main.pl'),table);
}

function showError (error, parameters)
{
	if (!parameters)
	  parameters = '';
	$.post('ajax.php', {'do': 'geterror', 'error': error, 'parameters': parameters}, function (data){
	  if (data)
	    visual.show_any('#error', data);
	});
}

function clearError ()
{
	$('#error').fadeOut('10000', function (){$(this).html('');});
}

function showHelp (link)
{
	$.post('encicl/help/'+link+'.html', function (data){
	  if (data)
      visual.show_help(data);
	});
}

function hideHelp ()
{
	visual.hide_help();
}

function showInventory (section, type, mail_guid)
{
	clearError ();
	var cur_section = getCookie ('section');
	
	if (cur_section == section && $("#inventory").html() != '')
	  return;
	
	$('#section_'+cur_section+', #section_1').attr('bgcolor', '#d4d2d2');
	$('#section_'+section).attr('bgcolor', '#a5a5a5');
	setCookie('section', section, getTimePlusHour ());
	$.post('ajax.php', {'do': 'showinventory', 'section': section, 'type': type, 'mail_guid': mail_guid}, function (data){
    var inventory = top.exploder(data);
	  visual.show_any('#inventory', inventory[0]);
	});
}

function showShapes (available)
{
	if (available)
	{
	  $('#shape_a').css('backgroundColor', '#A9AFC0');
	  $('#shape_na').css('backgroundColor', '');
	}
	else
	{
	  $('#shape_a').css('backgroundColor', '');
	  $('#shape_na').css('backgroundColor', '#A9AFC0');
	}
	  
	$.post('ajax.php', {'do': 'showshapes', 'available': available}, function (data){
    var shapes = top.exploder(data);
	  visual.show_any('#shapes', shapes[0]);
	});
}

function chooseShape (shape)
{
	$.post('ajax.php', {'do': 'chooseshape', 'shape': shape}, function (data){
	  var shapes = top.exploder(data);
	  if (shapes[0] == 'complete')
	    location.href = 'main.php?action=inv';
	  else if (shapes[0] == 'error')
	    showError(shapes[1]);
	});
}

//-- Смена хитпоинтов
var delay = 2;			// Каждые 2 сек. увеличение HP и MP на 0.2%
var redHP = 0.33;		// меньше 30% красный цвет
var yellowHP = 0.66;	// меньше 60% желтый цвет, иначе зеленый
var TimerOnHP = -1;		// id таймера HP
var TimerOnMP = -1;		// id таймера MP
var nowHP, maxHP, nowMP, maxMP, hspeed, mspeed;

function showHP (now, max, newspeed)
{
	nowHP = now;
	maxHP = max;
	if (TimerOnHP >= 0)
	{
		clearTimeout(TimerOnHP);
		TimerOnHP = -1;
	}
	hspeed = newspeed;
	setHPlocal();
}

function setHPlocal ()
{
  var plusHP = 0;
	if (nowHP >= maxHP)
	{
		nowHP = maxHP;
		TimerOnHP = -1;
	}
	else
	{
    plusHP = maxHP * hspeed * delay * 0.00001;
		nowHP += plusHP;
		TimerOnHP = 0;
	}
	var le = 120;
	var h1 = Math.round((le / maxHP) * nowHP);
	var h2 = le - h1;
	if (nowHP / maxHP < redHP) 
		imag = 'img/icon/bk_life_red.gif';
	else if (nowHP / maxHP < yellowHP)
		imag = 'img/icon/bk_life_yellow.gif';
	else
		imag = 'img/icon/bk_life_green.gif';
	var rhp = Math.round(nowHP) + "/" + maxHP;
  var alt = 'Уровень жизни'+((plusHP > 0 && (difHP = maxHP-nowHP) > 0) ?'<br>Осталось: '+top.getFormatedTime(Math.round(difHP*2/plusHP)) :'');
	$('#HP').html("<table border='0' cellpadding='0' cellspacing='0' width='"+le+"' align='center' style='padding-top: 1px;'><tr>"+
                "<td style='position: absolute; width: "+le+"px; font-size: 9px; color: white; font-weight: bold; margin-top: -3px; padding-left: 5px;' align='left' alt='"+alt+"'>"+rhp+"</td>"+
                "<td style='width: "+h1+"px; height: 10px; background: url("+imag+") repeat-x;'></td>"+
                "<td style='width: "+h2+"px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
                "</tr></table>");
  updateMmoves('HP', alt);
	if (TimerOnHP != -1)
		TimerOnHP = setTimeout('setHPlocal()', delay * 1000);
}

function showMP (now, max, newspeed)
{
	if (max == 0)
		return;
	
	nowMP = now;
	maxMP = max;
	if (TimerOnMP >= 0)
	{
		clearTimeout(TimerOnMP);
		TimerOnMP = -1;
	}
	mspeed = newspeed;
	setMPlocal();
}

function setMPlocal ()
{
  var plusMP = 0;
	if (maxMP == 0)
		return;
	
	if (nowMP >= maxMP)
	{
		nowMP = maxMP;
		TimerOnMP = -1
	}
	else
	{
    plusMP = maxMP * mspeed * delay * 0.00001;
		nowMP += plusMP;
		TimerOnMP = 0;
	}
	var le = 120;
	var m1 = Math.round((le / maxMP) * nowMP);
	var m2 = le - m1;
	var rmp = Math.round(nowMP) + "/" + maxMP;
  var alt = 'Уровень маны'+((plusMP > 0 && (difMP = maxMP-nowMP) > 0) ?'<br>Осталось: '+top.getFormatedTime(Math.round(difMP*2/plusMP)) :'')
	$('#MP').html("<table border='0' cellpadding='0' cellspacing='0' width='"+le+"' align='center' style='margin-top: -1px;'><tr>"+
                "<td style='position: absolute; width: "+le+"px; font-size: 9px; color: white; font-weight: bold; margin-top: -3px; padding-left: 5px; color: #80FFFF;' align='left' alt='"+alt+"'>"+rmp+"</td>"+
                "<td style='width: "+m1+"px; height: 10px; background: url(img/icon/blue.gif) repeat-x;'></td>"+
                "<td style='width: "+m2+"px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
                "</tr></table>");
  updateMmoves('MP', alt);
	if (TimerOnMP != -1)
		TimerOnMP = setTimeout('setMPlocal()', delay * 1000);
}

var broken = new Array ();
var i = 1;

function BrokenItems ()
{
  $('.broken').each(function (){
    bgcolor = $(this).parents('tr[bgColor]').attr('bgColor');
    $(this).animate({backgroundColor: ((broken[i]) ?"#f88383" :bgcolor)}, 2000);
    broken[i] = !broken[i];
    i++;
  });
  i = 1;
}

function checkWindow ()
{
  if ($('body').height() > $(window).height())
    $('body').css('margin-right', '0px');
  else
    $('body').css('margin-right', '17px');
}

var pos = {};

$(function (){
  $('.broken').each(function (){
    broken[i] = true;
    i++;
  });
  i = 1;
  if ($('.broken').html() != undefined)
    setInterval(BrokenItems, 4100);
  
  $('#clear').live('mouseover mouseleave', function (e){
    if (e.type == 'mouseover')
      $(this).attr('src', 'i/clear.gif');
    else if (e.type == 'mouseleave')
      $(this).attr('src', 'i/clearg.gif');
  });
  $('#link').css('cursor', 'pointer').live('click', function (){
    top.linkAction($(this).attr('link'));
  });
  $('#hint').live('click', function (){
    showHelp ($(this).attr('link'));
  });
  $('#refresh').live('click', function (){
    location.reload();
  });
  $(document).mousemove(function (e){
    pos.x = e.pageX;
    pos.y = e.pageY;
  });
  $('input[type=button], input[type=radio], input[type=submit], a').live('click', function (){
    $(this).blur();
  });
  $(window).resize(checkWindow);
  checkWindow();
});