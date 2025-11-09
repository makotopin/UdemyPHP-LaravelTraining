<?php

// デフォルト値を設定した関数
function defaultValue($string = ''){
  echo $string . 'です';
}

// 引数なしで呼び出し
defaultValue();
echo '<br>';

// 引数ありで呼び出し
defaultValue('テスト');


// デフォルト値がない関数
function noDefaultValue($string){
  echo $string . 'です';
}

// 引数なしで呼び出し
noDefaultValue();
echo '<br>';
// ↑エラーが発生する（デフォルト値がなく、引数もないため）
// なので、デフォルト値を設定しておく


