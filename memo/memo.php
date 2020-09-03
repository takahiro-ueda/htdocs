<main>
<h2>Practice</h2>
<?php
try {
  $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
  echo 'DB接続エラー：　' . $e->getMessage();
}
// より安全にURLパラメーターを受け取るには
$id = $_REQUEST['id'];
if (!is_numeric($id) || $id <= 0) { //「is_numeric」は「数字かどうか」を判定するファンクション[数字が指定有はtrue,無はfalse]
  print('1以上の数字で指定してください');
  exit();
}

//すぐに実行されず次の「execute」メソッドで実行される, IDはURLパラメーターで指定されるため「$_REQUEST」または「$_GET」を使って取得
$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
$memos->execute(array($_REQUEST['id']));
$memo = $memos->fetch();
?>
<article>
  <pre><?php print($memo['memo']); ?></pre>

  <a href="index.php">戻る</a>
</article>
</main>