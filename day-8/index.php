<?php

namespace pd\core;

require_once("autoload.php");

$env = new Environment([
  // ! Этот префикс мне пришлось ввести чтобы перенаправление на индекс корректно работало для папок каждого дня
  // Т.е. запрос /day-X/path/to/something должен быть перенаравлен в файл day-X/index.php 
  // и приложение должно "думать" что запрос был к /path/to/something
  // ! ОБЯЗАТЕЛЬНО ЗАКОММЕНТРУЙТЕ эту строку, т.к. предполагается, что вы последовательно работаете над своим кодом в одной папке.
  "uriRoot" => array_pop(preg_split("/[\/\\\\]/", __DIR__)),
  
  
  // Поменяйте значение на Environement::PRODUCTION и посмотриете как изменится отображение ошибок
  "mode" => Environment::DEVELOPMENT,
]);


$app = new App($env);

$app->run();