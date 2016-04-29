<?php
/**
 *
 * HTML Shortcodes
 *
 */

// Frames
function frame_shortcode($atts, $content = null) {

    $output = '<figure class="thumbnail align' . $atts['align'] . ' clearfix">';
        $output .= do_shortcode($content);
    $output .= '</figure>';

    return $output;
}
add_shortcode('frame', 'frame_shortcode');

// Button
function button_shortcode($atts, $content = null) {
	extract(shortcode_atts(
        array(
            'link' => 'http://www.google.com',
            'text' => 'Button Text',
			'size' => 'normal',
			'style' => '',
			'target' => '_self',
            'display' => '',
            'class' => '',
            'icon' => 'no'
    ), $atts));
    
    $output =  '<a href="'.$link.'" title="'.$text.'" class="btn btn-'.$style.' btn-'.$size.' btn-'.$display.' '.$class.'" target="'.$target.'">';
    if ($icon != 'no') {
        $output .= '<i class="'.$icon.'"></i> ';
    }    
	$output .= $text;
	$output .= '</a><!-- .btn -->';

    return $output;
}
add_shortcode('button', 'button_shortcode');


// Map
function map_shortcode($atts, $content = null) {
wp_enqueue_script('googlemaps');
 $template_url = get_stylesheet_directory_uri();
	extract(shortcode_atts(
        array(
				'latitude' => '',
				'longitude' => '',
				'zoom' => '16',
				'saturation' => '20',
				'hue' => '#28a0ff',
				'title' => '',
				'height' => '200px',
				'markerimg' => '200px'  
    ), $atts));
    
    $output =  '<div id="googlemap" style="height:'.$height.';">';
		$output .= '</div>';
		
		$output .= '<script>
		var MY_MAPTYPE_ID = "custom_style";

function initialize() {
var styles = [
	{
    stylers: [
      { saturation: '.$saturation.' }
    ]
  },{
							// Style the map with the custom hue
							stylers: [
								{ "hue":"'.$hue.'" }
							]
						}
						
];
  var myLatlng = new google.maps.LatLng('.$latitude.', '.$longitude.');
  var image = "'. $template_url  .'/images/google-maps-marker.png";    
  var mapOptions = {
    zoom: '.$zoom.',
    disableDefaultUI: false,
scrollwheel: false,
		draggable: true,	
    center: myLatlng,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
    },
    mapTypeId: MY_MAPTYPE_ID

  }

  var map = new google.maps.Map(document.getElementById("googlemap"), mapOptions);
  
  var styledMapOptions = {
    name: "Custom Style"
  };

	
  var customMapType = new google.maps.StyledMapType(styles, styledMapOptions);
 map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

  var marker = new google.maps.Marker({
      position: myLatlng,
      icon: image,
      animation: google.maps.Animation.DROP,
      map: map,
      title: "'.$title.'"
  });

}


				function loadScript() {
					var script = document.createElement("script");
					script.type = "text/javascript";
					script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
					document.body.appendChild(script);
				}

				window.onload = loadScript;

</script>';

    return $output;
}
add_shortcode('map', 'map_shortcode');


// Dropcaps
function dropcap_shortcode($atts, $content = null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
    $output = '<p class="dropcap '. $custom_class .'">';
    $output .= do_shortcode($content);
    $output .= '</p>';

    return $output;
}
add_shortcode('dropcap', 'dropcap_shortcode');


// Horizontal Rule
function hr_shortcode($atts, $content = null) {

    $output = '<div class="hr"><!-- .hr (end) --></div>';

    return $output;
}
add_shortcode('hr', 'hr_shortcode');

// Intro text
function intro_shortcode($atts, $content = null) {

    $output = '<div class="intro">';
	$output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}
add_shortcode('intro', 'intro_shortcode');


// Small Horizontal Rule
function sm_hr_shortcode($atts, $content = null) {

    $output = '<div class="sm_hr"></div>';

    return $output;
}
add_shortcode('sm_hr', 'sm_hr_shortcode');


// Spacer
function spacer_shortcode($atts, $content = null) {

    $output = '<div class="spacer"><!-- .spacer (end) --></div>';

    return $output;
}
add_shortcode('spacer', 'spacer_shortcode');


// Blockquote
function blockquote_shortcode($atts, $content = null) {

    
    $output = '<blockquote>';
    $output .= do_shortcode($content);
    $output .= '</blockquote><!-- blockquote (end) -->';

    return $output;
}
add_shortcode('blockquote', 'blockquote_shortcode');

// Wide Row

function widerow_shortcode($atts, $content=null) {
	extract(shortcode_atts(
        array(
				'customclass' => ''  
    ), $atts));
	// add divs to the content	
	$output = '<div class="'.$customclass.'"><div class="content-holder clearfix"><div class="container"><div class="row-fluid"><div class="span12"><div class="row-fluid"><div class="span12">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div></div></div></div></div><!-- widerow (end) -->';
   
	return $output;
}
add_shortcode('widerow', 'widerow_shortcode');

// Parallax

function parallax_shortcode($atts, $content=null) {
	extract(shortcode_atts(
        array(
'photourl' => '',
'verticaloffset' => '0',
'title' => '',
'text' => '',
'textmargin' => '30',
'overlaycolor' => '#222222',
'overlayopacity' => '0.8',
'custom_class' => ''
    ), $atts));
	// add divs to the content	
	$output = '<div class="'.$custom_class.'" style="position: relative;"><div class="hider-page"></div><div style="background-image: url('.$photourl.');" class="paraphoto" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="'.$verticaloffset.'"><div class="paraphoto-overlay" style="background:'.$overlaycolor.';-moz-opacity: '.$overlayopacity.'; -khtml-opacity: '.$overlayopacity.'; opacity: '.$overlayopacity.';"><div class="container" style="padding-top:'.$textmargin.'px; padding-bottom:'.$textmargin.'px;">';
	$output .=  '<div class="heading-entrance clearfix">';  
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
	$output .= do_shortcode($content);
	$output .= '</div><!-- .heading-entrance (end) -->'; 
	$output .= '</div></div></div></div><!-- parallax (end) -->';
   
	return $output;
}
add_shortcode('parallax', 'parallax_shortcode');

// Fullwidthimage

function fullwidthimage_shortcode($atts, $content=null) {
	extract(shortcode_atts(
        array(
				'photourl' => ''				
    ), $atts));
	
$output = '<div class="post-thumb clearfix">
    <figure class="featured-thumbnail thumbnail large">
        <div class="hider-page"></div>
        <a class="image-wrap image-popup-no-margins"  href="'.$photourl.'" data-rel="Photo">
            <img src="'.$photourl.'" alt="photo" />
            <span class="zoom-icon"></span>
        </a>
    </figure>
    <div class="clear"></div>
</div>';

	return $output;
}
add_shortcode('fullwidthimage', 'fullwidthimage_shortcode');

// Row
function row_shortcode($atts, $content=null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
	// add divs to the content	
	$output = '<div class="row '. $custom_class .'">';
	$output .= do_shortcode($content);
	$output .= '</div> <!-- .row (end) -->';
   
	return $output;
}
add_shortcode('row', 'row_shortcode');

// Container
function container_shortcode($atts, $content=null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
	// add divs to the content	
	$output = '<div class="container '. $custom_class .'">';
	$output .= do_shortcode($content);
	$output .= '</div> <!-- .container (end) -->';
   
	return $output;
}
add_shortcode('container', 'container_shortcode');


// Row Inner
function row_inner_shortcode($atts, $content=null) {

    // add divs to the content  
    $output = '<div class="row">';
    $output .= do_shortcode($content);
    $output .= '</div> <!-- .row (end) -->';
   
    return $output;
}
add_shortcode('row_in', 'row_inner_shortcode');


// Row Fluid
function row_fluid_shortcode($atts, $content=null) {
extract(shortcode_atts(
	        array(
					'custom_class' => ''
	    ), $atts));
    // add divs to the content  
    $output = '<div class="row-fluid '. $custom_class .'">';
    $output .= do_shortcode($content);
    $output .= '</div> <!-- .row-fluid (end) -->';
   
    return $output;
}
add_shortcode('row_fluid', 'row_fluid_shortcode');

// Clear
function clear_shortcode($atts, $content = null) {

    $output = '<div class="clear"></div>';

    return $output;
}
add_shortcode('clear', 'clear_shortcode');


// Address
function address_shortcode($atts, $content = null) {
	
	$output = '<address>';
	$output .= do_shortcode($content);
	$output .= '</address> <!-- address (end) -->';
   
	return $output;
}
add_shortcode('address', 'address_shortcode');


// Lists

// Unstyled
function list_un_shortcode($atts, $content = null) {
    $output = '<div class="list unstyled">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('list_un', 'list_un_shortcode');

// Check List
function check_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled check-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('check_list', 'check_list_shortcode');

// Check2 List
function check2_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled check2-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('check2_list', 'check2_list_shortcode');

// Arrow List
function arrow_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled arrow-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('arrow_list', 'arrow_list_shortcode');

// Arrow2 List
function arrow2_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled arrow2-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('arrow2_list', 'arrow2_list_shortcode');

// Circle List
function circle_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled circle-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('circle_list', 'circle_list_shortcode');

// Plus List
function plus_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled plus-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('plus_list', 'plus_list_shortcode');

// Minus List
function minus_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled minus-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('minus_list', 'minus_list_shortcode');

// Custom List
function custom_list_shortcode($atts, $content = null) {
    $output = '<div class="list styled custom-list">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
add_shortcode('custom_list', 'custom_list_shortcode');


// Vertical Rule
function vr_shortcode($atts, $content = null) {
	
	$output = '<div class="vertical-divider">';
	$output .= do_shortcode($content);
	$output .= '</div> <!-- divider (end) -->';
   
	return $output;
}
add_shortcode('vr', 'vr_shortcode');


// Label
function label_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'style' => '',
            'icon' => ''
    ), $atts));

    $output = '<span class="label label-'.$style.'">';
    if ($icon != "") {
        $output .= '<i class="'.$icon.'"></i>';
    }
    $output .= $content .'</span>';

    return $output;
}
add_shortcode('label', 'label_shortcode');


// Text Highlight
function highlight_shortcode($atts, $content = null) {

    $output = '<span class="text-highlight">';
    $output .= do_shortcode($content);
    $output .= '</span><!-- .highlight (end) -->';

    return $output;
}
add_shortcode('highlight', 'highlight_shortcode');


// Icon
function icon_shortcode($atts, $content = null) {

    extract(shortcode_atts(
        array(
            'icons' => '',
            'align' => '',
			'size' => '',
			'color' => ''
    ), $atts));

    if ($icons != '') {
        $output = '<i style="color:'. $color .'" class="'. $icons .' align'. $align .' '. $size .'"></i>';
        return $output;
    }    
}
add_shortcode('icon', 'icon_shortcode');

// Template URL
function template_url_shortcode($atts, $content = null) {

    $template_url = home_url();
    return $template_url;
}
add_shortcode('template_url', 'template_url_shortcode');

// Extra Wrap
function extra_wrap_shortcode($atts, $content = null) {

    $output = '<div class="extra-wrap">';
        $output .= do_shortcode($content);
    $output .= '</div>';

    return $output;
}
add_shortcode('extra_wrap', 'extra_wrap_shortcode');
?>