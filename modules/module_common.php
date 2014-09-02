<?php

	use google\appengine\api\app_identity\AppIdentityService;
	$app_name = AppIdentityService::getApplicationId();

	$memcache = new Memcached;
	

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

	function broadcast($message) {
		syslog(LOG_DEBUG, $message);
	    echo "<!--" . $message . " -->" . "\n";
	}

	function getFromCacheOrCreate($memcache, $cache_name, $cache_age, $contentCreationFunction, $contentCreationStore, $count) {

		$cached_content = $memcache->get($cache_name);
		$rebuild = ($cached_content == false) ||  isset($_GET['reset_cache']);

		if ($rebuild){
			try {
				$content_html = $contentCreationFunction($contentCreationStore, $count);
				$cache_html = "<!-- From Cache -->" . $content_html;
				$memcache->set($cache_name, $cache_html, $cache_age);
			} catch (Exception $e) {
				$content_html = "<p>No entries</p>";
			 	broadcast($e->getMessage());
			}
		} else {
			$content_html = $cached_content;
		}

		return $content_html;
	}

?>