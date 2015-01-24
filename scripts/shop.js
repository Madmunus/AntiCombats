function showShopSection (section_shop)
{
  clearError();
  var level_filter = $("input[name=level_filter]").val();
  var name_filter = $("input[name=name_filter]").val();
  $("#loadbar").show();
  $.post('ajax.php', {'do': 'showshopsection', 'section_shop': section_shop, 'level_filter': level_filter, 'name_filter': name_filter}, function (data){
    var section = top.exploder(data);
    visual.show_section(section[0]);
  });
}

function shopSection (section_shop)
{
  var cur_section_shop = getCookie('section_shop');
  if (section_shop)
  {
    $("#section_shop_"+cur_section_shop+", #section_shop_knife").css('backgroundColor', '');
    $("#section_shop_"+section_shop).css('backgroundColor', '#C7C7C7');
    setCookie('section_shop', section_shop, getTimePlusHour());
    $.post('ajax.php', {'do': 'getshoptitle', 'section_shop': section_shop}, function (data){
      var title = top.exploder(data);
      visual.show_any('#shop_title', title[0]);
    });
  }
  section_shop = getCookie('section_shop');
  showShopSection(section_shop);
}

function buyItem (entry)
{
  var count = ($('input[name=count]').val()) ?$('input[name=count]').val() :1;
  $.post('ajax.php', {'do': 'buyitem', 'entry': entry, 'count': count}, function (data){
    var item = top.exploder(data);
    closehint3 ();
    $('html, body').animate({scrollTop: 0}, 500);
    if (item[0] == 'complete')
      visual.item_buy(item);
    else if (item[0] == 'error')
      showError(item[1], item[2]);
  });
}

function sellItem (id)
{
  $.post('ajax.php', {'do': 'sellitem', 'id': id}, function (data){
    var item = top.exploder(data);
    if (item[0] == 'complete')
      visual.item_sell(id, item);
    else if (item[0] == 'error')
      showError(item[1], item[2]);
  });
}

function AddCount (entry, name, price, kr)
{
  $("#hint3").html('<table width="100%" cellspacing="1" cellpadding="0" bgcolor="#CCC3AA"><tr><td align="center"><b>Купить неск. штук</b></td><td width="20" align="right" valign="top" style="cursor: pointer;" onclick="closehint3 ();"><strong>X</strong></td></tr><tr><td colspan="2" bgcolor="#FFF6DD"><center><b><i>'+name+'</i></b><br>'+
  'Количество: <input type="text" name="count" size="6" value="1"><input type="hidden" name="price" value="'+price+'">&nbsp;<input style="cursor: pointer;" type="submit" value=" »» " onclick=\'buyItem ("'+entry+'");\'><br>Стоимость: <b><span id="full_price" style="color: #339900;">'+price+'</span></b> '+kr+
  '</center></td></tr></table>').css({'left': pos.x + 50 + "px", 'top': pos.y - 25 + "px"}).fadeIn('fast');
  $('[name=count]').focus();
}

$(function (){
  $('body').on('keyup', 'input[name=count]', function (){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
    
    if ($(this).val() == '')
      $(this).val(1);
    
    var summ = rdf(parseFloat($('input[name=price]').val()) * parseInt($('input[name=count]').val()));
    visual.show_any('#full_price', summ);
  });
});