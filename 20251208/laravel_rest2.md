【12/8】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 121~125. 要件定義と基本設計、リレーション
### 要件定義と基本設計
要件定義は「誰が何をどう使いたいか。」から、抽象を具体にする。
大きく「画面設計」「機能設計」「データ設計」がある。
詳しくはこのページ（https://qiita.com/Saku731/items/741fcf0f40dd989ee4f8）を参照するとよい。
※記事にはまず画面設計とあるが、正直ここは顧客次第

フローやER図を作成する時にdrow.ioというツールが無料であるので、それを使ってみてもよい。
詳しくは、上記のURLのページを見てみるのが良い。 

最も難しいのはデータベース設計やデータ設計の部分になるかと思う。ここがうまくいかないと後々開発難易度が上がる。 
### リレーション（1対多①）
データベースのテーブル同士の関係は複数ある。
1対多…複数の中から1つ選べる
多対多…複数の条件を紐づける

なお、外部キーを設定する際には、先に親テーブルのキーが設定されていないと、子テーブルでそのキーを外部キーとして設定することができない。なので、必ず親テーブルから先に設定をする。 
このマイグレーションファイルの中では、foreignIdという書き方をする。 
```
$table->foreignID('area_id');
```

また、シーダーを設定する際にも、外部キー設定をする際に、先に親のテーブルのキーが設定されていないといけないので、この際も書き込む順番には注意する。 

テーブル同士をつなぐときには、JOINを使って接続してあげる。 
```
SELECT * FROM `shops`
INNER JOIN `areas`
ON `shops`.`area_id` = `areas`.`id`;
```
Laravelを使用しているときにはEloquentモデルのクエリビルダで取得することもできる。

### リレーション（1対多②）
Eloquentを使うと、モデルにはずめに等のリレーションを書いておけば、わざわざJOIN等をせずにデータを引っ張ってくることができる。 
例えば、記事からその記事に対するコメントを呼び出したいときは、一対多の関係になるので、記事の方のModelに``hasMany->(Comment::class)``というように書いてあげると、Eloquentで簡単にデータを取ってくることができる体制が整う。 

これには逆もあり、コメント側から記事側を呼び出したいときに関しては、``->belongsTo(Post::class)``というメソッドを使う。 

まずはモデルを作成する
```
php artisan make:model Area -ms
php artisan make:model Shop -ms
php artisan make:model Route -ms
```

Models/Area.php
```
public function shops()
{
	return $this->hasMany(Shops::class);
}
```
※メソッド名を複数形にする

Models/Shops.php
```
public function area()
{
	return $this->BelongsTo(Area::class);
}
```
※メソッド名を単数形にする

テーブルの作成とデータの用意をする
```
php artisan make:migration create_areas_table --create=areas
php artisan make:migration create_routes_table --create=routes
php artisan make:migration create_shops_table --create=shops
```

それぞれの中身は以下
areasテーブル
```
$table->id();
$table->string('name',20);
$table->integer('sort_no');
$table->timestamps();
```

shopsテーブル
```
$table->id();
$table->string('name',20);
$table->foregnId('area_id');
$table->timestamps();
```

seeder作成とデータ挿入
AreaSeeder
```
php artisan make:seeder AreaSeeder

use Illuminate\database\Seeder;
use Illuminate\Support\Facades\DB;

DB::table('areas')->insert([
	['name' => '東京', 'sort_no' => 1 ],
	['name' => '大阪', 'sort_no' => 2 ],
	['name' => '福岡', 'sort_no' => 3 ],
])
```


ShopSeeder
```
php artisan make:seeder ShopSeeder

use Illuminate\database\Seeder;
use Illuminate\Support\Facades\DB;

DB::table('shops')->insert([
	['name' => '高級食パン屋', 'area_id' => 1 ],
	['name' => '高級クロワッサン屋', 'area_id' => 2 ],
	['name' => '高級コッペパン屋', 'area_id' => 1 ],
	['name' => '高級メロンパン屋', 'area_id' => 3 ],
])
```

DatabaseSeeder::run()
```
AreaSeeder::class,
ShopSeeder::class,
```


ルーティング設定、ShopControllerの作成を行う。
Route::get('shops', [ ShopController::class, 'index' ])->name('shops.index')

ShopController::index()
親->子で情報を見たいとき
```
$shops = Area::find(1)->shops; 
dd($shops);
```

子->親で情報を見たい時
```
$area = Shop::find(3)->area;
dd($area);
```

JOINで書いていくと大変なのだが、あらかじめこのようにリレーションをセットしておくと、簡単に情報が取得できる。 

### リレーション（外部キー制約）
親側で登録しているID以外は登録できなくするという制約をかける。 
外部キー制約がついていないと親側で存在しないレコードに対して、子側でIDを設定してしまい、データ不整合によるエラーが発生する。 
テーブルに関する設定なので、migrationファイルにconstrainedと書き込む。 
```
$table->foreignId('area_id')->constrained();
```
またseederを流し直す。

### リレーション（多対多）
中間テーブル（ピボットテーブル）を作成する。 
多対多の場合のモデルには互いに belongsToMany というメソッドを書いていく。 
以下のコマンドで必要なマイグレーションファイルとシーダーのファイルを作成する。 
```
php artisan make:migration create_route_shop_table

php artesan make:seeder RouteShopSeeder
```
pivot tableの名称はアルファベット順で書く。またどちらも単数形とする。 

ShopモデルとRouteモデルにそれぞれリレーションを書く
Shop.php
```
public function routes()
{
	return $this->belongsToMany(Route::class);
}
```

Route.php
```
public function shops()
{
	return $this->belongsToMany(Shop::class);
}
```

routeテーブルとroute_shopテーブルのマイグレーションは以下
routeテーブル
```
$table->id();
$table->string('name', 20);
$table->integer('sort_no');
$table->timestamps();
```

shopテーブル
```
$table->foreignId('route_id');
$table->foreignId('shop_id');
$table->primary(['route_id', 'shop_id']); // テーブルには必ずプライマリーキーが必要なのだが、今回は'id'カラムを削除しているので、別で指定する必要がある。複数のカラムをキーに設定することも可能。
```

RouteSeeder::run()
```
use Illuminate\Support\Facades\DB;
public function run()
{
	DB::table('routes')->insert([
		['name' => '山手線', 'sort_no' => 1],
		['name' => '京浜東北線', 'sort_no' => 2],
		['name' => '東武東上線', 'sort_no' => 3],
	]);
}
```

RouteShopSeeder.php
```
use Illuminate\Support\Facades\DB;

public function run()
{
	DB::table('routes')->insert([
		['route_id' => 1, 'shop_id' => 1],
		['route_id' => 1, 'shop_id' => 2],
		['route_id' => 2, 'shop_id' => 1],
	]);
}
```

DatabaseSeeder.phpに``Route::class``, ``RouteShopSeeder::class``を書きこむ。

ShopController.php
```
$routes = Shop::find(1)->routes()->get()
```



