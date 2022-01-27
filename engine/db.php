<?php
/*
 * Функции работы с БД
 */

/** Создание соединения с БД
 *
 * @param string DB_HOST    Доменное имя сервера
 * @param string DB_USER    Имя пользователя
 * @param string DB_PASS    Пароль
 * @param string DB_NAME    Имя БД
 * @return mixed            Объект, представляющий связь с БД или false
 */
function createConnection()
{
    $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);   // Подключение к БД
    // Обработка ошибки подключения к БД
    if (!$db) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        die;
    }
    mysqli_set_charset($db, 'utf8');                            // Установка кодировки UTF-8
    return $db;
}

/** Выполнение SQL-запроса
 * Применяется только для модификации данных !!!
 *
 * @param   string  $sql    SQL-запрос
 * @param   object  $db     Объект, представляющий связь с БД
 * @return  bool            Результат функции mysqli_query()
 */
function execQuery($sql, $db=null)
{
    if (!$db) {                             // Создание соединения, если его нет
        $db = createConnection();
    }
    $result = mysqli_query($db, $sql);      // Выполнение запроса
    mysqli_close($db);                      // Закрытие соединения
    return $result;
}

/** Создание соединения, выполнение запроса и возврат результата запроса, как результата выполнения функции
 * Применяется для выборки данных
 *
 * @param   string      $sql    SQL-запрос
 * @return  array               $Возвращает ассоциативный массив с выборкой
 */
function getAssocResult($sql)
{
    $db = createConnection();                       // Создание соединения
    $result = mysqli_query($db, $sql);              // Выполнение запроса к БД
    $arrayResult = [];                              // Объявление массива для возврата выборки
    while ($row = mysqli_fetch_assoc($result)) {    // Цикл по результирующему ряду выборки
        $arrayResult[] = $row;                          // Добавление элемента выборки в результирующий массив
    }
    mysqli_close($db);                              // Закрытие соединения с БД
    return $arrayResult;
}

/** Выборка единственной записи из б/д
 *
 * @param   string      $sql    SQL-запрос
 * @return  array               Возвращает ассоциативный массив с выборкой или NULL
 */
function getSingle($sql)
{
    $result = getAssocResult($sql);
    if (empty($result)) {
        return NULL;
    }
    return $result[0];
}

/** Преобразуем строку в безопасную для выполнения SQL-выражения
 *
 * @param   mysqli    $dbLink       готовое подключение к БД
 * @param   string    $string       SQL-строка запроса, которую необходимо защитить
 * @return  string                  Возвращает безопасную строку SQL-выражения
 */
function realEscape($dbLink, $string) {
    return mysqli_real_escape_string($dbLink, (string)htmlspecialchars(strip_tags($string)));
}