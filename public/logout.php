<?php
/*
 * Выход из системы
 */
require_once '../config/config.php';
header('location: ' . $_SESSION['originalURL']); // возврат на прежнее место сайта

// Закрываем сессию, тем самым разлогиниваем пользователя
echo 'До свидания, ' . $_SESSION['login']['login'];
$_SESSION = [];
unset($_COOKIE[session_name()]);
session_destroy();