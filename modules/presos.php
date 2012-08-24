<?php
include_once 'module_common.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';

$count = 3;


$slideShare_url = "http://www.slideshare.net/api/2/get_slideshows_by_user?username_for=tpryan";
$slideShare_cache = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/presos.html";
$cache_age = 2 * 60 * 60;


$ts = time();
$hash = hash("SHA1", $slideshare['secret'] . $ts );
$urlToGet = $slideShare_url . "&api_key=" . $slideshare['api_key'] . "&ts=" . $ts . "&hash=" . $hash . "&limit=" . $count;


if (isset($_GET['reset_cache']) && file_exists($slideShare_cache)){
	unlink($slideShare_cache);
}


if (shouldStillBeCached($slideShare_cache, $cache_age)){
	$slideShare_html = file_get_contents($slideShare_cache);
}
else{
	try {
		$slideShare_html = refreshSlideShareHTML($urlToGet, $slideShare_cache);
	} catch (Exception $e) {
		$slideShare_html = "<p>No presentations</p>";
		//var_dump($e);
	}
}

echo $slideShare_html;

function refreshSlideShareHTML($slideShare_url, $slideShare_cache){
	$slideShare_xml = get_content_from_slideShare($slideShare_url);
	$slideShare_html = generateSlideShareHTML($slideShare_xml);
	$cache_html = "<!-- From Cache --->" . $slideShare_html;
	file_put_contents($slideShare_cache, $cache_html);
	return $slideShare_html;
}


function generateSlideShareHTML($xml){
	$result = "";
	$result .=  "<!-- pulled in from slideShare -->" ."\n";
	foreach($xml->children() as $preso){
		//var_dump($preso);

		if (isset($preso->Title)){
			$item = "";
			$item .= '			<article>' . "\n";
			$item .= '				<h1>';
			$item .= '<a href="' . $preso->URL . '">';
			$item .= $preso->Title;
			$item .= '</a>';
			$item .= '</h1>' . "\n";
			$item .= '				<p>';
			$item .= $preso->Description;
			$item .= '</p>' . "\n";
			$item .= '			</article>' . "\n";
			$result .= $item;
		}
	}
	return $result;
}


function sort_slideShare_results($slideShare_content){
	$dates = array();
	foreach ($slideShare_content as $key => $row)
	{
	    $dates[$key] = $row['pushed_at'];
	}
	array_multisort($dates, SORT_DESC, $slideShare_content);
	return $slideShare_content;
}


function get_content_from_slideShare($url) {
	$content = file_get_contents($url);
	return simplexml_load_string($content);
}






