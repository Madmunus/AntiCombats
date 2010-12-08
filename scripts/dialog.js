var Hint3Name = '';

function fixspaces (s)
{
	while (s.substr(s.length - 1, s.length) == " ")
		s = s.substr(0, s.length - 1);
	while (s.substr(0,1) == " ")
		s = s.substr(1, s.length);
	return (s);
}

function bank_open (ac_list, name)
{
	var x = parseFloat($('#x').val());
	var y = parseFloat($('#y').val());
	var ac = ac_list.split(',');
	var s;
	var opt = '<select name="credit" size="0" style="width: 100px;">';
	for (var i = 0; i < ac.length; i++)
	{
		opt += '<option value="' + ac[i] + '"' +((i == 0)?' selected' :'')+ '>'+ ac[i] + '</option>';
	}
	opt += '</select>';	
	s = '<table border="0" width="100%" cellspacing="0" cellpadding="2" >'+
		'<tr><td colspan="2" align="center">Выберите счёт и введите пароль</td></tr>' +
		'<tr>'+
			'<td style="padding-left: 5px; text-align: right;">' + opt+ '&nbsp;<input style="width: 100px;" type="password" name="pass" size="12" maxlength="30"></td>' +
			'<td><input type="image" src="#IMGSRC#" width="27" height="20" border="0" onclick="inventoryLoginBank ();"></td>'+
		'</tr>'+
		'</table>';
	s = crtmagic ('', 'Счёт в банке', s, '');
	if (!name)
		name = "hint3";

	$('#'+name).html(s).css({'left': x - 135 + "px", 'top': y - 30 + "px", 'zIndex': '101'}).fadeIn('fast');
	$('[name=credit]').focus();
	Hint3Name = 'credit';
}

function findlogin (title, script, name, defaultlogin, mtype, addon, noclose)
{
	var s;
	s = '<form action="'+script+'" method="get" name="slform" style="display: inline;">' +
		'<table border="0" width="100%" cellspacing="0" cellpadding="2"><tr>' +
		'<td colspan="2">Укажите логин персонажа:<small><br>(можно щелкнуть по логину в чате)</td></tr>'+
		'<tr><td width="50%" align="right" style="padding-left: 5px;"><input style="width: 100%" type="text" name="'+name+'" value="'+defaultlogin+'"></td>' +
		'<td width="50%"><input type=image src="#IMGSRC#" width="27" height="20" border="0" onclick="slform.'+name+'.value = fixspaces (slform.'+name+'.value);">'+(addon ?addon :'')+'</td></tr></table></form>';
	s = crtmagic (mtype, title, s, noclose);

	$('#hint3').html(s).css({'left': 100, 'top': document.body.scrollTop + 50, 'zIndex': 200}).fadeIn('fast');
	$('[name='+name+']').focus();
	Hint3Name = name;
}

function foundmagictype (mtypes)
{
	if (mtypes)
	{
		mtypes = mtypes + "";
		if (mtypes.indexOf(',') == -1) return parseInt(mtypes);
		var s = mtypes.split(',');
		var found = 0;
		var doubl = 0;
		var maxfound = 0;
		for (i = 0; i < s.length; i++)
		{
			var k = parseInt(s[i]);
			if (k > maxfound)
			{
				found = i + 1;
				maxfound = k;
				doubl = 0;
			}
			else
				if (k == maxfound)
					doubl = 1;
		}
		if (doubl)
			return 0;
		return found;
	}
	return 0;
}

function crtmagic (mtype, title, body, noclose)
{
	var mtype = foundmagictype (mtype);
	var names = new Array (
	'neitral', 17, 6, 14, 17, 14, 7, 0, 0, 3,
	'fire', 57, 30, 33, 20, 21, 14, 11, 12, 0,
	'water', 57, 30, 33, 20, 21, 14, 11, 12, 0,
	'air', 57, 30, 33, 20, 21, 14, 11, 12, 0,
	'earth', 57,30, 33, 20, 21, 14, 11, 12, 0,
	'white', 51, 25, 46, 44, 44, 10, 5, 5, 0,
	'gray', 51, 25, 46, 44, 44, 10, 5, 5, 0,
	'black', 51, 25, 46, 44, 44, 10, 5, 5, 0);
	var colors = new Array ('B1A993','DDD5BF', 'ACA396','D3CEC8', '96B0C6', 'BDCDDB', 'AEC0C9', 'CFE1EA', 'AAA291', 'D5CDBC', 'BCBBB6', 'EFEEE9', '969592', 'DADADA', '72726B', 'A6A6A0');

	while (body.indexOf ('#IMGSRC#') >= 0)
		body = body.replace ('#IMGSRC#', 'i/misc/dmagic/'+names[mtype*10]+'_30.gif');
	var s = 
	'<table width="270" border="0" align="center" cellpadding="0" cellspacing="0">'+
	'<tr>'+
	'<td width="100%">'+
		'<table width="100%" border="0" cellspacing="0" cellpadding="0">'+
			'<tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>'+
				'<td width="'+names[mtype*10+1]+'" align="left"><img src="i/misc/dmagic/b'+names[mtype*10]+'_03.gif" width="'+names[mtype*10+1]+'" height="'+names[mtype*10+2]+'"></td>'+
				'<td width="100%" background="i/misc/dmagic/b'+names[mtype*10]+'_05.gif"></td>'+
				'<td width="'+names[mtype*10+3]+'" align="right"><img src="i/misc/dmagic/b'+names[mtype*10]+'_07.gif" width="'+names[mtype*10+3]+'" height="'+names[mtype*10+2]+'"></td>'+
			'</tr></table></td></tr>'+
			'<tr>'+
				'<td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>'+
					(names[mtype*10+7] ?'<td width="'+names[mtype*10+7]+'"><span style="width: '+names[mtype*10+7]+'">&nbsp;</span></td>' :'')+
					'<td width="5" background="i/misc/dmagic/b'+names[mtype*10]+'_19.gif">&nbsp;</td>'+
					'<td width="100%" bgcolor="#'+colors[mtype*2]+'"' + (names[mtype*10+9] ?' style="padding-top: '+names[mtype*10+9]+'px;"' :'') + '>'+
						'<table border="0" width="100%" cellspacing="0" cellpadding="0">'+
							'<td align="center"><b>'+title+'</b></td>'+
							'<td width="20" align="right" valign="top">' + (noclose ?'' :'<img src="i/clearg.gif" width="13" height="13" style="cursor: pointer;" onclick="closehint3 ();">') + '&nbsp;</td>'+
						'</table>'+
						'<div align="center" style="background-color:#'+colors[mtype*2+1]+';">'+body+'</div>'+
					'</td>'+
					'<td width="5" background="i/misc/dmagic/b'+names[mtype*10]+'_17.gif">&nbsp;</td>'+
					(names[mtype*10+8] ?'<td width="'+names[mtype*10+8]+'"><span style="width:'+names[mtype*10+8]+'px;">&nbsp;</span></td></td>' :'')+
				'</tr></table></td>'+
			'</tr>'+
			'<tr><td><table width="100%"  border="0" cellpadding="0" cellspacing="0"><tr>'+
				'<td width="'+names[mtype*10+4]+'" align="left"><img src="i/misc/dmagic/b'+names[mtype*10]+'_27.gif" width="'+names[mtype*10+4]+'" height="'+names[mtype*10+6]+'"></td>'+
				'<td width="100%" background="i/misc/dmagic/b'+names[mtype*10]+'_29.gif"></td>'+
				'<td width="'+names[mtype*10+5]+'" align="right"><img src="i/misc/dmagic/b'+names[mtype*10]+'_31.gif" width="'+names[mtype*10+5]+'" height="'+names[mtype*10+6]+'"></td>'+
			'</tr></table></td></tr>'+
		'</table>'+
	'</td>'+
	'</tr>'+
	'</table>';
	return s;
}

// Закрывает окно ввода логина
function closehint3 ()
{
	$('#hint3').fadeOut('fast', function (){$(this).html('');});
    Hint3Name = '';
}