## Laravelのデータベース設定

MAMPを使用しているという前提
phpMyAdminから、新しくDBとユーザーを作成する

DB名：laravel_task
ユーザー：laravel_user
PASS：password123

また、.envにも追記をし、接続を確認する必要がある。

1. DB作成
MAMP>WebStart でMAMPのページを表示
toolsのphpMyAdminを選択
データベースタブを選択し、新規作成にて作る

照合順序はそのまま標準のUTF-8系のものでOK
文字コード＋照合順序で成り立っている。
※なお、照合順序は文字通り「どういった順番でDB内を照合していくか？」のルールのこと
　MySQL 8 系なら、`utf8mb4_0900_ai_ci` がバランス◎（国際化の精度と速度の折衷が良い）とのこと。
　
2. ユーザー作成
画面上部「権限」タブで、ユーザーを追加する
ホスト名：%
※ホスト名は本来は％だと危険。というのも、DBというのは「ユーザー名」＋「ホスト名（つまり、どこからアクセスしているのか？のIPアドレス）」でユーザーを判定している。
この辺りのDB接続周りはまた追々学習していく。
「すべての権限を与える」にチェックが入っている事を確認する。
他はいじらなくてOK

3. .envファイルの編集
DB_DATABASE=laravel, DB_USERNAME=root, DB_PASSWORD=
を
DB_DATABASE=laravel_task, DB_USERNAME=laravel_user, DB_PASSWORD=password123
に変更する。

4. 接続確認
``php artisan migrate``コマンドを流す。
MAMPのphpMyAdmin内でテーブルができていることを確認する。


## 実際に動かしてみた
なぜか弾かれてしまった
1. PASSの確認
ユーザーのPASSと.envに設定されているPASSを確認
ついでにDBの名前やユーザー名、ユーザーの権限も確認したがダメ

2. DBの存在確認
現在向いているDBを調べると、過去にインストールした古いDBの方を向いていた
```which mysql
mysql --version```

これで現在のDBを確認すると
```/usr/local/opt/mysql@5.6/bin/mysql
zsh: no such file or directory: /Applications/MAMP/Library/bin/mysql```
という結果に…。

3. MAMPのDBをPASSを設定
```echo 'export PATH="/Applications/MAMP/Library/bin/mysql80/bin:$PATH"' >> ~/.zshrc```を入力して、DBの向き先を再設定。

4. .envファイルのポート指定を変更
3306に設定されていたが、これを8889に設定。
というのも、一般的にMySQLのポートは3306なのだが、MAMPでは8889を使用しているため

ホスト名で設定した％は、たしかに「全て許可」なのだが、これは
アクセスされる側であるDBが「どこからの接続でも許可する」という意味。

今回の.envファイルに関しては、Laravel側が「どこにアクセスするか」なので、全然話が違う。
