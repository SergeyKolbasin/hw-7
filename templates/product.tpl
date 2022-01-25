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
        <a href="editProduct.php?id={{ID}}">Редактировать</a>&nbsp
        <a href="deleteProduct.php?id={{ID}}">Удалить</a>&nbsp
        <a href="insertProductBasket.php?id={{ID}}">В корзину</a>
    </header>
    <h3>{{NAME}}</h3>
    <div class="container">
        <div class="img">
            <img src="{{URL}}" alt="{{NAME}}" width="800" height="600">
        </div>
        <div class="txt">
            <span>{{DESCRIPTION}}</span>
            <p>Просмотров: {{VIEWS}}</p>
            <p><b>Цена: {{PRICE}}</b></p>
        </div>
    </div>
    <br>
</body>
</html>
