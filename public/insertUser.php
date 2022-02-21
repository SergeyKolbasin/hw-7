<?php
/*
 * Добавление нового юзера
 */
require_once '../config/config.php';

$login = $_POST['login'] ?? '';                                     // логин
$password = $_POST['password'] ?? '';                               // пароль
$description = $_POST['description'] ?? '';                         // описание юзера
$address = $_POST['address'] ?? '';                                 // адрес юзера
$email = $_POST['email'] ?? '';                                     // e-mail
$role = $_POST['role'] ?? '0';                                      // роль в системе
// Проверка, вводились ли данные юзера
if ($login !== '' || $password !== ''|| $description !== '' || $address !== ''|| $email !== '') {
    // Если такого логина не существует в базе
    if (!presentLogin($login)) {
            // Если все данные юзера введены
            if ($login && $password && $description && $address && $email && ($role === '0' || $role === '1')) {
                // Если выбран файл для загрузки
                if (isset($_FILES['userfile']) && ($_FILES['userfile']['error']) !== UPLOAD_ERR_NO_FILE) {
                    $photo = getPhotoName();            // определим имя файла фото
                    // Загружаем файл на сервер
                    $uploadDir = USERS_DIR;
                    $uploadFile = getPhotoName() . getExtension($_FILES['userfile']['name']);
                    $url = $uploadDir . $uploadFile;
                    // Переносим временный файл из временного каталога в хранилище
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $url)) {
                        echo 'Файл корректен и был успешно загружен.' . '<br>';
                    } else {
                        echo 'Возможная атака с помощью файловой загрузки';
                    }
                } else {
                    $uploadFile = '';
                }
                if (insertUser($login, $password, $description, $address, $email, $role, $url)) {
                    echo 'Добавили юзера';
                } else {
                    echo 'Произошла ошибка' . '<br>';
                }
            } else {
                echo 'Что-то пошло не так';
            }
    } else {
        echo 'Такой логин уже существует, выберите другой';
    }
} else {
    echo 'Форма не заполнена';
}
echo '<hr>';
?>

<!-- Форма добавление нового юзера -->
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
    <span>Логин: </span><input type="text" name="login" size="10" value="<?= $login ?>">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span>Пароль: </span><input type="password" name="password" size="10" value="<?= $password ?>"><br><br>
    <legend>Описание:</legend><textarea name="description" cols="50" rows="5"><?= $description ?></textarea>
    <br><br>
    <legend>Адрес:</legend><textarea name="address" cols="50" rows="5"><?= $description ?></textarea>
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
