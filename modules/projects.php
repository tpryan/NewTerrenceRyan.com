<?php
include_once 'module_common.php';

$count = 3;
$github_url = "https://api.github.com/users/tpryan/repos";
$github_cache = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/projects.html";
$cache_age = 2 * 60 * 60;

//$github_content = get_content_from_github($github_url);
//$github_content = sort_github_results($github_content);


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
		//var_dump($e);
	}
}

echo $github_html;

function refreshGitHubHTML($github_url, $count, $github_cache){
	$github_content = get_content_from_github($github_url);
	$github_content = sort_github_results($github_content);
	$github_html = generateGithubHTML($github_content,$count);
	$cache_html = "<!-- From Cache --->" . $github_html;
	file_put_contents($github_cache, $cache_html);
	return $github_html;
}


function generateGithubHTML($github_content, $count){
	$result = "";
	$result .=  "<!-- pulled in from github -->" ."\n";
	for ($i=0; $i<$count; $i++){
		$item = "";
		$item .= '			<article>' . "\n";
		$item .= '				<h1>';
		$item .= '<a href="' . $github_content[$i]['html_url'] . '">';
		$item .= $github_content[$i]['name'];
		$item .= '</a>';
		$item .= '</h1>' . "\n";
		$item .= '				<p>';
		$item .= $github_content[$i]['description'];
		$item .= '</p>' . "\n";
		$item .= '			</article>' . "\n";
		$result .= $item;
	}
	return $result;
}


function sort_github_results($github_content){
	$dates = array();
	foreach ($github_content as $key => $row)
	{
	    $dates[$key] = $row['pushed_at'];
	}
	array_multisort($dates, SORT_DESC, $github_content);
	return $github_content;
}


function get_content_from_github($url) {
	$content = file_get_contents($url);
	return json_decode($content, true);
}






