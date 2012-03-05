var clevel = '';
var arrChange = { };
var skillsArr = new Array ();
skillsArr["sword"] = 0;
skillsArr["bow"] = 0;
skillsArr["crossbow"] = 0;
skillsArr["fail"] = 0;
skillsArr["staff"] = 0;
skillsArr["knife"] = 0;
skillsArr["axe"] = 0;
skillsArr["fire"] = 0;
skillsArr["water"] = 0;
skillsArr["air"] = 0;
skillsArr["earth"] = 0;
skillsArr["light"] = 0;
skillsArr["gray"] = 0;
skillsArr["dark"] = 0;

function SetAllSkills (isOn)
{
  var arrSkills = new Array("str", "dex", "con", "vit", "int", "wis", "spi");
  for (var i in arrSkills)
  {
    var clname = (isOn) ?"skill" :"nonactive";
    $('#plus_'+arrSkills[i]).attr('class', clname);
  }
}

function ChangeButtonState (bid)
{
  if ($('#save_button'+bid).attr('class') == 'nonactive')
    $('#save_button'+bid).attr('class', 'active').removeAttr('disabled');
  else
    $('#save_button'+bid).attr({'class': 'nonactive', 'disabled': 'disabled'});
}

function MakeSkillStep (nDelta, id)
{
  var n_UP = parseInt($('#ups').html()) | 0;
  
  if ((n_UP - nDelta ) < 0)
    return;
  
  if (!arrChange[id])
    arrChange[id] = 0;
  
  if ((arrChange[id] + nDelta) < 0 )
  {
    $('#minus_'+id).attr('class', 'nonactive');
    return;
  }
  
  SetAllSkills((n_UP - nDelta));
  arrChange[id] += nDelta;
  $('input[name=base_'+id+']').val(parseInt($('input[name=base_'+id+']').val()) + nDelta);
  $('#inst_'+id).html(parseInt($('#inst_'+id).html()) + nDelta);
  $('#ups').html(n_UP -= nDelta);
  
  if (arrChange[id] == 0)
    $('#minus_'+id).attr('class', 'nonactive');
  else
    $('#minus_'+id).attr('class', 'skill');
}

function ChangeAbility (id, nDelta, inst, maxval)
{
  var nm_UP = parseInt($('#skills').html()) | 0;
  
  if ((nm_UP - nDelta) < 0)
    return;
  
  if (!arrChange[id])
    arrChange[id] = 0;
  
  if ((arrChange[id] + nDelta ) == 0)
    $('#minus_'+id).attr('class', 'nonactive');
  
  if (nDelta > 0 && (arrChange[id] + nDelta + inst) == maxval)
  {
    skillsArr[id] = 1;
    $('#plus_'+id).attr('class', 'nonactive');
  }
  
  if ((arrChange[id] + nDelta) < 0 )
    return;
  
  if (nDelta > 0 && (arrChange[id] + nDelta + inst) > maxval)
    return;
  
  arrChange[id] += nDelta;
  if ((nm_UP - nDelta) == 0)
  {
    for (var i in skillsArr)
      $('#plus_'+i).attr('class', 'nonactive');
  }
  $('[name=base_'+id+']').val(parseInt($('[name=base_'+id+']').val()) + nDelta);
  $('#inst_'+id).html(parseInt($('#inst_'+id).html()) + nDelta);
  $('#skills').html(nm_UP -= nDelta);
  
  if (nDelta > 0)
    prefix = "minus_";
  else
  {
    prefix = "plus_";
    skillsArr[id] = 0;
    for (var i in skillsArr)
    {
      if (skillsArr[i] == 0)
        $('#plus_'+i).attr('class', 'skill');
    }
  }
  $('#'+prefix+id).attr('class', 'skill');
}

function setlevel (nm)
{
  if (clevel != '' && clevel != nm)
  {
    $('#'+clevel).removeClass('tzSet tzOver');
    $('#d'+clevel).css('display', 'none');
  }
  
  clevel = nm || 'L1';
  setCookie('clevel', clevel, getTimePlusHour());
  $('#'+clevel).addClass('tzSet');
  $('#d'+clevel).css('display', 'block');
  checkWindow();
}

$(function (){
  if (c = getCookie ('clevel'))
    clevel = c;
  else
    clevel = 'L5';
  setlevel(clevel);
  $('.tz').hover(
    function ()
    {
      if (clevel != $(this).attr('id'))
        $(this).addClass('tzOver');
    },
    function ()
    {
      if (clevel != $(this).attr('id'))
        $(this).removeClass('tzOver');
    }
  ).click(function (){
    setlevel($(this).attr('id'));
  });
});