<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Spider_Prime
 */

get_header(); ?>

<?php
	$spiderprime_single_layout = esc_attr(get_theme_mod('spiderprime_single_posts_layout','rightsidebar'));
	if(!empty($spiderprime_single_layout) && $spiderprime_single_layout == 'rightsidebar' || $spiderprime_single_layout == 'leftsidebar' ) {
		$spiderprime_col = 9;
	}else if(!empty($spiderprime_single_layout) && $spiderprime_single_layout == 'nosidebar' ){
		$spiderprime_col = 12;
	}
?>

<div class="content">

	<?php do_action('spiderprime_breadcrumb'); ?>

	<div class="container">
		<div class="row-fluid blog-page">

			<?php  if ($spiderprime_single_layout == 'leftsidebar') : ?>
				<section class="span3 sidebar">
					<?php get_sidebar(); ?>	
				</section> <!-- .span3 -->
			<?php endif; ?>

			<section class="span<?php echo intval( $spiderprime_col ); ?> blog-box">
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );						

					endwhile; // End of the loop.
				?>
			</section>

			<?php  if ($spiderprime_single_layout == 'rightsidebar') : ?>
				<section class="span3 sidebar">						
					<?php get_sidebar('right'); ?>	
				</section> <!-- .span3 -->
			<?php endif; ?>

		</div>
	</div>
</div>

<?php
get_footer();