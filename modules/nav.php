<?php

if (!isset($active)) {
    $active = false;
}

?>

<nav>
	<ul>
		<li><a href="/"<?php if ($active == "home") {echo ' class="active"';} ?>>Home</a></li>
		<li><a href="/about"<?php if ($active == "about") {echo ' class="active"';} ?>>About</a></li>
		<li><a href="/job"<?php if ($active == "job") {echo ' class="active"';} ?>>Job</a></li>
		<li><a href="/book"<?php if ($active == "book") {echo ' class="active"';} ?>>Book</a></li>
		<li><a href="/blog">Blog</a></li>
	</ul>
</nav>	