<?php
// クラスは単一の継承しかできなかったが、トレイトを使用することで複数の継承が可能になる。

trait ProductTrait
{
  public function getProduct()
  {
    echo 'プロダクト';
  }
}

trait NewsTrait
{
  public function getNews()
  {
    echo 'ニュース';
  }
}


class Product
{
  use ProductTrait;
  use NewsTrait;
  // ↑複数のトレイトを使用することができる。

  public function getInformation()
  {
    echo 'クラスです';
  }

  // public function getProduct()
  // {
  //   echo 'プロダクトクラスのメソッドです';
  // }
  // ↑オーバーライドすることもできる。
}

$product = new Product();

$product->getInformation();
echo '<br>';
$product->getNews();
echo '<br>';
$product->getProduct();
echo '<br>';

// まとめ
// クラス…「型」「インスタンス化」「継承」の主役
// インターフェース…「契約（多態の受け口）」
// トレイト…「共通コードの再利用（コピペの賢い代替）」
