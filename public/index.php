<?php
require_once '../config/config.php';
// Отображение главной страницы сайта
echo render(TEMPLATES_DIR . '/index.tpl', [
        'title'     => 'Фото-зоопарк',
        'head'      => 'Фото-зоопарк',
        'content'   => 'На этом сайте вы можете посмотреть и приобрести фотографии животных',
        'image'     => IMG_DIR . 'main.jpg',
        'alt'       => 'ЗООПАРК'
]);