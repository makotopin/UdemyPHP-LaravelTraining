【11/13】
# PHP
## 91. Laravel認証
### Laravel Breeze
認証ライブラリのこと。CSSがTailwindcssになった。
このBreezeをインストールすると
- ログイン
- ユーザー登録
- パスワードリセット
- メール検証
- パスワード確認
等の機能が使える
⇒簡単に認証機能が使える。

公式ドキュメントの、利用開始>スターターキットからBreezeのインストールができる
vue, react, bladeによってインストール方法が変わる。
こちらもcomposerでインストールする。
``composer require laravel/breeze:^1.13 --dev``
でインストールする。

追加されたBreezeのバージョン情報はcomposer.jsonに記録される
その後``php artisan breeze:install``にて必要なファイルを作成する。
するとpackage.jsonにも入る。また、初回インストール時にはviteも動き出している。
なお、以下のファイルへの追記・以下のファイルの追加が発生する。
【追記】
- composer.json
- App\Models\User.php
- resources/css/app.css
- resources/js/app.js
【追加】
- App/View/Components
- resources/view/auth
- resources/view/components
- resources/view/layouts
- resources/view/dashboard.blade.php
これらのファイルの中身の変更は確認すること

これまではphp（バックエンド）側の簡易サーバーだけを``php artisan serve``で起動していたが、フロントエンド側の簡易サーバーも起動させる必要がある。
その際は``npm run dev``にて起動。
``npm run build``を叩くと本番用にビルドをしてくれる。
コマンドを叩くと、public/build/assetsの中にコンパイルされたコードが格納される。
なお、この"dev"と"build"に関してpackage.json内の"scripts"の中で設定されている。


