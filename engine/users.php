<?php
/*
 * Функции для работы с личным кабинетом
 */
/** Функция получает информацию об одном одном пользователе
 *
 * @param   integer    $id    Идентификатор фотографии
 * @return  array             Массив с информацией о пользователе системы
 */
function getUser($id)
{
    $id = (int)$id;                                     // Превращаем id в число
    $sql = "SELECT * FROM `users` WHERE `id` = $id";    // Формируем SQL-запрос
    return getSingle($sql);                             // и возвращаем результат, выполняя его
}

/** Получение имени файла для добавления фото нового юзера, имя файла = его ID в БД
 *
 * @return  string          Числовое имя фото, соответствует ID в БД
 *                          или '0', если произошла ошибка
 */
function getPhotoName(): string
{
    $sql = "SELECT `auto_increment` FROM information_schema.tables WHERE table_schema='" . DB_NAME . "' AND table_name='" . TABLE_USER . "'";
    $newID = getSingle($sql);
    if ($newID !== NULL) {
        return (string)$newID['auto_increment'];
    } else {
        return '0';
    }
}

/** Добавление учетки пользователя
 * @param   string      $login          логин
 * @param   string      $description    описание (ФИО)
 * @param   string      $email          e-mail
 * @param   integer     $role           роль в системе
 * @return  integer                     количество записей, затронутых запросом
 */
function insertUser($name, $description, $price, $url, $size): int
{
    $db = createConnection();
    // Защита
    $name = realEscape($db, $name);
    $description = realEscape($db, $description);
    $url = realEscape($db, $url);
    $size = (int)$size;
    $views = 0;                                     // колчество просмотров
    $price = (float)$price;
    // Добавление в БД
    $sql = "INSERT INTO `gallery`(`name`, `description`, `views`, `price`, `url`, `size`)
                VALUES ('$name', '$description', '$views', '$price', '$url', '$size')";
    return execQuery($sql, $db);
}
