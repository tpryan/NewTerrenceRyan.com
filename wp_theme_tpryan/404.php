<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/creds.php';


$dbInfo = $newDB;
$search_array = explode("/", $_SERVER["REQUEST_URI"]);

$search_term = "";

while (strlen($search_term) == 0){
	$search_term = array_pop($search_array);

	if (count($search_array) == 0) {
		break;
	}
}

if (isBlogEntry($dbInfo, $search_term)) {
	$url_to_go_to = "http://" . $_SERVER["HTTP_HOST"] . "/blog/index.php/" . $search_term;
	//redirect($url_to_go_to, 301);
} 


function isBlogEntry($dbInfo, $search_string){
	// Make a MySQL Connection
	$dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
	mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());

	// Retrieve all the data from the "example" table
	$entries = mysql_query(" SELECT count(post_title) as doesExist   
    FROM 
        wp_posts 
    WHERE
        post_name='" . $search_string . "'
        AND post_type='post'", $dbConn) or die(mysql_error()); 

	$doesExist = mysql_result($entries,0,"doesExist");

	if ($doesExist){
		return true;
	} else {
		return false;
	}

}

function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}



get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'twentythirteen' ); ?></h1>
			</header>

			<div class="page-wrapper">
				<div class="page-content">
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentythirteen' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>