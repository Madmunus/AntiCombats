var visual = {
  hint_c_set: function ()
              {
                $('#hint3').html('<table width="400" cellspacing="1" cellpadding="0" bgcolor="#CCC3AA">'+
                                 '<tr><td align="center"><b>Запомнить комплект одежды</b></td>'+
                                   '<td width="20" align="right" valign="top" style="cursor: pointer;" onclick="closehint3();"><big><b>x</b></big></td>'+
                                 '</tr>'+
                                 '<tr><td colspan="2">'+
                                  '<table width="100%" cellspacing="0" cellpadding="5" bgcolor="#FFF6DD">'+
                                    '<tr><td>Запомнить надетый комплект одежды, для быстрого переодевания. Подробнее об этой функции читайте в разделе <span id="hint" link="invent" class="nick">Подсказка</span>.<br>Введите название комплекта: <input type="text" name="set_name" maxlength="30"></td></tr>'+
                                    '<tr><td align="center"><input type="submit" value="Запомнить" onclick=\'workSets ("create");\'></td></tr>'+
                                  '</table>'+
                                 '</td></tr></table>').css({left: pos.x - 200 + 'px', top: pos.y - 20 + 'px'});
              },
  hint_set: function (hint)
            {
              $('#hint3').html(hint+getCloseButton('top', 'left', 'closehint3();'));
              var coor = getCenter($('#hint3').width(), $('#hint3').height());
              $('#hint3').css({left: coor.x, top: coor.y});
            },
  bar_show: function (bar)
            {
              $('#spoiler_'+bar).attr({src: 'img/minus.gif', alt: 'Скрыть'});
              $('#'+bar+'c').slideDown('slow', function (){checkWindow();});
              updateMmoves('spoiler_'+bar, 'Скрыть');
            },
  bar_hide: function (bar)
            {
              $('#spoiler_'+bar).attr({src: 'img/plus.gif', alt: 'Показать'});
              $('#'+bar+'c').slideUp('slow', function (){checkWindow();});
              updateMmoves('spoiler_'+bar, 'Показать');
            },
  bar_switch: function (bars)
              {
                $('#bar_'+bars[1]).fadeOut('10000', function (){$(this).html(bars[4]).fadeIn('10000').attr('id', 'bar_')});
                $('#bar_'+bars[3]).fadeOut('10000', function (){$(this).html(bars[2]).fadeIn('10000').attr('id', 'bar_'+bars[1]);$("#bar_").attr('id', 'bar_'+bars[3]);});
              },
  show_help: function (data)
             {
               $('body').css({overflow: 'hidden', marginRight: '17px'}).append('<div id="help"></div>');
               $('#help').html(data);
               var coor = getCenter($('#help').width(), $('#help').height());
               $('#help').css({left: coor.x, top: coor.y}).before("<div id='help_bg' onclick='hideHelp();'></div>").fadeIn('10000');
               $('#help_bg').css({width: $(window).width(), height: $(window).height()}).fadeIn('10000');
             },
  hide_help: function ()
             {
               $('#help').fadeOut('10000', function (){$(this).remove();});
               $('#help_bg').fadeOut('10000', function (){$(this).remove();});
               $('body').css('overflow', 'auto');
               checkWindow();
             },
  show_section: function (str)
                {
                  $('html, body').animate({scrollTop: 0}, 500);
                  this.show_any('#section', str);
                  $('#loadbar').hide();
                },
  show_any: function (selector, str) {hideShow(selector, function (){$(selector).html(str);}, str);},
  set_create: function (name, str)
              {
                closehint3();
                if (!($('div[name='+name.replace(' ', '_')+']').length))
                  $('#allsets').append(str);
                $('div[name='+name.replace(' ', '_')+']').hide().fadeIn('10000');
                checkWindow();
              },
  set_delete: function (name)
              {
                $('div[name='+name.replace(' ', '_')+']').fadeOut('10000', function (){$(this).remove(); checkWindow();});
              },
  item_buy: function (item)
            {
              if (item[3] == 400)
                this.show_any('#money', item[1]);
              else if (item[3] == 401)
                this.show_any('#money_euro', item[1]);
              this.show_any('#mass', item[2]);
              showError(item[3], item[4]);
            },
  item_sell: function (id, item)
             {
               if (item[3] == 404)
                 this.show_any('#money', item[1]);
               else if (item[3] == 405)
                 this.show_any('#money_euro', item[1]);
               $('#item_id_'+id).slideUp('10000', function (){$(this).remove(); checkWindow();});
               this.show_any('#mass', item[2]);
               showError(item[3], item[4]);
             },
  item_delete: function (item, id, dropall)
               {
                 var count_items = parseInt($('#count_items').html()) - item[2];
                 this.show_any('#mass', item[1]);
                 this.show_any('#count_items', count_items);
                 if (!dropall)
                   $('#item_id_'+id).slideUp('10000', function (){$(this).remove(); checkWindow();});
                 else if (dropall)
                   $('[name=item_entry_'+item[3]+']').slideUp('10000', function (){$(this).remove(); checkWindow();});
               },
  item_inc_stat: function (id, stat, incs)
                 {
                   $('#inc_'+id+'_'+stat+'_val').animate({color: '#00ff00'}, 500, function (){$(this).html('+'+incs[1]).animate({color: '#000000'}, 500);});
                   $('#inc_count_'+id).animate({color: '#ff0000'}, 500, function (){$(this).html(incs[2]).animate({color: '#000000'}, 500);});
                   if (incs[2] == 0)
                     $('input[type=image]').each(function (){if ($(this).attr('id') == 'inc_'+id+'_btn') $(this).hide();});
                 },
}