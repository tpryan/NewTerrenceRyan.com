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
		broadcast($e);
		$service_html = "<article><p>No current projects</p></article>";
	}
}


echo $service_html;



function refreshServiceHTML($behance, $count, $service_cache, $cache_dir){
	broadcast("refreshServiceHTML started ");
	$service_content = get_wips($behance,$cache_dir);
	$service_html = generateBehanceHTML($service_content, $count);
	$cache_html = "<!-- From Cache -->" . $service_html;
	file_put_contents($service_cache, $cache_html);
	cache_images($service_content, $cache_dir, $count);
	broadcast("refreshServiceHTML ended ");
	return $service_html;
}

function cache_images($service_content, $cache_dir, $count){
	broadcast("cache_images started ");
	
	
	if (count($service_content) < $count){
		$count = count($service_content);
	}
	
	
	

	for ($i=0; $i<$count; $i++){
		$target = $service_content[$i]['img'];
		$extension = get_file_extention($target);
		$destination = $cache_dir . $service_content[$i]['id']  .   '.' . $extension;

		broadcast("Target : " . $target);
        broadcast("Destination : " . $destination);
		
		if (!file_exists($destination)){
			broadcast("Image needs caching");
			
            
            $ch = curl_init($target);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_USERAGENT,'PHP Client of Behance API User: tpryan' );
            $image = curl_exec($ch);
            curl_close($ch);
            
            
            
            if ($extension == "png") {
                $image = imagepng(imagecreatefromstring($image), $destination, 9,PNG_NO_FILTER );
            } else {
                file_put_contents($destination, $image);
            }   
            
			
		}
		else{
		    broadcast("Image does not need caching");
        }
	}
	broadcast("cache_images ended ");
}	


function get_wips($behance,$cache_dir){
	broadcast("get_wips started ");
	$wips_url = $behance['base'] . "users/" . $behance['user'] . "/wips?api_key=" . $behance['key'];
	//$wips_url = "http://new.terrenceryan.dev/assets/cache/behance.static.json";
	
	broadcast("wips_url: " . $wips_url);
	$wips = get_content_from_service($wips_url);
	file_put_contents($cache_dir . "behance.json", json_encode($wips));
	
	$result_array = array();

	for ($i=0; $i<count($wips); $i++){
		$revision = array_shift($wips['wips'][$i]['revisions']);
		$comment_url = $behance['base'] . "wips/" . $wips['wips'][$i]['id'] . "/" .  $revision['id'] ."/comments?api_key=" . $behance['key'];

		$comments = get_content_from_service($comment_url);


		$entry = array();
		$entry['id']  = "wip" . $revision['id'];
		$entry['name']  = $wips['wips'][$i]['title'];
		$entry['date']  = $wips['wips'][$i]['created_on'];
		$entry['url']  = $revision['url'];
		$entry['img']  = $revision['images']['thumbnail']['url'];
		$entry['desc']  = $revision['description'];
		$entry['img']  = $revision['images']['thumbnail']['url'];
		$entry['img_type']  = get_file_extention($revision['images']['thumbnail']['url']);

		

		array_push($result_array, $entry);
	}

	usort($result_array, 'sortByOrder');
	broadcast("get_wips ended ");
	return $result_array;
}

function sortByOrder($a, $b) {
    return $b['date'] - $a['date'];
}

function get_file_extention($filename) {
	return substr($filename, strrpos($filename, '.')+1);
}


function generateBehanceHTML($service_json, $count ){
	broadcast("generateBehanceHTML started ");
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
		$item .= '					<img src="/assets/cache/' . $service_json[$i]['id'] . '.' . $service_json[$i]['img_type'] . '" />'. "\n";
		$item .= '				</a>'. "\n";
		$item .= '				<div><p>' . $service_json[$i]['desc'] . '</p></div>'. "\n";
		$item .= '			</article>' . "\n";
		$result .= $item;
	}
    broadcast("generateBehanceHTML ended");
	return $result;
}


function broadcast($message) {
    echo "<!--" . $message . " -->" . "\n";
    error_log($message, 0);
}

?>