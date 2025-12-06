【11/30】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 108. show 詳細画面追加
リソースコントローラー（よく使うメソッドをまとめて生成できる）で作られる7つのアクションのうち、今度は詳細（=show）の画面を作っていく
showは
- GET通信
- URIは /xxx/{}
- ルート名は xxx.show
詳細画面なので、通常、idなどを指定する

作成の流れがいつも通りルーティング → コントローラー → ビュー

1. ルーティング
route/web.php
```
Route::get('/{id}', 'show')->name('show');
```
を追加し
```
php artisan route:list
```
で確認する

2. コントローラー
app/Http/Controllers/ContactFormController.php
showメソッドに追記
```
    public function show($id)
    {
        $contact = ContactForm::find($id);
        return view('contacts.show', compact('contact'));
    }
```
Eloquentコレクション（Laravelコレクションの拡張…つまり機能が増えている。）の'find'は、引数に数値を入れて1つのレコードを取得できる。
今回はfind($id)とすることで、クリックしたコンタクトのidが入るようになっている。


3. ビュー
create.blade.phpをコピーして作成する
formタグと@csrfは削除
まずは{{$contact->id}}などで、情報がとれているのか？を確認する。

続いて、リンクの作成をする。
index.blade.phpに移動し、表の右端に詳細画面へと遷移するためのリンクを作成する
```<th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>```と
```<td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900"><a href="{{ route('contacts.show', ['id' => $contact->id]) }}">詳細</a></td>```を追加

なお、
```<a href="{{ route('contacts.show', ['id' => $contact->id]) }}">詳細</a>```の部分だが、
名前付きルートがパラメータを定義している場合は、パラメータを2番目の引数としてroute関数に渡すことでフロントエンドに運べる。
```class="text-blue-500 hover:underline"```をつけてあげて、青字にする。