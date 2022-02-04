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
    <p><label>Пользователь:  <input type="text" name="login"></label></p>
    <p><label>Пароль: <input type="password" name="password"></label></p>
    <p><input type="submit" value="Войти"></p>
</form>
<a href="gallery.php"><< В зоопарк</a><br>
<a href="index.php">На главную</a>
<br><br>
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
        if (isset($_SESSION['login'])) {
            header('location: ' . $_SESSION['originalURL']); // возврат на прежнее место сайта
        }else{
            header('location: index.php');                 // возврат на стартовую страницу
        }
    } else {
        echo 'Неверная пара логин/пароль!';
    }
} else {
    echo 'Не введены логин и/или пароль!';
}
