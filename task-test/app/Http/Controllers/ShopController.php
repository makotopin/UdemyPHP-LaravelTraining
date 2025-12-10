<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Shop;
use App\Models\Route;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Area::find(1)->shops;
        //dd($shops);

        $area = Shop::find(3)->area;
        //dd($area);

        $route = Shop::find(1)->routes()->get();
        dd($route);
    }
}
