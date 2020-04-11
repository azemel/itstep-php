<?php
namespace pd\core;

use ErrorException;
use Exception;

class NotFoundException extends Exception { }

class App {

  public $env;
  
  public function __construct(Environment $env) {

    $this->env = $env;

    if ($this->env->mode === Environment::PRODUCTION) {
      set_error_handler([$this, "handleError"]);
      set_exception_handler([$this, "handleException"]);
    }

  }

  public function run() {
    
    $request = new Request($this->env->uriRoot);

    $request->mergeParams();

    if ($request->uri === "/") {
      echo "INDEX";
    } else if ($request->uri === "/books") {
      throw new Exception("Исключения для тестирования перехвата ошибок");
      echo "BOOKS LIST";
    } else if ($request->uri === "/book") {
      echo "BOOK";
      var_dump($request);
    } else {
      $this->handleNotFound();
    }

  }

  public function handleError(int $errno , string $errst, string $errfile, int $errline, array $errcontext) {

    if (error_reporting() & $errno) {
      $this-> handleException(new ErrorException($errst, $errno, $errno, $errfile, $errline));
    }

    return true;
  }

  public function handleException($exception) {

    if ($exception instanceof NotFoundException) {
      $this->handleNotFound();
      return;
    }

    header("HTTP/1.1 500 Internal Server Error");
    include("500.php");
    die();
  }

  public function handleNotFound() {
    header("HTTP/1.1 404 Not Found");
    include("404.php");
    die();
  }
}