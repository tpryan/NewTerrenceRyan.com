<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';
include_once 'module_common.php';
$count = 3;
$blog_cache = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/blog.html";
$cache_age = 2 * 60 * 60;

$dbInfo = $newDB;
$entries = getPostsFromDataBase($newDB, $count);
$blogHTML = generateBlogHTML($entries);



if (isset($_GET['reset_cache']) && file_exists($blog_cache)){
	unlink($blog_cache);
}

if (shouldStillBeCached($blog_cache, $cache_age)){
	$blog_html = file_get_contents($blog_cache);
}
else{
	try {
		$blog_html = refreshBlogHTML($dbInfo, $count,$blog_cache);
	} catch (Exception $e) {
		$blog_html = "<p>No posts</p>";
		var_dump($e);
	}
}

echo $blog_html;



function refreshBlogHTML($dbInfo, $count, $blog_cache){
	$blog_content = getPostsFromDataBase($dbInfo, $count);
	$blog_html = generateBlogHTML($blog_content);
	$cache_html = "<!-- From Cache --->" . $blog_html;
	file_put_contents($blog_cache, $cache_html);
	return $blog_html;
}





function getPostsFromDataBase($dbInfo, $count){
	// Make a MySQL Connection
	$dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
	mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());

	// Retrieve all the data from the "example" table
	$entries = mysql_query("SELECT post_title, post_excerpt, guid, DATE_FORMAT(post_date, '%M %d, %Y') as formatted_post_date FROM wp_posts WHERE LENGTH(post_excerpt) > 0  ORDER BY post_date desc LIMIT 0, ". $count, $dbConn) or die(mysql_error()); 

	return $entries;
}




function generateBlogHTML($entries){
	
	$results = "";
	$results .=  "<!-- pulled in from blog -->" ."\n";
	while ($row = mysql_fetch_array($entries)) {
		$title = $row['post_title'];
		$excerpt = $row['post_excerpt'];
		$url = $row['guid'];
		$date = $row['formatted_post_date'];
		$item = "";
		$item .= '			<article>'. "\n";
		$item .= '				<h1><a href="' . $url . '">' . $title .'</a></h1>'. "\n";
		$item .= '				<time>' . $date . '</time>'. "\n";
		$item .= '				<div>' . $excerpt . '</div>'. "\n";
		$item .= '			</article>'. "\n";	
		$results .= $item; 
	}
	return $results;
}




?>