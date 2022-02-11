<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина покупок</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h3>Корзина покупок:</h3>
    <table>
        <tr>
            <th>Вид</th>
            <th>Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Удаление</th>
        </tr>
        {foreach $basket as $basketItem}
            <tr>
                <td><img width="100px" src="{$basketItem.url}" alt="{$basketItem.name}"></td>
                <td>{$basketItem.name}</td>
                <td>{sprintf("%01.2f", $basketItem.price)}</td>
                <td>{$basketItem.amount}<a href="editBasketItem.php?id={$basketItem.id}"> - Изменить</a></td>
                <td><a href="deleteBasketItem.php?id={$basketItem.id}&productid={$basketItem.productid}">Удалить</a></td>>
            <!--
            <td><?php printf("%01.2f", $price * $amount) ?></td>
            -->
        </tr>
        {/foreach}
    </table>




</body>
</html>
