<?php

namespace pd\core;

class Request {

  public $uri;
  public $method;

  public $query; 
  public $form;
  public $files;

  public $routeData;

  public $all;

  public function __construct(string $uriRoot) {
    
    $this->uri = $_SERVER['REQUEST_URI'];
    $this->uri = explode("?", $this->uri, 2)[0];

    // Удаляем префикс. Cм. комментарий в index.php
    if ($uriRoot !== "") {
      $this->uri = preg_replace("/^\/?$uriRoot/", "", $this->uri);
    }

    $this->method = strtoupper($_SERVER['REQUEST_METHOD']);

    $this->query = $_GET;
    $this->form = $_POST;
    $this->files = $_FILES;

    $this->routeData = [];

    $this->all = [];

  }

  public function mergeParams() {
    $this->all = array_merge($this->query, $this->form, $this->routeData);
  }

}