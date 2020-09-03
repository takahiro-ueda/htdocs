<?php
$success = file_put_contents('./news_date/news.txt', '2018-06-01 ホームページをリニューアルしました');
if ($success) {
  print('ファイルへの書き込みが完了しました。');
} else {
  print('書き込みに失敗しました。フォルダの権限を確認してください！！');
}