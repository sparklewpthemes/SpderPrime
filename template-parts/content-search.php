<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-project '. get_post_format()); ?>>
	
	<div class="post-type">
		<a class="comment-number" href="<?php echo get_comments_link( $post->ID ); ?>">
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
			<?php  
					the_excerpt(); 
			?>
		</div><!-- .entry-content -->
		<?php if(!is_single()) : ?>
			<a class="read-more" href="<?php the_permalink(); ?>">
				<?php esc_html_e('Read More','spiderprime'); ?>
			</a>
		<?php endif; ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<ul class="post-data">			
					<?php spiderprime_posted_on(); ?>			
				<?php the_category(', '); ?>
				<?php the_tags('Tags : ' ,' , '); ?>
			</ul><!-- .entry-meta -->
		<?php endif; ?>		
	</div>
</article>
