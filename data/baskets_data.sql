/*
 *  Выборка данных для корзины активного юзера
 */
SELECT gallery.id, gallery.name, gallery.price, baskets.amount FROM gallery
    INNER JOIN baskets ON baskets.productid=gallery.id
    WHERE baskets.userid=7                  -- 7 - это идентификатор пользователя, соответствующий полю users.id
        ORDER BY gallery.name ASC