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
				    	$spiderprime_section = get_theme_mod('spiderprime_homepage_slider_settings');
				    	if( !empty( $spiderprime_section ) ) {
				    	$spiderprime_all_slider_items = json_decode($spiderprime_section);
				    	foreach ($spiderprime_all_slider_items as $slider_item) {
				    ?>				    
					   	<li><!-- Slider  list item-->
					   	    <img alt="<?php echo esc_attr($slider_item->title_text); ?>" src="<?php echo esc_url($slider_item->bg_image_url); ?>" />
					   	    <div class="flex-caption">
					   	    	<div class="container">
					   	    		<div class="caption-adjust">
										<h1><?php echo esc_attr( $slider_item->title_text ); ?></h1>
										<p><?php echo esc_attr( $slider_item->short_textarea ); ?></p>
										<?php 
											$button_text = esc_attr( $slider_item->view_more_text ); 
											if(!empty( $button_text ) ) { 
										?>
											<a href="<?php echo esc_url( $slider_item->view_more_link ); ?>">
												<?php echo esc_attr( $slider_item->view_more_text ); ?>
											</a>
										<?php } ?>
									</div>
								</div>
					   	    </div>
					   	</li>
					<?php } } ?>
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
 * Enqueue scripts & css in admin panel
 */
if ( ! function_exists( 'spiderprime_admin_styles' ) ) {
	function spiderprime_admin_styles() {
		wp_enqueue_style( 'spiderprime_admin_stylesheet', get_template_directory_uri().'/css/admin-style.css','1.0.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'spiderprime_admin_styles', 10 );

/**
* Spider Prime Custom CSS Function Area
*/
if ( ! function_exists( 'spiderprime_custom_css' ) ) {
	function spiderprime_custom_css(){
		$spiderprime_custom_css = get_theme_mod('spiderprime_custom_css');
	 ?>
		<style type="text/css">
			<?php echo wp_filter_nohtml_kses( $spiderprime_custom_css ); ?>
		</style>
	 <?php
	}
}
add_action('wp_head','spiderprime_custom_css');


/**
* Spider Prime Banner of Every Page
*/
if ( ! function_exists( 'spiderprime_banner_section_breadcrumb' ) ) {
	function spiderprime_banner_section_breadcrumb(){
		$breadcrumb_bg_img = esc_url( get_theme_mod('spiderprime_breadcrumbs_bg_image') );
		$breadcrumb_bg_color = wp_filter_nohtml_kses(get_theme_mod('spiderprime_breadcrumbs_background_color','#8248ac'));
		$breadcrumb_bg_font_color = esc_attr(get_theme_mod('spiderprime_breadcrumbs_font_color','#fff'));
		$breadcrumb_section_height = intval(get_theme_mod('spiderprime_breadcrumbs_min_height_options','80'));
		if(!empty($breadcrumb_bg_img)) {
			$bg = "background:url(".$breadcrumb_bg_img.");";
		}else {
			$bg = "background:".$breadcrumb_bg_color.";";
		}
		$breadcrumbs_settings =  "background-size:cover; color :". $breadcrumb_bg_font_color ."; ". $bg ." height:". intval( $breadcrumb_section_height ) ."px;";
	 ?>
		<div class="banner about-banner" style="<?php echo $breadcrumbs_settings; ?>">
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
						echo '<h1 class="entry-title">'.__('404','spiderprime').'</h1>';
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
* Spider Prime Comment Call Back Function
*/
if ( ! function_exists( 'spiderprime_comment' ) ) {
	function spiderprime_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>   
	    <li <?php comment_class('comment-item'); ?> id="li-comment-<?php comment_ID() ?>">
	        <div class="comment-content" id="comment-<?php comment_ID(); ?>">
	            <?php if( get_avatar($comment, $size='60' ) ) { echo get_avatar($comment,$size='60'); } ?>
	            <?php if ($comment->comment_approved == '0') : ?>
	                 <em><?php _e('Your comment is awaiting moderation.','spiderprime') ?></em>
	                 <br />
	            <?php endif; ?>
	            	<div>
	                    <h2><?php comment_author(); ?></h2>                      
	                    
	                    <span class="date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
	                      <?php echo get_comment_date();  echo get_comment_time(); ?>
	                    </span>

						<?php comment_text() ?>
	                    
	                    <a class="reply-comment">
	                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	                    </a>
	                     
	            	</div>
	        </div>       
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
    	$delimiter = '>>';    
    	$home = __('Home', 'spiderprime'); // text for the 'Home' link
    	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    	$before = '<span class="current">'; // tag before the current crumb
    	$after = '</span>'; // tag after the current crumb
    	$homeLink = home_url();

    	if (is_home() || is_front_page()) {

	    	if ($showOnHome == 1)
	    		echo '<div id="spiderprime-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
	    } else {
    			echo '<div id="spiderprime-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
	    	if (is_category()) {
	    		$thisCat = get_category(get_query_var('cat'), false);
	    		if ($thisCat->parent != 0)
	    			echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
	    		echo $before . __('Archive by category','spiderprime').' "' . single_cat_title('', false) . '"' . $after;
	    	} elseif (is_search()) {
	    		echo $before . __('Search results for','spiderprime'). '"' . get_search_query() . '"' . $after;
	    	} elseif (is_day()) {
	    		echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	    		echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
	    		echo $before . get_the_time('d') . $after;
	    	} elseif (is_month()) {
	    		echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	    		echo $before . get_the_time('F') . $after;
	    	} elseif (is_year()) {
	    		echo $before . get_the_time('Y') . $after;
	    	} elseif (is_single() && !is_attachment()) {
	    		
	    		if (get_post_type() != 'post') {
	    			$post_type = get_post_type_object(get_post_type());
	    			$slug = $post_type->rewrite;
	    			echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
	    			if ($showCurrent == 1)
	    				echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	    		} else {
	    			$cat = get_the_category();
	    			$cat = $cat[0];
	    			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	    			if ($showCurrent == 0)
	    				$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	    			echo $cats;
	    			if ($showCurrent == 1)
	    				echo $before . get_the_title() . $after;
	    		}

	    	} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
	    		$post_type = get_post_type_object(get_post_type());
	    		echo $before . $post_type->labels->singular_name . $after;
	    	} elseif (is_attachment()) {
	    		$parent = get_post($post->post_parent);
	    		$cat = get_the_category($parent->ID);
	    		$cat = $cat[0];
	    		echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	    		echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
	    		if ($showCurrent == 1){
	    			echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	    		}
	    	} elseif (is_page() && !$post->post_parent) {
	    		if ($showCurrent == 1){
	    			echo $before . get_the_title() . $after;
	    		}
	    	} elseif (is_page() && $post->post_parent) {
	    		$parent_id = $post->post_parent;
	    		$breadcrumbs = array();
	    		while ($parent_id) {
	    			$page = get_page($parent_id);
	    			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	    			$parent_id = $page->post_parent;
	    		}
	    		$breadcrumbs = array_reverse($breadcrumbs);
	    		for ($i = 0; $i < count($breadcrumbs); $i++) {
	    			echo $breadcrumbs[$i];
	    			if ($i != count($breadcrumbs) - 1)
	    				echo ' ' . $delimiter . ' ';
	    		}
	    		if ($showCurrent == 1){
	    			echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
	    		}
	    	} elseif (is_tag()) {
	    		echo $before . __('Posts tagged','spiderprime').' "' . single_tag_title('', false) . '"' . $after;
	    	} elseif (is_author()) {
	    		global $author;
	    		$userdata = get_userdata($author);
	    		echo $before . __('Articles posted by ','spiderprime'). $userdata->display_name . $after;
	    	} elseif (is_404()) {
	    		echo $before . 'Error 404' . $after;
	    	}

	    	if (get_query_var('paged')) {
	    		if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()){
	    			echo ' (';
	    			echo __('Page', 'spiderprime') . ' ' . get_query_var('paged');
	    		}
	    		if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()){
	    					echo ')';
				}
			}

			echo '</div>';
		}
	}
}


/**
* Spider Prime Content Limit function
*/
if ( ! function_exists( 'spiderprime_letter_count' ) ) {
	function spiderprime_letter_count($content, $limit) {
		$striped_content = strip_tags($content);
		$striped_content = strip_shortcodes($striped_content);
		$limit_content = mb_substr($striped_content, 0 , $limit );

		if($limit_content < $content){
			$limit_content .= "..."; 
		}
		return $limit_content;
	}
}


/**
 * Spider Prime Pagination Function
*/
if ( ! function_exists( 'spiderprime_pagination' ) ) {

    function spiderprime_pagination($pages = '', $range = 2){  
         $showitems = ($range * 2)+1;  
          global $paged;
         if(empty($paged)) $paged = 1; 
         if($pages == '')
         {
             global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
         }   
     
         if(1 != $pages)
         {
             echo "<div class=\"primepagination\">";
             if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
              if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
      
              for ($i=1; $i <= $pages; $i++)
              {
                  if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                  {
                      echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                  }
              }
      
              if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";  
              if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
              echo "</div>\n";
          }
    }
}

/**
 * Spider Prime Search Function
*/
if ( ! function_exists( 'spiderprime_search_form' ) ) {
	function spiderprime_search_form( $form ) {
	    $form = '<form role="search" method="get" id="search-bar" class="searchform" action="' . home_url( '/' ) . '" >
	    	<input type="text" value="' . get_search_query() . '" name="s" id="s" />	   
	    </form>'; 
	    return $form;
	}
}
add_filter( 'get_search_form', 'spiderprime_search_form' );


/**
 * Spider Prime default layout seciton action
*/
if ( ! function_exists( 'spiderprime_default_section' ) ) {
	function spiderprime_default_section(){
		echo '<div class="spiderprime-default-section"></div>';
	}
}
add_action('default-section','spiderprime_default_section');
