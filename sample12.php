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

// 00010と表示　＝　%05dは5桁になるまで0を補って数字として整える
$fix = sprintf('%05d', 10);
print($fix);
?>