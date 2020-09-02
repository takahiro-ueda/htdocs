<h2>Practice</h2>
<pre>
<?php
try {
  $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');
  // $db->exec('INSERT INTO memos SET memo="' . $_POST['memo'] . '", created_at=NOW()');
  //INSERT文はすでに「exec」メソッドで実行できるためフォームの値を取得するのは「$_POST['memo']」という記述で取得
} catch (PDOException $e) {
  echo 'DB接続エラー：　' . $e->getMessage();
}

$statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
$statement->execute(array($_POST['memo']));// 「prepare」メソッドでSQLを組み立てたとき「？」を指定した箇所に、挿入したい内容を指定
echo 'メモが登録されました！';
?>
</pre>