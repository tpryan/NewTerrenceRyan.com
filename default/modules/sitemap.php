<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';
include_once 'module_common.php';

$cache_name = $app_name . "_blog_sitemap";
$cache_age = 2 * 60 * 60;
$dbInfo = $newDB;


$contentCreationFunction = function ($dbInfo){return generateBlogHTML(getPostsFromDataBase($dbInfo));};
$contentCreationStore = $dbInfo;
$content_html = getFromCacheOrCreate($memcache, $cache_name, $cache_age, $contentCreationFunction, $contentCreationStore, 0);

echo $content_html;




function getPostsFromDataBase($dbInfo){
	// Make a MySQL Connection
	// Make a MySQLi Connection
	if (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
		$mysqli = mysqli_connect(null, $dbInfo['username'], $dbInfo['password'], $dbInfo['db'], 0, $dbInfo['host']) or die(mysqli_error());
	} else{
		$mysqli = mysqli_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password'], $dbInfo['db']) or die(mysqli_error());
	}



	$entries = $mysqli->query("	SELECT 		post_title, guid, post_name, 
											DATE_FORMAT(post_date, '%M') as month, 
											DATE_FORMAT(post_date, '%Y') as year 
							   	FROM 		wp_posts 
							   	WHERE 		post_status = 'publish' AND post_type='post'  
							   	ORDER BY 	post_date desc") or die(mysqli_error($mysqli)); 

	return $entries;
}




function generateBlogHTML($entries){
	$current_year ="";
	$current_month = "";
	$results = "";
	$results .=  "<!-- pulled in from blog -->" ."\n";
	while ($row = mysqli_fetch_array($entries)) {
		

		$year = $row['year'];
		$month = $row['month'];
		$title = $row['post_title'];
		$url = "http://" . "terrenceryan.com" . "/blog/index.php/" . $row['post_name'];
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