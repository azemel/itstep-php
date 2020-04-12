<?php

namespace pd\controllers;

use pd\core\NotFoundException;
use pd\core\View;
use pd\models\Book;


class BooksController {

  private $db = null;

  private function connectDb() {
    // ! Используйте данные актуальные для вашей базы: пользователь, пароль, имя базы данных
    $this->db = mysqli_connect("localhost", "root", "", "itstep");
  }

  private function disconnectDb() {
    $this->db->close();
  }

  private function escape($string) {
    return $this->db->real_escape_string($string);
  }

  private function queryDb($query) {
    
    $result = $this->db->query($query);

    $list = [];
    while(null !== ($data = $result->fetch_assoc())) { 
      $list[] = $data;
    }

    
    $result->close();

    return $list;
  }

  private function bookFromRow($row) {
    $book = new Book();
    $book->id = $row["Book_Id"];
    $book->title = $row["Book_Title"];
    $book->author = $row["Book_Author"];
    $book->isbn = $row["Book_ISBN"];
    $book->year = $row["Book_Year"];
  
    return $book;
  }

  public function list() {
    $this->connectDb();
    
    $rows = $this->queryDb("SELECT * FROM Books");
    
    $this->disconnectDb();

    $list = [];
    foreach($rows as $row) {
      $list[] = $this->bookFromRow($row);
    }

    return new View("Books", $list);
  }

  public function find(int $book_id) {
    
    $this->connectDb();
    $book_id = $this->escape($book_id);
    $rows = $this->queryDb("SELECT * FROM Books WHERE Book_Id='$book_id'");
    $this->disconnectDb();
    

    if (count($rows) == 0) {
      throw new NotFoundException();
    }

    $book = $this->bookFromRow($rows[0]);

    return new View("Book", $book);
  }

  public function create() {
    $book = new Book();

    return new View("BookEditor", $book, ["errors" => ""]);
  }

  public function edit(int $book_id) {
    $this->connectDb();
    $book_id = $this->escape($book_id);
    $rows = $this->queryDb("SELECT * FROM Books WHERE Book_Id='$book_id'");
    $this->disconnectDb();
    

    if (count($rows) == 0) {
      throw new NotFoundException();
    }

    $book = $this->bookFromRow($rows[0]);

    return new View("BookEditor", $book, ["errors" => ""]);
  }

  public function save(Book $book, $files, $context) {

    // Валидация
    // Подключите свою реализацию из HW5 или добавьте пару ошибок вручную, 
    // чтобы посмотреть как они повлияют на поток
    $errors = []; //["title" => "Обязательно"];

    if ($errors) {
      return new View("BookEditor", $book, ["errors" => $errors]);
    }
    
    $this->connectDb();
    
    $book_id = $this->escape($book->id);
    $book_year = intval($book->year);
    // И остальные поля тоже
    
    if ($book->id) {
      $this->db->query(
        "UPDATE 
          Books 
        SET 
          Book_Title='{$book->title}',
          Book_Author='{$book->author}',
          Book_ISBN='{$book->isbn}',
          Book_Year='{$book_year}'
        WHERE Book_Id='{$book_id}'");

    } else {

      $this->db->query(
        "INSERT INTO Books 
          (Book_Title, Book_Author, Book_ISBN, Book_Year)
        VALUES 
          ('{$book->title}','{$book->author}','{$book->isbn}','{$book_year}')");
      
      $book->id = $this->db->insert_id;
    }

    // var_dump($this->db->error);
    $this->disconnectDb();

    header("302 Redirect");
    header("Location: " . $context->urlToRoute("books"));
    die();
  }

}

