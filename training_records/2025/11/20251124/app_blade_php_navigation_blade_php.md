【11/24】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 102. app.blade.phpとnavigation.blade.php

ログイン後の画面
まずはdashbord.blade.php
```<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>```
まずは、この<x-app-layout>を確認する。
views/componentsから確認する。それでも見つからなかったので、app/View/Components/AppLayout.phpを確認。
すると、```    public function render(): View
    {
        return view('layouts.app');
    }```とあるので、resources/views/layouts/app.blade.phpを確認する。（はじめからlayoutフォルダのapp.blade.phpを確認するのではダメ？）

```            @include('layouts.navigation')```とあるが、これはlayoutsフォルダのnavigationを読み込むという操作となっている。
つまり、ナビゲーションバーを読んでいる。
（ここでは小要素が親要素を呼ぶのではなく、あくまで親が子を呼んでいる。つまり、slotとは考え方が逆になっている。）


navibation.blade.phpの以下の部分```                <x-dropdown align="right" width="48">```を確認すると、これもコンポーネントを引っ張ってきている。
components/dropdown.blade.phpを確認すると、名前付きスロットのtrigger, contentがある。
```                            <div>{{ Auth::user()->name }}</div>```で名前の表示
```                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>```で下矢印のアイコンなど、1つずつ表示されている内容が書かれている。

```<!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>```でハンバーガーメニューも入っている。sm:hiddenとあり、こちらはレスポンシブになっている。

これらの多くの内容を```            @include('layouts.navigation')```から持ってきている。