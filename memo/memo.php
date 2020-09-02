<main>
<h2>Practice</h2>
<?php
try {
  $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
  echo 'DB接続エラー：　' . $e->getMessage();
}

$memos = $db->query('SELECT * FROM memos WHERE id=1');
$memo = $memos->fetch();
?>
<article>
  <pre><?php print($memo['memo']); ?></pre>

  <a href="index.php">戻る</a>
</article>
</main>