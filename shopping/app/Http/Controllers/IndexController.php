<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        dump($request->session('items'));
        // 商品名のデータベースから取得していく
        $products = Product::all();

        return view('index', ['products' => $products]);
    }

    public function cart(Request $request)
    {
        // 送られたrequestをsessionに保存する処理
        $items = session('items');

        // ここでもう計算してしまう。重複してカートに追加した場合その数分増えていく
        // dd($items);
        $amount = (isset($items[$request->input('item_id')])) ? $items[$request->input('item_id')] : 0;
        $items[$request->input('item_id')] = $amount + $request->input('amount');
        session(['items' => $items]);

        return redirect('/')->with('status', 'カートに追加しました');
    }
}
