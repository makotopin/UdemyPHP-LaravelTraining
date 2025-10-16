<?php
// インターフェース
// インターフェースは、メソッドのみを定義することができる。
// インターフェースは、クラスに実装を強制することができる。
interface ProductInterface
// interfaceをつけると、このクラスはインターフェースになる。
{
  // public function echoProduct()
  // {
  //   echo '親クラスです';
  // }
  // interfaceには、メソッドの中身を書けない。
  
  public function getProduct();
  // 本当に↑のように、メソッドのみ書くことができる　。
}

interface NewsInterface
// interfaceをつけると、このクラスはインターフェースになる。
{
  // public function echoProduct()
  // {
  //   echo '親クラスです';
  // }
  // interfaceには、メソッドの中身を書けない。
  
  public function getNews();
  // 本当に↑のように、メソッドのみ書くことができる　。
}

// 子クラス
final class Product implements ProductInterface, NewsInterface
// implementsをつけると、このクラスはインターフェースを実装する。
// 複数のインターフェースを実装することができる。
// クラスは 多重継承はできない（extends は1つだけ）が、インターフェースは複数 “implements” できる のが特徴。
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

  public function getNews()
  {
    echo 'ニュースです';
  }

  public static function getStaticProduct($str){
    echo $str;
  }
}

$instance = new Product('テスト');

var_dump($instance);

$instance->getProduct();
echo '<br>';

// $instance->echoProduct();
// echo '<br>';

$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';

$instance->getNews();
echo '<br>';

Product::getStaticProduct('静的メソッド');
echo '<br>';


// インターフェースの例
//共通処理は要らないけど、「最低限これだけは実装してほしい」というものがあるとき
// 他のライブラリや依存関係と疎結合にしたいときなど
// 例：

// interface Sendable {
//   public function send($message);
// }

// class Mailer implements Sendable {
//   public function send($message) { echo "メール送信: $message"; }
// }

// class LineBot implements Sendable {
//   public function send($message) { echo "LINE送信: $message"; }
// }


// 「send() メソッドを持っていること」が保証されるので、外部から見るとどのクラスでも同じように扱える

// function notify(Sendable $sender, $msg) {
//   $sender->send($msg);
// }

// notify(new Mailer(), "こんにちは");
// notify(new LineBot(), "やっほー");
// どちらを渡してもOK！