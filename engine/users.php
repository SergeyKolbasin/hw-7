<?php
/*
 * Функции для работы с личным кабинетом
 */
require_once __DIR__ . '/../config/config.php';

/** Функция получает информацию об одном одном пользователе
 *
 * @param   integer    $id    Идентификатор пользователя
 * @return  array             Массив с информацией о пользователе системы
 */
function getUser($id)
{
    $id = (int)$id;                                     // Превращаем id в число
    $sql = "SELECT * FROM `users` WHERE `id` = $id";    // Формируем SQL-запрос
    return getSingle($sql);                             // и возвращаем результат, выполняя его
}

/** Функция определения существования логина в базе пользователей
 *
 * @param   string      $login              логин пользователя
 * @return  boolean                         существует или нет такой логин
 */
function presentLogin($login): bool
{
    $sql = "SELECT * FROM `users` WHERE `login` = '$login'";
    if (getSingle($sql) != NULL) {
        return true;                    // такой лонин уже существует в базе
    } else {
        return false;                   // такого логина нет в базе
    }
}

/** Функция определения ID нового юзера
 *
 * @return  string          ID нового юзера в БД
 *                          или '', если произошла ошибка
 */
function getID(): string
{
    $sql = "SELECT `auto_increment` FROM information_schema.tables WHERE table_schema='" . DB_NAME . "' AND table_name='" . TABLE_USER . "'";
    $newID = getSingle($sql);
    if ($newID !== NULL) {
        return (string)$newID['auto_increment'];
    } else {
        return '';
    }
}

/** Добавление учетки пользователя
 * @param   string      $login          логин
 * @param   string      $password       пароль
 * @param   string      $description    описание (ФИО)
 * @param   string      $address        адрес
 * @param   string      $email          e-mail
 * @param   integer     $role           роль в системе
 * @param   string      $photo          имя файла с фото
 * @return  integer                     количество записей, затронутых запросом
 */
function insertUser($login, $password, $description, $address, $email, $role, $photo): int
{
    $db = createConnection();
    // Защита
    $login = realEscape($db, $login);
    $password = password_hash(realEscape($db, $password), PASSWORD_DEFAULT);
    $description = realEscape($db, $description);
    $address = realEscape($db, $address);
    $email = realEscape($db, $email);
    // Добавление в БД
    $sql = "INSERT INTO `users`(`login`, `password`, `description`, `address`, `email`, `role`, `photo`)
                VALUES ('$login', '$password', '$description', '$address', '$email', '$role', '$photo')";
    return execQuery($sql, $db);
}

/** Изменение учетки пользователя
 * @param   string      $id             id юзера
 * @param   string      $password       пароль
 * @param   string      $description    описание (ФИО)
 * @param   string      $address        адрес
 * @param   string      $email          e-mail
 * @param   string      $photo          имя файла с фото
 * @return  integer                     количество записей, затронутых запросом
 */
function editUser($id, $password, $description, $address, $email, $photo): int
{
    $db = createConnection();
    // Защита
    $id = realEscape($db, $id);
    $password = $password = password_hash(realEscape($db, $password), PASSWORD_DEFAULT);
    $description = realEscape($db, $description);
    $address = realEscape($db, $address);
    $email = realEscape($db, $email);
    // Изменение в БД
    $sql = "UPDATE `users` SET `password`='$password', `description`='$description', `address`='$address', `email`='$email', `photo`='$photo'
             WHERE `id`=$id";
    return execQuery($sql, $db);
}
