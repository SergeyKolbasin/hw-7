<?php
require_once '../config/config.php';
// Если юзер вошел в систему
if (!empty($_SESSION['login'])) {
    $id = $_SESSION['login']['id'];
    $sql = "SELECT baskets.id, baskets.productid, gallery.name, gallery.price, baskets.amount FROM baskets
                INNER JOIN gallery ON baskets.productid=gallery.id
                WHERE baskets.userid=$id";                  // это идентификатор пользователя, соответствующий полю users.id
    $basket = getAssocResult($sql);
}else{
    header('location: login.php');
}
mainMenu();
echo '<h3>Корзина покупок:</h3>';
foreach($basket as $product) {
    echo $product['name'] . ' ' . $product['price'] . ' ' . $product['amount'] . ' ';
    echo '<a href="editBasketItem.php?id=' . $product['id'] . '">Изменить</a>';
    echo $product['price'] * $product['amount'];
    echo '<a href="deleteBasketItem.php?id=' . $product['id'] . '&productid=' . $product['productid'] . '">Удалить</a>';
    echo '<br>';
}
