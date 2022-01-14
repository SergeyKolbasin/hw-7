<?php
/*
 * Функции для работы с отзывами
 */

/**
 * Получение отзывов из БД
 * @param   string  $sql    Выражение sql-запроса для получения отзывов
 * @return  array           Массив с отзывами
 */
function    getReviews(): array
{
    $sql = "SELECT * FROM gallery_reviews ORDER BY `gallery_reviews`.`date` DESC";
    return getAssocResult($sql);
}

/**
 * Выборка одного отзывае по его id
 * @param       integer    $id  Идентификатор отзыва
 * @return      array           Массив, содержащий поля отзыва
 */
function getReview($id) {
    $id = (int)$id;
    $sql = "SELECT * FROM `gallery_reviews` WHERE `id`=$id";
    return getSingle($sql);
}

/** Отображение отзывов на страницу
 *
 * @param   array   $reviews    Массив отзывов
 * @return  string              HTML-код отзывов
 */
function renderReviews($reviews)
{
    $reviews = getReviews();
    $reviewsContent = '';
    $reviewsContent .= '<div class=\"reviews\">';
    foreach($reviews as $review) {
        $reviewsContent .= $review['date'] . ': ' . $review['author'] . ': ' . $review['text'];
        // Ссылка на редактирование
        $reviewsContent .= " <a href=\"editReview.php?id=" . $review['id'] . "\">Редактировать</a>";
        // Ссылка на удаление
        $reviewsContent .= " <a href=\"deleteReview.php?id=" . $review['id'] . "\">Удалить</a>";
        $reviewsContent .= '<br>';
    }
    $reviewsContent .= '<div>';
    return $reviewsContent;
}
    
/** Вставка отзыва
 *
 * @param   string  $author Автор отзыва
 * @param   string  $text   Текст отзыва
 * @return  boolean         Результат выполнения вставки отзыва
 */
function insertReview($author, $text) {
    $db = createConnection();
    // Защита введенных выражений
    $author = realEscape($db, $author);
    $text = realEscape($db, $text);
    $sql = "INSERT INTO `gallery_reviews`(`author`, `text`) VALUES ('$author', '$text')";
    return execQuery($sql, $db);
}

/** Редактирование отзыва
 * @param   integer     $id     Идентификатор отзыва
 * @param   string      $author Автор отзыва
 * @param   $text       $text   Текст отзыва
 * @return  boolean             Результат выполнения редактирования
 */
function updateReview($id, $author, $text) {
    $db = createConnection();
    $id = (int)$id;
    // Защита от тегов
    $author = realEscape($db, $author);
    $text = realEscape($db, $text);
    $sql = "UPDATE `gallery_reviews` SET `author`='$author', `text`='$text' WHERE `id`=$id";
    return execQuery($sql, $db);
}

/** Удаление отзыва
 * @param   integer   $id       Идентификатор отзыва
 * @return  boolean             Результат удаления
 */
function deleteReview($id) {
    $db = createConnection();
    $id = (int)$id;
    $sql = "DELETE FROM `gallery_reviews` WHERE `id`=$id";
    return execQuery($sql, $db);
}