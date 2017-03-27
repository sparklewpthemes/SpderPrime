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
		add_image_size( 'spiderprime-banner-image', 1600, 480, true);
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
		add_theme_support( 'custom-logo', array(
			'height'      => 48,
			'width'       => 168,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( '.site-title', '.site-description' ),
		) );
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
		'name'          => esc_html__( 'Sidebar Widget Area', 'spiderprime' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'spiderprime' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area One', 'spiderprime' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'spiderprime' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Two', 'spiderprime' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'spiderprime' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Three', 'spiderprime' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'spiderprime' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area Four', 'spiderprime' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'spiderprime' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'spiderprime_widgets_init' );

/**
 * Enqueue scripts and styles.
*/
function spiderprime_scripts() {

		$spiderprime_theme = wp_get_theme();
		$theme_version = $spiderprime_theme->get( 'Version' );

		/* SpiderPrime Google Font */
		$spiderprime_font_args = array(
	        'family' => 'Noto+Sans:400,700|Open+Sans:400,600,700,300',
	    );
	    wp_enqueue_style('spiderprime-google-fonts', add_query_arg( $spiderprime_font_args, "//fonts.googleapis.com/css" ) );
		
	    /* SpiderPrime Font Awesome */
	    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/library/fontawesome/css/font-awesome.min.css', esc_attr( $theme_version ) );

	    /* SpiderPrime BootStrap */
	    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap.css', esc_attr( $theme_version ) );
	    wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/assets/library/bootstrap/css/bootstrap-responsive.css', esc_attr( $theme_version ) );        
	   
	    /*SpiderPrime Bxslider CSS*/
	   	wp_enqueue_style( 'jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/css/jquery.bxslider.min.css', esc_attr( $theme_version ) );

	   	/*SpiderPrime Flexslider CSS*/
	    wp_enqueue_style('jquery-flexslider', get_template_directory_uri() . '/assets/library/flexslider/css/flexslider.css', esc_attr( $theme_version ));

	    /*SpiderPrime PrettyPhoto CSS*/
	    wp_enqueue_style('prettyphoto', get_template_directory_uri() . '/assets/library/prettyphoto/css/prettyPhoto.css', esc_attr( $theme_version ));

	    /* SpiderPrime Main Style */
		wp_enqueue_style('spiderprime-style', get_stylesheet_uri() );
	 	wp_enqueue_style('spiderprime-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

 		/*SpiderPrime Bootstrap JS*/
 		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/library/bootstrap/js/bootstrap.min.js', array('jquery'), esc_attr( $theme_version ), true);
 		
 		/*SpiderPrime Flexslider*/
 		wp_enqueue_script('jquery-flexslider', get_template_directory_uri() . '/assets/library/flexslider/js/jquery.flexslider-min.js', array('jquery'), esc_attr( $theme_version ), true);
  	
  		/*SpiderPrime Bxslider*/
 		wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/assets/library/bxslider/js/jquery.bxslider.min.js', array('jquery'), esc_attr( $theme_version ), true);
  		
  		/*SpiderPrime PrettyPhoto*/
 		wp_enqueue_script('jquery-prettyphoto', get_template_directory_uri() . '/assets/library/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'), esc_attr( $theme_version ), true);
  		
  		/*SpiderPrime parallax*/
 		wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/library/parallax/js/parallax.min.js', array('jquery'), esc_attr( $theme_version ), true);

 		/* SpiderPrime Imagesloaded */
	    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/library/imagesloaded/js/imagesloaded.pkgd.min.js', array('jquery'), esc_attr( $theme_version ), true );

	    /* SpiderPrime html5 */
	    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/library/html5shiv/html5shiv.min.js', array('jquery'), esc_attr( $theme_version ), false);
	    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	    /* SpiderPrime Respond */
	    wp_enqueue_script('respond', get_template_directory_uri() . '/assets/library/respond/respond.min.js', array('jquery'), esc_attr( $theme_version ), false);
	    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

        /* SpiderPrime Theme Custom js */
	    wp_enqueue_script( 'spiderprime-prime', get_template_directory_uri() . '/assets/js/prime.js', array('jquery'), esc_attr( $theme_version ), true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
}
add_action( 'wp_enqueue_scripts', 'spiderprime_scripts' );

/**
 * Enqueue scripts & css in admin panel
*/
if ( ! function_exists( 'spiderprime_admin_styles' ) ) {
	function spiderprime_admin_styles() {
		wp_enqueue_style( 'spiderprime-admin-stylesheet', get_template_directory_uri().'/assets/css/admin-style.css');
	}
}
add_action( 'admin_enqueue_scripts', 'spiderprime_admin_styles', 10 );


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

/**
 * Load main hooks file
*/
require get_template_directory() . '/inc/hooks.php';

/**
 * Page and Post Page Display Layout Metabox function
*/
add_action('add_meta_boxes', 'spiderprime_metabox_section');
if ( ! function_exists( 'spiderprime_metabox_section' ) ) {
    function spiderprime_metabox_section(){   
        add_meta_box('spiderprime_display_layout', 
            esc_html__( 'Display Layout Options', 'spiderprime' ), 
            'spiderprime_display_layout_callback', 
            array('page','post'), 
            'normal', 
            'high'
        );
    }
}

$spiderprime_page_layouts =array(
    'leftsidebar' => array(
        'value'     => 'leftsidebar',
        'label'     => esc_html__( 'Left Sidebar', 'spiderprime' ),
        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png',
    ),
    'rightsidebar' => array(
        'value'     => 'rightsidebar',
        'label'     => esc_html__( 'Right (Default)', 'spiderprime' ),
        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png',
    ),
     'nosidebar' => array(
        'value'     => 'nosidebar',
        'label'     => esc_html__( 'Full width', 'spiderprime' ),
        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png',
    )
);

/**
 * Function for Page layout meta box
*/
if ( ! function_exists( 'spiderprime_display_layout_callback' ) ) {
    function spiderprime_display_layout_callback(){
        global $post, $spiderprime_page_layouts;
        wp_nonce_field( basename( __FILE__ ), 'spiderprime_settings_nonce' ); ?>
        <table>
            <tr>
              <td>            
                <?php
                  $i = 0;  
                  foreach ($spiderprime_page_layouts as $field) {  
                  $spiderprime_page_metalayouts = esc_attr( get_post_meta( $post->ID, 'spiderprime_page_layouts', true ) ); 
                ?>            
                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo intval( $i ); ?>" style="float:left; margin-right:30px;">
                    <label class="description">
                        <span>
                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </span></br>
                        <input type="radio" name="spiderprime_page_layouts" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_html( $field['value'] ), 
                            $spiderprime_page_metalayouts ); if( empty( $spiderprime_page_metalayouts ) && esc_html( $field['value'] ) =='rightsidebar' ){ echo "checked='checked'";  } ?>/>
                         <?php echo esc_html( $field['label'] ); ?>
                    </label>
                  </div>
                <?php  $i++; }  ?>
              </td>
            </tr>            
        </table>
    <?php
    }
}

/**
 * Save the custom metabox data
*/
if ( ! function_exists( 'spiderprime_save_page_settings' ) ) {
    function spiderprime_save_page_settings( $post_id ) { 
        global $spiderprime_page_layouts, $post; 
        if ( !isset( $_POST[ 'spiderprime_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'spiderprime_settings_nonce' ], basename( __FILE__ ) ) )
            return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;        
        if ('page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
                return $post_id;  
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
                return $post_id;  
        }    
        foreach ($spiderprime_page_layouts as $field) {  
            $old = esc_attr( get_post_meta( $post_id, 'spiderprime_page_layouts', true) ); 
            $new = sanitize_text_field($_POST['spiderprime_page_layouts']);
            if ($new && $new != $old) {  
                update_post_meta($post_id, 'spiderprime_page_layouts', $new);  
            } elseif ('' == $new && $old) {  
                delete_post_meta($post_id,'spiderprime_page_layouts', $old);  
            } 
         } 
    }
}
add_action('save_post', 'spiderprime_save_page_settings');