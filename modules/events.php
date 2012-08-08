<?php
	include_once 'error.php';
	
	$lanyrd_url = "http://lanyrd.com/people/tpryan/tpryan.ics";
	$count = 3;
	$lanyrd_cache = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/events.html";
	$cache_age = 2 * 60 * 60;



	if (isset($_GET['reset_cache']) && file_exists($lanyrd_cache)){
		unlink($lanyrd_cache);
	}

	if (shouldStillBeCached($lanyrd_cache, $cache_age)){
		$lanyrd_html = file_get_contents($lanyrd_cache);
	}
	else{
		try {
			$lanyrd_html = refreshHTML($lanyrd_url, $count,$lanyrd_cache);
		} catch (Exception $e) {
			$lanyrd_html = "<p>No upcoming events</p>";
			var_dump($e);
		}
	}
	
	echo $lanyrd_html;


	function customError($errno, $errstr){
		if (strpos($errstr,"failed to open stream") !== false){
			$lanyrd_html = "<p>No upcoming events</p>";

		}
		else{
			echo "<b>Error:</b> [$errno] $errstr<br />";
			echo "Ending Script";
			die();
		}
		
	}

	function shouldStillBeCached($file, $cache_age){
		if (file_exists($file) &&(time() - filemtime($file) < $cache_age)){
			return true;
		}
		else{
			return false;
		}
	}

	function refreshHTML($lanyrd_url, $count, $lanyrd_cache){
		$lanyrd_content = get_content_from_lanyrd($lanyrd_url);
		$lanyrd_html = generateEventHTML($lanyrd_content,$count);
		$cache_html = "<!-- From Cache --->" . $lanyrd_html;
		file_put_contents($lanyrd_cache, $cache_html);
		return $lanyrd_html;
	}


	function generateEventHTML($lanyrd_content,$count){

		date_default_timezone_set('America/New_York');
		
		$result = ""; 
		$result .=  "<!-- pulled in from lanyrd -->" ."\n";
		for ($i=0; $i<$count; $i++){
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

			$entry .= '				<time>';
			$entry .= $date_string;
			$entry .= '</time>' . "\n";

			$entry .= '				<address>';
			$entry .= $lanyrd_content[$i]['location'];
			$entry .= '</address>' . "\n";

			$entry .= '				<p>';
			$entry .= $lanyrd_content[$i]['description'];
			$entry .= '</p>' . "\n";
			
			$entry .= '			</article>' . "\n";
			if (strpos($lanyrd_content[$i]['location'], "Amsterdam") !== false){
				date_default_timezone_set('America/New_York');
			}
			$result .= $entry;
		}
		return $result;
	}

	


	function get_content_from_lanyrd($url) {
		date_default_timezone_set('Europe/London');
		$content = file_get_contents($url);
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



		return sort_lanyrd_results($data);
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



?> 

