$(document).ready(function(){
		$('#submit').click(handleEmail);
});	

function handleEmail(){
	event.preventDefault();
	
	var name = $("#name").val();
	var mail = $("#email").val();
	var text = $("#text").val();

	var datastr ='name=' + name + '&email=' + mail + '&text=' + text;
	send(datastr);
	$("#submit").attr("disabled", "disabled");
	return false;
}


function send(datastr){
	$.ajax({
		type: "POST",
		url: "process.php",
		data: datastr,
		cache: false, 
		success: handleSuccess,
		failure: handleFailure
		});
}

function handleSuccess(e){
	$("#response").addClass("alert");
	$("#response").addClass("delay");
	$("#response").html("Your mail is on it's way.");
	setTimeout(makeAlertFade, 2000);
}
function makeAlertFade(){
	$("#response").addClass("alertclear");
}

function handleFailure(e){
	alert("failure.");
}