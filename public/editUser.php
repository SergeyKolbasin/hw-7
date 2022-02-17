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

$login = $_POST['login'] ?? $user['login'];                     // наименование товара
$description = $_POST['description'] ?? $user['description'];   // описание товара
$email = $_POST['email'] ?? $user['email'];                     // цена товара
$role = $_POST['role'] ?? $user['role'];                        // роль в системе
$photo = USERS_DIR . $user['photo'];                                        // фото юзера
$lastAction = $user['last_action'];                             // дата/время последнего действия в системе
// Проверка, редактировались ли параметры товара
/*
if ($name !== $product['name'] || $description !== $product['description'] || $price !== $product['price']) {
    if ($name && $description && $price) {
        // Редактируем товар
        if (updateProduct($id, $name, $description, $price) == 1) {     // запросом д/б затронута только одна запись
            echo 'Товар изменен' . '<br>';
        } else {
            echo 'Произошла ошибка' . '<br>';
        }
    } elseif ($name || $description || $price) {
        echo 'Форма не заполнена' . '<br>';
    }
}
*/
//if (!empty($_FILES)) {

    // Если выбран файл для загрузки
    if (isset($_FILES['userfile']) && ($_FILES['userfile']['error']) !== UPLOAD_ERR_NO_FILE) {
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


//}
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
<p>Личный кабинет пользователя: <i><?= $user['description'] ?></i></p>
<div class="container">
    <div class="img">
        <img src="<?= $photo ?>" alt="<?= $user['description'] ?>" width="300">
<!--        <img src="<?/*= $photo */?>" alt="<?/*= $user['description'] */?>" width="400" height="300">-->
    </div>
</div>
<br>
<form enctype="multipart/form-data" method="POST">
    <span>Логин: </span><input type="text" name="name" size="35" value="<?= $login ?>"><br><br>
    <fielset>
        <legend>Описание:</legend>
        <textarea name="description" cols="50" rows="15"><?= $description ?></textarea>
    </fielset>
    <br><br>
    <span>e-mail: </span><input type="email" name="price" value="<?= $email ?>"><br><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_FILE_SIZE ?>">
    <span>Загрузить фото: </span><input type="file" name="userfile"><br><br>
    <input type="submit" value="Отправить">
</form>
<!-- Возврат из формы редактирования -->
<a href="/gallery.php"><< В зоопарк</a><br>
<a href="index.php">На главную</a>
</body>