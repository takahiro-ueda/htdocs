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
<?php
$statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
$statement->execute(array($_POST['memo']));// 「prepare」メソッドでSQLを組み立てたとき「？」を指定した箇所に、挿入したい内容を指定
echo 'メモが登録されました！';
?>
</pre>
</main>
</body>
</html>