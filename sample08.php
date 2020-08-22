<?php
//  曜日
// print(date('w'));

//  複数の値
// $week_name = ['日', '月', '火', '水', '木', '金', '土'];
// print($week_name);

//インデックス(添え字)
$week_name = ['日', '月', '火', '水', '木', '金', '土'];
print($week_name[0]);
print($week_name[1]);
print($week_name[2]);
print($week_name[3]);
print($week_name[4]);
print($week_name[5]);
print($week_name[6]);

$week = 1 + 3;
print($week_name[$week] . "\n");

print('今日は' . $week_name[date('w')] . '曜日です！！！！');
?>