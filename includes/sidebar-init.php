<?php
function hs_elegance_widgets_init() {
	
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 					=> 'hs_main_sidebar',
		'description'   => __( 'Located at the right side of pages.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="widget"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));

	
	// Bottom 1 Widget Area
	// Location: at the bottom of the footer
	register_sidebar(array(
		'name'					=> 'Bottom 1',
		'id' 					=> 'hs_bottom_1',
		'description'   => __( 'Located at the bottom of pages.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footer_heading"><h5>',
		'after_title' => '</h5></div>',
	));
	
	
		// Bottom 2 Widget Area
	// Location: at the bottom of the footer
	register_sidebar(array(
		'name'					=> 'Bottom 2',
		'id' 					=> 'hs_bottom_2',
		'description'   => __( 'Located at the bottom of pages.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footer_heading"><h5>',
		'after_title' => '</h5></div>',
	));
	
	// Slideshow Widget
	register_sidebar(array(
		'name'					=> 'Slideshow',
		'id' 					=> 'hs_main_slideshow',
		'description'   => __( 'Located below the main menu.', HS_CURRENT_THEME),
		'before_widget' => '<div id="%1$s" class="widget_slideshow">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
}
/** Register sidebars by running hs_elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'hs_elegance_widgets_init' );
?>