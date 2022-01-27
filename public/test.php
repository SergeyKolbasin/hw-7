<?php
/*
 * Файл для тестирования функций
 */
require_once '../config/config.php';

$sql = "SELECT * FROM `baskets` WHERE `userid`=1 AND `productid`=6";
$q = getSingle($sql);
//$newID = getSingle($sql);
//var_dump((int)$newID['auto_increment']);
echo 'test';
var_dump($q);
