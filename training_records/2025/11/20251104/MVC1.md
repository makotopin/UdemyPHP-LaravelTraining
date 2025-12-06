【11/4】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 82. MVCモデルの記述方法1

ルーティング→コントローラ→ビューの流れで、実際にMVCモデルを記述してみる

### ルーティング
routes/web.phpに記入
```use App\Http\Controllers\TestController; // ファイル内で使用できるようにする為
Route::get('tests/test', [TestController::class, 'index']); // メソッド名、URL、コントローラ名、関数名を順番に書く

### コントローラ
App/Http/Controllers/TestController.php
```public function index()
{
  return view('tests/test'); // viewはLaravelのヘルパ関数。フォルダ名とファイル名は'.'で接続する
}```

### ビュー
resources/views/tests/test.blade.php // viewに使用するのはbladeファイル
test
