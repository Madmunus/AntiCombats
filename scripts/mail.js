/* function showInventory(section, type, mail_guid)
{
	clearError ();
	var cur_section = getCookie ('section');
	
	if (cur_section == section && $("#inventory").html() != '')
	  return;
	
	$("#section_"+cur_section+", #section_1").attr('bgcolor', '#d4d2d2');
	$("#section_"+section).attr('bgcolor', '#a5a5a5');
	setCookie('section', section, getTimePlusHour ());
	$.post('ajax.php', 'do=showinventory&section='+section+'&type='+type+'&mail_guid='+mail_guid, function (data){
    var inventory = top.exploder(data);
	  $("#inventory").fadeOut('10000', function (){$(this).html(inventory[0]).fadeIn('10000');});
	});
}

$(function (){
  
}); */