function showShopSection (section_shop)
{
  var level_filter = $("input[name=level_filter]").val();
  var name_filter = $("input[name=name_filter]").val();
  $("#loadbar").show();
  $.post('ajax.php', 'do=showshopsection&section_shop='+section_shop+'&level_filter='+level_filter+'&name_filter='+name_filter, function (data){
    if (data)
      $("#section").fadeOut('10000', function (){$(this).html(data).fadeIn('10000'); $("#loadbar").hide();});
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

function sellItem (id)
{
  $.post('ajax.php', 'do=sellitem&id='+id, function (data){
    var item = data.split('A_D');
    if (item[0] == 'error')
      showError (item[1], item[2]);
    else if (item[0] == 'complete')
    {
      if (item[3] == 404)
        $("#money").fadeOut('10000', function (){$(this).html(item[1]).fadeIn('10000');});
      else if (item[3] == 405)
        $("#money_euro").fadeOut('10000', function (){$(this).html(item[1]).fadeIn('10000');});
      $("#item_id_"+id).slideUp('10000', function (){$(this).remove();});
      $("#mass").fadeOut('10000', function (){$(this).html(item[2]).fadeIn('10000');});
      showError (item[3], item[4]);
    }
  });
}

function AddCount (entry, name)
{
  var x = parseFloat(document.getElementById('x').value);
  var y = parseFloat(document.getElementById('y').value);
  $("#hint3").html('<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#CCC3AA"><tr><td align="center"><b>Купить неск. штук</b></td><td width="20" align="right" valign="top" style="cursor: pointer;" onclick="closehint3 ();"><strong>X</strong></td></tr><tr><td colspan="2">'+
  '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFF6DD"><tr><td colspan="2" align="center"><b><i>'+name+'</i></b></td></tr><tr><td width="80%" align="right">'+
  'Количество (шт.) <input type="text" name="count" size="4"></td><td width="20%">&nbsp;<input style="cursor: pointer;" type="submit" value=" »» " onclick=\'buyItem ("'+entry+'");\'>'+
  '</td></tr></table></td></tr></table>').css({'left': x + 50 + "px", 'top': y - 25 + "px"}).fadeIn('fast');
  $('[name=count]').focus();
}