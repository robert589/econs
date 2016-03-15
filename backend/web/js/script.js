$("#send_all_button").click(function(e){
    console.log("hello");
    krajeeDialog.confirm("Are you sure you want to proceed?", function (result) {
        if (result) {
            $("#send_all_form").submit();
            return false;
        }
    });
});