<?php

if (strlen($_POST['email']) < 1){
	throw new Exception('Mail Faiure');
	die("Email invalid");

}

if (strlen($_POST['text']) < 1){
	throw new Exception('Mail Faiure');
	die("Message missing");
}
 
 

$mail = $_POST['email'];
$name = $_POST['name'];
$subject = "Email from terrenceryan.com";
$text = $_POST['text'];
$to = "terrence.p.ryan@gmail.com";
$message =" You received  a mail from ".$name ."<" .$mail .">" .  "\n";
$message .= $text;
	if(mail($to, $subject,$message)){
		echo "Success";
	}
	else{
		echo "Failure";
		throw new Exception('Mail Faiure');
	}


 ?>