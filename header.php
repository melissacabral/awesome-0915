<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php 
	echo esc_url( get_stylesheet_directory_uri() ) ?>/styles/reset.css" />
	<?php 
	//Necessary in <head> for JS and plugins to work. 
	//I like it before style.css loads so the theme stylesheet is more specific than all others.
	wp_head();  ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
</head>
<body <?php body_class(); ?> >	
	<div id="wrapper">
	<header role="banner">
		<div class="top-bar clearfix">
			<h1 class="site-name">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home"> 
					<?php bloginfo('name'); ?> 
				</a>
			</h1>
			<h2 class="site-description"> <?php bloginfo('description'); ?> </h2>
			
			<?php wp_nav_menu( array(
				'theme_location'	=>	'main_nav',	 //registered in functions.php
				'container'			=> 	'nav',		 //wrap in <nav> tag
				'fallback_cb'		=> 	'',			 //turn off the menu if not set
			) ); ?>

		</div><!-- end .top-bar -->
		
		<?php wp_nav_menu( array(
			'theme_location'	=>  'utilities', 	//registered in functions.php
			'fallback_cb'		=> 	'',				//no fallback behavior
			'menu_class'		=> 	'utilities',	//<ul class="utilities">
			'container'			=> 	false,			//no div or nav container
		) ); ?>

		<?php get_search_form(); //includes searchform.php if it exists, if not, this outputs the default search bar ?>	
	</header>