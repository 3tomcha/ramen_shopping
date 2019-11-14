<h1>お届け先入力</h1>
<form action="/confirm" method="POST">
    @csrf
    お届け先入力<br>
    名前<input type="text" name="name"/>
    郵便番号<input type="text" name="postalcode"/>
    都道府県コード<input type="text" name="prefecturecode"/>
    住所<input type="text" name="address"/>
    電話番号<input type="text" name="tel"/>
    メール<input type="text" name="mail"/>
    <input type="submit" value="購入確認"/>
</form>