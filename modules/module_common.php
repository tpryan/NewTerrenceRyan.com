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
	
	function place_in_cache($location, $content) {
	    $parent = dirname($location);
	    if (!file_exists($parent) ){
	        mkdir($parent); 
        }
	    
	    file_put_contents($location, $content);
    }

	function url_get_contents ($url) {
        $options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
        $context  = stream_context_create($options);	    
        $response = file_get_contents($url, false, $context);
	    return $response;
	}

	function get_content_from_service($url) {
		$content = url_get_contents($url);
		return json_decode($content, true);
	}

?>