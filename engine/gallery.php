<?php
/*
 * Функции работы с галереей
 */
require_once '../config/config.php';

/** Функция формирует и возвращает HTML-код отображения галереи
 *
 * @param   array   $fArrayImages   Массив с информацией о фотографиях - выборка из БД
 * @param   integer $fColumns       Количество столбцов в строке
 * return   html                    HTML документ отображения галереи
 */
function renderGallery(
    $fArrayImages = [],      // Массив с иформацией о фотографиях - выборка из БД
    $fColumns = 3            // Количество столбцов в строке по умолчанию
)
{
    // ПЕРЕМЕННЫЕ
    $urls = $fArrayImages;   // Массив фото
    $k = 0;                  // Счетчик картинок в строке
    $result = '';            // Формируемый HTML-код отображения галереи
    
    // КОД
    $result .= '<table>';                                               // Открывем тег таблицы
    //  Цикл по всем файлам в галерее
    foreach ($urls as $url) {
        if ($k % $fColumns == 0) echo '<tr>';                                               // Добавляем строку
        $result .= '<td>';                                                                  // Начинаем столбец
            $result .= '<a href=image.php?id=' . strval($url['id']) . '>';                  // Формируем ссылку
            $result .= '<img src=' .  $url['url'] . ' alt=' . $url['name'] . ' width="100"/>';  // Формируем превью
            $result .= '<br>' . $url['name'];
            $result .= '</a>';                                                              // Закрываем ссылку
        $result .= '</td>';                                                                 // Закрываем столбец
        if ((($k + 1) % $fColumns == 0)) {                          // Переходим на следеющею строку при заполнении
            $result .= '</tr>';                                 // Закрываем тег строки
        }
        $k++;                       // Увеличиваем  счётчик картинок в строке
    }
    $result .= '</table>';          // Закрываем тег таблицы
    return $result;                 // Возвращаем HTML-код отображения галереи
}

/** Функция получает выборку из БД об отображаемых фото
 *
 * @param   string  $sql    Выражение SQL-запроса
 * @param   string  $sql    Выражение SQL-запроса
 * @return  array           Массив с информацией об отображаемых фотографиях
 */
function getImages($sql)
{
    $result = getAssocResult($sql);     // Получаем инфу из БД
    return $result;                     // и возвращаем ее ассоциативным массивом
}

/** Функция получает информацию об одном фото по его id
 *
 * @param   integer    $id    Идентификатор фотографии
 * @return  array             Массив с информацией об отображаемой фотографии
 */
function getImage($id)
{
    $id = (int)$id;                                     // Превращаем id в число
    $sql = "SELECT * FROM `gallery` WHERE `id` = $id";  // Формируем SQL-запрос
    return getSingle($sql);                             // и возвращаем результат, выполняя его
}

/** Функция возвращает HTML-код отображения страницы фото из БД по его id
 *
 * @param   integer     $id     Идентификатор отображаемой фотографии
 * @return  array               HTML-код отображения страницы с фото
 */
function showImage($id)
{
    $_SESSION['originalURL'] = $_SERVER['REQUEST_URI']; // сохранения для возврата на эту же страницу
    mainMenu();

    $id = (int)$id;                                             // Преобразуем id в число
    $image = getImage($id);                                     // Получаем информацию о фото
    if (empty($image)) {                                        // Если информация о фото отсутствует в базе
        echo "Ошибка 404, фотографии с id=$id нет в базе!";             // Выводим сообщение об ошибке
        die;
    }
    if (!file_exists($image['url'])) {                                     // Если запрашиваемый файл отсутствует
        echo 'Ошибка 404, файл "' . $image['url'] . '" отсутствует!';      // Выводим сообщение об ошибке
        die;
    }
    $image['views']++;                                      // Увеличиваем количество просмотров на 1
    updateViews($id, $image['views']);                      // Запишем их в БД
    return render(TEMPLATES_DIR . 'product.tpl', $image);   // Возвращаем HTML-код отображения страницы с фото
}


/** Функция записывает количество просмотров фото заданного $id в БД
 *
 * @param   integer     $id     Идентификатор фотографии
 * @param   integer     $views  Количество записываемых просмотров
 * @return  boolean             Результат обновления записи таблицы
 */
function updateViews(
    $id,                // id фотографии
    $views              // Количество записываемых просмотров
)
{
    $id = (int)$id;                                                       // Преобразуем $id в число
    $viewsStr = strval($views);                                           // Число преобразем в строку
    $sql = "UPDATE `gallery` SET `views`=$viewsStr WHERE `id` = $id";     // Формируем SQL-запрос
    return execQuery($sql);                                               // Выполняем его
}

/** Редактирование карточки товара
 * @param   integer     $id             идентификатор
 * @param   string      $name           наименование товара
 * @param   string      $description    описание товара
 * @param   float       $price          цена товара
 * @return  integer                     количество записей, затронутых запросом
 */
function updateProduct($id, $name, $description, $price): int
{
    $db = createConnection();
    $id = (int)$id;
    // Защита
    $name = realEscape($db, $name);
    $description = realEscape($db, $description);
    $price = (float)$price;
    // Обновление в БД
    $sql = "UPDATE `gallery` SET `name`='$name', `description`='$description', `price`='$price' WHERE `id`=$id";
    return execQuery($sql, $db);
}

/** Добавление карточки товара
 * @param   string      $name           наименование товара
 * @param   string      $description    описание товара
 * @param   float       $price          цена товара
 * @param   string      $url            расположение на сайте
 * @param   integer     $size           размер файла в байтах
 * @return  integer                     количество записей, затронутых запросом
 */
function insertProduct($name, $description, $price, $url, $size): int
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

/** Получение имени файла для добавления нового изображения товара, имя файла = его ID в БД
 *
 * @return  string          Числовое имя нового товара, соответствует ID в БД
 *                          или '0', если произошла ошибка
 */
function getProductName(): string
{
    $sql = "SELECT `auto_increment` FROM information_schema.tables WHERE table_schema='" . DB_NAME . "' AND table_name='" . TABLE_PRODUCT . "'";
    $newID = getSingle($sql);
    if ($newID !== NULL) {
        return (string)$newID['auto_increment'];
    } else {
        return '0';
    }
}

/** Удаление товара
 * @param   integer   $id       Идентификатор отзыва
 * @return  boolean             Результат удаления
 */
function deleteProduct($id): bool
{
    $db = createConnection();
    $id = (int)$id;
    $sql = "DELETE FROM `gallery` WHERE `id`=$id";
    return execQuery($sql, $db);
}

/** Функция вывода отображения меню сайта
 */
function mainMenu()
{
    // показать в меню вход или выход
    if (!isset($_SESSION['login'])) {
        echo '<ul><li><a href="login.php">Войти</a></li></ul>';
    } else {
        echo 'Вы вошли как <i>' . $_SESSION['login']['description'] . '</i>';
        echo '<ul><li><a href="logout.php">Выйти</a></li></ul>';
    }
    // главное меню
    echo render(TEMPLATES_DIR . 'mainMenu.tpl', []);
}

/** Добавление товара в корзину
 * @param   integer   $id       Идентификатор товара
 * @return  boolean             Результат удаления
 */
function insertProductBasket($id)
{
    $product = getImage($id);
    $price = $product['price'];

    //echo '<script>alert("Продукт ' . $name . ' с id=' . $id . ' добавлен в корзину")</script>';
    echo '<script>alert("Продукт ' . $product['name'] . ' с id=' . $id . ' добавлен в корзину")</script>';
}