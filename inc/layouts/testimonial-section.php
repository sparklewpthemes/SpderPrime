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
	<div class="span12">
		<ul class="bxslider">
			<?php 
				$args = array(
					'cat' => $section_category,
					'posts_per_page' => 9,
				);
				$query = new WP_Query($args);
				
				if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
			?>
					<li>
						<?php if(get_the_content() != "" ) { ?>
							<blockquote>
								<?php echo wp_trim_words( get_the_content(), 40, '...' ); ?>
							</blockquote>
						<?php } ?>						
						<div class="tesimonial-autor">
							<h4><?php the_title(); ?></h4>
						</div>
					</li>
			<?php } } wp_reset_query(); ?>
		</ul>

		<div id="bx-pager">
			<?php 
				$args = array(
					'cat' => $section_category,
					'posts_per_page' => 9
				);
				$query = new WP_Query($args);
				if($query->have_posts()) {
					$i = 0;
					while($query->have_posts()) { $query->the_post();
			?>
				<a data-slide-index="<?php echo $i; ?>" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( array(80,80) ); ?>
				</a>
			<?php $i++; } } ?>
		</div>
	</div>
</div>