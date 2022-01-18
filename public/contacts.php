<?php
require_once '../config/config.php';

// Отображение меню
echo render(TEMPLATES_DIR . 'menu.tpl', []);
// Отображение контактов
echo render(TEMPLATES_DIR . 'contacts.tpl', [
    'title'     => 'Контакты',
    'h4'        => 'Мои контакты:',
    'content'   => 'Пишите мне почаще<br><br>'
]);