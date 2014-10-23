<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';



$dbInfo = $newDB;

$urlString = $_SERVER["REQUEST_URI"];


if (isDateArchive($urlString )) {
	$url_to_go_to = getDateArchiveUrl($urlString);
	redirect($url_to_go_to, 301);
} 


if (isBlogEntry($dbInfo, $urlString )) {
	$url_to_go_to = getPostUrl($urlString);
	redirect($url_to_go_to, 301);
} 

function getPostUrl($urlString){
	$search_term = getSearchTerm($urlString);
	$url_to_go_to = "http://" . $_SERVER["HTTP_HOST"] . "/blog/index.php/" . $search_term;
	return $url_to_go_to;
}

function getDateArchiveUrl($urlString){
	$search_array = explode("/", $urlString);
	$month = array_pop($search_array);
	$year = array_pop($search_array);
	$url_to_go_to = "http://" . $_SERVER["HTTP_HOST"] . "/blog/index.php/" . $year . "/" . $month ;
	return $url_to_go_to;
}



function isDateArchive($urlString){

	if (strpos($urlString, "archive") === false || strpos($urlString, "date") === false ){
		return false;
	} else {
		return true;
	}

}

function isBlogEntry($dbInfo, $urlString){

	$search_term = getSearchTerm($urlString);
	if (strlen($search_term) == 0){
		return false;
	}

	// Make a MySQL Connection
	$dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
	mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());

	// Retrieve all the data from the "example" table
	$query = " SELECT count(post_title) as doesExist   
    FROM 
        wp_posts 
    WHERE
        post_name='" . $search_term . "'
        AND post_type='post'";

	$entries = mysql_query($query, $dbConn) or die(mysql_error()); 

	$doesExist = mysql_result($entries,0,"doesExist");


	if ($doesExist){
		return true;
	} else {
		return false;
	}

}


function getSearchTerm($urlString) {
	$search_array = explode("/", $urlString);
	$search_term = "";

	while (strlen($search_term) == 0){
		$search_term = array_pop($search_array);

		if (count($search_array) == 0) {
			break;
		}
	}
	return $search_term;
}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}





;?>