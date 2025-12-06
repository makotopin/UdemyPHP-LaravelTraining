<?php
// 可変引数
// 複数の変数をまとめて指定できるようになる。
// つまり「引数がいくつあるのか？」の数をきにしなくてよくなる。
// : string・・・これは返ってくる内容の型を判断している。
function combine(string ...$name): string
{
  $combinedNAME = '';
  for($i = 0; $i < count($name); $i++){
    $combinedNAME .= $name[$i];
    if($i < count($name) - 1){
      $combinedNAME .= ' . ';
    }
  }
  return $combinedNAME;
}

echo combine('山田', '太郎');
echo '<br>';

echo combine('山田', '太郎', '花子');
echo '<br>';
