<?php

add_action( 'after_setup_theme', 'hs_setup' );

if ( ! function_exists( 'hs_setup' ) ):

function hs_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

		/*  Post Thumbnails  */
	if ( function_exists( 'add_image_size' ) ) {

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'standard-large', 980, 735 );		// Large Blog Image
		add_image_size( 'standard', 700, 525, array( 'center', 'top' ) );			// Standard Blog Image
		add_image_size( 'medium-thumb', 300, 220, array( 'center', 'top' ) );			// medium-thumb Image
		add_image_size( 'gallery-thumb', 573, 430 );			// gallery-thumb Image
		add_image_size( 'slideshow-post', 700, 400, true );			// Slideshow Post
		add_image_size( 'slideshow', 1170, 427, array( 'center', 'top' ) );			// Slideshow Image
		add_image_size( 'small', 194, 150, array( 'center', 'top' ) ); 				// Related posts image
		add_image_size( 'mini', 80, 80, array( 'center', 'top' ) ); 				// sidebar widget image
		set_post_thumbnail_size( 300, 200, array( 'center', 'top' ) ); // Normal post thumbnails
	}
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// custom menu support
	//add_theme_support( 'menus' );
	//if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'header_menu' => __( 'Header Menu', HS_CURRENT_THEME ),
	  		  'footer_menu' => __( 'Footer Menu', HS_CURRENT_THEME ),
	  		)
	  	);
	//}
}
endif;



/* Slideshow */
function my_post_type_slideshow() {      
    register_post_type( 'slideshow',
        array(
            'labels' => array(
                'name' => __( 'Slideshow', HS_CURRENT_THEME ),
                'singular_name' => __( 'Slideshow', HS_CURRENT_THEME )
            ),
        'public' => true,
        'supports' => array ('title', 'editor', 'thumbnail')
        )
    );

    register_taxonomy(
        'slideshow_categories',
        'slideshow',
        array(
            'labels' => array(
                'name' => 'Slideshow Categories',
                'add_new_item' => 'Add New Slideshow Category',
                'new_item_name' => "New Slideshow Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'hasArchive' => true,
			'show_admin_column' => true
        )
    );
	
}
add_action('init', 'my_post_type_slideshow');


/* Gallery */
function my_post_type_gallery() {
	register_post_type( 'gallery',
		array( 
				'label'             => __( 'Gallery', HS_CURRENT_THEME ),
				'singular_label'    => __( 'Gallery', HS_CURRENT_THEME ),
				'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
	'show_in_admin_bar'   => true,
		'query_var'          => true,
		'has_archive'        => true,
		'show_admin_column' => true,
		'hierarchical'       => true,
		'menu_position'      => null,
				'capability_type'   => 'post',
				'rewrite'           => array(
					'slug'       => 'gallery-view',
					'pages' => true,
				),
				'supports' => array(
						'title',
						'editor',
						'thumbnail')
					) 
				);
	register_taxonomy('gallery_categories', 'gallery', array('hierarchical' => true, 'labels' => array(
                'name' => 'Gallery Categories',
                'add_new_item' => 'Add New Gallery Category',
                'new_item_name' => "New Gallery Category"
            ), 'rewrite' => true, 'query_var' => true, 'show_admin_column' => true));
	
}
add_action('init', 'my_post_type_gallery');

/* FAQs */
function phi_post_type_faq() {
	register_post_type('faq', 
				array(
				'label' => __('FAQs', HS_CURRENT_THEME),
				'singular_label' => __('FAQ', HS_CURRENT_THEME),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'show_admin_column' => true,
				'rewrite' => array("slug" => "faq"), // Permalinks
				'query_var' => "faq", // This goes to the WP_Query schema
				'supports' => array('title','author','editor'),
				'menu_position' => 5,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				));
	register_taxonomy(
        'faq_categories',
        'faq',
        array(
            'labels' => array(
                'name' => 'FAQ Categories',
                'add_new_item' => 'Add New FAQ Category',
                'new_item_name' => "New FAQ Category"
            ),
            'show_ui' => true,
            'hierarchical' => true,
            'hasArchive' => true,
			'show_admin_column' => true
        )
    );
	
}
add_action('init', 'phi_post_type_faq');

?>