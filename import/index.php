<?php
include 'creds.php';

// Make a MySQL Connection
$oldBDConnection = mysql_connect($oldDB['host'], $oldDB['username'], $oldDB['password']) or die(mysql_error());
$newBDConnection = mysql_connect($newDB['host'], $newDB['username'], $newDB['password']) or die(mysql_error());

mysql_select_db($oldDB['db'], $oldBDConnection) or die(mysql_error());


// Retrieve all the data from the "example" table
$entries = mysql_query("SELECT e.*, p.posted_on FROM entry e INNER JOIN post p on e.id=p.id", $oldBDConnection) or die(mysql_error());  
$categories = mysql_query("SELECT * FROM category", $oldBDConnection) or die(mysql_error()); 
$comments = mysql_query("SELECT * FROM comment", $oldBDConnection) or die(mysql_error()); 
$categoriesToPosts = mysql_query("SELECT * FROM post_category", $oldBDConnection) or die(mysql_error()); 
$categoryCount = mysql_query("select count(post_id) as entries, category_id from post_category GROUP By category_id ", $oldBDConnection) or die(mysql_error());
$commentCount = mysql_query("select count(id) as comments, entry_id from comment GROUP BY entry_id ", $oldBDConnection) or die(mysql_error());

mysql_select_db($newDB['db'], $newBDConnection) or die(mysql_error());

// Handle Entries
echo "<p>Handling posts</p>";
clearTable("wp_posts", 4, $newBDConnection);


while ($row = mysql_fetch_array($commentCount)) {
	$commentCountHash[$row['entry_id']] = $row['comments'];
}


while ($row = mysql_fetch_array($entries)) {
	$title = mysql_real_escape_string($row['title']);
	$name = $row['name'];
	$author = 1;
	$posted = $row['posted_on'];
	$id = $row['id'];
	$modified = $row['last_modified'];
	$content = mysql_real_escape_string($row['content']);
	$excerpt = mysql_real_escape_string($row['excerpt']);
	$commentCount = $commentCountHash[$id];
	$guid = "http://blog.terrenceryan.dev/" .  $name;

	$columns = "post_title, post_name, post_author, post_date, post_date_gmt, post_modified, post_modified_gmt, post_content, post_excerpt, comment_count, guid";
	$values = "'" . $title . "','" . $name . "'," . $author . ",'" .$posted. "'," .  "'" .$posted. "'," ."'" .$modified. "'," ."'" .$modified. "'," . "'" . $content . "','" . $excerpt . "','" . $commentCount . "','" . $guid . "'" ; 

	$insertSQL = "INSERT INTO wp_posts(" . $columns . ") VALUES (" . $values .  ")"; 
	mysql_query($insertSQL, $newBDConnection) or die(mysql_error());
	$postid = mysql_insert_id();
	$entriesHash[$id]  = $postid; 

}

// Handle Comments
clearTable("wp_comments", 2, $newBDConnection);

while ($row = mysql_fetch_array($comments)) {
	$createdon = $row['created_on'];
	$content = mysql_real_escape_string($row['content']);
	$name = mysql_real_escape_string($row['creator_name']);
	$email = mysql_real_escape_string($row['creator_email']);
	$url = mysql_real_escape_string($row['creator_url']);
	$entryid = $row['entry_id'];
	$postid = $entriesHash[$entryid];

	$columns = "comment_post_id, comment_author, comment_author_email, comment_author_url, comment_date, comment_date_gmt, comment_content";
	$values = "'" . $postid . "','" . $name . "','" . $email . "','" .$url. "'," .  "'" .$createdon. "'," ."'" .$createdon. "'," ."'" .$content. "'"; 

	$insertSQL = "INSERT INTO wp_comments(" . $columns . ") VALUES (" . $values .  ")";
	//echo $insertSQL; 
	mysql_query($insertSQL, $newBDConnection) or die(mysql_error());
	$commentid = mysql_insert_id();
	$commentHash[$id]  = $commentid; 

}







//Handle Tags
echo "<p>Handling tags </p>";
clearTable("wp_terms", 3, $newBDConnection); 
clearTable("wp_term_taxonomy", 3, $newBDConnection); 


while ($row = mysql_fetch_array($categoryCount)) {
	$categoryCountHash[$row['category_id']] = $row['entries'];
}

while ($row = mysql_fetch_array($categories)) {
	$title = mysql_real_escape_string($row['title']);
	$name = $row['name'];
	$id = $row['id'];

	$columns = "name, slug";
	$values = "'" . $title . "','" . $name . "'"; 

	$insertSQL = "INSERT INTO wp_terms(" . $columns . ") VALUES (" . $values .  ")";
	mysql_query($insertSQL, $newBDConnection) or mysql_error();

	$categoryid = mysql_insert_id(); 
	$tagHash[$id]  = $categoryid; 

	$tagCount = $categoryCountHash[$id];

	$columns = "term_id, taxonomy, count";
	$values = "'" . $categoryid . "','post_tag', " . $tagCount; 
	$insertSQL = "INSERT INTO wp_term_taxonomy(" . $columns . ") VALUES (" . $values .  ")";
	mysql_query($insertSQL, $newBDConnection) or mysql_error();

}

//handle tags to posts
echo "<p>Handling tags to post</p>";



mysql_query("DELETE FROM wp_term_relationships WHERE term_taxonomy_id > 2 ", $newBDConnection) or die(mysql_error());  

while ($row = mysql_fetch_array($categoriesToPosts)) {
	$entryID = $row['post_id'];
	$categoryId = $row['category_id'];

	$tagID = $tagHash[$categoryId];
	$postID = $entriesHash[$entryID];

	$columns = "object_id, term_taxonomy_id";
	$values = "'" . $postID . "','" . $tagID . "'"; 
	$insertSQL = "INSERT INTO wp_term_relationships(" . $columns . ") VALUES (" . $values .  ")"; 
	mysql_query($insertSQL, $newBDConnection) or mysql_error();

}

mysql_close($oldBDConnection);
mysql_close($newBDConnection);


function clearTable($table, $index, $dbconn){
	$lastValidRecord = $index - 1;
	$tableIdentity = getIdentityForTable($table, $dbconn);
	mysql_query("DELETE FROM ". $table ." WHERE " . $tableIdentity . " > " . $lastValidRecord, $dbconn) or die(mysql_error());  
	mysql_query("ALTER TABLE ". $table ." AUTO_INCREMENT = " . $index, $dbconn) or die(mysql_error()); 
}

function getIdentityForTable($table, $dbconn){
	$idresult = mysql_query("select column_name from information_schema.columns where extra = 'auto_increment' and table_name = '". $table ."'", $dbconn) or die(mysql_error()); 

	$row = mysql_fetch_array($idresult);
	return $row['column_name'];

}


?>