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

?>