<?php
/*
 * Удаление товара из корзины
 */
require_once '../config/config.php';
$id = isset($_GET['id']) ? $_GET['id'] : false;
$productid = isset($_GET['productid']) ? $_GET['productid'] : false;
if (!$id || !$productid) {
    echo 'id не переданы';
    exit();
}

$id = (int)$id;
$product = getImage($productid);
$name = $product['name'];
$price = $product['price'];

// Удаляем запись из БД в корзине
if (deleteBasketItem($id)) {
    echo 'Удален товар: "<b>' . $name . '</b>, стоимостью: ' . $price . '"';
} else {
    echo 'Произошла ошибка';
}
?>
<!-- Возврат из формы удаления -->
<br><br>
<a href="basketProduct.php"><< Обратно в корзину</a><br>
<a href="gallery.php">В галерею</a><br>
<a href="index.php">На главную</a>
