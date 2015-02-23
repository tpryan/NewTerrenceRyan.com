<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';
include_once 'module_common.php';
$count = 3;
$sitemap_cache = $_SERVER['DOCUMENT_ROOT'] . "/assets/cache/sitemap.html";
$cache_age = 2 * 60 * 60;

$dbInfo = $newDB;
$entries = getPostsFromDataBase($newDB, $count);
$blogHTML = generateBlogHTML($entries);



if (isset($_GET['reset_cache']) && file_exists($sitemap_cache)){
	unlink($sitemap_cache);
}

if (shouldStillBeCached($sitemap_cache, $cache_age)){
	$blog_html = file_get_contents($sitemap_cache);
}
else{
	try {
		$blog_html = refreshBlogHTML($dbInfo, $count,$sitemap_cache);
	} catch (Exception $e) {
		$blog_html = "<p>No posts</p>";
		var_dump($e);
	}
}

echo $blog_html;



function refreshBlogHTML($dbInfo, $count, $sitemap_cache){
	$blog_content = getPostsFromDataBase($dbInfo, $count);
	$blog_html = generateBlogHTML($blog_content);
	$cache_html = "<!-- From Cache --->" . $blog_html;
	file_put_contents($sitemap_cache, $cache_html);
	return $blog_html;
}





function getPostsFromDataBase($dbInfo, $count){
	// Make a MySQL Connection
	$dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
	mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());

	// Retrieve all the data from the "example" table
	$entries = mysql_query("SELECT post_title, guid, DATE_FORMAT(post_date, '%M') as month, DATE_FORMAT(post_date, '%Y') as year FROM wp_posts WHERE post_status = 'publish' AND post_type='post'  ORDER BY post_date desc", $dbConn) or die(mysql_error()); 

	return $entries;
}




function generateBlogHTML($entries){
	$current_year ="";
	$current_month = "";
	$results = "";
	$results .=  "<!-- pulled in from blog -->" ."\n";
	while ($row = mysql_fetch_array($entries)) {
		

		$year = $row['year'];
		$month = $row['month'];
		$title = $row['post_title'];
		$url = $row['guid'];
		if (isset($data[$year][$month]) == false){
			$data[$year][$month] = "";
		}	
		$item = '					<li><a href="' . $url . '">' . $title .'</a></li>'. "\n";
		$data[$year][$month].= $item;
	

	}

	$years = array_keys($data);

	$results .=  "<ul>" ."\n";
	foreach ($years as $year){
		$yearStrings = "";
		$yearStrings .= "	<li>\n";
		$yearStrings .= "		<h3>" . $year. "</h3>\n";
		$yearStrings .= "		<ul>\n";

		$months = array_keys($data[$year]);
			foreach ($months as $month){
				$monthStrings = "";
				$monthStrings .= "		<li>\n";
				$monthStrings .= "			<h4>" . $month. "</h4>\n";
				$monthStrings .= "			<ul>\n";

				$monthStrings .= "" . $data[$year][$month];

				$monthStrings .= "			</ul>\n";
				$monthStrings .= "		</li>\n";
				$yearStrings .= $monthStrings;
			}	


		$yearStrings .= "		</ul>\n";
		$yearStrings .= "	</li>\n";
		$results .= $yearStrings;
	}
	$results .=  "</ul>" ."\n";




	return $results;
}




?>