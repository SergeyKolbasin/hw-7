<?php
/*
 * Файл для тестирования функций
 */
require_once '../config/config.php';

// Получение ID для нового товара
$sql = "SELECT `auto_increment` FROM information_schema.tables WHERE table_schema='" . DB_NAME . "' AND table_name='"
    . TABLE_PRODUCT . "'";
$newID = getSingle($sql);
var_dump((int)$newID['auto_increment']);
echo 'test';
