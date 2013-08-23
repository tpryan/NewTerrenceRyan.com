<?php
	set_error_handler(
	    create_function(
	        '$severity, $message, $file, $line',
	        'throw new ErrorException($message, $severity, $severity, $file, $line);'
	    )
	);

	function shouldStillBeCached($file, $cache_age){
		if (file_exists($file) &&(time() - filemtime($file) < $cache_age)){
			return true;
		}
		else{
			return false;
		}
	}

	function url_get_contents ($Url) {
	    if (!function_exists('curl_init')){ 
	        die('CURL is not installed!');
	    }
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $Url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch,CURLOPT_USERAGENT,'PHP_Curl');
	    $output = curl_exec($ch);
	    curl_close($ch);

	    return $output;
	}

	function get_content_from_service($url) {
		$content = url_get_contents($url);
		return json_decode($content, true);
	}

?>