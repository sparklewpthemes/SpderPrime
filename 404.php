<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Spider_Prime
 */

get_header(); ?>

<div class="content">

	<?php do_action('spiderprime_breadcrumb'); ?>

	<div class="container">
		<div class="page-error">
			<h1><?php _e('404','spiderprime'); ?></h1>
			<h2><?php _e('Wooops','spiderprime'); ?></h2>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below ?', 'spiderprime' ); ?></p>
			<p><?php _e('Return to the','spiderprime'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('home page','spiderprime'); ?></a>.</p>
		</div>
	</div>
</div>
<?php
get_footer();
