<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Purchase;
use App\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->session()->get('items');

        return view('cart.index', ['items' => $items, 'products' => Product::all()]);
    }

    public function update(Request $request)
    {
        // まだデータベースでなく、sessionを用いて更新していく
        $items = $request->session()->get('items');

        if (array_key_exists($request->item_id, $items)) {
            $items[$request->item_id] = $request->amount;
        }
        // dd($items);

        $request->session()->put(
            'items',
            $items
        );
        // dd($request->session());

        return redirect('/cartitem');
    }

    public function destroy(Request $request)
    {
        // まだデータベースでなく、sessionを用いて更新していく
        $items = $request->session()->get('items');

        if (array_key_exists($request->item_id, $items)) {
            unset($items[$request->item_id]);
        }
        // dd($items);

        $request->session()->put(
            'items',
            $items
        );
        // dd($request->session());

        return redirect('/cartitem');
    }

    // お届け先入力ページ
    public function add(Request $request)
    {
        return view('buy');
    }

    public function confirm(Request $request)
    {
        // 前画面で入力したお届け先と、商品の情報を表示する

        $customer = $request->all();
        unset($customer['_token']);
        // dd($customer);

        // 次のbuyメソッドで使えるようにセッションに保存しておく
        $request->session()->put(
            'customer',
            $customer
        );
        // 前画面で入力した情報はフォームから取得する必要がある
        $items = $request->session()->get('items');
        // dd($items);

        return view('confirm', ['items' => $items, 'customer' => $customer, 'products' => Product::all()]);
    }

    public function buy(Request $request)
    {
        // ここで初めてデータベース保存する
        // 保存する内容は、住所などの顧客情報と、商品IDと買った個数
        // 住所などの顧客情報と、商品IDと買った個数は別テーブルに保存し、連携させたい

        // 住所などの顧客情報：Customersテーブル
        // 商品情報：Productsテーブル(これはこの操作とは関係なく事前にデータが保存されている)

        // ひとまず仮のデータを入れてみると0から始まる数字問題が現れる
        // 保存するときはハイフンありなしや、trimの必要性がありそう

        // 全部保存すると重複しそう。検索してもうあるなら保存しないとか
        // そもそもログインしている場合は、もう入力する必要ないか？
        // そこらへんは仕様を詰める必要がある
        // リロードへの対策も必要か？

        $temp_customer = $request->session()->get('customer');

        $customer = new Customer();
        $customer->fill($temp_customer);
        $customer->save();

        // dd($Customer->id);

        $Product = new Product();

        // 送られてきた商品IDと個数をデータベースに保存していく
        $items = $request->session()->get('items');

        foreach ($items as $item_id => $amount) {
            $Purchase = new Purchase();
            $Purchase->customer_id = $customer->id;
            $Purchase->product_id = $item_id;
            $Purchase->number = $amount;
            $Purchase->save();
        }
        // 購入が完了したので、セッションを削除する
        $request->session()->forget('items');

        return view('end');
    }
}
