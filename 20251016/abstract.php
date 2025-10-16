<?php
// 抽象クラス
// 抽象クラスは、子クラスで必ず実装しなければならないメソッドを持つクラス。
// 抽象クラスは、インスタンス化できない。
// 抽象クラスは、共通の設計図を作るためのクラスである。
// つまり「子クラスに実装を強制したいもの」を管理するクラスである。

abstract class ProductAbstract
// abstractをつけると、このクラスは抽象クラスになる。
{
  public function echoProduct()
  {
    echo '親クラスです';
  }

  abstract public function getProduct();
  // abstractをつけると、この関数は抽象メソッドになる。
  // abstractをつけると、このメソッドの中身には何も書けない。
  // つまり、このメソッドは子クラスで必ず実装しなければならない。
}


// 具象クラス
class BaseProduct
{
  // 変数や関数を入れる
  public function echoProduct()
  {
    echo '親クラスです';
  }

  public function getProduct()
  {
    echo '親の関数です。';
  }
}


// 子クラス
final class Product extends ProductAbstract
{
  private $product = [];

  function __construct($product)
  {
    $this->product = $product;
  }

  public function getProduct()
  {
    echo $this->product;
  }

  public function addProduct($item)
  {
    $this->product .= $item;
  }

  public static function getStaticProduct($str){
    echo $str;
  }
}

$instance = new Product('テスト');

var_dump($instance);

$instance->getProduct();
echo '<br>';

$instance->echoProduct();
echo '<br>';

$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';

Product::getStaticProduct('静的メソッド');
echo '<br>';


// abstract(抽象クラス)の例
// 親クラスで ある程度の共通機能を持たせたい
// でも 子クラスごとに一部だけ変えたい

//  例：
// abstract class ReportGenerator {
//   public function generate() {
//     $this->prepare();
//     $this->output();
//   }
// generate() で処理の流れを共通化し、prepare() と output() は子クラスごとに書き換える。
