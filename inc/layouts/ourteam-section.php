<?php
/**
 * The template for displaying all pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Spider_Prime
 */
?>
<div class="row-fluid ourteam">
	<?php 
		$args = array(
			'cat' => $section_category,
			'posts_per_page' => 4
		);
		$query = new WP_Query($args);
		if($query->have_posts()) { while($query->have_posts()){ $query->the_post();
	?>
		<div class="span3 team-post">
			<?php if(has_post_thumbnail()) { 
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'spiderprime-team');
				$image_large = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large'); 
			?>
				<div class="team-photo">
					<img alt="<?php the_title(); ?>" src="<?php echo esc_url($image[0]); ?>">
					<div class="hover-project">						
						<a class="zoom-image" href="<?php echo esc_url($image_large[0]); ?>" rel="teamPrettyPhoto[team]" title="<?php the_title(); ?>"></a>
					</div>
				</div>
			<?php } ?>			
			<?php the_title( '<h3>', '</h3>' ); ?>
			<?php if( get_the_content() != "" ) { ?>
			<?php
				$content = substr( get_the_content(),0, 250) ;
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]>', $content);
				echo $content;
			} ?>
		</div>
	<?php } } wp_reset_query();
	?>
</div>
<?php if(!empty($section_view_more_text)) { ?>
	<a class="look-all" href="<?php echo $section_view_more_link ?>">
		<?php echo $section_view_more_text; ?>
	</a>
<?php } ?>