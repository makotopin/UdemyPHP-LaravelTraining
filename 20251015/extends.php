<?php
// 継承
// 継承するクラス(親クラス・基底クラス・スーパークラス)
// 継承させることで親クラスの中に持っている関数や変数を子クラス
class BaseProduct
{
  // 変数や関数を入れる
  public function echoProduct()
  {
    echo '親クラスです';
  }

  // オーバーライド（上書き）
  // 関数の名前が一緒ならば、子クラスが優先される
  // もしも、親のクラスを使いたいのであれば'parent::'をつけることで使用可能
  public function getProduct()
  {
    echo '親の関数です。';
  }
}


// 継承するクラス(子クラス・派生クラス・サブクラス)
// extendsは、継承するクラスを指定する。
final class Product extends BaseProduct
// finalをつけると、このクラスからの継承をしないようにできる
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

// 親クラスの関数を呼び出している
$instance->echoProduct();
echo '<br>';

$instance->addProduct('追加分');
echo '<br>';

$instance->getProduct();
echo '<br>';

Product::getStaticProduct('静的メソッド');
echo '<br>';
