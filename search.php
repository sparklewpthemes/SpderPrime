<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Spider_Prime
 */

get_header(); ?>

<?php
	$spiderprime_page_layout = esc_attr(get_theme_mod('spiderprime_archive_page_layout','rightsidebar'));
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
						if ( have_posts() ) : 						

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

							endwhile;

							the_posts_pagination( 
			            		array(
								    'prev_text' => esc_html__( 'Prev', 'spiderprime' ),
								    'next_text' => esc_html__( 'Next', 'spiderprime' ),
								)
				            );

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; 
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