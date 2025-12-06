【11/8】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 85. Laravelとコレクション型

DBから情報を引っ張ってくる方法②
Select, where, groupBy, orderByなどSQLに近い構文で書く
SQLインジェクションに注意する必要はあるが、生のSQLを書くことも可能

使い方
1. DBファサードを読み込む
```use illuminate\Support\Facades\DB```
2. 以下のように書く
```        // クエリビルダ
        $query_test = DB::table('tests')->where('text', '=' ,'bbb')
        ->select('text')
        ->get();```
ポイントはgetでデータを取得・確定させること。
3. 表示される
なお、前回Eloquentで表示したものは、ddで表示すると
```Illuminate\Database\Eloquent\Collection```というパスになるのだが、今回のクエリビルダだと```Illuminate\Support\Collection```となり、同じコレクション型でも、少々パスが異なる
使用できる昨日などが少々出てくる

### エロクアント VS クエリビルダ
速度はクエリビルダの方が若干速いが、エロクアントの方がメリットが大きいので一般的である。
エロクアントだとリレーション（複数テーブルの連携）やスコープ（クエリの分割）などの機能を使うことができる。