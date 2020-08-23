<?php
// 10と表示(%d)
$fix = sprintf('%d', 10);
print($fix . "\n");

// 0と表示(%d)
$fix = sprintf('%d', 'abc');
print($fix . "\n");

// string(=文)
$fix = sprintf('%s', 'abc');
print($fix . "\n");
?>