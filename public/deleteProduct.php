<?php
/*
 * Удаление товара
 */
require_once '../config/config.php';
$id = isset($_GET['id']) ? $_GET['id'] : false;
if (!$id) {
    echo 'id не передан';
    exit();
}
$id = (int)$id;
$product = getImage($id);
$name = $product['name'];
$url = $product['url'];
$price = $product['price'];

// Удаляем запись из БД и файл фотографии
if (deleteProduct($id) && unlink($url)) {
    echo 'Удален товар: ';
    echo '"<b>' . $name . '</b>, стоимостью: ' . $price . '"';
} else {
    echo 'Произошла ошибка';
}
?>
<!-- Возврат из формы удаления -->
<br><br>
<a href="gallery.php"><< Назад</a><br>
<a href="index.php">На главную</a>
