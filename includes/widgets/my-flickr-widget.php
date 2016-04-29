<?php
// =============================== My Flickr widget  ======================================
  
class MY_FlickrWidget extends WP_Widget {
function __construct() {
$widget_ops = array(
'classname' => 'flickr',
'description' => __('A widget that displays the latest flickr images', HS_CURRENT_THEME)
);
parent::__construct( 'flickr-widget', __('hercules - Flickr', HS_CURRENT_THEME), $widget_ops );
add_action('wp_enqueue_scripts', array(&$this, 'js'));
}   // Widget Settings
function js(){
    if ( is_active_widget(false, false, $this->id_base, true) ) {
      wp_enqueue_script('jflickrfeed');
    }           

  }

  /** @see WP_Widget::widget */
  function widget($args, $instance) {	
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $flickr_id = apply_filters('flickr_id', $instance['flickr_id']);
    $amount = apply_filters('flickr_image_amount', $instance['image_amount']);
    $linktext = apply_filters('widget_linktext', $instance['linktext']);
	$suf = rand(100000,999999);

?>
<?php echo $before_widget; 
if ( $title )
echo $before_title . $title . $after_title; ?>
                 
<div class="grid_gallery clearfix">			
<div class="zoom-gallery grid_gallery_inner">
<div id="cbox">
</div>
</div>
<?php if ($linktext) { ?>
<br>
<a href="http://flickr.com/photos/<?php echo $flickr_id ?>" class="btn22 btn-1 btn-1c"><?php echo $linktext; ?></a>
<?php } ?>
</div>

<script>
jQuery('#cbox').jflickrfeed({
	limit: <?php echo $amount ?>,
	qstrings: {
		id: '<?php echo $flickr_id ?>'
	},
	itemTemplate:
	'<div class="gallery_item"><figure class="featured-thumbnail thumbnail large"><div class="hider-page"></div>' +
		'<a class="image-wrap thumbnail zoomer" data-source="{{image_b}}" href="{{image_b}}" title="{{title}}">' +
			'<img src="{{image_q}}" alt="{{title}}" />' +
		'<span class="zoom-icon"></span></a>' +
	'</figure></div>'
}, function(data) {
    jQuery();
});

</script>
<?php wp_reset_query(); ?>
								
<?php echo $after_widget; ?>
			 
<?php }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
      /* Set up some default widget settings. */
      $defaults = array( 'title' => '', 'flickr_id' => '', 'image_amount' => '', 'linktext' => '' );
      $instance = wp_parse_args( (array) $instance, $defaults );	

      $title = esc_attr($instance['title']);
			$flickr_id = esc_attr($instance['flickr_id']);
			$amount = esc_attr($instance['image_amount']);
			$linktext = esc_attr($instance['linktext']);
			
        ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

      <p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" /></label></p>
	  	<p><label for="<?php echo $this->get_field_id('image_amount'); ?>"><?php _e('Images count:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('image_amount'); ?>" name="<?php echo $this->get_field_name('image_amount'); ?>" type="text" value="<?php echo $amount; ?>" /></label></p>	
      <p><label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link Text:', HS_CURRENT_THEME); ?> <input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" /></label></p>	
			
<?php }

} // class  Widget
?>