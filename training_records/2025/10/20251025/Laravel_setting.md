## Laravelの初期設定

Laravelは元々英語圏のソフトなので、日本の時間や言語に設定する
また、動作確認をする時のデバッグバーなども入れておく
また、データベースの設定もしておく。

config/app.php ファイルを設定する
以下、ファイル内の項目

【基本設定】
'name'	アプリケーション名。通知などで表示される。.env の APP_NAME で上書き可能。
'env'	環境設定。local / production / staging など。.env の APP_ENV に対応。
'debug'	デバッグモード。true なら詳細なエラーメッセージが表示される。APP_DEBUG に対応。
'url'	アプリの基底URL。ArtisanコマンドやURL生成時に使用される。APP_URL に対応。
'asset_url'	アセット（画像・CSSなど）のベースURL。ASSET_URL に対応。（そもそも、アセットというのはWebで配信する静的ファイルのこと。パフォーマンスの観点から、WebのURLとは区別されて設定されている。）

【地域・言語設定】
'timezone'	タイムゾーン。日時系関数の基準となる。例：Asia/Tokyo。
'locale'	デフォルトの言語設定。ここでは ja（日本語）。
'fallback_locale'	翻訳が存在しない場合の代替言語。通常は en。
'faker_locale'	Faker（ダミーデータ生成）用のロケール。電話番号や住所などの形式に影響。

【暗号化設定】
'key'	アプリの暗号化キー。.env の APP_KEY に設定される32文字のキー。
'cipher'	暗号化方式。デフォルトは AES-256-CBC。

【メンテナンス設定】
'maintenance'	メンテナンスモードの制御方式。file はローカルにフラグを書き込む、cache は複数サーバで共有可。

【その他】
'providers'
Laravelが起動時に読み込む「機能提供クラス」の一覧。
Laravel標準プロバイダ：認証、DB、キャッシュ、ルーティングなどの基盤機能。
アプリケーション独自のプロバイダ：App\Providers\... に定義された自作クラス。
AppServiceProvider：全体の初期設定。
AuthServiceProvider：認可ポリシー関連。
EventServiceProvider：イベントとリスナの登録。
RouteServiceProvider：ルーティング設定。

'aliases'
Facade 経由でクラスを短縮名で呼び出すための設定。
例）use Illuminate\Support\Facades\Route;　を　Route::get(...);
　　のように呼び出せるのは、この設定のおかげ。


## デバッグバー
``composer require barryvdh/laravel-debugbar:^3.7``
このコマンドでデバッグバーをインストールする
php系のインストールなので、composer.jsonにデバッグバーに関する記述が自動的に増える。

``php artisan serve``で確認する
