<?php
function combineSpace(string $firstName, string $lastName): string
{
  return $firstName . ' ' . $lastName;
}

$nameParam = ['名前', '苗字'];

// コールバック関数（引数に関数を入れる）
function useCombine(array $name, callable $func)
{
  $concatName = $func(...$name);
  // (...)は、配列の中身を展開して、関数に渡す。
  // つまり、combineSpace関数に、$nameParamの「中身を」渡している。
  // これを$func($name)とすると、「配列そのものを丸ごと」渡していることになる
  // 箱だけ渡すのか、中身を取り出して1つずつ渡すか？の違い。
  print($func.'関数での結合結果: ' . $concatName . '<br>');
  // この＄funcに入っているのは、あくまでただの文字列
  // $func(...name)はcombineSpace(...name)と同じなので関数を呼び出すことができるし、$func . '関数での結合結果: '~とすると、単純に文字列の結合となる
}

useCombine($nameParam, 'combineSpace');

