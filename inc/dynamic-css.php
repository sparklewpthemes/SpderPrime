<?php
/**
 * Dynamic css
*/
if ( ! function_exists( 'spiderprime_dynamic_css' ) ) {
    function spiderprime_dynamic_css() {   
        /**
         * Custom css
        */
        $custom_css = '';
        $spiderprime_custom_css = wp_strip_all_tags ( get_theme_mod('spiderprime_custom_css') );
        if ( ! empty( $spiderprime_custom_css ) ) {
            $custom_css .= $spiderprime_custom_css;
        }
        wp_add_inline_style( 'spiderprime-style', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'spiderprime_dynamic_css', 99 );