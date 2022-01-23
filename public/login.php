<html lang="ru">
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
</head>
<body>
<h3>Вход в систему</h3>
<hr>
<form method="post" action="login.php">
    <p>Пользователь:<input type="text" name="login"></p>
    <p>Пароль:<input type="password" name="password"></p>
    <p><input type="submit" value="Войти"></p>
</form>
</body>
</html>
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
        header('location: /index.php'); // возврат в корень сайта
    } else {
        echo 'Неверная пара логин и пароль!';
    }
} else {
    echo 'Не введены логин или пароль';
}