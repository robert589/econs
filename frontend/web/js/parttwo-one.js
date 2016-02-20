var timer;
function beginQuestion(){
	
	$('#clickToBegin').hide();
	$('#securityQuestion').show();

	startTimer();
}

function startTimer(){
	var i = 15;
	timer=	setInterval(function(){
			i--;
			$("#timerLabel").text(i + " Seconds");

			if(i == 0){
				$("#inputCGPA").prop('disabled', 'disabled');
				stopTimer();
			}
		},1000);
	
}

function stopTimer(){
	clearTimeout(timer);
}