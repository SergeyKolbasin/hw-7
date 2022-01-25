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
    <h3>{{NAME}}</h3>
    <div class="container">
        <div class="img">
            <img src="{{URL}}" alt="{{NAME}}">
        </div>
        <div class="txt">
            <span>{{DESCRIPTION}}</span>
        </div>
        <p>Просмотров: {{VIEWS}}</p>
        <a href="/gallery.php"><< В зоопарк</a>
        <br>
        <a href="/index.php">На главную</a>
    </div>
    <br>
</body>
</html>
