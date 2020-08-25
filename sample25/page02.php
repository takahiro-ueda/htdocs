<?php session_start(); //初期化処理を行う必要あり?>
<!DOCTYPE html>
<html>
<head>
 <title>sample</title>
 <meta http-equiv="content-type" charset="utf-8">
</head>
<pre>
  セッションの値：　<?php print($_SESSION['session_message']); //セッション変数を画面に表示させています?>
  <?php session_unset(); //セッションの内容を全て削除します?>
</pre>
</html>