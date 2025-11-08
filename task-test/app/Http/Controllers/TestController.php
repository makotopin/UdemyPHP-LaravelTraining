<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        // Eloquant。コレクション型となる
        $values = Test::all();

        // countで取ったものはint型となる
        $count = Test::count();

        // findOrFailで取ったものはモデルのインスタンスとなる
        $first = Test::findOrFail(1);

        // whereで取ったものはBuilderオブジェクトとなる。query builderという
        $whereBBB = Test::where('text', 'bbb');
        // getをつけると、コレクション型となる
        // $whereBBB = Test::where('text', 'bbb')->get();


        // クエリビルダ
        $queryBuilder = DB::table('tests')->where('text', '=' ,'bbb')
        ->select('id', 'text')
        ->get();
        // getをつけないと、Builderオブジェクトとなる。クエリの途中の状態のようなイメージ。

        dd($values, $count, $first, $whereBBB, $queryBuilder);
        // dd($values); // デバッグ用。これで中身を確認できる。dd = die + dump

        return view('tests.test', compact('values'));
    }
}

// compactは、配列を作成するための関数。
// ここでは、$valuesを配列にして、viewに渡している。
// これで、viewで$valuesを使用できる。
// なお、compactは、変数名と配列のキーが一致するので、変数名を変えたい場合は、
// return view('tests.test', ['values' => $values]);のように書く。
