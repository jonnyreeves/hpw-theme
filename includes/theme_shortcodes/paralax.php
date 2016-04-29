<?php
/**
 * Paralax
 *
 */
if (!function_exists('shortcode_paralax')) {

	function shortcode_paralax($atts, $content = null) {
	
		extract(shortcode_atts(
	        array(
					'image' => '',
					'velocity' => '3',
					'minheight' => '900px',
					'height' => '1200px',
					'contentopposition' => '80px'
	    ), $atts));

		$hercules_home_url = get_template_directory_uri();
		$output = '<section style="position: relative; min-height:'.$minheight.'; width: 100% !important; margin: 0; padding: 0; overflow: hidden;">';
		$output .= '<div style="position:absolute;z-index:4; width: 100%; top:'.$contentopposition.'">';
		$output .= do_shortcode($content);
		$output .= '</div>';
		$output .= '<div class="parallax" style="background: url('.$hercules_home_url.'/images/'.$image.') 50% 0 no-repeat fixed; margin: 0; height: '.$height.'; position:absolute; width:100%;    top:0;left:0;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; " data-velocity="-.'.$velocity.'"></div></section>';

		return $output;

	}
	add_shortcode('paralax', 'shortcode_paralax');

}?>