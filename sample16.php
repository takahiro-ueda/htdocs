<?php
$file = file_get_contents('https://h2o-space.com/feed/json');
$json = json_decode($file);　//「デコード(Decode)」というは「コードをほぐす」といった意味

// foreach構文
foreach($json->items as $item) :　//XMLと違って「channel」という親要素はない
?>
・<a href="<?php print($item->url); ?>"><?php print($item->title); ?></a>
<?php
endforeach;
?>