<?php
require_once '../config/config.php';

// Отображение меню
mainMenu();
// Отображение галереи
echo render(TEMPLATES_DIR . 'gallery.tpl',[
        'title'     => 'Фото-зоопарк',
        'head'      => 'Фото-зоопарк',
        //'content'   => renderGallery($htmlGallery, 5)
        'content'   => renderGallery(getImages('SELECT * FROM gallery ORDER BY `views` DESC'), COLUMNS)
]);