<?php

namespace pd\controllers;

use pd\core\View;

class IndexController {

  public function index() {
    return new View("Index");
  }
}