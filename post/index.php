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
// if (!empty($_POST)) {
//   if ($_POST['message'] != '') {
//     $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, created=NOW()');
//     $message->execute(array(
//       $member['id'],
//       $_POST['message']
//     ));
//   }
// }

//投稿を取得
$posts = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
//メッセージの情報を取り出す

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
<form action="" method="post">
  <dl>
    <dt><?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、メッセージをどうぞ</dt>
    <dd>
      <textarea name="message" cols="50" rows="5"></textarea>
    </dd>
  </dl>
  <div>
    <p>
      <input type="submit" value="投稿する" />
    </p>
  </div>
</form>
<?php
foreach ($posts as $post);
?>
<div class="msg">
  <img src="member_picture/<?php echo htmlspecialchars($post['picture'],ENT_QUOTES); ?>" width="48" height="48" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES; ?>" />
  <p><?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?><span class="name">（<?php echo htmlspecialchars($post['name'], ENT_QUOTES）; ?></span></p>
  <p class="day"><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></p>
</div>
<?php
endforeach;
?>
</main>
</body>
</html>