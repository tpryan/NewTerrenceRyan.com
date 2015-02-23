/*jslint undef: true, sloppy: true */
/*global $: true */

function changeMessage(message) {
	$("#response").addClass("alert");
	$("#response").html(message);
}

function makeAlertFade(){
	$("#response").addClass("delay");
	$("#response").addClass("alertclear");
}

function handleSuccess(e) {
	changeMessage("Your mail is on it's way.");
	setTimeout(makeAlertFade, 2000);
}

function handleFailure(e){
	alert("failure.");
}

function send(datastr){
	$.ajax({
		type: "POST",
		url: "/contact/process.php",
		data: datastr,
		cache: false,
		success: handleSuccess,
		failure: handleFailure
		});
}

function handleEmail(){
	event.preventDefault();
	
	var name = $("#name").val();
	var mail = $("#email").val();
	var text = $("#text").val();

	if (name.length < 1) {
		$("#response").addClass("alert");
		changeMessage("Your name is required.");
		return false;
	}
	if (mail.length < 1) {
		$("#response").addClass("alert");
		changeMessage("Your email is required.");
		return false;
	}
	if (text.length < 1) {
		$("#response").addClass("alert");
		changeMessage("You gotta say something.");
		return false;
	}

	var datastr ='name=' + name + '&email=' + mail + '&text=' + text;
	send(datastr);
	$("#submit").attr("disabled", "disabled");
	return false;
}

$(document).ready(function(){
		$('#submit').click(handleEmail);
});
