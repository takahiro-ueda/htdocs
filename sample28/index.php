<!-- 「enctype」＝「encode type」の略でコード化（エンコード）と呼ばれる作業をします
「multipart/form-data」はこれまでの文字情報のみのフォームに加えて、ファイルをそのまま送信することができる方式
※ファイル送信はgetではなく必ずpost -->
<form action="submit.php" method="post" enctype="multipart/form-data">

<input type="text" name="ok">
写真：　<input type="file" name="picture">
<input type="submit" value="送信する！">
</form>