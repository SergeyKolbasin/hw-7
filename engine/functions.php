<?php
require_once '../config/config.php';
/** Функция вывода шаблона
 *
 * @param   string    $file         Имя и полный путь к файлу шаблона
 * @param   array     $variables    Массив переменных, переданных в шаблон
 * @return  string                  HTML документ
 */
function render($file = '', $variables = [])
{
	if (!is_file($file)) {
		echo 'Файл шаблона "' . $file . '" не найден';
		exit();
	}
	if (filesize($file) === 0) {
		echo 'Файл шаблона "' . $file . '" пуст';
		exit();
	}
	
	$templateContent = file_get_contents($file);
	
	if (empty($variables)) {
	    return $templateContent;
    }
    // Просмотрим все переменные, переданные в шаблон
	foreach ($variables as $varName => $varValue) {
		if (is_array($varValue)) {
			continue;
		}
		$varName = '{{' . strtoupper($varName) . '}}';
		$templateContent = str_replace($varName, $varValue, $templateContent);
	}
	return $templateContent;
}

/** Функция получения расширения файла
 *
 * @param   string      $fileName       имя файла
 * @return  string                      расширение файла с точкой
 */
function getExtension($fileName = ''): string
{
    return substr($fileName, strrpos($fileName, '.'));
}

/** Функция вывода отображения меню сайта
 */
function mainMenu()
{
    // показать в меню вход или выход
    if (!isset($_SESSION['login'])) {
        //echo '<ul><li><a href="' . WWW_DIR . 'login.php">Войти</a></li></ul>';
        echo '<ul><li><a href="../login.php">Войти</a></li></ul>';
    } else {
        echo 'Вы вошли как <i>' . $_SESSION['login']['description'] . '</i>';
        //echo '<ul><li><a href="' . WWW_DIR . 'logout.php">Выйти</a></li></ul>';
        echo '<ul><li><a href="../logout.php">Выйти</a></li></ul>';
    }
    // главное меню
    echo render(TEMPLATES_DIR . 'mainMenu.tpl', []);
}