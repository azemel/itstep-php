<?php
namespace pd\core;

use ErrorException;
use Exception;

class NotFoundException extends Exception { }

class App {

  public $env;
  public $router;

  public function __construct(Environment $env) {

    $this->env = $env;

    if ($this->env->mode === Environment::PRODUCTION) {
      set_error_handler([$this, "handleError"]);
      set_exception_handler([$this, "handleException"]);
    }

  }

  public function useRouter(Router $router) {
    $this->router = $router;
  }

  public function run() {
    
    $request = new Request($this->env->uriRoot);
    $context = new Context($request);

    [$route, $params] = $this->router->match($request);

    $request->routeData = $params;

    if (!$route) {
      $this->handleNotFound();
    }
    
    $context->route = $route;
    $request->mergeParams();

    $this->invokeAction($context);
  }

  public function invokeAction(Context $context) {
    $controller = "pd\\controllers\\" . $context->route->controller . "Controller";
    $controller = new $controller();

    $action = $context->route->action;
    $controller->$action($context->request);
  }

  public function handleError(int $errno , string $errst, string $errfile, int $errline, array $errcontext) {

    if (error_reporting() & $errno) {
      $this-> handleException(new ErrorException($errst, $errno, $errno, $errfile, $errline));
    }

    return true;
  }

  public function handleException(Exception $exception) {

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