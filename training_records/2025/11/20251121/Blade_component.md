【11/21】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 99. Bladeコンポーネントについて(login.blade.php)
ログインボタンを押してから、ログイン画面が表示されるまでをしっかり見てみる
views>auth>login.blade.php
<x-guest-layout>
この'x'で始まるタグはBladeコンポーネント
このコンポーネントの置き場所はクラスを使うパターンと使わないパターンとで分かれる
- クラスを使う時は app/View/Components/配下
- クラスを使わない時は resources/view/components/配下
に置かれている
(先にresourcesを見て、無ければappを見るのが良さそう)

<x-auth-card>など、'x-'で始まっているものは基本的にはresourcesの中にある。
先ほどの<x-guest-layout>はapp側にある。
この<x-guest-layout>に該当するファイルを見てみると
```namespace APP\View\Components;
use Illuminate\View\Component;```
とあり、view側との関連がある事が分かる。

ここではrenderというメソッドでguest.blade.phpを返すようにしている。



