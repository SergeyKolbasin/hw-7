<?php
/*
 * Функции для работы с личным кабинетом
 */
require_once __DIR__ . '/../config/config.php';
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
 * @param   string      $address        адрес
 * @param   string      $email          e-mail
 * @param   integer     $role           роль в системе
 * @return  integer                     количество записей, затронутых запросом
 */
function insertUser($login, $description, $address, $email, $role): int
{
    $db = createConnection();
    // Защита
    $login = realEscape($db, $login);
    $description = realEscape($db, $description);
    $address = realEscape($db, $address);
    $email = realEscape($db, $email);
    $role = realEscape($db, $role);
    // Добавление в БД
    $sql = "INSERT INTO `users`(`login`, `description`, `address`, `email`, `role`)
                VALUES ('$login', '$description', '$address', '$email', 'role')";
    return execQuery($sql, $db);
}
