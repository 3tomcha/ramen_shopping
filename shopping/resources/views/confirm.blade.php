確認画面

お届け先入力<br>

購入内容<br>
@foreach ($sum as $item_id => $amount) 
            {{"商品IDは{$item_id}です。選択された合計数は{$amount}個です"}}
@endforeach

<form action="/buy" method="POST">
    @csrf
    <input type="submit" value="注文を確定する"/>
</form>