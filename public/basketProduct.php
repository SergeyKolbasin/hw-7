<?php
require_once '../config/config.php';
// Если юзер вошел в систему
if (isset($_SESSION['login'])) {
    $id = $_SESSION['login']['id'];
    $sql = "SELECT gallery.id, gallery.name, gallery.price, baskets.amount FROM gallery
                INNER JOIN baskets ON baskets.productid=gallery.id
                    WHERE baskets.userid=$id
                        ORDER BY gallery.name ASC";
    $basket = getAssocResult($sql);
}else{
    header('location: login.php');
}
mainMenu();
echo '<h3>Корзина покупок:</h3>';

var_dump($basket);