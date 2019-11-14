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
        // 同じ番号で登録されているものをここで合算してみる
        $items = $request->session()->get('item');
        $sum = array();
        foreach ($items as $item) {
            foreach ($item as $key => $value) {
                // Noticeエラーが出てしまうので@をつける
                @$sum[$key] += $item[$key];
            }
        }

        // foreach ($sum as $item_id => $amount) {
        //     echo "商品IDは{$item_id}です。選択された合計数は{$amount}個です<br>";
        // }

        // これからデータベースに保存する処理を書いていく
        // dd($sum);
        // dd($request->session());

        // 次の画面でも使うのでsessionにsumの方も保存しておく
        $request->session()->put(
            'sum',
            $sum
        );

        return view('cart.index', ['sum' => $sum, 'products' => Product::all()]);
    }

    public function update(Request $request)
    {
        // dd($request->item_id);
        // まだデータベースでなく、sessionを用いて更新していく
        $sum = $request->session()->get('sum');
        $sum[$request->item_id] = $request->amount;

        $request->session()->put(
            'sum',
            $sum
        );

        return view('cart.index', ['sum' => $sum, 'products' => Product::all()]);
        // dd($sum);

        // Purchase::where('customer_id', )
        // $request->amount;
    }

    public function add(Request $request)
    {
        $sum = $request->session()->get('sum');
        // dd($sum);

        return view('buy', ['sum' => $sum]);
    }

    public function confirm(Request $request)
    {
        // 前画面で入力したお届け先と、商品の情報を表示する
        // 前画面で入力した情報はフォームから取得する必要がある
        $sum = $request->session()->get('sum');
        // dd($sum);

        return view('confirm', ['sum' => $sum]);
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

        $Customer = new Customer();
        $Customer->name = 'test';
        $Customer->postalcode = '3114145';
        $Customer->prefecturecode = 11;
        $Customer->address = '水戸市双葉台5-24 6-4-5';
        $Customer->tel = '0292518696';
        $Customer->mail = 'test@gmail.com';
        $Customer->save();

        // dd($Customer->id);

        $Product = new Product();

        // 送られてきた商品IDと個数をデータベースに保存していく
        $sum = $request->session()->get('sum');

        foreach ($sum as $item_id => $amount) {
            $Purchase = new Purchase();
            $Purchase->customer_id = $Customer->id;
            $Purchase->product_id = $item_id;
            $Purchase->number = $amount;
            $Purchase->save();
        }

        // あとは購入テーブルもあった方が良いかも
    }
}
