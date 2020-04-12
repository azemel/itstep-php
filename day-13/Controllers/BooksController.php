<?php

namespace pd\controllers;

use pd\core\NotFoundException;
use pd\core\View;
use pd\models\Book;


class BooksController {

  public function list() {
    $list = STORE();

    return new View("Books", $list);
  }

  public function find(int $book_id) {
    $list = STORE();

    if (!array_key_exists($book_id, $list)) {
      throw new NotFoundException();
    }

    $book = $list[$book_id];

    return new View("Book", $book);
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


function STORE() {
  $list = [];

  $book = new Book();
  $book->id = 1;
  $book->title = "In Search og Lost Time";
  $book->author = "Marcel Proust";
  $book->year = 1990;
  $list[$book->id] = $book;


  $book = new Book();
  $book->id = 2;
  $book->title = "The Great Gatsby";
  $book->author = "F. Scott Fitzgerald";
  $book->year = 1994;
  $list[$book->id] = $book;

  return $list;
}
