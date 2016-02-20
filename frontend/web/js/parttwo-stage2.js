//beginInstructionModal();

function beginInstructionModal(){
    $("#stage2inst").modal("show")
        .find('#stage2inst')
        .load($(this).attr("value"));
}
