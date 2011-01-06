function kmp ()
{
	var x = parseFloat($('#x').val());
	var y = parseFloat($('#y').val());
	$("#hint3").html('<table width="400" cellspacing="1" cellpadding="0" bgcolor="#CCC3AA">'+
					 '<tr><td align="center"><b>Запомнить комплект одежды</b></td>'+
						 '<td width="20" align="right" valign="top" style="cursor: pointer;" onclick="closehint3 ();"><big><b>x</b></big></td>'+
					 '</tr>'+
					 '<tr><td colspan="2">'+
						'<table width="100%" cellspacing="0" cellpadding="5" bgcolor="#FFF6DD">'+
							'<tr><td>Запомнить надетый комплект одежды, для быстрого переодевания. Подробнее об этой функции читайте в разделе <span id="hint" link="invent" class="nick">Подсказка</span>.<br>Введите название комплекта: <input type="text" name="set_name" maxlength="30"></td></tr>'+
							'<tr><td align="center"><input type="submit" value="Запомнить" onclick=\'workSets ("create");\'></td></tr>'+
						'</table>'+
					 '</td></tr></table>')
				.css({'left': x - 200 + 'px', 'top': y - 75 + 'px'}).fadeIn('fast');
	$("[name=savekmp]").focus();
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
  $('html, body').animate({scrollTop: 0}, 500);
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

function increaseItemStat (id, stat)
{
	clearError ();
	$.post('ajax.php', 'do=increaseitemstat&id='+id+'&stat='+stat, function (data){
	  var incs = data.split('A_D');
	  if (incs[0] == 'complete')
	  {
      $("#inc_"+id+"_"+stat+"_val").animate({color: '#00ff00'}, 500, function (){$(this).html('+'+incs[1]).animate({color: '#000000'}, 500);});
      $("#inc_count_"+id).animate({color: '#ff0000'}, 500, function (){$(this).html(incs[2]).animate({color: '#000000'}, 500);});
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
	    $("#spoiler_"+bar).attr({'src': "img/plus.gif", 'alt': "Показать"});
      $("#"+bar+"c").slideUp("slow");
	  }
	  else if (data == 'show')
	  {
      $("#spoiler_"+bar).attr({'src': "img/minus.gif", 'alt': "Скрыть"});
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


function deleteItem (id)
{
  var dropall = ($('input[name=dropall]').is(':checked')) ?1 :0;
	$.post('ajax.php', 'do=deleteitem&id='+id+'&dropall='+dropall, function (data){
    closehint3 ();
	  var item = data.split('A_D');
	  if (item[0] == 'error')
	    showError (item[1]);
	  else if (item[0] == 'complete')
	  {
      var count_items = parseInt($("#count_items").html()) - item[2];
      $("#mass").fadeOut('10000', function (){$(this).html(item[1]).fadeIn('10000');});
      $("#count_items").fadeOut('10000', function (){$(this).html(count_items).fadeIn('10000');});
      if (!dropall)
        $("#item_id_"+id).slideUp('10000', function (){$(this).remove();});
      else if (dropall)
        $("[name=item_entry_"+item[3]+"]").slideUp('10000', function (){$(this).remove();});
	  }
	});
}