<?php

$count = 3;
$github_url = "https://api.github.com/users/tpryan/repos";


$github_content = get_content_from_github($github_url);
$github_content = sort_github_results($github_content);




echo "<!-- pulled in from github -->" ."\n";
for ($i=0; $i<$count; $i++){
	echo '			<article>' . "\n";
	echo '				<h1>';
	echo '<a href="' . $github_content[$i]['url'] . '">';
	echo $github_content[$i]['name'];
	echo '</a>';
	echo '</h1>' . "\n";
	echo '				<p>';
	echo $github_content[$i]['description'];
	echo '</p>' . "\n";
	echo '			</article>' . "\n";
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






