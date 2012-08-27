<?php

$redirect = false;
if (stripos($_SERVER["REQUEST_URI"], "/blog/post.cfm") > -1){
	$url_part = str_replace("/blog/post.cfm", "", $_SERVER["REQUEST_URI"]);
	$url = "http://blog.terrenceryan.dev" . $url_part;
} else if (stripos($_SERVER["REQUEST_URI"], "/blog/archives.cfm/date") > -1){
	$url_part = str_replace("/blog/archives.cfm/date", "", $_SERVER["REQUEST_URI"]);
	$url = "http://blog.terrenceryan.dev" . $url_part;
} else if (stripos($_SERVER["REQUEST_URI"], "/blog/archives.cfm/category") > -1){
	$url_part = str_replace("/blog/archives.cfm/category", "", $_SERVER["REQUEST_URI"]);
	$url = "http://blog.terrenceryan.dev/tag" . $url_part;
}
else {
	$url = "http://new.terrenceryan.dev/error/404.php";
}

header("Location: " . $url);

?>