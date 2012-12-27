function exploder (data)
{
  var variable = data.split('$$');
  return variable;
}

function checkStep1 ()
{
  $('#error').hide().html('');
  var login = $('input[name=reg_login]').val();
  $.post('ajax_index.php', {'do': 'checkstep1', 'login': login}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = '?step=2';
    else if (check[0] == 'error')
      $('#error').show().html(check[1]);
  });
}

function checkStep2 ()
{
  $('#error').hide().html('');
  var password = $('input[name=password]').val();
  var password_confirm = $('input[name=password_confirm]').val();
  $.post('ajax_index.php', {'do': 'checkstep2', 'password': password, 'password_confirm': password_confirm}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = '?step=3';
    else if (check[0] == 'error')
      $('#error').show().html(check[1]);
  });
}

function checkStep3 ()
{
  $('#error').hide().html('');
  var email = $('input[name=email]').val();
  var secretquestion = $('input[name=secretquestion]').val();
  var secretanswer = $('input[name=secretanswer]').val();
  $.post('ajax_index.php', {'do': 'checkstep3', 'email': email, 'secretquestion': secretquestion, 'secretanswer': secretanswer}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = '?step=4';
    else if (check[0] == 'error')
      $('#error').show().html(check[1]);
  });
}

function checkStep4 ()
{
  $('#error').hide().html('');
  var name = $('input[name=name]').val();
  var birth_day = $('select[name=birth_day]').val();
  var birth_month = $('select[name=birth_month]').val();
  var birth_year = $('select[name=birth_year]').val();
  var sex = $('input[name=sex]').val();
  var city_n = $('select[name=city_n]').val();
  var city = $('input[name=city]').val();
  var icq = $('input[name=icq]').val();
  var hide_icq = $('input[name=hide_icq]').is(':checked');
  var deviz = $('input[name=deviz]').val();
  var color = $('select[name=color]').val();
  $.post('ajax_index.php', {'do': 'checkstep4', 'name': name, 'birth_day': birth_day, 'birth_month': birth_month, 'birth_year': birth_year, 'sex': sex, 'city_n': city_n, 'city': city, 'icq': icq, 'hide_icq': hide_icq, 'deviz': deviz, 'color': color}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = '?step=5';
    else if (check[0] == 'error')
      $('#error').show().html(check[1]);
  });
}

function checkStep5 ()
{
  $('#error').hide().html('');
  var rules = $('input[name=rules]').is(':checked');
  var code = $('input[name=code]').val();
  $.post('ajax_index.php', {'do': 'checkstep5', 'rules': rules, 'code': code}, function (data){
    var check = exploder(data);
    if (check[0] == 'complete')
      location.href = 'game.php';
    else if (check[0] == 'error')
      $('#error').show().html(check[1]);
  });
}

$(function (){
  $('input[name=reg_login]').keyup(function (){
    $(this).val($(this).val().replace(/[^a-zA-Zа-яА-Я\-_]/g, ''));
  });
  $('input[name=icq]').keyup(function (){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
  $('input[name=code]').keyup(function (){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
});