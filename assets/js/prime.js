var $ = jQuery.noConflict();
$(document).ready(function($) {
	"use strict";

	// Menu Toggle
	$('.toggle-nav').click(function(){
	    $('.toggle-nav').toggleClass('on');
	    $('.main-navigation').slideToggle();
	});

	/* ---------------------------------------------------------------------- */
	/*	PrettyPhoto
	/* ---------------------------------------------------------------------- */
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: false,
        default_width: 500,
        default_height: 344,
        social_tools:false,
        deeplinking:false,
    });

    $("a[rel^='blogPrettyPhoto']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: false,
        default_width: 500,
        default_height: 344,
        social_tools:false,
        deeplinking:false,
    });

    $("a[rel^='teamPrettyPhoto']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: false,
        default_width: 500,
        default_height: 344,
        social_tools:false,
        deeplinking:false,
    });
	
	/* ---------------------------------------------------------------------- */
	/*	testimonials isotope
	/* ---------------------------------------------------------------------- */
	// Needed variables
		var $content=$('.testimonial-box');
		
		var sliderTestim = $('.bxslider');

		sliderTestim.bxSlider({
			pagerCustom: '#bx-pager',
			auto: true,
			mode: 'vertical'
		});	


	/*-------------------------------------------------*/
	/* =  Flexslider
	/*-------------------------------------------------*/
	try {

		var boxSlider = $('.flexslider');

		boxSlider.flexslider({
			animation: "fade"
		});
	} catch(err) {

	}

	var nextSlide = $('.next-slide'),
		prevSlide = $('.prev-slide');

	nextSlide.on('click', function(e){
		e.preventDefault();
		var nextTrigg = $('.flex-direction-nav .flex-next');
		nextTrigg.trigger('click');
	});

	prevSlide.on('click', function(e){
		e.preventDefault();
		var prevTrigg = $('.flex-direction-nav .flex-prev');
		prevTrigg.trigger('click');
	});

	/* ---------------------------------------------------------------------- */
	/*	Client Slider
	/* ---------------------------------------------------------------------- */
	var clientSlider = $('.bxslider.clSlider');

	try {
			clientSlider.bxSlider({
				auto: true,
				mode: 'horizontal'
			});
		} catch(err) {
	}

	/**
     * ScrollUp
    */
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 1000) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

    jQuery('.scrollup').click(function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    }); 
	
		
});