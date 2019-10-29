<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->session());

        return view('index');
    }

    public function cart(Request $request)
    {
        session([
            'item_id' => 2,
            'amount', 3,
            ]);
        // 送られたrequestをsessionに保存する処理
        // session([
        //     'item_id' => $request->item_id,
        //     'amount', $request->amount,
        //     ]);

        return redirect('/');
    }
}
