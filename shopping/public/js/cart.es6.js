window.onload = function () {
  var prices = document.getElementsByClassName("price");
  var amounts = document.getElementsByName("amount");
  var total_amount = document.getElementById("total-amount");
  console.log(total_amount);
  var length = prices.length;
  var result = 0;

  for (var i = 0; i < length; i++) {
    result += prices[i].textContent * amounts[i].value;
  }

  total_amount.textContent = result;
};
