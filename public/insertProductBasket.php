<?php
/*
 * Модуль добавления товара в корзину
 */
require_once '../config/config.php';
// Если нет авторизации, перенаправление на логин
if (empty($_SESSION['login'])) {
    header('location: login.php');
}
// Контроль id товара
$id = isset($_GET['id']) ? $_GET['id'] : false;
if (!$id) {
    echo 'id не передан';
    exit();
}
$id = (int)$id;
$product = getImage($id);           // получение всех параметров товара
// Добавление в корзину с сообщением
if (insertProductBasket($id)) {
    echo 'Товар <b><i>' . $product['name'] . '</i></b> добавлен в корзину';
} else {
    echo 'При добавлении товара <b><i>' . $product['name'] . '</i></b> произошла ошибка, возможно он уже есть в корзине<br>';
    echo 'Проверьте свою корзину.';
}
echo '<hr>';
// На экран главное меню и товары
mainMenu();
echo renderGallery(getImages('SELECT * FROM gallery ORDER BY `views` DESC'), COLUMNS);
