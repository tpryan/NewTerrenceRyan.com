<?php
include 'creds.php';

// Make a MySQL Connection
$oldBDConnection = mysql_connect($oldDB['host'], $oldDB['username'], $oldDB['password']) or die(mysql_error());
$newBDConnection = mysql_connect($newDB['host'], $newDB['username'], $newDB['password']) or die(mysql_error());

mysql_select_db($oldDB['db'], $oldBDConnection) or die(mysql_error());


// Retrieve all the data from the "example" table
$entries = mysql_query("SELECT e.title, e.name, e.last_modified, e.content, p.posted_on FROM entry e INNER JOIN post p on e.id=p.id", $oldBDConnection) or die(mysql_error());  

// store the record of the "example" table into $row
//$row = mysql_fetch_array( $entries );

mysql_select_db($newDB['db'], $newBDConnection) or die(mysql_error());
mysql_query("DELETE FROM wp_posts WHERE id > 3", $newBDConnection) or die(mysql_error());  
mysql_query("ALTER TABLE wp_posts AUTO_INCREMENT = 4", $newBDConnection) or die(mysql_error());  



while ($row = mysql_fetch_array($entries)) {
	$title = mysql_real_escape_string($row['title']);
	$name = $row['name'];
	$author = 1;
	$posted = $row['posted_on'];
	$modified = $row['last_modified'];
	$content = mysql_real_escape_string($row['content']);

	$columns = "post_title, post_name, post_author, post_date, post_date_gmt, post_modified, post_modified_gmt, post_content";
	$values = "'" . $title . "','" . $name . "'," . $author . ",'" .$posted. "'," .  "'" .$posted. "'," ."'" .$modified. "'," ."'" .$modified. "'," . "'" . $content . "'" ; 

	$insertSQL = "INSERT INTO wp_posts(" . $columns . ") VALUES (" . $values .  ")"; 
	mysql_query($insertSQL, $newBDConnection) or die(mysql_error());  


}

mysql_close($oldBDConnection);
mysql_close($newBDConnection);

?>