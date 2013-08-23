<?php

if (!isset($include_contact)) {
    $include_contact = false;
}
if (!isset($page_title)) {
    $page_title = "Terrenceryan.com";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php echo $page_title;?></title>
	<link rel="alternate" type="application/rss+xml" title="RSS Feeds" href="http://feeds.feedburner.com/Terrenceryan" />
	<link rel="stylesheet" href="/assets/css/2013.css" type="text/css" media="screen" />
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
	<script type="text/javascript" src="//use.typekit.net/rbx8rox.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<?php if ($include_contact) {
			echo '<script type="text/javascript" src="/assets/js/jquery-1.8.0.min.js"></script>' , chr(10);
			echo chr(9),'<script type="text/javascript" src="/assets/js/contact.js"></script>';
			} ?>
</head>
<body>