/*
 *  Выборка данных для корзины активного юзера
 */
/* Первый вариант
SELECT gallery.id, gallery.name, gallery.price, baskets.amount FROM gallery
    INNER JOIN baskets ON baskets.productid=gallery.id
    WHERE baskets.userid=7                  -- 7 - это идентификатор пользователя, соответствующий полю users.id
        ORDER BY gallery.name ASC
*/
SELECT baskets.id, baskets.productid, gallery.name, gallery.price, baskets.amount FROM baskets
    INNER JOIN gallery ON baskets.productid=gallery.id
    WHERE baskets.userid=7                  -- 7-это идентификатор пользователя, соответствующий полю users.id
        ORDER BY baskets.id ASC