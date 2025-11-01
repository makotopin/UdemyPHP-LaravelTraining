【10/31】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 78. Laravel モデル

MVCモデルのMの部分
モデルはDBとやり取りをする機能を持つ

DBとのやり取りをSQLではなく他の言語で書ける仕組みをORM（ORマッパー）…Object Relational Mapping
どの言語にもORマッパーはあるのだが、PHP・LaravelのORマッパーはEloquent（エロクアント）という名前

モデルファイルの作り方
```php artisan make:model Modelname```
のコマンドでモデルが作成される
作成される場所はApp/Modelsの配下
コントローラーやマイグレーションも同時に作成するのであれば
```php artisan make:model Modelname- m```
で作成できる
