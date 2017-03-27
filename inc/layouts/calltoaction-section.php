<?php
/**
 * The template for displaying all pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */
?>
<?php if(!empty($page->ID)) { ?>
	<div class="banner parallax-window" <?php if(!empty( $section_bg_image )) { ?> data-parallax="scroll" data-image-src="<?php echo $section_bg_image; ?>" <?php } ?>>
		<div class="container">
			<?php  
	            $query = new WP_Query( 'page_id='.$page->ID );
	            while ( $query->have_posts() ) { $query->the_post();
	        ?>
	        <?php the_title( '<h1>', '</h1>' ); ?>
			<?php if( get_the_content() != "" ) { ?>
				<?php
					$content = substr( get_the_content(),0, 190) ;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]>', $content);
					echo $content;
				?>
			<?php } } wp_reset_query(); ?>
			<?php if(!empty( $section_view_more_text )) { ?>
				<a class="purchase-button" href="<?php echo $section_view_more_link ?>">
					<?php echo $section_view_more_text; ?>
				</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>