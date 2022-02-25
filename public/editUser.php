<?php
/*
 * Личный кабинет
 */
require_once '../config/config.php';
$id = isset($_GET['id']) ? $_GET['id'] : false;
if (!$id) {
    echo 'id не передан';
    exit();
}
$id = (int)$id;
$user = getUser($id);
$password = $_POST['password'] ?? $user['password'];            // пароль
$description = $_POST['description'] ?? $user['description'];   // описание пользователя
$email = $_POST['email'] ?? $user['email'];                     // его e-mail
$address = $_POST['address'] ?? $user['address'];               // адрес
//$role = $_POST['role'] ?? $user['role'];                        // роль в системе
$photo = $user['photo'];                                        // фото юзера
$lastAction = $user['last_action'];                             // дата/время последнего действия в системе
// Проверка, редактировались ли параметры кабинета
if ($password !== $user['password'] ||$description !== $user['description'] || $email !== $user['email'] || $address
    !== $user['address'] || !empty($_FILES)) {
    if ($password && $description && $email && $address) {
        // Если выбран файл для загрузки
        if (!empty($_FILES)) {
            if ((isset($_FILES['userfile']) && ($_FILES['userfile']['error']) !== UPLOAD_ERR_NO_FILE)) {
                // Загружаем файл на сервер
                $uploadDir = USERS_DIR;
                $uploadFile = (string)$id . getExtension($_FILES['userfile']['name']);
                $photo = $uploadDir . $uploadFile;
                // Переносим временный файл из временного каталога в хранилище
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $photo)) {
                    echo 'Фото корректно и успешно загружено.' . '<br>';
                } else {
                    echo 'Возможная атака с помощью файловой загрузки.';
                }
            }
        } else {
            $photo = $user['photo'];
        }

        // Запросом д/б затронута только одна запись
        if (editUser($id, $password, $description, $address, $email, $photo) == 1) {
            echo 'Данные в кабинете изменены.' . '<br>';
            echo '<hr>';
        } else {
            echo 'Произошла ошибка или не заполнена форма.' . '<br>';
            echo '<hr>';

        }
    }
}

?>
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
    <title><?= $user['login'] ?></title>
</head>
<body>
<?php mainMenu() ?>
<p>Личный кабинет пользователя: <i><?= $user['description'] ?></i></p>
<div class="container">
    <div class="img">
        <img src="<?= $user['photo'] ?>" alt="<?= $user['description'] ?>" width="400" height="300">
    </div>
</div>
<br>
<form enctype="multipart/form-data" method="POST">
    <span>Логин: </span><input type="text" name="login" size="10" value="<?= $user['login'] ?>" disabled>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span>Пароль: </span><input type="password" name="password" size="10"><br><br>
    <span>Последяя активность: </span><input type="text" name="last_action" size="20" value="<?= $user['last_action'] ?>"
                                            disabled><br><br>
    <legend>Описание:</legend>
    <textarea name="description" cols="50" rows="4"><?= $description ?></textarea>
    <br><br>
    <legend>Адрес:</legend>
    <textarea name="address" cols="50" rows="4"><?= $address ?></textarea>
    <br><br><br>
    <span>e-mail: </span><input type="email" name="email" value="<?= $email ?>">
    <br><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_FILE_SIZE ?>">
    <span>Загрузить фото: </span><input type="file" name="userfile"><br><br>
    <input type="submit" value="Отправить">
</form>
</body>
</html>