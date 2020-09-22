<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id'])) { //ここでログインをしているかを検査
  $id = $_REQUEST['id'];

  //投稿を検査する
  $messages = $db->prepare('SELECT * FROM posts WHERE id=?'); //削除する投稿の情報を一度検索し、その内容の投稿者IDとログインしているユーザーログインしているユーザーのIDを比べる
  $messages->execute(array($id));
  $message = $messages->fetch();

  if ($message['member_id'] == $_SESSION['id']) {
    //削除する
    $del = $db->prepare('DELETE FROM posts WHERE id=?');  //検査にパスした場合だけ、実際の削除が行われます。
    $del->execute(array($id));
  }
}

header('Location: index.php'); exit();