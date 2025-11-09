## composerのセットアップ
### 設定ファイルの作成
作成したいディレクトリの配下で``composer init``コマンドでcomposerに関する設定ファイルを作成する。
様々な設定について聞かれるが、ひとまずはEnterキーを押していればOK

composerの設定ファイルはcomposer.jsonというファイル
{}の中にキーと値がセットされている連想配列の形で表現されている

## オートロードができるように書き換える

```{
  "autoload":{
    "psr-4": {
      "App\\" : "app/"
    }
  }
}```

Appから始まる名前空間のファイルをオートロードする
その後、ターミナルから``composer install``と入力
→venderフォルダが作成される。

このvenderフォルダ内に色々入っている
vender>autoload.phpや
vender>composer>autoload_...
といったファイルが入っている

これはcomposer.jsonで設定した内容にしたがって、venderフォルダの中が変わるため
なので、composer.jsonを編集した後には``composer update``や``composer dump-autoload``コマンドで再度venderファイルの中身が変わる。
なお、composer updateは依存関係の更新なので、オートロード反映だけならdump-autoloadで十分