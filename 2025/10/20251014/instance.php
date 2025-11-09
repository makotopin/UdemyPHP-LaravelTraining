<?php

// クラスの書き方
class Product
// 大文字から始める
{
  // アクセス修飾詞：public, private, protected
  // public：クラス内、クラス外からアクセス可能
  // private：クラス内からのみアクセス可能
  // protected：クラス内、継承したクラスのみアクセス可能
  // デフォルトはpublic

  // クラス内には変数も関数もいくつでも作れる

  // 変数
  private $product = [];
  
  // 関数
  function __construct($product)
  {
    $this->product = $product;
  }
  // __constructは、クラスがインスタンス化されたときに自動的に実行される関数

  public function getProduct()
  {
    echo $this->product;
  }

  public function addProduct($item)
  {
    $this->product .= $item;
    // .=（ドットイコール） は、PHPの「文字列連結代入演算子」
    // 例えば $a .= $b は、$a = $a . $b と同じ。
  }

  public static function getStaticProduct($str){
    // staticは、クラスの静的メソッドとなる。
    // 静的メソッドは、クラスのインスタンス化をせずに呼び出すことができる。
    // Product::getStaticProduct('静的メソッド'); とすることで、静的メソッドを呼び出すことができる。
    echo $str;
  }
}

$instance = new Product('テスト');

var_dump($instance);

$instance->getProduct();
echo '<br>';

$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';

Product::getStaticProduct('静的メソッド');
echo '<br>';
