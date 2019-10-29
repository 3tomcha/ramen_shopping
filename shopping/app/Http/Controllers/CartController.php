<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        foreach ($sum as $item_id => $amount) {
            echo "商品IDは{$item_id}です。選択された合計数は{$amount}個です<br>";
        }

        // これからデータベースに保存する処理を書いていく
        dd($sum);
        dd($request->session());
    }
}
