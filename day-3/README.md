# День 3

## :house: Домашнее задание

### Задачи

1.  В файле [`validation.php`](./validation.php) реализовать валидацию построенную на функциях. Используйте Ваши наработки из предыдущего ДЗ [`hw2.php`](../day-2/hw2.php).  
Объявление функции `validatteForm` (т.е. аргументы, которые она принимает, и значение, которое она возврщает) менять нельзя. Остальные функции (`generateRangeValidator`, `generateLengthValidator` и т.д.), даны для примера. Можно изменять/заменять их в соответсвии с Вашей реализацией. 

1. В файле [`hw3.php`](./hw3.php) правильно подключить файл [`validation.php`](./validation.php) и настроить схему валидации в соответствии с Вашей реализацией. 

### На проверку
- Файл `validation.php` c Вашими изменениями.
- Файл `hw3.php` c Вашими изменениями.

## :scroll: Конспект. Функции

### Объявление

```PHP
/**
 * Проверяет является ли значение целым числом
 * @param $value значени для проверки
 */
function isIntValue($value) {
  return strval((int)$value) === strval($value);
}

var_dump(isIntValue(4));    // true
var_dump(isIntValue("4"));  // true
var_dump(isIntValue(4.0));  // false
var_dump(isIntValue("4a")); // false 
```

Можно указать значение по умолчанию и тип аргумента.
Тип может быть примитивом, классом, array или callable. Указать несколько типов одновременно нельзя. Подробнее: https://www.php.net/manual/ru/functions.arguments.php#functions.arguments.type-declaration

```PHP
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

var_dump(power(4, 2));  // 16 
var_dump(power(4));     // 16
var_dump(power(4, 0));  // 1 
var_dump(power(4, -1)); // 0.25 
```

Можно объявить функцию принимающую переменное коилчество аргументов и получить их в виде массива

```PHP
/**
 * Склеивает переданные значения вставляя указанную строку между ними
 * @params string $glue строка для склеивания 
 * @params mixed ...$values значения
 */
function glue($glue, ...$values) {
  var_dump($values);
  return implode($glue, $values);
}

var_dump(glue(",", 1, 23, 45, "end")); // 1,23,45,end
var_dump(glue(",", 1));                // 1
```

Функции можно объявлять вне глобального контекста: в `if`, циклах, других функциях.  
Запустите нижеследующий код с `$isFuncNeeded` cо значениями `true` и `false`

```PHP
$isFuncNeeded = true;

if ($isFuncNeeded) {
  
  function func() {
    var_dump("Called!");
  }

  func()
}

func();
```

### Контекст переменных

Ключевое слово `global` указывает, что функция должна использовать переменную из глобального контекста

```PHP
$global = 10;

function half($global) {
  global $global; // Закоментируйте эту строчку и сравните результат
  $global /= 2;
  return $global;
}

var_dump(half(2));
```

Переменную в функции можно объявить с ключевым словом `static`. В этом случае она будет сохранять свое значение между вызовами функции

```PHP
function staticVar() {
  static $static = 2;
  $static *= 2;
  return $static;
}

var_dump(staticVar()); // 2
var_dump(staticVar()); // 4
var_dump(staticVar()); // 8
```

### Анонимные функции и `use`

Функция не имеет названия, но хранится в переменной. Мы можем вызывать ее используя эту переменную.

```PHP
$func = function($a) { 
  return $a * $a; 
};

var_dump(call_user_func($func, 2)); // 4
var_dump($func(2));                 // 4
```

Мы можем создать замыкание с помощью слова `use`, чтобы внутри функции иметь доступ к значениям переменных из внешнего контекста *на момент создания*

```PHP
$outer = 3;

$func1 = function () use ($outer) {
  echo "called with $outer";
};

$outer = 4; // меняем значение переменной

$func2 = function () use ($outer) {
  echo "called with $outer";
};

$func1(); // called with 3
$func2(); // called with 4
```

Мы можем генерировать функции другими функциям и возвращать их для дальнейшего использования

```PHP
function createScaler($factor) {

  return function ($n) use ($factor) {
    return $n * $factor;
  };

}

$scaler = createScaler(10);
var_dump($scaler(2)); //20
var_dump($scaler(4)); //40
```

### Функции как аргументы функции

Если мы можем сохранить функцию в переменную, мы можем передать ее как аргумент в другую функцию

```PHP
function decorateArray($array, $decorator) {
  foreach($array as $v) {
    echo $decorator($v) . "\n"; 
  }
}

decorateArray([1, 2, 3], function($v) {
  return "===$v===";
});
```

Существует множество встроенных функци PHP которые принимают функции в качестве аргументов.

Например код выше, можно заменить на: 

```PHP
$array = [1, 2 ,3];
array_walk($array, function($v) {
  echo "===$v===\n";
});
```

Еще пример с фильтрацией массива. Останутся только четные числа.
```PHP
var_dump(array_filter([1, 2 , 3, 4], function($i) {
  return $i % 2 === 0;
}));
```