<?php

$redirect = false;
if (stripos($_SERVER["REQUEST_URI"], "/blog/post.cfm") > -1){
	$url_part = str_replace("/blog/post.cfm", "", $_SERVER["REQUEST_URI"]);
	$url = "http://blog.terrenceryan.dev" . $url_part;
} else {
	$url = "http://new.terrenceryan.dev/error/404.php";
}

header("Location: " . $url);

?>