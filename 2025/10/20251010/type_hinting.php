<?php
echo 'タイプヒンティング';
echo '<br>';

// タイプヒンティング（引数の型を明示・指定する）
function typeTest(string $string){
  var_dump($string);
}

function noTypeHint($string){
  var_dump($string);
}

// 配列を渡した場合
// ↓エラーが発生しない。なぜなら、型を細かく指定していないため。
noTypeHint(['テスト']);
echo '<br>';

// エラーが発生する。なぜなら、型を細かく指定しているため。
typeTest(['テスト']);
echo '<br>';

// なお、typeTestをnoTypeTestより上に書くと、noTypeTestが実行されない。
// これは、先に実行されたtypeTestで処理が中断してしまうため。
// なので、typeTestをnoTypeTestより上に書くこと。

// なお、
// declear(static_types);
//　を記述することで、強制的に型を指定することができる。
// PHPは動的型付け言語であるため、元々の制限が緩い。なので、これを記述することで、型を指定することができる。