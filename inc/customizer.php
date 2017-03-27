<?php
/**
 * Spider Prime Theme Customizer.
 *
 * @package Spider_Prime
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function spiderprime_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	** Header Settings
	**/
	$wp_customize->add_panel('spiderprime_general_settings', array(
	  'capabitity' => 'edit_theme_options',
	  'description' => esc_html__('Change the header settings here as you want', 'spiderprime'),
	  'priority' => 5,
	  'title' => esc_html__('General Settings', 'spiderprime')
	));

	// Header Logo Section
	$wp_customize->get_section('title_tagline' )->panel = 'spiderprime_general_settings';
	$wp_customize->get_section('title_tagline' )->title = esc_html__( 'Logo/Site Title/Favicon','spiderprime' );
	$wp_customize->get_section('title_tagline' )->priority = 0;
	$wp_customize->get_section('background_image' )->panel = 'spiderprime_general_settings';
	$wp_customize->get_section('colors' )->panel = 'spiderprime_general_settings';
	$wp_customize->get_section('colors')->title = esc_html__( 'Themes Colors','spiderprime' );      

	// Main Slider Settings
	$wp_customize->add_section('spiderprime_homepage_slider_setting', array(
	  'priority' => 6,
	  'title' => esc_html__('Slider Settings', 'spiderprime'),
	  'description' => esc_html__('Manage you home slider section here as you want', 'spiderprime'),
	));

		$wp_customize->add_setting('spiderprime_slider_section_options', array(
		 'default' => 'enable',
		 'capability' => 'edit_theme_options',
		 'sanitize_callback' => 'spiderprime_enable_disable_sanitize', // done
		));

		$wp_customize->add_control('spiderprime_slider_section_options', array(
		 'type' => 'radio',
		 'label' => esc_html__('Enable/Disable Slider Section', 'spiderprime'),
		 'section' => 'spiderprime_homepage_slider_setting',
		 'setting' => 'spiderprime_slider_section_options',
		 'choices' => array(
		    'enable' => esc_html__('Enable', 'spiderprime'),
		    'disable' => esc_html__('Disable', 'spiderprime'),
		)));

		/* Main Slider Category */
		$wp_customize->add_setting( 'spiderprime_slider_team_id', array(
			'default' => '',
			'sanitize_callback' => 'spiderprime_sanitize_number'
		) );

		$wp_customize->add_control( new Spiderprime_Category_Dropdown( $wp_customize, 'spiderprime_slider_team_id', array(
		    'label' => esc_html__( 'Select Slide Category', 'spiderprime' ),
		    'section' => 'spiderprime_homepage_slider_setting',
			'priority' => 30,
		) ) );


	// Start of the Design Options
	$wp_customize->add_section('spiderprime_homepage_section_setting', array(
	  'priority' => 7,
	  'title' => esc_html__('Configure HomePage Settings', 'spiderprime'),
	  'description' => esc_html__('Manage you home page section here as you want', 'spiderprime'),
	));		

		/* Services content */
		$wp_customize->add_setting( 'spiderprime_homepage_settings', array(
			'sanitize_callback' => 'spiderprime_sanitize_repeater',
			'default' => json_encode(
	        array( 
	          array(
	            "section_value_page" => '',
	            "section_value" => '',
	            "section_value_cat" => '',
	            "bg_image_url" => '',
	            "view_more_text" => '',
		        "view_more_link" => '',
	          )
	        )
	      )
		));


		$wp_customize->add_control( new SpiderPrime_General_Repeater( $wp_customize, 'spiderprime_homepage_settings', array(
			'label'   => esc_html__('Manage HomePage Section Area','spiderprime'),
			'section' => 'spiderprime_homepage_section_setting',
			'priority' => 30,
			'homepage_section_page' => true,
			'homepage_section_layout' => true,
			'homepage_section_category' => true,
			'homepage_bg_image' => true,
			'homepage_button_text' => true,		
			'homepage_button_link' => true,
		) ) );


	// Breadcrumbs Settings
	$wp_customize->add_section('spiderprime_breadcrumbs_section', array(
	  'title' => esc_html__('Breadcrumbs Settings', 'spiderprime'),
	  'priority' => 8,
	));

		$wp_customize->add_setting('spiderprime_breadcrumbs_menu', array(
		 'default' => 1,
		 'capability' => 'edit_theme_options',
		 'sanitize_callback' => 'spiderprime_checkbox_sanitize' // done
		));

		$wp_customize->add_control('spiderprime_breadcrumbs_menu', array(
		 'type' => 'checkbox',
		 'label' => esc_html__('Check to Disable the Breadcrumbs Menu', 'spiderprime'),
		 'section' => 'spiderprime_breadcrumbs_section',
		 'settings' => 'spiderprime_breadcrumbs_menu'
		));

		$wp_customize->add_setting('spiderprime_breadcrumbs_background_color', array(
			 'default' => '#8248ac',
			 'priority' => 2,     
			 'capability' => 'edit_theme_options',
			 'sanitize_callback' => 'sanitize_hex_color',  // done
			 'transport'         => 'postMessage',
		));

		$wp_customize->add_control('spiderprime_breadcrumbs_background_color', array(
			 'type'         => 'color',
			 'label'        => esc_html__('Breadcrumbs Background Colors','spiderprime'),
			 'description'  => esc_html__('Select default breadcrumbs background color as you want Note :- if you upload the background image for breadcrumbs then background color is not working.', 'spiderprime'),
			 'section'      => 'spiderprime_breadcrumbs_section',
		));


		$wp_customize->add_setting('spiderprime_breadcrumbs_font_color', array(
		 'default' => '#ffffff',
		 'priority' => 2,     
		 'capability' => 'edit_theme_options',
		 'sanitize_callback' => 'sanitize_hex_color', // done
		 'transport'         => 'postMessage',
		));

		$wp_customize->add_control('spiderprime_breadcrumbs_font_color', array(
		 'type'         => 'color',
		 'label'        => esc_html__('Breadcrumbs Font Colors','spiderprime'),
		 'description'  => esc_html__('Select default breadcrumbs Font color as you want', 'spiderprime'),
		 'section'      => 'spiderprime_breadcrumbs_section',
		));

		$wp_customize->add_setting('spiderprime_breadcrumbs_bg_image', array(
			 'default' => '',
			 'capability' => 'edit_theme_options',
			 'sanitize_callback' => 'esc_url_raw',
			 'transport'         => 'postMessage',
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'spiderprime_breadcrumbs_bg_image', array(
			 'label' => esc_html__('Upload Breadcrumbs Background Image', 'spiderprime'),
			 'section' => 'spiderprime_breadcrumbs_section',
			 'setting' => 'spiderprime_breadcrumbs_bg_image'
		)));	

		$wp_customize->add_setting('spiderprime_breadcrumbs_min_height_options', array(
		  'default' => '250',
		  'capability' => 'edit_theme_options',
		  'sanitize_callback' => 'spiderprime_sanitize_number'  // done
		));

		$wp_customize->add_control('spiderprime_breadcrumbs_min_height_options', array(
		  'type' => 'number',
		  'label' => esc_html__('Enter Min Height For Breadcrumbs', 'spiderprime'),
		  'section' => 'spiderprime_breadcrumbs_section',
		  'settings' => 'spiderprime_breadcrumbs_min_height_options'
		));
 
	   
	// Start of the Design Options
	$wp_customize->add_panel('spiderprime_design_options', array(
	  'capabitity' => 'edit_theme_options',
	  'description' => esc_html__('Change the Design Settings from here as you want', 'spiderprime'),
	  'title' => esc_html__('Layout Settings', 'spiderprime'),
	  'priority' => 9,
	));
		// Archive or Category page Layout only
		$wp_customize->add_section('spiderprime_archive_page_layout_setting', array(
		  'priority' => 5,
		  'title' => esc_html__('Archive Page Layout Settings', 'spiderprime'),
		  'panel'=> 'spiderprime_design_options'
		));

		$wp_customize->add_setting('spiderprime_archive_page_layout', array(
		  'default' => 'rightsidebar',
		  'capability' => 'edit_theme_options',
		  'sanitize_callback' => 'spiderprime_layout_sanitize'  //done
		));

		$wp_customize->add_control(new spiderprime_Image_Radio_Control( $wp_customize, 'spiderprime_archive_page_layout', array(
		  'type' => 'radio',
		  'label' => esc_html__('Select Category Page Layout', 'spiderprime'),
		  'section' => 'spiderprime_archive_page_layout_setting',
		  'settings' => 'spiderprime_archive_page_layout',
		  'choices' => array( 
				'leftsidebar' => get_template_directory_uri() . '/images/left-sidebar.png',  
				'rightsidebar' => get_template_directory_uri() . '/images/right-sidebar.png', 
				'nosidebar' => get_template_directory_uri() . '/images/no-sidebar.png',
		    )
		)));
	
	// Start Footer Section here      
	$wp_customize->add_panel('spiderprime_footer_settings', array(
	  'priority' => 11,
	  'title' => esc_html__('Footer Settings', 'spiderprime'),
	  'capability' => 'edit_theme_options',
	));

	  // Footer Area One Settings
	  $wp_customize->add_section('spiderprime_footer_area_settings', array(
	     'priority' => 5,
	     'title' => esc_html__('Footer Area Settings', 'spiderprime'),
	     'panel'=> 'spiderprime_footer_settings'
	  ));

	  $wp_customize->add_setting('spiderprime_footer_area_enable_disable_section', array(
	     'default' => 'enable',
	     'capability' => 'edit_theme_options',
	     'sanitize_callback' => 'spiderprime_enable_disable_sanitize', // done
	  ));

	  $wp_customize->add_control('spiderprime_footer_area_enable_disable_section', array(
	     'type' => 'radio',
	     'label' => esc_html__('Enable or Disable Footer Area Section', 'spiderprime'),
	     'description' => __('Choose any options as you want','spiderprime'),
	     'section' => 'spiderprime_footer_area_settings',
	     'setting' => 'spiderprime_footer_area_enable_disable_section',
	     'choices' => array(
	        'enable' => esc_html__('Enable', 'spiderprime'),
	        'disable' => esc_html__('Disable', 'spiderprime'),
	  )));

	  $wp_customize->add_setting('spiderprime_footer_area_background_color', array(
	     'default' => '#f6f7f7',
	     'priority' => 2,     
	     'capability' => 'edit_theme_options',
	     'sanitize_callback' => 'sanitize_hex_color',
	     'transport'         => 'postMessage',
	  ));

	  $wp_customize->add_control('spiderprime_footer_area_background_color', array(
	     'type'         => 'color',
	     'label'        => esc_html__('Footer Area Background Colors','spiderprime'),
	     'description'  => esc_html__('Select default footer area background color as you want', 'spiderprime'),
	     'section'      => 'spiderprime_footer_area_settings',
	  ));

	  // Sub Footer Area Settings
	  $wp_customize->add_section('spiderprime_footer_buttom_area_settings', array(
	     'priority' => 5,
	     'title' => esc_html__('Footer Buttom Area Settings', 'spiderprime'),
	     'panel'=> 'spiderprime_footer_settings'
	  ));
	 

	  $wp_customize->add_setting('spiderprime_footer_buttom_area_background_color', array(
	     'default' => '#e9ebeb',
	     'priority' => 2,     
	     'capability' => 'edit_theme_options',
	     'sanitize_callback' => 'sanitize_hex_color', // done
	     'transport'         => 'postMessage',
	  ));

	  $wp_customize->add_control('spiderprime_footer_buttom_area_background_color', array(
	     'type'         => 'color',
	     'label'        => esc_html__('Footer Buttom Area Background Colors','spiderprime'),
	     'description'  => esc_html__('Select default footer buttom area background color as you want', 'spiderprime'),
	     'section'      => 'spiderprime_footer_buttom_area_settings',
	  ));	      

	// End footer section here	
	
	// Text Sanitization
	function spiderprime_text_sanitize( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	// Number Sanitization
	function spiderprime_sanitize_number( $input ) {
	$output = intval($input);
	  return $output;
	} 	   
 

	function spiderprime_layout_sanitize($input) {
		$valid_keys = array( 
	          'leftsidebar' => get_template_directory_uri() . '/images/left-sidebar.png',  
	          'rightsidebar' => get_template_directory_uri() . '/images/right-sidebar.png', 
	          'nosidebar' => get_template_directory_uri() . '/images/no-sidebar.png',
	     );
	  if ( array_key_exists( $input, $valid_keys ) ) {
	     return $input;
	  } else {
	     return '';
	  }
	}
	

	// checkbox sanitization
	function spiderprime_checkbox_sanitize($input) {
	  if ( $input == 1 ) {
	     return 1;
	  } else {
	     return 0;
	  }
	}	

	// radio button yes/no sanitization
	function spiderprime_enable_disable_sanitize($input) {
	   $valid_keys = array(
	     'enable'=> esc_html__('Enable', 'spiderprime'),
	     'disable'=> esc_html__('Disable', 'spiderprime')
	   );
	   if ( array_key_exists( $input, $valid_keys ) ) {
	      return $input;
	   } else {
	      return '';
	   }
	}	

	// Customoizer repiter fields sanitize
	function spiderprime_sanitize_repeater($input){
	  
		$input_decoded = json_decode($input,true);
		$allowed_html = array(
							'br' => array(),
							'em' => array(),
							'strong' => array(),
							'a' => array(
								'href' => array(),
								'class' => array(),
								'id' => array(),
								'target' => array()
							),
							'button' => array(
								'class' => array(),
								'id' => array()
						));
		
		
			if(!empty($input_decoded)) {
				foreach ($input_decoded as $boxk => $box ){
					foreach ($box as $key => $value){
						if ($key == 'text'){
							$value = html_entity_decode($value);
							$input_decoded[$boxk][$key] = wp_kses( $value, $allowed_html);
						} else {
							$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
						}

					}
				}

				return json_encode($input_decoded);
			}
			
			return $input;
	}
	    
}
add_action( 'customize_register', 'spiderprime_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'spiderprime_customize_preview_js' ) ) {
	function spiderprime_customize_preview_js() {
		wp_enqueue_script( 'spiderprime_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20160215', true );
	}
}
add_action( 'customize_preview_init', 'spiderprime_customize_preview_js' );


/**
 * Enqueue scripts in customizer section
 */
if ( ! function_exists( 'spiderprime_customizer_script' ) ) {
	function spiderprime_customizer_script() {
		wp_enqueue_script( 'spiderprime-scustomizer-script', get_template_directory_uri() .'/assets/js/spiderprime_customizer.js', array("jquery","jquery-ui-draggable"),'1.0.0', true  );
	}
}
add_action( 'customize_controls_enqueue_scripts', 'spiderprime_customizer_script' );
