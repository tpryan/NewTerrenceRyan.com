<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';
include_once 'module_common.php';


$count = 2;
$cache_name = $app_name . "_blog";
$cache_age = 2 * 60 * 60;
$dbInfo = $newDB;

$contentCreationFunction = function ($dbInfo, $count){return refreshBlogHTML($dbInfo, $count);};

$contentCreationStore = $dbInfo;

$content_html = getFromCacheOrCreate($memcache, $cache_name, $cache_age, $contentCreationFunction, $contentCreationStore, $count);

echo $content_html;









function refreshBlogHTML($dbInfo, $count){
	$blog_content = getPostsFromDataBase($dbInfo, $count);
	$blog_html = generateBlogHTML($blog_content);
	return $blog_html;
}

function getPostsFromDataBase($dbInfo, $count){
	// Make a MySQLi Connection
	if (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
		$mysqli = mysqli_connect(null, $dbInfo['username'], $dbInfo['password'], $dbInfo['db'], 0, $dbInfo['host']) or die(mysqli_error());
	} else{
		$mysqli = mysqli_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password'], $dbInfo['db']) or die(mysqli_error());
	}	
	

	// Retrieve all the data from the "example" table
	$entries = $mysqli->query(" SELECT
        p1.post_title, p1.post_excerpt, p1.post_name, p1.guid, p1.post_date, DATE_FORMAT(p1.post_date, '%M %d, %Y') as formatted_post_date, p2.guid as thumbnail
        
    FROM 
        wp_posts p1
    LEFT JOIN 
        wp_postmeta wm1
        ON (
            wm1.post_id = p1.id 
            AND wm1.meta_value IS NOT NULL 
            AND wm1.meta_key = '_thumbnail_id'             
        )
    LEFT JOIN 
        wp_postmeta wm2
        ON (
            wm1.meta_value = wm2.post_id
            AND wm2.meta_key = '_wp_attached_file'
            AND wm2.meta_value IS NOT NULL  
        )
	LEFT JOIN 
    	wp_posts p2 
    	ON (
    		 wm1.meta_value = p2.id
    	)
    WHERE
        p1.post_status='publish' 
        AND p1.post_type='post'
    ORDER BY 
        p1.post_date DESC
    LIMIT 0,". $count) or die(mysqli_error()); 

	return $entries;
}

function generateBlogHTML($entries){
	
	$results = "";
	$results .=  "<!-- pulled in from blog -->" ."\n";
	while ($row = mysqli_fetch_array($entries)) {
		$title = $row['post_title'];
		$post_date = $row['post_date'];
		$excerpt = $row['post_excerpt'];
		$url = "http://" . "terrenceryan.com" . "/blog/index.php/" . $row['post_name'];
		$thumb = $row['thumbnail'];
		$date = $row['formatted_post_date'];
		$item = "";
		$item .= '			<article>'. "\n";
		$item .= '				<h1><a href="' . $url . '">' . $title .'</a></h1>'. "\n";
		$item .= '				<time datetime="' . $post_date . '">' . $date . '</time>'. "\n";
		
		if (strlen($thumb) > 0){
			$item .= '				<img src="' . $thumb . '" />'. "\n";
		}
		$item .= '				<div><p>' . strip_tags($excerpt) . '</p></div>'. "\n";

		$item .= '			</article>'. "\n";	
		$results .= $item; 
	}
	return $results;
}




?>