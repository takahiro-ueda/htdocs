<!-- <?php 
// 連想配列
// $fruits =[
//   'apple' => 'りんご',
//   'grape' => 'ぶどう',
//   'lemon' => 'レモン',
//   'tomato' => 'トマト',
//   'peach' => 'もも'
// ];
// foreach ($fruits as $english => $japanese) {
//   print($english . ' : ' . $japanese . "\n");
// }
// ?> -->

<select>
<?php
//練習問題
$pratforms = [
  'win' => 'Windows',
  'mac' => 'Macintosh',
  'iphone' => 'iPhone',
  'ipad' => 'iPod',
  'android' => 'Android'
];
foreach ($pratforms as $pratformId => $platformValue) :
?>
<option value="<?php echo $platformId; ?>"><?php echo $platformValue; ?></option>
<?php endforeach; ?>
</select>