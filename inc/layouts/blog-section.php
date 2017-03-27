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
			<?php if( get_the_content() != "" ) { ?>
				<p><?php echo spiderprime_letter_count( get_the_excerpt(), 125 ); ?></p>
			<?php } ?>
			<div class="date">
				<span><a href="<?php the_permalink(); ?>"><?php echo get_the_date();?></a></span>
				<ul class="view-com">
					<li><a class="comments" href="<?php echo get_comments_link( $post->ID ); ?>"><?php comments_number('0','1','%'); ?></a></li>
				</ul>
			</div>
		</div>
	<?php  } } wp_reset_query(); ?>
</div>
<?php if(!empty($section_view_more_text)) { ?>
	<a class="look-all" href="<?php echo $section_view_more_link ?>">
		<?php echo $section_view_more_text; ?>
	</a>
<?php } ?>