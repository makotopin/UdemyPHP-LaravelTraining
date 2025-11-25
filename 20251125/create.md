【11/25】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 103. Create 新規登録 レイアウト調整
CRUDを書いていく
依然作った /contacts を編集していく
dashbord.blade.phpをコピーして、contacts/index.blade.phpに貼る
このindex.blade.phpにおいて、下記のように書いてリンク作成。```
```
<a href="{{ route('contacts.create') }}">新規登録</a>
```
この'route'はヘルパ関数で、名前付きルートを指定してリンク先にできる。
※リンク先のルーティングはこれから設定する。

【ルーティング】
既存のルーティンググループに以下を追加する。
```
Route::get('/create', 'create')->name('create');
```
すでにグループ化しているため、本当は'contacts/create'なのだが、このように省略して書く事ができる。

【コントローラ】
すでに ``php artisan make:controller ContactFormController --resource``にて、createメソッドは作成済みなので、そこに以下の処理を追加で記入する。
```
return view('contacts.create');
```

【ビュー】
index.blade.phpをコピペしてcreate.blade.phpを作成。
新規登録のリンクが表示されていることと、クリックしたら画面遷移することを確認する
（このリンクはTailwindcssで ``class="text-blue-500"など追加してリンクだとわかるようにしておく)

また、TAILBLOCKSというサイトのCONTACTの3つ目のコードをコピーしてあげる。
そこからインデント調整をして、レイアウトも調整してあげる。
- 'Contact US'や、その下の文章を削除
- emailは不要なので削除
- nameが1/2になっているのでfullに変更
- ボタンの下のフッター部分を削除
- 全体の縦方向のパディングがおおきい(24)ので、削除