var fireworks_types = new Array('04',21, '03',21, '05',21, '06',21, '07',27, '08',27, '02',34, '09',34, '10',34 );

function fireworks (x,y,type)
{
  return start_fireworks(x,y,type);
}

function start_fireworks (x,y,type)
{
  myFW = new JSFX.FireworkDisplay(1, "img/fw"+fireworks_types[type*2], fireworks_types[type*2+1], x, y);
  myFW.start();
  return false;
}

function stop_fireworks (id)
{
  $('#'+id).css('display', 'none');
  document.getElementById(id).removeNode(true);
  return false;
}