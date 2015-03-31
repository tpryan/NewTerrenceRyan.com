<?php header("HTTP/1.0 404 Not Found");?>
<?php $page_title="404 - TerrenceRyan.com";  include '../modules/head.php';?>
<body>
<?php $show_images=false; $show_tagline=false;  include '../modules/page-header.php';?>  

<div class="top-bar">
	<div class="page-title">
		
		<?php include '../modules/nav.php';?>	
	</div>	
</div>
<div class="main error404">
	<h1>404</h1>
	<article>
		<div class="column full">
		<img src="//storage.googleapis.com/terrenceryan.com/img/hipster.jpg" class="picture" />
		<p>I know, you used to go to this page <em>all the time</em> back in the day. <Br />Then it got trendy, and over crowded
			with lame people who listen to Coldplay.  And now it's gone.  Gone!  All because you couldn't keep it a secret. 
			You have only yourself to blame.</p>
		<p>On a more helpful note, perhaps you should try a <a href="/search">search</a>, or start over again at the <a href="/">main page</a>.</p>
		</div>	
</article>
</div>
<?php include '../modules/page-footer.php';?>
<?php include '../modules/google.php';?>
<?php include '../modules/foot.php';?>