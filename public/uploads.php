<?php
/*
 * Загрузка фотографии на сервер
 */
    require_once __DIR__ . '/../config/config.php';
    if (!empty($_POST)) {
        var_dump($_POST);
    }
    if (!empty($_FILES)) {
        var_dump($_FILES);
    }
    // Загружаем файл на сервер
    if (!empty($_FILES)) {
        $upload_dir = WWW_DIR . IMG_DIR . 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['userfile']['name']);
        // Переносим временный файл
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file)) {
            echo 'Файл корректен и был успешно загружен.';
        } else {
            echo 'Возможная атака с помощью фаловой загрузки';
        }
    }
?>
<h4>Загрузка файла:</h4>
<form enctype="multipart/form-data" method="POST">
    <!-- Поле MAX_FILE_SIZE должно быть указано до загрузки файла(в байтах) -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000">
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Загрузить этот файл: <input type="file" name="userfile">
    <input type="submit" value="Загрузить">
</form>

