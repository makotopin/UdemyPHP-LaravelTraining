<?php

namespace App\Models;

// クラスの名前はファイルと同じにする必要あり
// なので1ファイル1クラス
class TestModel
{
  private $text = 'Hello world';

  public function getHello(){
    return $this->text;
    // 自分のクラスの中の$textを返す
  }
}