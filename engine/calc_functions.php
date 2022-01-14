<?php
/*
 * Функции для работы калькуляторов
 */
    require_once '../config/config.php';
    /** Функция сложения
     *
     * @param number $a Первое слагаемое
     * @param number $b Второе слагаемое
     * @return number   Результат сложения
     */
    function fMathAdd($a = 0, $b = 0) {
        return $a + $b;
    }
    /** Функция вычитания
     *
     * @param number $a Уменьшаемое
     * @param number $b Вычитаемое
     * @return number   Разность
     */
    function fMathSub ($a = 0, $b = 0) {
        return $a - $b;
    }
    /** Функция умножения
     *
     * @param number $a Множимое
     * @param number $b Множитель
     * @return number   Произведение
     */
    function fMathMul ($a = 0, $b = 0) {
        return $a * $b;
    }
    /** Функция деления
     *
     * @param number $a Делимое
     * @param number $b Делитель
     * @return number   Частное
     */
    function fMathDiv ($a = 0, $b = 1) {
        if ($b == 0) {
            return 'На 0 делить нельзя!';
        } else {
            return $a / $b;
        }
    }
    /** Функция вызова математических операций
     *
     * @param number $argA          Аргумент A
     * @param number $argB          Аргумент B
     * @param string $mathOperation Математическая операция
     * @return mixed                Результат математической операции
    */
    function fMathOperation(
        $argA,                  // аргумент A
        $argB,                  // аргумент B
        $mathOperation          // математическая операция: "+", "-", "*" или "/"
    )
    {
        switch ($mathOperation) {
            case '+':                                   // Сложение
                if (isset($argA) && isset($argB)) {
                    return fMathAdd($argA, $argB);
                }
                break;
            case '-':                                   // Вычитание
                if (isset($argA) && isset($argB)) {
                    return fMathSub($argA, $argB);
                }
                break;
            case '*':                                   // Умножение
                if (isset($argA) && isset($argB)) {
                    return fMathMul($argA, $argB);
                }
                break;
            case '/':                                   // Деление
                if (isset($argA) && isset($argB)) {
                    return fMathDiv($argA, $argB);
                }
                break;
            default:                                    // Если по какой-то причине операция не определена
                return "Неверно задана операция";
        }
    }
    