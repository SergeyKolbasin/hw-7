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
$id = (int)$id;                         // id записи в корзине
$userid = $_SESSION['login']['id'];     // id юзера
$product = getBasketItem($id, $userid); // содержимое выбранной позиции корзины данного юзера
$user = $product['description'];        // описание юзера(полное ФИО)
$name = $product['name'];               // наименование товара
$url = $product['url'];                 // изображение товара
$amount = $product['amount'];           // количество товара в корзине
$price = $product['price'];             // цена единицы товара
// Если кол-во не пусто и оно было изменено
if (!empty($_POST['amount']) && ($_POST['amount'] !== $amount)) {
    $amount = $_POST['amount'];
    // Обновляем запись в БД корзины
    if (insertBasketItem($id, $amount)) {
        echo 'Количество товара изменено';
    }else{
        echo 'Что-то пошло не так';
    }
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
<p>Редактируем количество товара "<?= $name ?>"в корзине пользователя <i><?= $user ?></i></p>
<hr>
<table>
    <tr>
        <th>Вид</th>
        <th>Наименование</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Стоимость</th>
    </tr>
    <tr>
        <td><img width="100px" src="<?= '../' . $url ?> " alt="<?= $name ?>"></td>
        <td><?= $name ?></td>
        <td><?= sprintf("%01.2f", $price) ?></td>
        <td>
            <form action="" method="post">
             <input type="number" size="3" min="0" max="999" step="1" name="amount" value="<?= $amount ?>">
             <input type="submit" name="send" value="ОК">
            </form>
        </td>
        <td><?php printf("%01.2f", $price * $amount) ?></td>
    </tr>
</table>
<!-- Возврат из формы редактирования -->
<br>
<p>Количество товара "<?= $name ?>" составляет <?= $amount ?> шт. </p>
<br>
<a href="basketProduct.php"><< В корзину</a><br>
<a href="gallery.php">В зоопарк</a><br>
<a href="index.php">На главную</a>
</body>
</html>