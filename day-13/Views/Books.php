<?php
$viewData["Title"] = "Books";
$viewData["NavigationItem"] = 1;
?>

<div class="books">

<?php foreach($model as $book) { ?>
  <div class="books__book">
    <a href="<?=$this->urlToRoute("book", ["book.id" => $book->id])?>"><?=$book->title?></a> by <?=$book->author?>
  </div>
<?php } ?>
</div>
