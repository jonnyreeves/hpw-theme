<?php
/*	Register javascript
/*-----------------------------------------------------------------------------------*/

add_action('init', 'hercules_register_script');
add_action('wp_footer', 'hercules_print_script_footer');
add_action('init', 'hercules_register_head');

function hercules_register_script() {

wp_register_script('flexslider', get_template_directory_uri().'/js/jquery.flexslider.js', array('jquery'), '2.1',true);
wp_register_script('owljs', get_template_directory_uri().'/js/owl.carousel.min.js', array('jquery'), '2.1',true);
wp_register_script('collageplus', get_template_directory_uri().'/js/jquery.collagePlus.min.js', array('jquery'), '0.3.3',true);

wp_register_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js', array('jquery'), '1.3',true);
wp_register_script('magnificpopup', get_template_directory_uri().'/js/jquery.magnificpopup.js', array('jquery'), '0.9.9',true);
wp_register_script('plugins', get_template_directory_uri().'/js/jquery.plugins.js', array('jquery'), '3.1.5',true);
wp_register_script('flexnav', get_template_directory_uri().'/js/jquery.flexnav.min.js', array('jquery'), '3.1.5',true);

wp_register_script('custom', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.0',true);		
wp_register_script('appear', get_template_directory_uri().'/js/jquery.appear.js', array('jquery'), '1.0.0',true);
wp_register_script('classie', get_template_directory_uri().'/js/classie.js', array('jquery'), '1.0.0',true);

wp_register_script('AnimatedHeader', get_template_directory_uri().'/js/AnimatedHeader.js', array('jquery'), '1.0.0',true);

wp_register_script('isotope', get_template_directory_uri().'/js/jquery.isotope.js', array('jquery'), '1.5.25',true);

wp_register_script('debouncedresize', get_template_directory_uri().'/js/jquery.debouncedresize.js', array('jquery'), '1.0',true);
wp_register_script('isotopeinit', get_template_directory_uri().'/js/isotope_init.js', array('jquery'), '1.5.25',true);

wp_register_script('swfobject', home_url().'/wp-includes/js/swfobject.js', array('jquery'), '2.2',true);
wp_register_script('playlist', get_template_directory_uri().'/js/jplayer.playlist.min.js', array('jquery'), '2.1.0',true);
wp_register_script('jplayer', get_template_directory_uri().'/js/jquery.jplayer.min.js', array('jquery'), '2.2.0',true);

wp_register_script('easypie', get_template_directory_uri().'/js/jquery.easy-pie-chart.js', array('jquery'), '1.0.0',true);
wp_register_script('bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', array('jquery'), '2.3.0',true);

}

function hercules_register_head() {
if (!is_admin()) {
wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.js', array('jquery'), '2.0.6');
wp_register_script('nicescroll', get_template_directory_uri().'/js/jquery.nicescroll.js', array('jquery'), '3.5');
wp_register_script('jflickrfeed', get_template_directory_uri().'/js/jflickrfeed.js', array('jquery'), '1.0',false);
wp_enqueue_script('modernizr');
$hs_nicescroll = of_get_option('g_nicescroll');
if ($hs_nicescroll == 'yes') {
wp_enqueue_script('nicescroll');
}
	}
}

function hercules_print_script_footer() {
	global $hercules_add_flexslider;
	global $hercules_add_owl;
	global $hercules_add_collageplus;
	global $hercules_add_donutchart;
	global $hercules_add_swfobject;
	global $hercules_add_playlist;
	global $hercules_add_jplayer;
	global $hercules_add_animatedheader;
	
	wp_enqueue_script(array(
		'easing',
        'flexnav',
		'magnificpopup',
		'plugins', 
		'custom', 
		'appear',
		'bootstrap'
	));
	
	if ( $hercules_add_animatedheader ) {
	wp_enqueue_script('AnimatedHeader');
	wp_enqueue_script('classie');
	}
	
	if ( $hercules_add_jplayer ) {
	wp_enqueue_script('jplayer');
	}
	
	if ( $hercules_add_playlist ) {
	wp_enqueue_script('playlist');
	}
	
	if ( $hercules_add_swfobject ) {
	wp_enqueue_script('swfobject');
	}
	
	if ( $hercules_add_donutchart ) {
	wp_enqueue_script('easypie');
	}
	
	if ( $hercules_add_flexslider ) {
	wp_enqueue_script('flexslider');
	}
	if ( $hercules_add_owl ) {
	wp_enqueue_script('owljs');
	}
	if ( $hercules_add_collageplus ) {
	wp_enqueue_script('collageplus');
	}
	
}

// Loading styles
function hercules_styles()
{
if (!is_admin()) {
		wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/bootstrap.css', false, '2.3', 'all' );
		wp_enqueue_style( 'bootstrap' );
		wp_register_style( 'responsive', get_stylesheet_directory_uri() . '/responsive.css', false, '2.3', 'all' );
		wp_enqueue_style( 'responsive' );
		wp_register_style( 'magnificpopup', get_stylesheet_directory_uri() . '/css/magnificpopup.css', false, '1.0', 'all' );
		wp_enqueue_style( 'magnificpopup' );
		wp_register_style( 'mainstyle', get_stylesheet_directory_uri() . '/style.css', false, '1.2', 'all' );
		wp_enqueue_style( 'mainstyle' );
		wp_register_style( 'style1', get_stylesheet_directory_uri() . '/css/style1.css', false, '1.0', 'all' );
		wp_register_style( 'style2', get_stylesheet_directory_uri() . '/css/style2.css', false, '1.0', 'all' );
		wp_register_style( 'style3', get_stylesheet_directory_uri() . '/css/style3.css', false, '1.0', 'all' );
		wp_register_style( 'style4', get_stylesheet_directory_uri() . '/css/style4.css', false, '1.0', 'all' );
		wp_register_style( 'style5', get_stylesheet_directory_uri() . '/css/style5.css', false, '1.0', 'all' );
		wp_register_style( 'style6', get_stylesheet_directory_uri() . '/css/style6.css', false, '1.0', 'all' );
		wp_register_style( 'style7', get_stylesheet_directory_uri() . '/css/style7.css', false, '1.0', 'all' );
		wp_register_style( 'style8', get_stylesheet_directory_uri() . '/css/style8.css', false, '1.0', 'all' );
		wp_register_style( 'style9', get_stylesheet_directory_uri() . '/css/style9.css', false, '1.0', 'all' );
		wp_register_style( 'style10', get_stylesheet_directory_uri() . '/css/style10.css', false, '1.0', 'all' );
		wp_register_style( 'style11', get_stylesheet_directory_uri() . '/css/style11.css', false, '1.0', 'all' );
		wp_register_style( 'owl', get_stylesheet_directory_uri() . '/css/owl.carousel.css', false, '1.0', 'all' );
		wp_enqueue_style( 'owl' );
	}
}
add_action('wp_enqueue_scripts','hercules_styles');

/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

function hs_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('hs-admin', get_template_directory_uri() . '/js/jquery.custom.admin.js', 'jquery');
		wp_enqueue_script('hs-admin');
		
	}
}
add_action('admin_enqueue_scripts','hs_admin_js',10,1);

?>
