<?php

namespace pd\controllers;

use pd\core\Request;

class BooksController {

  public function list() {
    echo "BOOKS";
  }

  public function find(Request $request) {
    echo "BOOK";
    var_dump($request);
  }

  public function create() {
    echo "NEW BOOK";
  }

  public function edit(Request $request) {
    echo "BOOK EDITOR";
    var_dump($request);
  }

  public function save(Request $request) {
    echo "SAVING THE BOOK";
    var_dump($request);
  }

}