<?php

$github_url = "https://api.github.com/users/tpryan/repos";


$github_content = get_content_from_github($github_url);
echo $github_content;
echo $github_url;

function get_content_from_github($url) {
	$content = file_get_contents($url) or die();
	return $content;
}







