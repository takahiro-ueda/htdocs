<?php
$doc = file_get_contents('./news_data/news.txt');
$doc .= "<br />2018-06-02 ニュースを追加しました";
file_get_contents('./news_data/news.txt', $doc);

readfile('./news_data/news.txt');
?>