<?php
 // Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 900;
function limit_text($content = false, $length) {
 
// if no content, fail
if($content == false)
return false;
 
//strip shortcodes & tags
$content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $content);
$content = strip_tags($content);
$excerpt_length = $length;
$words = explode(' ', $content, $excerpt_length + 1);
 
//if the content is longer than the limit
if(count($words) > $excerpt_length) :
array_pop($words);
array_push($words, '...', '');
endif;
$content = implode(' ', $words);
$content = '<p>' . $content . '</p>';
 
// Make sure to return the content
return $content;
}

// The excerpt based on words
function my_string_limit_words($hs_string, $hs_word_limit)
{
  $hs_words = explode(' ', $hs_string, ($hs_word_limit + 1));
  if(count($hs_words) > $hs_word_limit)
  array_pop($hs_words);
  return implode(' ', $hs_words).'... ';
}


// The excerpt based on character
function my_string_limit_char($hs_excerpt, $hs_substr=0)
{

	$hs_string = strip_tags(str_replace('...', '...', $hs_excerpt));
	if ($hs_substr>0) {
		$hs_string = substr($hs_string, 0, $hs_substr);
	}
	return $hs_string;
		}


add_action( 'after_setup_theme', 'hs_setup' );


// Remove invalid tags
function hs_remove_invalid_tags($hs_str, $tags) 
{
    foreach($tags as $tag)
    {
    	$hs_str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($hs_str));
    }

    return $hs_str;
}

// Generates a random string (for embedding flash)
function hs_gener_random($length){

	srand((double)microtime()*1000000 );
	
	$hs_random_id = "";
	
	$char_list = "abcdefghijklmnopqrstuvwxyz";
	
	for($i = 0; $i < $length; $i++) {
		$hs_random_id .= substr($char_list,(rand()%(strlen($char_list))), 1);
	}
	
	return $hs_random_id;
}


// Add Thumb Column
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );
	function fb_AddThumbColumn($cols) {
	$cols['thumbnail'] = __('Thumbnail', HS_CURRENT_THEME);
	return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
	$hs_width = (int) 35;
	$hs_height = (int) 35;
	if ( 'thumbnail' == $column_name ) {
		// thumbnail of WP 2.9
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		// image from gallery
		$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
		if ($thumbnail_id)
			$thumb = wp_get_attachment_image( $thumbnail_id, array($hs_width, $hs_height), true );
		elseif ($attachments) {
			foreach ( $attachments as $attachment_id => $attachment ) {
				$thumb = wp_get_attachment_image( $attachment_id, array($hs_width, $hs_height), true );
			}
		}
		if ( isset($thumb) && $thumb ) {
			echo $thumb;
		} else {
			echo __('None', HS_CURRENT_THEME);
		}
	}
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}



// Show filter by categories for custom posts
function hs_restrict_manage_posts() {
	global $typenow;
	$hs_args=array( 'public' => true, '_builtin' => false ); 
	$hs_post_types = get_post_types($hs_args);
	if ( in_array($typenow, $hs_post_types) ) {
	$hs_filters = get_object_taxonomies($typenow);
		foreach ($hs_filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			wp_dropdown_categories(array(
				'show_option_all' => __('Show All '.$tax_obj->label, HS_CURRENT_THEME ),
				'taxonomy' => $tax_slug,
				'name' => $tax_obj->name,
				'orderby' => 'term_order',
				// 'selected' => $_GET[$tax_obj->query_var],
				'hierarchical' => $tax_obj->hierarchical,
				'show_count' => false,
				'hide_empty' => true
			));
		}
	}
}
function hs_convert_restrict($query) {
	global $pagenow;
	global $typenow;
	if ($pagenow=='edit.php') {
		$hs_filters = get_object_taxonomies($typenow);
		foreach ($hs_filters as $tax_slug) {
			$hs_var = &$query->query_vars[$tax_slug];
			if ( isset($hs_var) ) {
				$term = get_term_by('id',$hs_var,$tax_slug);
				// $var = $term->slug;
			}
		}
	}
}
add_action('restrict_manage_posts', 'hs_restrict_manage_posts' );
add_filter('parse_query','hs_convert_restrict');


/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'hs_pagination' ) ) {
	function hs_pagination( $pages = '', $range = 1 ) {
		$showitems = ($range * 2) + 1;

		global $wp_query;
		$paged = (int) $wp_query->query_vars['paged'];
		if( empty($paged) || $paged == 0 ) $paged = 1;

		if ( $pages == '' ) {
			$pages = $wp_query->max_num_pages;
			if( !$pages ) {
				$pages = 1;
			}
		}
		if ( 1 != $pages ) {
			echo "<div class=\"pagination pagination__posts\"><ul>";
			if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<li class='first'><a href='".get_pagenum_link(1)."'>".theme_locals("first")."</a></li>";
			if ( $paged > 1 && $showitems < $pages ) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'>".theme_locals("prev")."</a></li>";

			for ( $i = 1; $i <= $pages; $i++ ) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<li class=\"active\"><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
				}
			}

			if ( $paged < $pages && $showitems < $pages ) echo "<li class='next'><a href=\"".get_pagenum_link($paged + 1)."\">".theme_locals("next")."</a></li>"; 
			if ( $paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages ) echo "<li class='last'><a href='".get_pagenum_link($pages)."'>".theme_locals("last")."</a></li>";
			echo "</ul></div>\n";
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Custom Comments Structure
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'hercules_comment' ) ) {
	function hercules_comment($comment, $args, $depth) {
	     $GLOBALS['comment'] = $comment;
$GLOBALS['depth'] = $depth;
	?> 
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>" class="clearfix">
	     	<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
	      		<div class="wrapper">
	      			<div class="comment-author vcard">
	  	         		<?php echo get_avatar( $comment->comment_author_email, 65 ); ?>
	  	  				
	  	      		</div>
	  		      	<?php if ($comment->comment_approved == '0') : ?>
	  		        	<em><?php _e('Your comment is awaiting moderation.', HS_CURRENT_THEME) ?></em>
	  		      	<?php endif; ?>	      	
	  		     	<div class="extra-wrap">
					<?php printf(__('<span class="author">%1$s</span>' ), get_comment_author_link()) ?><br />
					<?php printf(__('%1$s', HS_CURRENT_THEME ), get_comment_date('F j, Y')) ?>
	  		     		<?php comment_text() ?>	     	
	  		     	</div>
	  		    </div>
		     	<div class="wrapper">
				  	<div class="reply">
				    	<?php //comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span><i class="icon-reply"></i></span>', HS_CURRENT_THEME ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				   	</div>
			 	</div>
	    	</div>
	<?php }
}
//Limited Number of Tags
add_filter('term_links-post_tag','hs_limit_tags');
function hs_limit_tags($terms) {
return array_slice($terms,0,5,true);
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {
	$array = array (
			'<p>['    => '[', 
			']</p>'   => ']', 
			']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumbs
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'hs_breadcrumbs' ) ) {
function hs_breadcrumbs() {

  $showOnHome = 0; // 1 - show "hs_breadcrumbs" on home page, 0 - hide
  $delimiter = '<li class="divider">/</li>'; // divider
  $home = 'Home'; // text for link "Home"
  $showCurrent = 1; // 1 - show title current post/page, 0 - hide
  $before = '<li class="active">'; // open tag for active breadcrumb
  $after = '</li>'; // close tag for active breadcrumb

  global $post;
  $hs_homeLink = home_url();

 if (is_front_page()) {

    if ($showOnHome == 1) echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $hs_homeLink . '">' . $home . '</a><li></ul>';

  } else {

    echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $hs_homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
	
	if ( is_home() ) {
		echo $before . theme_locals("blog") . $after;
	} elseif ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . theme_locals("category_archives").': "' . single_cat_title('', false) . '"' . $after;
    
	} elseif ( is_tax() ) {
      echo $before . 'Post type: "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_search() ) {
      echo $before . theme_locals("fearch_for") . ': "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
      	$post_name = get_post_type();
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $hs_homeLink . '/' . $post_name . '/">' . $post_type->labels->singular_name . '</a></li>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo is_wp_error( $cat_parents = get_category_parents($cat, TRUE, '' . $delimiter . '') ) ? '' : $cat_parents;
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $hs_breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $hs_breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $hs_breadcrumbs = array_reverse($hs_breadcrumbs);
      for ($i = 0; $i < count($hs_breadcrumbs); $i++) {
        echo $hs_breadcrumbs[$i];
        if ($i != count($hs_breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . theme_locals("tag_archives") . ': "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . theme_locals("by") . ' ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . '404' . $after;
    }
	/*
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __(' Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
	*/
    echo '</ul>';
  }
} // end hs_breadcrumbs() 
}?>