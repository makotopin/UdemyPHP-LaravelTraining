<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        $values = Test::all();

        // dd($values); // デバッグ用。これで中身を確認できる。dd = die + dump

        return view('tests.test', compact('values'));
    }
}

// compactは、配列を作成するための関数。
// ここでは、$valuesを配列にして、viewに渡している。
// これで、viewで$valuesを使用できる。
// なお、compactは、変数名と配列のキーが一致するので、変数名を変えたい場合は、
// return view('tests.test', ['values' => $values]);のように書く。
