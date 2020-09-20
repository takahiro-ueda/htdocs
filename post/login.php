<?php
require('dbconnect.php');

session_start();

if ($_COOKIE['email'] != '') { //
  $_POST['email'] = $_COOKIE['email'];
  $_POST['password'] = $_COOKIE['password'];
  $_POST['save'] = 'on';
}

if (!empty($_POST)) { //ログインボタンがクリックされているか確認
  //ログインの処理
  if ($_POST['email'] != '' && $_POST['password'] != '') { //「email」「password」の両方のフィールドが記入されているか確認
    $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?'); //DBから記入されたメールアドレス及びパスワードのデータを検索
    $login->execute(array(
      $_POST['email'],
      shal($_POST['password'])
    ));
  $member = $login->fetch();

    if ($member) { //トップページへ移動
      //ログイン成功
      $_SESSION['id'] = $member['id'];
      $_SESSION['time'] = time();

      //ログイン情報を記録する
      if ($_POST['save'] == 'on') { //ログイン成功で情報をcookieに保存
        setcookie('email', $_POST['email'], time()+60*60*24*14);  //最後の数式は秒・時間を表し、14日間の保存期間を設定
        setcookie('password', $_POST['password'], time()+60*60*24*14);
      }

      header('Location: index.php'); exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank'; //「email」「password」のどちらかが記入されていない場合のエラー
  }
}
?>
<div id="lead">
  <p>メールアドレスとパスワードを記入してログインしてください。</p>
  <p>入会手続きがまだの方はこちらからどうぞ。</p>
  <p>&raquo;<a href="join/">入会手続きをする</a></p>
</div>
<form action="" method="post">
  <dl>
    <dt>メールアドレス</dt>
    <dd>
      <input type="text" name="email" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>" />
      <?php if ($error['login'] == 'blank'): ?>
      <p class="error">* メールアドレスとパスワードをご記入してください。</p>
      <?php endif; ?>
      <?php if ($error['login'] == 'failed'): ?>
      <p class="error">* ログインに失敗しました。正しくご記入してください。</p>
      <?php endif; ?>
    </dd>
    <dt>パスワード</dt>
    <dd>
      <input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" />
    </dd>
    <dt>ログイン情報の記録</dt>
    <dd>
      <input id="save" type="checkbox" name="save" value="on"><label for="save">次回からは自動的にログインする</label>
    </dd>
  </dl>
  <div><input type="submit" value="ログインする" /></div>
</form>