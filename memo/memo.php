<?php require('dbconnect.php'); ?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<link rel="stylesheet" href="css/style.css">

<title>よくわかるPHPの教科書</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">よくわかるPHPの教科書</h1>
</header>

<main>
<h2>Practice</h2>
<pre>
<main>
<h2>Practice</h2>
<?php
// // より安全にURLパラメーターを受け取るには
// $id = $_REQUEST['id'];
// if (!is_numeric($id) || $id <= 0) { //「is_numeric」は「数字かどうか」を判定するファンクション[数字が指定有はtrue,無はfalse]
//   print('1以上の数字で指定してください');
//   exit();
// }

//すぐに実行されず次の「execute」メソッドで実行される, IDはURLパラメーターで指定されるため「$_REQUEST」または「$_GET」を使って取得
$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
$memos->execute(array($_REQUEST['id']));
$memo = $memos->fetch();
?>
<article>
  <pre><?php print($memo['memo']); ?></pre>
  <a href="update.php?id=<?php print($memo['id']); ?>">編集する</a>
   |
  <a href="delete.php?id=<?php print($memo['id']); ?>">削除する</a>
   |
  <a href="index.php">戻る</a>
</article>
</main>
</pre>
</main>
</body>
</html>