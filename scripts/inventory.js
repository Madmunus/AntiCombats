function kmp ()
{
  hideShow('#hint3', visual.hint_c_set, '');
	$("[name=savekmp]").focus();
}

function sortInventory (type)
{
	clearError();
  $('html, body').animate({scrollTop: 0}, 500);
	var num = $("#sort_"+type).attr('name');
	$.post('ajax.php', {'do': 'sortinventory', 'type': type, 'num': num}, function (data){
    var sort = top.exploder(data);
	  if (sort[0] == 'complete')
	  {
	    var section = getCookie ('section');
      num = (num == 1) ?0 :1;
      $.post('ajax.php', 'do=showinventory&section='+section+'&type=inv', function (data){
        var inventory = top.exploder(data);
        visual.show_any('#inventory', inventory[0]);
        $('#sort_'+type).attr('name', num);
      });
	  }
	});
}

function increaseItemStat (id, stat)
{
	clearError();
	$.post('ajax.php', {'do': 'increaseitemstat', 'id': id, 'stat': stat}, function (data){
	  var incs = top.exploder(data);
	  if (incs[0] == 'complete')
      visual.item_inc_stat(id, stat, incs);
	  else if (incs[0] == 'error')
      showError(incs[1]);
	});
}

function inventoryLoginbank()
{
	clearError();
	var credit = $('select[name=credit]').val();
	var pass = $('input[name=pass]').val();
	$.post('ajax.php', {'do': 'inventoryloginbank', 'credit': credit, 'pass': pass}, function (data){
	  closehint3();
	  var bank = top.exploder(data);
	  if (bank[0] == 'complete')
      visual.show_any('#loginbank', bank[1]);
	  else if (bank[0] == 'error')
      showError(bank[1]);
	});
}

function inventoryUnLoginbank()
{
	clearError();
	$.post('ajax.php', {'do': 'inventoryunloginbank'}, function (data){
    var unlogin = top.exploder(data);
    visual.show_any('#loginbank', unlogin[0]);
	});
}

function switchBars (type, bar)
{
	clearError();
	$.post('ajax.php', {'do': 'switchbars', 'bar': bar, 'type': type}, function (data){
	  var bars = top.exploder(data);
	  if (bars[0] == 'complete')
      visual.bar_switch(bars);
	});
}

function spoilerBar (bar)
{
	clearError();
	$.post('ajax.php', {'do': 'spoilerbar', 'bar': bar}, function (data){
    var bars = top.exploder(data);
	  if (bars[0] == 'hide')
	    visual.bar_hide(bar);
	  else if (bars[0] == 'show')
      visual.bar_show(bar);
	});
}

function workSets (type, name)
{
	clearError();
	if (!name)
	  name = $("input[name=set_name]").val();
	$.post('ajax.php', {'do': 'worksets', 'name': name, 'type': type}, function (data){
	  var set = top.exploder(data);
	  if (type == 'create' && set[0] == 'complete')
	    visual.set_create(name, set[1]);
	  else if (type == 'delete' && set[0] == 'complete')
      visual.set_delete(name);
    else if (type == 'show' && set[0] == 'complete')
      hideShow('#hint3', visual.hint_set, set[1]);
	  else if (set[0] == 'error')
	    showError(set[1], name);
	});
}

function deleteItem (id)
{
  var dropall = ($('input[name=dropall]').is(':checked')) ?1 :0;
	$.post('ajax.php', {'do': 'deleteitem', 'id': id, 'dropall': dropall}, function (data){
    closehint3 ();
	  var item = top.exploder(data);
	  if (item[0] == 'complete')
      visual.item_delete(item, id, dropall);
    else if (item[0] == 'error')
	    showError(item[1]);
	});
}

function bank_info ()
{
  alert("У вас нет активных счетов.\n\nНа правах рекламы: Вы можете открыть счёт в Банке БК, на Страшилкиной улице*\n\n* Мелким шрифтом: услуга платная.");
}