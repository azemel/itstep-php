<?php

# 1. Синтаксис

/**
 * Проверяет является ли значение целым числом
 * @param $value значени для проверки
 */
function isIntValue($value) {
  return strval((int)$value) === strval($value);
}


/**
 * Возводит число в степень
 * @param int|float $base основание степени
 * @param int $power (optional) показатель степени
 */
function power($base, int $power = 2) {

  if (!is_numeric(($base))) {
    return false;
  }

  if (!isIntValue($power)) {
    return false;
  }

  $result = 1;
  if ($power >= 0) {
    while ($power--) $result *= $base;
  } else {
    while ($power++) $result /= $base;
  } 
  return $result;
}

// var_dump(power(4, 0));

function glue($glue, ...$values) {
  var_dump($values);
  // return implode($glue, $values);
}


// var_dump(glue(",", 1, 23, 45, "end"));

// ! sum arrays

# 1.1 Функции в контексте

// Для глобальных функций порядок не важен. т.к. кросс референс

# 1.2

$isFuncNeeded = true;

if ($isFuncNeeded) {
  
  function func() {
    var_dump("Called!");
    func2();
  }

  function func2() {
    var_dump("Called2!");
  }

  // func();  
}


# 2. Scope

$global = 1;

function scope($global) {
  // global $global;
  $global *= 2;
  return $global;
}

// var_dump($global);
// var_dump(scope($global));
// var_dump($global);

function staticVar() {
  static $static = 2;
  $static *= 2;
  return $static;
}

// var_dump(staticVar());
// var_dump(staticVar());


# 3. Анонимные и use

$func = function($a) { return $a * $a; };

// var_dump(call_user_func($func, 2));

var_dump($func(2));

function outer() {
  $outer = 3;
  
  $callback = function () use ($outer) {
    echo "called! ($outer)";
  };

  $outer = 4;

  call_user_func(function () use ($outer) {
    echo "called! ($outer)";  
  });

  return $callback;
}

$callback = outer();
call_user_func($callback);

# 3.1

// var_dump(array_filter([1, 2 , 3, 4], function($i) {
//   return $i % 2 === 0;
// }));


// var_dump(filter_var(-10.2, FILTER_VALIDATE_INT));

