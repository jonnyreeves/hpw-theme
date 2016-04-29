<?php
/**
 * Progressbar
 *
 */
if (!function_exists('shortcode_progressbar')) {

	function shortcode_progressbar($atts, $content = null) {
		extract(shortcode_atts(
	        array(
					'value' => '50',
					'label' => '',
					'custom_class' => ''
	    ), $atts));
		
$output = '<div class="bars"><div class="progress-label">'.$label.'</div>';
		$output .= '<div id="max'.$value.'" class="progress active '.$custom_class.'">';
		$output .= '<div class="bar" data-progress="'.$value.'" ><span>'.$value.'%</span></div>';
		$output .= '</div>';
$output .= '</div>';
	    return $output;

	}
	add_shortcode('progressbar', 'shortcode_progressbar');

}?>