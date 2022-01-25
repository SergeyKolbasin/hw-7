<?php
/*
 * Удаление товара
 */
require_once '../config/config.php';
// Если нет авторизации, перенаправление на логин
if (!isset($_SESSION['login'])) {
    header('location: login.php');
}


$id = isset($_GET['id']) ? $_GET['id'] : false;
if (!$id) {
    echo 'id не передан';
    exit();
}
$id = (int)$id;
$product = getImage($id);
$price = $product['price'];

insertProductBasket($id);

// Удаляем запись из БД и файл фотографии
/*
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
*/