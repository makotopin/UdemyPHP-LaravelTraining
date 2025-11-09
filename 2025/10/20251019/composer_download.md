## 現状の構成
実際の作業フォルダ
/Users/yoshidamakoto/dev/UdemyPHP-LaravelTraining

MAMPの公開フォルダ
/Applications/MAMP/htdocs/UdemyPHP-LaravelTraining


## そもそものphpコマンドやPHPについての理解を深める
「PHPコマンドが使える」 ということと、「PHPが実際にWebサーバーで動いている」 というのは、実は別の話である。
### PHPコマンド
php コマンドは「コマンドラインで PHP を動かすための実行ファイル」。
つまり “人間がターミナルから手動で動かすPHP”。
なので、「php コマンドが割り当てられていない＝PATHが通っていない」と言える。

MAMPにはいくつかのバージョンのPHPが含まれていて、それぞれが実行ファイルではある。
ただ、それをCLIから呼び出すことができるのはphpコマンドが向いているものだけ。

### WebサーバーのPHP
MAMPを使用しているのであれば、それはMAMPのApachが指定しているPHPである。

つまり
- CLI（ターミナル）で動くPHP：phpコマンド（PATH依存）
- Apache（MAMP）で動くPHP：MAMPの設定ファイル依存
なので、**ターミナルでphpコマンドが通っていなくても、MAMP上ではPHPは普通に動く。**
つまり、別バージョンのPHPを同時に使うことができる。
（CLIとサーバーでも使えるし、サーバー同士…Apach vs nginxでも）


## composerって？
そもそもcomposerは「PHPでつくられたプログラム」である
composerの一行目には "#!/usr/bin/env php" と書かれている
これは**「このファイルを実行するときに、どのプログラムを使って実行するか」** を指定している。
つまり、「PHPを使う」と言っている
でも今回はphpコマンドが見つからないと言われてしまった。

