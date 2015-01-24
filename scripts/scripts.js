function getFormatedTime (time)
{
  if (!time)
    return 0;
  
  var m = parseInt(time / 60);
  time %= 60;
  var s = time;
  if (m == 0) return s+' cек.';
  else        return m+' мин. '+s+' cек.';
}

function strip_sc (str)
{
  str = str.replace(/^\s+/, '');
  str = str.replace(/\s*,\s*/g, ',');
  str = str.substr(0, str.length - 1);
  return str;
}

function trim (str)
{
  str = str.replace(/^\s*/, '');
  str = str.replace(/\s*$/, '');
  return str;
}

function AddTo (login, bPrivate)
{
  var c = frames.main.Hint3Name;
  if (c != null && c != "")
  {
    $('#'+c+', [name='+c+']', main.document).val(login).focus();
    return;
  }
  var txt = $('#text', talk.document).val();
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
  $('#text', talk.document).val(txt).focus();
}

function AddToPrivate (login)
{
  var s = $('#text', talk.document).val();
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
  $('#text', talk.document).val(s).focus();
}

function linkAction (action)
{
  frames.main.location.href = "main.php?action="+action;
}

function exploder (data)
{
  if (data == '' || data == 'ajax_error')
    location.href = 'index.php';
  
  var variable = data.split('$$');
  
  return variable;
}

function checkGame ()
{
  var link = location.href.split("/");
  if (link[link.length - 1] != 'game.php')
    location.href = 'index.php';
  try
  {
    var gframes = new Array($('[name=msg]').attr('src'), $('[name=user]').attr('src'), $('[name=talk]').attr('src'));
    if (gframes[0] != 'msg.php' || gframes[1] != 'users.php' || gframes[2] != 'talk.php')
      location.href = 'index.php';
  }
  catch(e){location.href = 'index.php';}
}

function cleanChat ()
{
  $('#mes', msg.document).html('');
}

function exit ()
{
  frames.main.dialogconfirm('Подтверждение', "top.linkAction('exit')", '<center>Вы уверены что хотите выйти из игры?</center>', 0);
}

var time_to_go = 0;
var city = '';