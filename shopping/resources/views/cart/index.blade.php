<h1>レジに進む前の確認＆更新ページ</h1>
@empty($items)
    カートは空です
<a href="/">TOPに戻る</a>
@else
    @foreach ($items as $item_id => $amount)
    {{$products->find($item_id)->name}}
    <p><span class="price">{{$products->find($item_id)->price}}</span>円</p>
    <form action="/cartitem" method="POST">
        @csrf
        個数の更新
        <input type="text" name="amount" value="{{$amount}}" id="amount_{{ $item_id }}"/>
        <input type="hidden" name="item_id" value="{{$item_id}}"/><br>
        @method('PUT')
        <input type="submit" value="更新"/>
    </form>
    
    <form action="/cartitem" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{$item_id}}"/>
        @method('DELETE')
        <input type="submit" value="削除"/>
    </form>
    <br>
    @endforeach
合計金額<p id="total-amount"></p>
<a href="/">TOPに戻る</a>
<a href="/buy">レジに進む</a>
@endempty
<script src="js/cart.es6.js" ></script>