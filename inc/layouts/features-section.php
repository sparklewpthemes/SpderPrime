<?php
/**
 * The template for displaying all pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */
?>
<div class="row-fluid services-con">	
	<?php 
		$args = array(
			'cat' => $section_category,
			'posts_per_page' => 3
		);
		$query = new WP_Query($args);
		if( $query->have_posts() ){ while($query->have_posts()) { $query->the_post();
	?>
				<article class="span4">
					<?php if( has_post_thumbnail() ){
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'thumbnail'); ?>
						<img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
					<?php } ?>
					<?php the_title( '<h2>', '</h2>' ); ?>
					<?php if( get_the_content() != "" ) { ?>
						<p><?php echo spiderprime_letter_count(get_the_excerpt(), 125); ?></p>
					<?php } ?>
					<a class="more" href="<?php the_permalink(); ?>">
						<?php _e('More','spiderprime'); ?>
					</a>
				</article>
	<?php } } wp_reset_query(); ?>
</div>
<?php if(!empty($section_view_more_text)) { ?>
	<a class="look-all" href="<?php echo $section_view_more_link ?>">
		<?php echo $section_view_more_text; ?>
	</a>
<?php } ?>