<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>TerrenceRyan.com</title>
	<link rel="alternate" type="application/rss+xml" title="RSS Feeds" href="http://feeds.feedburner.com/Terrenceryan" />
	<link rel="stylesheet" href="/assets/css/main.css" type="text/css" media="screen" />
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
	<script type="text/javascript" src="http://use.typekit.com/puk0eup.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body id="home">
<header>
	<div id="masthead">
		<hgroup>
			<h1><a href="/">TerrenceRyan.com</a></h1>
			<h2>I'm a 36 year old web geek <br /> 
				<span class="hidesmall">I live in Philly. <br /> 
				I'm an Evangelist for <a href="/job">Adobe</a>.<br />
				Wrote <a href="/book">Driving Technical Change</a></span>
			</h2>
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
			<h1><a href="http://blog.terrenceryan.com">I Write</a></h1>
			 
			<?php include './modules/blog.php';?>
				
			<p class="externalref">View more on <a href="http://blog.terrenceryan.com">my blog</a>.</p>
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
			<!-- <h1><a href="http://www.slideshare.net/tpryan/">I Present</a></h1> -->
			<?php //include './modules/presos.php';?>
			<!-- <p class="externalref">View more on <a href="http://www.slideshare.net/tpryan/">slideshare.com</a>.</p> -->
			<h1>I Present</h1>
			<article>
				<h1><a href="/max/2013/programmingcss/preso">Max 2013 Programming CSS</a></h1>
				<p>An Adobe MAX 2013 presentation about programming topics in CSS.</p>
			</article>	
			<article>
				<h1><a href="/max/2013/practical/preso">Max 2013 Practical CSS</a></h1>
				<p>An Adobe MAX 2013 presentation about creating interfaces entirely in CSS.</p>
			</article>
			<article>
				<h1><a href="/createtheweb">Create The Web</a></h1>
				<p>A series of presentations about Adobe Edge Tools &amp; Services..</p>
			</article>		

			
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
<?php include './modules/google.php';?>
</body>
</html>