<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */

get_header(); 

	$spiderprime_page_layout = esc_attr( get_post_meta($post->ID, 'spiderprime_page_layouts', true) );
	if(!$spiderprime_page_layout){
		$spiderprime_page_layout = 'rightsidebar';
	}
	if(!empty($spiderprime_page_layout) && $spiderprime_page_layout == 'rightsidebar' || $spiderprime_page_layout == 'leftsidebar' ) {
		$spiderprime_col = 9;
	}else if(!empty($spiderprime_page_layout) && $spiderprime_page_layout == 'nosidebar' ){
		$spiderprime_col = 12;
	}
?>

<div class="content">

	<?php do_action('spiderprime_breadcrumb'); ?>

	<div class="container">
		<section class="about-us">

			<div class="row-fluid our-description">
				<?php  if ($spiderprime_page_layout == 'leftsidebar') : ?>
					<section class="span3 sidebar">
						<?php get_sidebar(); ?>	
					</section> <!-- .span3 -->
				<?php endif; ?>
				
				<section class="span<?php echo intval( $spiderprime_col ); ?>">
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
					?>
				</section><!-- .span9 -->			

				<?php  if ($spiderprime_page_layout == 'rightsidebar') : ?>
					<section class="span3 sidebar">						
						<?php get_sidebar(); ?>	
					</section> <!-- .span3 -->
				<?php endif; ?>

			</div>
			
		</section>				
	</div>
</div>
<?php get_footer();