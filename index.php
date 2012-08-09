<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>TerrenceRyan.com</title>
	<link rel="stylesheet" href="/assets/css/main.css" type="text/css" media="screen" />
	<script type="text/javascript" src="http://use.typekit.com/puk0eup.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body id="home">
<header>
	<div id="masthead">
		<hgroup>
			<h1><a href="/">TerrenceRyan.com</a></h1>
			<p>I'm a 35 year old redhead geek from Philly. <br /> 
				<span class="hidesmall">I'm an Evangelist for <a href="/job">Adobe</a>.<br />
				Also wrote <a href="/book">Driving Technical Change</a></span>
			</p>
		</hgroup>	
		<nav>
			<ul>
				<li>
					<a href="/about">
						<img src="/assets/img/headshot.jpg" width="160" height="230" alt="Headshot of Terrence Ryan" />
						<span>About Me</span>
					</a>
				</li>
				<li>
					<a href="/book">
						<img src="/assets/img/book.jpg" width="160" height="230" alt="Cover of Driving Technical Change" />
						<span>My Book</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>	
	
</header>   

<div id="content">
	<section id="primary">		
		<section>
			<h1><a href="/blog">I Write</a></h1>
			 
			<?php include './modules/blog.php';?>
				
			<p class="externalref">View more on <a href="http://blog.terrenceryan.dev">my blog</a>.</p>
		</section>
		<hr />
		<section>
			<h1><a href="http://lanyrd.com/profile/tpryan/">I Speak</a></h1>

			<?php include './modules/events.php';?>

			<p class="externalref">View more on <a href="http://lanyrd.com/profile/tpryan/">lanyrd.com</a></p>
		</section>
	</section>				
	<hr />
	<section id="secondary">	
		<section>
			<h1><a href="https://github.com/tpryan">I Code</a></h1>

			<?php include './modules/projects.php';?>

			<p class="externalref">View more on <a href="https://github.com/tpryan">github.com</a>.</p>
		</section>
		<hr />
		<section>
			<h1><a href="http://www.slideshare.net/tpryan/">I Present</a></h1>

			<?php include './modules/presos.php';?>

			<p class="externalref">View more on <a href="http://www.slideshare.net/tpryan/">slideshare.com</a>.</p>
		</section>
	</section>	
</div>
<footer>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/sitemap">Sitemap</a></li>      
			<li><a href="/search">Search</a></li>
			<li><a href="/contact">Contact</a></li>
		</ul>
	</nav>
	<small id="copyright">Copyright 2008 - 2012 Terrence Ryan</small>
	<small id="disclaimer">This is a personal blog. While Adobe paying my salary might 
	not make me completely  objective, the opinions expressed here are mine and not theirs.</small>
</footer>
</body>
</html>