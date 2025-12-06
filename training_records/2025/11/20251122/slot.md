【11/22】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 100. スロット、名前付きスロット
resources > views > layouts > guest.blade.php
{{ $slot }} という部分がある

スロットとは
ヘッダー・フッターなどの共通の部分をまとめたり、一部だけ他の表示に差し替えたりできる機能のこと
今回のページは、login.blade.phpの中のコードが差し込まれるようなイメージになる。
なので {{ $slot }} とあれば、他の何かが差し込まれる。

また、{{ }}の中にはPHPw書くことができる。
```<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">```だが、ここで言語設定をしてる。
str_replaceで文字を変換している'_'から'-’への変換である
app()->getLocale()は、ヘルパ関数で、設定されている言語に対応
```<meta name="viewport" content="width=device-width, initial-scale=1">```でレスポンシブ対応もしている。また、LaravelではCSRFが必須になるので、これを書く```<meta name="csrf-token" content="{{ csrf_token() }}">```
また、タイトルに関しては
```<title>{{ config('app.name', 'Laravel') }}</title>```となっている。
この'config'はヘルパ関数である。
config > app.php::nameを参照すると
```'name' => env('APP_NAME', 'Laravel'),```となっており、このアプリケーションの名前を決められる。
さらにこの'APP_NAME'は別のヘルパ関数を使用している。
.envのAPP_NAME = Laeavelの情報をもってきている。

ここでは何度も'Laravel'という文字列が出てきているが、これは最も奥にある.envにてAPP_NAMEが設定されていなかった時用の保険のデフォルト値
というのも、.envはコミットしなかったり、ファイルが一時的に存在しないタイミングもある（新規クローン時など）。
なので、毎回', Laravel'と入力しているものは、基本的には省略せずにそのまま書くのが通例である。


```@vite(['resources/css/app.css', 'resources/js/app.js'])```これを書くことで、CSSが書かれているファイルを呼び出しているので、これを書かないとうまくjsが当たらないということが起こる。


dashboard.blade.phpにおいて```<x-slot name="header">```などは名前付きスロットという
この場合はheaderという名前が付いている。
```<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>```となっているので、このx-app-layout つまり views > layouts > app.blade.php を見ると
  {{ $header }}
が確認できる。

この{{ $header }}の中に、上記の部分が入る。
つまり、親が子を呼び出しているのではなくて「子が親を呼び出している」
どの親を呼び出すかは```<x-app-layout>```の部分で決めている。
なので、呼び出した箇所の中で上と下など決まったレイアウトを入れたい場合はスロットを2つ設定する必要がある。