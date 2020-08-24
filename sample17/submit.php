<?php
//  入力されたHTMLタグの効果を打ち消す「htmlspecialchars」ファンクション
print(htmlspecialchars($_REQUEST['my_name'], ENT_QUOTES));
?>