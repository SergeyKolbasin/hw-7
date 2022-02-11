<?php
//Подключаем класс смарти
require_once 'lib/Smarty.class.php';
//Создадим обьект класса смарти
$smarty = new Smarty();
//Создадим переменную для примера
$name = 'Сергей';
//Передаем переменную в шаблонизатор Smarty
$smarty->assign('name',$name);
//Выводим шаблон на экран
$smarty->display('main.tpl');
?>