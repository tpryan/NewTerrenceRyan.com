<?php
require_once 'module_common.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';

$lanyrd_url = "http://lanyrd.com/people/tpryan/tpryan.ics";
$count = 3;
$lanyrd_cache = "gs://" . $googleprojectname . "/assets/cache/events.html";
$cache_age = 2 * 60 * 60;



if (isset($_GET['reset_cache']) && file_exists($lanyrd_cache)){
	unlink($lanyrd_cache);
}

if (shouldStillBeCached($lanyrd_cache, $cache_age)){
	$lanyrd_html = file_get_contents($lanyrd_cache);
}
else{
	try {
		$lanyrd_html = refreshLanyrdHTML($lanyrd_url, $count,$lanyrd_cache);
	} catch (Exception $e) {
		$lanyrd_html = "<article><p>No upcoming events</p></article>";
	}
}

echo $lanyrd_html;



function refreshLanyrdHTML($lanyrd_url, $count, $lanyrd_cache){
	$lanyrd_content = get_content_from_lanyrd($lanyrd_url);
	$lanyrd_html = generateEventHTML($lanyrd_content,$count);
	$cache_html = "<!-- From Cache -->" . $lanyrd_html;
	place_in_cache($lanyrd_cache, $cache_html);
	return $lanyrd_html;
}


function generateEventHTML($lanyrd_content,$count){

	date_default_timezone_set('America/New_York');

	if ($count > count($lanyrd_content)){
		$count = count($lanyrd_content);
	}
	
	$result = ""; 
	$result .=  "<!-- pulled in from lanyrd -->" ."\n";
	for ($i=0; $i<$count; $i++){
		
		
		if (strlen($lanyrd_content[$i]['end']) > 0 ){
			$compstr = date("Ymd", $lanyrd_content[$i]['end']);
		}
		else{
			$compstr = date("Ymd", $lanyrd_content[$i]['start']);
		}

		$compnow = date("Ymd", time());
		

		if($compnow >= $compstr){
			continue;
		}

		$entry = "";
		$entry .=  '			<article>' . "\n";
		$entry .=  '				<h1>';
		$entry .=  '<a href="' . $lanyrd_content[$i]['url'] . '">';
		$entry .=  $lanyrd_content[$i]['title'];
		$entry .=  '</a>';
		$entry .=  '</h1>' . "\n";

		if (strpos($lanyrd_content[$i]['location'], "Amsterdam") !== false){
			date_default_timezone_set('Europe/Amsterdam');
		}

		$date_string = date("F j", $lanyrd_content[$i]['start']);
		$first_day = date("j", $lanyrd_content[$i]['start']);
		$last_day = date("j", $lanyrd_content[$i]['end']);

		if (($lanyrd_content[$i]['end'] - $lanyrd_content[$i]['start']) > (24 * 60 * 60) ){
			$date_string = $date_string . " - " . $last_day; 
		}

		$entry .= '				<time datetime="' . date("Y-m-d", $lanyrd_content[$i]['start']) .'">';
		$entry .= $date_string;
		$entry .= '</time>' . "\n";



		$entry .= '				<address>';
		$entry .= str_replace("\,", ",", format_address($lanyrd_content[$i]['location_fixed'])). "\n";
		$entry .= '				<img class="flag" src="';
		$entry .= "/assets/img/flags/" . strtolower($lanyrd_content[$i]['location_fixed']['country_code']) . ".svg";
		$entry .= '" />' . "\n";
		$entry .= '				</address>' . "\n";

		$entry .= '				<p>';
		$entry .= str_replace("\,", ",", convert_smart_quotes($lanyrd_content[$i]['description']));
		$entry .= '</p>' . "\n";
		
		
		$entry .= '			</article>' . "\n";
		if (strpos($lanyrd_content[$i]['location'], "Amsterdam") !== false){
			date_default_timezone_set('America/New_York');
		}
		$result .= $entry;
	}
	return $result;
}

function format_address($address_info){
	$results = $address_info['city'];

	if ($address_info['country'] == "United Kingdom"){
		$address_info['country'] = "UK";
	}

	if ($address_info['country'] !== "United States"){
		$results .=  ", " . $address_info['country'];
	}
	else{
		$results .=  ", " . $address_info['state'];
	}
	return $results;
}

function convert_smart_quotes($string) 
{ 
    $search = array(chr(145), 
                    chr(146), 
                    chr(147), 
                    chr(148), 
                    chr(151),
                    "’"); 
 
    $replace = array("'", 
                     "'", 
                     '"', 
                     '"', 
                     '-',
                     "'"); 
 
    return str_replace($search, $replace, $string); 
} 


function get_content_from_lanyrd($url) {
	date_default_timezone_set('Europe/London');
	
	$content = url_get_contents($url);


	$content = explode("\n", $content);
	$j = 0;

	for ($i=0; $i < count($content); $i++){

		if (strpos($content[$i],"END:VEVENT") !== false){
			$j ++;
		}
		if (strpos($content[$i],"BEGIN:VEVENT") !== false){
			$data[$j]['title'] = "";
			$data[$j]['description'] = "";
			$data[$j]['location'] = "";
			$data[$j]['url'] = "";
			$data[$j]['start'] = "";
			$data[$j]['end'] = "";
		}

		if (strpos($content[$i],"SUMMARY") !== false){
			$str = explode(":", $content[$i]);
			$data[$j]['title'] = $str[1];
		}

		if ((strpos($content[$i],"DESCRIPTION") !== false)) {
			$str = explode(":", $content[$i]);
			$str = explode("\\n", $str[1]);
			if ($str[0] !== "http"){
				$data[$j]['description'] = $str[0];
			}
		}

		if (strpos($content[$i],"LOCATION") !== false){
			$str = explode(":", $content[$i]);
			$data[$j]['location'] = $str[1];
		}
		if (strpos($content[$i],"URL") !== false){
			$str = substr($content[$i],4);
			$data[$j]['url'] = $str;
		}
		if (strpos($content[$i],"DTSTART") !== false){
			$str = explode(":", $content[$i]);
			$data[$j]['start'] = strtotime($str[1]);
		}
		if (strpos($content[$i],"DTEND") !== false){
			$str = explode(":", $content[$i]);
			$data[$j]['end'] = strtotime($str[1]);
		}

	}

	$results = sort_lanyrd_results($data);
	$results = fix_addresses($results);
	return $results;
}

function fix_addresses($lanyrd_details){

	for ($i=0; $i<count($lanyrd_details); $i++){
		$lanyrd_details[$i]['location_fixed'] = normalize_address($lanyrd_details[$i]['location']);
	}


	return $lanyrd_details;
}


function sort_lanyrd_results($lanyrd_content){
	$dates = array();
	foreach ($lanyrd_content as $key => $row)
	{
	    $dates[$key] = $row['start'];
	}
	array_multisort($dates, SORT_ASC, $lanyrd_content);
	return $lanyrd_content;
}

function normalize_address($address){
	$address = urlencode($address);
	$base_url ="http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=";
	$map_data = get_content_from_service($base_url . $address);
	$results = extracts_geo_details($map_data);
	return $results;

}


function extracts_geo_details($googleinfo){
	$results = array('city'=>"",'state'=>"",'country'=>"",'country_code'=>"");
	
	$address_components = $googleinfo['results'][0]['address_components'];

	for ($i=0; $i<count($address_components); $i++){
	
		if($address_components[$i]['types'][0] == "country"){
			$results["country"] = $address_components[$i]['long_name'];
			$results["country_code"] = $address_components[$i]['short_name'];
		}
		if($address_components[$i]['types'][0] == "locality"){
			$results["city"] = $address_components[$i]['long_name'];
		}
		if($address_components[$i]['types'][0] == "administrative_area_level_1"){
			$results["state"] = $address_components[$i]['short_name'];
		}		
		
	}
	return $results;
}





?> 

