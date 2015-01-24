$(function (){
  $('body').on('click', 'input[name=add_kredit]', function (){
    if (isNaN(parseFloat($('input[name=add_sum]').val())))
    {
      alert('Укажите сумму');
      return false;
    }
    else
      return confirm('Вы хотите положить на свой счет '+parseFloat($('input[name=add_sum]').val())+' кр. ?');
  }).on('click', 'input[name=get_kredit]', function (){
    if (isNaN(parseFloat($('input[name=get_sum]').val())))
    {
      alert('Укажите сумму');
      return false;
    }
    else
      return confirm('Вы хотите снять со своего счета '+parseFloat($('input[name=get_sum]').val())+' кр. ?');
  }).on('click', 'input[name=transfer_kredit]', function (){
    if (isNaN(parseFloat($('input[name=transfer_sum]').val())) || isNaN(parseInt($('input[name=id2]').val())))
    {
      alert('Укажите сумму и номер счета');
      return false;
    }
    else
      return confirm('Вы хотите перевести со своего счета '+parseFloat($('input[name=transfer_sum]').val())+' кр. на счет номер #'+parseInt($('input[name=id2]').val())+' ?');
  }).on('click', 'input[name=convert_ekredit]', function (){
    if (isNaN(parseFloat($('input[name=convert_sum]').val())))
    {
      alert('Укажите обмениваемую сумму');
      return false;
    }
    else
      return confirm('Вы хотите обменять '+parseFloat($('input[name=convert_sum]').val())+' екр. на кредиты ?');
  }).on('click', 'input[name=close]', function (){
    if (confirm('Если вы закроете счет, то для открытия нового счета вам придется снова заплатить 3.00 кр.\nЗакрыть счет?'))
      location.href = '?do=delete';
  });
});