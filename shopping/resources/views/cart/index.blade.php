@foreach ($sum as $item_id => $amount)
{{"商品IDは{$item_id}です。選択された合計数は{$amount}個です"}}
<br>
@endforeach
<a href="/buy">レジに進む</a>