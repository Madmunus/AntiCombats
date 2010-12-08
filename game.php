<html>
<head>
<link rel="SHORTCUT ICON" href="img/favicon.ico" />
<title>Анти Бойцовский Клуб</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="ru" />
<script src="scripts/jquery-1.4.3.js" type="text/javascript"></script>
<script type="text/javascript">
function strip_sc (str)
{
	str = str.replace (/^\s+/, '');
	str = str.replace (/\s*,\s*/g, ',');
	str = str.substr (0, str.length - 1);
	return str;
}

function trim (str)
{
	str = str.replace (/^\s*/, '');
	str = str.replace (/\s*$/, '');
	return str;
}

function AddTo (login, bPrivate)
{
	var c = frames.main.Hint3Name;
	if (c != null && c != "")
	{
		frames.main.document.all(c).value = login;
		frames.main.document.all(c).focus();
		return;
	}
	var txt = talk.document.talker.phrase.value;
	var txtreg = txt;
	var to = '';
	var private = '';
	var reg1 = new RegExp("(private|to)\\s*\\[(.+?)\\]", "");
	while (res = txtreg.match(reg1))
	{
		action = res[1];
		pr = res[2];
		txtreg = txtreg.replace (reg1, '');
		if (action == 'private')
		{
			pr_ar = pr.split(/,/);
			for (i = 0; i < pr_ar.length; i++)
			{
				pr_ar[i] = trim(pr_ar[i]);
				var slogin = pr_ar[i].replace (/([\^.*{}$%?\[\]+|\/\(\)])/g, "\\$1");
				prReg = new RegExp (slogin+",", "");
				if (!private.match(prReg))
					private += pr_ar[i]+',';
			}
		}
		if (action == 'to')
		{
			pr_ar = pr.split(/,/)
			for (i = 0; i < pr_ar.length; i++)
			{
				pr_ar[i] = trim(pr_ar[i]);
				var slogin = pr_ar[i].replace(/([\^.*{}$%?\[\]+|\/\(\)])/g, "\\$1");
				prReg = new RegExp(slogin+",", "");
				if (!to.match(prReg))
					to += pr_ar[i]+',';
			}
		}
	}
	to = strip_sc (to);
	private = strip_sc (private);
	var to_str = ','+to+',';
	var private_str = ','+private+',';
	if (private)
		private = 'private ['+private+'] ';
	if (to)
		to = 'to ['+to+'] ';
	txtreg = txtreg.replace (/^\s+/, '');
	txt = private + to + txtreg;
	var ntxt = 'to ['+login+']';
	var i = txt.indexOf (ntxt);
	if (i != -1)
		txt = txt.substr (0, i) + 'private ['+login+'] '+ txt.substr (i+ntxt.length, txt.length);
	else
	{
		var ntxt2 = 'private ['+login+']';
		i = txt.indexOf (ntxt2);
		if (i != -1)
			txt = txt.substr (0, i) + 'to ['+login+'] '+ txt.substr (i+ntxt2.length, txt.length);
		else
		{
			var slogin = login.replace (/([\^.*{}$%?\[\]+|\/\(\)])/g, "\\$1");
			reg = new RegExp (","+slogin+",", "");
			flag = 0;
			if (!private_str.match(reg) && txt.match(/private\s*\[.*\]/))
			{
				txt = txt.replace (/private\s*\[(.+)\]/, "private ["+login+",$1]");
				flag = 1;
			}
			if (!to_str.match(reg) && txt.match(/to\s*\[.*\]/))
			{
				txt = txt.replace (/to\s*\[(.+)\]/, "to ["+login+",$1]");
				flag = 1;
			}
			if (flag == 0 && !txt.match (/(to|private)\s*\[.*\]/))
				txt = (( bPrivate ) ?'private ['+login+'] ' :'to ['+login+'] ') + txt;
		}
	}
	talk.document.talker.phrase.value = txt;
	talk.document.talker.phrase.focus();
}

function AddToPrivate (login)
{
	var s = talk.document.talker.phrase.value;
	var reg2 = new RegExp ("private(\\s*)\\[(.*?)\\]", "");
	var cs = s.replace (reg2, "private$1[,$2,]");
	var slogin = login.replace (/([\^.*{}$%?\[\]+|\/\(\)])/g, "\\$1");
	var reg = new RegExp ("private\\s*\\[.*,\\s*"+slogin+"\\s*,.*\\]", "");
	var result = '';
	var reg3 = new RegExp ("private\\s*\\[(.*?)\\]", "");
	while (res = s.match(reg3))
	{
		result += res[1]+',';
		s = s.replace (reg3, '');
	}
	result = result.replace (/,$/, '');
	var prar = result.split (',');
	for (i = 0; i < prar.length; i++)
	{
		prar[i] = prar[i].replace (/^\s+/, '');
		prar[i] = prar[i].replace (/\s+$/, '');
	}
	var str = prar.join (', ');
	if (str)
		login += ', ';
	space = ''
	if (!s.match(/^\s+/))
		space = ' ';
	if (!cs.match(reg))
		s = 'private ['+login+str+']' + space + s;
	else
		s = 'private ['+str+']' + space + s;
	talk.document.talker.phrase.value = s;
	talk.document.talker.phrase.focus();
}

$(document).ready(function (){
	$('[name=menu]').attr('src', 'topp.php');
	$('[name=main]').attr('src', 'main.php?action=enter');
	$('[name=msg]').attr('src', 'msg.php');
	$('[name=user]').attr('src', 'users.php');
	$('[name=talk]').attr('src', 'talk.php');
	$('[name=ref]').attr('src', 'refresh.php');
	$('[name=null]').attr('src', 'null.php');
});

$(window).unload(function() {
  $('[name=main]').attr('src', 'main.php?action=exit');
});
</script>
</head>
	<frameset rows="35, *, 30, 5" frameborder="0" border="0" framespacing="0">
		<frame name="menu" src="" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
		<frameset cols="9, *, 9" frameborder="0" border="0" framespacing="0">
			<frame src="left.html" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
			<frameset rows="52%, *" frameborder="1" border="3">
				<frame name="main" src="" />
				<frameset cols="*, 220">
					<frame name="msg" src="" target="_top" scrolling="auto" frameborder="1" border="0" framespacing="0" marginwidth="3" marginheight="3" />
					<frame name="user" src="" target="_blank" scrolling="auto" frameborder="0" border="0" framespacing="0" marginwidth="3" marginheight="0" />
				</frameset>
				<frame name="ref" src="" target="_top" scrolling="no" noresize frameborder="0" border="0" />
			</frameset>
			<frame src="right.html" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
		</frameset>
		<frame name="talk" src="" scrolling="no" noresize />
		<frame src="bottom.html" target="_top" scrolling="no" noresize frameborder="0" border="0" framespacing="0" marginwidth="0" marginheight="0" />
		<frame name="null" src="" scrolling="no" noresize />
	</frameset>
</html>