<?php
/*
 * Функции для работы с новостями
 */

/** Получение новостей из БД
 *
 * @param   string  $sql    Выражение SQL-запроса для получения новостей
 * @return  array           Массив с новостями
 */
function getNews()
{
    $sql = "SELECT * FROM gallery_news ORDER BY `gallery_news`.`date` DESC";
    return getAssocResult($sql);
}

/** Отображение новостей на страницу
 *
 * @param   array   $news   Массив новостей
 * @return  text            HTML-код новостей
 */
function renderNews($news)
{
    $newsContent = '';
    foreach($news as $newsItem) {
        $newsContent .= render(TEMPLATES_DIR . 'newsItem.tpl', $newsItem);
    }
    return $newsContent;
}