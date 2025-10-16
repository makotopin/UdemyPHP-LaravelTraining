<?php
// abstractとinterfaceの使い分け

// 抽象クラス
abstract class BentoBox {
  public function pack() {
    echo "🍚 ご飯ゾーン詰めました\n";
    $this->addMainDish(); // ← 子クラスで実装する約束
  }

  abstract protected function addMainDish();
}

class KaraageBento extends BentoBox {
  protected function addMainDish() {
    echo "🍗 唐揚げを入れました\n";
  }
}

(new KaraageBento())->pack();

/*
結果：
🍚 ご飯ゾーン詰めました
🍗 唐揚げを入れました
*/


// インターフェース
interface BentoInterface {
  public function rice();
  public function main();
  public function dessert();
}

class MomBento implements BentoInterface {
  public function rice() { echo "🍙 おにぎり\n"; }
  public function main() { echo "🍳 卵焼き\n"; }
  public function dessert() { echo "🍎 リンゴ\n"; }
}

class DadBento implements BentoInterface {
  public function rice() { echo "🍚 チャーハン\n"; }
  public function main() { echo "🥩 ステーキ\n"; }
  public function dessert() { echo "🍫 チョコ\n"; }
}

function checkBento(BentoInterface $bento) {
  $bento->rice();
  $bento->main();
  $bento->dessert();
}

checkBento(new MomBento());
/*
結果：
🍙 おにぎり
🍳 卵焼き
🍎 リンゴ
*/
