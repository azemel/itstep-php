<?php
namespace pd\core;

class Route {

  public $name;

  public $uri;
  public $method;
  public $controller;
  public $action;

  public $pattern;
  public $params;

  public function __construct(string $name, string $method, string $uri, string $controller, string $action) {
    $this->name = $name;

    $this->method = strtoupper($method);
    $this->uri = $uri;
    $this->controller = $controller;
    $this->action = $action;
  
    [$this->pattern, $this->params] = static::parseTemplate($uri);
  }

  public function match(Request $request) {
    $matches = [];

    if ($request->method !== $this->method) {
      return false;
    }

    if (preg_match($this->pattern, $request->uri, $matches)) {
      $params = [];
      
      for ($i = 0; $i < count($this->params); $i++) {
        $params[$this->params[$i]] = $matches[$i + 1];
      }

      return $params;
    } else {  
      return false;
    }
  }

  public function createUri($params) {
    $uri = $this->uri;

    foreach ($params as $key => $value) {
      $uri = str_replace("{{$key}}", $value, $uri);
    }

    return $uri;
  }

  private static function parseTemplate($uri) {
    $tokens = explode("/", $uri);

    $regex = [];
    $params = [];
    foreach ($tokens as $token) {
      if ($token === "") continue;

      if ($token[0] === "{" && $token[-1] === "}") {
        $regex[] = "([^\/]+)";
        $params[] = substr($token, 1, strlen($token) - 2);
      } else {
        $regex[] = $token;
      }
    }

    $regex = "/^\/" . implode("\/", $regex) . "$/";

    return [$regex, $params];
  }
  
}
