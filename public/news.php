<?php
/*
 * Отображение страницы новостей
 */
require_once '../config/config.php';
$_SESSION['originalURL'] = $_SERVER['REQUEST_URI']; // сохранения для возврата на эту же страницу

// Отображение меню
mainMenu();
// Отображение новостей
$news = getNews();
$content = renderNews($news);
echo  render(TEMPLATES_DIR . 'news.tpl', [
    'title'     =>  'Новости',
    'h3'        =>  'Новости',
    'content'   =>  'На этой странице публикуются новости нашего зоопарка',
]);

echo renderNews($news);