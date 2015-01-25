//-- Смена хитпоинтов
var delay = 3;			// Каждые n сек. увеличение HP и MP на 1%
var redHP = 0.33;		// меньше 30% красный цвет
var yellowHP = 0.66;	// меньше 60% желтый цвет, иначе зеленый
var TimerOnHP = -1;		// id таймера HP
var TimerOnMP = -1;		// id таймера MP
var nowHP, maxHP, nowMP, maxMP, hspeed, mspeed;

function showHP (now, max, newspeed, mini)
{
	nowHP = now;
	maxHP = max;
  hspeed = newspeed;
  
	if (TimerOnHP >= 0)
	{
		clearTimeout(TimerOnHP);
		TimerOnHP = -1;
	}
  
  if (mini)
    setHPmini();
  else
    setHPlocal();
}

function setHPlocal ()
{
  var plusHP = 0;
	if (nowHP == maxHP)
		TimerOnHP = -1;
	else
	{
    plusHP = maxHP * hspeed * 0.00001;
		nowHP += ((plusHP+nowHP) <= maxHP) ?plusHP :maxHP-nowHP;
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
  var alt = 'Уровень жизни'+((plusHP > 0 && (difHP = maxHP-nowHP) > 0) ?'<br>Осталось: '+top.getFormatedTime(Math.round(difHP*delay/(plusHP*10))) :'');
	$('#HP').html("<table border='0' cellpadding='0' cellspacing='0' width='120' align='center' style='padding-top: 1px;'><tr>"+
                "<td style='position: absolute; width: 120px; font-size: 9px; color: white; font-weight: bold; margin-top: -2px; padding-left: 5px;' align='left' alt='"+alt+"'>"+rhp+"</td>"+
                "<td style='width: "+h1+"px; height: 10px; background: url("+imag+") repeat-x;'></td>"+
                "<td style='width: "+h2+"px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
                "</tr></table>");
  updateMmoves('HP', alt);
	if (TimerOnHP != -1)
		TimerOnHP = setTimeout(setHPlocal, delay * 100);
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
	
	if (nowMP == maxMP)
		TimerOnMP = -1
	else
	{
    plusMP = maxMP * mspeed * 0.00001;
		nowMP += ((plusMP+nowMP) <= maxMP) ?plusMP :maxMP-nowMP;
		TimerOnMP = 0;
	}
	var le = 120;
	var m1 = Math.round((le / maxMP) * nowMP);
	var m2 = le - m1;
	var rmp = Math.round(nowMP) + "/" + maxMP;
  var alt = 'Уровень маны'+((plusMP > 0 && (difMP = maxMP-nowMP) > 0) ?'<br>Осталось: '+top.getFormatedTime(Math.round(difMP*delay/(plusMP*10))) :'')
	$('#MP').html("<table border='0' cellpadding='0' cellspacing='0' width='"+le+"' align='center' style='margin-top: -1px;'><tr>"+
                "<td style='position: absolute; width: "+le+"px; font-size: 9px; color: white; font-weight: bold; margin-top: -2px; padding-left: 5px; color: #80FFFF;' align='left' alt='"+alt+"'>"+rmp+"</td>"+
                "<td style='width: "+m1+"px; height: 10px; background: url(img/icon/blue.gif) repeat-x;'></td>"+
                "<td style='width: "+m2+"px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
                "</tr></table>");
  updateMmoves('MP', alt);
	if (TimerOnMP != -1)
		TimerOnMP = setTimeout(setMPlocal, delay * 100);
}

function setHPmini ()
{
  var plusHP = 0;
	if (nowHP == maxHP)
		TimerOnHP = -1;
	else
	{
    plusHP = maxHP * hspeed * 0.00001;
		nowHP += ((plusHP+nowHP) <= maxHP) ?plusHP :maxHP-nowHP;
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
  var alt = 'Уровень жизни'+((plusHP > 0 && (difHP = maxHP-nowHP) > 0) ?'<br>Осталось: '+top.getFormatedTime(Math.round(difHP*delay/(plusHP*10))) :'');
	$('#HP').html(" <span style='font-size: 10px; cursor: default;' alt='"+alt+"'>"+rhp+"</span> <table border='0' cellpadding='0' cellspacing='0' width='120' style='display: inline; vertical-align: middle;'><tr>"+
                "<td style='width: "+h1+"px; height: 10px; background: url("+imag+") repeat-x;'></td>"+
                "<td style='width: "+h2+"px; height: 10px; background: url(img/icon/bk_life_loose.gif) repeat-x;'></td>"+
                "</tr></table>");
  updateMmoves('HP', alt);
	if (TimerOnHP != -1)
		TimerOnHP = setTimeout(setHPmini, delay * 100);
}

var pos = {};

$(function (){
  $(document).on('mousemove', function (e){
    pos.x = e.pageX - $(window).scrollLeft();
    pos.y = e.pageY - $(window).scrollTop();
  });
});