var enabled_5 = $("#relationform-enabled_5").val();
var enabled_6 = $("#relationform-enabled_6").val();
var enabled_7 = $("#relationform-enabled_7").val();
var enabled_8 = $("#relationform-enabled_8").val();
var enabled_9 = $("#relationform-enabled_9").val();

var enaArray = new Array(5);
enaArray[0] =  (enabled_5 == 1)? 1 : 0;
enaArray[1] = (enabled_6 == 1) ? 1 : 0;
enaArray[2] = (enabled_7 == 1)? 1 : 0;
enaArray[3] = (enabled_8 == 1)? 1 : 0;
enaArray[4] = (enabled_9 == 1)? 1 : 0;

if(!enaArray[0]){
	$("#r_5").hide();
}
if(!enaArray[1]){
	$("#r_6").hide();
}
if(!enaArray[2]){
	$("#r_7").hide();
}
if(!enaArray[3]){
	$("#r_8").hide();
}
if(!enaArray[4]){
	$("#r_9").hide();
}

function addRow(){
	//check which one can be enabled


	var indexToEnable = checkEnable();

	if(indexToEnable != -1){
		$("#relationform-enabled_" + indexToEnable).val(1);
		enaArray[indexToEnable - 5] = 1;
		$("#r_" + indexToEnable).show();
	}
}

function checkEnable(){
	if(enaArray[0] == 0 ){
		return 5;
	}
	else if(enaArray[1] == 0){
		return 6;
	}
	else if(enaArray[2] == 0){
		return 7;
	}
	else if(enaArray[3] == 0){
		return 8;
	}
	else if(enaArray[4] == 0){
		return 9;
	}
	else{
		return -1;
	}

}

function remove_5(){
	$("#relationform-enabled_5").val(0);

	enaArray[0] = 0;
	$("#r_5").hide();

}

function remove_6(){
	$("#relationform-enabled_6").val(0);

	enaArray[1] = 0;
	$("#r_6").hide();

}

function remove_7(){
	$("#relationform-enabled_7").val(0);

	enaArray[2] = 0;
	$("#r_7").hide();

}

function remove_8(){
	$("#relationform-enabled_8").val(0);
	enaArray[3] = 0;
	$("#r_8").hide();

}

function remove_9(){
	$("#relationform-enabled_9").val(0);

	enaArray[4] = 0;
	$("#r_9").hide();

}