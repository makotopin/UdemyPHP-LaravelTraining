【11/9】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 87. Laravelファサード

Facades…フランス語で「正面窓口」という意味
複雑な関連を持つクラス群を簡単に利用するための窓口を用意する。ということ。
これをFacadeパターンという。
中身をあまり考えずとも、窓口をしっかりつければOKになる。

よく使うもの
- Auth
- DB
- File
- Gate
- Hash
- Log
- Mail
- Route
- Storage
など

Facadeの設定は config>app.php に書かれている。
下の方に'aliases'があるので、そこにFacadesというファサードがある。
自分でオリジナルのファサードを作ることもできる。
すでに登録されているファサードに関しては Illuminate\Support\Facades\Facade にて確認可能
今回はComposer経由でLaravelをインストールしているので（というか、Laravelを使用する時点で100%Composer経由）
vendor>laravel>framework>src>Illuminate>Support>Facades>にある。
※'src'は「ソース」
そのファイルの内部に
```public static function defaultAliases()
    {
        return collect([
            'App' => App::class,
            'Arr' => Arr::class,
            'Artisan' => Artisan::class,
            'Auth' => Auth::class,
            'Blade' => Blade::class,
            'Broadcast' => Broadcast::class,
            'Bus' => Bus::class,
            'Cache' => Cache::class,
            'Config' => Config::class,
            'Cookie' => Cookie::class,
            'Crypt' => Crypt::class,
            'Date' => Date::class,
            'DB' => DB::class,
            'Eloquent' => Model::class,
            'Event' => Event::class,
            'File' => File::class,
            'Gate' => Gate::class,
            'Hash' => Hash::class,
            'Http' => Http::class,
            'Js' => Js::class,
            'Lang' => Lang::class,
            'Log' => Log::class,
            'Mail' => Mail::class,
            'Notification' => Notification::class,
            'Password' => Password::class,
            'Queue' => Queue::class,
            'RateLimiter' => RateLimiter::class,
            'Redirect' => Redirect::class,
            'Request' => Request::class,
            'Response' => Response::class,
            'Route' => Route::class,
            'Schema' => Schema::class,
            'Session' => Session::class,
            'Storage' => Storage::class,
            'Str' => Str::class,
            'URL' => URL::class,
            'Validator' => Validator::class,
            'View' => View::class,
            'Vite' => Vite::class,
        ]);
    }```がある。

これを
```    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
    ])->toArray(),```として配列で返している