<?php
/**
 * Post Grid
 *
 */

function posts_grid_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' => '',
		'category' => '', 
		'columns' => '3',
		'rows' => '3',
		'order_by' => 'date',
		'order' => 'DESC',
		'meta' => '',
		'isdate' => '',
		'excerpt_count' => '15',
		'link' => 'yes',
		'link_text' => 'Read More',
		'custom_class' => ''
	), $atts));


	$spans = $columns;

	// columns
	switch ($spans) {
		case '1':
			$spans = 'span12';
			break;
		case '2':
			$spans = 'span6';
			break;
		case '3':
			$spans = 'span4';
			break;
		case '4':
			$spans = 'span3';
			break;
		case '6':
			$spans = 'span2';
			break;
	}

	// check what order by method user selected
	switch ($order_by) {
		case 'date':
			$order_by = 'post_date';
			break;
		case 'title':
			$order_by = 'title';
			break;
		case 'popular':
			$order_by = 'hs_comment_count';
			break;
		case 'random':
			$order_by = 'rand';
			break;
	}

	// check what order method user selected (DESC or ASC)
	switch ($order) {
		case 'DESC':
			$order = 'DESC';
			break;
		case 'ASC':
			$order = 'ASC';
			break;
	}

	// show link after posts?
	switch ($link) {
		case 'yes':
			$link = true;
			break;
		case 'no':
			$link = false;
			break;
	}

		global $post;
		global $my_string_limit_words;

		$numb = $columns * $rows;
						
		$args = array(
			'post_type' => $type,
			'category' => $category,
			'numberposts' => $numb,
			'orderby' => $order_by,
			'order' => $order
		);		

		$posts = get_posts($args);
		$i = 0;
		$count = 1;
		$output_end = '';
		if ($numb > count($posts)) {
			$output_end = '</ul>';
		}

		$output = '<ul class="posts-grid row-fluid unstyled '. $custom_class .'">';

		for ( $j=0; $j < count($posts); $j++ ) {
			$post_id = $posts[$j]->ID;
			setup_postdata($posts[$j]);
			$excerpt = get_the_excerpt();
			$teampos = get_post_meta($post_id, 'my_team_pos', true);
			$formaticons = get_post_format( $post_id ); 
			$link_format_url =  get_post_meta($post_id, 'tz_link_url', true);
			if(has_post_thumbnail($post_id)) {
			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'standard', true );
			}

				if ($count > $columns) {
					$count = 1;
					$output .= '<ul class="posts-grid row-fluid unstyled '. $custom_class .'">';
				}

				$output .= '<li class="'. $spans .'">';
				if($formaticons == "quote") {
					$output .= '<div class="isotope-item"><div class="format-quote">';

	 $quote =  get_post_meta($post_id, 'tz_quote', true);
	 $author =  get_post_meta($post_id, 'tz_author_quote', true);

	$output .= '<div class="quote-wrap clearfix">';
			$output .= '<div class="quote">';
			$output .= $quote;
			$output .= '</div>';
		 if($author) { 
		$output .= '<span>';
		$output .=  '&mdash; ' . $author;
			$output .= '</span>';
		 }
	$output .= '</div></div></div>';

					}else{
					if(has_post_thumbnail($post_id)) {
					

					$output .= '<div style="position:relative; margin: 0 auto; ">';
						$output .= '<figure class="featured-thumbnail-grid"><a class="image-wrap" href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= '<img src="'.$attachment_url[0].'" width="'.$attachment_url[1].'" height="'.$attachment_url[2].'" alt="'.get_the_title($post_id).'" />';
						$output .= '<div class="zoom-icon"></div>';
						$output .= '</a></figure></div>';
					} 
					
					$output .= '<div style="padding:30px 0 30px 0;">';
$output .= '<div class="post_title_grid">';
				if ($formaticons == "link") {
						$output .= '<h5><a href="'.$link_format_url.'" title="'.get_the_title($post_id).'">';
						$output .= $link_format_url;
						$output .= '</a></h5>';

					//Other formats
					} else {
					$output .= '<h5><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= get_the_title($post_id);
					$output .= '</a></h5>';
					
					}
															if ($isdate == "yes") {
$output .= '<span>';
						$output .= '<time datetime="'.get_the_time('l, F j, Y', $post_id).'">'.get_the_time('l, F j, Y', $post_id).'</time>';
						
						$output .= '</span>';
					}

$output .= '</div>';
					if ($meta == 'yes') {
						// begin post meta
						$output .= '<div class="post_meta_grid">';

							// post category
							$output .= '<span class="post_category_grid">';
							if ($type!='' && $type!='post') {
								$terms = get_the_terms( $post_id, $type.'_category');
								if ( $terms && ! is_wp_error( $terms ) ) {
									$out = array();
									$output .= 'Posted in ';
									foreach ( $terms as $term )
										$out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
										$output .= join( ', ', $out );
								}
							} else {
								$categories = get_the_category();
								if($categories){
									$out = array();
									$output .= 'Posted in ';
									foreach($categories as $category)
										$out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
										$output .= join( ', ', $out );
								}
							}
							$output .= '</span>';

							

							// post author
							$output .= '<span class="post_author_grid">';
							$output .= ' By ';
							$output .= '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a>';
							$output .= '</span>, ';
							
					// post comment count
							$num = 0;						
							$queried_post = get_post($post_id);
							$cc = $queried_post->hs_comment_count;
							if( $cc == $num || $cc > 1 ) : $cc = $cc.' Comments';
							else : $cc = $cc.' Comment';
							endif;
							$permalink = get_permalink($post_id);
							$output .= '<span class="post_comment_grid">';
							$output .= '<a href="'. $permalink . '" class="comments_link">' . $cc . '</a>';
							$output .= '</span>';
							

						$output .= '</div>';
						// end post meta
						
}

					if($excerpt_count >= 1){
						$output .= '<div class="post_excerpt_grid"><p class="excerpt">';
							$output .= limit_text($excerpt,$excerpt_count);
						$output .= '</p></div>';
					}
					if($link){
						$output .= '<span class="post_comment_grid"><a class="btn btn-white btn-large" href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= $link_text;
						$output .= '</a></span>';
					}
					
							$output .= '</div>';
							}
					$output .= '</li>';
					if ($j == count($posts)-1) {
						$output .= $output_end;
					}
				if ($count % $columns == 0) {
					$output .= '</ul><!-- .posts-grid (end) -->';
				}
			$count++;
			$i++;		

		} // end for
		
		return $output;
}
 
add_shortcode('posts_grid', 'posts_grid_shortcode'); ?>