<?php
include_once 'module_common.php';

$count = 3;
$github_url = "https://api.github.com/users/tpryan/repos?sort=pushed";
$github_cache = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/projects.html";
$cache_age = 2 * 60 * 60;



if (isset($_GET['reset_cache']) && file_exists($github_cache)){
	unlink($github_cache);
}


if (shouldStillBeCached($github_cache, $cache_age)){
	$github_html = file_get_contents($github_cache);
}
else{
	try {
		$github_html = refreshGitHubHTML($github_url, $count,$github_cache);
	} catch (Exception $e) {
		$github_html = "<article><p>No current projects</p></article>";
		var_dump($e);
	}
}

echo $github_html;

function refreshGitHubHTML($github_url, $count, $github_cache){
	$github_content = get_content_from_github($github_url);
	$github_html = generateGithubHTML($github_content,$count);
	$cache_html = "<!-- From Cache --->" . $github_html;
	place_in_cache($github_cache, $cache_html);
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
	$content = url_get_contents($url);
	return json_decode($content, true);
}






