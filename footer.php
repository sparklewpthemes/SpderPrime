<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Spider_Prime
 */

?>
	<footer>
		<?php
			$footer_options = esc_attr( get_theme_mod('spiderprime_footer_area_enable_disable_section','enable') );
			if($footer_options == 'enable'):
			$footer_bg = wp_filter_nohtml_kses ( get_theme_mod('spiderprime_footer_area_background_color','#f6f7f7') );
		?>
			<section class="quick-contact primefooter" <?php if( $footer_bg ) {  ?> style="background-color:<?php echo $footer_bg; ?>"<?php } ?>>
				<div class="container">				

					<div class="row-fluid footer-data">

						<?php if(is_active_sidebar('footerone')) : ?>
	                        <div class="span3 footerarea"> 
	                        	<ul class="widgets">                      
	                               <?php dynamic_sidebar('footerone') ?>
	                            </ul>
	                        </div>
                   		<?php endif; ?>

                   		<?php if(is_active_sidebar('footertwo')) : ?>
	                        <div class="span3 footerarea">
	                        	<ul class="widgets">                       
	                               <?php dynamic_sidebar('footertwo') ?>
	                            </ul>
	                        </div>
                   		<?php endif; ?>

                   		<?php if(is_active_sidebar('footerthree')) : ?>
	                        <div class="span3 footerarea">
	                        	<ul class="widgets">                       
	                               <?php dynamic_sidebar('footerthree') ?>
	                            </ul>
	                        </div>
                   		<?php endif; ?>

                   		<?php if(is_active_sidebar('footerfour')) : ?>
	                        <div class="span3 footerarea">
	                        	<ul class="widgets">                       
	                               <?php dynamic_sidebar('footerfour') ?>
	                            </ul>
	                        </div>
                   		<?php endif; ?>							

					</div><!-- .row-fluid footer-data -->
				</div>
			</section><!-- Section -->
		<?php endif; ?>
		<?php $bg_copyright = wp_filter_nohtml_kses( get_theme_mod('spiderprime_footer_buttom_area_background_color','#e9ebeb')); ?>
			<div class="copyright" <?php if( $bg_copyright ) {  ?> style="background-color:<?php echo $bg_copyright; ?>"<?php } ?>>
				<div class="container">
					<div class="copyright_left pull-left">
						<?php if( get_theme_mod('spiderprime_footer_buttom_copyright_setting')) : ?>
							<p><?php echo wp_filter_nohtml_kses( get_theme_mod('spiderprime_footer_buttom_copyright_setting') ); ?></p>
						<?php else : ?>
							<p><?php printf(__('Copyright &copy; %1$s %2$s', 'spiderprime'), get_the_time("Y"), get_bloginfo('name')); ?></p>
						<?php endif; ?>
					</div>
					<div class="pull-right copyright_right">
						<p><?php _e('Spider Prime by','spiderprime'); ?> <a href="<?php echo esc_url('http://sparklewpthemes.com/'); ?>" title="Sparkle Wp Themes" target="_blank">Sparkle Wp Themes</a></p>
					</div>
				</div>
			</div><!-- container copyright -->
	</footer><!--End Footer -->
</div><!-- End Container -->
<?php wp_footer(); ?>
</body>
</html>
