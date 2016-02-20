/*
 $(window).load(function(){
 beginInstructionModal();
 });
 */

$(document).ready(function(){

	//initialization
	//check value of work_part_time
	checkWorkPartTime();

	initializeHobbies();

	initializeUserHall();
});

function initializeHobbies(){

	if($('#partone1form-hobbies').find(":selected").val() == 'Others'){
		$("#otherHobbies").prop("disabled" , false);
	}
	else{
		$("#otherHobbies").prop("disabled" , true);
		$("#otherHobbies").val(null);

	}

}

function initializeUserHall(){
	if($('#partone1form-user_hall').find(":selected").val() == 1){
		$("#partone1form-hall_number").prop("disabled" , false);
	}
	else{

		$("#partone1form-hall_number").prop("disabled" , true);
		$("#partone1form-hall_number").val(null);

	}
}

//initializae work part time value
function checkWorkPartTime(){
	if($('#partone1form-work_part_time').find(":selected").val() == 1){
		$("#hour_week").prop("disabled" , false);
		$("#part_time_rate").prop("disabled" , false);
	}
	else{

		$("#hour_week").prop("disabled" , true);
		$("#part_time_rate").prop("disabled" , true);
		$("#hour_week").val(null);
		$("#part_time_rate").val(null);

	}
}


//initialize work part time radio function
function workPartTimeOnClick(){
	$("#work_part_time_yes").click(function(){

		workPartTimeYesClicked();

	});


	$("#work_part_time_no").click(function(){
		workPartTimeNoClicked();


	});
}

function workPartTimeYesClicked(){
//	console.log("chec");

	//enable hour_week and part_time_rate
	$("#hour_week").prop('disabled' , false);
	$("#part_time_rate").prop('disabled' , false);

	//make required hour_week and part_time_rate
	$("#hour_week").prop('required' , true);
	$("#part_time_rate").prop('required' , true);

	//set hidden value of work_part_time
	$("#work_part_time").val(1);
}

function workPartTimeNoClicked(){
//	console.log("chec");

	//disable hour_week and part_time_rate
	$("#hour_week").prop('disabled' , true);
	$("#part_time_rate").prop('disabled' , true);

	//Set it to null
	$("#hour_week").val(null);
	$("#part_time_rate").val(null);

	//make required hour_week and part_time_rate

	$("#hour_week").prop('required' , false);
	$("#part_time_rate").prop('required' , false);

	//set hidden value of work_part_time
	$("#work_part_time").val(0);

}