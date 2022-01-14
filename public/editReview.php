<?php
/*
 * Редактирование отзыва
 */
    require_once '../config/config.php';
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    if (!$id) {
        echo 'id не передан';
        exit();
    }
    $review = getReview($id);
    $author = $_POST['author'] ?? $review['author'];
    $text = $_POST['text'] ?? $review['text'];
    // Проверка, редактировался ли отзыв
    if ($author !== $review['author'] || $text !== $review['text']) {
        if ($author && $text) {
            // Редактируем отзыв
            if (updateReview($id, $author, $text)) {
                echo 'Комментарий изменен';
            } else {
                echo 'Произошла ошибка';
            }
        } elseif ($author || $text) {
            echo 'Форма не заполнена';
        }
    }
    echo '<hr>';
?>
<h4>Редактировать отзыв:</h4>
<form method="POST">
    <span>Имя: </span><input type="text" name="author" value="<?= $author ?>"><br><br>
    <span>Комментарий: </span><textarea name="text"><?= $text ?></textarea><br><br>
    <input type="submit" value="Отправить">
</form>
<!-- Возврат из формы редактирования -->
<a href="reviews.php">Обратно в отзывы</a><br>
<a href="index.php">На главную</a>