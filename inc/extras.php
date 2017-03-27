<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Spider_Prime
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function spiderprime_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'spiderprime_body_classes' );


/**
 * Enqueue scripts & css in admin panel
**/
if ( ! function_exists( 'spiderprime_slider_section' ) ) {
	function spiderprime_slider_section() { ?>
		<div id="slider" class="slider2">
			<div class="flexslider">
			    <ul class="slides">
				    <?php
				        $slider_cat_id = intval( get_theme_mod( 'spiderprime_slider_team_id'));
				        if( !empty( $slider_cat_id ) ) {
				        $slider_args = array(
				            'post_type' => 'post',
				            'tax_query' => array(
				                array(
				                    'taxonomy'  => 'category',
				                    'field'     => 'id', 
				                    'terms'     => $slider_cat_id                                                                 
				                )),
				            'posts_per_page' => 8
				        );

				        $slider_query = new WP_Query( $slider_args );
				        if( $slider_query->have_posts() ) { while( $slider_query->have_posts() ) { $slider_query->the_post();
				        $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'spiderprime-banner-image', true );                           
				    ?>				    
					   	<li><!-- Slider  list item-->
					   	    <img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image_path[0] ); ?>" />
					   	    <div class="flex-caption">
					   	    	<div class="container">
					   	    		<div class="caption-adjust">
										<h1><?php the_title(); ?></h1>
										<p><?php the_content(); ?></p>										
									</div>
								</div>
					   	    </div>
					   	</li>
					<?php } } wp_reset_postdata();  } ?>
			    </ul>
		    </div>
		    <div class="arrow-pagin">
			    <div class="container">
					<a href="#" class="prev-slide"></a>
					<a href="#" class="next-slide"></a>
				</div>
		    </div>
		</div><!-- End Slider -->
	 <?php 
	}
}
add_action('spiderprime_slider','spiderprime_slider_section');


/**
 * Spider Prime Banner of Every Page
*/
if ( ! function_exists( 'spiderprime_banner_section_breadcrumb' ) ) {
	function spiderprime_banner_section_breadcrumb(){
		$breadcrumb_bg_img = esc_url( get_theme_mod('spiderprime_breadcrumbs_bg_image') );
		$breadcrumb_bg_color = esc_attr(get_theme_mod('spiderprime_breadcrumbs_background_color','#8248ac'));
		$breadcrumb_bg_font_color = esc_attr(get_theme_mod('spiderprime_breadcrumbs_font_color','#fff'));
		$breadcrumb_section_height = intval(get_theme_mod('spiderprime_breadcrumbs_min_height_options','250'));
		if(!empty($breadcrumb_bg_img)) {
			$bg = "background:url(".esc_url( $breadcrumb_bg_img ).");";
		}else {
			$bg = "background:".$breadcrumb_bg_color.";";
		}
		$breadcrumbs_settings =  "background-size:cover; color :". $breadcrumb_bg_font_color ."; ". $bg ." height:". intval( $breadcrumb_section_height ) ."px;";
	 ?>
		<div class="banner about-banner" style="<?php echo esc_attr( $breadcrumbs_settings ); ?>">
			<div class="container">
				<?php if( is_search() ) { ?>
					<h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'spiderprime' ), '<span style="background:#8248ac;">' . get_search_query() . '</span>' ); ?></h1>
					<?php
						$breadcrumbs_menu = intval( get_theme_mod('spiderprime_breadcrumbs_menu', 1 ) );
						if(!empty( $breadcrumbs_menu ) == 1 ){
							spiderprime_breadcrumbs();
						}
					?>
				<?php }else if( is_404() ) { 
						echo '<h1 class="entry-title">'.esc_html__('404','spiderprime').'</h1>';
						$breadcrumbs_menu = intval( get_theme_mod('spiderprime_breadcrumbs_menu', 1 ) );
						if(!empty( $breadcrumbs_menu ) == 1 ){
							spiderprime_breadcrumbs();
						}
				    }else if( is_archive() ) { 
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						$breadcrumbs_menu = intval( get_theme_mod('spiderprime_breadcrumbs_menu', 1 ) );
						if(!empty( $breadcrumbs_menu ) == 1 ){
							spiderprime_breadcrumbs();
						}
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					
					}else { 
						the_title( '<h1 class="entry-title">', '</h1>' ); 
						$breadcrumbs_menu = intval( get_theme_mod('spiderprime_breadcrumbs_menu', 1 ) );
						if(!empty( $breadcrumbs_menu ) == 1 ){
							spiderprime_breadcrumbs();
						}
				    } 
				?>
			</div>
		</div>
	<?php
	}
}
add_action('spiderprime_breadcrumb','spiderprime_banner_section_breadcrumb');


/**
 * Comment Callback function
*/
if ( ! function_exists( 'spiderprime_comment' ) ) {
    function spiderprime_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div class="comment-wrapper media" id="comment-<?php comment_ID(); ?>">
                <a href="javascript();" class="pull-left">
                  <?php echo get_avatar($comment, $size='100'); ?>
                </a>
                <?php if ($comment->comment_approved == '0') : ?>
                     <em><?php esc_html_e('Your comment is awaiting moderation.','spiderprime') ?></em>                
                <?php endif; ?>
                <div class="media-body">
                    <div>
                    	<h4 class="media-heading"><?php echo esc_attr(get_comment_author()); ?></h4>
                        <div class="prorow">
                            <div class="comment-left">
                                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                      <?php printf(esc_attr__('%1$s at %2$s','spiderprime'), get_comment_date(),  get_comment_time()) ?>
                    </a>
                    <?php comment_text() ?>
                </div>
            </div>
        </li>
        <?php
    }
}


/**
* Spider Prime Breadcrumbs Function Section
*/
if ( ! function_exists( 'spiderprime_breadcrumbs' ) ) {
	function spiderprime_breadcrumbs() {
		global $post;
    	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    	$delimiter = '/';    
    	$home = esc_html__('Home', 'spiderprime'); // text for the 'Home' link
    	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    	$before = '<span class="current">'; // tag before the current crumb
    	$after = '</span>'; // tag after the current crumb
    	$homeLink = esc_url( home_url() );

    	if (is_home() || is_front_page()) {
	    	if ($showOnHome == 1)
	    		echo '<div id="spiderprime-breadcrumb"><a href="' . esc_url($homeLink) . '">' . esc_attr($home) . '</a></div></div>';
	    } else {
    			echo '<div id="spiderprime-breadcrumb"><a href="' . esc_url($homeLink) . '">' . esc_attr($home) . '</a> ' . esc_attr($delimiter) . ' ';
	    	if (is_category()) {
	    		$thisCat = get_category( get_query_var('cat') , false);
	    		if ($thisCat->parent != 0)
	    			echo get_category_parents($thisCat->parent, TRUE, ' ' . esc_attr($delimiter) . ' ');
	    		echo esc_html__('Archive by category','spiderprime').' "' . single_cat_title('', false) . '" ';
	    	} elseif (is_search()) {
	    		echo esc_html__('Search results for','spiderprime'). '"' . get_search_query() . '"';
	    	} elseif (is_day()) {
	    		echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
	    		echo '<a href="' . esc_url(get_month_link(get_the_time('Y')), esc_attr(get_the_time('m'))) . '">' . esc_attr(get_the_time('F')) . '</a> ' . esc_attr($delimiter) . ' ';
	    		echo esc_attr(get_the_time('d'));
	    	} elseif (is_month()) {
	    		echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
	    		echo esc_attr(get_the_time('F'));
	    	} elseif (is_year()) {
	    		echo esc_attr(get_the_time('Y'));
	    	} elseif (is_single() && !is_attachment()) {
	    		
	    		if (get_post_type() != 'post') {
	    			$post_type = get_post_type_object(get_post_type());
	    			$slug = $post_type->rewrite;
	    			echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . $post_type->labels->singular_name . '</a>';
	    			if ($showCurrent == 1)
	    				echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_attr(get_the_title()) . $after;
	    		} else {
	    			$cat = get_the_category();
	    			$cat = $cat[0];
	    			$cats = get_category_parents($cat, TRUE, ' ' . esc_attr($delimiter) . ' ');
	    			if ($showCurrent == 0)
	    				$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	    			echo sprintf( $cats );
	    			if ($showCurrent == 1)
	    				echo esc_attr(get_the_title());
	    		}

	    	} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
	    		$post_type = get_post_type_object(get_post_type());
	    		echo esc_attr($post_type->labels->singular_name);
	    	} elseif (is_attachment()) {
	    		$parent = get_post($post->post_parent);
	    		$cat = get_the_category($parent->ID);
	    		$cat = $cat[0];
	    		echo get_category_parents($cat, TRUE, ' ' . esc_attr($delimiter) . ' ');
	    		echo '<a href="' . esc_url(get_permalink($parent)) . '">' . esc_attr($parent->post_title) . '</a>';
	    		if ($showCurrent == 1){
	    			echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_attr(get_the_title()) . $after;
	    		}
	    	} elseif (is_page() && !$post->post_parent) {
	    		if ($showCurrent == 1){
	    			echo esc_attr(get_the_title());
	    		}
	    	} elseif (is_page() && $post->post_parent) {
	    		$parent_id = $post->post_parent;
	    		$breadcrumbs = array();
	    		while ($parent_id) {
	    			if(!empty($parent_id)){
		    			$page = (object) get_posts($parent_id)[0];
		    			$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_attr(get_the_title($page->ID)) . '</a>';
		    			$parent_id = $page->post_parent;
		    		}
	    		}
	    		$breadcrumbs = array_reverse($breadcrumbs);
	    		for ($i = 0; $i < count($breadcrumbs); $i++) {
	    			echo sprintf( $breadcrumbs[$i] );
	    			if ($i != count($breadcrumbs) - 1)
	    				echo ' ' . $delimiter . ' ';
	    		}
	    		if ($showCurrent == 1){
	    			echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_attr(get_the_title()) . $after;
	    		}
	    	} elseif (is_tag()) {
	    		echo esc_html__('Posts tagged','spiderprime').' "' . single_tag_title('', false) . '"';
	    	} elseif (is_author()) {
	    		global $author;
	    		$userdata = get_userdata($author);
	    		echo esc_html__('Articles posted by ','spiderprime'). esc_attr($userdata->display_name);
	    	} elseif (is_404()) {
	    		echo esc_html__('Error 404','spiderprime');
	    	}

	    	if (get_query_var('paged')) {
	    		if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()){
	    			echo ' (';
	    			echo esc_html__('Page', 'spiderprime') . ' ' . get_query_var('paged');
	    		}
	    		if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()){
	    					echo ')';
				}
			}

			echo '</div>';
		}
	}
}