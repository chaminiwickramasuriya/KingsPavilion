<?php

if ( ! function_exists( "wp_body_open" ) ) {
	function wp_body_open() {
		do_action( "wp_body_open" );
	}
}

/************ Register Nav Menu*************/
if ( ! function_exists( "_registerMenus" ) ) {
 
    function _registerMenus(){
        register_nav_menus(array(
			'primary-menu' => __( 'Main Menu', 'custom' ),
            'footer-menu' => __( 'Footer Menu', 'custom' ),
			'footer-second-menu' => __( 'Footer Second Menu', 'custom' ),
			'bottom-menu' =>  __( 'Bottom Menu', 'custom' ),
			'hamburger-main-menu'=>  __( 'Hamburger Main Menu', 'custom' ),
			'fixed-menu'=>  __( 'Fixed Menu', 'custom' ),
			'hamburger-bottom-menu'=>  __( 'Hamburger Bottom Menu', 'custom' ),
		));
    }
    add_action( "after_setup_theme", "_registerMenus", 0 );
}

    acf_add_options_page(array(
	"page_title" 	=> "Global Settings",
	"menu_title"	=> "Global Settings",
	"menu_slug" 	=> "global-settings",
	"capability"	=> "edit_posts",
	"redirect"		=> false,
	"position" 		=> "31"
));




// if( function_exists('acf_add_options_page') ) {
// 	acf_add_options_page(array(
// 		'page_title'	=>	'PDF Options',
// 		'menu_title'	=>	'PDF Options',
// 		'menu_slug'		=>	'pdf-options',
// 		'capability'	=>	'edit_posts',
// 		'parent_slug'	=>	'',
// 		'position'		=>	false,
// 		'icon_url'		=>	false,
// 		'redirect'		=>	false,
// 	));
// }

/************add all styles and scripts*************/

add_action('template_redirect', function () {
    if (is_page('stay')) {
        wp_redirect(home_url('/stay/'), 301);
        exit;
    }
});

function add_custom_class_to_stay_menu_item($classes, $item, $args) {
    if (is_post_type_archive('stay') || is_singular('stay')) {
        // Replace with your actual menu item ID or URL
        if ($item->url === 'https://www.kingspavilion.com/stay/') {
            $classes[] = 'stay-active';
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_custom_class_to_stay_menu_item', 10, 3);

function custom_resources()
{

    $version_id = '1.0';

	wp_register_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), $version_id);
	wp_register_style('slick-css', get_template_directory_uri() . '/assets/css/slick.min.css', array(), $version_id);
	wp_register_style('global-css', get_template_directory_uri() . '/assets/css/templates/global.min.css', array(), $version_id);
	wp_register_style('stylesheet', get_stylesheet_uri());
	//wp_register_style('veno-css', get_template_directory_uri() . '/assets/css/venobox.min.css', array(), $version_id);
	wp_register_style('lenis-css', get_template_directory_uri() . '/assets/css/lenis.css', array(), $version_id);
	wp_register_style('fancy-css', get_template_directory_uri() . '/assets/css/fancybox.min.css', array(), $version_id);
	//wp_register_style('nice-css', get_template_directory_uri() . '/assets/css/nice-select.min.css', array(), $version_id);
	wp_register_style('flat-css', get_template_directory_uri() . '/assets/css/flatpickr.min.css', array(), $version_id);
	wp_register_style('booking-widget-css', get_template_directory_uri() . '/assets/css/templates/booking-widget.min.css', array(), $version_id);
	
	wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('slick-css');
    wp_enqueue_style('global-css');
	wp_enqueue_style('stylesheet');
	wp_enqueue_style('lenis-css');
	//wp_enqueue_style('veno-css');
	//wp_enqueue_style('nice-css');
	wp_enqueue_style('flat-css');
	wp_enqueue_style('booking-widget-css');

	/*****************************************************************************************************/

	// wp_register_script('popper-js', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), $version_id, true);
	wp_register_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), $version_id, true);
	wp_register_script('slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), $version_id, true);
    wp_register_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $version_id, true);
	//wp_register_script('veno-js', get_template_directory_uri() . '/assets/js/venobox.min.js', array('jquery'), $version_id, true);
	// wp_register_script('gsap-js', get_template_directory_uri() . '/assets/js/gsap.min.js', array('jquery'), $version_id, true);
	wp_register_script('lenis-js', get_template_directory_uri() . '/assets/js/lenis.min.js', array('jquery'), $version_id, true);
	wp_register_script('scroll-js', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array('jquery'), $version_id, true);
	wp_register_script('fancy-js', get_template_directory_uri() . '/assets/js/fancybox.umd.js', array('jquery'), $version_id, true);
	//wp_register_script('nice-js', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array('jquery'), $version_id, true);
	wp_register_script('flat-js', get_template_directory_uri() . '/assets/js/flatpickr.min.js', array('jquery'), $version_id, true);
	wp_register_script('booking-widget-js', get_template_directory_uri() . '/assets/js/booking-widget.js', array('jquery'), $version_id, true);
	
	wp_enqueue_script('jquery');
	// wp_enqueue_script('popper-js');
	wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('slick-js');
	wp_enqueue_script('main-js');
	//wp_enqueue_script('veno-js');
	wp_enqueue_script('lenis-js');
	wp_enqueue_script('scroll-js');
	//wp_enqueue_script('nice-js');
	wp_enqueue_script('flat-js');
	wp_enqueue_script('booking-widget-js');

	/*********************************Page Wise Styles and Scripts********************************************************* */

	wp_register_style('form-builder-css', get_template_directory_uri() . '/assets/css/templates/form-builder.min.css', array(), $version_id);
	wp_register_style('home-css', get_template_directory_uri() . '/assets/css/templates/home.min.css', array(), $version_id);
	wp_register_style('accommodation-css', get_template_directory_uri() . '/assets/css/templates/accommodation.min.css', array(), $version_id);
	wp_register_style('accommodation-inner-css', get_template_directory_uri() . '/assets/css/templates/accommodation-inner.min.css', array(), $version_id);
	wp_register_style('offers-css', get_template_directory_uri() . '/assets/css/templates/offers.min.css', array(), $version_id);
	wp_register_style('experience-css', get_template_directory_uri() . '/assets/css/templates/experience.min.css', array(), $version_id);
	wp_register_style('gallery-css', get_template_directory_uri() . '/assets/css/templates/gallery.min.css', array(), $version_id);
	wp_register_style('sustainability-css', get_template_directory_uri() . '/assets/css/templates/sustainability.min.css', array(), $version_id);
	wp_register_style('testimonials-css', get_template_directory_uri() . '/assets/css/templates/testimonials.min.css', array(), $version_id);
	wp_register_style('press-awards-css', get_template_directory_uri() . '/assets/css/templates/press-awards.min.css', array(), $version_id);
	wp_register_style('location-css', get_template_directory_uri() . '/assets/css/templates/location.min.css', array(), $version_id);
	wp_register_style('contact-us-css', get_template_directory_uri() . '/assets/css/templates/contact-us.min.css', array(), $version_id);
	wp_register_style('offers-inner-css', get_template_directory_uri() . '/assets/css/templates/offers-inner.min.css', array(), $version_id);


	
	if (is_page_template('templates/gdpr.php')|| is_page_template('templates/newsletter.php') || is_page_template('templates/T09-contact-us.php')) {
        wp_enqueue_style('form-builder-css');
    }

	if(is_page_template('templates/T01-home.php')){
		wp_enqueue_style('home-css');
	}

	if(is_archive('archive-stay.php') ){
		wp_enqueue_style('accommodation-css');
	}

	if(is_singular('stay')){
		wp_enqueue_style('accommodation-inner-css');
	}

	if(is_page_template('templates/T04-offers.php') || is_page_template('templates/T04-our-story.php') ){
		wp_enqueue_style('offers-css');
	}

	if(is_page_template('templates/T06-location.php') ){
		wp_enqueue_style('location-css');
	}

	if(is_page_template('templates/T07-experience.php') || is_page_template('templates/T07-facilities.php') || is_page_template('templates/T07-spa.php') ){
		wp_enqueue_style('experience-css');
	}

	if(is_page_template('templates/T11-gallery.php') ){
		wp_enqueue_style('gallery-css');	
	}

	if(is_page_template('templates/T12-sustainability.php') ){
		wp_enqueue_style('sustainability-css');
	}

	if(is_page_template('templates/T12-sustainability.php') || is_page_template('templates/T11-gallery.php')){
		wp_enqueue_script('fancy-js');
		wp_enqueue_style('fancy-css');
		wp_enqueue_script('gsap-js');
	}

	if(is_page_template('templates/T10-testimornials.php') ){
		wp_enqueue_style('testimonials-css');
	}

	if(is_page_template('templates/T08-press-awards.php') ){
		wp_enqueue_style('press-awards-css');
	}

	if(is_page_template('templates/T09-contact-us.php') ){
		wp_enqueue_style('contact-us-css');
	}

	if(is_page_template('templates/T05-offers-inner.php') ){
		wp_enqueue_style('offers-inner-css');
	}

}
add_action( 'wp_enqueue_scripts', 'custom_resources' );

require_once( "inc/custom-functions.php" );
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';






/*************************Headless Wordpress Settings*************************************** */