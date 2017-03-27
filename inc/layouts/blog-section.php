<?php
/**
 * The template for displaying all pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */
?>
<div class="row-fluid">
	<?php 
		$args = array(
			'cat' => $section_category,
			'posts_per_page' => 3
		);
		$query = new WP_Query($args);
		if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
	?>
		<div class="span4 blog-post">
			<?php if(has_post_thumbnail()) { 
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'spiderprime-blog');
				$image_large = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large'); 
			?>
				<div class="blog-photo project-photo">
					<img alt="<?php the_title(); ?>" src="<?php echo esc_url($image[0]); ?>">
					<div class="hover-project">
						<a class="view-image" href="<?php echo esc_url($image_large[0]); ?>" rel="blogPrettyPhoto[blog]" title="<?php the_title(); ?>"></a>
						<a class="visit-link" href="<?php the_permalink(); ?>"></a>
					</div>
				</div>
			<?php } ?>
			<h3><a href="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<p><?php echo wp_trim_words(get_the_content(), 22 ); ?></p>
			<div class="date">
				<span><a href="<?php the_permalink(); ?>"><?php echo the_date();?></a></span>
				<ul class="view-com">
					<li>
						<a class="comments" href="<?php echo esc_url(get_comments_link( $post->ID )); ?>">
							<?php comments_number('0','1','%'); ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
	<?php  } } wp_reset_postdata(); ?>
</div>