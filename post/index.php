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
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message']
    ));
  }
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
<div class="msg">
  <img src="member_picture/me.jpg" width="48" height="48" alt="makoto" />
  <p>こんにちは<span class="name">（makoto）</span></p>
  <p class="day">2020/09/18 13:00</p>
</div>
</main>
</body>
</html>