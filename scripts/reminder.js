function exploder (data)
{
  var variable = data.split('$$');
  return variable;
}

function checkRem1 ()
{
  var login = $('input[name=login]').val();
  $.post('ajax_register.php', {'do': 'checkrem1', 'login': login}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = '?step=2';
    else if (check[0] == 'error')
      $('#error').html(check[1]);
  });
}

function checkRem2 ()
{
  var answer = $('input[name=answer]').val();
  var birthday = $('input[name=birthday]').val();
  var code = $('input[name=code]').val();
  $.post('ajax_register.php', {'do': 'checkrem2', 'answer': answer, 'birthday': birthday, 'code': code}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = '?step=3';
    else if (check[0] == 'error')
      $('#error').html(check[1]);
  });
}

$(function (){
  $('input[name=login]').keyup(function (){
    $(this).val($(this).val().replace(/[^a-zA-Zа-яА-Я\- ]/g, ''));
  });
  $('input').keypress(function (e) {
    if (e.which == 13)
      $('#next').click();
  });
});