/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";

	/* ---------------------------------------------------------------------- */
	/*	for ie8 line
	/* ---------------------------------------------------------------------- */
	var dropdownMenu = $('.dropdown');
	dropdownMenu.css('z-index', 99999);

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
	
		
});