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
// mysqlにデータ挿入
// $count = $db->exec('INSERT INTO my_items SET maker_id=1, item_name="もも", price=210, keyword="缶詰,ピンク,甘い", sales=0, created="2020-09-02", modified="2020-09-02"');
// echo $count . '件のデータを挿入しました';

//「SELECT」文を用いて取得
// $records = $db->query('SELECT * FROM my_items');
// while ($record = $records->fetch()) { //[fetch]メソッドを用いることで$recordsという変数から1行のレコードを取得して[$record]変数に代入
//   print($record['item_name'] . "\n"); //[$record]変数はさらに連装配列として各カラムの内容を取り出すことが可能！
// }

//countなどで計算
// $records = $db->query('SELECT COUNT(*) AS record_count FROM my_items'); //コードを正規表記でASを活用（別名を付ける）
// $record = $records->fetch();
// print('件数は、' . $record['record_count'] . '件数です！');

//「SELECT」構文を利用してDBからメモのデータを取得
$memos = $db->prepare('SELECT * FROM memos ORDER BY id LIMIT 0,5'); //スタート位置と件数をカンマで区切って指定。
//bindParamメソッドでパラメーターを割当
//３つのパラメーターを指定しないとLIMIT句は文字列として渡されてしまい、正しく動作しないので注意
$memos->bindParam(1, $_REQUEST['page'], PDO::PARAM_INT); 
$memos->execute();
?>
<article>
<?php while ( $memo = $memos->fetch()): ?>
  <p>
    <a href="memo.php?id=<?php print($memo['id']); ?>">
      <?php print(mb_substr($memo['memo'], 0, 50));//「mb_substr」で文字列を切り取る一覧に表示される文字数は制限　0は先頭を意味、50は先頭から数えての文字数?>
      <?php print((mb_strlen($memo['memo']) > 50 ? '...' : '')); ?>
    </a>
  </p>
  <time><?php print($memo['created_at']); ?></time>
  <hr>
<?php endwhile; ?>
</article>
</pre>
</main>
</body>
</html>