<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // 商品名のデータベースから取得していく
        $products = Product::all();

        return view('index', ['products' => $products]);
    }

    public function cart(Request $request)
    {
        // 送られたrequestをsessionに保存する処理
        $request->session()->push(
            'item',
            [$request->item_id => $request->amount]
        );

        // session(['item' => [
        //     $request->item_id => $request->amount,
        //     ]]);

        return redirect('/')->with('status', 'カートに追加しました');
    }
}
