<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

	<div class="container">
		<div class="row-fluid blog-page">

			<?php  if ($spiderprime_page_layout == 'leftsidebar') : ?>
				<section class="span3 sidebar">
					<?php get_sidebar(); ?>	
				</section> <!-- .span3 -->
			<?php endif; ?>

			<section class="span<?php echo intval( $spiderprime_col ); ?> blog-box">
				<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

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
			</section>

			<?php  if ($spiderprime_page_layout == 'rightsidebar') : ?>
				<section class="span3 sidebar">						
					<?php get_sidebar(); ?>
				</section> <!-- .span3 -->
			<?php endif; ?>

		</div>
	</div>
</div>
<?php
get_footer();