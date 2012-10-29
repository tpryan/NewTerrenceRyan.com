<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>SiteMap - TerrenceRyan.com</title>
	<link rel="stylesheet" href="/assets/css/main.css" type="text/css" media="screen" />
	<script type="text/javascript" src="http://use.typekit.com/puk0eup.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>
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
				<li><a href="/about">About Me</a></li>
				<li><a href="/book">My Book</a></li>
			</ul>
		</nav>
	</div>	
	
</header>   

<div id="content">
	<section id="primary">
		<article>
			<h1>Site Map</h1>
			<ul>
				<li><h2><a href="/">Home</a></h2>
					<ul>
						<li><a href="/about">About</a></li>
						<li><a href="/book">Book</a></li>
						<li><a href="/contact">Contact</a></li>
						<li><a href="/job">Job</a></li>
						<li><a href="/search">Search</a></li>
						<li>Sitemap</li>

					</ul>
				</li>
				<li><h2><a href="http://blog.terrenceryan.com">Blog</a></h2>
					<?php include '../modules/sitemap.php';?>
				</li>	
			</ul>

		</article>		
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
<?php include '../modules/google.php';?>
</body>
</html>