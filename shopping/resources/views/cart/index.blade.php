<h1>レジに進む前の確認＆更新ページ</h1>
@foreach ($sum as $item_id => $amount)
{{$products->find($item_id)->name}}
{{"商品IDは{$item_id}です。選択された合計数は{$amount}個です"}}

<form action="/cartitem" method="POST">
    @csrf
    個数の更新
    <input type="text" name="amount" value="{{$amount}}"/>
    <input type="hidden" name="item_id" value="{{$item_id}}"/>
    <input type="submit" value="Submit"/>
</form>
<br>
@endforeach
<a href="/buy">レジに進む</a>