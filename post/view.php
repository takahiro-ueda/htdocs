<?php
session_start();
require('dbconnect.php');

if (empty($_REQUEST['id'])) { //URLパラメータの「id」が正しく指定されているかを検査、なければトップページへ戻る(不正な呼び出し予防)
  header('Location: index.php'); exit();
}

//投稿を取得する                SQLで指定してデータベースから取り出す
$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');
$posts->execute(array($_REQUEST['id']));
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ひとこと掲示板</tilte>

  <link rel="stylesheet" type="text/css" />
</head>

<body>
  <div id="wrap">
    <div id="head">
      <h1>ひとこと掲示板</h1>
    </div>
    <div id="content">
    <p>&laquo;<a href="index.php">一覧に戻る</a></p>
    <?php
    if ($post = $posts->fetch()):
    ?>
    <div class="msg">
      <img src="member_picture/<?php echo htmlspecialchars($post['picture'], ENT_QUOTES); ?>" width="48" height="48" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>" />
      <p>
        <?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?>
        <span class="name">
          （<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>）
        </span>
      </p>
      <p class="day"><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></p>
    </div>
    <?php
    else: //エラ〜メッセージを出力
    ?>
    <p>その投稿は削除されたか、URLが間違っています</p>
    <?php
    endif;
    ?>
  </div>
</body>
</html>