<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) { //ログインしている状態であるかを検査（idがセッションに記録されている、最後の行動から1時間以内）
  //ログインしている
  $_SESSION['time'] = time();

  $members = $db->prerare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  //ログインしていない
  header('Location: login.php'); exit();
}
//投稿を記録する
if (!empty($_POST)) {
  if ($_POST['message'] != '') {
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_post_id=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message'],
      $_POST['reply_post_id']
    ));

    header('Location: index.php'); exit();
  }
}

//投稿を取得
$page = $_REQUEST['page']; //URLパラメータで指定された値をページ数
if ($page == '') { //空の場合は「1」と表示
  $page = 1;
}
$page = max($page, 1); //指定されたパラメータのうち大きい方を返す「max」ファンクションを使って、もしもURLパラメータにマイナス値が指定された場合には＄pageに「１」が代入

//最終ページを取得 //件数を取得して最大ページ数を計算
$counts = $db->query('SELECT COUNT(*) AS cnt FROM posts');
$cnt = $counts->fetch();
$maxPage = ceil($cnt['cnt'] / 5);
$page = min($page, $maxPage); //minファンクションを使って、最大ページ数と、URLパラメータに指定されたページ数のうち、小さい方を＄pageに代入

$page = ($page - 1) * 5; //1ページ目では「0」件目から、2ページ目では「5」件目から表示させるようにスタート位置を計算

$posts = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT ?, 5'); //
$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();
//メッセージの情報を取り出す

//返信の場合 [@]というのは、誰かのメッセージに対しての返事を意味する記号で、この記号の前に返信メッセージを入力してもらう
if (isset($_REQUEST['res'])) {
  $response = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');

  $table = $response->fetch();
  $message = '@' . $table['name'] . ' ' . $table['message'];
}

//htmlspecialcharsのショートカット
function h($value) { //
  return htmlspecialchars($value, ENT_QUOTES);
}

//本文内のURLにリンクを設置
function makeLink($value) {
  return mb_ereg_replace("(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)", '<a href="\1\2">\1\2</a>' , $value);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" />

<title>会員登録</title>
</head>
<body>
<header>
<h1>会員登録</h1>
</header>

<main>
<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
<form action="" method="post">
  <dl>
    <dt><?php echo h($member['name'], ENT_QUOTES); ?>さん、メッセージをどうぞ</dt>
    <dd>
      <textarea name="message" cols="50" rows="5"><?php echo h ($message, ENT_QUOTES); ?></textarea>
      <input type="hidden" name="reply_post_id" value="<?php echo h ($_REQUEST['res'], ENT_QUOTES); ?>" />
    </dd>
  </dl>
  <div>
    <p>
      <input type="submit" value="投稿する" />
    </p>
  </div>
</form>
<?php
foreach ($posts as $post):
?>
  <div class="msg">
    <img src="member_picture/<?php echo h($post['picture'], ENT_QUOTES); ?>" width="48" height="48" alt="<?php echo h($post['name'], ENT_QUOTES); ?>" />
    <p>
      <?php echo makeLink(h($post['message'])); ?><span class="name">（<?php echo h($post['name'], ENT_QUOTES); ?>）</span>
      [<a href="index.php?res=<?php echo h($post['id'], ENT_QUOTES); ?>">Re</a>]
      <!-- Reと書いた文字にリンクを張る。 -->
    </p>
    <p class="day">
      <a href="view.php?id=<?php echo h($post['id'], ENT_QUOTES); ?>">
        <?php echo h($post['created'], ENT_QUOTES); ?>
      </a>
      <?php
      if ($post['reply_post_id'] > 0):
      ?>
      <a href="view.php?id=<?php echo h($post['reply_post_id'], ENT_QUOTES); ?>">返信元のメッセージ</a>
      <?php endif; ?>
      <?php
      if ($_SESSION['id']  == $post['member_id']):
      ?>
      [<a href="delete.php?id=<?php echo h($post['id']); ?>" style="color: #F33;">削除</a>]
      <?php endif; ?>
    </p>
  </div>
<?php
endforeach;
?>
<ul class="paging">
  <?php if ($page > 1) {
  ?>
  <li><a href="index.php?page=<?php print($page - 1); ?>">前のページへ</a></li>
  <?php
  } else {
  ?>
  <li>前のページへ</li>
  <?php
  }
  ?>
  <?php if ($page < $maxPage) {
  ?>
  <li><a href="index.php?page=<?php print($page + 1); ?>">次のページへ</a></li>
  <?php
  } else {
  ?>
  <li>次のページへ</li>
  <?php
  }
  ?>
</ul>
</main>
</body>
</html>