<?php
    /*
     * Отображение страницы отзывов
     */
    require_once '../config/config.php';
    $reviews = getReviews();
    
    // Добавляем в базу новый отзыв
    $author = $_POST['author'] ?? null;
    $text = $_POST['text'] ?? null;
    if ($author && $text) {
        if (insertReview($author, $text)) {
            echo 'Комментарий добавлен';
            $author = '';
            $text = '';
        } else {
            echo 'Произошла ошибка';
        }
    } elseif ($author || $text) {
        echo 'Форма не заполнена';
    }
    echo '<hr>';
    // Отображение меню
    mainMenu();
    // Заголовок отзывов
        echo  render(TEMPLATES_DIR . 'reviews.tpl', [
            'title'     =>  'Отзывы',
            'h3'        =>  'Отзывы',
            'content'   =>  'На этой странице публикуются отзывы о нашем зоопарке:',
        ]);
        // Отзывы
        echo renderReviews($reviews);
?>
<!-- Форма ввода отзыва -->
<h4>Добавьте ваш отзыв:</h4>
<form method="POST">
    <span>Ваше имя: </span><input type="text" name="author" value="<?= $author ?>"><br><br>
    <span>Комментарий: </span><textarea name="text"><?= $text ?></textarea><br><br>
    <input type="submit" value="Отправить">
</form>