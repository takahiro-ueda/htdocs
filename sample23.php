<table>
<?php
for ($i=1; $i<=10; $i++) {
  if ($i % 2) { //剰余算
    print('<tr style="background-color: #ccc>');
  } else {
    print('<tr>');
  }
  print('<td>' . $i . '行目</td>');
  print('</tr>');
}
?>
</table>