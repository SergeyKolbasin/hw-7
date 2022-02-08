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
$amount = $product['amount'];
$price = $product['price'];

if (!empty($_POST['amount']) && ($_POST['amount'] !== $amount)) {
    $amount = $_POST['amount'];
    echo "Количество товара изменено $name";
}
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
            <form action="" method="post">
             <input type="number" name="amount" value="<?= $amount ?>">
             <input type="submit" name="send" value="ОК">
            </form>
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