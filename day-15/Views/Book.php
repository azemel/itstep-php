<?php
  $viewData["Title"] = "$model->title";
?>

<div class="block book">

  <div class="book__cover-col">
    <?php if ($model->cover) {?>
      <img class="book__cover" src="/content/<?=$model->cover?>"/>
    <?php } else {?>
      <div class="book__cover book__cover_placeholder">Нет обложки</div>
    <?php }?>
  </div>

  <div class="book__info-col">
    <h3 class="book__title"><?=$model->title?></h3>
    <div class="book__author"><?=$model->author?> • <?=$model->year?></div>
    <div class="book__isbn">ISBN <?=$model->isbn?></div>
  </div>

</div>
