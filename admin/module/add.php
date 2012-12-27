<?
defined('AntiBK') or die("Доступ запрещен!");
?>
<script>
$(function (){
  $('[name=section]').live('change', function (){
    $('#types').html('');
    $('#fields').html('');
    $.post('ajax.php', 'do=showtypes&section='+$(this).val(), function (data){
      $('#types').html(data);
    });
  });
  $('[name=type]').live('change', function (){
    $('#fields').html('');
    $.post('ajax.php', 'do=showfields&type='+$(this).val(), function (data){
      $('#fields').html(data);
    });
  });
  $('[name=create]').live('click', function (){
    var fields = '';
    $('.field').each(function (){if ($(this).val()) fields += $(this).attr('name')+'='+$(this).val()+'$$';});
    $.post('ajax.php', 'do=createitem&fields='+fields, function (data){
      if (data == 'complete')
        alert('Предмет создан');
      else
        alert(data);
    });
    $('#fields').html('');
    $.post('ajax.php', 'do=showfields&type='+$('[name=type]').val(), function (data){
      $('#fields').html(data);
    });
  });
});
</script>
Тип предмета:
<select class='field' name="section">
  <option value="" selected></option>
  <option value="item">item</option>
  <option value="thing">thing</option>
</select><br>
<font id='types'></font>
<font id='fields'></font>