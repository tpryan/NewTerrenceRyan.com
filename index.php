<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>TerrenceRyan.com</title>
	<link rel="stylesheet" href="/assets/css/main.css" type="text/css" media="screen" />
	<!--<script type="text/javascript" src="http://use.typekit.com/puk0eup.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->
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
			 
			<?php 
				include './import/creds.php';
				include './modules/blog.php';
			?>
				
			<p class="externalref">View more on <a href="http://blog.terrenceryan.dev">my blog</a>.</p>
		</section>
		<hr />
		<section>
			<h1><a href="http://lanyrd.com/profile/tpryan/">I Speak</a></h1>

			<article>
				<h1><a href="http://lanyrd.com/2012/devcon-5-july/">DevCon 5</a></h1>
				<time>July 23 - 24</time>
				<address>New York, United States</address>
				<p>HTML5 Designer's and Developer's Conference</p>
			</article>

			<article>
				<h1><a href="http://lanyrd.com/2012/an-event-apart-dc/">An Event Apart DC 2012</a></h1>
				<time>August 6 - 7</time>
				<address>Alexandria, United States</address>
				<p>Three days of design\, code\, and content for people who make websites.</p>
			</article>

			<article>
				<h1><a href="http://lanyrd.com/2013/adobe-max/">Adobe MAX</a></h1>
				<time>May 4 - 8</time>
				<address>Los Angeles, United States</address>
			</article>

			<p class="externalref">View more on <a href="http://lanyrd.com/profile/tpryan/">lanyrd.com</a></p>
		</section>
	</section>				
	<hr />
	<section id="secondary">	
		<section>
			<h1><a href="https://github.com/tpryan">I Code</a></h1>

			<article>
				<h1><a href="https://api.github.com/repos/tpryan/brackets">brackets</a></h1>
				<p>An open source code editor for the web, written in JavaScript, HTML and CSS.</p>
			</article>

			<article>
				<h1><a href="https://api.github.com/repos/tpryan/brackets-phonegapbuild">brackets-phonegapbuild</a></h1>
				<p>Brackets Extension for interacting with PhoneGap Build</p>
			</article>

			<article>
				<h1><a href="https://api.github.com/repos/tpryan/DevCon-5-Mobile-Schedule">DevCon-5-Mobile-Schedule</a></h1>
				<p>A Mobile Schedule for DevCon 5 </p>
			</article>

			<p class="externalref">View more on <a href="https://github.com/tpryan">github.com</a>.</p>
		</section>
		<hr />
		<section>
			<h1><a href="">I Present</a></h1>

			<article>
				<h1><a href="http://www.slideshare.net/tpryan/edge-13047885">The Future of HTML Motion Design</a></h1>
				<p>Talk about Adobe's plans for HTML motion.  Talk about the present with Adobe Edge and the future with potential Adobe contributions to Webkit.</p>
			</article>

			<article>
				<h1><a href="http://www.slideshare.net/tpryan/skip-the-ide-with-phonegap-build">Skip the IDE with PhoneGap Build</a></h1>
				<p>Tour through the options around automating PhoneGap Build so that you can install applications during development easily with a smart workflow.</p>
			</article>

			<article>
				<h1><a href="http://www.slideshare.net/tpryan/d2wc-keynote">D2WC Keynote</a></h1>
				<p>An explanation of where Adobe sees developers and designers coming together in the modern world of HTML development. </p>
			</article>

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
			<li><a href="/about">Contact</a></li>
		</ul>
	</nav>
	<small id="copyright">Copyright 2008 - 2012 Terrence Ryan</small>
	<small id="disclaimer">This is a personal blog. While Adobe paying my salary might 
	not make me completely  objective, the opinions expressed here are mine and not theirs.</small>
</footer>
</body>
</html>