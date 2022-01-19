<?php
/*
 * Выход из системы
 */
require_once '../config/config.php';
// Закрываем сессию, тем самым разлогиниваем пользователя
echo 'До свидания, ' . $_SESSION['login']['login'];
$_SESSION = [];
unset($_COOKIE[session_name()]);
session_destroy();

header('location: /index.php'); // возврат в корень сайта
