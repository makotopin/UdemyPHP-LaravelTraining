【11/5】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 83. MVCモデルの記述方法2

コントローラ→モデル→ビューで表示してみる
①コントローラにて、使用するモデルの情報を書き込む
``use App\Models\Test;``

②コントローラーに処理を書く
```    public function index()
    {
        $values = Test::all();

        // dd($values); // デバッグ用。これで中身を確認できる。dd = die + dump

        return view('tests.test', compact('values'));
    }```
③ビューに表示用のコードを書く
```@foreach ($values as $value)
    <p>{{ $value->id }}</p>
    <p>{{ $value->text }}</p>
@endforeach```