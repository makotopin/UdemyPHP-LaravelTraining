【11/27】
PHPからLaravelまで サーバーサイドをとことんやってみよう
105. Store Requestクラス

'store'・・・つまり、保存処理を作っていく

リソースコントローラーでは、storeメソッドは
- POST通信
- URIはGETと同じ
- アクションはstore
- ルート名は〇〇〇.store
という風に生成される

### ルーティング
web.phpにルーティングを設定する。
```Route::('/', 'store')->name('store');```
これを書いてから
```php artisan route:list```
でルーティングが正しく設定されているか？を確認。

### コントローラー
app/Http/Controllers/ContactFormController.phpのstoreメソッドに処理を追加
これまでとの違いは**storeメソッドは引数を受け取る**ということ
```
public function store(Request $request)
{
    dd($request);
}
```
PHPでは$＿POSTというスーパーグローバル変数を使ってDBに保存していたが
LaravelではRequestクラスというクラスを使う。
Requestクラスは、$＿POSTを拡張したような機能を持っている。
DI（Dependency Injection ... 依存性の注入）を使う
つまり、すでにインスタンス化した物が入ってきている（メソッドインジェクションとも呼ぶ）

このRequestクラスはComposerでインストールしているのでvenderディレクトリの配下に存在している
vender/laravel/framework/src/Illuminate/Http/Request.php
このクラスだけでもたくさんの関数を持っているが、さらにSymfonyRequestという昔からのクラスを継承しているので、そちらの機能も使う事ができる。

フォームにも少し情報を追加する
create.blade.phpのformタグのactionの中身を埋める
{{ route('contacts.store') }}
を中に入れる。

そして実際にフォームに入力してみて、ddで止まるのかどうか？を確認する
ddで止まったらrequestを開く事で送った情報を見る事ができる。
```
public function store(Request $request)
{
    dd($request, $request->name);
}
```
としてname属性を指定してあげると、指定した情報だけを取り出せる。



