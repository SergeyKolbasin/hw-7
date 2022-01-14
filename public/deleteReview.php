<?php
    require_once '../config/config.php';
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    if (!$id) {
        echo 'id не передан';
        exit();
    }
    $review = getReview($id);
    $author = $_POST['author'] ?? $review['author'];
    $text = $_POST['text'] ?? $review['text'];
    
    // Удаляем комментарий
    if (deleteReview($id)) {
        echo 'Удален комментарий: ';
        echo '"' . $author . ': ' . $text . '"';
    } else {
        echo 'Произошла ошибка';
    }
?>
<!-- Возврат из формы удаления -->
<br><br>
<a href="reviews.php">Обратно в отзывы</a><br>
<a href="index.php">На главную</a>
