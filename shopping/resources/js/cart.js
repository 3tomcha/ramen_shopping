window.onload = function() {
const prices = document.getElementsByClassName("price");
const amounts = document.getElementsByName("amount");
const total_amount = document.getElementById("total-amount");

console.log(total_amount);

const length = prices.length;
let result = 0;
for(let i=0; i<length; i++){
  result += prices[i].textContent * amounts[i].value; 
} 
  total_amount.textContent = result;
};