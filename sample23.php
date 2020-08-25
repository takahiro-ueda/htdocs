<table>
<?php
// for ($i=1; $i<=10; $i++) {
//   if ($i % 2) { //剰余算
//     print('<tr style="background-color: #ccc>');
//   } else {
//     print('<tr>');
//   }
//   print('<td>' . $i . '行目</td>');
//   print('</tr>');
// }

// 曜日を繰り返し出力
$week = ['金', '土', '日', '月', '火', '水', '木'];
for ($i=1; $i<=30; $i++) {
  print($i . '日(' . $week[$i%7] . ')<br />');
}
?>
</table>