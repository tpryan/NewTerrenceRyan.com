<!DOCTYPE html>
<html lang="en">
<?php $page_title="TerrenceRyan.com";  include './modules/head.php';?>
<body id="home">
<?php include './modules/page-header.php';?>

<div class="content">
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
<?php include './modules/page-footer.php';?>
<?php include './modules/google.php';?>
</body>
</html>