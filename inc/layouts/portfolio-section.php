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
		if($query->have_posts()){ while($query->have_posts()){ $query->the_post();
	?>
		<div class="span4 project-post">
			<?php if(has_post_thumbnail()){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'spiderprime-blog');
				$image_large = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large'); 
			?>
				<div class="project-photo">
					<img alt="<?php the_title(); ?>" src="<?php echo esc_url($image[0]); ?>">
					<div class="hover-project">
						<a class="view-image" href="<?php echo esc_url($image_large[0]); ?>" rel="prettyPhoto[port]" title="<?php the_title(); ?>"></a>
						<a class="visit-link" href="<?php the_permalink(); ?>"></a>
					</div>
				</div>
			<?php } ?>		
			<?php the_title( '<h3>', '</h3>' ); ?>
			<p><?php echo wp_trim_words(get_the_content(), 22 ); ?></p>
			<?php the_tags( '<ul class="project-tags"><li>', '</li><li>', '</li></ul>' ); ?>			
		</div>
	<?php } } wp_reset_postdata(); ?>
</div>