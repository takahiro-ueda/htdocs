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
/* ここに、PHPのプログラムを記述します　*/
try {
  $db = new PDO('mysql:dbname=mybd;host=127.0.0.1;charset=ytf8',
  'root',
  'root');
} catch (PDOException $e) {
  echo 'DB接続エラー：　' . $e->getMessage();
}
?>
</pre>
</main>
</body>
</html>