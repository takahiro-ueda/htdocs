<?php
$age = 'あいうえお';

// mb_convert_kanaは全角文字を半角文字に変換
$age = mb_convert_kana($age, 'n', 'UTF-8');
// ある変数が、数字がどうかを判定するには「is_numeric」という便利なファンクション
if (is_numeric($age)) {
  print($age . '歳');
} else {
  print('※　年齢が数字ではありません！');
}
?>