<?php

namespace pd\core;

class View {

  public $template;
  public $model;
  public $viewData;
  public $params;
  public $context;

  private $body;

  public function __construct(string $template, $model = null, array $params = []) {
    $this->template = $template;
    
    $this->model = $model;
    
    $this->viewBag = $params;
    $this->params = $params;
    
    $this->layout = "Views/Layout.php";
  }

  public function send($context) {

    $this->context = $context;
    $this->body = $this->prerenderBody();

    $model = $this->model;
    $viewData = $this->viewData; 

    include("Views/Layout.php");
  }

  public function renderBody() {
    return $this->body;
  }

  public function renderPartial(string $template, array $params) {

    foreach ($params as $key => $value) {
      $$key = $value;
    }

    include("Views/$template.php");
  }

  public function urlToRoute($name, $params = []) {
    return $this->context->urlToRoute($name, $params);
  }
  
  public function urlToAsset($name) {
    return $this->context->urlToAsset($name);
  }

  private function prerenderBody() {

    $model = $this->model;
    $viewData = &$this->viewData;

    foreach ($this->params as $key => $value) {
      $$key = $value;
    }

    ob_start();

    include("Views/$this->template.php");

    return ob_get_clean();
  }

}
