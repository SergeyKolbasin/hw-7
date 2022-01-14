<!-- Изображение -->
<!doctype>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <style type="text/css">
        .img {
            float: left;
            margin-right: 1%;
        }
    </style>
    <title>{{NAME}}</title>
</head>
<body>
    <header>
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/news.php">Новости</a></li>
            <li><a href="/gallery.php">Товары</a></li>
            <li><a href="/reviews.php">Отзывы</a></li>
            <li><a href="/contacts.php">Контакты</a></li>
        </ul>
    </header>
    <h3>{{NAME}}</h3>
    <div class="container">
        <div class="img">
            <img src="{{URL}}" alt="{{NAME}}">
        </div>
        <div class="txt">
            <span>{{DESCRIPTION}}</span>
        </div>
        <p>Просмотров: {{VIEWS}}</p>
        <a href="/gallery.php"><< Назад</a>
        <br>
        <a href="/index.php">На главную</a>
    </div>
    <br>
</body>
</html>
