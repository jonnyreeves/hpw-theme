<?php
/**
 * Heading entrance
 *
 */
if (!function_exists('heading_entrance_shortcode')) {

	function heading_entrance_shortcode($atts, $content = null) { 
	    extract(shortcode_atts(
	        array(
				'title' => '',
				'text' => '',
				'custom_class' => ''
	    ), $atts));
	 
	
		$output =  '<div class="heading-entrance clearfix '.$custom_class.'">';
		

		if ($title!="") {
			$output .= '<h1>';
			$output .= $title;
			$output .= '</h1><div class="hr"></div>';
		}
		
		if ($text!="") {
			$output .= '<p>';
			$output .= $text;
			$output .= '</p>';
		}
	 
		$output .= '</div><!-- .heading-entrance (end) -->'; 
	    return $output; 
	} 
	add_shortcode('heading_entrance', 'heading_entrance_shortcode');
	
}?>