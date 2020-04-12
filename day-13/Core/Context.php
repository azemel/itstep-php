<?php
namespace pd\core;

class Context  {

  public $request;

  private $data = [];

  public function __construct(Request $request) {
    $this->request = $request;
  }

  public function __set($name, $value) {
    $this->data[$name] = $value;
  }

  public function __get($name) {
    return array_key_exists($name, $this->data) ? $this->data[$name] : null;
  }
  
  public function __isset($name) {
    return array_key_exists($name, $this->data);
  }

  public function __call($name, $args) {
    return array_key_exists($name, $this->data) ? $this->data[$name](...$args) : null;
  }
}

