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
				$section_view_more_text = esc_attr( $section->view_more_text );
				$section_view_more_link = esc_url( $section->view_more_link );				
		?>
		<?php if( $section_layout != 'Call to Action Section') { ?>
			<section class="what-we-do parallax-window" <?php if( !empty( $section_bg_image ) ) { ?> data-parallax="scroll" data-image-src="<?php echo $section_bg_image; ?>" <?php } ?>>
				<div class="container">
					<?php if( !empty( $page->ID ) ) { ?>
						<div class="row-fluid definition">
							<?php  
					            $query = new WP_Query( 'page_id='.$page->ID );
					            while ( $query->have_posts() ) { $query->the_post();
					        ?>
								<div class="span12">
									<?php the_title( '<h1>', '</h1>' ); ?>
									<?php if( get_the_content() != "" ) { ?>
										<?php the_content(); ?>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
		<?php } ?>
					<?php 
						switch ($section_layout) {

							case 'Default Section':
								$template = "inc/layouts/default";
								break;

							case 'Features Section':
								$template = "inc/layouts/features";
								break;						

							case 'Portfolio Section':
								$template = "inc/layouts/portfolio";
								break;

							case 'Call to Action Section':
								$template = "inc/layouts/calltoaction";
								break;

							case 'Blog Section':
								$template = "inc/layouts/blog";
								break;

							case 'Our Team Section':
								$template = "inc/layouts/ourteam";
								break;

							case 'Testimonial Section':
								$template = "inc/layouts/testimonial";
								break;
							
							default:
								$template = "inc/layouts/default";
								break;
						}
					?>

					<?php include($template."-section.php");?>
					
		<?php if($section_layout != 'Call to Action Section') { ?>
				</div>
			</section>
		<?php } ?>
	<?php } } ?>
</div>
<?php get_footer();