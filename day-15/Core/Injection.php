<?php

namespace pd\core;

use Exception;
use ReflectionClass;

class Injection {

  public $context;

  public function __construct(Context $context) {
    $this->context = $context;
  }

  public function invokeRouteAction(Route $route) {
    $controller = $this->instantiateController($route->controller);
    return $this->invokeAction($controller, $route->action);
  }

  public function instantiateController(string $name) {
    $controller = "pd\\controllers\\{$name}Controller";
    return new $controller();
  }

  public function invokeAction(object $controller, string $action) {
    $class = new ReflectionClass($controller);

    if (!$class->hasMethod($action)) {
      throw new Exception("Undefined action $action");
    }

    $method = $class->getMethod($action);
    $args = $method->getParameters();

    $values = $this->findArgsValues($args);

    return $method->invokeArgs($controller, $values);
  }

  private function findArgsValues(array $args) {
    $values = [];

    $request = $this->context->request;
    $params = $this->prepareParams();

    foreach($args as $arg) {
      $name = $arg->getName();

      if ($name === "context") {
        $values[$name] = $this->context;
      } else if ($name === "request") {
        $values[$name] = $request;
      } else if ($name === "form") {
        $values[$name] = $request->form;
      } else if ($name === "query") {
        $values[$name] = $request->query;
      } else if ($name === "files") {
        $values[$name] = $request->files;
      } else if ($name === "cookies") {
        $values[$name] = $request->cookies;
      } else if ($name === "session") {
        $values[$name] = $request->session;
      } else if ($arg->getClass() !== null) {
        $className = $arg->getType()->getName();
        $model = new $className();

        if (array_key_exists($name, $params)) {
          foreach($params[$name] as $k => $v) {
            $model->$k = $v;
          }
        }

        $values[$name] = $model;
      } else if (array_key_exists($name, $params)) {
        $values[$name] = $params[$name];
      } else if($arg->isOptional()) {
        $values[$name] = $arg->getDefaultValue();
      } else {
        throw new Exception("Value for parameter $name was not provided");
      }

    }

    return $values;
  }

  private function prepareParams() {
    $params = [];

    $all = $this->context->request->all;
    foreach($all as $k => $v) {
      $k = str_replace(".", "_", $k);   
      $params[$k] = $v;

      $tokens = explode("_", $k);
      if (count($tokens) <= 1) continue;

      if (count($tokens) > 2) {
        throw new Exception("Nesting of more than one layer is unimplemented");
      }

      if (!array_key_exists($tokens[0], $params)) {
        $params[$tokens[0]] = [];
      }
      
      $params[$tokens[0]][$tokens[1]] = $v;
    }

    return $params;
  }

}