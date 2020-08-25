ご予約日：
<?php
foreach ($_POST['reserve'] as $reserve) {
  print(htmlspecialchars($reserve, ENT_QUOTES) . ' ');
}
// 繰り返し構文
// for ($i=0; $i<count($_REQUEST['reserve']); $i++) {
//   print(htmlspecialchars($_REQUEST['reserve'] [$i], ENT_QUOTES) . '<br />');
// }
?>