<?php
/**
 * Theme: Flat Bootstrap
 * 
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package flat-bootstrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php do_action( 'before' ); ?>
	
	<header id="masthead" class="site-header" role="banner"><!-- page-header -->
		<div id="site-branding" class="site-branding">

		<?php
		// Get custom header image and determine its size
		if ( get_header_image() ) {
		?>
			<div class="custom-header-image" style="background-image: url('<?php echo header_image() ?>'); height: <?php echo get_custom_header()->height ?>px;">
			<div class="container">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' )?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div></div>
		<?php

		// If no custom header, then just display the site title and tagline
		} else {
		?>
			<div class="container">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' )?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		<?php
		} //endif get_header_image()
		?>			

		</div><!-- .site-branding -->

		<?php // Display the primary nav bar ?>	
		<nav id="site-navigation" class="main-navigation" role="navigation">

			<h1 class="menu-toggle sr-only screen-reader-text"><?php _e( 'Primary Menu', 'flat-bootstrap' ); ?></h1>
			<div class="skip-link"><a class="screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'flat-bootstrap' ); ?></a></div>

		<?php
		// Collapsed navbar menu toggle
		global $theme_options;
		$navbar = '<div class="navbar ' . $theme_options['navbar_classes'] . '">'
			.'<div class="container">'
        	.'<div class="navbar-header">'
          	.'<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">'
            .'<span class="icon-bar"></span>'
            .'<span class="icon-bar"></span>'
            .'<span class="icon-bar"></span>'
          	.'</button>';

		// Site title (Bootstrap "brand") in navbar. Hidden by default. Customizer will
		// display it if user turns of the main site title and tagline.
		//if ( ! display_header_text() ) {
			$navbar .= '<a class="navbar-brand" href="'
				.esc_url( home_url( '/' ) )
				.'" rel="home">'
				.get_bloginfo( 'name' )
				.'</a>';
		//}
		
        $navbar .= '</div><!-- navbar-header -->';

		// Display the desktop navbar
		$navbar .= wp_nav_menu( 
			array(  'theme_location' => 'primary',
			'container_class' => 'navbar-collapse collapse', //<nav> or <div> class
			'menu_class' => 'nav navbar-nav', //<ul> class
			'walker' => new wp_bootstrap_navwalker(),
			'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
			'echo'	=> false
			) 
		);
		echo apply_filters( 'xsbf_navbar', $navbar );
		?>

		</div><!-- .container -->
		</div><!-- .navbar -->
		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

	<?php // Display the page top (after header) widget area
		$sidebar_pagetop = get_dynamic_sidebar( 'Page Top' );
		if ( $sidebar_pagetop ) :
		?>
			<div id="sidebar-pagetop" class="sidebar-pagetop">
				<?php echo $sidebar_pagetop; ?>
			</div><!-- .sidebar-pagetop -->
		<?php endif; ?>
	<?php //endif;?>

	<?php // Set up the content area (but don't put it in a container) ?>	
	<div id="content" class="site-content">
