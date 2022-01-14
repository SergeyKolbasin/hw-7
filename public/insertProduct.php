<?php
/*
 * Добавление нового товара
 */
require_once '../config/config.php';
$name = $_POST['name'] ?? '';                           // наименование товара
$description = $_POST['description'] ?? '';             // описание товара
$price = $_POST['price'] ?? '';                        // цена товара
        // Проверка, вводились ли параметры товара
        if ($name !== '' && $description !== '' || $price !== '') {
            if ($name && $description && $price) {          // если параметры товара введены загружаем файл фото
                if (!empty($_FILES)) {
                    // Если выбран файл для загрузки
                    if (isset($_FILES['userfile']) && ($_FILES['userfile']['error']) !== UPLOAD_ERR_NO_FILE) {
                        // Загружаем файл на сервер
                        $uploadDir = PRODUCT_DIR;
                        $uploadFile = getProductName() . getExtension($_FILES['userfile']['name']);
                        $url = $uploadDir . $uploadFile;
                        $size = $_FILES['userfile']['size'];
                        // Переносим временный файл
                        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $url)) {
                            echo 'Файл корректен и был успешно загружен.' . '<br>';
                            // Добавляем товар в БД
                            if (insertProduct($name, $description, $price, $url, $size) == 1) {     // запросом д/б затронута только одна запись
                                echo 'Товар добавлен' . '<br>';
                            } else {
                                echo 'Произошла ошибка' . '<br>';
                            }
                        } else {
                            echo 'Возможная атака с помощью файловой загрузки';
                        }
                    } else {
                        echo 'Файл не выбран';
                    }
                }
            } else {
                echo 'Форма не заполнена';
            }
        }
echo '<hr>';
?>

<!-- Добавление нового товара -->
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
    <title>Новый товар</title>
</head>
<body>
<h3>Новый товар</h3>
<form enctype="multipart/form-data" method="POST">
    <span>Наименование: </span><input type="text" name="name" size="35"><br><br>
    <fielset>
        <legend>Описание:</legend>
        <textarea name="description" cols="50" rows="15"></textarea>
    </fielset>
    <br><br>
    <span>Цена: </span><input type="number" name="price" min="0" step="0.01"><br><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_FILE_SIZE ?>">
    <span>Загрузить этот файл: </span><input type="file" name="userfile"><br><br>
    <input type="submit" value="Отправить">
</form>
<!-- Возврат из формы редактирования -->
<a href="/gallery.php"><< Назад</a><br>
<a href="index.php">На главную</a>
</body>
