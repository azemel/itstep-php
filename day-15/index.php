<?php

namespace pd\core;

use pd\middleware\Validation;

require_once("autoload.php");

$env = new Environment([
  // ! Этот префикс мне пришлось ввести чтобы перенаправление на индекс корректно работало для папок каждого дня
  // Т.е. запрос /day-X/path/to/something должен быть перенаравлен в файл day-X/index.php 
  // и приложение должно "думать" что запрос был к /path/to/something
  // ! ОБЯЗАТЕЛЬНО ЗАКОММЕНТРУЙТЕ эту строку, т.к. предполагается, что вы последовательно работаете над своим кодом в одной папке.
  "uriRoot" => array_pop(preg_split("/[\/\\\\]/", __DIR__)),
  
  "mode" => Environment::DEVELOPMENT,
]);


$app = new App($env);

$router = new Router();

$router->get("index", "/", "Index", "index");
$router->get("books", "/books", "Books", "list");

$router->get("book.new", "/books/new", "Books", "create");
$router->post("book.new.save", "/books/new", "Books", "save");

$router->get("book", "/books/{book.id}", "Books", "find");

$router->get("book.editor", "/books/{book.id}/edit", "Books", "edit");
$router->post("book.editor.save", "/books/{book.id}/edit", "Books", "save");

$app->useRouter($router);

// $app->useMiddleware(new Validation());

$app->run();