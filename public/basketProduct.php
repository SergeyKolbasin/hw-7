<?php
require_once '../config/config.php';
// Если юзер вошел в систему
if (isset($_SESSION['login'])) {
    $id = $_SESSION['login']['id'];
    $sql = "SELECT baskets.id, baskets.productid, gallery.name, gallery.price, baskets.amount FROM baskets
                INNER JOIN gallery ON baskets.productid=gallery.id
                WHERE baskets.userid=7                  -- это идентификатор пользователя, соответствующий полю users.id
                ORDER BY baskets.id ASC";
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
    echo '<a href="deleteBasketItem.php?id=' . $product['id'] . '">Удалить</a>';
    echo '<br>';
}
