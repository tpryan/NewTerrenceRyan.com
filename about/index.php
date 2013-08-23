<!DOCTYPE html>
<html lang="en">
<?php $page_title="About - TerrenceRyan.com";  include '../modules/head.php';?>
<?php include '../modules/page-header.php';?>  


<div class="top-bar">
	<div class="page-title">
		<h1>About Me</h1>
	</div>	
</div>
<div class="main">
	
	<article>
		
		
		
		<div class="column bio">
			<h2>Current</h2>
			<img class="picture" src="/assets/img/headshot.jpg" >	
			<p>I'm a Worldwide Developer Evangelist for <a href="http://www.adobe.com/">Adobe</a>.  
			My job basically entails me traveling the world and 
			talking about the developer tools and technologies that Adobe has to offer or that we support. 
			To find out more, see about my <a href="/job">Job</a>. 
			</p>
			
			<p>I'm also the author of <em>Driving Technical Change.</em> It's about convincing reluctant co-workers 
			to adopt new tools and techniques.  To find out more, see about my <a href="/book">Book</a>. </p>
			<h2>Past</h2>
			<p>I went to University of Pennsylvania, and received a Bachelors of Art in Psychology.  While I was in school, I started 
			working in various Psychiatric clinical practices.  Gradually I shifted from psychological work to computing work. By the 
			time I got out of school, my desire to do psychology was gone, and there were tons of tech jobs available.</p>
			<p>I started out of school working at the Wharton School of Business. I moved from tech support to server admin to 
			system programmer to developer.  After 10 years there, I had done just about every technical job there is to do, and 
			decided programming was where I belonged. </p>
		</div>
		
		<div class="column">
			<h2>Site</h2>
			<h3>Front End</h3>
			<p>This is my third attempt at building a semantic HTML5 site.</p>
			<p>I use <a href="https://typekit.com/">Typekit</a> to render <a href="https://typekit.com/fonts/myriad-pro-condensed">Myriad Pro Condensed</a> 
			as a the header font and <a href="https://typekit.com/fonts/adobe-caslon-pro">Adobe Caslon Pro</a> for the copy font. </p>
		 
			
			<h3>Tools</h3>
			<ul>
			<li>I used <a href="http://browserlab.adobe.com">Browser Lab</a> to get the site working cross platform/browser.</li>	
			<li>The site was composed using <a href="http://www.adobe.com/products/fireworks/">Fireworks</a>.</li>
			<li>The responsive part of the site was planned using <a href="http://html.adobe.com/edge/reflow/">Adobe Edge Reflow</a>.</li>
			<li>The code was written using <a href="http://www.sublimetext.com/2">Sublime Text 2</a> 
				and <a href="http://www.brackets.io">Brackets</a>.</li>
			<li>I also used <a href="http://sass-lang.com/">Sass</a> to speed up my CSS work.</p>	
		 	</ul>
	 	</div>
	 	<div class="column contact">
	 		<h2>Social Networks</h2>
			<table id="socialnetworks">
				<tr>
					<td class="username"><a href="http://www.facebook.com/terry.ryan" title="Facebook | Terrence Ryan">Terry.Ryan</a> </td>
					<td>
						<a href="http://www.facebook.com/terry.ryan" title="Facebook | Terrence Ryan">
							<img src="/assets/img/facebookicon.png" height="55" width="116" alt="Facebook" />
						</a>
					</td>
				</tr>
				
				<tr>
					<td class="username"><a href="http://twitter.com/tpryan" title="Twitter / tpryan">tpryan</a> </td>
					<td>
						<a href="http://twitter.com/tpryan" title="Twitter / tpryan">
							<img src="/assets/img/twitter.png" height="55" width="155" alt="Twitter" class="twitter" />
						</a>
					</td>
				</tr>
				
				<tr>
					<td class="username"><a href="http://www.linkedin.com/in/terrencepryan" title="LinkedIn: Terrence Ryan">TerrencePRyan</a> </td>
					<td>
						<a href="http://www.linkedin.com/in/terrencepryan" title="LinkedIn: Terrence Ryan">
						<img src="/assets/img/linkedin-icon.png" height="35" width="121" alt="LinkedIn" />
					</a>	
					</td>
				</tr>
				
				<tr>
					<td class="username"><a href="https://github.com/tpryan" title="github: Terrence Ryan">tpryan</a> </td>
					<td>
						<a href="https://github.com/tpryan" title="github: Terrence Ryan">
						<img src="/assets/img/githublogo.png" height="45" width="100" alt="github" />
					</a>	
					</td>
				</tr>
			
			</table>
	 		<h2>Drop me an email</h2>
			<p id="response">Use form to send email. </p>
			<form name="contact_form" id="contact_form" action="process.php" method="post" >
				<label for="name">Name:</label><br />
				<input name="name" type="text" maxlength="128"  id="name"  size="50"  /><br />
				<label for="email">Email:</label><br />
				<input name="email" type="email" maxlength="128"  id="email"  size="50"  /><br />
				<label for="text">Message:</label><br />
				<textarea name="text" rows="7" columns="50" cols="23" id="text" ></textarea><br />
				<input name="Submit" type="submit" value="Submit" class="submit" id="submit" /><br />
			</form>		
	 	</div>	
	</article> 	
</div>
<?php include '../modules/page-footer.php';?>
<?php include '../modules/google.php';?>
</body>
</html>