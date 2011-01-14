function exploder (data)
{
  if (!data || data == 'ajax_error')
    top.location.href = 'index.php';
  
  var variable = data.split('A_D');
  
  return variable;
}

function getRandomInt (min, max)
{
  return Math.floor(Math.random() * (max - min + 1)) + min;
}