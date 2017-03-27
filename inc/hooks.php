<?php
/**
 * @package Spider_Prime
*/

/**
 * Default Section
*/
if(!function_exists('spiderprime_default_section')){
	function spiderprime_default_section(){
	?>
		<div class="row-fluid services-con">
			<div class="spiderprime-default-section">
				
			</div>
		</div>
	<?php }
}
add_action('spiderprime_default_section', 'spiderprime_default_section');

/**
 * Features Section
*/
if(!function_exists('spiderprime_features_section')){
	function spiderprime_features_section( $args ){
	?>
	<div class="row-fluid services-con">	
		<?php
			$cat_id = $args['cat_id'];
			$args = array(
				'cat' => $cat_id,
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
					<p><?php echo wp_trim_words(get_the_content(), 22 ); ?></p>
					<a class="more" href="<?php the_permalink(); ?>">
						<?php _e('More','spiderprime'); ?>
					</a>
				</article>
		<?php } } wp_reset_postdata(); ?>
	</div>
	<?php }
}
add_action('spiderprime_features_section', 'spiderprime_features_section');

/**
 * Call To Action Section
*/
if(!function_exists('spiderprime_calltoaction_section')){
	function spiderprime_calltoaction_section( $args ){
	 $page_id = $args['page_id'];
	 $section_bg_image = $args['bg_image'];
	 if(!empty($page_id)) { ?>
		<div class="banner parallax-window" <?php if(!empty( $section_bg_image )) { ?> data-parallax="scroll" data-image-src="<?php echo esc_url( $section_bg_image ); ?>" <?php } ?>>
			<div class="container">
				<?php  
		            $query = new WP_Query( 'page_id='.$page_id );
		            while ( $query->have_posts() ) { $query->the_post();
		        ?>
		        <?php the_title( '<h1>', '</h1>' ); ?>
					<?php
						$content = substr( get_the_content(),0, 190) ;
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]>', $content);
						echo $content;
					?>
				<?php } wp_reset_postdata(); ?>			
			</div>
		</div>
	<?php }
	}
}
add_action('spiderprime_calltoaction_section', 'spiderprime_calltoaction_section');

/**
 * Portfolio Section
*/
if(!function_exists('spiderprime_portfolio_section')){
	function spiderprime_portfolio_section( $args ){
	?>
	<div class="row-fluid">
		<?php
			$cat_id = $args['cat_id'];
			$args = array(
				'cat' => $cat_id,
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
	<?php }
}
add_action('spiderprime_portfolio_section', 'spiderprime_portfolio_section');

/**
 * Our Blogs Section
*/
if(!function_exists('spiderprime_blog_section')){
	function spiderprime_blog_section( $args ){
	?>
	<div class="row-fluid">
		<?php
			$cat_id = $args['cat_id'];
			$args = array(
				'cat' => $cat_id,
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
							<a class="comments" href="<?php echo esc_url(get_comments_link( $query->ID )); ?>">
								<?php comments_number('0','1','%'); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		<?php  } } wp_reset_postdata(); ?>
	</div>
	<?php }
}
add_action('spiderprime_blog_section', 'spiderprime_blog_section');

/**
 * Our Team Member Section
*/
if(!function_exists('spiderprime_ourteam_section')){
	function spiderprime_ourteam_section( $args ){
	?>
	<div class="row-fluid ourteam">
		<?php
			$cat_id = $args['cat_id'];
			$args = array(
				'cat' => $cat_id,
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
				<p><?php echo wp_trim_words(get_the_content(), 35 ); ?></p>
			</div>
		<?php } } wp_reset_postdata();
		?>
	</div>
	<?php }
}
add_action('spiderprime_ourteam_section', 'spiderprime_ourteam_section');

/**
 * Testimonial Section
*/
if(!function_exists('spiderprime_testimonial_section')){
	function spiderprime_testimonial_section( $args ){
	?>
	<div class="row-fluid">
		<div class="span12">
			<ul class="bxslider">
				<?php 
					$cat_id = $args['cat_id'];
					$args = array(
						'cat' => $cat_id,
						'posts_per_page' => 9,
					);
					$query = new WP_Query($args);
					
					if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
				?>
						<li>
							<blockquote>
								<?php echo wp_trim_words( get_the_content(), 40, '...' ); ?>
							</blockquote>					
							<div class="tesimonial-autor">
								<h4><?php the_title(); ?></h4>
							</div>
						</li>
				<?php } } wp_reset_postdata(); ?>
			</ul>

			<div id="bx-pager">
				<?php 
					$args = array(
						'cat' => $cat_id,
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
				<?php $i++; } } wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<?php }
}
add_action('spiderprime_testimonial_section', 'spiderprime_testimonial_section');
