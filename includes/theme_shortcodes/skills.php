<?php
/**
 * Skills
 *
 */
if (!function_exists('shortcode_skills')) {

	function shortcode_skills($atts, $content = null) {
	global $hercules_add_donutchart;
    $hercules_add_donutchart = true;
		extract(shortcode_atts(
	        array(
					'value' => '0',
					'size' => '180',
					'bgcolor' => '#f2f2f2',
					'fgcolor' => '#000000',
					'donutwidth' => '27',
					'title' => '',
					'font' => '',
					'fontsize' => '',
					'fontstyle' => '',
					'custom_class' => ''
	    ), $atts));

		
		$output = '<div class="skills '. $custom_class .'" style="text-align:center; font-family:'. $font .'; font-style:'. $fontstyle .'; font-size:'. $fontsize .'">
            <div class="chart" data-bgcolor="'. $bgcolor .'" data-fgcolor="'. $fgcolor .'" data-donutwidth="'. $donutwidth .'" data-size="'. $size .'" data-percent="'. $value .'"><span style="line-height: '. $size .'px;" class="percent"></span></div>
			
			
			<p style="color:#000000;">'. $title .'</p>
			</div>';
	    return $output;

	}
	add_shortcode('skills', 'shortcode_skills');

}?>