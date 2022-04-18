/*
 *  Выборка данных для корзины активного юзера
 */
/* Первый вариант
SELECT gallery.id, gallery.name, gallery.price, basket.amount FROM gallery
    INNER JOIN basket ON basket.productid=gallery.id
    WHERE basket.userid=7;                 -- 7 - это идентификатор пользователя, соответствующий полю users.id
*/
SELECT basket.id, basket.productid, gallery.name, gallery.price, basket.amount FROM basket
    INNER JOIN gallery ON basket.productid=gallery.id
    WHERE basket.userid=7;                 -- 7-это идентификатор пользователя, соответствующий полю users.id
/*
 *  Выборка данных из корзины одной позиции товара активного юзера
 */
SELECT basket.id, basket.productid, gallery.name, gallery.url, gallery.price, basket.amount FROM basket
    INNER JOIN gallery ON (basket.productid=gallery.id) AND (basket.id=$id)