<?php
/**
 * Template Name: BlogPage
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

$spiderprime_page_layout = esc_attr(get_theme_mod('spiderprime_page_layout','rightsidebar'));
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
                		$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
					       'post_type' => 'post',
					       'posts_per_page' => 10,
					       'paged' => $page,
						);
						query_posts($args);
						if ( have_posts() ) : 
					?>	
						<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('blog-project '. esc_attr(get_post_format())); ?>>
								
								<div class="post-type">									
									<a class="comment-number" href="<?php echo esc_url( get_comments_link( $post->ID ) ); ?>">
										<?php comments_number('0','1','%'); ?>
									</a>
								</div>

								<div class="post-content">
									<?php if(has_post_thumbnail()) : 
										$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'spiderprime-archive');
									?>
										<div class="post-features-img">
											<img alt="" src="<?php echo esc_url($image[0]); ?>">
										</div>
									<?php endif; ?>		
									<?php
										the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
									?>
									<div class="entry-content">
										<?php the_excerpt(); ?>
									</div><!-- .entry-content -->
									<?php if(!is_single()) : ?>
										<a class="read-more" href="<?php the_permalink(); ?>">
											<?php _e('Read More','spiderprime'); ?>
										</a>
									<?php endif; ?>
								
									<ul class="post-data">
										<?php if ( 'post' === get_post_type() ) : ?>
											<?php spiderprime_posted_on(); ?>
										<?php endif; ?>
										<?php the_category(', '); ?>
										<?php the_tags('Tags : ' ,' , '); ?>
									</ul><!-- .entry-meta -->										

								</div>
							</article>

						<?php
							endwhile;

							the_posts_pagination( 
			            		array(
								    'prev_text' => __( 'Prev', 'spiderprime' ),
								    'next_text' => __( 'Next', 'spiderprime' ),
								)
				            );

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; 
					?>
				</section><!-- .span9 -->			

				<?php  if ($spiderprime_page_layout == 'rightsidebar') : ?>
					<section class="span3 sidebar">						
						<?php get_sidebar('right'); ?>	
					</section> <!-- .span3 -->
				<?php endif; ?>

			</div>
			
		</section>				
	</div>
</div>
<?php get_footer();