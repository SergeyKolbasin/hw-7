<?php
/*
 * Файл для тестирования функций
 */
require_once '../config/config.php';

$smarty = new Smarty();
$login = '';
$smarty->assign('login', $login);
$smarty->display(SMARTY_TPL_DIR . 'test.tpl');
$login = $smarty->_tpl_vars['login'];
echo 'Я в test.php';
echo $login;