<?php $page_title="Contact - TerrenceRyan.com"; $include_contact= true;  include '../modules/head.php';?>
<?php include '../modules/page-header.php';?>  


<div class="top-bar">
	<div class="page-title">
		
		<?php $active="contact"; include '../modules/nav.php';?>	
	</div>

</div>
<div class="main">
	<h1>Contact</h1>
	<article>
		
		
		
		<div class="column half">
			<h2>Drop me an email</h2>
			<p id="response">Use form to send email. </p>
			<form name="contact_form" id="contact_form" action="/contact/process.php" method="post" >
				<label for="name">Name:</label><br />
				<input name="name" type="text" maxlength="128"  id="name"  size="50" required   /><br />
				<label for="email">Email:</label><br />
				<input name="email" type="email" maxlength="128"  id="email"  size="50" required /><br />
				<label for="text">Message:</label><br />
				<textarea name="text" rows="7" columns="50" cols="23" id="text" ></textarea><br />
				<input name="Submit" type="submit" value="Submit" class="submit" id="submit" /><br />
			</form>		
		</div>
		
		
	 	<div class="column half">
	 		<h2>Social Networks</h2>
			<ul id="socialnetworks">
				<li>
                    <a href="http://www.facebook.com/terry.ryan" title="Facebook | Terrence Ryan">
                        <img src="/assets/img/facebookicon.png" height="55" width="116" alt="Facebook" />
                    </a>
                </li>
            
                <li>
                    <a href="http://twitter.com/tpryan" title="Twitter / tpryan">
                        <img src="/assets/img/twitter.png" height="55" width="155" alt="Twitter" class="twitter" />
                    </a>
                </li>
                <li>
                    <a href="http://twitter.com/tpryan" title="Lanyrd / tpryan">
                        <img src="/assets/img/lanyrd.png" height="36" width="150" alt="Lanyrd" class="lanyrd" />
                    </a>
                </li>
                <li>
                    <a href="http://www.linkedin.com/in/terrencepryan" title="LinkedIn: Terrence Ryan">
                    <img src="/assets/img/linkedin-icon.png" height="35" width="121" alt="LinkedIn" />
                </a>	
                </li>
                <li>
                    <a href="https://github.com/tpryan" title="github: Terrence Ryan">
                    <img src="/assets/img/githublogo.png" height="45" width="100" alt="github" />
                </a>	
                </li>
                <li>
                    <a href="http://www.behance.net/tpryan" title="Behance: Terrence Ryan">
                    <img src="/assets/img/behance.png" height="56" width="150" alt="behance" />
                </a>	
                </li>
			
			</ul>
	 		
	 	</div>

	</article> 	
</div>
<?php include '../modules/page-footer.php';?>
<?php include '../modules/google.php';?>
<?php include '../modules/foot.php';?>