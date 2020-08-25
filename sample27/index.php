<?php
if (rand(0, 1) == 0) {  //PHPで、無作為な数字を取り出すには「rand」というファンクション
  header('Location: a.html');
} else {
  header('Location: b.html');
}
?>