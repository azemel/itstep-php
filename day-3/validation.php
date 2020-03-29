<?php

# Основаная функция валидации формы

/**
 * Функция проверяет и нормализует входные данные формы
 * в соотвествии с указанной схемой валидации
 * 
 * !! Функция должна принимать аргументы и возвращать значения в том формате что указа здесь
 * 
 * Если будете реализовывать возможность последовательных валидаторов, не забудьте, 
 * во-первых, что возникновение ошибки в одном из валидаторов должно останавливать проверку текущего поля
 * во-вторых, очищенные значения должны передаваться по цепочке
 * 
 * @param mixed[] $scheme схема валидации 
 * @param string[] $form данные формы 
 * @return array[] Возврвщвет массив нормальизованных данных и массив ошибок
 */
function validateForm($scheme, $form) {
  $clean = $form;
  $errors = [];
  // > Ваша реализация
  
  return [$clean, $errors];
}


# Функции валидации и вспомогательные функции 

// !! Можно менять в соответсвии с вашей идеей архитектуры

// require
// clearExtraSpaces
// integer
// bool
// ...Другие валидаторы, которые вам понадобятся


/**
 * Генерирует функцию, котрая проверяет, что число находится в промежутке
 * @param int $min нижняя граница
 * @param int $max верхняя граница
 * @return callable функция-валидатор 
 */
function generateRangeValidator($min = 0, $max = PHP_INT_MAX) {
  return function($value) use ($min, $max) {
    $clean = "";
    $error = null;
  
    return [$clean, $error];
  };
}


/**
 * Генерирует функцию, котрая проверяет, что длина строки находится в промежутке
 * @param int $min нижняя граница
 * @param int $max верхняя граница
 * @return callable функция-валидатор 
 */
function generateLengthValidator($min = 0, $max = PHP_INT_MAX) {
  return function($value) use ($min, $max) {
    $clean = "";
    $error = null;
    
    return [$clean, $error];
  };
}

/**
 * Генерирует функцию, котрая проверяет, что значение соответсвует регулярному выражению
 * @param int $regexp регулярное выражение для проверки
 * @return callable функция-валидатор 
 */
function generateRegExpValidator($regexp) {
  return function($value) use ($regexp) {
    $clean = "";
    $error = null;
  
    return [$clean, $error];
  };
}

