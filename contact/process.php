<?php

if (strlen($_POST['email']) < 1){
	throw new Exception('Mail Faiure');
	die("Email invalid");

}

if (strlen($_POST['text']) < 1){
	throw new Exception('Mail Faiure');
	die("Message missing");
}
 
include_once("../config/creds.php");
include_once("../modules/class.microakismet.inc.php");


$akismet	= new MicroAkismet( $akismet_key, "http://terrenceryan.com", $_SERVER["HTTP_USER_AGENT"] );
 
$mail = $_POST['email'];
$name = $_POST['name'];
$subject = "Email from terrenceryan.com";
$text = $_POST['text'];

foreach ( $_SERVER as $key => $val ) { $vars[ $key ] = $val; }

// Mandatory fields of information
$vars["user_ip"]           	= $_SERVER["REMOTE_ADDR"];
$vars["user_agent"]        	= $_SERVER["HTTP_USER_AGENT"];

// The body of the message to check, the name of the person who
// posted it, and their email address
$vars["comment_content"]   	= $text;
$vars["comment_author"]			= $name;
$vars["comment_author_email"]	= $mail;

set_error_handler("warning_handler", E_WARNING);
if ( $akismet->check( $vars ) ) {
    echo "SPAM!!!";
    die( "The message was spam!" );
}
else {
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
}

restore_error_handler();








function warning_handler($errno, $errstr) { 
    echo "Warning Caught";
}



 ?>