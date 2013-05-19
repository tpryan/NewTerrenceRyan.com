<!DOCTYPE html>
<html lang="en">
<?php $include_contact=true; $page_title="Contact - TerrenceRyan.com";  include '../modules/head.php';?>
<body class="sub-page">
<?php $show_images=false; $show_tagline=false;  include '../modules/page-header.php';?> 

<div class="content">
	<article>
	<h1>Contact Me</h1>
	<p>Looking to drop me a line?  Best way is probably on Twitter. Email is a giant black 
		hole for me, but I will get back to you eventually. </p>

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
	<br />

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
			
		
			
	</article>
	 
</div>
<?php include '../modules/page-footer.php';?>
<?php include '../modules/google.php';?>
</body>
</html>