<?php
  $isNew = !$model->Id;
  $viewData["Title"] = $isNew ? "Новая книга" : "Редактирование: $model->title";
  $viewData["NavigationItem"] = $isNew ? 2 : null;

  function displayField($name, $key, $value, $error, $type = "text") {
    ?>

    <div class="form__field <?=$error ? "form__field_is-invalid" : ""?>">
      
      <label class="form__label" for="<?=$key?>"><?=$name?></label>

      <?php if ($type === "file") { ?>
        <?php if ($value) {?>
          <div>Сейчас: <?=$value?></div>
        <?php }?>
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


<form class="block form" method="post" enctype="multipart/form-data">
  <?php
  displayField("Название книги", "book.title", $model->title, @$errors["title"]);
  displayField("Автор", "book.author", $model->author, @$errors["author"]);
  displayField("Год издания", "book.year", $model->year, @$errors["year"]);
  displayField("ISBN", "book.isbn", $model->isbn, @$errors["isbn"]);
  displayField("Обложка", "book.cover", $model->cover, @$errors["cover"], "file");
  ?>

  <div class="form__field">
    <button  class="button" type="submit">Сохранить</button>
  </div>
</form>