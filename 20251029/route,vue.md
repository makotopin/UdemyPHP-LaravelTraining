# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 76. ルート、ビュー

### ルーティング
URLが叩かれてから最初に通る場所。
Laravelではroutesフォルダの中のweb.phpが該当する。（/routes/web.php）
初期では
```Route::get('/', function () {
    return view('welcome');
});```
このURLできたら、このviewファイルを開いてほしいとなっている。

このviewファイルに関しては、具体的には /resources/view/welcome.blade.php というファイルを呼び出している
中は通常のHTMLファイルのようにheadとbodyがある。
