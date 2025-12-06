【11/29】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 107. index画面、ナビゲーション追加

Index画面は一般的には一覧表示をする画面となっている。
データベースから情報を取得して一覧表示する。

データベースからの情報取得はエロクアントかクエリビルダかの二択
編集する箇所は以下の二箇所
- app/Htp/Controllers/ContactFormController.php
- resources/views/contacts/index.blade.php

**app/Htp/Controllers/ContactFormController.php**
indexメソッドを見る（use分はすでに読み込んでいるのでOK）
selectをつけることでカラムを指定して取得することができる。
```
    public function index()
    {
        $contacts = ContactForm::select('id', 'name', 'title', 'created_at')
        ->get();
        return view('contacts.index', conpact('contacts'));
    }
```
**esources/views/contacts/index.blade.php**
@foreachで繰り返し処理を書いていく
```
                    @foreach ($contacts as $contact)
                        {{$contact->id}}
                        {{$contact->name}}
                        {{$contact->title}}
                        {{$contact->created_at}}
                    @endforeach
```
これで一覧表示そのものは叶うが、デザインが寂しいのでTAIL BLOCKSからコピーしてくる
今回はPRICEの2つ目のリストを使う
<thead>の中身を1つ減らす
<tbody>の中身も1つ減らし、@foreachをすぐ下に入れる
```
<div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 text-lg text-gray-900">氏名</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">タイトル</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">登録日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td class="border-t-2 border-gray-200 px-4 py-3">{{$contact->id}}</td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3">{{$contact->name}}</td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">{{$contact->title}}</td>
                                        <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">{{$contact->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
```

**ナビゲーションバーをつける**
resources/views/layouts/navigation.blade.php
```
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
```
とあるのでこれをコピーして
```
                    <x-nav-link :href="route('contacts.index')" :active="request()->routeIs('contacts.index')">
                        {{ __('Contacts') }}
                    </x-nav-link>
```
を真下につけてあげる


