<?php
//月・日・曜日の英語3文字が表示
// $day = date('n/j(D)');
// print($day . "\n");

//タイムスタンプ
$time = time();
print($time . ("\n"));

// $day = date('n/j(D)' . 86400);
// print($day . "\n");

//strtotimeファンクション
// $ieyasu = strtotime('1543/1/31', 86400);
// print($ieyasu);

//明後日の表示
$day_after_tomorrow = strtotime('+2day');
print($day_after_tomorrow);
?>