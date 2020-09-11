<?php
session_start();
require('../dbconnect.php'); //dbconnect.phpを呼び出している

if (!isset($_SESSION['join'])) { //入力したセッションに記録しておき、「$_SESSION['join']」に何も含まれていない場合はcheck.php。
  header('Location: index.php');
  exit();
}

if (!empty($_POST)) { //prepareメソッドでSQLを組み立て、セッションに保存した値をそれぞれセット。この時、パスワードのみ「shal」ファンクションを使って暗号化
  //登録処理をする
  $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, created=NOW()');
  echo $ret = $statement->execute(array(
    $_SESSION['join']['name'],
    $_SESSION['join']['email'],
    shal($SESSION['join']['password']),
    $_SESSION['join']['image']
  ));
  unset($_SESSION['join']); //「unset」ファンクションを使って、「$_SESSION['join']」変数、つまり入力情報を削除。DBには既に登録したので重複登録などを防ぐために、セッションから消す

  header('Location: thanks.php');
  exit();
}
?>
・・・
<form action="" method="post">
  <input type="hidden" name="action" value="submit" />
  <dl>
    <dt>ニックネーム</dt>
    <dd>
      <?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>
    </dd>
    <dt>メールアドレス</dt>
    <dd>
      <?php echo htmlspacialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
    </dd>
    <dt>パスワード</dt>
    <dd>
      【表示されません】
    </dd>
    <dt>写真など</dt>
    <dd>
      <img src="../member_picture/<?php echo htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES); ?>" width="100" height="100" alt="" />
    </dd>
  </dl>
  <div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
</form>