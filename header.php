<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Spider_Prime
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="container"><!--  Main Container -->
	
	<header class="style2"><!-- Header -->
	    <div class="navbar navbar-inverse navbar-fixed-top">
		    <div class="navbar-inner">
			    <div class="container">			    
				    	
			    	<div class="site-branding brand">
				    	<div class="sp-logo">
					    	<?php
	    						if ( function_exists( 'the_custom_logo' ) ) {
	    							the_custom_logo();
	    						}
	    					?>
			    			<h1 class="site-title">
			    				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			    					<?php bloginfo( 'name' ); ?>
			    				</a>
			    			</h1>
				    		<?php 					    		
				    			$description = get_bloginfo( 'description', 'display' );
				    			if ( $description || is_customize_preview() ) { ?>
				    			<p class="site-description"><?php echo $description; ?></p>
			    			<?php } ?>
			    		</div>
			    	</div><!-- .logo-->
					<div class="toggle-nav">
				    	<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			    		    <span class="icon-bar"></span>
			    		    <span class="icon-bar"></span>
			    		    <span class="icon-bar"></span>
			    	    </button>
			    	</div>
				    <div class="main-navigation">			    	    
				    	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>				  
				    </div><!-- .nav-collapse collapse -->
				    	
			    </div>
		    </div> <!-- .navbar-inner -->
	    </div>
	</header><!-- end header -->