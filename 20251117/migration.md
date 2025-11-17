【11/17】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 95. laravel マイグレーション 追加とロールバック

マイグレーションとは、テーブルの履歴を管理するしくみ
カラムの追加・削除の履歴も残る
```php artisan make:migration add_title_to_contact_forms_table```これで追加する

public function up()でカラムを追加する
public function down()で戻す処理をする
またSchema::createではなくSchema::tableになっている

今回は```$table->string('title', 50)->after('name');```を関数の中に書いてあげる
titleカラムをnameカラムの後ろに50文字までの文字列型で作成するという意味

public function down()の中には```$table->dropColumn('title');```を入れる

php artisan migrate::rollback で1つ戻す
php artisan migrate::rollback --step-2 これで2つ戻せる
php artisan migrate::refresh ロールバックして再実行（つまりdownメソッドもちゃんと書かないとだめ）
php artisan migrate::fresh (こっちは全消し→再migrate)

実際の開発の時はcreateに直接書き足してfreshしてしまうこともある。