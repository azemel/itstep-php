<?php
namespace pd\core;

use Exception;

class Router {

  public $routes = [];

  public function map(string $name, string $method, string $uri, $controller, string $action) {

    if (array_key_exists($name, $this->routes)) {
      throw new Exception("Route $name already exists");
    }

    $this->routes[$name] = new Route($name, $method, $uri, $controller, $action);
  }

  public function get(string $name, string $uri, $controller, string $action) {
    $this->map($name, "GET", $uri, $controller, $action);
  }

  public function post(string $name, string $uri, $controller, string $action) {
    $this->map($name, "POST", $uri, $controller, $action);
  }

  public function match(Request $request) {
    
    foreach ($this->routes as $route) {
      if (($params = $route->match($request)) !== false) {
        return [$route, $params];
      }
    }
    
    return [null, null];
  }

  public function urlToRoute($name, $params) {
    
    if (!array_key_exists($name, $this->routes)) {
      throw new Exception("Route $name doesn't exist");
    }

    return $this->routes[$name]->createUri($params);
  }

}