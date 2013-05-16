<!DOCTYPE html>
<html lang="en">
<?php $page_title="Site Map - TerrenceRyan.com";  include '../modules/head.php';?>
<body class="sub-page">
<?php $show_images=false; $show_tagline=false;  include '../modules/page-header.php';?>  

<div class="content">
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

</div>
<?php include '../modules/page-footer.php';?>
<?php include '../modules/google.php';?>
</body>
</html>