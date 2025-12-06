【11/20】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 98. ルーティング（グループ・認証）
ルーティングを一行ずつ書く書き方と、グループ化する書き方がある
```Route::resource('contacts', ContactFormController::class, ['index'])->name('contacts.index');```
この'name'を設定しておくと、view側で扱いやすくなる。

これを一行ずつやろうとすると
```Route::resource('contacts', ContactFormController::class, ['index'])->name('contacts.index');
Route::resource('contacts', ContactFormController::class, ['index'])->name('contacts.index');
Route::resource('contacts', ContactFormController::class, ['create'])->name('contacts.create');
Route::resource('contacts', ContactFormController::class, ['show'])->name('contacts.show');
Route::resource('contacts', ContactFormController::class, ['store'])->name('contacts.store');
Route::resource('contacts', ContactFormController::class, ['update'])->name('contacts.update');
Route::resource('contacts', ContactFormController::class, ['destroy'])->name('contacts.destroy');
```となる（show, update, destroyは正確には少し違うが省略。本来ならばid指定が必要になるはず。）

これでは見づらくなってしまうので、グループ化をしてすっきりと書けるようにする。
①ミドルウェアを設定するパターン
```Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // １番目と２番目のミドルウェアを使用
    });

    Route::get('/user/profile', function () {
        // １番目と２番目のミドルウェアを使用
    });
});```
※そもそも、ミドルウェアとは「関所」のようなもの。例えば、画面表示のために、HTTP通信がGETのURLを叩いたとしても、ログインしていなければ表示するわけにはいかない。
なので、その手前でauthミドルウェアを通るようにしておけばその中で「認証済んでる？」というのを確認してくれる。
他にも未ログインのユーザーを通す'guest'や、メール認証済みのみを通す'verified'などのミドルウェアがLaravelでは最初から用意されている。
これらのミドルウェアapp/Http/Karnel.phpに登録されている。
ちなみに、ミドルウェアを使用する時は```groupe(function (){})```とセットで使用するのが決まりであり、そうでないと文法的に誤り。
特定のコントローラーやルートに対してミドルウェアを通したい時は```Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth']);```という書き方が正解になる。


②コントローラを設定するパターン
```use App\Http\Controllers\OrderController;

Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});```
コントローラも同様。毎回コントローラー名を書かなくとも、このグループの中ではこのコントローラーを使うよという書き方になっている。


③プレフィックスを設定するパターン(URL)
```Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // /admin/usersのURLに一致
    });
});```

④プレフィックスを設定するパターン(name)
```Route::name('admin.')->group(function () {
    Route::get('/users', function () {
        // ルートに"admin.users"が名付けられる
    })->name('users');
});```

これらの書き方は重複させてもよい。今回は
```Route::prefix('contacts')->middleware(['auth']) // URLの頭の'contacts'が共通なのでまとめてすべてにつける + authミドルウェアを通す
->controller(ContactFormController::class) // ContactFormControllerクラスをまとめ、該当コントローラーの中のメソッドに限定
->name('contacts.') // URLだけでなく、nameに関しても、頭の'contacts.'はここでまとめてすべてにつける設定とする。
->group(function () { // グループ化することで、上記の設定を、グループ化した中身すべてに適用する。
    Route::get('/', 'index')->name('index'); URL省略＋コントローラ名省略＋name省略がかかっているので、これだけの情報でよい。
});```
とした。

本当にこれが動くのか確認する
ContactFormController.phpのindexを以下のように。
```    public function index()
    {
        return view('contacts.index');
    }```
かつ、views配下にcontacts/index.blade.phpを用意して、表示されるかを確認する。
なお、未ログイン状態でログイン画面に遷移するので、ちゃんとミドルウェアが効いているということになる。