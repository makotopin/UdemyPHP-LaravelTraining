【11/18】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 96. Laravel 以前書いていたコードの復元

### 復元
Laravel Breezeをインストールしたことで、ルーティングが書き換わってしまっている。
TestControllerを作成したが、消えてしまっているのでそれを復元する。

web.phpにて
1. use App\Http\Controllers\TestController を書いて宣言する。
2. 以下のルーティングを設定
```
Route::get('tests/test', [ TestController::class, 'index ]);
```
URLが異なるので、どこに書いてもOK。（同じURLだと上に書かれている物から優先される。）
3.　ルーティングの存在確認
 ```php artisan route:list```
 4. URLを叩いて画面確認

### マイグレーションの確認
```php artisan migrate:fresh```
を叩いてみる→消えるのを確認する。
データが無いので404エラーが出る事を確認する。
デバッグもできる。

TestController::indexの一番上に``dd('test')``を入力しておくことで、一旦保留。ダミーデータ作成パートにて再度確認する。