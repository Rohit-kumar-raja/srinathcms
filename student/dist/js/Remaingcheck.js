function checkRemaining(amount) {
    // console.log(amount);
    var totalRemainingValue = document.getElementById('remaininga').value
console.log(totalRemainingValue)
    var remaining = totalRemainingValue - amount;
    // console.log(remaining)
    if(amount>=0 && remaining>=0){
    document.getElementById('remaining_amount').value = remaining;
    document.getElementById('amount').value = amount+'.00';
    }
}
// somthing is changed 
