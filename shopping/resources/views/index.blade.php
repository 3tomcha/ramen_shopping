<h1>TOPページ</h1>
<div class="alert alert-success">
{{ session('status') }}
</div>
<a href="/cartitem">カートへ</a>
@foreach($products as $product)
<form method='POST' action='/'>
    @csrf
    <p>{{ $product->name }}</p>
    <p>{{ $product->price }}円</p>
    <select name="amount">
        <option>1</option>
        <option>2</option>
        <option>3</option>
    </select>
    <input type="hidden" name="item_id" value="{{ $product->id }}"/>
    <input type="submit" value="カートに入れる"/>
</form>
@endforeach
