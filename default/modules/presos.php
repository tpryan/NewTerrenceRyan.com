<?php
include_once 'module_common.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';

$speakerdeck_url = "https://speakerdeck.com/tpryan.atom";
$cache_name = $app_name . "_speakerdeck";
$count = 2;
$cache_age = 2 * 60 * 60;

$contentCreationStore = $speakerdeck_url;
$contentCreationFunction = function ($speakerdeck_url, $count){return refreshSpeakerDeckHTML($speakerdeck_url, $count);};

$content_html = getFromCacheOrCreate($memcache, $cache_name, $cache_age, $contentCreationFunction, $contentCreationStore, $count);

echo $content_html;


function refreshSpeakerDeckHTML($speakerdeck_url, $count){
	$speakerdeck_content = get_content_from_speakerdeck($speakerdeck_url);
	$speakerdeck_html = generateSpeakerDeckHTML($speakerdeck_content,$count);
	return $speakerdeck_html;
}

function generateSpeakerDeckHTML($speakerdeck_content, $count){
	date_default_timezone_set('America/New_York');
	$result = "";
	$result .=  "<!-- pulled in from speakerdeck -->" ."\n";
	$i=0;

	$speakerdeck_content->registerXPathNamespace('a', 'http://www.w3.org/2005/Atom');
	foreach($speakerdeck_content->xpath('/a:feed/a:entry') as $preso){
		$i++;
		if ($i > $count){
			break;
		}
		if (isset($preso->title)){
			$item = "";
			$item .= '			<article>' . "\n";
			$item .= '				<h1>';
			$item .= '<a href="' . $preso->link['href'] . '">';
			$item .= $preso->title;
			$item .= '</a>';
			$item .= '</h1>' . "\n";
			$item .= '				<p>';
			$item .= str_replace('img alt', 'img width="210" height="157" alt', $preso->content);
			$item .= '</p>' . "\n";
			$item .= '			</article>' . "\n";
			$result .= $item;
		}
	}
	return $result;
}


function get_content_from_speakerdeck($url) {
	$content = url_get_contents($url);
	return simplexml_load_string($content);
}






