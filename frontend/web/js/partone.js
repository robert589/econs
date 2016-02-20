//beginInstructionModal();

function beginInstructionModal(){
    $("#partone-inst").modal("show")
        .find('#partone-inst')
        .load($(this).attr("value"));
}

