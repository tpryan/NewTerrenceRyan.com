<?php
include_once 'module_common.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';

$github_url = "https://api.github.com/users/tpryan/repos?sort=pushed";
$cache_name = $app_name . "_github";
$count = 3;
$cache_age = 2 * 60 * 60;

$contentCreationStore = $github_url;
$contentCreationFunction = function ($github_url, $count){return refreshGitHubHTML($github_url, $count);};

$content_html = getFromCacheOrCreate($memcache, $cache_name, $cache_age, $contentCreationFunction, $contentCreationStore, $count);

echo $content_html;




function refreshGitHubHTML($github_url, $count){
	$github_content = get_content_from_github($github_url);
	$github_html = generateGithubHTML($github_content,$count);
	return $github_html;
}

function generateGithubHTML($github_content, $count){
	date_default_timezone_set('America/New_York');
	$result = "";
	$result .=  "<!-- pulled in from github -->" ."\n";
	for ($i=0; $i<$count; $i++){
		$raw_date = strtotime($github_content[$i]['pushed_at']);
		$date_string = date("F j, Y", $raw_date);
		$item = "";
		$item .= '			<article>' . "\n";
		$item .= '				<h1>';
		$item .= '<a href="' . $github_content[$i]['html_url'] . '">';
		$item .= $github_content[$i]['name'];
		$item .= '</a>';
		$item .= '</h1>' . "\n";
		$item .= '			<time datetime="' . date("Y-m-d", $raw_date) .'">';
		$item .= $date_string;
		$item .= '</time>' . "\n";
		$item .= '				<p>';
		$item .= $github_content[$i]['description'];
		$item .= '</p>' . "\n";
		$item .= '			</article>' . "\n";
		$result .= $item;
	}
	return $result;
}


function get_content_from_github($url) {
	broadcast($url);
	$content = url_get_contents($url);
	return json_decode($content, true);
}






