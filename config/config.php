<?php

    // Старт сессии
    session_start();

    // Каталоги сайта
    define('SITE_DIR', __DIR__ . '/../');                       // Выход на один уровень вверх в структуре каталогов сайта
    define('CONFIG_DIR', SITE_DIR . 'config/');                 // Конфигурация
    define('DATA_DIR', SITE_DIR . 'data/');                     // Данные
    define('ENGINE_DIR', SITE_DIR . 'engine/');                 // Функционал
    define('WWW_DIR', SITE_DIR . 'public/');                    // Каталог, доступный посетителям сайта
    define('TEMPLATES_DIR', SITE_DIR . 'templates/');           // Шаблоны
    define('SMARTY_TPL_DIR', SITE_DIR . 'smarty/templates/');   // Шаблоны шаблонизатора Smarty
    define('IMG_DIR', 'img/');                                  // Изображения
    define('PRODUCT_DIR', IMG_DIR . 'product/');                // Фотографии товаров
    define('USERS_DIR', IMG_DIR . 'users/');                    // Фотографии юзеров

    // Константы соединения с б/д
    define('DB_HOST', 'hw');                            // Доменное имя сервера
    define('DB_USER', 'jetsaus');                       // Имя пользователя
    define('DB_PASS', 'opdf117!');                      // Пароль
    define('DB_NAME', 'jetsaus');                       // Имя БД
    
    // Прочие константы
    define('COLUMNS', 4);                               // Количество колонок при отображении галереи
    define('TABLE_PRODUCT', 'gallery');                 // Имя таблицы с товарами
    define('TABLE_USER', 'users');                      // Имя таблицы юзеров
    define('MAX_FILE_SIZE', 30000000);                  // Максималный размер загружаемого файла

    require_once ENGINE_DIR . 'functions.php';              // Общепользовательские функции
    require_once ENGINE_DIR . 'db.php';                     // Функции работы с БД
    require_once ENGINE_DIR . 'gallery.php';                // Функции работы с галереей
    require_once ENGINE_DIR . 'news.php';                   // Функции работы с новостями
    require_once ENGINE_DIR . 'reviews.php';                // Функции работы с отзывами
    require_once ENGINE_DIR . 'users.php';                  // Функции работы с личным кабинетом
    require_once SITE_DIR . 'smarty/lib/Smarty.class.php';  // Подключение класса Smarty

