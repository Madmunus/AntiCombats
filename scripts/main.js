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

function kmp()
{
	var x = parseFloat($('#x').val());
	var y = parseFloat($('#y').val());
	$("#hint3").html('<table width="400" cellspacing="1" cellpadding="0" bgcolor="#CCC3AA">'+
					 '<tr><td align="center"><b>Запомнить комплект одежды</b></td>'+
						 '<td width="20" align="right" valign="top" style="cursor: pointer;" onclick="closehint3 ();"><big><b>x</b></big></td>'+
					 '</tr>'+
					 '<tr><td colspan="2">'+
						'<table width="100%" cellspacing="0" cellpadding="5" bgcolor="#FFF6DD">'+
							'<tr><td>Запомнить надетый комплект одежды, для быстрого переодевания. Подробнее об этой функции читайте в разделе <a href="encicl/help/invent.html" target="_blank" class="nick">Подсказка</a>.<br>Введите название комплекта: <input type="text" name="set_name" maxlength="30"></td></tr>'+
							'<tr><td align="center"><input type="submit" value="Запомнить" onclick=\'workSets ("create");\'></td></tr>'+
						'</table>'+
					 '</td></tr></table>')
				.css({'left': x - 200 + 'px', 'top': y - 75 + 'px'}).fadeIn('fast');
	$("[name=savekmp]").focus();
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

function showInventory (section, type, mail_guid)
{
	clearError ();
	var cur_section = getCookie ('section');
	
	if (cur_section == section && $("#inventory").html() != '')
	  return;
	
	$("#section_"+cur_section+", #section_1").attr('bgcolor', '#d4d2d2');
	$("#section_"+section).attr('bgcolor', '#a5a5a5');
	setCookie ('section', section, getTimePlusHour ());
	$.post('ajax.php', 'do=showinventory&section='+section+'&type='+type+'&mail_guid='+mail_guid, function (data){
	  if (data)
	    $("#inventory").fadeOut('10000', function (){$(this).html(data).fadeIn('10000');});
	});
}

function sortInventory (type)
{
	clearError ();
	window.scrollTo(0,0);
	var num = $("#sort_"+type).attr('name');
	$.post('ajax.php', 'do=sortinventory&type='+type+'&num='+num, function (data){
	  if (data == 'complete')
	  {
	    var section = getCookie ('section');
		num = (num == 1) ?0 :1;
		$.post('ajax.php', 'do=showinventory&section='+section+'&type=inv', function (data){
		  if (data)
			$("#inventory").fadeOut('10000', function (){$(this).html(data).fadeIn('10000');});
		});
		$("#sort_"+type).attr('name', num);
	  }
	});
}

function showShopSection (section_shop)
{
	var level_filter = $("input[name=level_filter]").val();
	var name_filter = $("input[name=name_filter]").val();
	$.post('ajax.php', 'do=showshopsection&section_shop='+section_shop+'&level_filter='+level_filter+'&name_filter='+name_filter, function (data){
	  if (data)
	    $("#section").fadeOut('10000', function (){$(this).html(data).fadeIn('10000');});
	});
}

function shopSection (section_shop)
{
	var cur_section_shop = getCookie ('section_shop');
	if (section_shop)
	{
		$("#section_shop_"+cur_section_shop+", #section_shop_knife").css('backgroundColor', '');
		$("#section_shop_"+section_shop).css('backgroundColor', '#C7C7C7');
		setCookie ('section_shop', section_shop, getTimePlusHour ());
		$.post('ajax.php', 'do=getshoptitle&section_shop='+section_shop, function (data){
		  if (data)
			$("#shop_title").html(data);
		});
	}
	section_shop = getCookie ('section_shop');
	showShopSection (section_shop);
}

function increaseItemStat (id, stat)
{
	clearError ();
	$.post('ajax.php', 'do=increaseitemstat&id='+id+'&stat='+stat, function (data){
	  var incs = data.split('A_D');
	  if (incs[0] == 'complete')
	  {
		$("#inc_"+id+"_"+stat+"_val").animate({color: '#00ff00'}, 500, function (){$(this).html('+'+incs[1]).animate({color: '#000000'}, 500);});
		$("#inc_count").animate({color: '#ff0000'}, 500, function (){$(this).html(incs[2]).animate({color: '#000000'}, 500);});
		if (incs[2] == 0)
		  $("input[type=image]").each(function (){if ($(this).attr('id') == 'inc_'+id+'_btn') $(this).hide();});
	  }
	  else if (incs[0] == 'error')
		showError (incs[1]);
	});
}

function inventoryLoginBank ()
{
	clearError ();
	var credit = $("select[name=credit]").val();
	var pass = $("input[name=pass]").val();
	$.post('ajax.php', 'do=inventoryloginbank&credit='+credit+'&pass='+pass, function (data){
	  closehint3 ();
	  var bank = data.split('A_D');
	  if (bank[0] == 'complete')
	    $("#loginbank").fadeOut('10000', function (){$(this).html(bank[1]).fadeIn('10000');});
	  else if (bank[0] == 'error')
		showError (bank[1]);
	});
}

function inventoryUnLoginBank ()
{
	clearError ();
	$.post('ajax.php', 'do=inventoryunloginbank', function (data){
	  if (data)
	    $("#loginbank").fadeOut('10000', function (){$(this).html(data).fadeIn('10000');});
	});
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

function switchBars (type, bar)
{
	clearError ();
	$.post('ajax.php', 'do=switchbars&bar='+bar+'&type='+type, function (data){
	  var bars = data.split('A_D');
	  if (bars[0] == 'complete')
	  {
		$("#bar_"+bars[1]).fadeOut('10000', function (){$(this).html(bars[4]).fadeIn('10000').attr('id', 'bar_')});
		$("#bar_"+bars[3]).fadeOut('10000', function (){$(this).html(bars[2]).fadeIn('10000').attr('id', 'bar_'+bars[1]);$("#bar_").attr('id', 'bar_'+bars[3]);});
	  }
	});
}

function spoilerBar (bar)
{
	clearError ();
	$.post('ajax.php', 'do=spoilerbar&bar='+bar, function (data){
	  if (data == 'hide')
	  {
	    $("#spoiler_"+bar).attr({'src': "img/plus.gif", 'title': "Показать"});
		$("#"+bar+"c").slideUp("slow");
	  }
	  else if (data == 'show')
	  {
		$("#spoiler_"+bar).attr({'src': "img/minus.gif", 'title': "Скрыть"});
		$("#"+bar+"c").slideDown("slow");
	  }
	});
}

function workSets (type, name)
{
	clearError ();
	if (!name)
	  name = $("input[name=set_name]").val();
	$.post('ajax.php', 'do=worksets&type='+type+'&name='+name, function (data){
	  var set = data.split('A_D');
	  if (type == 'create' && set[0] == 'complete')
	  {
	    closehint3 ();
	    if (!$("div[name="+name+"]").length)
		  $("#allsets").append(set[1]);
	    $("div[name="+name+"]").fadeIn('10000');
	  }
	  else if (type == 'delete' && set[0] == 'complete')
	    $("div[name="+name+"]").fadeOut('10000', function (){$(this).remove();});
	  else if (set[0] == 'error')
	    showError (set[1], name);
	});
}

function buyItem (entry)
{
	var count = ($('input[name=count]').val()) ?$('input[name=count]').val() :1;
	$.post('ajax.php', 'do=buyitem&entry='+entry+'&count='+count, function (data){
	  closehint3 ();
	  var item = data.split('A_D');
	  if (item[0] == 'error')
	    showError (item[1], item[2]);
	  else if (item[0] == 'complete')
	  {
		if (item[3] == 400)
		  $("#money").fadeOut('10000', function (){$(this).html(item[1]).fadeIn('10000');});
		else if (item[3] == 401)
		  $("#money_euro").fadeOut('10000', function (){$(this).html(item[1]).fadeIn('10000');});
		$("#mass").fadeOut('10000', function (){$(this).html(item[2]).fadeIn('10000');});
	    showError (item[3], item[4]);
	  }
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