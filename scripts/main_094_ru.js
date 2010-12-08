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

function kmp(){
	document.all("hint4").innerHTML = '<table width=400 cellspacing=1 cellpadding=0 bgcolor=CCC3AA><tr><td align=center><B>Запомнить комплект одежды</td><td width=20 align=right valign=top style="cursor: hand" onclick="closehint3();"><BIG><B>x</td></tr><tr><td colspan=2>'+
	'<table width=100% cellspacing=0 cellpadding=5 bgcolor=FFF6DD><tr><form action="/main.pl" method=POST><td>Запомнить надетый комплект одежды, для быстрого переодевания. Подробнее об этой функции читайте в разделе <A HREF="/encicl/help/invent.html" target="help">Подсказка</A>.<BR>'+
	'Введите название комплекта: <INPUT TYPE=text NAME=savekmp maxlength=30></TD></TR><TR><TD align=center><INPUT TYPE=submit value="Запомнить"></TD></TR></FORM></TABLE></td></tr></table>';
	document.all("hint4").style.visibility = "visible";
	document.all("hint4").style.left = 100;
	document.all("hint4").style.top = 100;
	document.all("savekmp").focus();
}

function DrawBar (title, id, flags, link_text, link)
{
	var s = '<table width="100%" border="0" cellspacing="0" cellpadding="1" background="img/back.gif"><tr><td valign="middle">';
	s += '<img class="spoiler" id="'+id+'" width="11" height="9" title="Скрыть" border="0" src="img/minus.gif" style="cursor: pointer;" />';
	s += '</td>';
	s += '<td>&nbsp;</td><td bgcolor="#e2e0e0"><small>&nbsp;<b>'+title+':<b>&nbsp;</small></td>';
	if (link_text)
		s += '<td>&nbsp;</td><td bgcolor="#e2e0e0"><small>&nbsp;<a href="'+link+'">'+link_text+'</a>&nbsp;</small></td>';
	s += '<td align="right" valign="middle" width="100%">';
	if (flags & 1)
		s += '<a href="main.php?action=inv&bar='+id+'&do=up"><img border="0" width="11" height="9" title="Поднять блок наверх" src="img/up.gif" /></a>';
	else
		s += '<img border="0" width="11" height="9" src="img/up-grey.gif">';
	if (flags & 2)
		s += '<a href="main.php?action=inv&bar='+id+'&do=down"><img border="0" width="11" height="9" title="Опустить блок вниз" src="img/down.gif" /></a>';
	else
		s += '<img border="0" width="11" height="9" src="img/down-grey.gif">';
	s += ' </td>';
	s += '</tr></table>';
	document.writeln(s);
}