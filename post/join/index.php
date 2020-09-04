<p>次のフォームに必要事項をご記入ください。</p>
<!-- action属性が空。これは自分自身に送信するという意味 / ファイルの送信フォームがある場合は「enctype="multipart/form-data"」属性を必ず指定 -->
<form action="" method="post" enctype="multipart/form-data">
  <dl>
    <dt>ニックネーム<span class="required">必須</span></dt>
    <dd><input type="text" name="name" size="35" maxlength="255" /></dd>
    <dt>パスワード<span class="required">必須</span></dt>
    <dd><input type="password" name="password" size="10" maxlength="20" /></dd>
    <dt>写真など</dt>
    <dd><input type="file" name="image" size="35" /></dd>
  </dl>
  <div><input type="submit" value="入力内容を確認する！" /></div>
</form>