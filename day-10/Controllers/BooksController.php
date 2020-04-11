<?php

namespace pd\controllers;

use pd\core\Request;
use pd\models\Book;

class BooksController {

  public function list() {
    echo "BOOKS";
  }

  public function find(int $book_id) {
    echo "BOOK";
    var_dump($book_id);
  }

  public function create() {
    echo "NEW BOOK";
  }

  public function edit(int $book_id) {
    echo "BOOK EDITOR";
    var_dump($book_id);
  }

  public function save(Book $book, $files) {
    echo "SAVING THE BOOK";
    var_dump($book);
    var_dump($files);

  }

}