<?
if (ereg("[<>\\/-]",$act) or ereg("[<>\\/-]",$ord) or ereg("[<>\\/-]",$spell)) {print "?!"; exit();}
$act=htmlspecialchars($act);
$ord=htmlspecialchars($ord);
$spell=htmlspecialchars($spell);
?>
<p align=right><input type=button value="Вернуться" class=nav onclick="javascript:location.href='main.php?act=none'">&nbsp;&nbsp;&nbsp;&nbsp;</p>
<?
if(empty($ord)){$ord=$db["orden"];}
		print "<hr color=#000000 noshade size=1 width=100%><table width=100%><td>";
if($ord==1 or $ord==2 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
	if($db["orden"]==1 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		if($db["admin_level"]>=1 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=1' class=us2 title='Заткнуть рот персонажу, за нарушения правил общения в чате.'><li>Заклятие молчания</li></a><BR>";
		}
		if($db["admin_level"]>=2 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=2' class=us2 title='Вынуть кляп изо рта нарушителя.'><li>Снять заклятие молчания</li></a><BR>";
		}
		if($db["admin_level"]>=3 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='perevod.php' target=_per class=us2 title='Просмотреть отчеты о переводах.'><li>Отчеты о переводах</li></a><BR>";
		}
		if($db["admin_level"]>=4 or $db["login"]=='Смотритель'  or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=3' class=us2 title='Отправить в тюрьму'><li>Отправить в тюрьму</li></a><BR>";
		}
		if($db["admin_level"]>=5 or $db["login"]=='Смотритель'  or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=4' class=us2 title='Выпустить персонажа из тюрьмы.'><li>Выпустить из тюрьмы</li></a><BR>";
		}
		if($db["type"]=="clan" or $db["login"]=='Смотритель' or $db["admin_level"]>=10 or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=10' class=us2 title='Управление заявками на создание клана'><li>Клановый отдел</li></a><BR>";
		}
		if($db["type"]=="proverka" or $db["login"]=='Смотритель' or $db["admin_level"]>=10 or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=11' class=us2 title='Поставить метку проверки паладинов'><li>Поставить метку</li></a><BR>";
		}
		if($db["admin_level"]>=6 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=20' class=us2 title='Поиск персонажей по ip'><li>Поиск персонажей по ip</li></a><BR>";
		print "<a href='?act=orden&ord=1&spell=5' class=us2 title='Заблокировать персонажа'><li>Заблокировать персонажа</li></a><BR>";
		}
		if($db["admin_level"]>=7 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=6' class=us2 title='Разблокировать персонажа'><li>Разблокировать персонажа</li></a><BR>";
		print "<a href='?act=orden&ord=1&spell=19' class=us2 title='Блокирование ip адресов'><li>Блокирование ip</li></a><BR>";
		}
		if($db["admin_level"]>=8 or $db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=14' class=us2 title='Добавление новостей'><li>Новости</li></a><BR>";
		}
		if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' ){
		print "<a href='?act=orden&ord=1&spell=15' class=us2 title='Принять персонажа в орден Паладинов'><li>Принять в орден Паладинов</li></a><BR>";
		print "<a href='?act=orden&ord=1&spell=16' class=us2 title='Изгнать персонажа из ордена Паладинов'><li>Изгнать из ордена Паладинов</li></a><BR>";
		print "<a href='?act=orden&ord=2&spell=77' class=us2 title='Принять персонажа в Армаду'><li>Принять в Армаду</li></a><BR>";
		print "<a href='?act=orden&ord=2&spell=88' class=us2 title='Изгнать персонажа из Армады'><li>Изгнать из Армады</li></a><BR>";
		print "<a href='?act=orden&ord=2&spell=12' class=us2 title='Выпить энергию'><li>Выпить энергию</li></a><BR>";
		}
		if($db["admin_level"]>=9 or $db["login"]=='Смотритель'){
		print "<a href='?act=orden&ord=1&spell=7' class=us2 title='Принять персонажа в орден Паладинов'><li>Принять в орден</li></a><BR>";
		}
		if($db["admin_level"]>=10 or $db["login"]=='Смотритель'){
		print "<a href='?act=orden&ord=1&spell=8' class=us2 title='Изгнать персонажа из ордена Паладинов'><li>Изгнать из ордена</li></a><BR>";
		}
		if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["admin_level"]>=10){
		print "<a href='adm.php' class=us2 title='Редактирование персонажей'><li>Редактирование персонажей</li></a><BR>";

		if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["admin_level"]>=10){
		print "<a href='add.php' class=us2 title='добавить вещи в маг' target=_blank><li>добавить вещи в магазин</li></a><BR>";
		}
		print "<a href='?act=orden&ord=1&spell=17' class=us2 title='Кик с боя'><li>Выбросить из боя</li></a><BR>";
		print "<a href='?act=orden&ord=1&spell=18' class=us2 title='Лечение от всех травм'><li>Вылечить от всех травм</li></a><BR>";
		}
		if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель'){
		print "<a href='?act=orden&ord=1&spell=21' class=us2 title='Редактирование кланов'><li>Редактирование кланов</li></a><BR>";
		}
		if($db["login"]=='Смотритель' or $db["login"]=='Мироздатель' or $db["admin_level"]>=10){
		print "<a href='?act=orden&ord=1&spell=22' class=us2 title='Редактирование личного дела'><li>Редактировать личное дело</li></a><BR>";
		}
	}
	if($db["orden"]==2){
		if($db["admin_level"]>=1){
		print "<a href='?act=orden&ord=2&spell=1' class=us2 title='Заткнуть рот персонажу, за нарушения правил общения в чате.'><li>Заклятие молчания</li></a><BR>";
		}
		if($db["admin_level"]>=2){
		print "<a href='?act=orden&ord=2&spell=2' class=us2 title='Вынуть кляп изо рта нарушителя.'><li>Снять заклятие молчания</li></a><BR>";
		}
		if($db["admin_level"]>=3){
		print "<a href='perevod.php' target=_per class=us2 title='Просмотреть отчеты о переводах.'><li>Отчеты о переводах</li></a><BR>";
		}
		if($db["admin_level"]>=4){
		print "<a href='?act=orden&ord=2&spell=3' class=us2 title='Отправить в тюрьму'><li>Отправить в тюрьму</li></a><BR>";
		}
		if($db["admin_level"]>=5){
		print "<a href='?act=orden&ord=2&spell=4' class=us2 title='Выпустить персонажа из тюрьмы.'><li>Выпустить из тюрьмы</li></a><BR>";
		}
		if($db["admin_level"]>=6){
		print "<a href='?act=orden&ord=2&spell=20' class=us2 title='Поиск персонажей по ip'><li>Поиск персонажей по ip</li></a><BR>";
		print "<a href='?act=orden&ord=2&spell=5' class=us2 title='Заблокировать персонажа'><li>Заблокировать персонажа</li></a><BR>";
		}
		if($db["admin_level"]>=7){
		print "<a href='?act=orden&ord=2&spell=6' class=us2 title='Разблокировать персонажа'><li>Разблокировать персонажа</li></a><BR>";
		print "<a href='?act=orden&ord=2&spell=19' class=us2 title='Блокирование ip адресов'><li>Блокирование ip</li></a><BR>";
		}
		if($db["admin_level"]>=8){
		print "<a href='?act=orden&ord=2&spell=14' class=us2 title='Добавление новостей'><li>Новости</li></a><BR>";
		}
		if($db["admin_level"]>=9){
		print "<a href='?act=orden&ord=2&spell=77' class=us2 title='Принять персонажа в Армаду'><li>Принять в Армаду</li></a><BR>";
		}
		if($db["admin_level"]>=10){
		print "<a href='?act=orden&ord=2&spell=88' class=us2 title='Изгнать персонажа из Армады'><li>Изгнать из Армады</li></a><BR>";
		print "<a href='?act=orden&ord=2&spell=22' class=us2 title='Редактирование личного дела'><li>Редактировать личное дело</li></a><BR>";

		}

	}
}
if($ord==20){
	if($db["orden"]==20){
		print "<a href='?act=orden&ord=20&spell=12' class=us2 title='Выпить энергию'><li>Выпить энергию</li></a><BR>";
		print "<a href='?act=orden&ord=20&spell=13' class=us2 title='Призвать нежить'><li>Призвать нежить</li></a><BR>";

		}

}
if($ord==3){
	if($db["orden"]==3){
	print "";
	}
}
if($ord==4){
	if($db["orden"]==4){
	print "У Вас нет специальных возможностей.";
	}
}
if($ord==5){
	if($db["orden"]==5){
	print "<a href='?act=orden&ord=5&spell=1' class=us2><li>Напугать противника</li></a><BR>";
	}
}
	print "</td><td align=right>";
if(!empty($spell)){
	if($ord==1 && $spell==1 && $db["admin_level"]>=1 && $db["orden"]==1 or $spell==1 && $db["login"]=='Смотритель' or $spell==1 && $db["login"]=='Смотритель' or $ord==2 && $spell==1 && $db["admin_level"]>=1 && $db["orden"]==2){
	include "magic/1/1.php";
	}
	if($ord==1 && $spell==2 && $db["admin_level"]>=2 && $db["orden"]==1 or $spell==2 && $db["login"]=='Смотритель' or $spell==2 && $db["login"]=='Смотритель' or $ord==2 && $spell==2 && $db["admin_level"]>=2 && $db["orden"]==2){
	include "magic/1/2.php";
	}
	if($ord==1 && $spell==3 && $db["admin_level"]>=4 && $db["orden"]==1 or $spell==3 && $db["login"]=='Смотритель' or $spell==3 && $db["login"]=='Смотритель' or $ord==2 && $spell==3 && $db["admin_level"]>=4 && $db["orden"]==2){
	include "magic/1/3.php";
	}
	if($ord==1 && $spell==4 && $db["admin_level"]>=5 && $db["orden"]==1 or $spell==4 && $db["login"]=='Смотритель' or $spell==4 && $db["login"]=='Смотритель' or $ord==2 && $spell==4 && $db["admin_level"]>=5 && $db["orden"]==2){
	include "magic/1/4.php";
	}
	if($ord==1 && $spell==5 && $db["admin_level"]>=6 && $db["orden"]==1 or $spell==5 && $db["login"]=='Смотритель' or $spell==5 && $db["login"]=='Смотритель' or $ord==2 && $spell==5 && $db["admin_level"]>=6 && $db["orden"]==2){
	include "magic/1/5.php";
	}
	if($ord==1 && $spell==20 && $db["admin_level"]>=6 && $db["orden"]==1 or $spell==20 && $db["login"]=='Смотритель' or $spell==20 && $db["login"]=='Смотритель' or $ord==2 && $spell==20 && $db["admin_level"]>=6 && $db["orden"]==2){
	include "magic/1/20.php";
	}
	if($spell==21 && $db["login"]=='Смотритель' or $spell==21 && $db["login"]=='Смотритель'){
	include "magic/1/21.php";
	}
	if($spell==22 && $db["login"]=='Смотритель' or $spell==22 && $db["login"]=='Смотритель' or $ord==1 && $spell==22 && $db["admin_level"]>=10 && $db["orden"]==1 or $ord==2 && $spell==22 && $db["admin_level"]>=10 && $db["orden"]==2){
	include "magic/1/22.php";
	}
	if($ord==1 && $spell==6 && $db["admin_level"]>=7 && $db["orden"]==1 or $spell==6 && $db["login"]=='Смотритель' or $spell==6 && $db["login"]=='Смотритель' or $ord==2 && $spell==6 && $db["admin_level"]>=7 && $db["orden"]==2){
	include "magic/1/6.php";
	}
	if($ord==1 && $spell==19 && $db["admin_level"]>=7 && $db["orden"]==1 or $spell==19 && $db["login"]=='Смотритель' or $spell==19 && $db["login"]=='Смотритель' or $ord==2 && $spell==19 && $db["admin_level"]>=7 && $db["orden"]==2){
	include "magic/1/19.php";
	}
	if($ord==1 && $spell==7 && $db["admin_level"]>=9 && $db["orden"]==1 or $spell==7 && $db["login"]=='Смотритель'){
	include "magic/1/7.php";
	}
	if($ord==1 && $spell==8 && $db["admin_level"]>=10 && $db["orden"]==1 or $spell==8 && $db["login"]=='Смотритель'){
	include "magic/1/8.php";
	}
	if($ord==2 && $spell==77 && $db["admin_level"]>=9 && $db["orden"]==2 or $spell==77 && $db["login"]=='Смотритель'){
	include "magic/1/77.php";
	}
	if($ord==2 && $spell==88 && $db["admin_level"]>=10 && $db["orden"]==2 or $spell==88 && $db["login"]=='Смотритель'){
	include "magic/1/88.php";
	}
	if($spell==15 && $db["login"]=='Смотритель'){
	include "magic/1/7.php";
	}
	if($spell==16 && $db["login"]=='Смотритель'){
	include "magic/1/8.php";
	}
	if($spell==18 && $db["login"]=='Смотритель' or $spell==18 && $db["login"]=='Мироздатель' or $ord==1 && $spell==18 && $db["admin_level"]>=10 && $db["orden"]==1){
	include "magic/1/18.php";
	}
	if($spell==17 && $db["login"]=='Смотритель' or $spell==17 && $db["login"]=='Мироздатель' or $ord==1 && $spell==17 && $db["admin_level"]>=10 && $db["orden"]==1){
	include "magic/1/17.php";
	}
	if($ord==1 && $spell==9 && $db["admin_level"]>=10 && $db["orden"]==1 or $spell==9 && $db["login"]=='Смотритель' or $ord==2 && $spell==9 && $db["admin_level"]>=10 && $db["orden"]==2){
	include "magic/1/9.php";
	}
	if($ord==1 && $spell==10 && $db["type"]=="clan" && $db["orden"]==1 or $spell==10 && $db["login"]=='Смотритель' or $ord==1 && $spell==10 && $db["admin_level"]>=10 && $db["orden"]==1 or $spell==10 && $db["login"]=='Смотритель' or $ord==2 && $spell==10 && $db["type"]=="clan" && $db["orden"]==2){
	include "magic/1/10.php";
	}
	if($ord==1 && $spell==11 && $db["type"]=="proverka" && $db["orden"]==1 or $spell==11 && $db["login"]=='Смотритель' or $ord==1 && $spell==11 && $db["admin_level"]>=10 && $db["orden"]==1 or $spell==11 && $db["login"]=='Смотритель' or $ord==2 && $spell==11 && $db["type"]=="proverka" && $db["orden"]==2){
	include "magic/1/11.php";
	}
	if($ord==1 && $spell==14 && $db["orden"]==1 or $spell==14 && $db["login"]=='Смотритель' or $spell==14 && $db["login"]=='Мироздатель' or $ord==1 && $spell==14 && $db["admin_level"]>=10 && $db["orden"]==1 or $ord==2 && $spell==14 && $db["orden"]==2){
	include "magic/1/12.php";
	}
	if($ord==20 && $spell==12 && $db["orden"]==20){
	include "magic/20/1.php";
}
	if($ord==20 && $spell==13 && $db["orden"]==20 or $spell==13 && $db["login"]=='Смотритель'){
	include "magic/20/2.php";
	}
	if($ord==5 && $spell==1 && $db["orden"]==5){
	include "magic/5/1.php";
	}
}
?></td></table><hr color=#000000 noshade size=1 width=100%>