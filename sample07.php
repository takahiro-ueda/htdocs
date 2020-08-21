<?php
//月・日・曜日の英語3文字が表示
// $day = date('n/j(D)');
// print($day . "\n");

//タイムスタンプ
$time = time();
print($time . ("\n"));

$day = date('n/j(D)' . 86400);
print($day . "\n");
?>