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
// $day_after_tomorrow = strtotime('+2day');
// $day = date('n/j(D)', $day_after_tomorrow);
// print($day . "\n");

//繰り返し構文でstrtotimeファンクションを利用
// for ($i=1; $i<=365; $i++) {
//   $timestamp = strtotime('+' . $i . 'day');
//   $day = date('n/j(D)' , $timestamp);
//   print($day ."\n");
// }

//パラメーターにファンクションを指定
$timestamp = strtotime('+' . $i . 'day');
$day = date('n/j(D)' , $timestamp);

//練習問題
$i =1;
while ($i<=365) {
  $timestamp = strtotime('+' . $i . 'day');
  $day = date('n/j(D)' , $timestamp);
  print($day . "\n");
  $i++;
}
?>