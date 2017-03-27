<?php
/**
 * Spider Prime functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Spider_Prime
 */

if ( ! function_exists( 'spiderprime_setup' ) ) {
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
	function spiderprime_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Spider Prime, use a find and replace
		 * to change 'spiderprime' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'spiderprime', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'spiderprime-blog', 370, 305, true);
		add_image_size( 'spiderprime-team', 270, 230, true);
		add_image_size( 'spiderprime-archive', 770, 430, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'spiderprime' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'spiderprime_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		/*
		 * Enable support for custom logo.
		 */
		add_image_size( 'spiderprime-logo', 168, 48 );
		add_theme_support( 'custom-logo', array( 'size' => 'spiderprime-logo' ) );

	}
}
add_action( 'after_setup_theme', 'spiderprime_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spiderprime_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spiderprime_content_width', 640 );
}
add_action( 'after_setup_theme', 'spiderprime_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spiderprime_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Left Side Widget Area', 'spiderprime' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Right Side Widget Area', 'spiderprime' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
        'name' => 'Footer Widget Area One',
        'id' => 'footerone',
        'before_widget' => '<li id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

    register_sidebar( array(
        'name' => 'Footer Widget Area Two',
        'id' => 'footertwo',
        'before_widget' => '<li id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

    register_sidebar( array(
        'name' => 'Footer Widget Area Three',
        'id' => 'footerthree',
        'before_widget' => '<li id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

    register_sidebar( array(
        'name' => 'Footer Widget Area Four',
        'id' => 'footerfour',
        'before_widget' => '<li id="%1$s" class="widget %2$s clearfix">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

}
add_action( 'widgets_init', 'spiderprime_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function spiderprime_scripts() {

	$font_args = array(
        'family' => 'Noto+Sans:400,700',
    );
    wp_enqueue_style('google-fonts', add_query_arg($font_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-responsive.css');
    wp_enqueue_style('jquery-bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css');
    wp_enqueue_style('jquery-flexslider', get_template_directory_uri() . '/css/flexslider.css');
    wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
	wp_enqueue_style('spiderprime-style', get_stylesheet_uri() );
 	wp_enqueue_style('spiderprime-responsive', get_template_directory_uri() . '/css/responsive.css');
	
	wp_enqueue_script('jquery');
 	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
 	wp_enqueue_script( 'jquery-imagesloaded-min', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array(), '1.0.0', true );
 	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '1.0.0', true );
 	wp_enqueue_script( 'jquery-bxslider-min', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array(), '1.0.0', true );
 	wp_enqueue_script( 'jquery-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), '1.0.0', true );
 	wp_enqueue_script( 'parallax-min', get_template_directory_uri() . '/js/parallax.min.js', array(), '1.0.0', true );
 	wp_enqueue_script( 'spiderprime-prime', get_template_directory_uri() . '/js/prime.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'spiderprime_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Customizer Control Class file
 */
require get_template_directory() . '/inc/class-repeater.php';
