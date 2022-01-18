<?php
/*
 * Отображение страницы новостей
 */
require_once '../config/config.php';
// Отображение меню
echo render(TEMPLATES_DIR . 'menu.tpl', []);
// Отображение новостей
$news = getNews();
$content = renderNews($news);
echo  render(TEMPLATES_DIR . 'news.tpl', [
    'title'     =>  'Новости',
    'h3'        =>  'Новости',
    'content'   =>  'На этой странице публикуются новости нашего зоопарка',
]);

echo renderNews($news);