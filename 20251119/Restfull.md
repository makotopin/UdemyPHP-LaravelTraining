【11/19】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 97. ResrFullなコントローラー
コントローラ側で、よく使うメソッドをまとめて生成する事ができる方法がある
```
php artisan make:controller ContactFormController --resource
```
リソースコントローラーと呼ばれている機能である。
ドキュメントの 基礎＞コントローラの中に説明がある。
この「リソース」はWeb業界ではRestFullと言われている。
以下、まとめて作成されるルートのアクション ()内は動詞
- index (GET)
- create (GET)
- store (POST)
- show (GET)
- edit (GET)
- update (PUT/PATCH)
- destroy (DELETE)
これらのメソッドを含むコントローラが一括で作成される。

また、ルーティングに関しても同様で
```
Route::resource('contacts', ContactFormController::class);
```
で、上記の7つ分のルーティングを書いたことと同義になる。
実際に
```
php artisan route:list
```
にて確認すると7つのルーティングが設定されたことが分かる。

