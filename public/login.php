<?php
/*
 * Вход в систему
 */
require_once '../config/config.php';

// Получаем логин, пароль
$login = $_POST['login'] ?? false;
$password = $_POST['password'] ?? false;
// Если логин и пароль, попытка авторизоваться
if ($login && $password) {
    // преобразуем пароль в хэш
    //$password = password_hash($password, PASSWORD_DEFAULT);
    $password = md5($password);
    // получаем пользователя из базы
    $sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $user = getSingle($sql);
    // Если пользователь найден, записываем его в сессию
    if ($user) {
        $_SESSION['login'] = $user;
        echo 'Удачный вход';
    } else {
        echo 'Неверная пара логин и пароль!';
    }
}
var_dump($_SESSION);