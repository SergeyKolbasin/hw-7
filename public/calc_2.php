<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Задание №2</title>
    </head>
<body>
<h3>Задача 2:</h3>
<p>Создать калькулятор, который будет определять тип выбранной пользователем операции,
    ориентируясь на нажатую кнопку:</p>

<?php
    if (count($_POST)) {
        // Проверка на существование и инициализация переменных
        // Это всего лишь демонстрация, т.к. в тегах <input> формы присутствует аргумент required
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
        // Определение математической операции
        if (isset($_POST['mathOperation'])) {
            $mathOperation = $_POST['mathOperation'];
        } else {
            $mathOperation = '+';     // Если не определена, то сложение
        }
    }
?>

<!-- Форма калькулятора -->
<form method="post">
    <input type="number" step="any" name="a" value="<?php if (isset($a)) echo $a; ?>" required>
    <?php
        // Вывод знака математической операции
        if (isset ($mathOperation)) {
            echo "&nbsp <bold>$mathOperation</bold> &nbsp";
        } else {
            echo '&nbsp; &nbsp; &nbsp; &nbsp;';
        }
    ?>
    <input type="number" step="any" name="b" value="<?php if (isset($b)) echo $b; ?>" required>
    <strong>=</strong>
    <?php
        require_once '../config/config.php';
        // Определение математической операции после нажатия на ее кнопке
        if (isset($_POST['mathOperation'])) {
            $mathOperation = $_POST['mathOperation'];
        }
        // Вызов функций математических операций
        if(isset($a) && isset($b)) {
            $result = fMathOperation($a, $b, $mathOperation);
        }
    ?>
    <!--Вывод результата в отдельное поле-->
    <input type="text" name="result" value="<?php if (isset($result)) echo $result; ?>" readonly>
    <br><br>
    <!--Кнопки математических операций-->
    <button value="+" name="mathOperation">+</button>
    <button value="-" name="mathOperation">-</button>
    <button value="*" name="mathOperation">*</button>
    <button value="/" name="mathOperation">/</button>
</form>
</body>
</html>