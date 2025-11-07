# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 85. Laravelとコレクション型

LaravelでDBから情報取得
1. Eloquent
2. クエリビルダ
本日はEloquentを使用

Eloquentはコレクション型
※コレクション型とは、配列を拡張した型。Laravelオリジナル。公式ドキュメントのコレクションの項目でも詳細を知ることができる。

Eloquentでall()やget()を利用してデータを取得すると**自動的に**コレクション型になる。
※getをつけないと、インスタンスだったりQueryBuilder状態になる

