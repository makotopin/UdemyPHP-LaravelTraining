## carbonをインストールする
``composer require nesbot/carbon``
上記のコマンドでcomposerにcarbonを入れる。

例えるのならば
- PHPは“舞台”
- Composerは“舞台監督”
- Laravelは“劇団”（演目一式）
- Carbonは“名脇役”
ということらしい。

つまるところ、Composerとは
- PHPのパッケージ管理ツール（依存関係マネージャ）
- 役割は「必要なライブラリを自動で取得し、バージョンを管理し、クラスを自動で読み込む」こと。
- **PHP本体には依存解決やバージョン固定の仕組みが無い**ため、それを補う存在。

主な機能は
- 依存関係の管理
  - composer.json に必要なライブラリを記述。
  - composer install で自動的に vendor/ に導入。
- バージョンの固定
  - 実際に導入されたバージョンは composer.lock に記録され、チームで環境が揃う。
- 自動オートロード
  - PSR-4規約に基づいて、クラスファイルを自動的に読み込む。
  - require 'vendor/autoload.php'; 一行で完了。
となる

carbonはそんなcomposerのライブラリの1つで、日付に関する機能を拡張してくれる。