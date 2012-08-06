<?php

$count = 3;

// Make a MySQL Connection
$dbConn = mysql_connect($newDB['host'], $newDB['username'], $newDB['password']) or die(mysql_error());

mysql_select_db($newDB['db'], $dbConn) or die(mysql_error());

// Retrieve all the data from the "example" table
$entries = mysql_query("SELECT post_title, post_excerpt, guid, DATE_FORMAT(post_date, '%M %d, %Y') as formatted_post_date FROM wp_posts WHERE LENGTH(post_excerpt) > 0  ORDER BY post_date desc LIMIT 0, ". $count, $dbConn) or die(mysql_error()); 




while ($row = mysql_fetch_array($entries)) {
	$title = $row['post_title'];
	$excerpt = $row['post_excerpt'];
	$url = $row['guid'];
	$date = $row['formatted_post_date'];

	echo '			<article>'. "\n";
	echo '				<h1><a href="' . $url . '">' . $title .'</a></h1>'. "\n";
	echo '				<time>' . $date . '</time>'. "\n";
	echo '				<div>' . $excerpt . '</div>'. "\n";
	echo '			</article>'. "\n";	


}

?>