<?php
$viewData["Title"] = "Books";
$viewData["NavigationItem"] = 1;
?>

<div class="books block">

<?php foreach($model as $book) { ?>
  <div class="books__book">
    <a href="<?=$this->urlToRoute("book", ["book.id" => $book->id])?>"><?=$book->title?></a> 
    by 
    <?=$book->author?> 
    <a href="<?=$this->urlToRoute("book.editor", ["book.id" => $book->id])?>">Edit</a>
  </div>
<?php } ?>
</div>
