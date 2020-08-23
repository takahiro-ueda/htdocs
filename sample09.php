<?php
// 連想配列
$fruits =[
  'apple' => 'りんご',
  'grape' => 'ぶどう',
  'lemon' => 'レモン',
  'tomato' => 'トマト',
  'peach' => 'もも'
];
foreach ($fruits as $english => $japanese) {
  print($english . ' : ' . $japanese . "\n");
}
?>