<?php
# 1. Типы данных

# 1.1 Boolean

$false = 0 || 0.0 || "" || "0" || []; // ! Обратите внимание что строка с "0" приводится к false
var_dump($false);

$true = 1 && 2.4 && "any other string" && ["non empty array"];
var_dump($true);


# 1.2 Integer

$int = 255;

// Шестнадцатиричная запись
var_dump($hex = 0xff); // 255

// Восьмиричная
var_dump($oct = 0377); // 255

// Двоичная
var_dump($hex = 0b11111111); // 255


# 1.3 Float

$decimal = 1.5; 

// Научная запись 
// 1.5 * 10^2
var_dump($scientific = 1.5e2); // float(150)
// 1.5 * 10^-2
var_dump($scientific = 1.5E-2); // float(0.015)

var_dump(1/3); //float(0.33333333333333)

// Если делимое или делитель float, то результат будет float, даже если получается целое число
var_dump(10.0/2); // float(5)

// Функции округления 
// ! Важно: возвращают тип float а не int
$float = 1.5;
// Математическое
var_dump(round(1.4)); // float(1)
var_dump(round(1.5)); // float(2)
// Вверх
var_dump(ceil(1.5)); // float(2)
// Вниз
var_dump(floor(1.5)); // float(1)

// ! Проблема точности
// ! Из-за особенностей представления чисел в формате float,
//   операции с ними могут давать неожиданные результаты
var_dump(floor((0.1 + 0.7) * 10)); // float(7), а не 8 как ожидается

// Для вычислений с большой точностью используйте библиотеку GMP 
// https://www.php.net/manual/ru/book.gmp.php


# 1.4 String

$key = "KEY";
$value = "VALUE";

// Строки в одинарных ковычках интерпретируют все символы как есть:
var_dump('The key is $key\nThe value is $value'); // string(36) The key is $key\nThe value is $value

// Cтроки в двойных ковычках распознают управляющие символы (\n \r \t)
// и подставлюят значения переменных
var_dump("The key is $key\nThe value is $value"); // string(33) 'The key is KEY (ПЕРЕНОС СТРОКИ) The value is VALUE'

// Значение может состоять из нескольких строк
var_dump($multiline = "
  Зайку бросила хозяйка -
  Под дождем остался зайка.
  Со скамейки слезть не мог,
  Весь до ниточки промок.
");

// Функции для работы со строками 
// https://www.php.net/manual/ru/ref.strings.php
// Функции для работы с Юникодом  
// https://www.php.net/manual/ru/ref.mbstring.php

var_dump(strlen("abcde")); // int(5) 
var_dump(strlen("абвгд")); // int(10) - каждый символ закодирован двумя байтами 
var_dump(mb_strlen("абвгд")); // int(5) - корректная длина для строки в юникоде

// Разбиение строки по разделителю
var_dump($split = explode(".", "12.12.2012")); //['12', '12', '2012']
// Склеивание строки
var_dump(implode("-", $split)); // 12-12-2012

// Поиск индекса подстроки
var_dump(mb_strpos("Эта функция вернет 4", "функция")); // int(4)

// Извлечение подстроки по индексу
var_dump(mb_substr("Эта функция вернет 'функция'", 4, 7)); // 'функция'

// Удаление пробелов (или других символов) с концов строки
var_dump(trim("   --!--  ")); // --!--
var_dump(trim("   --!--  ", " -")); // !

# 1.5 Массивы

var_dump($array = [1, 2, 3, "four"]);
var_dump($dictionary = [
  "name" => "Bob", 
  "color" => "red",
  "height" => 124,
  "fruits" => ["apple", "orange"] 
  ]);


// Проверка наличия ключа в массиве
var_dump(array_key_exists("name", $dictionary)); // true

// Функции для работы с массивами
// https://www.php.net/manual/ru/ref.array.php

// Деструктуризация массива

[$first, , , $last] = $array;
var_dump($first, $last); // 1 'four'

[
  "name" => $name, 
  "color" => $color,
  "fruits" => [ $fruit ] // Вложенная деструктуризация
] = $dictionary;

var_dump("$name has big $color $fruit"); // 'Bob has big red apple
