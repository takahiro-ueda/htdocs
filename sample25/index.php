<?php
session_start();
$_SESSION['session_message'] = '値をセッションに保存しました！';  //PHPでセッションを使う場合は「$_SESSION」という特殊な変数に値を代入
?>
<!DOCTYPE html>
<html>
<head>
 <title>sample</title>
 <meta http-equiv="content-type" charset="utf-8">
</head>
<pre>
  セッションに値を保存しました。次のページに移動してみましょう！
  &raquo; <a href="page02.php">Page02へ</a>
</pre>
</html>