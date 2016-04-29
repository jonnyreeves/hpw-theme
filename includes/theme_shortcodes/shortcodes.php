<?php

// Recent Comments
if (!function_exists('shortcode_recentcomments')) {

	function shortcode_recentcomments($atts, $content = null) {
	    extract(shortcode_atts(array(
	        'num' => '5',
			'custom_class' => ''
	    ), $atts));

	    global $wpdb;
	    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
	    comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved,
	    comment_type,comment_author_url,
	    SUBSTRING(comment_content,1,50) AS com_excerpt
	    FROM $wpdb->comments
	    LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
	    $wpdb->posts.ID)
	    WHERE comment_approved = '1' AND comment_type = '' AND
	    post_password = ''
	    ORDER BY comment_date_gmt DESC LIMIT $num";

	    $comments = $wpdb->get_results($sql);

	    $output = '<ul class="recent-comments unstyled">';

	    foreach ($comments as $comment) {

	        $output .= '<li>';
	            $output .= '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">';
	                 $output .= strip_tags($comment->comment_author).' : '.strip_tags($comment->com_excerpt).'...';
	            $output .= '</a>';
	        $output .= '</li>';

	    }

	    $output .= '</ul>';
	    return $output;
	}
	add_shortcode('recentcomments', 'shortcode_recentcomments');

}


//Slideshow
if (!function_exists('shortcode_slideshow')) {

	function shortcode_slideshow($atts, $content = null) {
	
	global $hercules_add_owl;
    $hercules_add_owl = true;
    
		extract(shortcode_atts(array(
				'num' => '5',
				'autoplay' => '5000',
				'blankwindow' => 'false',
				'effect' => 'fade',
		'pagination' => 'true',
				'custom_category' => '',
				'custom_class' => ''
		), $atts));
		
$args = array(
				'post_type' => 'slideshow',
				'slideshow_categories' => $custom_category,
				'numberposts' => $num,
				'orderby' => 'post_date',
				'order' => 'DESC'
			);
			
		$slideshow = get_posts($args);
$random = hs_gener_random(10);		

		$output = '<script type="text/javascript">
						jQuery(window).ready(function() {
								 jQuery("#owl-demo_'.$random.'").owlCarousel({
		items : '.$num.',						 
	    autoPlay : '.$autoplay.',
    stopOnHover : true,
    navigation:false,
    paginationSpeed : 3000,
	touchDrag: true,
    goToFirstSpeed : 2000,
    singleItem : true,
    autoHeight : true,
	pagination : '.$pagination.',
    transitionStyle:"'.$effect.'"
  
							});
						});';
		$output .= '</script>';
		$output .= '<div id="owl-demo_'.$random.'" class="owl-carousel">'; 

		global $post;
        if ($blankwindow =="true") { $window = "_blank"; } else {$window = "_self"; }
		foreach($slideshow as $post){
				setup_postdata($post);
				$content = get_the_content();
				$custom = get_post_custom($post->ID);
				$slideshow_link =  get_post_meta($post->ID, 'my_slideshow_link', true);
				$post_id ='';
				
				if (has_post_thumbnail($post->ID)) {
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slideshow', true );
				}
				
						$output .= '<div class="featured-thumbnail thumbnail large">';
						$output .= '<div class="hider-page"></div>';
						if ($content) {
						$output .= '<div class="slideshow-caption"><div>';
								$output .= $content;
								$output .= '</div></div>';
								}
								if (has_post_thumbnail($post->ID)) {
								if ($slideshow_link) {
$output .= '<a href="'.$slideshow_link.'" target="'.$window.'">';
}						
$output .= '<img src="'.$attachment_url[0].'" alt="'.get_the_title($post_id).'" />';
if ($slideshow_link) {
$output .= '</a>';
}
}
				$output .= '</div>';

		}

		$output .= '</div>';
		
		return $output;
		}

	add_shortcode('slideshow', 'shortcode_slideshow');

}
	
	
//Tag Cloud
if (!function_exists('shortcode_tags')) {

	function shortcode_tags($atts, $content = null) {
		$output = '<div class="tags-cloud clearfix">';
		$tags = wp_tag_cloud('smallest=8&largest=8&format=array');

		foreach($tags as $tag){
				$output .= $tag.' ';
		}

		$output .= '</div><!-- .tags-cloud (end) -->';
		return $output;
	}
	add_shortcode('tags', 'shortcode_tags');

}
// Video Player
if (!function_exists('shortcode_video')) {

	function shortcode_video($atts, $content = null) {
global $hercules_add_swfobject;
$hercules_add_swfobject = true;
global $hercules_add_playlist;
$hercules_add_playlist = true;
global $hercules_add_jplayer;
$hercules_add_jplayer = true;
	    extract(shortcode_atts(array(
	        'file' => '',
	        'm4v' => '',
	        'ogv' => '',
	        'width' => '600',
	        'height' => '350',
	    ), $atts));

	    $template_url = get_template_directory_uri();
	    $id = rand();

	    $video_url = $file;
	    $m4v_url = $m4v;
	    $ogv_url = $ogv;

	    // get site URL
		$home_url = home_url();

		$pos1 = strpos($m4v_url, 'wp-content');
		$m4v_new = substr($m4v_url, $pos1, strlen($m4v_url) - $pos1);
		$file1 = $home_url.'/'.$m4v_new;

		$pos2 = strpos($ogv_url, 'wp-content');
		$ogv_new = substr($ogv_url, $pos2, strlen($ogv_url) - $pos2);
		$file2 = $home_url.'/'.$ogv_new;

	    //Check for video format
	    $vimeo = strpos($video_url, "vimeo");
	    $youtube = strpos($video_url, "youtu");

	    $output = '<div class="video-wr">';

	    //Display video
	    if ($file) {
	    	if($vimeo !== false){

	        //Get ID from video url
	        $video_id = str_replace( 'http://vimeo.com/', '', $video_url );
	        $video_id = str_replace( 'http://www.vimeo.com/', '', $video_id );

	        //Display Vimeo video
	        $output .= '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';

	    	} elseif($youtube !== false){

	        //Get ID from video url
	    	$video_id = str_replace( 'http://', '', $video_url );
	    	$video_id = str_replace( 'https://', '', $video_id );
	        $video_id = str_replace( 'www.youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtube.com/watch?v=', '', $video_id );
	        $video_id = str_replace( 'youtu.be/', '', $video_id );
	        $video_id = str_replace( '&feature=channel', '', $video_id );

	        $output .= '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=opaque" frameborder="0"></iframe>';

	    	}
	    } else {

	        $output .= '<script type="text/javascript">
						jQuery(document).ready(function(){
							if(jQuery().jPlayer) {
								jQuery("#jquery_jplayer_'. $id .'").jPlayer( {
									ready: function () {
										jQuery(this).jPlayer("setMedia", {
											m4v: "'. $file1 .'",
											ogv: "'. $file2 .'"
										});
									},
									play: function() {
										jQuery(this).jPlayer("pauseOthers");
									},
									swfPath: "'. $template_url .'/flash",
									wmode: "window",
									cssSelectorAncestor: "#jp_container_'. $id .'",
									solution: "html, flash",
									supplied: "m4v, ogv",
									size: {width: "100%", height: "100%"}
								});
							}
						});
					</script>';
			$output .= '<div id="jp_container_'. $id .'" class="jp-video fullwidth">';
			$output .= '<div class="jp-type-single">';
			$output .= '<div id="jquery_jplayer_'. $id .'" class="jp-jplayer"></div>';
			$output .= '<div class="jp-gui">';
			$output .= '<div class="jp-video-play">';
			$output .= '<a href="javascript:;" class="jp-video-play-icon" tabindex="1" title="Play">Play</a></div>';
			$output .= '<div class="jp-interface">';
			$output .= '<div class="jp-progress">';
			$output .= '<div class="jp-seek-bar">';
			$output .= '<div class="jp-play-bar">';
			$output .= '</div></div></div>';
			$output .= '<div class="jp-duration"></div>';
			$output .= '<div class="jp-time-sep">/</div>';
			$output .= '<div class="jp-current-time"></div>';
			$output .= '<div class="jp-controls-holder">';
			$output .= '<ul class="jp-controls">';
			$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1" title="Play"><span>Play</span></a></li>';
			$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1" title="Pause"><span>Pause</span></a></li>';
			$output .= '<li class="li-jp-stop"><a href="javascript:;" class="jp-stop" tabindex="1" title="Stop"><span>Stop</span></a></li>';
			$output .= '</ul>';
			$output .= '<div class="jp-volume-bar">';
			$output .= '<div class="jp-volume-bar-value">';
			$output .= '</div></div>';
			$output .= '<ul class="jp-toggles">';
			$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1" title="Mute"><span>Mute</span></a></li>';
			$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="Unmute"><span>Unmute</span></a></li>';
			$output .= '</ul>';
			$output .= '<div class="jp-title">';
			$output .= '<ul><li>'. $title .'</li></ul>';
			$output .= '</div></div></div>';
			$output .= '<div class="jp-no-solution">';
			$output .= '<span>Update Required</span>';
			$output .= 'To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.';
			$output .= '</div></div></div></div>'; 

	    }
	    $output .= '</div><!-- .video-wrap (end) -->';
	    return $output;
	}
	add_shortcode('videos', 'shortcode_video');

}
add_action( 'after_setup_theme', 'hs_setup' );
?>