<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Spider_Prime
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<ul id="secondary" class="widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</ul><!-- #secondary -->