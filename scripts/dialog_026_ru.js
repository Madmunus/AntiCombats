var Hint3Name = '';

var step = 0;
function errmess(s)
{
  messid.innerHTML='<B>'+s+'</B>';
  highlight();
}
function highlight()
{
  if (step) return(0);
  step=10;
  setTimeout(dohi,50);
}

function dohi()
{
  var hx=new Array(0,1,2,3,4,5,6,7,8,9,"A","B","C","D","E","F");
  step--;
  messid.style.color="#"+hx[Math.floor(15-step/2)]+((step&1)?"F":"8")+"0000";
  if (step>0) setTimeout(dohi,50);
}

function fixspaces(s)
{
  while (s.substr(s.length-1,s.length)==" ") s=s.substr(0,s.length-1);
  while (s.substr(0,1)==" ") s=s.substr(1,s.length);
  return(s);
}

// Заголовок, название скрипта, имя поля с логином
function findlogin (title, script, name, defaultlogin, mtype, addon, need_defend)
{
	var s;

	if (need_defend && defend == false)
		defend = -1;
	if (need_defend)
	{
		addon+="<INPUT type=hidden name='mdefend' value='"+defend+"'>";
		addon+="<INPUT type=hidden name='enemy' value='"+enemy+"'>";
		addon+="<INPUT type=hidden name='myid' value='"+myid+"'>";
	}

	s = '<table border=0 width=100% cellspacing="0" cellpadding="2"><tr><form action="'+script+'" method=POST name=slform><td colspan=2>'+
		'Укажите логин персонажа:<small><BR>(можно щелкнуть по логину в чате)</TD></TR><TR><TD width=50% align=right style="padding-left:5"><INPUT style="width: 100%" TYPE="text" NAME="'+name+'" value="'+defaultlogin+'"></TD><TD width=50%><INPUT type=image SRC="#IMGSRC#" WIDTH="27" HEIGHT="20" BORDER=0 ALT="" onclick="slform.'+name+'.value=fixspaces(slform.'+name+'.value);">'+(addon?addon:'')+'</TD></TR></FORM></TABLE>';
	s = crtmagic (mtype, title, s);

	document.all("hint4").innerHTML = s;
	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.zIndex = 200;
	document.all("hint4").style.top = document.body.scrollTop+50;
	document.all(name).focus();
	Hint3Name = name;
}

// Заголовок, название скрипта, имя поля с логином

function bank_info() {
	alert('У Вас нет активных счетов. \n\n На правах рекламы: Вы можете открыть счёт в Банке БК,'+
		' на Страшилкиной улице*\n\n* Мелким шрифтом: услуга платная.');
}

function bank_blocked(tm) {
	var s = 'Ваши счета заблокированы (ещё '+ tm + ').';
	alert(s);
}

function get_bank_pwd(){

}

function b_confirm(script, txt, mtype, addon, need_defend) {

	if (need_defend && defend==false)    {
		defend=-1
//		errmess("Блок не выбран.");	return false;
	}

	if (need_defend) {
		addon+="<INPUT type=hidden name='mdefend' value='"+defend+"'>";
		addon+="<INPUT type=hidden name='enemy' value='"+enemy+"'>";
		addon+="<INPUT type=hidden name='myid' value='"+myid+"'>";
	}

	dialogconfirm('Подтверждение', '/battle.pl', '<TABLE width=100%><TD><B>'+txt+'</B><BR>Использовать сейчас?</TABLE>'+addon, mtype);
}


function dialogconfirm(title, script, text, mtype) {
	var s;

	s='<table border=0 width=100% cellspacing="0" cellpadding="2"><tr><form action="'+script+'" method=POST name=slform><td colspan=2>'+
	text+'</TD></TR><TR><TD width=50% align=left><INPUT TYPE="submit" name="tmpname423" value="Да" style="width:70%"></TD><TD width=50% align=right><INPUT type=button style="width:70%" value="Нет" onclick="closehint3();"></TD></TR></FORM></TABLE>';

	s = crtmagic(mtype, title, s);
	document.all("hint4").innerHTML = s;

	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.zIndex = 200;
	document.all("hint4").style.top = document.body.scrollTop+50;
	document.all("tmpname423").focus();
	Hint3Name = name;
}

function dialogOK(title, text, mtype) {
	var s;

	s='<table border=0 width=100% cellspacing="0" cellpadding="2"><tr><td colspan=2>'+
	text+'</TD></TR><TR><TD width=100% align=right><INPUT type=button style="width:70%" value="Закрыть" onclick="closehint3();"></TD></TR></FORM></TABLE>';

	s = crtmagic(mtype, title, s);
	document.all("hint4").innerHTML = s;
	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.zIndex = 200;
	document.all("hint4").style.top = document.body.scrollTop+50;
	Hint3Name = name;
}


function foundmagictype (mtypes) {
	if (mtypes) {
		mtypes=mtypes+"";
		if (mtypes.indexOf(',') == -1) return parseInt(mtypes);
		var s=mtypes.split(',');
		var found=0;
		var doubl=0;
		var maxfound=0;

		for (i=0; i < s.length; i++) {
			var k=parseInt(s[i]);
			if (k > maxfound) {
				found=i + 1;
				maxfound=k;
				doubl=0;
			} else {
				if (k == maxfound) {doubl=1;}
			}
		}
		if (doubl) {return 0};

		return found;
	}
	return 0;
}
// Для магии. Заголовок, название скрипта, название магии, номер вещицы в рюкзаке, логин по умолчанию, описание доп. поля
function magicklogin(title, script, magickname, n, defaultlogin, extparam, mtype) {

	var s = '<table border=0 width=100% cellspacing="0" cellpadding="2"><tr><form action="'+script+'" method=POST name=slform><input type=hidden name="use" value="'+magickname+'"><input type=hidden name="n" value="'+n+'"><td colspan=2>'+
	'Укажите логин персонажа:<small><BR>(можно щелкнуть по логину в чате)</TD></TR><TR><TD style="padding-left:5" width=50% align=right><INPUT TYPE="text" NAME="param" value="'+defaultlogin+'" style="width: 100%"></TD><TD width=50%><INPUT type=image SRC="#IMGSRC#" WIDTH="27" HEIGHT="20" BORDER=0 ALT="" onclick="slform.param.value=fixspaces(slform.param.value);"></TD></TR>';
	if (extparam != null && extparam != '') {
		s = s + '<TR><td style="padding-left:5">'+extparam+'<BR><INPUT style="width: 100%" TYPE="text" NAME="param2"></TD><TD></TR>';
	}
	s = s + '</FORM></TABLE>';
	s = crtmagic(mtype, title, s);
	document.all("hint4").innerHTML = s;
	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.zIndex = 200;
	document.all("hint4").style.top = document.body.scrollTop+50;
	document.all("param").focus();
	Hint3Name = 'param';
}

// Магия
function UseMagick(title, script, name, extparam, n, extparam2, mtype) {
   if ((extparam != null)&&(extparam != '')) {

	var t1='text',t2='text';

	if (extparam.substr(0,1) == "!")
	{
		t1='password';
		extparam=extparam.substr(1,extparam.length);
	}

	var s = '<table border=0 width=100% cellspacing="1" cellpadding="0"><TR><form action="'+script+'" method=POST name=slform><input type=hidden name="use" value="'+name+'"><input type=hidden name="n" value="'+n+'"><td colspan=2 align=left><NOBR><SMALL>'+
	extparam + ':</NOBR></TD></TR><TR><TD width=100% align=left style="padding-left:5"><INPUT tabindex=1 style="width: 100%" TYPE="'+t1+'" id="param" NAME="param" value=""></TD><TD width=10%><INPUT type=image SRC="#IMGSRC#" WIDTH="27" HEIGHT="20" BORDER=0 ALT="" tabindex=3></TD></TR>';
	if (extparam2 != null && extparam2 != '') {
		if (extparam2.substr(0,1) == "!")
		{
			t2='password';
			extparam2=extparam2.substr(1,extparam2.length);
		}
		s = s + '<TR><td colspan=2><NOBR><SMALL>'+extparam2+':</NOBR><TR style="padding-left:5"><TD><INPUT tabindex=2 TYPE="'+t2+'" NAME="param2" style="width: 50%"></TD><TD></TR>';
	}
	s += '</FORM></TABLE>';
	s = crtmagic(mtype, title, s);
	document.all("hint4").innerHTML = s;
	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.zIndex = 200;
	document.all("hint4").style.top = document.body.scrollTop+50;
	document.all("param").focus();
	Hint3Name = 'param';
   } else {
		dialogconfirm('Подтверждение', script, '<TABLE width=100%><TD><IMG src="i/items/'+name+'.gif"></TD><TD>Использовать сейчас?</TABLE>'+
		'<input type=hidden name="use" value="'+name+'"><input type=hidden name="n" value="'+n+'">', mtype);
   }
}

// Закрывает окно ввода логина
function closehint3()
{
	document.all("hint4").style.visibility="hidden";
    Hint3Name='';
}

// Для боевой магии. Заголовок, название магии, номер вещицы в рюкзаке
function Bmagicklogin (title, magickname, n, defaultlogin, extparam, mtype) {
	if (defend==false) {
		defend=-1;
//		errmess("Блок не выбран.");	return false;
	}

	var s = '<table border=0 width=100% cellspacing="0" cellpadding="2"><tr><form action="/battle.pl" method=POST name="bmagic" onsubmit="bmagic.mdefend.value=defend;"><input type=hidden name="use" value="'+magickname+'"><input type=hidden name="n" value="'+n+'"><input type=hidden name="mdefend" value="'+defend+'"><input type=hidden name="enemy" value="'+enemy+'"><input type=hidden name="myid" value="'+myid+'"><td colspan=2 align=left>'+
	'Укажите логин персонажа:<small><BR>(можно щелкнуть по логину в чате)</TD></TR><TR><TD width=50% align=right><INPUT style="width: 100%" TYPE="text" id="param" NAME="param" value="'+defaultlogin+'"></TD><TD width=50%><INPUT type=image SRC="#IMGSRC#" WIDTH="27" HEIGHT="20" BORDER=0 ALT="" onclick="bmagic.param.value=fixspaces(bmagic.param.value);"></TD></TR>';
	if (extparam != null && extparam != '') {
		s = s + '<TR><td colspan=2>'+extparam+'<TR><TD style="padding-left:5"><INPUT style="width: 100%" TYPE="text" NAME="param2"><TD></TD></TR>';
	}
	s = s + '</FORM></TABLE>';
	s = crtmagic(mtype, title, s);

	document.all("hint4").innerHTML= s;
	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.zIndex = 200;
	document.all("hint4").style.top = 60;
	document.all("param").focus();
	Hint3Name = 'param';
}

// Магия
function BUseMagick(name, extparam, n, mtype) {
	if (defend==false)    {
		defend=-1;
//		errmess("Блок не выбран.");	return false;
	}

	if ((extparam != null)&&(extparam != '')) {
		var s = prompt(extparam+':', '');
		if ((s != null)&&(s != '')) {
			re = /\%/g; s=s.replace(re, "%25");
			re = /\+/g; s=s.replace(re, "%2B");
			re = /\#/g; s=s.replace(re, "%23");
			re = /\?/g; s=s.replace(re, "%3F");
			re = /\&/g; s=s.replace(re, "%26");
			window.location.href='/battle.pl?use='+name+'&param='+s+'&n='+n+'&mdefend='+defend+'&enemy='+enemy+'&myid='+myid;
		}
	} else {
		dialogconfirm('Подтверждение', '/battle.pl', '<TABLE width=100%><TD><IMG src="i/items/'+name+'.gif"></TD><TD>Использовать сейчас?</TABLE>'+
		'<input type=hidden name="use" value="'+name+'"><input type=hidden name="n" value="'+n+'"><input type=hidden name="mdefend" value="'+defend+'"><input type=hidden name="enemy" value="'+enemy+'"><input type=hidden name="myid" value="'+myid+'">', mtype);
	}
}

function foundmagictype (mtypes)
{
	if (mtypes) {
		mtypes=mtypes+"";
		if (mtypes.indexOf(',') == -1) return parseInt(mtypes);
		var s=mtypes.split(',');
		var found=0;
		var doubl=0;
		var maxfound=0;

		for (i=0; i < s.length; i++) {
			var k=parseInt(s[i]);
			if (k > maxfound) {
				found=i + 1;
				maxfound=k;
				doubl=0;
			} else {
				if (k == maxfound) {doubl=1;}
			}
		}
		if (doubl) {return 0};

		return found;
	}
	return 0;
}

function crtmagic (mtype, title, body, subm)
{
	mtype = foundmagictype(mtype);

var names=new Array(
'neitral',17, 6, 14, 17, 14, 7,0,0, 3,
'fire', 57, 30, 33, 20, 21, 14, 11, 12, 0,
'water', 57, 30, 33, 20, 21, 14, 11, 12, 0,
'air', 57, 30, 33, 20, 21, 14, 11, 12, 0,
'earth', 57,30, 33, 20, 21, 14, 11, 12, 0,
'white', 51, 25, 46, 44, 44, 10, 5, 5, 0,
'gray', 51, 25, 46, 44, 44, 10, 5, 5, 0,
'black', 51, 25, 46, 44, 44, 10, 5, 5, 0);
var colors=new Array('B1A993','DDD5BF', 'ACA396','D3CEC8', '96B0C6', 'BDCDDB', 'AEC0C9', 'CFE1EA', 'AAA291', 'D5CDBC', 'BCBBB6', 'EFEEE9', '969592', 'DADADA', '72726B', 'A6A6A0');

while (body.indexOf('#IMGSRC#')>=0) body = body.replace('#IMGSRC#', 'i/misc/dmagic/'+names[mtype*10]+'_30.gif');
var s='<table width="270" border="0" align="center" cellpadding="0" cellspacing="0">'+
	'<tr>'+
	'<td width="100%">'+
	'<table width="100%"  border="0" cellspacing="0" cellpadding="0">'+
	'<tr><td>'+
		'<table width="100%" border="0" cellpadding="0" cellspacing="0">'+
		'<tr>'+
		'<td width="'+names[mtype*10+1]+'" align="left"><img src="i/misc/dmagic/b'+names[mtype*10]+'_03.gif" width="'+names[mtype*10+1]+'" height="'+names[mtype*10+2]+'"></td>'+
		'<td width="100%" align="right" background="i/misc/dmagic/b'+names[mtype*10]+'_05.gif"></td>'+
		'<td width="'+names[mtype*10+3]+'" align="right"><img src="i/misc/dmagic/b'+names[mtype*10]+'_07.gif" width="'+names[mtype*10+3]+'" height="'+names[mtype*10+2]+'"></td>'+
		'</tr>'+
		'</table></td>'+
	'</tr>'+
	'<tr><td>'+
		'<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
		'<tr>'+
			(names[mtype*10+7]?'<td width="'+names[mtype*10+7]+'"><SPAN style="width:'+names[mtype*10+7]+'">&nbsp;</SPAN></td>':'')+
			'<td width="5" background="i/misc/dmagic/b'+names[mtype*10]+'_17.gif">&nbsp;</td>'+
			'<td width="100%">'+
			'<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
			'<tr><td bgcolor="#'+colors[mtype*2]+'"'+(names[mtype*10+9]?' style="padding-top: '+names[mtype*10+9]+'"':'')+' >'+
			'<table border=0 width=100% cellspacing="0" cellpadding="0"><td style="padding-left: 20" align=center><B>'+title+
			'</td><td width=20 align=right valign=top style="cursor: hand" onclick="closehint3();" style=\'filter:Gray()\' onmouseover="this.filters.Gray.Enabled=false" onmouseout="this.filters.Gray.Enabled=true"><IMG src="i/clear.gif" width=13 height=13>&nbsp;</td></table>'+
			'</td></tr>'+
			'<tr>'+
				'<td align="center" bgcolor="#'+colors[mtype*2+1]+'">'+body+
			'</tr>'+
			'</table></td>'+
			'<td width="5" background="i/misc/dmagic/b'+names[mtype*10]+'_19.gif">&nbsp;</td>'+
			(names[mtype*10+8]?'<td width="'+names[mtype*10+8]+'"><SPAN style="width:'+names[mtype*10+8]+'">&nbsp;</SPAN></td></td>':'')+
			'</tr>'+
		'</table></td>'+
	'</tr>'+
	'<tr><td>'+
		'<table width="100%"  border="0" cellpadding="0" cellspacing="0">'+
		'<tr>'+
			'<td width="'+names[mtype*10+4]+'" align="left"><img src="i/misc/dmagic/b'+names[mtype*10]+'_27.gif" width="'+names[mtype*10+4]+'" height="'+names[mtype*10+6]+'"></td>'+
			'<td width="100%" align="right" background="i/misc/dmagic/b'+names[mtype*10]+'_29.gif"></td>'+
			'<td width="'+names[mtype*10+5]+'" align="right"><img src="i/misc/dmagic/b'+names[mtype*10]+'_31.gif" width="'+names[mtype*10+5]+'" height="'+names[mtype*10+6]+'"></td>'+
		'</tr>'+
		'</table></td>'+
	'</tr>'+
	'</table></td>'+
'</tr>'+
'</table>';

	return s;
}