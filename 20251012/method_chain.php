<?php
// メソッドチェーン
$string = 'テスト';

// 商品クラス
class Product
{
  private $price = 1000;
  // クラス内で変数を宣言すると「プロパティ」となる。
  // つまり、このとき$priceはプロパティとなった。
  // 実際には中身が
  // object(Product){
  //   price => 1000
  // }
  // ということ。

  // 価格取得
  public function getPrice()
  {
    return $this->price;
    // $thisは、インスタンス自身を指す。
    // つまり、$this = new Product(); であり、同時に。

    // object(Product){
    //   price => 1000
    // }

    // そのものとなる。
    // そこから、$this->priceとすることで、1000が呼び出せる。
  }
}

// カートクラス
class Cart
{
  private $products = [];

  // 商品追加
  public function addItem($product)
  {
    $this->products[] = $product;
    // $this->products[] = $product; は、$this->productsに$productを追加する。
    // これを$this->products = $product; としてしまうと、配列だったはずの$this->productsを$productの型によらず上書きしてしまう。
  }

  // 商品取得
  public function getItem($index)
  {
    return $this->products[$index];
    // $this->products[$index]は、$this->productsの$index番目の要素を返す。
    // これも$this->productsとしてしまうと、配列だったはずの$this->productsを上書きしてしまう。
  }
}

$cart = new Cart();

// 引数にインスタンス
$cart->addItem(new Product());

// 通常(それぞれメソッド実行)
$gotItem = $cart->getItem(0);
$price = $gotItem->getPrice();

echo '<br>';
echo '通常メソッド' . '<br>';
echo $price;
echo'<br>';

// メソッドチェーン
// メソッドの後にインスタンス（この場合はProduct)のメソッド(getPrice)をチェックする。
$price = $cart->getItem(0)->getPrice();
// やっていることは、上記の通常パターンと同じ。それを一行で書いただけ。
// 最初の$cart->getItem(0)で、$cartの0番目の要素を取得。その「0番目の要素」というのがまたオブジェクトである。そのオブジェクトのgetPriceメソッドを呼び出している。

echo '<br>';
echo 'メソッドチェーン' . '<br>';
echo $price;
echo'<br>';