<h1>確認画面</h1>

<h2>お届け先入力</h2><br>
@foreach($customer as $key => $value)
    {{ __("customer.$key") }}
    {{ $value }}<br>
@endforeach
<h2>購入内容</h2><br>
@foreach ($items as $item_id => $amount) 
            {{ __("product.name").$products->find($item_id)->name}}<br>
            {{ __("product.price").$products->find($item_id)->price}}<br>
            {{ __("product.amount").$amount}}<br>
@endforeach

<form action="/buy" method="POST">
    @csrf
    <input type="submit" value="注文を確定する"/>
</form>