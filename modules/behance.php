<?php
include_once 'module_common.php';
flush();
$count = 1;

$behance = array(
	    'base' => "http://www.behance.net/v2/",
	    'user' => "tpryan",
	    'key' => "lVyYO1uqnBR27R8IkVJkwvDOWKz9qvSm"
	);

$cache_dir = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/";
$service_cache = $cache_dir . "behance.html";
$cache_age = 2 * 60 * 60;



if (isset($_GET['reset_cache']) && file_exists($service_cache)){
	unlink($service_cache);
}


if (shouldStillBeCached($service_cache, $cache_age)){
	$service_html = file_get_contents($service_cache);
}
else{
	try {
		$service_html = refreshServiceHTML($behance,  $count, $service_cache, $cache_dir);
	} catch (Exception $e) {
		$service_html = "<article><p>No current projects</p></article>";
		var_dump($e);
	}
}


echo $service_html;



function refreshServiceHTML($behance, $count, $service_cache, $cache_dir){
	$service_content = get_wips($behance);
	$service_html = generateBehanceHTML($service_content, $count);
	$cache_html = "<!-- From Cache -->" . $service_html;
	file_put_contents($service_cache, $cache_html);
	cache_images($service_content, $cache_dir, $count);
	return $service_html;
}

function cache_images($service_content, $cache_dir, $count){
	
	if (count($service_content) < $count){
		$count = count($service_content);
	}

	for ($i=0; $i<$count; $i++){
		$target = $service_content[$i]['img'];
		$destination = $cache_dir .$service_content[$i]['id']  .   '.jpg';

		if (!file_exists($destination)){
			$image = file_get_contents($target);
			file_put_contents($destination, $image);
		}
		

		
		
	}
	
}	


function get_wips($behance){
	$wips_url = $behance['base'] . "users/" . $behance['user'] . "/wips?api_key=" . $behance['key'];
	$wips = get_content_from_service($wips_url);


	$result_array = array();



	for ($i=0; $i<count($wips); $i++){
		$revision = array_shift($wips['wips'][$i]['revisions']);
		$comment_url = $behance['base'] . "wips/" . $wips['wips'][$i]['id'] . "/" .  $revision['id'] ."/comments?api_key=" . $behance['key'];

		$comments = get_content_from_service($comment_url);


		$first_comment = array_pop($comments["comments"]);
		$entry = array();
		$entry['id']  = "wip" . $revision['id'];
		$entry['name']  = $wips['wips'][$i]['title'];
		$entry['date']  = $wips['wips'][$i]['created_on'];
		$entry['url']  = $revision['url'];
		$entry['img']  = $revision['images']['thumbnail']['url'];
		$entry['desc']  = $first_comment['comment'];

		

		array_push($result_array, $entry);
	}

	usort($result_array, 'sortByOrder');
	return $result_array;
}

function sortByOrder($a, $b) {
    return $b['date'] - $a['date'];
}




function generateBehanceHTML($service_json, $count ){
	date_default_timezone_set('America/New_York');
	$result = "";
	$result .=  "<!-- pulled in from Behance -->" ."\n";


	if (count($service_json) < $count){
		$count = count($service_json);
	}

	for ($i=0; $i<$count; $i++){
		$raw_date = $service_json[$i]['date'];
		$date_string = date("F j, Y", $raw_date);
		$item = "";
		$item .= '			<article>' . "\n";
		$item .= '				<h1>';
		$item .= '<a href="' . $service_json[$i]['url'] . '">';
		$item .= $service_json[$i]['name'];
		$item .= '</a>';
		$item .= '</h1>' . "\n";
		$item .= '				<time datetime="' . date("Y-m-d", $raw_date) .'">';
		$item .= $date_string;
		$item .= '</time>' . "\n";
		$item .= '				<a href="' . $service_json[$i]['url'] . '">'. "\n";
		$item .= '					<img src="/assets/cache/' . $service_json[$i]['id']  .   '.jpg" />'. "\n";
		$item .= '				</a>'. "\n";
		$item .= '				<div><p>' . $service_json[$i]['desc'] . '</p></div>'. "\n";
		$item .= '			</article>' . "\n";
		$result .= $item;
	}
	return $result;
}


function get_content_from_service($url) {
	$content = url_get_contents($url);
	return json_decode($content, true);
}

?>