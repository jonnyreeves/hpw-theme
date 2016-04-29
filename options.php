<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if(!function_exists('optionsframework_option_name')) {
	function optionsframework_option_name() {
		// This gets the theme name from the stylesheet (lowercase and without spaces)
			$themename = wp_get_theme();
$themename = preg_replace("/\W/", "_", strtolower($themename) );
		
		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);			
	}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */
 
if(!function_exists('optionsframework_options')) {

	function optionsframework_options() {
	
	//Styles
	$hs_styles_set = array(
			"defined_style" => "Choose from defined styles",
			"new_style" => "Create new style"
	);
		// Logo type
		$hs_logo_type = array(
			"image_logo" => __("Image Logo", HS_CURRENT_THEME),
			"text_logo" => __("Text Logo", HS_CURRENT_THEME)
		);
		// Header position
		$sf_header_array = array(
			"stickyheader" => "Sticky header",
			"normalheader" => "Normal header"
		);
		// Search box in the header
		$g_search_box = array(
			"no" => "No",
			"yes" => "Yes"
		);

		// Breadcrumbs in the page
		$g_breadcrumbs = array(
			"no" => "No",
			"yes" => "Yes"
		);		
		
		//true/false array
			$true_false_array = array(
				"true" => theme_locals("yes"),
				"false" => theme_locals("no")
			);
	//yes/no array
			$yes_no_array = array(
				"yes" => theme_locals("yes"),
				"no" => theme_locals("no")
			);
			//yes/no array
			$pagination_type_array = array(
				"pagnum" => "Links with page numbers",
				"paglink" => "Links only",
				"pagnone" => "None"
			);	
			$featured_images_array = array(
				"featured1" => "Show Featured image on main blog page and single blog page",
				"featured2" => "Show Featured image on main blog page only",
				"featured3" => "Disable Featured images"
			);
		
		// Background Defaults
		$hs_background_defaults = array(
			'color' => '#ffffff', 
			'image' => get_stylesheet_directory_uri() . '/images/patterns/pattern1.png', 
			'repeat' => 'repeat',
			'position' => 'top center',
			'attachment'=>'scroll'
		);
		
		// Background Defaults
		$hs_header_defaults = array(
			'color' => '#ffffff', 
			'image' => '', 
			//'image' => get_stylesheet_directory_uri() . '/images/patterns/pattern1.png', 
			'repeat' => 'no-repeat',
			'position' => 'center center',
			'attachment'=>'fixed'
		);
		
	
		// Fonts
		$hs_typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
		asort($hs_typography_mixed_fonts);
		
		// Footer menu
		$hs_footer_menu_array = array("true" => "Yes","false" => "No");
		
		// Featured image size on the blog.
		$hs_post_image_size_array = array("normal" => "Normal size","large" => "Large size");
		
		// Featured image size on the single page.
		$hs_single_image_size_array = array("normal" => "Normal size","large" => "Large size");
		
		// Meta for blog
		$hs_post_meta_array = array("true" => "Yes","false" => "No");
		
		// Meta for blog
		$hs_post_excerpt_array = array(
			"true" => "Yes",
			"false" => "No"
		);
			
		// If using image radio buttons, define a directory path
		$hs_imagepath =  get_template_directory_uri() . '/includes/images/';
			
		$options = array();

	
		$options[] = array( "name" => "General",
		"icon" => "icon-cog-alt",
							"type" => "heading");
												
		
		$options['body_background'] = array( 
							"name" =>  "Body styling",
							"desc" => "Change the background style.",
							"id" => "body_background",
							"std" => $hs_background_defaults, 
							"type" => "background");					
							
							
		$options['google_mixed_3'] = array( 'name' => 'Body Text',
							'desc' => 'Choose your prefered font for body text. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'google_mixed_3',
							'std' => array( 'size' => '20px', 'lineheight' => '31px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#525252'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
							
		$options['h1_heading'] = array( 'name' => 'H1 Heading',
							'desc' => 'Choose your prefered font for H1 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'h1_heading',
							'std' => array( 'size' => '60px', 'lineheight' => '60px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400',  'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
		
		$options['h2_heading'] = array( 'name' => 'H2 Heading',
							'desc' => 'Choose your prefered font for H2 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'h2_heading',
							'std' => array( 'size' => '40px', 'lineheight' => '40px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
							
		$options['h3_heading'] = array( 'name' => 'H3 Heading',
							'desc' => 'Choose your prefered font for H3 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'h3_heading',
							'std' => array( 'size' => '34px', 'lineheight' => '34px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
		
		$options['h4_heading'] = array( 'name' => 'H4 Heading',
							'desc' => 'Choose your prefered font for H4 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'h4_heading',
							'std' => array( 'size' => '24px', 'lineheight' => '28px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
							
		$options['h5_heading'] = array( 'name' => 'H5 Heading',
							'desc' => 'Choose your prefered font for H5 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'h5_heading',
							'std' => array( 'size' => '21px', 'lineheight' => '32px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
							
		$options['h6_heading'] = array( 'name' => 'H6 Heading',
							'desc' => 'Choose your prefered font for H6 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'h6_heading',
							'std' => array( 'size' => '18px', 'lineheight' => '24px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
		
		
		$options['g_search_box_id'] = array( "name" => "Display search box?",
							"desc" => "Display search box in the header?",
							"id" => "g_search_box_id",
							"type" => "radio",
							"std" => "yes",
							"options" => $yes_no_array);
							
		$options['g_breadcrumbs_id'] = array( "name" => "Display breadcrumbs?",
							"desc" => "Display breadcrumbs in the page?",
							"id" => "g_breadcrumbs_id",
							"type" => "radio",
							"std" => "yes",
							"options" => $yes_no_array);
							
		$options['g_nicescroll'] = array( "name" => "NiceScroll",
							"desc" => "Enable or Disable NiceScroll",
							"id" => "g_nicescroll",
							"type" => "radio",
							"std" => "no",
							"options" => $yes_no_array);

		$options['hs_import'] = array( "name" => "Import/export",
							"desc" => "Enable or Disable Import/export functions",
							"id" => "hs_import",
							"type" => "radio",
							"std" => "no",
							"options" => $yes_no_array);					
		
		$options[] = array( "name" => "Header styling",
		"icon" => "icon-params",
							"type" => "heading");
$options['header_color'] = array( "name" => "Header background image / background color",
							"desc" => "Change the header background image or background color.",
							"id" => "header_color",
							"std" => $hs_header_defaults,
							"type" => "background");
							
		$options['overlay_color'] = array( "name" => "Header overlay",
							"desc" => "Change the header overlay color.",
							"id" => "overlay_color",
							"std" => "#ffffff",
							"type" => "color");

				$options['overlay_transparency'] = array( "name" => "Header overlay transparency",
							"desc" => "Change the header overlay color transparency. Enter value from 0.0 to 1",
							"id" => "overlay_transparency",
							"std" => "0.85",
							"type" => "text");				

		$options['header_position'] = array( "name" => "Header type",
                            "desc" => "Change the header type (normal or sticky)",
                            "id" => "header_position",
                            "std" => "normalheader",
                            "type" => "select",
                            "class" => "tiny", //mini, tiny, small
                            "options" => $sf_header_array);
							
		$options['topsearchbtborder_color'] = array( "name" => "Top search button border color",
							"desc" => "Change the border color of the top search button.",
							"id" => "topsearchbtborder_color",
							"std" => "#eeeeee",
							"type" => "color");					
		
        $options['topsearchbticon_color'] = array( "name" => "Top search button icon color",
							"desc" => "Change the icon color of the top search button.",
							"id" => "topsearchbticon_color",
							"std" => "#e1e1e1",
							"type" => "color");			
							
		$options[] = array( "name" => "Theme styles",
		"icon" => "icon-monitor",
							"type" => "heading");
							
		$options['hs_choose_style'] = array( "name" => "Choose theme style",
							"desc" => "Choose whether you want to select a defined css style or create your own one.",
							'id' => 'hs_choose_style',
							'class' => 'hidden_control',
							"std" => "defined_style",
							"type" => "select",
							"options" => $hs_styles_set);
//Styling the theme START
$options['links_color'] = array( "name" => "Buttons and links color",
							"desc" => "Change the color of buttons and links.",
							"id" => "links_color",
							"std" => "#00e7b4",
							'class' => 'hiddenitems',
							"type" => "color");
							
		$options['subtitle_color'] = array( "name" => "Subtitle color",
							"desc" => "Change the color of subtitle.",
							"id" => "subtitle_color",
							"std" => "#00e7b4",
							'class' => 'hiddenitems',
							"type" => "color");	

		$options['global_color'] = array( "name" => "Global color",
							"desc" => "Change the global color for the elements like progress bars etc.",
							"id" => "global_color",
							"std" => "#00e7b4",
							'class' => 'hiddenitems',
							"type" => "color");		
							
		$options['mainmenu_current_button_color'] = array( "name" => "Current/active main menu link color",
							"desc" => "Change the color of the current/active main menu link.",
							"id" => "mainmenu_current_button_color",
							"std" => "#00e7b4",
							'class' => 'hiddenitems',
							"type" => "color");	

		$options['mainmenu_hover_button_color'] = array( "name" => "Hover main menu link color",
							"desc" => "Change the color of the main menu link hover.",
							"id" => "mainmenu_hover_button_color",
							"std" => "#cccccc",
							'class' => 'hiddenitems',
							"type" => "color");	
							
        $options['mainmenu_line_button_color'] = array( "name" => "Color of the line above the main button",
							"desc" => "Change the color of the line above the main button.",
							"id" => "mainmenu_line_button_color",
							"std" => "#dddddd",
							'class' => 'hiddenitems',
							"type" => "color");
							
		$options['mainmenu_submenu_link_color'] = array( "name" => "Submenu link color",
							"desc" => "Change the color of the submenu link.",
							"id" => "mainmenu_submenu_link_color",
							"std" => "#ffffff",
							'class' => 'hiddenitems',
							"type" => "color");	

		$options['mainmenu_submenu_hover_link_color'] = array( "name" => "Submenu hover/active link color",
							"desc" => "Change the color of the hover/active submenu link.",
							"id" => "mainmenu_submenu_hover_link_color",
							"std" => "#222222",
							'class' => 'hiddenitems',
							"type" => "color");					
							
		$options['mainmenu_submenu_button_color'] = array( "name" => "Submenu button color",
							"desc" => "Change the color of the submenu button.",
							"id" => "mainmenu_submenu_button_color",
							"std" => "#00e7b4",
							'class' => 'hiddenitems',
							"type" => "color");

		$options['mainmenu_submenu_hover_button_color'] = array( "name" => "Submenu hover/active button color",
							"desc" => "Change the color of the hover/active submenu button.",
							"id" => "mainmenu_submenu_hover_button_color",
							"std" => "#ffffff",
							'class' => 'hiddenitems',
							"type" => "color");			
							
//Styling the theme END				
							
		$options[] = array( "name" => "Select a Stylesheet to be Loaded",
	"desc" => "This is a manually defined list of stylesheets.",
	'id' => 'stylesheet',
	"std" => get_stylesheet_directory_uri() . '/css/style10.css',
	'class' => 'showitems',
	"type" => "images",
	"options" => array(
	get_stylesheet_directory_uri() . '/css/style1.css' => $hs_imagepath . 'green.png',
	get_stylesheet_directory_uri() . '/css/style2.css' => $hs_imagepath . 'red.png',
	get_stylesheet_directory_uri() . '/css/style3.css' => $hs_imagepath . 'gold.png',
	get_stylesheet_directory_uri() . '/css/style4.css' => $hs_imagepath . 'blue.png',
	get_stylesheet_directory_uri() . '/css/style5.css' => $hs_imagepath . 'vanilla.png',
	get_stylesheet_directory_uri() . '/css/style6.css' => $hs_imagepath . 'orange.png',
	get_stylesheet_directory_uri() . '/css/style7.css' => $hs_imagepath . 'black.png',
	get_stylesheet_directory_uri() . '/css/style8.css' => $hs_imagepath . 'mint.png',
	get_stylesheet_directory_uri() . '/css/style9.css' => $hs_imagepath . 'violet.png',
	get_stylesheet_directory_uri() . '/css/style10.css' => $hs_imagepath . 'salmon.png',
	get_stylesheet_directory_uri() . '/css/style11.css' => $hs_imagepath . 'pink.png')
);	

$options[] = array( "name" => "Custom CSS",
							"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
							"id" => "custom_css",
							"std" => "",
							'class' => '',
							"type" => "textarea");	

		
		$options[] = array( "name" => "Logo & Favicon",
		"icon" => "icon-tags",
							"type" => "heading");
							
				$options['logo_margin'] = array( "name" => "Logo margin",
							"desc" => "Enter the top and bottom margin value (Do not enter the px unit.)",
							"id" => "logo_margin",
							"std" => "50",
							"class" => "small",
							"type" => "text");
							
		$options['hs_logo_type'] = array( "name" => "What kind of logo?",
							"desc" => "Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your Site Title will be shown instead.",
							"id" => "logo_type",
							"std" => "text_logo",
							"type" => "radio",
							"options" => $hs_logo_type);

		$options[] = array( 'name' => 'Logo Typography',
							'desc' => 'Choose your prefered font for menu. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'logo_typography',
							'std' => array( 'size' => '73px', 'lineheight' => '45px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);

							
		$options['logo_url'] = array( "name" => "Logo Image Path",
							"desc" => "Click Upload or Enter the direct path to your <strong>logo image</strong>. For example <em>http://your_website_url_here/wp-content/themes/themeXXXX/images/logo.png</em>",
							"id" => "logo_url",
							"std" => "",
							"type" => "upload");
							
		$options['favicon'] = array( "name" => "Favicon",
							"desc" => "Click Upload or Enter the direct path to your <strong>favicon</strong>. For example <em>http://your_website_url_here/wp-content/themes/themeXXXX/favicon.ico</em>",
							"id" => "favicon",
							"std" => get_stylesheet_directory_uri() . "/favicon.ico",
							"type" => "upload");
		
        $options['logo_tagline'] = array( "name" => "Display logo tagline?",
							"desc" => "Do you want to display tagline under the logo?",
							"id" => "logo_tagline",
							"std" => "yes",
							"type" => "radio",
							"options" => $yes_no_array);		
							
		$options['tagline_color'] = array( "name" => "Tagline color",
							"desc" => "Change the tagline color.",
							"id" => "tagline_color",
							"std" => "#444444",
							"type" => "color");					
		
		
		$options[] = array( "name" => "Navigation",
		"icon" => "icon-menu",
							"type" => "heading");

		$options[] = array( 'name' => 'Menu Typography',
							'desc' => 'Choose your prefered font for menu. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'menu_typography',
							'std' => array( 'size' => '18px', 'lineheight' => '21px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#222222'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);
		
		$options['bgmenu_color'] = array( "name" => "Background Color of the main menu",
							"desc" => "Change the background color of the main menu.",
							"id" => "bgmenu_color",
							"std" => "#ffffff",
							"type" => "color");	
							
		$options['lineabove_color'] = array( "name" => "Color of the line above the main menu",
							"desc" => "Change the color of the line above the main menu.",
							"id" => "lineabove_color",
							"std" => "#eeeeee",
							"type" => "color");					

		$options['itemsbetween_color'] = array( "name" => "Color of the line between menu items",
							"desc" => "Change the color of the line between menu items.",
							"id" => "itemsbetween_color",
							"std" => "#d6d6d6",
							"type" => "color");							
		

		$options[] = array( "name" => "Blog",
		"icon" => "icon-doc-text",
							"type" => "heading");				
		
		$options[] = array( "name" => "Blog Single Page Title",
							"desc" => "Enter Your Blog Title used on Blog page.",
							"id" => "blog_text",
							"std" => "Blog",
							"type" => "text");
							
		$options[] = array( "name" => "Blog Single Page Subtitle",
							"desc" => "Enter Your Blog Subtitle used on Blog page.",
							"id" => "blog_sub",
							"std" => "The place where we write some words",
							"type" => "text");					
		
		$options[] = array( "name" => "Related Posts Title",
							"desc" => "Enter Your Title used on Single Post page for related posts.",
							"id" => "blog_related",
							"std" => "Related Posts",
							"type" => "text");
							
		$options[] = array( "name" => "The text before the author's name.",
							"desc" => "Enter Your text before the author's name that appears in the list of articles.",
							"id" => "blog_author_name",
							"std" => "By",
							"type" => "text");		

		$options['post_author'] = array( "name" => "Enable post author for blog posts?",
							"desc" => "Enable or Disable post author name for blog posts.",
							"id" => "post_author",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	
							
		$options['full_content'] = array( "name" => "Enable full text content posts?",
							"desc" => "Enable or Disable full text content posts.",
							"id" => "full_content",
							"std" => "false",
							"type" => "radio",
							"options" => $hs_post_meta_array);					

$options['post_sidebar'] = array( "name" => "Enable sidebar on single blog post page?",
							"desc" => "Enable or Disable sidebar on single blog post page.",
							"id" => "post_sidebar",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);							
		
		$options['blog_sidebar_pos'] = array( "name" => "Sidebar position",
							"desc" => "Choose sidebar position.",
							"id" => "blog_sidebar_pos",
							"std" => "right",
							"type" => "images",
							"options" => array(
								'left' => $hs_imagepath . '2cl.png',
								'right' => $hs_imagepath . '2cr.png')
								//'col' => $hs_imagepath . '1col.png')
							);
		$options['masonry_category'] = array( "name" => "Enable masonry style on category archive page?",
							"desc" => "Enable or Disable masonry style on category archive page.",
							"id" => "masonry_category",
							"std" => "false",
							"type" => "radio",
							"options" => $hs_post_meta_array);
							
			$options['category_name'] = array( "name" => "Category name",
								"desc" => "Do you want to display only the name of the category?",
								"id" => "category_name",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);
			
			$options['category_word'] = array( "name" => "Category word",
								"desc" => "Should the Category word be displayed?",
								"id" => "category_word",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);
							
			$options['blog_excerpt_count'] = array( "name" => "Excerpt words",
							"desc" => "Excerpt length (words).",
							"id" => "blog_excerpt_count",
							"std" => "55",
							"class" => "small",
							"type" => "text");								
							
		$options['post_image_size'] = array( "name" => "Blog standard post type image size",
							"desc" => "Featured image size on the blog.",
						"id" => "post_image_size",
						"type" => "select",
						"std" => "large",
						"class" => "small", //mini, tiny, small
						"options" => $hs_post_image_size_array);
		
		$options['single_image_size'] = array( "name" => "Single, standard post type image size",
							"desc" => "Featured image size on the single page.",
							"id" => "single_image_size",
							"type" => "select",
							"std" => "large",
							"class" => "small", //mini, tiny, small
							"options" => $hs_single_image_size_array);
		
		$options['featured_images'] = array( "name" => "Featured image",
							"desc" => "Enable or Disable Featured images",
							"id" => "featured_images",
							"type" => "select",
							"std" => "featured1",
							"options" => $featured_images_array);
							
		$options['post_meta'] = array( "name" => "Enable Meta for blog posts?",
							"desc" => "Enable or Disable meta information for blog posts.",
							"id" => "post_meta",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);
		
		$options['post_excerpt'] = array( "name" => "Enable excerpt for blog posts?",
							"desc" => "Enable or Disable excerpt for blog posts.",
							"id" => "post_excerpt",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_excerpt_array);
							
		

			$options['post_date'] = array( "name" => theme_locals('post_date_name'),
								"desc" => theme_locals('post_date_desc'),
								"id" => "post_date",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);
								
			$options[] = array( "name" => "Posts date format.",
							"desc" => "Enter posts date format. For more information go to http://codex.wordpress.org/Formatting_Date_and_Time - Formatting Date and Time website. For example, the format string: l, F j, Y creates a date that look like this: Friday, September 24, 2004",
							"id" => "date_format",
							"std" => "l, F j, Y",
							"type" => "text");

					$options['pagination_type'] = array( "name" => "Page numbering",
							"desc" => "Choose pagination type",
							"id" => "pagination_type",
							"type" => "radio",
							"std" => "paglink",
							"options" => $pagination_type_array);				

			$options['post_author'] = array( "name" => theme_locals('post_author_name'),
								"desc" => theme_locals('post_author_desc'),
								"id" => "post_author",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);

			$options['post_permalink'] = array( "name" => theme_locals('post_permalink_name'),
								"desc" => theme_locals('post_permalink_desc'),
								"id" => "post_permalink",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);

			$options['post_category'] = array( "name" => theme_locals('post_category_name'),
								"desc" => theme_locals('post_category_desc'),
								"id" => "post_category",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);			

			$options['post_tag'] = array( "name" => theme_locals('post_tag_name'),
								"desc" => theme_locals('post_tag_desc'),
								"id" => "post_tag",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);			

			$options['post_comment'] = array( "name" => theme_locals('post_comment_name'),
								"desc" => theme_locals('post_comment_desc'),
								"id" => "post_comment",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);
			
			$options['related_post'] = array( "name" => "Enable related posts?",
								"desc" => "Enable or Disable related posts.",
								"id" => "related_post",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);					
			
			$options['readmore_button'] = array( "name" => "Enable readmore button?",
								"desc" => "Enable or Disable readmore button",
								"id" => "readmore_button",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);
								
		$options[] = array( "name" => "Social Networks",
		"icon" => "icon-share",
							"type" => "heading");	
							
		$options['social_share'] = array( "name" => "Enable Social sharing for blog posts?",
							"desc" => "Enable or Disable Social sharing for blog posts.",
							"id" => "social_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	

		$options['shareon'] = array( "name" => "Display Share on text",
							"desc" => "Should Share on text be displayed?",
							"id" => "shareon",
							"std" => "false",
							"type" => "radio",
							"options" => $hs_post_meta_array);						

$options['facebook_share'] = array( "name" => "Enable Facebook sharing for blog posts?",
							"desc" => "Enable or Disable Facebook sharing for blog posts.",
							"id" => "facebook_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	
							
$options['twitter_share'] = array( "name" => "Enable Twitter sharing for blog posts?",
							"desc" => "Enable or Disable Twitter sharing for blog posts.",
							"id" => "twitter_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);		

$options['gplus_share'] = array( "name" => "Enable Google Plus sharing for blog posts?",
							"desc" => "Enable or Disable Google Plus sharing for blog posts.",
							"id" => "gplus_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);

$options['digg_share'] = array( "name" => "Enable Digg sharing for blog posts?",
							"desc" => "Enable or Disable Digg sharing for blog posts.",
							"id" => "digg_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	

$options['reddit_share'] = array( "name" => "Enable Reddit sharing for blog posts?",
							"desc" => "Enable or Disable Reddit sharing for blog posts.",
							"id" => "reddit_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	

$options['linkedin_share'] = array( "name" => "Enable Linkedin sharing for blog posts?",
							"desc" => "Enable or Disable Linkedin sharing for blog posts.",
							"id" => "linkedin_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	

$options['pinterest_share'] = array( "name" => "Enable Pinterest sharing for blog posts?",
							"desc" => "Enable or Disable Pinterest sharing for blog posts.",
							"id" => "pinterest_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	

$options['stumbleupon_share'] = array( "name" => "Enable Stumbleupon sharing for blog posts?",
							"desc" => "Enable or Disable Stumbleupon sharing for blog posts.",
							"id" => "stumbleupon_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);	
							
$options['vkontakte_share'] = array( "name" => "Enable vkontakte sharing for blog posts?",
							"desc" => "Enable or Disable vkontakte sharing for blog posts.",
							"id" => "vkontakte_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);

$options['tumblr_share'] = array( "name" => "Enable Tumblr sharing for blog posts?",
							"desc" => "Enable or Disable Tumblr sharing for blog posts.",
							"id" => "tumblr_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);

$options['email_share'] = array( "name" => "Enable Email sharing for blog posts?",
							"desc" => "Enable or Disable Email sharing for blog posts.",
							"id" => "email_share",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_post_meta_array);							

		$options[] = array( "name" => "Blog grid",
		"icon" => "icon-windows",
							"type" => "heading");

		$options['folio_filter'] = array( "name" => "Filter",
							"desc" => "Blog filter.",
							"id" => "folio_filter",
							"std" => "cat",
							"type" => "select",
							"options" => array(
											"cat"	=>	"by Category",
											"none"	=>	"None"));

		$options['items_count2'] = array( "name" => "Blog masonry 2 columns items amount",
							"desc" => "Post items amount per page for Blog masonry 2 columns template.",
							"id" => "items_count2",
							"std" => "12",
							"class" => "small",
							"type" => "text");

		$options['items_count3'] = array( "name" => "Blog masonry 3 columns items amount",
							"desc" => "Post items amount per page for Blog masonry 3 columns template.",
							"id" => "items_count3",
							"std" => "12",
							"class" => "small",
							"type" => "text");
		
		$options['items_count4'] = array( "name" => "Blog masonry 4 columns items amount",
							"desc" => "Post items amount per page for Blog masonry 4 columns template.",
							"id" => "items_count4",
							"std" => "12",
							"class" => "small",
							"type" => "text");
		
		$options[] = array( "name" => "Gallery",
		"icon" => "icon-picture-1",
							"type" => "heading");

		$options['gallery_columns'] = array( "name" => "Number of columns",
							"desc" => "Choose the number of columns (2, 3, 4 or 5)",
							"id" => "gallery_columns",
							"std" => "3",
							"type" => "select",
							"options" => array(
											"2"	=>	"2 columns",
											"3"	=>	"3 columns",
											"4"	=>	"4 columns",
											"5"	=>	"5 columns"));

		$options['images_per_page'] = array( "name" => "Images per page",
							"desc" => "Set number of thumbnail images per gallery page.",
							"id" => "images_per_page",
							"std" => "6",
							"class" => "small",
							"type" => "text");

		$options['gallery_title'] = array( "name" => "Image titles",
								"desc" => "Display image titles",
								"id" => "gallery_title",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);

		$options['gallery_category'] = array( "name" => "Image category",
								"desc" => "Display image category",
								"id" => "gallery_category",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);								
		
		$options['gallery_description'] = array( "name" => "Image description",
								"desc" => "Display image description",
								"id" => "gallery_description",
								"std" => "yes",
								"class" => "post_meta_options",
								"type" => "radio",
								"options" => $yes_no_array);
		
		$options[] = array( "name" => "Footer",
		"icon" => "icon-doc-landscape",
							"type" => "heading");
		
		$options['footer_text'] = array( "name" => "Footer copyright text",
							"desc" => "Enter text used in the right side of the footer. HTML tags are allowed.",
							"id" => "footer_text",
							"std" => "Copyrights &copy; 2014 BUZZBLOG. All Rights Reserved.",
							"type" => "textarea");
		
		$options[] = array( "name" => "Google Analytics Code",
							"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
							"id" => "ga_code",
							"std" => "",
							"type" => "textarea");
		
		$options['feed_url'] = array( "name" => "Feedburner URL",
							"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website.",
							"id" => "feed_url",
							"std" => "",
							"type" => "text");
		
		$options['footer_menu'] = array( "name" => "Display Footer Menu?",
							"desc" => "Do you want to display footer menu?",
							"id" => "footer_menu",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_footer_menu_array);
							
		$options['footer_logo'] = array( "name" => "Display Footer Logo?",
							"desc" => "Do you want to display logo in the footer?",
							"id" => "footer_logo",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_footer_menu_array);

		$options['footer_lowest'] = array( "name" => "Display the lowest Footer Section?",
							"desc" => "Do you want to display the lowest footer section?",
							"id" => "footer_lowest",
							"std" => "true",
							"type" => "radio",
							"options" => $hs_footer_menu_array);						

		$options[] = array( 'name' => 'Footer Menu Typography',
							'desc' => 'Choose your prefered font for menu. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',
							'id' => 'footer_menu_typography',
							'std' => array( 'size' => '13px', 'lineheight' => '22px', 'face' => 'playfair_displayregular', 'style' => 'normal', 'weight' => '400', 'character'  => 'latin', 'color' => '#667078'),
							'type' => 'typography',
							'options' => array(
									'faces' => $hs_typography_mixed_fonts )
							);				
		
		return $options;
	}
	
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');


if(!function_exists('optionsframework_custom_scripts')) {

	function optionsframework_custom_scripts() { ?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {
		
		if(jQuery('.hidden_control').find('select').val()=="new_style") {
            jQuery('.hiddenitems').slideDown();
			jQuery('.showitems').slideUp();
        } else {
            jQuery('.hiddenitems').slideUp();
			jQuery('.showitems').slideDown();
        }
		
jQuery('.hidden_control').each(function() {
    var control = jQuery(this);
    control.find('select').change(function () {
        if(jQuery(this).val()=="new_style") {
            jQuery('.hiddenitems').slideDown();
			jQuery('.showitems').slideUp();
        } else {
            jQuery('.hiddenitems').slideUp();
			jQuery('.showitems').slideDown();
        }
    });
});
		});
		</script>
		<?php
		}
}