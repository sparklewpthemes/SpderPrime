<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-project '. esc_attr(get_post_format())); ?>>
	
	<div class="post-type">
		<?php if( get_post_format() ) { ?>
			<span></span>
		<?php } ?>
		<a class="comment-number" href="<?php echo esc_url(get_comments_link( $post->ID )); ?>">
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
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			}
		?>
		<div class="entry-content">
			<?php if(is_single()) : 
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'spiderprime' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'spiderprime' ),
						'after'  => '</div>',
					) );
				else : 
					the_excerpt(); 
				endif;
			?>
		</div><!-- .entry-content -->
		<?php if(! is_single() ) { ?>
			<a class="read-more" href="<?php the_permalink(); ?>">
				<?php esc_html_e('Read More','spiderprime'); ?>
			</a>
		<?php } ?>
	
		<ul class="post-data">
			<?php if ( 'post' === get_post_type() ) { ?>
				<?php spiderprime_posted_on(); ?>
			<?php } ?>
			<?php the_category(', '); ?>
			<?php the_tags('Tags : ' ,' , '); ?>
		</ul><!-- .entry-meta -->

		<?php 
			if(is_single()) {
				
				the_post_navigation();
			
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}
		?>

	</div>
</article>