<h1>レジに進む前の確認＆更新ページ</h1>
@empty($sum)
    カートは空です
<a href="/">TOPに戻る</a>
@else
    @foreach ($sum as $item_id => $amount)
    {{$products->find($item_id)->name}}
    {{$products->find($item_id)->price}}円
    <form action="/cartitem/{{ $item_id}}" method="POST">
        @csrf
        個数の更新
        <input type="text" name="amount" value="{{$amount}}"/>
        <input type="hidden" name="item_id" value="{{$item_id}}"/>
        <input type="submit" value="更新"/>
    </form>
    <br>
    @endforeach
合計金額
<a href="/">TOPに戻る</a>
<a href="/buy">レジに進む</a>
@endempty