
var val  = $("#notExist").length;
if(val == 1){
    var   myRandomNumber = setInterval(function(){ myTimer() }, 50);

}
else{
}

function myTimer() {
    var randNum = Math.floor((Math.random() * 6) + 1);

    document.getElementById("die1").innerHTML = randNum;
}

function myStopFunction() {
    clearInterval(myRandomNumber);
}

function rollDice(){
    var die1 = document.getElementById("die1");
    var labeledVal = document.getElementById("labeledValue");
    var d1 = Math.floor(Math.random() * 6) + 1;
    var diceTotal = d1;
    die1.innerHTML = d1;
    $("#dice_value_hidden").val(d1);
    var payoff = 2 * d1 + 10
    labeledVal.innerHTML =  "Your payoff: " + payoff;
   

    $('#btnRollDice').prop('disabled', true);
    myStopFunction();
    $("#part2-stage1-dicevalue").submit()
}

//beginInstructionModal();

function beginInstructionModal(){

    $("#stage1inst").modal("show")
        .find('#stage1inst')
        .load($(this).attr("value"));
}


$(window).load(function(){
});
