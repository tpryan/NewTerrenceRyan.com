<?php
	$error404 = "/error/error404.php";
	$error404Content = file_get_contents("http://" . $_SERVER['HTTP_HOST'] . $error404);

	$static_message = "<!-- Compiled by the server -->";
	file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/error/error404.html", $error404Content . $static_message);

?>