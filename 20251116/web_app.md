【11/16】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 94. Laravel 概要 モデル・マイグレーション

ここからは実際に、Laravelを使用して簡易的なWebアプリケーションを作成する。
以下、搭載機能
- お問い合わせフォームの拡張版（CRUD）→REST（RESTful）を活用
- バリデーション
- ダミーデータ（シーダー・ファクトリー）
- ページネーション
- 簡易検索機能
- Model -> Route -> Controller -> View

### モデル・マイグレーション
```php artisan make:model ContactForms -m```
モデルを作成する際に'-m'をつけることで、マイグレーションも同時作成される。
モデルは単数系、マイグレーションファイルは複数形で生成される。

モデル・マイグレーションファイルの作成を確認
マイグレーションファイルにて、以下の部分を確認
```        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });```contact_formsとなっているのは、DBの中には大文字小文字を判別できないものもあるため。
まずはこのmigrationファイルに必要なカラムを追記しておく。
念の為ドキュメントを確認しておくと、利用可能なカラムが一覧で見ることができる。コピーしてくるのもよい。
```
$table->string('name', 20);
$table->string('email', 255);
$table->longText('url')->nullable();
$table->boolean('gender');
$table->TinyInteger('age');
$table->string('contact', 200);
```を追加する。
```php artisan migrate```で実行
問題がなければ、DBに新たなテーブルが作られる

なお、phpMyAdminにて確認すると、idの属性は'UNSIGNED’となっている。
この属性を持っているとマイナスのあたいを入れることができないなど、制限に関与する。