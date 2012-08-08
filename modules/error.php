<?php
	set_error_handler(
	    create_function(
	        '$severity, $message, $file, $line',
	        'throw new ErrorException($message, $severity, $severity, $file, $line);'
	    )
	);

?>