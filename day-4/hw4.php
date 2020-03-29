<?php

/**
 * Структура книги. Здесь будут хранится чистые данные после валидации
 */
$book = []; 
$errors = [];

/**
 * 1. Проверяем отправлена ли форма (или это переход по ссылке)
*/
$isFormPosted = false; // > Заменяем на проверку метода

if ($isFormPosted) {

  /**
   * 2. Подключаем Вашу реализацию валидации из hw3 
   *  ! но дополнительно добавляем профилактику XSS атак: очищаем все строки от html тегов 
   */
  // > Какой из вариантов следует выбрать в этом случае require, require_once, include или incldue_once

  $validationScheme = [
    // > Ваша схема валидации из hw3 с учетом новых проверок
  ];
  

  /**
   * 3. Сохраняем данные формы из запроса в переменную $form 
   */
  $form = null; // > Данные формы из запроса

  [ $book, $errors ] = validateForm($validationScheme, $form);


  $maxHeight = 297;
  $maxWidth = 210;
  
  /**
   * 4. Обрабатываем загруженное изображение
   *    а. если файл не был загружен - ничего не делаем
   *    б. проверяем, что файл - изображение, если нет, добавляем ошибку $errors["cover"] => "Файл обложки должен быть изображением"
   *    в. проверяем, что изображение в формате JPEG или PNG, если нет, добавляем ошибку $errors["cover"] => "Неподдерживаемый формат изображениея"
   *    в. изменяем размер изображения, чтобы он не превышал $maxWidth по ширине и $maxHeight по высоте. 
   *    г. генерируем имя файла: "Автор - Название (Год).расширение",   
   *       где расширение .jpg или .png определяем по типу файла   
   *    д. сохраняем файл в папку /covers 
   *       ! папку нужно создать в корне сайта 
   *    е*. создавать папку covers динамически, если она еще не существует.
   */
  $cover = null; 
  $coverFilename = "";
  
  // > Ваш код обрабатывающий загрузку обложки

  // Добавляем имя файла в структуру книги
  $book["cover"] = $coverFilename; 

}


// Можно написать вывод формы, валидации и "сохраненной" книги самостоятельно,
// а можно использвоат мою заготовку:

function displayField($name, $key, $value, $error, $type = "text") {
  ?>

  <div class="form__field <?=$error ? "form__field_is-invalid" : ""?>">
    
    <label class="form__label" for="<?=$key?>"><?=$name?></label>

    <?php if ($type === "file") { ?>
      <input class="filepicker" type="file" name="<?=$key?>" id="<?=$key?>"/>
    <?php } else {?>
      <input class="textbox" type="text" name="<?=$key?>" value="<?=$value ?? ""?>" id="<?=$key?>"/>
    <?php } ?>
    
    <?php if ($error) { ?> 
      <div class="form__error"><?=$error?></div>
    <?php }?>

  </div>
  
  <?php
}

?>

<html>
<head>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, input, button {
      font: 16px sans-serif;
    }

    body {
      background-color: hsl(0, 0%, 96%);  
    }

    .block {
      background-color: white;
      margin: 20px auto;
    }

    .block__header {
      padding: 20px;
    }

    .form {
      width: 600px;
      /* padding: 10px 0; */
    }

    .form__field {
      padding: 10px 20px;
    }

    .form__field_is-invalid {
      background-color: hsl(0, 75%, 96%);
      padding: 20px;
      margin: 10px 0;
    }

    .form__label {
      display: block;
      padding-bottom: 4px;
    }

    .form__error {
      color: hsl(0, 80%, 50%);
      padding-top: 4px;
    }

    .textbox {
      display: block;
      width: 100%;
      padding: 4px;
    }

    .button {
      display: block;
      margin: 0 auto;
      padding: 8px 16px;
    }

    .book {
      width: 600px;
      display: flex;
    }

    .book__cover {
      min-width: 210px;
      min-height: 297px;
    }

    .book__cover_placeholder {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      background-color: hsl(50, 100%, 96%);
    }

    .book__title {
      padding: 20px;
    }

    .book__author {
      padding: 10px 20px;
    }

    .book__isbn {
      padding: 10px 20px;
    }

    .add-book-link {
      display: table;
      margin: 0 auto;
    }

  </style>
</head>
<body>

  <?php /* Если форма не отправлена или содержит ошибки - выводим форму */ ?>
  <?php if (!$isFormPosted || $errors) { ?>
  
  <form class="block form" method="post" enctype="multipart/form-data">
    <h3 class="block__header">Добавление книги</h3>
    <?php
    displayField("Название книги", "title", @$book["title"], @$errors["title"]);
    displayField("Автор", "author", @$book["author"], @$errors["author"]);
    displayField("Год издания", "year", @$book["year"], @$errors["year"]);
    displayField("ISBN", "isbn", @$book["isbn"], @$errors["isbn"]);
    displayField("Обложка", "cover", null, @$errors["cover"], "file");

    ?>
    <div class="form__field">
      <button  class="button" type="submit">Сохранить</button>
    </div>
  </form>

  <?php /* Иначе выводим "сохраненную" книгу */ ?>
  <?php } else { ?>

  <div class="block book">

    <div class="book__cover-col">
      <?php if (array_key_exists("cover", $book)) {?>
        <img class="book__cover" src="<?=$book["cover"]?>"/>
      <?php } else {?>
        <div class="book__cover book__cover_placeholder">Нет обложки</div>
      <?php }?>
    </div>

    <div class="book__info-col">
      <h3 class="book__title"><?=@$book["title"]?></h3>
      <div class="book__author"><?=@$book["author"]?> • <?=@$book["year"]?></div>
      <div class="book__isbn">ISBN <?=@$book["isbn"]?></div>
    </div>

  </div>

  <a class="add-book-link" href="">Добавить еще книгу</a>

  <?php } ?>

</body>
</html>


