【11/1】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 79. Laravel マイグレーション

DBテーブルの履歴管理をする役割があり、PHPで書くことができる
ファイルの場所はLaravel/migrations
モデルは単数系、マイグレーションは複数形で書くことによって、Laravelが自動判定してモデルとテーブルを紐づけてくれる。

以下、ファイル作成コマンド
``php artisan make:migration create_tests_table``

初期設定で
```    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }```という部分があるので

```$table->string('text');```を追加

その後、
``php artisan migrate``
にて、変クオを反映させる。

``php artisan migrate:fresh``
テーブルを全部削除して、改めて作り直すというコマンド
とにかく、履歴を残さずに反映をさせたい場合などに使用する。