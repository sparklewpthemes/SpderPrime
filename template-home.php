<?php
/**
 * Template Name: Home Page
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
get_header(); ?>

<?php 
	if( esc_attr( get_theme_mod('spiderprime_slider_section_options','enable' ) == 'enable') ) {

		do_action('spiderprime_slider');

	}
?>

<div class="content">
	<?php
		$sections = get_theme_mod('spiderprime_homepage_settings');
		$all_sections = json_decode( $sections );
		if(!empty( $all_sections ) ) {
			foreach ($all_sections as $section){
				$page = get_page_by_title( esc_attr( $section->section_value_page ) );
				$section_layout = esc_attr( $section->section_value );
				$section_category = get_cat_ID( esc_attr( $section->section_value_cat ) );
				$section_bg_image = esc_url( $section->bg_image_url );
				$section_button_text = esc_attr( $section->view_more_text );
				$section_button_link = esc_url( $section->view_more_link );
				$args = array(
					'cat_id'      => $section_category,
					'page_id'     => $page->ID,
					'bg_image'    => $section_bg_image,
					'button_text' => $section_button_text,
					'button_link' => $section_button_link
				);
		?>
		<?php if( $section_layout != 'Call to Action Section') { ?>
			<section class="what-we-do parallax-window" <?php if( !empty( $section_bg_image ) ) { ?> data-parallax="scroll" data-image-src="<?php echo esc_url( $section_bg_image ); ?>" <?php } ?>>
				<div class="container">
					<?php if( !empty( $page->ID ) ) { ?>
						<div class="row-fluid definition">
							<?php  
					            $query = new WP_Query( 'page_id='.$page->ID );
					            while ( $query->have_posts() ) { $query->the_post();
					        ?>
								<div class="span12">
									<?php the_title( '<h2>', '</h2>' ); ?>
									<?php the_content(); ?>
								</div>
							<?php } wp_reset_postdata(); ?>
						</div>
					<?php } ?>
		<?php } ?>
					<?php 
						switch ($section_layout) {

							case 'Features Section':
								do_action('spiderprime_features_section', $args);
								break;						

							case 'Portfolio Section':
								do_action('spiderprime_portfolio_section', $args);
								break;

							case 'Call to Action Section':
								do_action('spiderprime_calltoaction_section', $args);
								break;

							case 'Blog Section':
								do_action('spiderprime_blog_section', $args);
								break;

							case 'Our Team Section':
								do_action('spiderprime_ourteam_section', $args);
								break;

							case 'Testimonial Section':
								do_action('spiderprime_testimonial_section', $args);
								break;
							
							default:
								do_action('spiderprime_default_section');
								break;
						}
					?>
				
		<?php if($section_layout != 'Call to Action Section') { ?>
				</div>
			</section>
		<?php } ?>
	<?php } } ?>
</div>
<?php get_footer();