function drop(name, n, txt){
	var table = 	'<TABLE width=100%><TD><IMG src="http://img.combats.com/i/items/'+name+
			'.gif"></TD><TD>Предмет <NOBR><B>\''+txt+'\'</B></NOBR> будет утерян, вы уверены ?</TABLE>'+
 (!specialscript?'<input type=checkbox name="dropall" value="'+txt+'"><SMALL> Все предметы этого вида</SMALL>':'')+
	'<INPUT type=hidden name=drop value="'+name+'"><INPUT type=hidden name=n value="'+n+'"><INPUT type=hidden name=sd4 value="' + sd4+'">';
// window.clipboardData.setData('Text', table);
	dialogconfirm('Выбросить предмет?', (specialscript?specialscript:'main.pl'),table);
}

function drophlam(){
	var table = 	'<TABLE width=100%><TR><TD width="10%"><IMG src="http://img.combats.com/i/items/just_junk.gif">'+
			'</TD><TD>Выбросить разный хлам типа выписок, квитанций и увядших букетов?</TD></TR>'+
			'<TR><TD colspan="2"><small><B style="color:red">Внимание!</B> Имеющие срок годности предметы, купленные за зубы (эликсиры, корм для животных и т.д.), будут уничтожены.</small></TD></TR></TABLE>'+
			'<INPUT type=hidden name=drophlam value="1"><INPUT type=hidden name=sd4 value="' + sd4+'">';
	dialogconfirm('Выбросить хлам?', 'main.pl', table);
}

function unstack(name, n, txt){
	var table = 	'<TABLE width=100%><TD><IMG src="http://img.combats.com/i/items/'+name+
			'.gif"></TD><TD>Разделить предмет <NOBR><B>\''+txt+'\'</B></NOBR></TABLE>'+
	'<INPUT type=hidden name=unstack value="'+name+'"><INPUT type=hidden name=n value="'+n+'"><INPUT type=hidden name=sd4 value="' + sd4+'">'+
	'Кол-во: <INPUT type=text name=quant value="1">';
// window.clipboardData.setData('Text', table);
	dialogconfirm('Разделить предмет?', (specialscript?specialscript:'main.pl'),table);
}

function showError (warning, parameters)
{
	if (!parameters)
	  parameters = '';
	$.post('ajax.php', 'do=geterror&warning='+warning+'&parameters='+parameters, function (data){
	  if (data)
	    $("#error").fadeOut('10000', function (){$(this).html(data).fadeIn('10000');});
	});
}

function clearError ()
{
	$("#error").fadeOut('10000', function (){$(this).html('');});
}

function showHelp (link)
{
	$.post('encicl/help/'+link+'.html', function (data){
	  if (data)
	  {
		$("#help").html(data).css({left: ($(document).width() - 700)/2, top: 100}).before("<div id='help_bg' onclick='hideHelp ();'></div>").fadeIn('10000');
		$("#help_bg").fadeIn('10000');
	  }
	});
}

function hideHelp ()
{
	$("#help").fadeOut('10000');
	$("#help_bg").fadeOut('10000', function (){$(this).remove();});
}

function showShapes (available)
{
	if (available)
	{
	  $("#shape_a").css('backgroundColor', '#A9AFC0');
	  $("#shape_na").css('backgroundColor', '');
	}
	else
	{
	  $("#shape_a").css('backgroundColor', '');
	  $("#shape_na").css('backgroundColor', '#A9AFC0');
	}
	  
	$.post('ajax.php', 'do=showshapes&available='+available, function (data){
	  if (data)
	    $("#shapes").fadeOut('10000', function (){$(this).html(data).fadeIn('10000');});
	});
}

function chooseShape (shape)
{
	$.post('ajax.php', 'do=chooseshape&shape='+shape, function (data){
	  var shapes = data.split('A_D');
	  if (shapes[0] == 'complete')
	    location.href = 'main.php?action=inv';
	  else if (shapes[0] == 'error')
	    showError (shapes[1]);
	});
}

function deleteItem (id)
{
	$.post('ajax.php', 'do=deleteitem&id='+id, function (data){
	  var item = data.split('A_D');
	  if (item[0] == 'error')
	    showError (item[1]);
	  else if (item[0] == 'complete')
	  {
	    var count_items = parseInt($("#count_items").html()) - 1;
      $("#item_id_"+id).slideUp('10000', function (){$(this).remove();});
      $("#mass").fadeOut('10000', function (){$(this).html(item[1]).fadeIn('10000');});
      $("#count_items").fadeOut('10000', function (){$(this).html(count_items).fadeIn('10000');});
	  }
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
		clearTimeout (TimerOnHP);
		TimerOnHP = -1;
	}
	hspeed = newspeed;
	setHPlocal ();
}

function setHPlocal ()
{
	if (nowHP >= maxHP)
	{
		nowHP = maxHP;
		TimerOnHP = -1;
	}
	else
	{
		nowHP += maxHP * hspeed * delay * 0.00001;
		TimerOnHP = 0;
	}
	var le = 120;
	var h1 = Math.round ((le / maxHP) * nowHP);
	var h2 = le - h1;
	if (nowHP / maxHP < redHP) 
		imag = "img/icon/bk_life_red.gif";
	else if (nowHP / maxHP < yellowHP)
		imag = "img/icon/bk_life_yellow.gif";
	else
		imag = "img/icon/bk_life_green.gif";
	var rhp = Math.round(nowHP) + "/" + maxHP;
	$('#HP').html(	"<table border='0' cellpadding='0' cellspacing='0' width='" + le + "' align='center' style='padding-top: 1px;'><tr>"+
					"<td style='position: absolute; width: " + le + "px; font-size: 9px; color: white; font-weight: bold; margin-top: -3px; padding-left: 5px;' align='left' alt='Уровень жизни'>" + rhp + "</td>"+
					"<td style='width: " + h1 + "px; height: 10px; background: url(" + imag + ") repeat-x;'></td>"+
					"<td style='width: " + h2 + "px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
					"</tr></table>");
	if (TimerOnHP != -1)
		TimerOnHP = setTimeout ('setHPlocal()', delay * 1000);
}

function showMP (now, max, newspeed)
{
	if (max == 0)
		return;
	
	nowMP = now;
	maxMP = max;
	if (TimerOnMP >= 0)
	{
		clearTimeout (TimerOnMP);
		TimerOnMP = -1;
	}
	mspeed = newspeed;
	setMPlocal ();
}

function setMPlocal ()
{
	if (maxMP == 0)
		return;
	
	if (nowMP >= maxMP)
	{
		nowMP = maxMP;
		TimerOnMP = -1
	}
	else
	{
		nowMP += maxMP * mspeed * delay * 0.00001;
		TimerOnMP = 0;
	}
	var le = 120;
	var m1 = Math.round ((le / maxMP) * nowMP);
	var m2 = le - m1;
	var rmp = Math.round(nowMP) + "/" + maxMP;
	$('#MP').html(	"<table border='0' cellpadding='0' cellspacing='0' width='" + le + "' align='center' style='margin-top: -1px;'><tr>"+
					"<td style='position: absolute; width: " + le + "px; font-size: 9px; color: white; font-weight: bold; margin-top: -3px; padding-left: 5px; color: #80FFFF;' align='left' alt='Уровень маны'>" + rmp + "</td>"+
					"<td style='width: " + m1 + "px; height: 10px; background: url(img/icon/blue.gif) repeat-x;'></td>"+
					"<td style='width: " + m2 + "px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
					"</tr></table>");
	if (TimerOnMP != -1)
		TimerOnMP = setTimeout ('setMPlocal()', delay * 1000);
}

function getRandomInt (min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}