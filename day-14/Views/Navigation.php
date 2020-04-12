<?php

$items  = [
  ["Main", $this->urlToRoute("index")],
  ["Books", $this->urlToRoute("books")],
  ["Add Book", $this->urlToRoute("book.new")],
];

?>

<div class="navigation">
<?php foreach($items as $i => [$display, $uri]) { ?>
  <?php $activeClass = $active === $i ? " navigation__item_active" : ""; ?>
  
  <a href="<?=$uri?>" class="navigation__item<?=$activeClass?>"><?=$display?></a>

<?php } ?>
</div>