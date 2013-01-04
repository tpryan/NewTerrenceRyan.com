<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Contact - TerrenceRyan.com</title>
	<link rel="stylesheet" href="/assets/css/main.css" type="text/css" media="screen" />
	<script type="text/javascript" src="http://use.typekit.com/puk0eup.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<script type="text/javascript" src="/assets/js/jquery-1.8.0.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
				$('#submit').click(handleEmail);
		});	

		function handleEmail(){
			event.preventDefault();
			
			var name = $("#name").val();
			var mail = $("#email").val();
			var text = $("#text").val();

			var datastr ='name=' + name + '&email=' + mail + '&text=' + text;
			send(datastr);
			$("#submit").attr("disabled", "disabled");
			return false;
		}


		function send(datastr){
			$.ajax({
				type: "POST",
				url: "process.php",
				data: datastr,
				cache: false, 
				success: handleSuccess,
				failure: handleFailure
				});
		}

		function handleSuccess(e){
			$("#response").addClass("alert");
			$("#response").addClass("delay");
			$("#response").html("Your mail is on it's way.");
			setTimeout(makeAlertFade, 2000);
		}
		function makeAlertFade(){
			$("#response").addClass("alertclear");
		}

		function handleFailure(e){
			alert("failure.");
		}

	</script>
</head>
<body id="contact">
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