<?php
$file = $_FILES['picture'];
?>
ファイル名（name）：　<?php print($file['name']); ?>
ファイルタイプ（type）：　<?php print($file['type']); ?>
アップロードされたファイル（tmp_name）：　<?php print($file['tmp_name']); ?>
エラー内容（error）：　<?php print($file['error']); ?>
サイズ（size）：　<?php print($file['size']); ?>

<?php
$ext = substr($file['name'], -4);
if ($ext == '.gif' || $ext == '.jpg' || $ext == '.png') :
  $filePath = './user_img/' . $file['name'];
  $success = move_uploaded_file($file['tmp_name'], $filePath);

  if ($success) :
?>
<img src="<?php print($filePath); ?>">
  <?php else: ?>
※　ファイルアップロードに失敗しました
  <?php endif; ?>

<?php else: ?>
※拡張子が.gif, .jpg, .pngのいずれかのファイルをアップロードしてください
<?php endif; ?>
  