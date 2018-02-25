<?php

	/*-----------------------------------------------------------------------------------*/
	/* Set Proper Parent/Child theme paths for inclusion
	/*-----------------------------------------------------------------------------------*/

	@define( 'HS_PARENT_DIR', get_template_directory() );
	@define( 'HS_CHILD_DIR', get_stylesheet_directory() );

	@define( 'HS_PARENT_URL', get_template_directory_uri() );
	@define( 'HS_CHILD_URL', get_stylesheet_directory_uri() );
	
	include (HS_PARENT_DIR . '/includes/locals.php');

	//Loading Custom function
	include(HS_CHILD_DIR . '/includes/custom-function.php');	
	
	//Loading jQuery and Scripts
	require HS_PARENT_DIR . '/includes/theme-scripts.php';
	
	
	//Widget and Sidebar
	require HS_CHILD_DIR . '/includes/sidebar-init.php';
	require HS_PARENT_DIR . '/includes/register-widgets.php';
	include HS_PARENT_DIR . '/includes/widgets/display-widgets.php';
	
	
	//Theme initialization
	require HS_CHILD_DIR . '/includes/theme-init.php';
	
	//Additional function
	require HS_PARENT_DIR . '/includes/theme-function.php';
	
	
	//Shortcodes
	require HS_PARENT_DIR . '/includes/theme_shortcodes/columns.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/shortcodes.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/posts_grid.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/alert.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/tabs.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/toggle.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/html.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/misc.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/progressbar.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/skills.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/table.php';
	require HS_PARENT_DIR . '/includes/theme_shortcodes/heading-entrance.php';
	
	//tinyMCE includes
	include(HS_PARENT_DIR . '/includes/theme_shortcodes/tinymce/tinymce_shortcodes.php');
	
	// Add the pagemeta
	include(HS_PARENT_DIR . '/includes/theme-pagemeta.php');
	
	// Add the postmeta
	include(HS_PARENT_DIR . '/includes/theme-postmeta.php');
	
	// Add the postmeta to Slideshow posts
	include(HS_PARENT_DIR . '/includes/theme-slideshowmeta.php');
	

	//Loading options.php for theme customizer
	include(HS_PARENT_DIR . '/options.php');

	//Plugin Activation
	require(HS_PARENT_DIR . '/includes/class-tgm-plugin-activation.php');
	require(HS_PARENT_DIR . '/includes/register-plugins.php');

	//Loading theme textdomain
	if ( !function_exists('hercules_theme_setup')) {
		function hercules_theme_setup() {
		    load_theme_textdomain( HS_CURRENT_THEME, HS_PARENT_DIR . '/languages' );	 
		}
		add_action('after_setup_theme', 'hercules_theme_setup');
	}	
	
	// removes detailed login error information for security
	add_filter('login_errors',create_function('$hs_a', "return null;"));
	
	/* 
	 * Loads the Options Panel
	 *
	 * If you're loading from a child theme use stylesheet_directory
	 * instead of template_directory
	 */
	if ( !function_exists( 'hs_optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', HS_PARENT_URL . '/admin/' );
		require dirname( __FILE__ ) . '/admin/options-framework.php';
	}
	// Json options backup
	require HS_PARENT_DIR . '/admin/options-json-backup.php';


	
	// Removes Trackbacks from the comment cout	
	if ( !function_exists('comment_count') ) {
		add_filter('get_comments_number', 'comment_count', 0);

		function comment_count( $count ) {
			if ( ! is_admin() ) {
				global $id;
				$args = 'status=approve&post_id=' . $id;
				$comments = get_comments( $args, ARRAY_A );
				$comments_by_type = separate_comments( $comments );
				return count($comments_by_type['comment']);
			} else {
				return $count;
			}
		}
	}
	
	
	// Post Formats
	$hs_formats = array( 
				'aside', 
				'gallery', 
				'link', 
				'image', 
				'quote', 
				'audio',
				'video');
	add_theme_support( 'post-formats', $hs_formats ); 
	add_post_type_support( 'post', 'post-formats' );
	

// Removing rel from category
add_filter( 'the_category', 'hs_remove_cat_rel' );
function hs_remove_cat_rel( $hs_list )
{
    return str_replace(
        array ( 'rel="category tag"', 'rel="category"' ), '', $hs_list
    );
}
	
	// enable shortcodes in sidebar
	add_filter('widget_text', 'do_shortcode');
	
	// custom excerpt ellipses for 2.9+
	if(!function_exists('hs_custom_excerpt_more')) {
	
		function hs_custom_excerpt_more($more) {
			return 'Read More &raquo;';
		}
		add_filter('excerpt_more', 'hs_custom_excerpt_more');
	
	}
	
	// no more jumping for read more link
	if(!function_exists('hs_no_more_jumping')) {
		
		function hs_no_more_jumping($post) {
			return '&nbsp;<a href="'.get_permalink().'" class="read-more">'.'Continue reading &raquo;'.'</a>';
		}
		add_filter('excerpt_more', 'hs_no_more_jumping');
		
	}
	
function hs_admin_css(){ 
echo '<style type="text/css">';
 $logo_margin = of_get_option('logo_margin');
 if ($logo_margin != '') {
 echo '.logo {
    margin: '.$logo_margin.'px auto;
}';
 }else{echo '.logo {margin: 50px auto;}';};
  if(of_get_option('topsearchbticon_color')) {
				echo '.top-panel-button .toggle-button {color:'.of_get_option('topsearchbticon_color').'}';
				}else{echo '.top-panel-button .toggle-button {color:#e1e1e1}';};
  if(of_get_option('topsearchbtborder_color')) {
				echo '.top-panel-button {border-color:'.of_get_option('topsearchbtborder_color').'}';
				}else{echo '.top-panel-button {border-color:#eeeeee}';};
 if(of_get_option('bgmenu_color')) {
				echo '.nav__primary {background:'.of_get_option('bgmenu_color').'}';
				}else{echo '.nav__primary {background:#ffffff}';};
 if(of_get_option('itemsbetween_color')) {
				echo '@media all and (min-width: 800px) {.flexnav > li > a:after {color:'.of_get_option('itemsbetween_color').'}}';
				}else{echo '@media all and (min-width: 800px) {.flexnav > li > a:after {color:#d6d6d6}}';};
 if(of_get_option('lineabove_color')) {
				echo '.nav__primary {border-color:'.of_get_option('lineabove_color').'}';
				}else{echo '.nav__primary {border-color:#eeeeee}';}
 if(of_get_option('tagline_color')) {
				echo '.logo_tagline {color:'.of_get_option('tagline_color').'}';
				}else{echo '.logo_tagline {color:#444444}';};
$overlay_color = of_get_option('overlay_color'); 
			if($overlay_color) {
				echo '.header-overlay {background:'.$overlay_color.'}';
				}
$overlay_transparency = of_get_option('overlay_transparency'); 
			if($overlay_transparency) {
				echo '.header-overlay {-moz-opacity: '.$overlay_transparency.'; -khtml-opacity: '.$overlay_transparency.'; opacity: '.$overlay_transparency.';}';
				}
$hercules_background = of_get_option('body_background');
			if ($hercules_background != '') {
				if ($hercules_background['image'] != '') {
					echo 'body { background-image:url('.$hercules_background['image']. '); background-repeat:'.$hercules_background['repeat'].'; background-position:'.$hercules_background['position'].';  background-attachment:'.$hercules_background['attachment'].'; }';
				}
				if($hercules_background['color'] != '') {
					echo 'body { background-color:'.$hercules_background['color']. ';}';
				}
			}else{
			echo 'body { background-image:url('. get_template_directory_uri() .'/images/patterns/pattern1.png); background-repeat:repeat; background-position:top center;  background-attachment:scroll; background-color:#ffffff; }';
			};
$hercules_header_styling = of_get_option('header_color');
			if ($hercules_header_styling != '') {
				if ($hercules_header_styling['image'] != '') {
					echo '.headerstyler { background-image:url('.$hercules_header_styling['image']. '); background-repeat:'.$hercules_header_styling['repeat'].'; background-position:'.$hercules_header_styling['position'].';  background-attachment:'.$hercules_header_styling['attachment'].'!important; }';
				}
				if($hercules_header_styling['color'] != '') {
					echo '.headerstyler { background-color:'.$hercules_header_styling['color']. ';}';
				}
			}else{echo '.headerstyler { background-color:#ffffff;}';};
$hercules_custom_css = of_get_option('custom_css');
		if($hercules_custom_css) {
		echo of_get_option('custom_css'); 
} 
echo '</style>';
if ( of_get_option('hs_choose_style')=='new_style') {
echo '<style type="text/css">';
		
//Global colors	
$hercules_global_color = of_get_option('global_color'); 
			if($hercules_global_color) {
			echo '.dropcap.bl:first-letter, .text-highlight, .services-grid  .hr, div.jp-play-bar, div.jp-volume-bar-value, .blue, #ascrail2000 div, .progress .bar, .ourclients .hr, .clients .hr, .zoom-icon, .zoom-insta, .zoom-icon-video, .image-mail:hover .zoom-mail, .format-quote, .isotope-item .format-quote, .post-header-article, #showTop, .cbp-spmenu {
background:'.$hercules_global_color.'!important;
}';
echo '.twitter .stream-item-header .account-group .username, .error404-holder_num, .twitter .stream-item-header .account-group .username, .twitter i, .private-image h3, .twitter-code i {
color:'.$hercules_global_color.';
}';
echo '.hi-icon-effect-1 .hi-icon {
box-shadow: 0 0 0 2px '.$hercules_global_color.';
}';
echo '.hi-icon-effect-1 .hi-icon:after {
box-shadow: 0 0 0 4px '.$hercules_global_color.';
}';
			}
			
//Navigation	
$hercules_mainmenu_submenu_hover_button_color = of_get_option('mainmenu_submenu_hover_button_color'); 
			if($hercules_mainmenu_submenu_hover_button_color) {
			
			echo '.flexnav ul li:hover > a, .flexnav li li > a:hover, .flexnav li li.sfHover > a, .flexnav li li.current-menu-item > a { background: '.$hercules_mainmenu_submenu_hover_button_color.' url('.HS_PARENT_URL .'/images/line-menu.png) repeat-x bottom; }';
			}
			
$hercules_mainmenu_submenu_link_color = of_get_option('mainmenu_submenu_link_color'); 
			if($hercules_mainmenu_submenu_link_color) {
			
			echo '.flexnav li ul li a { color: '.$hercules_mainmenu_submenu_link_color.'}';
			}
$hercules_mainmenu_submenu_hover_link_color = of_get_option('mainmenu_submenu_hover_link_color'); 
			if($hercules_mainmenu_submenu_hover_link_color) {
			
			echo '.flexnav li li > a:hover, .flexnav li li.current-menu-item > a { color: '.$hercules_mainmenu_submenu_hover_link_color.'}';
			}
			
$hercules_mainmenu_submenu_button_color = of_get_option('mainmenu_submenu_button_color'); 
			if($hercules_mainmenu_submenu_button_color) {
			
			echo '.flexnav .sub-menu  > li { background: '.$hercules_mainmenu_submenu_button_color.'}';
			echo '.sub-menu li:first-child a:after { border-bottom: 11px solid '.$hercules_mainmenu_submenu_button_color.'}';
			}

$hercules_mainmenu_line_button_color = of_get_option('mainmenu_line_button_color'); 
			if($hercules_mainmenu_line_button_color) {
			
			echo '.flexnav > li > a span, .flexnav > li.current-menu-item > a span, .flexnav > li.current-menu-ancestor  > a span, .flexnav > li > a span, .flexnav li:hover > a span, .flexnav > li > a:hover span { background: '.$hercules_mainmenu_line_button_color.'; }';
			}
			
$hercules_mainmenu_hover_button_color = of_get_option('mainmenu_hover_button_color'); 
			if($hercules_mainmenu_hover_button_color) {
			
			echo '.flexnav > li > a:hover {
 color:'.$hercules_mainmenu_hover_button_color.';
}';
			}

$hercules_mainmenu_current_button_color = of_get_option('mainmenu_current_button_color'); 
			if($hercules_mainmenu_current_button_color) {
			
			echo '.flexnav > li.current-menu-item > a, .flexnav > li.current-menu-ancestor  > a {
 color:'.$hercules_mainmenu_current_button_color.';
}';
			}
			
//Subtitle color		
$hercules_subtitle_styling = of_get_option('subtitle_color'); 
			if($hercules_subtitle_styling) {
			echo '.title-section h2 {
    color: '.$hercules_subtitle_styling.';
}';
			}
//Buttons and links color
		 $hercules_links_styling = of_get_option('links_color'); 
			if($hercules_links_styling) {
				echo 'a, .social_link, .related-posts_item a, .post_author a, .breadcrumb a, .post-list a, .comments-custom a, #wp-calendar a, .tagcloud a, .post_date_grid_filtr a, .flexslider a, .footer .social a, .fs-carousel-header a:hover {color:'.$hercules_links_styling.'}';
				
echo '.btn-color {background-color:'.$hercules_links_styling.'!important; border: 2px solid '.$hercules_links_styling.'!important;}';	
echo '.btn-white:hover, .btn-white:focus {background-color:'.$hercules_links_styling.'!important; border-color:'.$hercules_links_styling.'!important;}';	

echo '.link-image a p {background:'.$hercules_links_styling.';-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=90)";filter: alpha(opacity=90);-moz-opacity: 0.9;-khtml-opacity: 0.9;opacity: 0.9;}';
echo '.link-image a:hover p {background:'.$hercules_links_styling.';-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";filter: alpha(opacity=100);-moz-opacity: 1.0;-khtml-opacity: 1.0;opacity: 1.0;}';		

echo '.form-submit input[type="submit"]:hover, .active .btn, .btn:hover, .btn:focus {
  background: '.$hercules_links_styling.';
  border-color: '.$hercules_links_styling.';
}';

echo '.btn-1c:after {
  background: '.$hercules_links_styling.';
}';

echo '.btn-1c:hover, .btn-1c:active {
  border: 3px solid '.$hercules_links_styling.';
}';

echo '.tagcloud a {
  border: 1px solid '.$hercules_links_styling.';
}';

echo '.flexslider a:hover {
  color: #222222!important;
}';
			}
			echo '</style>';
	 } 
	 }
add_action( 'wp_head', 'hs_admin_css' ); 

	// category id in body and post class
	if(!function_exists('hs_category_id_class')) {
		
		function hs_category_id_class($hs_classes) {
			global $post;
			foreach((get_the_category()) as $category)
				$hs_classes [] = 'cat-' . $category->cat_ID . '-id';
				return $hs_classes;
		}
		add_filter('post_class', 'hs_category_id_class');
		add_filter('body_class', 'hs_category_id_class');
		
	}
	
	// Threaded Comments
	if(!function_exists('hs_enable_threaded_comments')) {
		function hs_enable_threaded_comments()
		{
			if (!is_admin()) {
				if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
					wp_enqueue_script('comment-reply');
				}
			}	
		}
		add_action('get_header', 'hs_enable_threaded_comments');
	}
	
 /* 
 * The CSS file selected in the options panel 'stylesheet' option
 * is loaded on the theme front end
 *
 * If you'd prefer to use the 'auto_stylesheet' option, replace
 * of_get_option('stylesheet') with of_get_option('auto_stylesheet')
 *
 * If the "Default" option is selected, "0" is returned (equivalent to false),
 * which means no files will be registered or enqueued
 */

function hs_options_stylesheets_alt_style()   {
	if ( of_get_option('hs_choose_style')=='defined_style' && of_get_option('stylesheet') ) {
		wp_enqueue_style( 'hs_options_stylesheets_alt_style', of_get_option('stylesheet'), array(), null );
	}
	if ( of_get_option('hs_choose_style')=='' && of_get_option('stylesheet')=='' ) {
	wp_enqueue_style( 'style10' );
	}
}
add_action( 'wp_enqueue_scripts', 'hs_options_stylesheets_alt_style' );


	// Navigation with description
	if (! class_exists('hs_description_walker')) {
		class hs_description_walker extends Walker_Nav_Menu {
			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				global $wp_query;
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$class_names = ' class="'. esc_attr( $class_names ) . '"';

				$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                
				$description  = ! empty( $item->description ) ? '<span class="desc">'.esc_attr( $item->description ).'</span>' : '';

				if($depth != 0) {
					$description = $append = $prepend = "";
				}

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;

				if (isset($prepend))
					$item_output .= $prepend;

				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

				if (isset($append))
					$item_output .= $append;

				$item_output .= $description.$args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}
	
//Unattach &Detach & Re-Attach Media Attachment
	
add_filter("manage_upload_columns", 'hs_upload_columns');
add_action("manage_media_custom_column", 'hs_media_custom_columns', 0, 2);
function hs_upload_columns($columns) {
    unset($columns['parent']);
    $columns['better_parent'] = "Parent";
    return $columns;
}
function hs_media_custom_columns($column_name, $id) {
    $post = get_post($id);
    if($column_name != 'better_parent')
        return;
        if ( $post->post_parent > 0 ) {
            if ( get_post($post->post_parent) ) {
                $title =_draft_or_post_title($post->post_parent);
            }
            ?>
            <strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo get_the_time(__('Y/m/d',HS_CURRENT_THEME)); ?>
            <br />
            <a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Re-Attach',HS_CURRENT_THEME); ?></a>
            <?php
        } else {
            ?>
            <?php _e('(Unattached)',HS_CURRENT_THEME); ?><br />
            <a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Attach',HS_CURRENT_THEME); ?></a>
            <?php
        }
}
//filter to add button to media library UI
function unattach_media_row_action( $actions, $post ) {
	if ($post->post_parent) {
		$url = admin_url('tools.php?page=unattach&noheader=true&&id=' . $post->ID);
		$actions['unattach'] = '<a href="' . esc_url( $url ) . '" title="' . __( "Unattach this media item.",HS_CURRENT_THEME) . '">' . __( 'Unattach',HS_CURRENT_THEME) . '</a>';
	}

	return $actions;
}

//action to set post_parent to 0 on attachment
function unattach_do_it() {
	global $wpdb;
	
	if (!empty($_REQUEST['id'])) {
		$wpdb->update($wpdb->posts, array('post_parent'=>0), array('id'=>$_REQUEST['id'], 'post_type'=>'attachment'));
	}
	
	wp_redirect(admin_url('upload.php'));
	exit;
}

//set it up
add_action( 'admin_menu', 'unattach_init' );
function unattach_init() {
	if ( current_user_can( 'upload_files' ) ) {
		add_filter('media_row_actions',  'unattach_media_row_action', 10, 2);
		//this is hacky but couldn't find the right hook
		add_submenu_page('tools.php', 'Unattach Media', 'Unattach', 'upload_files', 'unattach', 'unattach_do_it');
		remove_submenu_page('tools.php', 'unattach');
	}
}
//Unattach &Detach & Re-Attach Media Attachment

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn-pagination"';
}

function posts_link_next_class($format){
     $format = str_replace('href=', 'class="btn-pagination" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="btn-pagination" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');
function formaticons() {
 $postid = get_the_ID();
 $formaticons = get_post_format( $postid );
 echo edit_post_link( __( 'Edit', HS_CURRENT_THEME ), '<span class="edit-link">', '</span>' );
if(is_sticky()){
	echo "<div class=\"post-formats hidden-phone\"><span class=\"stickyin\">".theme_locals('featured')."</span> <i class=\"icon-pin icon-2x\"></i></div>";
	}else{ 
 switch ($formaticons) {
    case "aside":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-newspaper icon-2x\"></i></div>";
        break;
    case "gallery":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-picture-1 icon-2x\"></i></div>";
        break;
    case "link":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-link-1 icon-2x\"></i></div>";
        break;
	case "image":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-picture icon-2x\"></i></div>"; 
        break;
	case "quote":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-quote icon-2x\"></i></div>";
        break;
	case "audio":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-note-beamed icon-2x\"></i></div>";
        break;
	case "video":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-video icon-2x\"></i></div>";
        break;	
	case "":
        echo "<div class=\"post-formats hidden-phone\"><i class=\"icon-doc-text-1 icon-2x\"></i></div>";
        break;		
}
}
}
add_filter('the_excerpt', 'do_shortcode');
$hs_nicescroll = of_get_option('g_nicescroll');
if ($hs_nicescroll == 'yes') {
function addNiceScroll(){
    $out = "
    <script type=\"text/javascript\">
var niceScrolltrue = 1;	
	jQuery(function($) {
$(\"html\").niceScroll({cursorwidth:8});
  });
    </script>
    ";
  echo $out;
}
add_action('wp_head',"addNiceScroll");
}
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'gallery_categories') ) {
        return 2;
    } else {
        return $option_posts_per_page;
    }
}


// Exclude Sharing The Blog Love from RSS Feed
function exclude_categories_from_rss( $query ) {
	if ($query->is_feed) {
		$query->set( 'cat','-233' );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'exclude_categories_from_rss' );

?>