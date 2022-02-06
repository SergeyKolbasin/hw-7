/*
 *  Выборка данных для корзины активного юзера
 */
/* Первый вариант
SELECT gallery.id, gallery.name, gallery.price, baskets.amount FROM gallery
    INNER JOIN baskets ON baskets.productid=gallery.id
    WHERE baskets.userid=7;                 -- 7 - это идентификатор пользователя, соответствующий полю users.id
*/
SELECT baskets.id, baskets.productid, gallery.name, gallery.price, baskets.amount FROM baskets
    INNER JOIN gallery ON baskets.productid=gallery.id
    WHERE baskets.userid=7;                 -- 7-это идентификатор пользователя, соответствующий полю users.id
/*
 *  Выборка данных из корзины одной позиции товара активного юзера
 */
SELECT baskets.id, baskets.productid, gallery.name, gallery.url, gallery.price, baskets.amount FROM baskets
    INNER JOIN gallery ON (baskets.productid=gallery.id) AND (baskets.id=$id)