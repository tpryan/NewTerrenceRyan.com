<?php $page_title="Sitemap - TerrenceRyan.com";  include '../modules/head.php';?>
<?php include '../modules/page-header.php';?>  


<div class="top-bar">
	<div class="page-title">
		<?php $active="sitemap"; include '../modules/nav.php';?>	
	</div>	
</div>

<div class="main">
	<h1>Site Map</h1>
	<article>
			
			<ul>
				<li><h2><a href="/">Home</a></h2>
					<ul>
						<li><a href="/about">About</a></li>
						<li><a href="/book">Book</a></li>
						<li><a href="/contact">Contact</a></li>
						<li><a href="/resume">Resume</a></li>
						<li><a href="/search">Search</a></li>
						<li>Sitemap</li>

					</ul>
				</li>
				<li><h2><a href="http://blog.terrenceryan.com">Blog</a></h2>
				
					<?php include '../modules/sitemap.php';?>
				</li>	
			</ul>
	</article>
</div>
<?php include '../modules/page-footer.php';?>
<?php include '../modules/google.php';?>
<?php include '../modules/foot.php';?>