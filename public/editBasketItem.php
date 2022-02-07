<?php
/*
 * Изменение количества товара
 */
require_once '../config/config.php';
$id = isset($_GET['id']) ? $_GET['id'] : false;
if (!$id) {
    echo 'id не передан';
    exit();
}
$id = (int)$id;
$userid = $_SESSION['login']['id'];
$product = getBasketItem($id, $userid);
$user = $product['description'];
$name = $product['name'];
$url = $product['url'];
$price = $product['price'];
$amount = $product['amount'];

//var_dump($product);
/*
// Удаляем запись из БД и файл фотографии
if (deleteProduct($id) && unlink($url)) {
    echo 'Удален товар: ';
    echo '"<b>' . $name . '</b>, стоимостью: ' . $price . '"';
} else {
    echo 'Произошла ошибка';
}
*/
?>
<! DOCTYPE html>
<html lang="ru">
<head>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
<p>Редактируем количество товара <i><?= $name ?></i> в корзине пользователя <i><?= $user ?></i></p>
<hr>
<table>
    <tr>
        <th>Вид</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Количество</th>
    </tr>
    <tr>
        <td><img width="100px" src="<?= '../' . $url ?> " alt="<?= $name ?>"></td>
        <td><?= $name ?></td>
        <td><?= $price ?></td>
        <td>
            <?= $amount ?>
        </td>
    </tr>
</table>
<!-- Возврат из формы редактирования -->
<br><br>
<a href="basketProduct.php"><< В корзину</a><br>
<a href="gallery.php">В зоопарк</a><br>
<a href="index.php">На главную</a>
</body>
</html>