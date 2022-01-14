<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Задача №1</title>
    </head>
<body>
<h3>Задача №1:</h3>
<p>Создать форму-калькулятор c операциями: сложение, вычитание, умножение, деление. Не забыть
    обработать деление на ноль!:</p>

<?php
    require_once '../config/config.php';
    if (count($_POST)) {
        // Проверка на существование и инициализация переменных
        $result = 0;
        if (isset($_POST['a'])) {
            $a = $_POST['a'];
        } else {
            $a = 0;
        }
        if (isset($_POST['b'])) {
            $b = $_POST['b'];
        } else {
            $b = 0;
        }
        if (isset($_POST['mathOperation'])) {
            $mathOperation = MATH_OPERATION[$_POST['mathOperation']];
        } else {
            $mathOperation = MATH_OPERATION[0];     // По умолчанию - сложение
        }
    }
    // Вызов функции математических операций
    if(isset($a) && isset($b)) {
        $result = fMathOperation($a, $b, $mathOperation);
    }
?>

<!-- Форма калькулятора -->
<form method="post">
    <!-- Ввод аргумента A -->
    <input type="number" step="any" name="a" value="<?php if (isset($a)) echo $a; ?>" required>
    <!-- Выбор математической операции калькулятора -->
    <select name="mathOperation">
        <?php
            // Отображение операций калькулятора
            foreach (MATH_OPERATION as $key => $mathVal) {
                    // Определение последней математической операции
                    if ($mathOperation == $mathVal) {
                        echo "<option selected value=$key>$mathVal</option>";
                    } else {
                        echo "<option value=$key>$mathVal</option>";
                    }
                }
        ?>
    </select>
    <!-- Ввод аргумента B -->
    <input type="number" step="any" name="b" value="<?php if (isset($b)) echo $b; ?>" required>
    <input type="submit" value="=">
    <!-- Вывод результата -->
    <input type="text" name="result" value="<?php if (isset($result)) echo $result; ?>" readonly>
</form>
</body>
</html>