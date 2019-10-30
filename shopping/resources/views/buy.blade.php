お届け先入力<br>

購入内容<br>
@foreach ($sum as $item_id => $amount) 
            {{"商品IDは{$item_id}です。選択された合計数は{$amount}個です"}}
@endforeach

<form action="/confirm" method="POST">
    @csrf
    <input type="submit" value="購入確認"/>
</form>