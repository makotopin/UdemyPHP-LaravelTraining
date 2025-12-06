【11/11】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 88. Laravel blade

Bladeはテンプレートエンジンの1つ。
拡張子が.blade.php となる。

### {{}}
{{ }}で変数の内容を表示できる
XSS攻撃を防ぐための処理がなされている。具体的には
``{{ $user->name }}``
は、内部的には
``<?php echo e($user->name); ?>``
となっており、この e() が
```function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
}```という中身になっている。
そのため、見た目もすっきりしながらXSSを防ぐことができている。
※{{}}のことを「マスタッシュ(口髭)」と呼ぶ


### Bladeディレクティブ
@をつけることでさまざまな機能が使える。
@if, @authなど。
CSRF(クロスサイトリクエストフォージェリ)の対策も、@csrfでできてしまう。
これでセキュリティも担保される。

@phpで生のPHPを書くこともできるし、@errorでエラーを表示できる。
@section, @yieldで共通化させることもできる。

View側では色々なことができる。
コンポーネント、Inertial、Livewireなども使える。