<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */

get_header(); ?>

<?php
	$spiderprime_archive_layout = esc_attr(get_theme_mod('spiderprime_archive_page_layout','rightsidebar'));
	if(!empty($spiderprime_archive_layout) && $spiderprime_archive_layout == 'rightsidebar' || $spiderprime_archive_layout == 'leftsidebar' ) {
		$spiderprime_col = 9;
	}else if(!empty($spiderprime_archive_layout) && $spiderprime_archive_layout == 'nosidebar' ){
		$spiderprime_col = 12;
	}
?>

<div class="content">

	<?php do_action('spiderprime_breadcrumb'); ?>

	<div class="container">
		<div class="row-fluid blog-page">

			<?php  if ($spiderprime_archive_layout == 'leftsidebar') : ?>
				<section class="span3 sidebar">
					<?php get_sidebar(); ?>	
				</section> <!-- .span3 -->
			<?php endif; ?>

			<section class="span<?php echo intval( $spiderprime_col ); ?> blog-box">
				<?php
					if ( have_posts() ) : ?>					

					<?php
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

			<?php  if ($spiderprime_archive_layout == 'rightsidebar') : ?>
				<section class="span3 sidebar">						
					<?php get_sidebar(); ?>	
				</section> <!-- .span3 -->
			<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer();

