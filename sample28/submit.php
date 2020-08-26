<?php
$file = $_FILES['picture'];
?>
<!-- ファイルアップロードでは必ず決まった連装配列となる -->
ファイル名（name）：　<?php print($file['name']); ?>  
ファイルタイプ（type）：　<?php print($file['type']); ?>
アップロードされたファイル（tmp_name）：　<?php print($file['tmp_name']); //「tmp_name」は「Temporary Nameの略」?>
エラー内容（error）：　<?php print($file['error']); ?>
サイズ（size）：　<?php print($file['size']); ?>

<?php
$ext = substr($file['name'], -4);
if ($ext == '.gif' || $ext == '.jpg' || $ext == '.png') :
  $filePath = './user_img/' . $file['name'];
  $success = move_uploaded_file($file['tmp_name'], $filePath);  //一時的に保存されたファイルを移動するファンクションが「move_uploaded_file」

  if ($success) :
?>
<img src="<?php print($filePath); ?>">
  <?php else: ?>
※　ファイルアップロードに失敗しました
  <?php endif; ?>

<?php else: ?>
※拡張子が.gif, .jpg, .pngのいずれかのファイルをアップロードしてください
<?php endif; ?>
  