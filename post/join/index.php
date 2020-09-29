<?php
require('../dbconnect.php'); //DBへの接続が必要のため記入([require]ファンクションで参照)
session_start();

if (!empty($_POST)) { //今回はプログラムでは入力画面を「表示」と「チェック」で兼用のため切り分けが必要。これを「$_POST」がからでないかを確認
  // エラー項目の確認
  // 「!empty($_POST)」の戻り値がtrueである場合（＝フォームが送信されている場合）は内容をチェック
  if ($_POST['name'] == '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] == '') {
    $error['email'] = 'blank';
  }
  //パスワードの文字数も「strlen」ファンクションで確認。今回は6文字以下
  if (strlen($_POST['password']) < 6) { 
    $error['password'] = 'length';
  }
  //「$_FILES」は連想配列となっており、ファイル名や一時的にアップロードされたファイル名などが代入されています
  if ($_POST['password'] == '') {
    $error['password'] = 'blank';
  }
  $fileName = $_FILES['image']['name'];
  if (!isset($fileName)) {
    $ext = substr($fileName, -3);
    if ($ext != 'jpg' && $ext != 'gif' && $ext !='jpeg' && $ext !='png') {
      $error['image'] = 'type';
    }
  }
  //重複アカウントのチェック　重複を確認するのは「members」テーブルから、入力されたメールアドレスのレコードが保存されているかどうかで確認
  if (!isset($error)) {
    $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
    $member->execute(array($_POST['email']));
    $record = $member->fetch();
    if ($record['cnt'] > 0) {
      $error['email'] = 'duplicate';
    }
  }

  //全ての確認が終了すれば「$error」配列がからであるか判定。/ 「header」ファンクションで次の画面に移動
  if(empty($error)) {  
    // 画像をアップロードする
    // $image = date('YmdHis') . $_FILES['image']['name'];
    // move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
    $_SESSON['join'] = $_POST;
    // $_SESSON['join']['image'] = $image;
    header('Location: check.php');
    exit();
  }
}

//書き直し
if (@$_REQUEST['action'] == 'rewrite') { //URLパラメーターの「action」が「rewrite」という内容だった場合、つまりURLに「index.php?action=rewrite」と指定された場合というif構文
  $_POST = $_SESSION['join'];
  $error['rewrite'] = true;
}

//htmlspecialcharsのショートカット
function h($value) { 
  return htmlspecialchars($value, ENT_QUOTES);
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
<!-- <h2>Practice</h2> -->
<p>次のフォームに必要事項をご記入ください。</p>
<!-- action属性が空。これは自分自身に送信するという意味 / ファイルの送信フォームがある場合は「enctype="multipart/form-data"」属性を必ず指定 -->
<form action="" method="post" enctype="multipart/form-data">
  <dl>
    <dt>ニックネーム<span class="required">必須</span></dt>
    <dd>
    <!-- //「htmlspecialchars」ファンクションにかけてから表示をしないと、入力された文字によっては画面が壊れてしまったりする -->
      <input type="text" name="name" size="35" maxlength="255" value="<?php if (isset($_POST['name'])) {
        echo h($_POST['name'], ENT_QUOTES);
       } ?>" />
      <!-- //「$error」配列のキーが「name」の内容を確認、空の場合はエラーメッセージを表示 -->
      <?php if (isset($error['name']) && $error['name'] == 'blank'): ?> 
        <p class="error">* ニックネームを入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>メールアドレス<span class="required">必須</span></dt>
    <dd>
      <input type="text" name="email" size="35" maxlength="255" value="<?php if (isset($_POST['email'])) {
        echo h($_POST['email'], ENT_QUOTES); 
        } ?>" />
      <?php if (isset($error['email']) && $error['email'] == 'blank'): ?>
        <p class="error">* メールアドレスを入力してください！</p>
      <?php endif; ?>
      <?php if (@$error['email'] == 'duplicate'): ?>
        <p class="error">* 指定されたメールアドレスは既に登録されています！！！</p>
      <?php endif; ?>
    </dd>
    <dt>パスワード<span class="required">必須</span></dt>
    <dd>
      <input type="password" name="password" size="10" maxlength="20" value="<?php if (isset($_POST['password'])) {
        echo h($_POST['password'], ENT_QUOTES);
      } ?>" />
      <?php if (isset($error['password']) && $error['password'] == 'blank'): ?>
        <p class="error">* パスワードを入力してください！</p>
      <?php endif; ?>
      <?php if (isset($error['password']) && $error['password'] == 'length'): ?>
        <p class="error">* パスワードは6文字以上で入力してください</p>
      <?php endif; ?>
    </dd>
    <dt>写真など</dt>
    <dd>
      <input type="file" name="image" size="35" />
      <?php if (isset($error['image']) && $error['image'] == 'type'): //ファイルの形式が正しくない場合に表示されるエラーメッセージ?>
        <p class="error">* 写真などは「.gif」または「.jpg」の画像を指定してください</p>
      <?php endif; ?>
      <?php if (!empty($error)): //?>
        <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
      <?php endif; ?>
    </dd>
  </dl>
  <div><input type="submit" value="入力内容を確認する！" /></div>
</form>
</main>
</body>
</html>
<?php print('なかなか出来ない') ?>