<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!-- arcitc-mark-865 --->
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<h1>
				<span class="extra">My name is <strong><a href="/about" title="About Me">Terrence Ryan</a></strong>.</span>
				<span class="short">I'm <strong><a href="/about" title="About Me">Terry Ryan</a></strong>.</span> 
				<span class="extra">I&rsquo;m a <a href="/job" title="My Resume">geek from Philadelphia who loves technology</a>. </span>
				<span class="extra">I love evangelizing tools and tech that makes developers lives easier. </span> 
				<span class="short">I&rsquo;m an <a href="/job" title="My Resume">Technology lover</a>. </span> 
				I <span class="extra">also</span> wrote <a href="/book" title="My Book">Driving Technical Change</a>.
			</h1>


			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="/about">About</a></li>
						<li><a href="/resume">Resume</a></li>
						<li><a href="/book">Book</a></li>
						<li><a href="/blog" class="active">Blog</a></li>
						<li><a href="/contact">Contact</a></li>
					</ul>
					<?php get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
