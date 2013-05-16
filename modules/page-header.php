<?php



if (!isset($show_images)) {
    $show_images = true;
}
if (!isset($show_tagline)) {
    $show_tagline = true;
}

?>
<header class="page-header">
	<div class="title">
		<h1><a href="/">TerrenceRyan.com</a></h1>
		<?php if ($show_tagline) 
			echo '<p>I\'m a 36 year old web geek. &nbsp;<br class="hidetablet" />
			<span class="hidesmall">I live in Philly. &nbsp;<br class="hidetablet" /> 
			I\'m an Evangelist for <a href="/job">Adobe</a>. &nbsp;<br class="hidetablet" />
			I wrote <a href="/book">Driving Technical Change</a>. </span></p>' ?>
		
		
	</div>	
	<nav>
		<ul>
			<li>
				<a href="/about">
					<?php if ($show_images) echo '<img src="/assets/img/headshot.jpg" alt="Headshot of Terrence Ryan" />' ?>

					<span>About Me</span>
				</a>
			</li>
			<li>
				<a href="/book">
					<?php if ($show_images) echo '<img src="/assets/img/book.jpg" alt="Cover of Driving Technical Change" />' ?>
					
					<span>My Book</span>
				</a>
			</li>
		</ul>
	</nav>
</header>