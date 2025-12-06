【12/5】
## PHPからLaravelまで サーバーサイドをとことんやってみよう
## 113~120
- サービスの切り離し（ファットコントローラー防止）
- バリデーション（フォームリクエスト）
- oldヘルパ関数
- ダミーデータ（シーダー）
- ダミーデータ（Factory & Faker）
- ページネーション
- 検索フォーム その1
- 検索フォーム その2（クエリのローカルスコープ）

#### サービスの切り離し
コントローラーにすべての処理を書くとどんどんコントローラが肥大化していってしまうので、処理を別ファイルに分けることでコントローラをできるだけスリムにする。 

今までコントローラーに書いていた処理を、'Service'というファイルを別で作り、そこに処理を逃がしてあげる。 
Laravelにはサービスを作るコマンドがないので、ここは実は手作業しなくてはいけない。

現在テストで作っているフォームを入力するシステムに関しては、性別の入力欄と年齢の入力欄の処理が少し重たくなっているので、その処理をサービス層に逃がす。 

app/Service/CheckFormServise.php を作成
```
<?php

namespace App\Services;

class CheckFormService {
	public static function checkGender($data){
		if($data->gender === 0){
			$gender = '男性';
		} ifelse($data->gender === 1) {
			$gender = '女性';
		} else {
			$gender = 'その他';
		}
		
		return $gender;
	}

	public static function checkAge($data){
		if($data->age === 1){$age = '～19歳';}
		if($data->age === 2){$age = '20～29歳';}
		if($data->age === 3){$age = '30～39歳';}
		if($data->age === 4){$age = '40～49歳';}
		if($data->age === 5){$age = '50～59歳';}
		if($data->age === 6){$age = '60歳～';}
	}
	
	return $age;
}
```
と書いて、コントローラーでこのサービスを呼び出す。
```
use App\Services\CheckFormService;

$gender = checkFormService::checkGender($contact);
$age = checkFormService::checkAge($contact);
```

#### バリデーション
バリデーションは以前書いたようにコントローラーに直接記入することもできるが、FATコントローラーになることを防ぐために、フォームリクエストという機能を使って別の場所で設定することも可能である。
マニュアルを確認するのが良い（バリデーションルールがたくさんある、ビュー側のエラー表示もある。）。
リクエストはコマンドで作ることができるので、コマンドを使って生成する。 
```
php artisan make:request StoreContactRequest
```
作成したファイルにはauthrizeというメソッドがあるが、元々returnがfalseになっているが、このreturnの返ってくる値をtrueに変えてあげる。 （ここをtrueに変えていないとうまくバリデーションがかからない。 ）
実際のバリデーションの内容は、その下部にあるruleメソッドの中に書いていく。 
```
public function rules()
{
    return [
        'name'    => ['required', 'string', 'max:20'],
        'title'   => ['required', 'string', 'max:50'],
        'email'   => ['required', 'email', 'max:255'], // テーブル毎に1件ならunique:contact_forms
        'url'     => ['url', 'nullable'],
        'gender'  => ['required'],
        'age'     => ['required'],
        'contact' => ['required', 'string', 'max:200'],
        'caution' => ['required', 'accepted'],
    ];
}
```

ContactFormControllerにて、use文でStoreContactRequestを指定し、storeメソッドの引数の'Request'もStoreContactRequestに変更する。 

また、エラーメッセージに関してはresources/views/auth内のlogin.blade.phpを参照すると
"<x-auth-validation-errors..."という部分を見つけられる。
このコンポーネントの中にエラーを検知して表示するコードが含まれている。なのでこのコンポーネントをcreate.blade.phpの上部sectionタグとformタグの間で呼び出してあげる。
このままだと、未入力の部分が「名前」や「タイトル」が入力されていません、などと表示されるが、これは lang フォルダの ja 内にある validation.php というファイルの'attributes'の中で設定可能。 
```
'name' => '氏名',
'title' => '件名',
'gender' => '性別',
'age' => '年齢',
'contact' => 'お問い合わせ内容',
'caution' => '注意事項',
```
これ以外であれば、上部で変更も可能。

updateの処理の中でバリデーションをかける際も同じように書くが、アップデートなので caution だけは含まないように気をつける。 
#### oldヘルパ関数
oldは、バリデーションで弾かれてしまったときに一度入力した内容が消えてしまうと不便になるので、その入力内容を残すようなヘルパ関数。
各inputタグにこのような設定を書いてあげる。 （textareaはタグの間なので注意）
```
value="{{old('name')}}"
```

ラジオボタンのインプットは以下。
```
value="0" {{ old('gender') == 0 ? 'cgecked' : '' }}
value="1" {{ old('gender') == 1 ? 'cgecked' : '' }}
value="2" {{ old('gender') == 2 ? 'cgecked' : '' }}
```

セレクトボックスは以下。
```
value="1" {{ old('age') == 1 ? 'selected' : '' }}
// その他の年齢も同様に
```

#### ダミーデータ（シーダー）
動作確認のためデータを入力する必要があるが、毎回一つずつフォームから新規登録をするのは非常に手間である。そのため、ダミーデータを作成する。
ダミーデータを作る方法は大きく2つあり、1つずつ作るのであればSeederに直書きをする。 大量に作るのであれば、FactoryやFakerといったものも混ぜて作っていく。 

まずはSeederファイルを以下のコマンドで作成する。 （以前作成したtestsテーブルとusersテーブル ）
```
php artisan make:seeder TestSeeder
php artisan make:seeder UserSeeder
```
作成した2つのシーダーファイルそれぞれに以下の情報をコピーする。 
マニュアルからクエリビルダによるコードをコピーしてくる。 （データベース：シーディング）
また、DatabaseSeederのファイルの中には、DBファサード、Hashファサードが必須になってくるので、それらをuse文で追加してあげる。 

準備が整ったら、ファイル内のrunメソッドにデータの情報を書いていく。 
```
publec function run(){
	DB::table('tests')->insert([
		[
			'text' => 'aaa',
			'created_at' => Now()
		],
		[
			'text' => 'bbb',
			'created_at' => Now()
		],
	])
}
```
このSeederファイルはDatabaseSeederで呼び出さないといけない。
```
public function run(){
	$this->call([
		TestSeeder::class,
	])
}
```

テーブル全削除＋Seederのダミーデータ作成
```
php artisan migrate:fresh --seed
```

同様にUsersテーブルにSeederもセットする
```
publec function run(){
	DB::table('users')->insert([
		[
			'name' => 'aaa',
			'email' => 'test@test.com',
			'password' => Hash::make('passwore123'),
		],
	])
}
```
これでseederを流した後に新しいユーザーでログインできればOK

#### ダミーデータ（Factory & Faker）
ダミーデータを大量に作るにはFakerを使う。
fakeヘルパを使ってFaker PHP Libraryにアクセスし、テストやシードのために様々な種類のランダムデータを生成できる。 まずはコマンドでファクトリーを作る。 
```
php artisan make:factory ContactFormFactory
```
database/factoryにできる。サンプルとしてUserFactory.php::difinition()を見てみると、キーとデータの組み合わせが連想配列で書かれているので要参照。

また日本語設定をする必要があるので、config/app.phpの下部にfaker_localeという部分があるので、 ここを'ja_JP'に変更する。
実際にContactFormFactoryのdefinition()の中に以下のコードを書く。 
```
public function difinition(){
	return [
		'name' => $this->faker->name(20),
		'title' => $this->faker->realText(50),
		'email' => $this->faker->email(),
		'url' => $this->faker->url(),
		'gender' => $this->faker->numberBetween(1,3),
		'age' => $this->faker->numberBetween(1,6),
		'contact' => $this->faker->realText(200),
	]
}
```
またファクトリーを作った際はSeederにそちらを書き込む必要があるので、database/Seeder.phpのrun()の中に以下を書き込む。 
```
\App\Models\ContactForm::factory(100)->create();
```
これで100件のデータができあがる
#### ページネーション
大量のデータがあった際にページごとに何件と指定して表示する機能がページネーション。
Laravelでは簡単にページネーションを実装することができる。コントローラー側では'->pagenate(20)'を呼び出せば良い(20というのは1ページ当たりの表示件数)。View側では変数名の横に'->links()'を付ければ良い。 

ContactFormController::index()
```
$contacts = ContactForm::...)->get();
```
から
```
$contacts = ContactForm::...)->pagenate(20);
```

index.blade.php テーブルタグの少し下に書く
```
</table>
</div>
{{ $contact->links() }}
```
日本語にしたければ、マニュアルのデータベース：ペジネーションを参照すると
>ページネーションビューをカスタマイズする最も簡単な方法は、vendor:publish コマンドを使用して resources/views/vendor ディレクトリにエクスポートすることです。 

と書かれている。以下のコマンドを叩いてvendorフォルダをresourcesフォルダの配下にコピーしてくる。 
```
php artisan vendor:publish --tag=laravel-pagination
```
resources/vendor/pagination/tailwind.blade.php を開く（お子のみのCSSでOK）
その中に"Showing", "to", "of", "results"」などと書かれている部分があるので、そこを日本語に変更してあげる。
#### 検索フォーム その1
検索フォームを実装するときにはwhereで全文検索などができてlikeを使うと曖昧検索もできる。 
まずはMAMPのSQLのところで実験をしてみる。ContactFormsテーブルには現在ダミーのデータが入っていると思うので、一番上のデータのnameの中にある名前（フェイカーが作ったものなので何が入っているかは見ないと分からない。）を入力してあげる。 
```
select * from `contact_forms` where `name` like `%ここに名前%` 
```
画面下部のクエリボックスを保持するという欄にチェックを付けって実行する。
さらに
```
select * from `contact_forms` where `name` like `%ここに名前%` and `name` like `%ここに2つ目の検索ワード%`
```
とするとand検索ができる。

index.blade.php の新規登録のaタグの下に新たにformタグを設置する。 
```
<form class="mb-8" method="get" action="{{ route('contacts.index') }}" >
	<input type="text" name="search" placeholder="検索">
	<button>検索する</button>
</form>
```
文字を入力するのでtypeはtext、placeholderには薄い字で表示される文字が入るので、ここには「検索」と入れておく。 
これだとボタンが少し寂しいので、create.blade.phpからボタンをクラスごと引っ張ってきてコピーする。 (flexとmx-autoは削除)

ContactFormController::index()
```
$search = $request->search; 
```
引数に'Request $request'を入れる。
このサーチの中には複数の単語が入ってくるので、単語それぞれに分けてWhere句にかける。

#### 検索フォーム その2（クエリのローカルスコープ）
FATコントローラーを防ぐために使う機能がクエリのローカルスコープ。 
マニュアルだと、Eloquent ORMのEloquentの準備というページを参照する。その中でローカルスコープを検索する
頭に"scope"という文字列をつけたメソッドで引数には"$query"を書いてあげて、"$query"を処理した値をリターンしてあげる。 

App/Models/ContactForm.phpに新しいスコープを作る。メソッド名の先頭にscope、第一引数は$query、第二引数には渡ってくる引数を入れる。 
```
public function scopeSearch($query, $search){
	if ($search !== null) { 
		$search_split = mb_convert_kana($search, 's'); //全角スペースを半角
		$$search_split2 = preg_split('/[\s]+/', $search_ansco_split );//空白で区切る
		foreach($search_split2 as $value){
			$query->where('name', 'like', '%'.$value.'%'); 
		} 
	}
	return $query; 
} 
```
mb_convert_kana, preg_sprit は PHP の関数
コードだけ読み取ると、whereをいくつもくっつけているという判定になるが、Laravel では where を重ねて書くと、それが AND 扱いになるのでOK。
上記のコードをfillableの下に貼り付ける。 

また、contactformcontroller.phpの中にあるindexメソッドの$searchの定義の下に
```
$query = ContactForm::search($search); 
```
を入れることで呼び出すことができる。 （正しいメソッド名はscopeSearchだが、このスコープの機能として頭の"スコープ"はカットした名前で呼び出す。 ）

検索した内容でページネーションの内容も変わってくるので、ページネーションを調節する。 
```
$contacts = $query->select('id', 'name', 'title', 'created_at')->paginate(20); 
```
とする。

最後に動作確認をする。 




