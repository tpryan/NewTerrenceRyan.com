<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>TerrenceRyan.com</title>
	<link rel="alternate" type="application/rss+xml" title="RSS Feeds" href="http://feeds.feedburner.com/Terrenceryan" />
	<link rel="stylesheet" href="/assets/css/2013.css" type="text/css" media="screen" />
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
	<script type="text/javascript" src="//use.typekit.net/rbx8rox.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>

	<header>
		<h1><span class="extra">My name is <strong><a href="/">Terrence Ryan</a></strong>.</span>
			<span class="short">I'm <strong><a href="/">Terry Ryan</a></strong>.</span> 
			<span class="extra">I&rsquo;m an <a href="">Education Evangelist</a> for <em>Adobe</em>. </span> 
			<span class="short">I&rsquo;m an <a href=""><em>Adobe</em> Education Evangelist</a>. </span> 
			<span class="extra">I help students &amp; educators create with our software.</span> I <span class="extra">also</span> wrote <a href="">Driving Technical Change</a>.</h1>
	</header>
	<div class="tweet-bar">
		<div class="tweet">
			<div class="icon">&#62217;</div>
			<?php include './modules/twitter.php';?>
		</div>
	</div>

	<div class="main">
		<div class="design column">
			<h2><a href="http://www.behance.net/tpryan">Design <span class="icon">&#62286;</span></a></h2>
			<?php include './modules/behance.php';?>
			<p class="externalref">View more on <a href="http://www.behance.net/tpryan">Behance.com</a>.</p>
		</div>	
		<div class="code column">
			<h2><a href="https://github.com/tpryan">Code <span class="icon">&#62208;</span></a></h2>
			<?php include './modules/projects.php';?>
			<p class="externalref">View more on <a href="https://github.com/tpryan">github.com</a>.</p>
		</div>
		<div class="blog column">
			<h2><a href="http://blog.terrenceryan.com">Blog <span class="icon">&#59194;</span></a></h2>
			<?php include './modules/blog.php';?>
			<p class="externalref">View more on <a href="http://blog.terrenceryan.com">my blog</a>.</p>
		</div>
		<div class="events column">
			<h2><a href="http://lanyrd.com/profile/tpryan/">Events <span class="icon">&#128197;</span></a></h2>
			<?php include './modules/events.php';?>
			<p class="externalref">View more on <a href="http://lanyrd.com/profile/tpryan/">lanyrd.com</a></p>
		</div>
	</div>		

	<footer>
		<p class="copyright">Copyright 2008 - 2013 &nbsp;<strong>Terrence Ryan</strong></p>
		<small class="disclaimer">This is a personal site. While Adobe paying my salary might 
		not make me completely  objective, the opinions expressed here are mine and not theirs.</small>
	</footer>
	<?php include './modules/google.php';?>
</body>
</html>