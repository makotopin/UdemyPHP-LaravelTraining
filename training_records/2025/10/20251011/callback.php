<?php
//PHPの関数は、引数に関数を入れることができる
$paramaters = ['  空白あり ', '  配列  ', ' 空白あり  '];

// 配列の中身を確認→空白はそのまま残って表示される
echo '<pre>';
var_dump($paramaters);
echo '</pre>';

// array_map （引数に関数） 配列の値それぞれに関数を適用する
$trimedParameters = array_map('trim', $paramaters);
// trimは、文字列の前後の空白を削除する関数↑

// 配列の中身を確認→空白が削除されて表示される
echo '<pre>';
var_dump($trimedParameters);
echo '</pre>';

// array_map()はcallable対応の関数なので、関数を呼べる。
// 呼べる関数は今回のtrimnoのように組み込まれている関数でも良いし、自作の関数でもよい