【11/28】
PHPからLaravelまで サーバーサイドをとことんやってみよう
106. store保存
app/Http/Controllers/Auth/RegisteredUser.phpというファイルを確認してみる
このクラスのstore内の処理を参考にして、contactsのstoreも作成していく。

この処理の中身は以下
```
public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
```
上の方は 'キー' => 値 という関係になっている

保存処理を作成するにあたって、もう一箇所見ておかなければならない箇所がある
app/Models/User.php
中には'fillable'と書かれている部分がある。
ここに書いてあるカラムは一括でDBに追加することができる。

Userモデルの中の$fillableをContactForm.phpに貼り付ける
中身をcreate.blade.phpに合わせる

app/Http/Controllers/Auth/RegisteredUser.phpのstoreの$userの部分をまるっとコピーしてくる
そして、変数削除、Userで指定していたモデルをContactFormに入力していく。

処理の最後にリダイレクトを書く
```
return to_route('contacts.index');
```
to_routeはヘルパ関数

ここまでできたら、登録できるかどうかを試してみる。
PhpMyAdminにてデータの登録が確認できて、リダイレクトすればOK


