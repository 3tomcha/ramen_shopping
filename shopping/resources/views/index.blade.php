<form method='POST' action='/'>
    @csrf
    <p>商品IDは2番の品物</p>
    <select name="amount">
        <option>1</option>
        <option>2</option>
        <option>3</option>
    </select>
    <input type="hidden" name="item_id" value="2"/>
    <input type="submit" value="カートに入れる"/>
</form>