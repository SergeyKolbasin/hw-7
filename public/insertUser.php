<?php
/*
 * Добавление нового юзера
 */
require_once '../config/config.php';

$login = $_POST['login'] ?? '';                         // логин
$description = $_POST['description'] ?? '';             // описание юзера
$email = $_POST['email'] ?? '';                         // e-mail
$role = (int)$_POST['role'] ?? 0;                           // роль юзера в системе
var_dump($_POST);
var_dump($role);
if (isset($a)) {
    var_dump($a);
}
// Проверка, вводились ли данные юзера
if ($login !== '' && $description !== '' && $email !== '') {
    if ($login && $description && $email && isset($role)) {    // если данные юзера введены загружаем файл фото
        if (!empty($_FILES)) {
            $photo=getPhotoName();
            // Если выбран файл для загрузки
            if (isset($_FILES['userfile']) && ($_FILES['userfile']['error']) !== UPLOAD_ERR_NO_FILE) {
                // Загружаем файл на сервер
                $uploadDir = USERS_DIR;
                $uploadFile = getPhotoName() . getExtension($_FILES['userfile']['name']);
                $url = $uploadDir . $uploadFile;
                $size = $_FILES['userfile']['size'];
                // Переносим временный файл
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $url)) {
                    echo 'Файл корректен и был успешно загружен.' . '<br>';
                } else {
                    echo 'Возможная атака с помощью файловой загрузки';
                }
            } else {
                echo 'Файл не выбран';
            }
        }
        // Добавляем юзера в БД
        if (insertUser($login, $description, $email, $role) == 1) {     // запросом д/б затронута только одна
            echo 'Юзер добавлен' . '<br>';
        } else {
            echo 'Произошла ошибка' . '<br>';
        }
    } else {
        echo 'Форма не заполнена';
    }
}
echo '<hr>';
?>

<!-- Добавление нового юзера -->
<!doctype>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <style type="text/css">
        .img {
            float: left;
            margin-right: 1%;
        }
    </style>
    <title>Новый пользователь</title>
</head>
<body>
<h3>Новый пользователь</h3>
<form enctype="multipart/form-data" method="POST">
    <span>Логин: </span><input type="text" name="login" size="35" value="<?= $login ?>"><br><br>
        <legend>Описание:</legend>
        <textarea name="description" cols="50" rows="15"><?= $description ?></textarea>
    <br><br>
    <span>e-mail: </span><input type="email" name="email" value="<?= $email ?>"><br><br>
    <span>Роль: </span><br>
        <select size="3" name="role" required>
            <option disabled>Выберите роль</option>
            <option selected value="1">Пользователь</option>
            <option value="0">Администратор</option>
        </select>
    <br><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_FILE_SIZE ?>">
    <span>Загрузить фото: </span><input type="file" name="userfile"><br><br>
    <input type="submit" value="Отправить">
</form>
<!-- Возврат из формы редактирования -->
<a href="/gallery.php"><< В зоопарк</a><br>
<a href="index.php">На главную</a>
</body>